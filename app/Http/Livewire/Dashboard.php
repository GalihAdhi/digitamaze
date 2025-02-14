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
        'kelasdatas' => Kelas::with(['guru', 'murid'])->paginate(5),
        'gurudatas' => Kelas::has('guru')->with('guru')->paginate(5),
        'muriddatas' => Kelas::has('murid')->with('murid.wali')->paginate(5),
    ]);
}

}
