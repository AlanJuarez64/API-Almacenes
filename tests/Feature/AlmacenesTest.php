<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Almacen;

class AlmacenesTest extends TestCase
{

    public function test_BuscarAlmacenValido()
    {
         
        $response = $this->post('/almacenes/buscar', [
            "id" => "1",
        ]);
    
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'ID_Almacen',
            'Capacidad',
            'created_at',
            'updated_at'
        ]);
    }
}
