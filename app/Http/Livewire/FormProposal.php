<?php

namespace App\Http\Livewire;

use App\Models\Skim;
use App\Models\Prodi;
use App\Models\Bidang;
use App\Models\Dosens;
use Livewire\Component;
use App\Models\Proposals;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class FormProposal extends Component
{
    use WithFileUploads;
    // public $params;
    public $token_id = null;
    public $ids, $judul_proposal, $id_bidang, $id_skim, $lokasi_kegiatan, $thn_usulan, $thn_kegiatan, $thn_pelaksanaan, $dok_link;

    public $keanggotaanProposal = [];

    public function mount()
    {
        $this->keanggotaanProposal = [
            ['id_dosen' => '', 'peran' => 'anggota']
        ];
    }
    public function addDosen()
    {
        $this->keanggotaanProposal[] = ['id_dosen' => '', 'peran' => 'anggota'];
    }

    public function removeDosen($index)
    {
        unset($this->keanggotaanProposal[$index]);
        $this->keanggotaanProposal = array_values($this->keanggotaanProposal);
    }

    public function render()
    {
        $this->generateUniqueCode();
        return view('livewire.form-proposal', [
            'token_id' => $this->token_id,
            'bidangs' => Bidang::all(),
            'skims' => Skim::all(),    
            'dosens' => Dosens::all(),
            'prodis' => Prodi::all()
        ]);
    }

   

    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (Proposals::where("id", "=", $code)->first());
  
        return $this->token_id = $code;
    }

    public function checker()
    {
        $temp = Proposals::where('id', $this->token_id)->first();
        if ($temp != null) {
            $data = [
                'id' => $this->token_id,
                'judul_proposal' => $this->judul_proposal,
                'id_bidang' => $this->id_bidang,
                'id_skim' => $this->id_skim,
                'lokasi_kegiatan' => $this->lokasi_kegiatan,
                'thn_usulan' => $this->thn_usulan,
                'thn_kegiatan' => $this->thn_kegiatan,
                'thn_pelaksanaan' => $this->thn_pelaksanaan,
                'dok_link' => $this->dok_link
            ];
            if($temp == $data){
                session()->flash('warning', 'Data Telah Dikirimkan!');
            } else{
                $this->ids = $this->id_param;
                $this->update();
            }
        } else {
            $this->create();
        }
    }

    public function create()
    {
        
        $this->validate([
            'judul_proposal' => 'required|string|min:10|unique:proposals',
            'id_bidang' => 'required',
            'id_skim' => 'required',
            'lokasi_kegiatan' => 'required|string|min:4',
            'thn_usulan' => 'required|numeric',
            'thn_kegiatan' => 'required|numeric',
            'thn_pelaksanaan' => 'required|numeric',
            'dok_link' => 'required|mimes:pdf,docx|max:5000',
        ]);

        $filename = $this->dok_link->store('berkas', 'public');

        Proposals::create([
            'id' => $this->token_id,
            'judul_proposal' => $this->judul_proposal,
            'slug' => Str::of($this->judul_proposal)->slug('-'),
            'id_bidang' => $this->id_bidang,
            'id_skim' => $this->id_skim,
            'lokasi_kegiatan' => $this->lokasi_kegiatan,
            'thn_usulan' => $this->thn_usulan,
            'thn_kegiatan' => $this->thn_kegiatan,
            'thn_pelaksanaan' => $this->thn_pelaksanaan,
            'dok_link' => $filename
        ]);
        
        // $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Berhasil Menambahkan Data Proposal!');
        $this->ClearForm();
    }
    public function update()
    {
        
        $this->validate([
            // 'judul_proposal' => 'required|string|min:10|unique:proposals',
            'id_bidang' => 'required',
            'id_skim' => 'required',
            'lokasi_kegiatan' => 'required|string|min:4',
            'thn_usulan' => 'required|numeric',
            'thn_kegiatan' => 'required|numeric',
            'thn_pelaksanaan' => 'required|numeric',
            // 'dok_link' => 'required'
        ]);

        $proposal = Proposals::where('id', $this->ids)->first();
        if($this->judul_proposal != $proposal->judul_proposal){
            $this->validate(['judul_proposal' => 'required|string|min:10|unique:proposals']);
        }

        if($this->dok_link != $proposal->dok_link){
            $this->validate(['dok_link' => 'required|mimes:pdf,docx|max:5000']);
            unlink(public_path('storage/'.$proposal->dok_link));
            $filename = $this->dok_link->store('berkas', 'public');
        } else if($this->dok_link == $proposal->dok_link){
            $filename = $this->dok_link;
        }

        $data = [
            'judul_proposal' => $this->judul_proposal,
            'id_bidang' => $this->id_bidang,
            'id_skim' => $this->id_skim,
            'lokasi_kegiatan' => $this->lokasi_kegiatan,
            'thn_usulan' => $this->thn_usulan,
            'thn_kegiatan' => $this->thn_kegiatan,
            'thn_pelaksanaan' => $this->thn_pelaksanaan,
            'dok_link' => $filename
        ];
        $get = Proposals::find($this->ids)->update($data);
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Data Berhasil Diedit');
    }
}
