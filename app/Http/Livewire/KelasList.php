<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kelas;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;

class KelasList extends Component
{
    public $kelasdatas, $kelas_id;

    #[Validate('required|string|max:255|min:3')] 
    public $nama = '';

    public function mount()
    {
        $this->kelasdatas= Kelas::all();
    }

    public function create()
    {
        $this->validate();

        Kelas::create([
            'nama' => $this->nama,
        ]);

        $this->dispatch('closeModal');

        return redirect()->to('/kelaslist')->with('message', 'Kelas berhasil ditambahkan!');
    }

    public function delete($id)
    {
        Kelas::findOrFail($id)->delete();
        return redirect()->to('/kelaslist')->with('message', 'Kelas berhasil dihapus!');
        $this->refreshUsers();
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $this->nama = $kelas->nama;
        $this->kelas_id = $id;
    }

    public function update()
    {
        $this->validate();
        Kelas::findOrFail($this->kelas_id)->update(['nama' => $this->nama]);
        $this->dispatch('closeModal');
        return redirect()->to('/kelaslist')->with('message', 'Kelas berhasil diperbarui!');
    }
    
    public function render()
    {
        return view('livewire.kelas-list');
    }
}
