<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    protected $table = 'lotes';
    protected $primaryKey = 'ID_Lote';
    public $timestamps = true;

    public function productos()
    {
        return $this->hasMany(Producto::class, 'ID_Lote', 'ID_Lote');
    }

    public function camion()
    {
        return $this->belongsTo(Camion::class, 'Num_Serie', 'Num_Serie');
    }
}
