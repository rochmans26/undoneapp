<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaDosenLuar;
use App\Models\AnggotaMahasiswa;
use App\Models\AnggotaDosenLokal;

class AnggotaMahasiswaController extends Controller
{
    //
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'npm_mhs' => 'required',
            'id_proposal' => 'required',
            'peran' => 'required'
        ]);
        $temp1 = AnggotaDosenLokal::where('id_proposal', $request->id_proposal)->where('peran', 'ketua')->get();
        $temp2 = AnggotaDosenLuar::where('id_proposal', $request->id_proposal)->where('peran', 'ketua')->get();
        $temp3 = AnggotaMahasiswa::where('id_proposal', $request->id_proposal)->where('peran', 'ketua')->get();
        $jumlah1 = count($temp1);
        $jumlah2 = count($temp2);
        $jumlah3 = count($temp3);
    
        $cek_anggota = AnggotaMahasiswa::where('npm_mhs', $request->npm_mhs)->where('id_proposal', $request->id_proposal)->get();
        $cek_anggota2 = AnggotaMahasiswa::where('id_proposal', $request->id_proposal)->get();
        if($request->peran == 'ketua'){
            if($jumlah1 == 0 && $jumlah2 == 0 && $jumlah3 == 0 ){
                    if(count($cek_anggota) != 0){
                        $request->session()->flash('error', 'Mahasiswa telah terdaftar sebagai anggota proposal ini!');
                    } else {
                        if(count($cek_anggota2) == 2)
                        {
                            $request->session()->flash('error', 'Anggota Mahasiswa telah terpenuhi!');
                        } else {
                            
                            AnggotaMahasiswa::create([
                                'npm_mhs' => $validatedData['npm_mhs'],
                                'id_proposal' => $validatedData['id_proposal'],
                                'peran' => $validatedData['peran']
                            ]);
                            $request->session()->flash('success', 'Data Berhasil Ditambahkan');
                        }
                    }
                    
                } else {
                    $request->session()->flash('error', 'Peran Ketua Hanya 1 Untuk 1 Judul PKM!');
                }
        } else if($request->peran == 'anggota') {
            if(count($cek_anggota) != 0){
                $request->session()->flash('error', 'Mahasiswa telah terdaftar sebagai anggota proposal ini!');
            } else{
                if(count($cek_anggota2) == 2)
                {
                    $request->session()->flash('error', 'Anggota Mahasiswa telah terpenuhi!');
                } else {
                    AnggotaMahasiswa::create([
                        'npm_mhs' => $validatedData['npm_mhs'],
                        'id_proposal' => $validatedData['id_proposal'],
                        'peran' => $validatedData['peran']
                    ]);
                    $request->session()->flash('success', 'Data Berhasil Ditambahkan');
                }
            }
        }
        return redirect()->back();
    }
}
