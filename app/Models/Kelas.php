<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Murid;
use App\Models\Guru;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    public function murid()
    {
        return $this->belongsToMany(Murid::class, 'kelas_murids', 'id_kelas', 'id_murid');
    }
    
    public function guru()
    {
        return $this->belongsToMany(Guru::class, 'kelas_gurus', 'id_kelas', 'id_guru');
    }
}
