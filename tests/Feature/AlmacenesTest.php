<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Almacen;
use Tests\Feature\Factory;
use Database\Factories\AlmacenFactory;

class AlmacenesTest extends TestCase
{

    public function testBuscarAlmacenValido()
    {
         
        $response = $this->get('/api/almacenes/1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'ID_Almacen',
            'Capacidad',
            'created_at',
            'updated_at'
        ]);
    }

    public function testBuscarAlmacenInvalido()
    {
         
        $response = $this->get('/api/almacenes/999');
    
        $response->assertStatus(404);
    }

    public function testVerTodo()
    {       
        $response = $this->get('/api/almacenes');
        $response->assertStatus(200);
    }


    public function testRegistrarAlmacenValido()
    {
        $data = [
            'Capacidad' => 20,
        ];

        $response = $this->post('/api/almacenes', $data);
        $response->assertStatus(201);

        $response->assertJson([
            'message' => 'Almacén registrado con éxito.',

        ]);
    }


    public function testEliminarAlmacenValido()
    {
        $almacen = Almacen::factory()->create();

        $response = $this->delete("/api/almacenes/{$almacen->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Almacén eliminado correctamente',
        ]);

        $this->assertDeleted('almacens', ['id' => $almacen->id]);
    }

    public function testModificarDatos()
    {
        $almacen = AlmacenFactory::new()->create();
        $data = [
            'Capacidad' => 30,
        ];

        $response = $this->put("/api/almacenes/{$almacen->id}", $data);
        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Almacén modificado con éxito.',
        ]);

        $this->assertDatabaseHas('almacenes', [
            'id' => $almacen->id,
            'Capacidad' => 30,
        ]);
    }
}
