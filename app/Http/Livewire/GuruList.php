<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasGuru;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class GuruList extends Component
{
    use WithFileUploads;

    public $gurudatas, $kelasdatas, $kelas_id, $guru_id, $kelas = [];

    #[Validate('required|string|max:255|min:3')] 
    public $nama = '';
    
    #[Validate('required|string|max:255|min:3')] 
    public $mapel = '';

    #[Validate('required|integer|digits:8')] 
    public $nip = '';

    #[Validate('required')] 
    public $kelamin = '';
    
    #[Validate('mimes:jpg,jpeg,png')] 
    public $foto = '';

    public function mount()
    {
        $this->gurudatas= Guru::all();
        $this->kelasdatas= Kelas::all();
    }

    public function create()
    {
        $this->validate();

        $dataguru = [
            'nama' => $this->nama,
            'mapel' => $this->mapel,
            'nip' => $this->nip,
            'kelamin' => $this->kelamin,
        ];

        if ($this->foto) {
            $dataguru['foto'] = $this->foto->store('teacherimg', 'public');
        }

        $guru = Guru::create($dataguru);

        if (!empty($this->kelas)) {
            foreach ($this->kelas as $id_kelas) {
                KelasGuru::create([
                    'id_kelas' => $id_kelas,
                    'id_guru' => $guru->id,
                ]);
            }
        }

        $this->dispatch('closeModal');

        return redirect()->to('/gurulist')->with('message', 'guru berhasil ditambahkan!');
    }

    public function delete($id)
    {
        Guru::findOrFail($id)->delete();
        return redirect()->to('/gurulist')->with('message', 'guru berhasil dihapus!');
        $this->refreshUsers();
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $this->guru_id = $id;
        $this->nama = $guru->nama;
        $this->mapel = $guru->mapel;
        $this->nip = $guru->nip;
        $this->kelas = $guru->kelas->pluck('id')->toArray();
    }

    public function update()
    {
        $this->validate();

        $guru = Guru::findOrFail($this->guru_id);
    
        // Cek apakah ada foto baru yang diupload
        if ($this->foto) {
            // Simpan foto baru
            $imagePath = $this->foto->store('teacherimg', 'public');
    
            // Hapus foto lama jika ada
            if ($guru->foto) {
                Storage::delete('public/studentimg/' . $guru->foto);
            }
    
            // Update data termasuk foto baru
            $guru->update([
                'nama' => $this->nama,
                'mapel' => $this->mapel,
                'nip' => $this->nip,
                'kelamin' => $this->kelamin,
                'foto' => $imagePath, 
            ]);
        } else {
            // Jika tidak ada foto baru, update tanpa menyentuh `foto`
            $guru->update([
                'nama' => $this->nama,
                'mapel' => $this->mapel,
                'nip' => $this->nip,
                'kelamin' => $this->kelamin,
            ]);
        }
    
        // Update relasi dengan kelas jika ada perubahan
        if (!empty($this->kelas)) {
            // Hapus data lama di tabel kelas_murid untuk murid ini
            KelasGuru::where('id_guru', $guru->id)->delete();
    
            // Simpan data kelas baru
            foreach ($this->kelas as $id_kelas) {
                KelasGuru::create([
                    'id_kelas' => $id_kelas,
                    'id_guru' => $guru->id,
                ]);
            }
        }
    
        // Emit event untuk menutup modal
        $this->dispatch('closeModal');
    
        // Redirect dengan pesan sukses
        return redirect()->to('/gurulist')->with('message', 'Data guru berhasil diperbarui!');
    }
    
    public function render()
    {
        return view('livewire.guru-list');
    }
}
