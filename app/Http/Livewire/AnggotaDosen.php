<?php

namespace App\Http\Livewire;

use App\Models\Prodi;
use App\Models\Dosens;
use Livewire\Component;
use App\Models\AnggotaDosenLuar;
use App\Models\AnggotaMahasiswa;
use App\Models\AnggotaDosenLokal;

class AnggotaDosen extends Component
{
    public $params;
    public $id_param;
    public $ids, $peran, $id_proposal, $id_dosen;

    protected $listeners = [
        'delete_dosen' => 'render'
    ];

    public function mount($params)
    {
        $this->id_param = $params;
    }

    public function render()
    {
        return view('livewire.anggota-dosen', [
            'anggota' => AnggotaDosenLokal::orderBy('id', 'desc')->where('id_proposal', $this->id_param)->get(),
            'dosens' => Dosens::all(),
            'prodis' => Prodi::all(), 
        ]);
    }

    public function detail($id)
    {
        $temp = AnggotaDosenLokal::where('id', $id)->first();
        $this->ids = $id;
        $this->peran = $temp->peran;
        $this->id_proposal = $temp->id_proposal;
        $this->id_dosen = $temp->id_dosen;
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

        $cek_anggota1 = AnggotaDosenLokal::where('id_dosen', $this->id_dosen)->where('peran', 'ketua')->get();
        $cek_anggota2 = AnggotaDosenLokal::where('id_dosen', $this->id_dosen)->where('peran', 'anggota')->get();

        // $cek_anggota = AnggotaDosenLokal::where('id_dosen', $this->ids)->where('id_proposal', $this->id_proposal)->get();
        // $cek_anggota2 = AnggotaDosenLokal::where('id_proposal', $this->id_proposal)->get();
        if($this->peran == 'ketua'){
            if($jumlah1 == 0 && $jumlah2 == 0 && $jumlah3 == 0 ){
                    if(count($cek_anggota1) > 1){
                        session()->flash('err_doslok', 'Dosen tidak boleh menjadi ketua lebih dari satu Judul PKM!');
                    } else {
                        $data = [
                            'peran' => $this->peran
                        ];
                        AnggotaDosenLokal::find($this->ids)->update($data);
                        session()->flash('suc_doslok', 'Data Berhasil Diperbarui!');
                    }  
                } else {
                    session()->flash('err_doslok', 'Peran Ketua Hanya 1 Untuk 1 Judul PKM!');
                }
        } else if($this->peran == 'anggota') {
            if(count($cek_anggota2) > 2){
                session()->flash('err_doslok', 'Dosen tidak boleh terdaftar sebagai anggota lebih dari 2 Judul PKM!');
            } else {
                $data = [
                    'peran' => $this->peran
                ];
                AnggotaDosenLokal::find($this->ids)->update($data);
                session()->flash('suc_doslok', 'Data Berhasil Diperbarui!');
            }
        }
    }

    public function delete()
    {
        $del = AnggotaDosenLokal::find($this->ids)->delete();
        session()->flash('suc_doslok', 'Data Berhasil Dihapus!');
        // $this->emit('delete_dosen');
    }
}
