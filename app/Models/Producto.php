<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'Productos';
    protected $primaryKey = 'ID_Producto';
    public $timestamps = true;

    protected $fillable = ['Peso', 'Cantidad', 'ID_Lote'];

    public function lote()
    {
        return $this->hasOne(Contiene::class, 'ID_Lote', 'ID_Producto');
    }
}
