<?php

namespace App\Http\Controllers;

use App\Models\Proposals;
use Illuminate\Http\Request;
use App\Models\SeminarProposals;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SemproController extends Controller
{
    //
    public function index(){
        return view('sempro.index');
    }
    public function form(){
        $proposals = Proposals::where('id_sempro', null)->get();
        return view('sempro.create', [
            'proposals' => $proposals
        ]);
    }
    public function create(Request $request){
        // dd($request->all());
        $rules = [
            'id_proposal' => 'required',
            'tgl_seminar' => 'required',
            'jam_seminar' => 'required',
            'sifat_seminar' => 'required',
            // 'tmpt_seminar' => 'required|string|min:4',
            // 'tautan' => 'required|url|',
            'reviewer1' => 'required|string',
            'reviewer2' => 'required|string'
        ]; //

        if($request->sifat_seminar == 'luring'){
            $rules['tmpt_seminar'] = 'required|string|min:4';
        } else if($request->sifat_seminar == 'daring'){
            $rules['tautan'] = 'required|url';
        }

        $validatedData = $request->validate($rules);

        if($validatedData == true){
            $fetch = new SeminarProposals;
            $fetch->id_proposal = $validatedData['id_proposal'];
            $fetch->tgl_seminar = $validatedData['tgl_seminar'];
            $fetch->jam_seminar = $validatedData['jam_seminar'];
            $fetch->sifat_seminar = $validatedData['sifat_seminar'];
            $fetch->tmpt_seminar = $request->tmpt_seminar;
            $fetch->tautan = $request->tautan;
            $fetch->reviewer1 = $validatedData['reviewer1'];
            $fetch->reviewer2 = $validatedData['reviewer2'];
            // dd($fetch);
            
            $fetch->save();
            // $param = SeminarProposals::where('id_proposal', $this->id_proposal)->first();
            Proposals::where('id', $fetch->id_proposal)->update(['id_sempro' => $fetch->id_sempro]);
            return redirect('/'. Auth::user()->level.'/proposals/seminar')->with('success', 'Berhasil Menambahkan Data!');
        } 
    }

    public function edit($id)
    {
        $sempro = SeminarProposals::where('id_sempro', $id)->first();
        $find = Proposals::where('id', $sempro->id_proposal)->first();
        return view('sempro.edit', [
            'sempro' => $sempro,
            'judul' => $find,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $rules = [
            'tgl_seminar' => 'required',
            'jam_seminar' => 'required',
            'sifat_seminar' => 'required',
            // 'tmpt_seminar' => 'required|string|min:4',
            // 'tautan' => 'required|url|',
            'reviewer1' => 'required|string',
            'reviewer2' => 'required|string'
        ]; //

        if($request->sifat_seminar == 'luring'){
            $rules['tmpt_seminar'] = 'required|string|min:4';
        } else if($request->sifat_seminar == 'daring'){
            $rules['tautan'] = 'required|url';
        }

        $validatedData = $request->validate($rules);

        if($validatedData == true){
            $fetch = SeminarProposals::find($id);
            $fetch->tgl_seminar = $validatedData['tgl_seminar'];
            $fetch->jam_seminar = $validatedData['jam_seminar'];
            $fetch->sifat_seminar = $validatedData['sifat_seminar'];
            $fetch->tmpt_seminar = $request->tmpt_seminar;
            $fetch->tautan = $request->tautan;
            $fetch->reviewer1 = $validatedData['reviewer1'];
            $fetch->reviewer2 = $validatedData['reviewer2'];
            // dd($fetch);
            
            $fetch->save();
            return redirect('/'. Auth::user()->username.'/proposals/seminar')->with('success', 'Berhasil Mengubah Data!');
            // $param = SeminarProposals::where('id_proposal', $this->id_proposal)->first();
            // Proposals::where('id', $fetch->id_proposal)->update(['id_sempro' => $fetch->id_sempro]);
        } 
    }
}
