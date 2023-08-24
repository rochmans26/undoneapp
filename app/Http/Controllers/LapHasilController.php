<?php

namespace App\Http\Controllers;

use App\Models\Skim;
use App\Models\Bidang;
use App\Models\Proposals;
use App\Models\LaporanHasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LapHasilController extends Controller
{
    //
    public function show($id)
    {

        // $proposal = Proposals::where('id_proposal', $id)->first();
        $laphasil = DB::table('laporan_hasils')
        ->leftJoin('bidangs', 'bidangs.id_bidang', 'laporan_hasils.id_bidang')
        ->leftJoin('skims', 'skims.id_skim', 'laporan_hasils.id_skim')
        ->orderBy('id','desc')
        ->where('id', $id)->first();
        $proposal = DB::table('proposals')
        ->leftJoin('bidangs', 'bidangs.id_bidang', 'proposals.id_bidang')
        ->leftJoin('skims', 'skims.id_skim', 'proposals.id_skim')
        ->orderBy('id','desc')
        ->where('id', $laphasil->id)->first();
        $dikti = 0;
        $unla = 0;
        $lainnya = 0;
        $total = 0;
        $dikti = $laphasil->dana_dikti;
        $unla = $laphasil->dana_unla;
        $lainnya = $laphasil->dana_lainnya;
        $total = $dikti + $unla + $lainnya;

        $anggotadosens = DB::table('anggota_dosen_lokals')
        ->leftJoin('dosens', 'dosens.id', 'anggota_dosen_lokals.id_dosen')
        ->where('id_proposal', $id)->get();
        $anggotadosenluars = DB::table('anggota_dosen_luars')
        ->leftJoin('dosen_luars', 'dosen_luars.nidn_dosen_luar', 'anggota_dosen_luars.nidn_dosen_luar')
        ->where('id_proposal', $id)->get();
        $anggotamahasiswas = DB::table('anggota_mahasiswas')
        ->leftJoin('mahasiswas', 'mahasiswas.npm', 'anggota_mahasiswas.npm_mhs')
        ->where('id_proposal', $id)->get();
        
        return view('laphasil.detail_laphasil', [
            'data' => $laphasil,
            'proposal' => $proposal,
            'total' => $total,
            'anggotadosens' => $anggotadosens,
            'anggotadosenluars' => $anggotadosenluars,
            'anggotamahasiswas' => $anggotamahasiswas
        ]);
    }

    public function form() {
        return view('laphasil.form', [
            'proposals' => Proposals::all(),
            'bidangs' => Bidang::all(),
            'skims' => Skim::all(),
        ]);
    }

    public function store(Request $request) {
        $rules = [
            'id' => 'required|unique:laporan_hasils',
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
            'dok_laphasil' => 'required|mimes:pdf|max:5000',
        ];
        if($request->dana_dikti != null){
            $rules['dana_dikti'] = 'required|numeric';
        }
        if($request->dana_unla != null){
            $rules['dana_unla'] = 'required|numeric';
        }
        if($request->dana_lainnya != null){
            $rules['dana_lainnya'] = 'required|numeric';
        }
        $validatedData = $request->validate($rules);
        
        $validatedData['dok_laphasil'] = $request->file('dok_laphasil')->store('berkas-laphasil', 'public');
        // dd($validatedData);
        LaporanHasil::create($validatedData);
        return redirect('/'. Auth::user()->level.'/laporan-hasil')->with('success', 'Berhasil Menambahkan Data!');
        // dd($validatedData);
        // dd($request->all());
    }
}
