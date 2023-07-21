<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    use HasFactory;
    protected $table = 'camiones';
    protected $primaryKey = 'Num_Serie';
    public $timestamps = true;

    public function lotes()
    {
        return $this->hasMany(Lote::class, 'Num_Serie', 'Num_Serie');
    }
}
