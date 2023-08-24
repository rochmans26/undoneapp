<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GantiKatasandi extends Component
{
    public $oldpassword, $newpassword;
    protected $ids;

    public function render()
    {
        return view('livewire.ganti-katasandi')->extends('layouts.master')->section('content');
    }

    public function ClearForm()
    {
        $this->oldpassword = Null;
        $this->newpassword = Null;
    }
    
    public function ganti()
    {
        $this->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/'
        ]);
        
        $this->ids = Auth::user()->id;
        $newpass = Hash::make($this->newpassword);
        $temp = User::where('id', $this->ids)->first();
        // dd($newpass);
        if(Hash::check($this->oldpassword, $temp->password)){
            $data = [
                'password' => $newpass
            ];
            User::where('id', $this->ids)->update($data);
            session()->flash('success', 'Berhasil Ganti Kata Sandi!');
            $this->ClearForm();
        } else {
            session()->flash('error', 'Kata Sandi Lama Salah!');
        }
    }
}
