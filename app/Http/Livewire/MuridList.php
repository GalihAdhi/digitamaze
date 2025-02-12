<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Murid;
use App\Models\Kelas;
use App\Models\KelasMurid;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class MuridList extends Component
{
    use WithFileUploads;

    public $muriddatas, $kelasdatas, $kelas_id, $murid_id, $kelas = [];

    #[Validate('required|string|max:255|min:3')] 
    public $nama = '';

    #[Validate('required|integer|digits:8')] 
    public $nim = '';

    #[Validate('required')] 
    public $kelamin = '';
    
    #[Validate('mimes:jpg,jpeg,png')] 
    public $foto = '';

    public function mount()
    {
        $this->muriddatas= Murid::all();
        $this->kelasdatas= Kelas::all();
    }

    public function create()
    {
        $this->validate();

        $datamurid = [
            'nama' => $this->nama,
            'nim' => $this->nim,
            'kelamin' => $this->kelamin,
        ];

        if ($this->foto) {
            $datamurid['foto'] = $this->foto->store('studentimg', 'public');
        }

        $murid = Murid::create($datamurid);

        if (!empty($this->kelas)) {
            foreach ($this->kelas as $id_kelas) {
                KelasMurid::create([
                    'id_kelas' => $id_kelas,
                    'id_murid' => $murid->id,
                ]);
            }
        }

        $this->dispatch('closeModal');

        return redirect()->to('/muridlist')->with('message', 'murid berhasil ditambahkan!');
    }

    public function delete($id)
    {
        Murid::findOrFail($id)->delete();
        return redirect()->to('/muridlist')->with('message', 'murid berhasil dihapus!');
        $this->refreshUsers();
    }

    public function edit($id)
    {
        $murid = Murid::findOrFail($id);
        $this->murid_id = $id;
        $this->nama = $murid->nama;
        $this->nim = $murid->nim;
        $this->kelas = $murid->kelas->pluck('id')->toArray();
    }

    public function update()
    {
        $this->validate();

        $murid = Murid::findOrFail($this->murid_id);
    
        // Cek apakah ada foto baru yang diupload
        if ($this->foto) {
            // Simpan foto baru
            $imagePath = $this->foto->store('studentimg', 'public');
    
            // Hapus foto lama jika ada
            if ($murid->foto) {
                Storage::delete('public/studentimg/' . $murid->foto);
            }
    
            // Update data termasuk foto baru
            $murid->update([
                'nama' => $this->nama,
                'nim' => $this->nim,
                'kelamin' => $this->kelamin,
                'foto' => $imagePath, 
            ]);
        } else {
            // Jika tidak ada foto baru, update tanpa menyentuh `foto`
            $murid->update([
                'nama' => $this->nama,
                'nim' => $this->nim,
                'kelamin' => $this->kelamin,
            ]);
        }
    
        // Update relasi dengan kelas jika ada perubahan
        if (!empty($this->kelas)) {
            // Hapus data lama di tabel kelas_murid untuk murid ini
            KelasMurid::where('id_murid', $murid->id)->delete();
    
            // Simpan data kelas baru
            foreach ($this->kelas as $id_kelas) {
                KelasMurid::create([
                    'id_kelas' => $id_kelas,
                    'id_murid' => $murid->id,
                ]);
            }
        }
    
        // Emit event untuk menutup modal
        $this->dispatch('closeModal');
    
        // Redirect dengan pesan sukses
        return redirect()->to('/muridlist')->with('message', 'Data murid berhasil diperbarui!');
    }
    
    public function render()
    {
        return view('livewire.murid-list');
    }
}
