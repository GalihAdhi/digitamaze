<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Murid;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasGuru;
use App\Models\KelasMurid;
use Livewire\WithPagination;


class KelasInfo extends Component
{
    use WithPagination;

    public $kelasid;


    public function mount($kelasid)
    {
        $this->kelasid = $kelasid;
    }

    public function render()
    {
        return view('livewire.kelas-info', [
            'gurudatas' => Guru::whereHas('kelas', function ($query) {
                $query->where('id_kelas', $this->kelasid);
            })->paginate(5),

            'muriddatas' => Murid::whereHas('kelas', function ($query) {
                $query->where('id_kelas', $this->kelasid);
            })->paginate(5),
        ]);
    }
}
