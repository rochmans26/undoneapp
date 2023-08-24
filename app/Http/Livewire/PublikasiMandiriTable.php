<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\PublikasiMandiri;

class PublikasiMandiriTable extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        return view('livewire.publikasi-mandiri-table', [
            'pubmans' => PublikasiMandiri::all()
        ])
        ->extends('layouts.masters')
        ->section('content');
    }
    
}
