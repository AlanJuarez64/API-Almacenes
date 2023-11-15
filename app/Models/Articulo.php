<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $table = 'Articulo';

    protected $primaryKey = 'ID_Articulo';
    protected $fillable = [
        'id',
        'ID_Producto',
        'Estado',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_Producto');
    }
}
