<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Publikasi;
use App\Models\LaporanHasil;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class PublikasiTable extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $ids, $id_laphasil, $judul_jurnal, $nm_jurnal, $vol_jurnal, $no_jurnal, $tgl_terbit_jurnal, $jumlah_penulis, $link_jurnal, $status_jurnal, $dok_jurnal;

    public $search="";
    public $result=10;
    protected $paginationTheme = 'bootstrap';
    

    // public function typeResult()
    // {
    //     if(!empty($this->type)){
    //         $this->records = LaporanHasil::orderBy('id', 'asc')
    //         ->select('*')
    //         ->where('judul_pkm','like','%'.$this->type.'%')
    //         ->limit(5)
    //         ->get();
    //         $this->showresult = true;
    //     }else{
    //         $this->showresult = false;
    //     }
    // }

    // // Fetch record by ID
    // public function fetchLaphasilDetail($id = 0){
    //     // dd($id);
        

    //     $record = LaporanHasil::where('id', $id)->first();

    //     $this->type = $record->judul_pkm;
    //     // $this->empDetails = $record;
    //     $this->id_laphasil = $record->id;
    //     $this->showresult = false;
    // }

    // public function mount($id) {
    //     $this->show_detail = Publikasi::where('id', $id)->first();
    // }

    public function render()
    {
        return view('livewire.publikasi-table', [
            'publikasis' => DB::table('publikasis')
            ->leftJoin('laporan_hasils', 'laporan_hasils.id', 'publikasis.id_laphasil')
            ->orderBy('id_publikasi','desc')
            ->where('judul_pkm', 'like', '%'.$this->search.'%')
            ->orWhere('judul_jurnal', 'like', '%'.$this->search.'%')
            ->paginate($this->result),
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function create()
    {
        $this->validate([
            'id_laphasil' => 'required|numeric',
            'judul_jurnal' => 'required|string|min:5|unique:publikasis',
            'nm_jurnal' => 'required|string',
            'vol_jurnal' => 'required|numeric',
            'no_jurnal' => 'required|numeric',
            'tgl_terbit_jurnal' => 'required',
            'jumlah_penulis' => 'required|numeric',
            'link_jurnal' => 'required|url',
            'status_jurnal' => 'required'
        ]);

        Publikasi::create([
            'id_laphasil' => $this->id_laphasil,
            'judul_jurnal' => $this->judul_jurnal,
            'nm_jurnal' => $this->nm_jurnal,
            'vol_jurnal' => $this->vol_jurnal,
            'no_jurnal' => $this->no_jurnal,
            'tgl_terbit_jurnal' => $this->tgl_terbit_jurnal,
            'jumlah_penulis' => $this->jumlah_penulis,
            'link_jurnal' => $this->link_jurnal,
            'status_jurnal' => $this->status_jurnal
           
        ]);
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Berhasil Menambahkan Data Publikasi!');
        $this->ClearForm();
    }

    public function ClearForm()
    {
        $this->judul_jurnal = Null;
        $this->id_laphasil = Null;
        $this->nm_jurnal = Null;
        $this->no_jurnal = Null;
        $this->vol_jurnal = Null;
        $this->tgl_terbit_jurnal = Null;
        $this->jumlah_penulis = Null;
        $this->link_jurnal = Null;
        $this->status_jurnal = Null;
        // $this->type = Null;
    }

    public function detail($id)
    {
        // $this->mount($id);
        $publikasi = Publikasi::where('id_publikasi', $id)->first();
        $lap = LaporanHasil::where('id', $publikasi->id_laphasil)->first();
        $this->ids = $publikasi->id_publikasi;
        $this->id_laphasil = $publikasi->id_laphasil;
        // $this->type = $lap->judul_pkm;
        $this->judul_jurnal = $publikasi->judul_jurnal;
        $this->nm_jurnal = $publikasi->nm_jurnal;
        $this->no_jurnal = $publikasi->no_jurnal;
        $this->vol_jurnal = $publikasi->vol_jurnal;
        $this->tgl_terbit_jurnal = $publikasi->tgl_terbit_jurnal;
        $this->jumlah_penulis = $publikasi->jumlah_penulis;
        $this->link_jurnal = $publikasi->link_jurnal;
        $this->dok_jurnal = $publikasi->dok_jurnal;
        $this->status_jurnal = $publikasi->status_jurnal;
    }

    // public function test($id) {
    //     $publikasi = Publikasi::where('id_publikasi', $id)->first();
    //     dd($publikasi);
    // }

    public function update()
    {
        /*
            ** Cara Kedua
        */
        $this->validate([
            'nm_jurnal' => 'required|string',
            'vol_jurnal' => 'required|numeric',
            'no_jurnal' => 'required|numeric',
            'tgl_terbit_jurnal' => 'required',
            'jumlah_penulis' => 'required|numeric',
            'link_jurnal' => 'required|url|unique:publikasis',
            'status_jurnal' => 'required'
        ]);

        $publikasi = Publikasi::where('id_publikasi', $this->ids)->first();
        if($this->judul_jurnal != $publikasi->judul_jurnal){
            $this->validate(['judul_jurnal' => 'required|string|min:5|unique:publikasis']);
        }

        if($this->dok_jurnal != $publikasi->dok_jurnal){
            $this->validate(['dok_jurnal' => 'required|mimes:pdf|max:5000']);
            unlink(public_path('storage/'.$publikasi->dok_jurnal));
            $filename = $this->dok_jurnal->store('berkas-publikasi', 'public');
        } else if($this->dok_jurnal == $publikasi->dok_jurnal){
            $filename = $this->dok_jurnal;
        }
        // dd($filename);
        $data = [
            'id_laphasil' => $this->id_laphasil,
            'judul_jurnal' => $this->judul_jurnal,
            'nm_jurnal' => $this->nm_jurnal,
            'vol_jurnal' => $this->vol_jurnal,
            'no_jurnal' => $this->no_jurnal,
            'tgl_terbit_jurnal' => $this->tgl_terbit_jurnal,
            'jumlah_penulis' => $this->jumlah_penulis,
            'dok_jurnal' => $filename,
            'link_jurnal' => $this->link_jurnal,
            'status_jurnal' => $this->status_jurnal
        ];
        $get = Publikasi::find($this->ids)->update($data);
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('success', 'Data Berhasil Diedit');
        $this->ClearForm();
        

        /*
            ** Cara Pertama
        */


        // $this->validate([
        //     // 'id_laphasil' => 'required|numeric',
        //     // 'judul_jurnal' => 'required|string|min:5|unique:publikasis',
        //     'nm_jurnal' => 'required|string',
        //     'vol_jurnal' => 'required|numeric',
        //     'no_jurnal' => 'required|numeric',
        //     'tgl_terbit_jurnal' => 'required',
        //     'jumlah_penulis' => 'required|numeric',
        //     // 'link_jurnal' => 'required|url|unique:publikasis',
        //     'status_jurnal' => 'required'
        // ]);

        // $publikasi = Publikasi::where('id_publikasi', $this->ids)->first();
        // if($this->judul_jurnal != $publikasi->judul_jurnal){
        //     $this->validate(['judul_jurnal' => 'required|string|min:5|unique:publikasis']);
        // }

        // if($this->id_laphasil != $publikasi->id_laphasil){
        //     $this->validate(['id_laphasil' => 'required|numeric|unique:publikasis']);
        // }

        // if($this->link_jurnal != $publikasi->link_jurnal){
        //     $this->validate(['link_jurnal' => 'required|url|unique:publikasis']);
        // }

        // $data = [
        //     'id_laphasil' => $this->id_laphasil,
        //     'judul_jurnal' => $this->judul_jurnal,
        //     'nm_jurnal' => $this->nm_jurnal,
        //     'vol_jurnal' => $this->vol_jurnal,
        //     'no_jurnal' => $this->no_jurnal,
        //     'tgl_terbit_jurnal' => $this->tgl_terbit_jurnal,
        //     'jumlah_penulis' => $this->jumlah_penulis,
        //     'link_jurnal' => $this->link_jurnal,
        //     'status_jurnal' => $this->status_jurnal
        // ];
        // $get = Publikasi::find($this->ids)->update($data);
        // $this->dispatchBrowserEvent('closeModal');
        // session()->flash('success', 'Data Berhasil Diedit');
        // $this->ClearForm();
    
    }

}
