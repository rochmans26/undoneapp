<?php

namespace App\Http\Livewire;
use App\Models\Prodi;
use Livewire\Component;
use App\Models\Fakultas;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ProdiTable extends Component
{
    public $id_prodi, $nm_prodi, $id_fak, $ids;
    public $search="";
    public $result=10;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    

    public function render()
    {
        return view('livewire.prodi-table', [
            'prodis' => Prodi::orderBy('id', 'desc')
            ->where('nm_prodi', 'like', '%'.$this->search.'%')
            ->orWhere('slug', 'like', '%'.$this->search.'%')
            ->paginate($this->result),
            'fakultas' => Fakultas::all()
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function create()
    {
        $this->validate([
            'id_prodi' => 'required|unique:prodis',
            'id_fak' => 'required',
            'nm_prodi' => 'required|string|min:4|unique:prodis'
        ]);

        Prodi::create([
            'id_prodi' => $this->id_prodi,
            'id_fak' => $this->id_fak,
            'nm_prodi' => $this->nm_prodi,
            'slug' => Str::of($this->nm_prodi)->slug('-')
        ]);
        session()->flash('success', 'Berhasil Menambahkan Data Prodi!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    // Clear Form
    public function ClearForm()
    {
        $this->nm_prodi = Null;
        $this->id_prodi = Null;
        $this->id_fak = Null;
        $this->ids = Null;
    }
    
    // Edit
    public function edit($id)
    {
        $prodi = Prodi::where('id', $id)->first();
        $this->nm_prodi = $prodi->nm_prodi;
        $this->id_prodi = $prodi->id_prodi;
        $this->id_fak = $prodi->id_fak;
        $this->ids = $prodi->id;
    }

    public function update()
    {
        $data = [
            'id_prodi' => $this->id_prodi,
            'id_fak' => $this->id_fak,
            'nm_prodi' => $this->nm_prodi,
            'slug' => Str::of($this->nm_prodi)->slug('-')
        ];
        $get=Prodi::find($this->ids);
        $get->update($data);
        session()->flash('success', 'Berhasil Edit Data Prodi!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function confirm($id)
    {
        $prodi = Prodi::where('id', $id)->first();
        $this->ids = $prodi->id;
    }

    public function delete()
    {
        $del = Prodi::find($this->ids)->delete();

        session()->flash('success', 'Data Berhasil Dihapus');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
