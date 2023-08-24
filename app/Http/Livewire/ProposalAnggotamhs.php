<?php

namespace App\Http\Livewire;

use App\Models\Prodi;
use Livewire\Component;
use App\Models\Proposals;
use App\Models\AnggotaDosenLuar;
use App\Models\AnggotaMahasiswa;
use App\Models\AnggotaDosenLokal;

class ProposalAnggotamhs extends Component
{
    public $params;
    public $id_param;
    public $ids, $nm_mahasiswa, $npm, $id_prodi, $thn_masuk, $peran;
    
    public function mount($params)
    {
        $this->id_param = $params;
    }

    public function render()
    {
        // $proposal = Proposals::where('id', $this->ids)->first();
        return view('livewire.proposal-anggotamhs', [
            'prodis' => Prodi::all(),
            'anggota' => AnggotaMahasiswa::orderBy('id', 'desc')->where('id_proposal', $this->id_param)->get()
        ]);
    }

    public function create()
    {
        $this->validate([
            'npm' => 'required|numeric|min:4|unique:anggota_mahasiswas',
            'nm_mahasiswa' => 'required|string|max:255',
            'id_prodi' => 'required',
            'thn_masuk' => 'required|numeric',
            'peran' => 'required'
        ]);

        $temp1 = AnggotaDosenLokal::where('id_proposal', $this->id_param)->where('peran', 'ketua')->get();
        $temp2 = AnggotaDosenLuar::where('id_proposal', $this->id_param)->where('peran', 'ketua')->get();
        $temp3 = AnggotaMahasiswa::where('id_proposal', $this->id_param)->where('peran', 'ketua')->get();
        $jumlah1 = count($temp1);
        $jumlah2 = count($temp2);
        $jumlah3 = count($temp3);

        // dd($jumlah1, $jumlah2, $jumlah3);

        if($jumlah1 = 0 && $jumlah2 = 0 && $jumlah3 = 0 ){
            AnggotaMahasiswa::create([
                'npm' => $this->npm,
                'nm_mahasiswa' => $this->nm_mahasiswa,
                'id_prodi' => $this->id_prodi,
                'thn_masuk' => $this->thn_masuk,
                'peran' => $this->peran,
                'id_proposal' => $this->id_param
            ]);
            session()->flash('success', 'Data Berhasil Ditambahkan');
        } else {
            if($this->peran == 'ketua'){
                session()->flash('error', 'Peran Ketua Hanya 1 Untuk 1 Judul PKM!');
            } else if($this->peran == 'anggota') {
                AnggotaMahasiswa::create([
                    'npm' => $this->npm,
                    'nm_mahasiswa' => $this->nm_mahasiswa,
                    'id_prodi' => $this->id_prodi,
                    'thn_masuk' => $this->thn_masuk,
                    'peran' => $this->peran,
                    'id_proposal' => $this->id_param
                ]);
                session()->flash('success', 'Data Berhasil Ditambahkan');
            }
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function ClearForm()
    {
        $this->npm = "";
        $this->nm_mahasiswa = "";
        $this->id_prodi = "";
        $this->thn_masuk = "";
        $this->peran = "";
    }
    
    public function detail($id)
    {
        $anggota = AnggotaMahasiswa::where('id', $id)->first();
        $this->npm = $anggota->npm;
        $this->nm_mahasiswa = $anggota->nm_mahasiswa;
        $this->id_prodi = $anggota->id_prodi;
        $this->thn_masuk = $anggota->thn_masuk;
        $this->peran = $anggota->peran;
        $this->ids = $anggota->id;
    }

    public function update()
    {
        $this->validate([
            // 'npm' => 'required|numeric|min:4',
            'nm_mahasiswa' => 'required|string|max:255',
            'id_prodi' => 'required',
            'thn_masuk' => 'required|numeric',
            'peran' => 'required|string'
        ]);

        $temp1 = AnggotaDosenLokal::where('id_proposal', $this->id_param)->where('peran', 'ketua')->get();
        $temp2 = AnggotaDosenLuar::where('id_proposal', $this->id_param)->where('peran', 'ketua')->get();
        $temp3 = AnggotaMahasiswa::where('id_proposal', $this->id_param)->where('peran', 'ketua')->get();
        $jumlah1 = count($temp1);
        $jumlah2 = count($temp2);
        $jumlah3 = count($temp3);

        $anggota = AnggotaMahasiswa::where('id', $this->ids)->first();
        if($this->npm != $anggota->npm){
            $this->validate(['npm' => 'required|numeric|min:4|unique:anggota_mahasiswas']);
        }

        if($this->peran == 'ketua'){
            if($jumlah1 == 0 && $jumlah2 == 0 && $jumlah3 == 0 ){
                $data = [
                    'npm' => $this->npm,
                    'nm_mahasiswa' => $this->nm_mahasiswa,
                    'id_prodi' => $this->id_prodi,
                    'thn_masuk' => $this->thn_masuk,
                    'peran' => $this->peran
                ];
                $get = AnggotaMahasiswa::find($this->ids)->update($data);
                session()->flash('success', 'Data Berhasil Diperbarui!');
            } else {
                session()->flash('error', 'Peran Ketua Hanya 1 Untuk 1 Judul PKM!');
            }
        } else if($this->peran == 'anggota'){
            $data = [
                'npm' => $this->npm,
                'nm_mahasiswa' => $this->nm_mahasiswa,
                'id_prodi' => $this->id_prodi,
                'thn_masuk' => $this->thn_masuk,
                'peran' => $this->peran
            ];
            $get = AnggotaMahasiswa::find($this->ids)->update($data);
            session()->flash('success', 'Data Berhasil Diperbarui!');
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function confirm($id)
    {
        $anggota = AnggotaMahasiswa::where('id', $id)->first();
        $this->ids = $anggota->id;
    }

    public function delete()
    {
        $del = AnggotaMahasiswa::find($this->ids)->delete();
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
