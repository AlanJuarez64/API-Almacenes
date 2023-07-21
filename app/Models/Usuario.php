<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function productos()
    {
        return $this->hasMany(Producto::class, 'ID_Usuario', 'id');
    }
}
