<?php

namespace App\Http\Controllers;

use App\Models\LaporanHasil;
use App\Models\SeminarHasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeminarHasilController extends Controller
{
    //
    public function index(){
        return view('seminarhasil.index');
    }

    public function form() {
        $laphasil = LaporanHasil::where('id_semhas', null)->get();
        return view('seminarhasil.form', [
            'laphasil' => $laphasil
        ]);
    }

    public function store(Request $request) {
        // dd($request->all());
        $rules = [
            'id_laphasil' => 'required',
            'tgl_semhas' => 'required',
            'jam_semhas' => 'required',
            'sifat_semhas' => 'required',
            // 'tmpt_seminar' => 'required|string|min:4',
            // 'tautan' => 'required|url|',
            'rev1_semhas' => 'required|string',
            'rev2_semhas' => 'required|string'
        ]; //

        if($request->sifat_semhas == 'luring'){
            $rules['tmpt_semhas'] = 'required|string|min:4';
        } else if($request->sifat_semhas == 'daring'){
            $rules['tautan_semhas'] = 'required|url';
        }

        $validatedData = $request->validate($rules);

        if($validatedData == true){
            $fetch = new SeminarHasil;
            $fetch->id_laphasil = $validatedData['id_laphasil'];
            $fetch->tgl_semhas = $validatedData['tgl_semhas'];
            $fetch->jam_semhas = $validatedData['jam_semhas'];
            $fetch->sifat_semhas = $validatedData['sifat_semhas'];
            $fetch->tmpt_semhas = $request->tmpt_semhas;
            $fetch->tautan_semhas = $request->tautan_semhas;
            $fetch->rev1_semhas = $validatedData['rev1_semhas'];
            $fetch->rev2_semhas = $validatedData['rev2_semhas'];
            // dd($fetch);
            
            $fetch->save();
            // $param = SeminarProposals::where('id_proposal', $this->id_proposal)->first();
            LaporanHasil::where('id', $fetch->id_laphasil)->update(['id_semhas' => $fetch->id_semhas]);
            return redirect('/'.Auth::user()->username.'/laporan-hasil/seminar')->with('success', 'Berhasil Menambahkan Jadwal Seminar!');
        } 
    }

    public function edit($id) {
        $semhas = SeminarHasil::where('id_semhas', $id)->first();
        $find = LaporanHasil::where('id', $semhas->id_laphasil)->first();
        return view('seminarhasil.edit', [
            'semhas' => $semhas,
            'judul' => $find,
        ]);
    }

    public function update(Request $request, $id) {
        $rules = [
            'tgl_semhas' => 'required',
            'jam_semhas' => 'required',
            'sifat_semhas' => 'required',
            // 'tmpt_seminar' => 'required|string|min:4',
            // 'tautan' => 'required|url|',
            'rev1_semhas' => 'required|string',
            'rev2_semhas' => 'required|string'
        ]; //

        if($request->sifat_semhas == 'luring'){
            $rules['tmpt_semhas'] = 'required|string|min:4';
        } else if($request->sifat_semhas == 'daring'){
            $rules['tautan_semhas'] = 'required|url';
        }

        $validatedData = $request->validate($rules);

        if($validatedData == true){
            $fetch = SeminarHasil::find($id);
            $fetch->tgl_semhas = $validatedData['tgl_semhas'];
            $fetch->jam_semhas = $validatedData['jam_semhas'];
            $fetch->sifat_semhas = $validatedData['sifat_semhas'];
            $fetch->tmpt_semhas = $request->tmpt_semhas;
            $fetch->tautan_semhas = $request->tautan_semhas;
            $fetch->rev1_semhas = $validatedData['rev1_semhas'];
            $fetch->rev2_semhas = $validatedData['rev2_semhas'];
            // dd($fetch);
            
            $fetch->save();
            return redirect('/'. Auth::user()->username.'/laporan-hasil/seminar')->with('success', 'Berhasil Mengubah Data!');
            // $param = SeminarProposals::where('id_proposal', $this->id_proposal)->first();
            // Proposals::where('id', $fetch->id_proposal)->update(['id_sempro' => $fetch->id_sempro]);
        } 
    }
}
