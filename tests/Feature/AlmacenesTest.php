<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Almacen;
use Illuminate\Support\Facades\Http;
use Tests\Feature\Factory;
use App\Models\User;

class AlmacenesTest extends TestCase
{

    public function testBuscarAlmacenValido()
    {
         
        $token = $this->simularAutenticacion();
        

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/almacenes/1');

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
         
        $token = $this->simularAutenticacion();
        

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/almacenes/999');
    
        $response->assertStatus(404);
    }

    public function testVerTodo()
    {
        $token = $this->simularAutenticacion();
        

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/almacenes');
        $response->assertStatus(200);
    }


    public function testRegistrarAlmacenValido()
    {
        $data = [
            'Capacidad' => 20,
        ];

        $token = $this->simularAutenticacion();
        

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/almacenes', $data);
        $response->assertStatus(201);

        $response->assertJson([
            'message' => 'Almacén registrado con éxito.',

        ]);
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
