<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Murid;

class WaliMurid extends Model
{
    use HasFactory;

    public function murid()
    {
        return $this->hasone(Murid::class, 'id_murid', 'id');
    }

    protected $fillable = [
        'nama',
        'id_murid',
    ];

}
