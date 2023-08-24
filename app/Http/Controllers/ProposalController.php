<?php

namespace App\Http\Controllers;

use App\Models\Skim;
use App\Models\Prodi;
use App\Models\Bidang;
use App\Models\Dosens;
use App\Models\Proposals;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    //
    public function detail($id)
    {
        $data = Proposals::find($id);
        echo json_encode($data);
        exit;
    }
    public function show($id)
    {
        // $proposal = Proposals::where('id_proposal', $id)->first();
        $proposal = DB::table('proposals')
        ->leftJoin('bidangs', 'bidangs.id_bidang', 'proposals.id_bidang')
        ->leftJoin('skims', 'skims.id_skim', 'proposals.id_skim')
        ->orderBy('id','desc')
        ->where('id', $id)->first();
        $anggotadosens = DB::table('anggota_dosen_lokals')
        ->leftJoin('dosens', 'dosens.id', 'anggota_dosen_lokals.id_dosen')
        ->where('id_proposal', $id)->get();
        $anggotadosenluars = DB::table('anggota_dosen_luars')
        ->leftJoin('dosen_luars', 'dosen_luars.nidn_dosen_luar', 'anggota_dosen_luars.nidn_dosen_luar')
        ->where('id_proposal', $id)->get();
        $anggotamahasiswas = DB::table('anggota_mahasiswas')
        ->leftJoin('mahasiswas', 'mahasiswas.npm', 'anggota_mahasiswas.npm_mhs')
        ->where('id_proposal', $id)->get();
        
        return view('proposal.detail_proposal', [
            'data' => $proposal,
            'anggotadosens' => $anggotadosens,
            'anggotadosenluars' => $anggotadosenluars,
            'anggotamahasiswas' => $anggotamahasiswas
        ]);
    }
    
    // public function gen_id()
    // {
    //     $temp = DB::table('proposals')->latest()->first();
    //     if($temp == null){
    //         $token_id = 1;
    //     } else if($temp != null){
    //         $token_id = $temp->id + 1;
    //     }
    //     return $token_id;
    // }
    public function generateUniqueCode()
    {
        $code = random_int(100000, 999999);
        $temp = Proposals::where('id', $code)->first();
        if($temp == null){
            return $code;
        } else {
            return $this->generateUniqueCode();
        }
    }

    public function store(Request $request)
    {
        // $data = $request->all();
        // dd($data);
        $validatedData = $request->validate([
            'judul_proposal' => 'required|string|min:10|unique:proposals',
            'id_bidang' => 'required',
            'id_skim' => 'required',
            'lokasi_kegiatan' => 'required|string|min:4',
            'thn_mulai' => 'required|numeric',
            'thn_selesai' => 'required|numeric',
            // 'thn_pelaksanaan' => 'required|numeric',
            'dok_link' => 'required|mimes:docx,pdf|max:5000'
        ]);
        if($validatedData == true)
        {
            $proposal = new Proposals;
            $proposal->judul_proposal = $validatedData['judul_proposal'];
            $proposal->slug = Str::of($validatedData['judul_proposal'])->slug('-');
            $proposal->id_bidang = $validatedData['id_bidang'];
            $proposal->id_skim = $validatedData['id_skim'];
            $proposal->lokasi_kegiatan = $validatedData['lokasi_kegiatan'];
            $proposal->thn_mulai = $validatedData['thn_mulai'];
            $proposal->thn_selesai = $validatedData['thn_selesai'];
            // $proposal->thn_pelaksanaan = $validatedData['thn_pelaksanaan'];
            if($request->file('dok_link')){
                $validatedData['dok_link'] = $request->file('dok_link')->store('berkas-proposal', 'public');
            }
            $proposal->dok_link = $validatedData['dok_link'];
            // dd($proposal);
            $proposal->save();
        }

        return redirect('kelola-anggota/'. $proposal->id);
        // $proposal = new Proposals;
        // $proposal->judul_proposal = $data['judul_proposal'];
        // $proposal->slug = Str::of($data['judul_proposal'])->slug('-');
        // $proposal->id_bidang = $data['id_bidang'];
        // $proposal->id_skim = $data['id_skim'];
        // $proposal->lokasi_kegiatan = $data['lokasi_kegiatan'];
        // $proposal->thn_usulan = $data['thn_usulan'];
        // $proposal->thn_kegiatan = $data['thn_kegiatan'];
        // $proposal->thn_pelaksanaan  = $data['thn_pelaksanaan'];
        // $proposal->save();
        // dd($proposal);
        // $order = Order::create([
        //     'customer_name' => $request->customer_name,
        //     'customer_email' => $request->customer_email,
        // ]);

        // foreach ($request->orderProducts as $product) {
        //     $order->products()->attach($product['product_id'],
        //         ['quantity' => $product['quantity']]);
        // }

        // return 'Order stored successfully!';
    }

    public function form()
    {
        // $code = random_int(100000, 999999);
        // $temp = Proposals::where('id', $code)->first();
        // if($temp == null){
        //     $data = [
        //         'bidangs' => Bidang::all(),
        //         'skims' => Skim::all(),
        //         'prodis' => Prodi::all(),
        //         'dosens' => Dosens::all()
        //     ];
        //     return view('proposal.create', $data);
        // } else {
        //     return $this->form();
        // }

        return view('proposal.form', [
            'bidangs' => DB::table('bidangs')->get(),
            'skims' => DB::table('skims')->get(),
            'dosens' => DB::table('dosens')->get(),
            'prodis' => DB::table('prodis')->get(),
            // 'dosenluars' => DB::table('dosen_luars')->get(),
            // 'mahasiswas' => DB::table('mahasiswas')->get(),
        ]);
    }

    public function tambahanggota($id) {
        return view('proposal.kelola_anggota', [
            'id_proposal' => $id,
            'dosens' => Dosens::all(),
            'dosenluars' => DB::table('dosen_luars')->get(),
            'mahasiswas' => DB::table('mahasiswas')->get(),
            'prodis' => DB::table('prodis')->get(),
        ]);
    }
    

}
