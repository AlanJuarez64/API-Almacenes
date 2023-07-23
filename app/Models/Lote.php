<?php

namespace App\Models;

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

    protected $fillable = [
        'Nombre', 
        'Descripcion', 
        'Fecha_Hora_Estimada', 
        'Num_Serie'];
}
