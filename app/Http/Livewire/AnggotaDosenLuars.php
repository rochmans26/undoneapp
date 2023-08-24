<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AnggotaDosenLuar;
use App\Models\AnggotaMahasiswa;
use App\Models\AnggotaDosenLokal;

class AnggotaDosenLuars extends Component
{
    public $params;
    public $id_param;
    public $ids, $peran, $id_proposal, $nidn_dosen_luar;

    public function mount($params)
    {
        $this->id_param = $params;
    }

    public function render()
    {
        return view('livewire.anggota-dosen-luars', [
            'anggotas' => AnggotaDosenLuar::orderBy('id', 'desc')->where('id_proposal', $this->id_param)->get(),
            // 'dosens' => Dosens::all(),
            // 'prodis' => Prodi::all(), 
        ]);
    }

    public function detail($id)
    {
        $temp = AnggotaDosenLuar::where('id', $id)->first();
        $this->ids = $id;
        $this->peran = $temp->peran;
        $this->id_proposal = $temp->id_proposal;
        $this->nidn_dosen_luar = $temp->nidn_dosen_luar;
    }


    public function update()
    {
        // $data = [
        //     "peran" => $this->peran
        // ];
        // dd($data);
        $temp1 = AnggotaDosenLokal::where('id_proposal', $this->id_proposal)->where('peran', 'ketua')->get();
        $temp2 = AnggotaDosenLuar::where('id_proposal', $this->id_proposal)->where('peran', 'ketua')->get();
        $temp3 = AnggotaMahasiswa::where('id_proposal', $this->id_proposal)->where('peran', 'ketua')->get();
        $jumlah1 = count($temp1);
        $jumlah2 = count($temp2);
        $jumlah3 = count($temp3);

        $cek_anggota1 = AnggotaDosenLuar::where('nidn_dosen_luar', $this->nidn_dosen_luar)->where('peran', 'ketua')->get();
        $cek_anggota2 = AnggotaDosenLuar::where('nidn_dosen_luar', $this->nidn_dosen_luar)->where('peran', 'anggota')->get();

        // $cek_anggota = AnggotaDosenLokal::where('id_dosen', $this->ids)->where('id_proposal', $this->id_proposal)->get();
        // $cek_anggota2 = AnggotaDosenLokal::where('id_proposal', $this->id_proposal)->get();
        if($this->peran == 'ketua'){
            if($jumlah1 == 0 && $jumlah2 == 0 && $jumlah3 == 0 ){
                    if(count($cek_anggota1) > 1){
                        session()->flash('err_dosluar', 'Dosen tidak boleh menjadi ketua lebih dari satu Judul PKM!');
                    } else {
                        $data = [
                            'peran' => $this->peran
                        ];
                        AnggotaDosenLuar::find($this->ids)->update($data);
                        session()->flash('suc_dosluar', 'Data Berhasil Diperbarui!');
                    }  
                } else {
                    session()->flash('err_dosluar', 'Peran Ketua Hanya 1 Untuk 1 Judul PKM!');
                }
        } else if($this->peran == 'anggota') {
            if(count($cek_anggota2) > 2){
                session()->flash('err_dosluar', 'Dosen tidak boleh terdaftar sebagai anggota lebih dari 2 Judul PKM!');
            } else {
                $data = [
                    'peran' => $this->peran
                ];
                AnggotaDosenLuar::find($this->ids)->update($data);
                session()->flash('suc_dosluar', 'Data Berhasil Diperbarui!');
            }
        }
    }

    public function delete()
    {
        $del = AnggotaDosenLuar::find($this->ids)->delete();
        session()->flash('suc_dosluar', 'Data Berhasil Dihapus!');
        // $this->emit('delete_dosen');
    }
}
