<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasMurid extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kelas',
        'id_murid',
    ];

}
