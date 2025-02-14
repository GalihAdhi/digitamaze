<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\WaliMurid;
use App\Models\Murid;
use Livewire\Attributes\Validate;


class WaliMuridList extends Component
{
    public $walidatas, $wali_id, $muriddatas;

    #[Validate('required|string|max:255|min:3')] 
    public $nama = '';

    #[Validate('required')] 
    public $id_murid = '';


    public function mount()
    {
        $this->muriddatas= Murid::all();
        $this->walidatas= WaliMurid::all();
    }

    public function create()
    {
        $this->validate();

        $wali = [
            'nama' => $this->nama,
            'id_murid' => $this->id_murid,
        ];

        WaliMurid::create($wali);

        $this->dispatch('closeModal');

        return redirect()->to('/wali-murid')->with('message', 'wali berhasil ditambahkan!');
    }

    public function delete($id)
    {
        WaliMurid::findOrFail($id)->delete();
        return redirect()->to('/wali-murid')->with('message', 'wali berhasil dihapus!');
        $this->refreshUsers();
    }

    public function edit($id)
    {
        $wali = WaliMurid::findOrFail($id);
        $this->nama = $wali->nama;
        $this->id_murid = $wali->nama;
        $this->wali_id = $id;
    }

    public function update()
    {
        $this->validate();
        WaliMurid::findOrFail($this->wali_id)->update(['nama' => $this->nama], ['id_murid' => $this->id_murid]);
        $this->dispatch('closeModal');
        return redirect()->to('/wali-murid')->with('message', 'wali berhasil diperbarui!');
    }
    
    public function render()
    {
        return view('livewire.wali-murid');
    }
}
