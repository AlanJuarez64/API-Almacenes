<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contiene extends Model
{
    use HasFactory;

    protected $table = 'Contiene';
    protected $primaryKey = 'ID_Producto';
    protected $fillable = ['ID_Lote'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_Producto');
    }

    public function lote()
    {
        return $this->belongsTo(Lote::class, 'ID_Lote');
    }
    
}
