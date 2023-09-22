<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Articulo;

class ArticuloTest extends TestCase
{
    public function testVerTodosLosArticulos(){
        $response = $this->get('/api/articulos/');

        $response->assertStatus(200)
            ->assertJsonStructure(['*' => [
                'ID_Articulo', 'ID_Usuario', 'ID_Producto', 'Estado',
                'created_at', 'updated_at'
                ]]);
    }

    public function testBuscarArticuloExistente()
    {
        $response = $this->get('/api/articulos/1');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'ID_Articulo', 'ID_Usuario', 'ID_Producto', 'Estado',
                'created_at', 'updated_at'
                ]);
    }

    public function testBuscarArticuloNoExistente()
    {
        $response = $this->get('/api/articulos/999');
        $response->assertStatus(404)
            ->assertJsonStructure(['error']);

    }

    public function testCambiarEstadoDeArticuloExistente()
    {
        $data = ['estado' => 'En camino'];
        $response = $this->put('/api/articulos/1', $data);

        $response->assertStatus(200)
            ->assertJson(["message" => "Estado del artículo modificado correctamente"]);


        $updatedArticulo = Articulo::find(1);
        $this->assertEquals('En camino', $updatedArticulo->Estado);
    }

    public function testCambiarEstadoDeArticuloNoExistente()
    {
        $data = ['estado' => 'En camino'];
        $response = $this->put('/api/articulos/999', $data);

        $response->assertStatus(404)
            ->assertJson(["error" => "Artículo no encontrado"]);
    }

    public function testRegistrarArticuloValido()
    {
        $datos = [
            'ID_Usuario' => 1,
            'ID_Producto' => 2,
            'Estado' => 'En espera'
        ];

 
        $response = $this->post('/api/articulos', $datos);

        $response->assertStatus(200);

        $this->assertDatabaseHas('Articulo', $datos);
    }

    public function testRegistrarArticuloInvalido()
    {
        $datos = [
            'ID_Usuario' => 999,
            'ID_Producto' => 999,
            'Estado' => 'a'
        ];

 
        $response = $this->post('/api/articulos', $datos);

        $response->assertStatus(400);
                
        
    }

}
