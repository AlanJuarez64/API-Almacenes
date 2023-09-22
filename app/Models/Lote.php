<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    protected $table = 'Lote';
    protected $primaryKey = 'ID_Lote';
    public $timestamps = true;

    protected $fillable = [
        'Nombre', 
        'Descripcion', 
        'Fecha_Hora_Estimada', 
        'Num_Serie'];

        public function producto()
    {
        return $this->hasMany(Contiene::class, 'ID_Lote');
    }
}
