<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Guru extends Model
{
    use HasFactory;

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_gurus', 'id_guru', 'id_kelas');
    }


    protected $fillable = [
        'nama',
        'mapel',
        'nip',
        'kelamin',
        'kelas',
        'foto',
    ];
}
