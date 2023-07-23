<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $primaryKey = 'ID_Producto';
    public $timestamps = true;


    public function lote()
    {
        return $this->belongsTo(Lote::class, 'ID_Lote', 'ID_Lote');
    }

    protected $fillable = ['Peso', 'Cantidad', 'ID_Lote'];
}
