<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SeminarHasil;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class SeminarHasilTable extends Component
{
    public $ids, $nrev1_semhas, $nrev2_semhas, $dok_rev_semhas;

    public $search="";
    public $result=3;

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'semhasstore' => 'render',
        'delSemhas' => 'render'
    ];
    public function render()
    {
        return view('livewire.seminar-hasil-table', [
            'semhass' => DB::table('seminar_hasils')
            ->leftJoin('laporan_hasils', 'laporan_hasils.id', 'seminar_hasils.id_laphasil')
            ->where('judul_pkm', 'like', '%'.$this->search.'%')
            ->paginate($this->result)
        ]);
    }

    public function update($id)
    {
        $temp = DB::table('seminar_hasils')->where('id_semhas', $id)->first();
        $this->ids = $temp->id_semhas;
        $this->nrev1_semhas = $temp->nrev1_semhas;
        $this->nrev2_semhas = $temp->nrev2_semhas;
        $this->dok_rev_semhas = $temp->dok_rev_semhas;
        $this->tgl_semhas = $temp->tgl_semhas;
        $this->jam_semhas = $temp->jam_semhas;
        $this->sifat_semhas = $temp->sifat_semhas;
        $this->tmpt_semhas = $temp->tmpt_semhas;
        $this->tautan_semhas = $temp->tautan_semhas;
        $this->rev1_semhas = $temp->rev1_semhas;
        $this->rev2_semhas = $temp->rev2_semhas;
    }

    public function ClearForm()
    {
        $this->ids = Null;
        $this->nrev1_semhas = Null;
        $this->nrev2_semhas = Null;
        $this->dok_rev_semhas = Null;
        $this->tgl_semhas = Null;
        $this->jam_semhas = Null;
        $this->sifat_semhas = Null;
        $this->tmpt_semhas = Null;
        $this->tautan_semhas = Null;
        $this->rev1_semhas = Null;
        $this->rev2_semhas = Null;
    }

    public function add_notes()
    {
        // $temp = DB::table('seminar_hasils')->where('id_semhas', $this->ids)->first();
        SeminarHasil::find($this->ids)->update([
            'nrev1_semhas' => $this->nrev1_semhas,
            'nrev2_semhas' => $this->nrev2_semhas,
        ]);
        session()->flash('success', 'Catatan Berhasil Diubah!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function dokrev()
    {
        $temp = DB::table('seminar_hasils')->where('id_semhas', $this->ids)->first();

        if($temp->dok_rev_semhas == Null){
            $this->validate([
                'dok_rev_semhas' => 'required|mimes:pdf,docx|max:5000'
            ]);
            $filename = $this->dok_rev_semhas->store('berkas-revsemhas', 'public');
        } else if($this->dok_rev_semhas != $temp->dok_rev_semhas){
            $this->validate(['dok_rev_semhas' => 'required|mimes:pdf,docx|max:5000']);
            unlink(public_path('storage/'.$temp->dok_rev_semhas));
            $filename = $this->dok_rev_semhas->store('berkas-revsemhas', 'public');
        } else if($this->dok_rev_semhas == $temp->dok_rev_semhas){
            $filename = $this->dok_rev_semhas;
        }

        SeminarHasil::find($this->ids)->update([
            'dok_rev_semhas' => $filename,
        ]);
        session()->flash('success', 'Dokumen Revisi Telah Ditambahkan!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function ubahsemhas()
    {
        $temp = DB::table('seminar_hasils')->where('id_semhas', $this->ids)->first();
        $this->validate([
            'tgl_semhas' => 'required',
            'jam_semhas' => 'required',
            'sifat_semhas' => 'required',
            // 'tmpt_seminar' => 'required|string|min:4',
            // 'tautan' => 'required|url|',
            'rev1_semhas' => 'required|string',
            'rev2_semhas' => 'required|string'
        ]);

        if($this->sifat_semhas != $temp->sifat_semhas){
            if($this->sifat_semhas == 'Luring'){
                $this->validate(['tmpt_semhas' => 'required|string|min:4']);
                $this->tautan_semhas = Null;
            } elseif ($this->sifat_semhas == 'Daring') {
                $this->validate(['tautan_semhas' => 'required|url']);
                $this->tmpt_semhas = Null;
            }
        }
        

        $data = [
            'tgl_semhas' => $this->tgl_semhas,
            'jam_semhas' => $this->jam_semhas,
            'sifat_semhas' => $this->sifat_semhas,
            'tmpt_semhas' => $this->tmpt_semhas,
            'tautan_semhas' => $this->tautan_semhas,
            'rev1_semhas' => $this->rev1_semhas,
            'rev2_semhas' => $this->rev2_semhas
        ];

        $get = SeminarHasil::find($this->ids)->update($data);
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
        session()->flash('success', 'Pengaturan Diubah!');
    }
}
