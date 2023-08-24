<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AnggotaDosenLuar;
use App\Models\AnggotaMahasiswa;
use App\Models\AnggotaDosenLokal;

class AnggotaMahasiswas extends Component
{
    public $params;
    public $id_param;

    public function mount($params)
    {
        $this->id_param = $params;
    }

    public function render()
    {
        return view('livewire.anggota-mahasiswas', [
            'anggota' => AnggotaMahasiswa::orderBy('id', 'desc')->where('id_proposal', $this->id_param)->get()
        ]);
    }

    // public function detail($id)
    // {
    //     $temp = AnggotaMahasiswa::where('id', $id)->first();
    //     $this->ids = $id;
    //     $this->peran = $temp->peran;
    //     $this->id_proposal = $temp->id_proposal;
    //     $this->npm_mhs = $temp->npm_mhs;
    // }


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

        $cek_anggota1 = AnggotaMahasiswa::where('npm_mhs', $this->npm_mhs)->where('peran', 'ketua')->get();
        $cek_anggota2 = AnggotaMahasiswa::where('npm_mhs', $this->npm_mhs)->where('peran', 'anggota')->get();

        // $cek_anggota = AnggotaDosenLokal::where('id_dosen', $this->ids)->where('id_proposal', $this->id_proposal)->get();
        // $cek_anggota2 = AnggotaDosenLokal::where('id_proposal', $this->id_proposal)->get();
        if($this->peran == 'ketua'){
            if($jumlah1 == 0 && $jumlah2 == 0 && $jumlah3 == 0 ){
                    if(count($cek_anggota1) > 1){
                        session()->flash('err_mhs', 'Dosen tidak boleh menjadi ketua lebih dari satu Judul PKM!');
                    } else {
                        $data = [
                            'peran' => $this->peran
                        ];
                        AnggotaMahasiswa::find($this->ids)->update($data);
                        session()->flash('suc_mhs', 'Data Berhasil Diperbarui!');
                    }  
                } else {
                    session()->flash('err_mhs', 'Peran Ketua Hanya 1 Untuk 1 Judul PKM!');
                }
        } else if($this->peran == 'anggota') {
            if(count($cek_anggota2) > 2){
                session()->flash('err_mhs', 'Dosen tidak boleh terdaftar sebagai anggota lebih dari 2 Judul PKM!');
            } else {
                $data = [
                    'peran' => $this->peran
                ];
                AnggotaMahasiswa::find($this->ids)->update($data);
                session()->flash('suc_mhs', 'Data Berhasil Diperbarui!');
            }
        }
    }

    public function delete()
    {
        $del = AnggotaMahasiswa::find($this->ids)->delete();
        session()->flash('suc_mhs', 'Data Berhasil Dihapus!');
        // $this->emit('delete_dosen');
    }
}
