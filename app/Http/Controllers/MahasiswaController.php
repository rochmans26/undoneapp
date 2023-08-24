<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    //
    public function store(Request $request)
    {
        // Membuat instance validator
        $validator = Validator::make($request->all(), [
            'npm' => 'required|numeric|min:4|unique:mahasiswas',
            'nm_mahasiswa' => 'required|string|max:255',
            'id_prodi' => 'required',
            'thn_masuk' => 'required|numeric',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan error message
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal Menambahkan Data Mahasiswa! Pastikan Isian Data Tidak Kosong dan Benar!');
        }
        // $validatedData = $request->validate([
        //     'nidn' => 'required|numeric|unique:dosens',
        //     'nm_dosen'  => 'required|max:255',
        //     'alamat_dosen' => 'required',
        //     'jafung' => 'required',
        //     'telp' => 'required|numeric',
        //     'email' => 'required|email',
        //     'id_prodi' => 'required'
        // ]);
        $fetchData = new Mahasiswas;
        $fetchData->npm = $request->input('npm');
        $fetchData->nm_mahasiswa = $request->input('nm_mahasiswa');
        $fetchData->id_prodi = $request->input('id_prodi');
        $fetchData->thn_masuk = $request->input('thn_masuk');
        $fetchData->save();

        return redirect()->back()->with('success', 'Berhasil Menambahkan Data Mahasiswa!');

    }
}
