<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\SeminarProposals;
use Illuminate\Support\Facades\DB;

class SeminarProposalTable extends Component
{
    public $ids, $note_rev1, $note_rev2, $dok_rev;
    public $tgl_seminar, $jam_seminar, $sifat_seminar, $tmpt_seminar, $tautan, $reviewer1, $reviewer2;

    public $search="";
    public $result=3;

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'semprostore' => 'render',
        'delSempro' => 'render'
    ];

    public function render()
    {
        return view('livewire.seminar-proposal-table',[
            'sempros' => DB::table('seminar_proposals')
            ->leftJoin('proposals', 'proposals.id', 'seminar_proposals.id_proposal')
            ->where('judul_proposal', 'like', '%'.$this->search.'%')
            ->paginate($this->result)
        ]);
    }

    public function update($id)
    {
        $temp = DB::table('seminar_proposals')->where('id_sempro', $id)->first();
        $this->ids = $temp->id_sempro;
        $this->note_rev1 = $temp->note_rev1;
        $this->note_rev2 = $temp->note_rev2;
        $this->dok_rev = $temp->dok_rev;
        $this->tgl_seminar = $temp->tgl_seminar;
        $this->jam_seminar = $temp->jam_seminar;
        $this->sifat_seminar = $temp->sifat_seminar;
        $this->tmpt_seminar = $temp->tmpt_seminar;
        $this->tautan = $temp->tautan;
        $this->reviewer1 = $temp->reviewer1;
        $this->reviewer2 = $temp->reviewer2;

    }

    public function ClearForm()
    {
        $this->ids = Null;
        $this->note_rev1 = Null;
        $this->note_rev2 = Null;
        $this->dok_rev = Null;
        $this->tgl_seminar = Null;
        $this->jam_seminar =Null;
        $this->sifat_seminar =Null;
        $this->tmpt_seminar =Null;
        $this->tautan =Null;
        $this->reviewer1 =Null;
        $this->reviewer2 =Null;
    }

    public function add_notes()
    {
        $temp = DB::table('seminar_proposals')->where('id_sempro', $this->ids)->first();
        SeminarProposals::find($this->ids)->update([
            'note_rev1' => $this->note_rev1,
            'note_rev2' => $this->note_rev2,
        ]);
        session()->flash('success', 'Catatan Berhasil Diubah!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function dokrev()
    {
        $temp = DB::table('seminar_proposals')->where('id_sempro', $this->ids)->first();

        if($temp->dok_rev == Null){
            $this->validate([
                'dok_rev' => 'required|mimes:pdf,docx|max:5000'
            ]);
            $filename = $this->dok_rev->store('berkas-revsempro', 'public');
        } else if($this->dok_rev != $temp->dok_rev){
            $this->validate(['dok_rev' => 'required|mimes:pdf,docx|max:5000']);
            unlink(public_path('storage/'.$temp->dok_rev));
            $filename = $this->dok_rev->store('berkas-revsempro', 'public');
        } else if($this->dok_rev == $temp->dok_rev){
            $filename = $this->dok_rev;
        }

        SeminarProposals::find($this->ids)->update([
            'dok_rev' => $filename,
        ]);
        session()->flash('success', 'Dokumen Revisi Telah Ditambahkan!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function ubahseminar()
    {
        $temp = DB::table('seminar_proposals')->where('id_sempro', $this->ids)->first();

        $this->validate([
            'tgl_seminar' => 'required',
            'jam_seminar' => 'required',
            'sifat_seminar' => 'required',
            // 'tmpt_seminar' => 'required|string|min:4',
            // 'tautan' => 'required|url|',
            'reviewer1' => 'required|string',
            'reviewer2' => 'required|string'
        ]);
        
        if($this->sifat_seminar != $temp->sifat_seminar){
            if($this->sifat_seminar == 'Luring'){
                $this->validate(['tmpt_seminar' => 'required|string|min:4']);
                $this->tautan = Null;
            } elseif ($this->sifat_seminar == 'Daring') {
                $this->validate(['tautan' => 'required|url']);
                $this->tmpt_seminar = Null;
            }
        }

        $data = [
            'tgl_seminar' => $this->tgl_seminar,
            'jam_seminar' => $this->jam_seminar,
            'sifat_seminar' => $this->sifat_seminar,
            'tmpt_seminar' => $this->tmpt_seminar,
            'tautan' => $this->tautan,
            'reviewer1' => $this->reviewer1,
            'reviewer2' => $this->reviewer2
        ];

        $get = SeminarProposals::find($this->ids)->update($data);
        session()->flash('success', 'Pengaturan Seminar Diubah!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
