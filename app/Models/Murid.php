<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Murid extends Model
{
    use HasFactory;

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_murids', 'id_murid', 'id_kelas');
    }

    protected $fillable = [
        'nama',
        'nim',
        'kelamin',
        'kelas',
        'foto',
    ];
}
