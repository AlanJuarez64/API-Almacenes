<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $primaryKey = 'ID_Producto';
    public $timestamps = true;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_Usuario', 'id');
    }

    public function lote()
    {
        return $this->belongsTo(Lote::class, 'ID_Lote', 'ID_Lote');
    }
}
