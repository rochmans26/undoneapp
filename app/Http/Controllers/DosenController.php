<?php

namespace App\Http\Controllers;

use App\Models\Dosens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    //
    public function get_data(Request $request)
    {
        $dosen = [];
        if($request->has('q')){
            $search = $request->q;
            $movies = Dosens::select('*')
            		->where('nidn', 'like', '%'.$search.'%')
            		->get();
        }
        return response()->json($dosen);
    }

    public function store(Request $request)
    {
        // Membuat instance validator
        $validator = Validator::make($request->all(), [
            'nidn' => 'required|numeric|unique:dosens',
            'nm_dosen'  => 'required|max:255',
            'alamat_dosen' => 'required',
            'jafung' => 'required',
            'telp' => 'required|numeric',
            'email' => 'required|email',
            'id_prodi' => 'required'
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan error message
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal Menambahkan Data Dosen! Periksa Kembali Data Yang Diinputkan!');
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
        $fetchData = new Dosens;
        $fetchData->nidn = $request->input('nidn');
        $fetchData->nm_dosen = $request->input('nm_dosen');
        $fetchData->alamat_dosen = $request->input('alamat_dosen');
        $fetchData->jafung = $request->input('jafung');
        $fetchData->telp = $request->input('telp');
        $fetchData->email = $request->input('email');
        $fetchData->id_prodi = $request->input('id_prodi');
        $fetchData->save();

        return redirect()->back()->with('success', 'Berhasil Menambahkan Data Dosen!');

    }
}
