<?php

namespace App\Http\Controllers;

use App\Models\DosenLuar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DosenLuarController extends Controller
{
    //
    public function store(Request $request)
    {
        // Membuat instance validator
        $validator = Validator::make($request->all(), [
            'nidn_dosen_luar' => 'required|numeric|unique:dosen_luars',
            'nm_dosen_luar'  => 'required|max:255',
            'telp_dosen_luar' => 'required|numeric',
            'email_dosen_luar' => 'required|email',
            'fakultas_dosen_luar' => 'required',
            'prodi_dosen_luar' => 'required',
            'universitas_dosen_luar' => 'required'
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan error message
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal Menambahkan Data Dosen Luar! Periksa Kembali Data Yang Diinputkan!');
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
        $fetchData = new DosenLuar;
        $fetchData->nidn_dosen_luar = $request->input('nidn_dosen_luar');
        $fetchData->nm_dosen_luar = $request->input('nm_dosen_luar');
        $fetchData->telp_dosen_luar = $request->input('telp_dosen_luar');
        $fetchData->email_dosen_luar = $request->input('email_dosen_luar');
        $fetchData->fakultas_dosen_luar = $request->input('fakultas_dosen_luar');
        $fetchData->prodi_dosen_luar = $request->input('prodi_dosen_luar');
        $fetchData->universitas_dosen_luar = $request->input('universitas_dosen_luar');
        $fetchData->save();

        return redirect()->back()->with('success', 'Berhasil Menambahkan Data Dosen Luar!');
    }
}
