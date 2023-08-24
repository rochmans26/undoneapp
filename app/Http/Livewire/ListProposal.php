<?php

namespace App\Http\Livewire;

use App\Models\Skim;
use App\Models\Bidang;
use Livewire\Component;
use App\Models\Proposals;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\AnggotaDosenLuar;
use App\Models\AnggotaMahasiswa;
use App\Models\AnggotaDosenLokal;
use Illuminate\Support\Facades\DB;

class ListProposal extends Component
{
    public $ids, $judul_proposal, $id_bidang, $id_skim, $lokasi_kegiatan, $thn_mulai, $thn_selesai, $dok_link;
    public $search="";
    public $result=10;
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.list-proposal', [
            'proposals' => DB::table('proposals')
            ->leftJoin('bidangs', 'bidangs.id_bidang', 'proposals.id_bidang')
            ->leftJoin('skims', 'skims.id_skim', 'proposals.id_skim')
            ->orderBy('id','desc')
            ->where('judul_proposal', 'like', '%'.$this->search.'%')
            ->orWhere('thn_mulai', 'like', '%'.$this->search.'%')
            ->orWhere('thn_selesai', 'like', '%'.$this->search.'%')
            ->orWhere('nm_bidang', 'like', '%'.$this->search.'%')
            ->orWhere('nm_skim', 'like', '%'.$this->search.'%')
            ->paginate($this->result),
            'bidangs' => Bidang::all(),
            'skims' => Skim::all()
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function create()
    {
        
        $this->validate([
            'judul_proposal' => 'required|string|min:10|unique:proposals',
            'id_bidang' => 'required',
            'id_skim' => 'required',
            'lokasi_kegiatan' => 'required|string|min:4',
            'thn_mulai' => 'required|numeric',
            'thn_selesai' => 'required|numeric',
            'dok_link' => 'file|max:5000',
        ]);

        $filename = $this->dok_link->store('berkas', 'public');

        Proposals::create([
            'judul_proposal' => $this->judul_proposal,
            'slug' => Str::of($this->judul_proposal)->slug('-'),
            'id_bidang' => $this->id_bidang,
            'id_skim' => $this->id_skim,
            'lokasi_kegiatan' => $this->lokasi_kegiatan,
            'thn_mulai' => $this->thn_mulai,
            'thn_selesai' => $this->thn_selesai,
            'dok_link' => $filename
        ]);
        
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Berhasil Menambahkan Data Proposal!');
        $this->ClearForm();
    }

    public function ClearForm()
    {
        $this->judul_proposal = Null;
        $this->id_bidang = Null;
        $this->id_skim = Null;
        $this->lokasi_kegiatan = Null;
        $this->thn_mulai = Null;
        $this->thn_selesai = Null;
        $this->dok_link = Null;
    }

    public function edit($id)
    {
        $proposal = Proposals::where('id', $id)->first();
        $this->ids = $proposal->id;
        $this->judul_proposal = $proposal->judul_proposal;
        $this->id_bidang = $proposal->id_bidang;
        $this->id_skim = $proposal->id_skim;
        $this->lokasi_kegiatan = $proposal->lokasi_kegiatan;
        $this->thn_mulai = $proposal->thn_mulai;
        $this->thn_selesai = $proposal->thn_selesai;
        // $this->thn_pelaksanaan = $proposal->thn_pelaksanaan;
        $this->dok_link = $proposal->dok_link;
    }

    public function update()
    {
        
        $this->validate([
            // 'judul_proposal' => 'required|string|min:10|unique:proposals',
            'id_bidang' => 'required',
            'id_skim' => 'required',
            'lokasi_kegiatan' => 'required|string|min:4',
            'thn_mulai' => 'required|numeric',
            'thn_selesai' => 'required|numeric',
            // 'thn_pelaksanaan' => 'required|numeric',
            // 'dok_link' => 'required'
        ]);

        $proposal = Proposals::where('id', $this->ids)->first();
        if($this->judul_proposal != $proposal->judul_proposal){
            $this->validate(['judul_proposal' => 'required|string|min:10|unique:proposals']);
        }

        if($this->dok_link != $proposal->dok_link){
            $this->validate(['dok_link' => 'required|mimes:pdf,docx|max:5000']);
            unlink(public_path('storage/'.$proposal->dok_link));
            $filename = $this->dok_link->store('berkas-proposal', 'public');
        } else if($this->dok_link == $proposal->dok_link){
            $filename = $this->dok_link;
        }

        $data = [
            'judul_proposal' => $this->judul_proposal,
            'id_bidang' => $this->id_bidang,
            'id_skim' => $this->id_skim,
            'lokasi_kegiatan' => $this->lokasi_kegiatan,
            'thn_mulai' => $this->thn_mulai,
            'thn_selesai' => $this->thn_selesai,
            // 'thn_pelaksanaan' => $this->thn_pelaksanaan,
            'dok_link' => $filename
        ];
        $get = Proposals::find($this->ids)->update($data);
        // $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Data Berhasil Diedit');
        $this->ClearForm();
    
    }

    public function details($id)
    {
        $proposal = Proposals::where('id', $id)->first();
        $this->ids = $proposal->id;
        $this->judul_proposal = $proposal->judul_proposal;
        $this->id_bidang = $proposal->id_bidang;
        $this->id_skim = $proposal->id_skim;
        $this->lokasi_kegiatan = $proposal->lokasi_kegiatan;
        $this->thn_mulai = $proposal->thn_mulai;
        $this->thn_selesai = $proposal->thn_selesai;
        // $this->thn_pelaksanaan = $proposal->thn_pelaksanaan;
        $this->dok_link = $proposal->dok_link;
    }

    public function confirmdel($id){
        $prop = Proposals::where('id', $id)->first();
        $this->ids = $prop->id;
        $this->dok_link = $prop->dok_link;
    }

    public function delete()
    {
        unlink(public_path('storage/'.$this->dok_link));
        $del = Proposals::find($this->ids)->delete();
        // AnggotaDosenLokal::find($this->ids)->delete();
        // AnggotaDosenLuar::find($this->ids)->delete();
        // AnggotaMahasiswa::find($this->ids)->delete();
        session()->flash('success', 'Data Berhasil Dihapus');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function deleteall()
    {
        DB::table('proposals')->truncate();
        DB::table('anggota_dosen_lokals')->truncate();
        DB::table('anggota_dosen_luars')->truncate();
        DB::table('anggota_mahasiswas')->truncate();
    }
}
