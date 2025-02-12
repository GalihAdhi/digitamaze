<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Murid;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasGuru;
use App\Models\KelasMurid;
use Livewire\WithPagination;


class Dashboard extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.dashboard', [
            'gurudatas' => Guru::paginate(5),
            'muriddatas' => Murid::paginate(5),
            'kelasdatas' => Kelas::paginate(5),
        ]);
    }
}
