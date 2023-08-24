<?php

namespace App\Http\Livewire;

use App\Models\Skim;
use App\Models\Bidang;
use Livewire\Component;
use App\Models\Proposals;
use App\Models\LaporanHasil;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class LaporanHasilTable extends Component
{
    public $id_proposal, $ids, $id_laphasil, $judul_pkm, $id_bidang, $id_skim, $lok_kegiatan, $thn_mulai, $thn_selesai, $pendanaan, $nosk_pkm, $tglsk_pkm, $mitra_pkm, $dok_laphasil, $dana_dikti, $dana_unla, $dana_lainnya;
    // public $id_proposal, $ids, $id_laphasil, $judul_pkm, $id_bidang, $id_skim, $lok_kegiatan, $thn_usulan, $thn_kegiatan, $thn_pelaksanaan, $pendanaan, $nosk_pkm, $tglsk_pkm, $mitra_pkm, $dok_laphasil, $dana_dikti, $dana_unla, $dana_lainnya;

    public $search="";
    public $result=10;

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $showresult = false;
    public $type = "";
    public $records;
    // public $empDetails;

    public function typeResult()
    {
        if(!empty($this->type)){
            $this->records = Proposals::orderby('id', 'asc')
            ->select('*')
            ->where('judul_proposal','like','%'.$this->type.'%')
            ->limit(5)
            ->get();
            $this->showresult = true;
        }else{
            $this->showresult = false;
        }
    }

    // Fetch record by ID
    public function fetchProposalDetail($id = 0){
        // dd($id);
        $record = Proposals::select('*')
        ->where('id',$id)
        ->first();

        $this->type = $record->judul_proposal;
        // $this->empDetails = $record;
        $this->id_proposal = $record->id;
        $this->showresult = false;
    }

    public function render()
    {
        return view('livewire.laporan-hasil-table',[
            'laporanhasil' => DB::table('laporan_hasils')
            // ->leftJoin('proposals', 'proposals.id', 'laporan_hasils.id')
            ->leftJoin('bidangs', 'bidangs.id_bidang', 'laporan_hasils.id_bidang')
            ->leftJoin('skims', 'skims.id_skim', 'laporan_hasils.id_skim')
            ->orderBy('id','desc')
            ->where('judul_pkm', 'like', '%'.$this->search.'%')
            ->paginate($this->result),
            'bidangs' => Bidang::all(),
            'skims' => Skim::all(),
            'proposals' => Proposals::all(),
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function create()
    {
        $this->validate([
            'judul_pkm' => 'required|string|min:5|unique:laporan_hasils',
            'id_bidang' => 'required',
            'id_skim' => 'required',
            'lok_kegiatan' => 'required|string|min:4',
            'thn_mulai' => 'required|numeric',
            'thn_selesai' => 'required|numeric',
            // 'thn_pelaksanaan' => 'required|numeric',
            'nosk_pkm' => 'required',
            'tglsk_pkm' => 'required|date',
            'mitra_pkm' => 'required',
            'dok_laphasil' => 'required|mimes:pdf,docx|max:5000',
        ]);
        $filename = $this->dok_laphasil->store('berkas-laphasil', 'public');
        
        $temp = LaporanHasil::where('id', $this->id_proposal)->first();
        if($temp == Null){
            $data = [
                'judul_pkm' => $this->judul_pkm,
                'id' => $this->id_proposal,
                'id_bidang' => $this->id_bidang,
                'id_skim' => $this->id_skim,
                'lok_kegiatan' => $this->lok_kegiatan,
                'thn_mulai' => $this->thn_mulai,
                'thn_selesai' => $this->thn_selesai,
                // 'thn_pelaksanaan' => $this->thn_pelaksanaan,
                'dana_dikti' => $this->dana_dikti,
                'dana_unla' => $this->dana_unla,
                'dana_lainnya' => $this->dana_lainnya,
                'nosk_pkm' => $this->nosk_pkm,
                'tglsk_pkm' => $this->tglsk_pkm,
                'mitra_pkm' => $this->mitra_pkm,
                'dok_laphasil' => $filename
            ];
            // dd($data);
    
            LaporanHasil::create($data);
            $this->dispatchBrowserEvent('closeModal');
            session()->flash('success', 'Berhasil Menambahkan Data Laporan!');
            $this->ClearForm();
        } else {
            $this->dispatchBrowserEvent('closeModal');
            session()->flash('error', 'Referensi Judul Proposal Telah Digunakan!');
        }

        
    }

    public function ClearForm()
    {
        $this->judul_pkm = Null;
        $this->id_proposal = Null;
        $this->id_bidang = Null;
        $this->id_skim = Null;
        $this->lok_kegiatan = Null;
        $this->thn_mulai = Null;
        $this->thn_selesai = Null;
        // $this->thn_pelaksanaan = Null;
        $this->dana_unla = Null;
        $this->dana_dikti = Null;
        $this->dana_lainnya = Null;
        $this->nosk_pkm = Null;
        $this->tglsk_pkm = Null;
        $this->mitra_pkm = Null;
        $this->dok_laphasil = Null;
        $this->type = Null;
    }

    public function edit($id)
    {
        $lap = LaporanHasil::where('id', $id)->first();
        $proposal = Proposals::where('id', $lap->id)->first();
        $this->ids = $lap->id;
        $this->type = $proposal->judul_proposal;
        $this->judul_pkm = $lap->judul_pkm;
        $this->id_bidang = $lap->id_bidang;
        $this->id_skim = $lap->id_skim;
        $this->lok_kegiatan = $lap->lok_kegiatan;
        $this->thn_mulai = $lap->thn_mulai;
        $this->thn_selesai = $lap->thn_selesai;
        // $this->thn_pelaksanaan = $lap->thn_pelaksanaan;
        $this->dana_dikti = $lap->dana_dikti;
        $this->dana_unla = $lap->dana_unla;
        $this->dana_lainnya = $lap->dana_lainnya;
        $this->nosk_pkm = $lap->nosk_pkm;
        $this->tglsk_pkm = $lap->tglsk_pkm;
        $this->mitra_pkm = $lap->mitra_pkm;
        $this->dok_laphasil = $lap->dok_laphasil;
    }

    public function update()
    {
        
        $this->validate([
            // 'judul_proposal' => 'required|string|min:10|unique:proposals',
            'id_bidang' => 'required',
            'id_skim' => 'required',
            'lok_kegiatan' => 'required|string|min:4',
            'thn_mulai' => 'required|numeric',
            'thn_selesai' => 'required|numeric',
            // 'thn_pelaksanaan' => 'required|numeric',
            'nosk_pkm' => 'required',
            'tglsk_pkm' => 'required|date',
            'mitra_pkm' => 'required',
            // 'dok_laphasil' => 'required',
        ]);

        $laporanhasil = LaporanHasil::where('id', $this->ids)->first();
        if($this->judul_pkm != $laporanhasil->judul_pkm){
            $this->validate(['judul_pkm' => 'required|string|min:10|unique:laporan_hasils']);
        }

        if($this->dok_laphasil != $laporanhasil->dok_laphasil){
            $this->validate(['dok_laphasil' => 'required|mimes:pdf|max:5000']);
            unlink(public_path('storage/'.$laporanhasil->dok_laphasil));
            $filename = $this->dok_laphasil->store('berkas-laphasil', 'public');
        } else if($this->dok_laphasil == $laporanhasil->dok_laphasil){
            $filename = $this->dok_laphasil;
        }
        // dd($filename);
        $data = [
            'judul_pkm' => $this->judul_pkm,
            'id_bidang' => $this->id_bidang,
            'id_skim' => $this->id_skim,
            'lok_kegiatan' => $this->lok_kegiatan,
            'thn_mulai' => $this->thn_mulai,
            'thn_selesai' => $this->thn_selesai,
            // 'thn_pelaksanaan' => $this->thn_pelaksanaan,
            'dana_dikti' => $this->dana_dikti,
            'dana_unla' => $this->dana_unla,
            'dana_lainnya' => $this->dana_lainnya,
            'nosk_pkm' => $this->nosk_pkm,
            'tglsk_pkm' => $this->tglsk_pkm,
            'mitra_pkm' => $this->mitra_pkm,
            'dok_laphasil' => $filename
        ];
        $get = LaporanHasil::find($this->ids)->update($data);
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Data Berhasil Diedit');
        $this->ClearForm();
    
    }


    public function confirmdel($id){
        $prop = LaporanHasil::where('id', $id)->first();
        $this->ids = $prop->id;
        $this->dok_laphasil = $prop->dok_laphasil;
    }

    public function delete()
    {
        unlink(public_path('storage/'.$this->dok_laphasil));
        $del = LaporanHasil::find($this->ids)->delete();
        session()->flash('success', 'Data Berhasil Dihapus');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
