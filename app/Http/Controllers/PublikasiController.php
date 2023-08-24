<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use App\Models\LaporanHasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PublikasiController extends Controller
{
    //
    public function form(){
        return view('publikasi.form', [
            'laporanhasils' => LaporanHasil::all()
        ]);
    }
    
    public function form2(){
        return view('publikasi.form2', [
            'laporanhasils' => LaporanHasil::all()
        ]);
    }

    public function simpan(Request $request){
        // dd($request->all());
        $rules = [
            'id_laphasil' => 'required|numeric|unique:publikasis',
            'judul_jurnal' => 'required|string|min:5|unique:publikasis',
            'nm_jurnal' => 'required|string',
            'vol_jurnal' => 'required|numeric',
            'no_jurnal' => 'required|numeric',
            'tgl_terbit_jurnal' => 'required',
            'jumlah_penulis' => 'required|numeric',
            'link_jurnal' => 'required|url',
            'status_jurnal' => 'required'
        ];
        
        $validatedData = $request->validate($rules);
        // dd($validatedData);
        Publikasi::create($validatedData);
        return redirect('/'.Auth::user()->username.'/publikasi')->with('success', 'Berhasil Menambahkan Data Publikasi!');

    }

    public function simpan2(Request $request) {
        // dd($request->all());
        $rules = [
            'id_laphasil' => 'required|numeric|unique:publikasis',
            'judul_jurnal' => 'required|string|min:5|unique:publikasis',
            'nm_jurnal' => 'required|string',
            'vol_jurnal' => 'required|numeric',
            'no_jurnal' => 'required|numeric',
            'tgl_terbit_jurnal' => 'required',
            'jumlah_penulis' => 'required|numeric',
            'dok_jurnal' => 'required|mimes:pdf|max:5000',
            'link_jurnal' => 'required|url',
            'status_jurnal' => 'required'
           
        ]; //

        $validatedData = $request->validate($rules);
        $validatedData['dok_jurnal'] = $request->file('dok_jurnal')->store('berkas-publikasi', 'public');

        Publikasi::create($validatedData);
        return redirect('/'.Auth::user()->username.'/publikasi')->with('success', 'Berhasil Menambahkan Data Publikasi!');
    }

    public function detail($id) {
        return view('publikasi.detail',[
            'showDetailPub' => DB::table('publikasis')->leftJoin('laporan_hasils', 'laporan_hasils.id', 'publikasis.id_laphasil')
            ->where('id_publikasi', $id)->first(),
        ]);
    }
}
