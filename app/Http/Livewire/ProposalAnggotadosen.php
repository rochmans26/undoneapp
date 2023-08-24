<?php

namespace App\Http\Livewire;

use App\Models\Dosens;
use Livewire\Component;
use App\Models\AnggotaDosenLuar;
use App\Models\AnggotaMahasiswa;
use App\Models\AnggotaDosenLokal;

class ProposalAnggotadosen extends Component
{
    public $params;
    public $id_param;
    public $ids, $id_dosen, $peran;

    public $showresult = false;
    public $search = "";
    public $records;
    // public $empDetails;

    // Fetch records
    public function searchResult()
    {
        if(!empty($this->search)){
            $this->records = Dosens::orderby('id','asc')
                      ->select('*')
                      ->where('nm_dosen','like','%'.$this->search.'%')
                      ->orWhere('nidn','like','%'.$this->search.'%')
                      ->limit(5)
                      ->get();
            $this->showresult = true;
        }else{
            $this->showresult = false;
        }
    }

    // Fetch record by ID
    public function fetchDosenDetail($id){

        $record = Dosens::select('*')
                    ->where('id',$id)
                    ->first();

        $this->search = $record->nm_dosen;
        // $this->empDetails = $record;
        $this->id_dosen = $record->id;
        $this->showresult = false;
    }

    public function mount($params)
    {
        $this->id_param = $params;
    }

    public function render()
    {
        return view('livewire.proposal-anggotadosen',[
            'anggota' => AnggotaDosenLokal::orderBy('id', 'desc')->where('id_proposal', $this->id_param)->get()
        ]);
    }

    public function create()
    {
        $this->validate([
            'id_dosen' => 'required',
            'peran' => 'required|string'
        ]);
        $temp1 = AnggotaDosenLokal::where('id_proposal', $this->id_param)->where('peran', 'ketua')->get();
        $temp2 = AnggotaDosenLuar::where('id_proposal', $this->id_param)->where('peran', 'ketua')->get();
        $temp3 = AnggotaMahasiswa::where('id_proposal', $this->id_param)->where('peran', 'ketua')->get();
        $jumlah1 = count($temp1);
        $jumlah2 = count($temp2);
        $jumlah3 = count($temp3);

        // dd($jumlah1, $jumlah2, $jumlah3);

        if($jumlah1 = 0 && $jumlah2 = 0 && $jumlah3 = 0 ){
            AnggotaDosenLokal::create([
                'id_dosen' => $this->id_dosen,
                'id_proposal' => $this->id_param,
                'peran' => $this->peran
            ]);
            session()->flash('success', 'Data Berhasil Ditambahkan');
        } else {
            if($this->peran == 'ketua'){
                session()->flash('error', 'Peran Ketua Hanya 1 Untuk 1 Judul PKM!');
            } else if($this->peran == 'anggota') {
                AnggotaDosenLokal::create([
                    'id_dosen' => $this->id_dosen,
                    'id_proposal' => $this->id_param,
                    'peran' => $this->peran
                ]);
                session()->flash('success', 'Data Berhasil Ditambahkan');
            }
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();

    }

    public function ClearForm()
    {
        $this->search = "";
        $this->showresult = false;
        $this->records = Null;
        $this->peran = "";
    }

    public function detail($id)
    {
        $anggota = AnggotaDosenLokal::where('id', $id)->first();
        $dosen = Dosens::where('id', $anggota->id_dosen)->first();
        $this->search = $dosen->nm_dosen;
        $this->id_dosen = $anggota->dosen;
        $this->ids = $anggota->id;
        $this->peran = $anggota->peran;
    }

    public function update()
    {
        $this->validate([
            'peran' => 'required|string'
        ]);

        $temp1 = AnggotaDosenLokal::where('id_proposal', $this->id_param)->where('peran', 'ketua')->get();
        $temp2 = AnggotaDosenLuar::where('id_proposal', $this->id_param)->where('peran', 'ketua')->get();
        $temp3 = AnggotaMahasiswa::where('id_proposal', $this->id_param)->where('peran', 'ketua')->get();
        $jumlah1 = count($temp1);
        $jumlah2 = count($temp2);
        $jumlah3 = count($temp3);
        

        if($this->peran == 'ketua'){
            if($jumlah1 == 0 && $jumlah2 == 0 && $jumlah3 == 0 ){
                $data = [
                    'peran' => $this->peran
                ];
                AnggotaDosenLokal::find($this->ids)->update($data);
                session()->flash('success', 'Data Berhasil Diperbarui!');
            } else {
                session()->flash('error', 'Peran Ketua Hanya 1 Untuk 1 Judul PKM!');
            }
        } else if($this->peran == 'anggota'){
            $data = [
                'peran' => $this->peran
            ];
            AnggotaDosenLokal::find($this->ids)->update($data);
            session()->flash('success', 'Data Berhasil Diperbarui!');
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();

        // $anggota = AnggotaDosenLokal::where('id', $this->ids)->first();
        // $dosen = Dosens::where('id', $anggota->id_dosen)->first();
        // if($this->id_dosen != $anggota->id_dosen || $this->search != $dosen->nm_dosen){
        //     $this->validate(['id_dosen' => 'required|unique:anggota_dosen_lokals']);
        // }
    }

    public function confirm($id)
    {
        $anggota = AnggotaDosenLokal::where('id', $id)->first();
        $this->ids = $anggota->id;
    }

    public function delete()
    {
        $del = AnggotaDosenLokal::find($this->ids)->delete();
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
