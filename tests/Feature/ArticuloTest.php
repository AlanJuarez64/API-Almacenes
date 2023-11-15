<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Models\Articulo;
use App\Models\User;

class ArticuloTest extends TestCase
{
    public function testVerTodosLosArticulos(){
        $token = $this->simularAutenticacion();
        

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/articulos/');

        $response->assertStatus(200)
            ->assertJsonStructure(['*' => [
                'ID_Articulo', 'id', 'ID_Producto', 'Estado',
                'created_at', 'updated_at'
                ]]);
    }

    public function testBuscarArticuloExistente()
    {        
        $token = $this->simularAutenticacion();
        

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/articulos/1');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'ID_Articulo', 'id', 'ID_Producto', 'Estado',
                'created_at', 'updated_at'
                ]);
    }

    public function testBuscarArticuloNoExistente()
    {        
        $token = $this->simularAutenticacion();
        

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/articulos/999');

        $response->assertStatus(404)
            ->assertJsonStructure(['error']);

    }

    public function testCambiarEstadoDeArticuloExistente()
    {
        $data = ['Estado' => 'En camino'];

        $token = $this->simularAutenticacion();
        

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/articulos/1', $data);

        $response->assertStatus(200)
            ->assertJson(["message" => "Estado del artículo modificado correctamente"]);


        $updatedArticulo = Articulo::find(1);
        $this->assertEquals('En camino', $updatedArticulo->Estado);
    }

    public function testCambiarEstadoDeArticuloNoExistente()
    {
        $data = ['Estado' => 'En el almacen'];
        
        $token = $this->simularAutenticacion();
        

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/articulos/999', $data);

        $response->assertStatus(404)
            ->assertJson(["error" => "Artículo no encontrado"]);
    }

    public function testRegistrarArticuloValido()
    {
        $datos = [
            'id' => 4,
            'ID_Producto' => 2,
            'Estado' => 'En el almacen'
        ];

        $token = $this->simularAutenticacion();
        

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/articulos', $datos);

        $response->assertStatus(200);

        $this->assertDatabaseHas('Articulo', $datos);
    }

    public function testRegistrarArticuloInvalido()
    {
        $datos = [
            'id' => 999,
            'ID_Producto' => 999,
            'Estado' => 'a'
        ];

        $token = $this->simularAutenticacion();
        

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/articulos', $datos);

        $response->assertStatus(400); 
    }

    private function simularAutenticacion()
    {
        $user = User::factory()->create();
        
        $response = Http::post('http://localhost:8001/oauth/token', [
            'grant_type' => 'password',
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'username' => "$user->email",
            'password' => 'password',
        ]);

        $token = $response->json('access_token');

        return $token;
    }

}
