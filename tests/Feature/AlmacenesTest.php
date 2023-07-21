<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Almacen;

class AlmacenesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para buscar un almacén existente.
     *
     * @return void
     */
    public function testBuscarAlmacenPorId()
    {
        // Supongamos que ya tienes un almacén con ID 1 en tu base de datos
        $almacen = Almacen::find(1);

        // Realiza la solicitud a la API para buscar el almacén por ID
        $response = $this->get('/api/almacenes/buscar?id=1');

        // Verifica que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verifica que los datos del almacén obtenidos de la API sean iguales a los datos existentes en la base de datos
        $response->assertJson([
            'id' => $almacen->id,
            'Capacidad' => $almacen->Capacidad,
            // Agrega aquí los otros atributos del modelo que desees verificar
        ]);
    }


    public function testBuscarAlmacenNoExistente()
    {
        // Realizamos una solicitud POST al endpoint /almacenes/buscar con un ID de almacén inexistente (por ejemplo, 999)
        $response = $this->postJson('/almacenes/buscar', ['id' => 999]);

        // Verificamos que la respuesta sea un error 404 (no encontrado)
        $response->assertStatus(404);

        // Verificamos que la respuesta contenga un mensaje de error
        $response->assertJson([
            'error' => 'Almacén no encontrado',
        ]);
    }
}
