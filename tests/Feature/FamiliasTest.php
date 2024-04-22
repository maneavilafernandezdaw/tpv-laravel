<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Familia;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FamiliasTest extends TestCase
{
    use RefreshDatabase;

    public function test_familia_index(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/familias');

        $response->assertOk();
    }

    public function test_familia_store(): void
    {
        $this->actingAs(User::factory()->create());

        $familia = [
           
            'nombre' => 'whisky',
            'combinada' => 0,
        ];
        $response = $this->post('/familias/store', $familia);
            // Verificar que la familia se haya creado en la base de datos
        $this->assertDatabaseHas('familias', $familia);

        // Verificar que la solicitud sea redirigida a la página adecuada después de crear la familia (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/familias');


    }


    public function test_familia_update(): void
    {
        $this->actingAs(User::factory()->create());
        $familiaTest = [
            'nombre' => 'Whisky',
            'combinada' => 0,
        ];
        $familia = familia::create($familiaTest);
     

           // Nuevos datos de la familia
           $newData = [
            'nombre' => 'familia Actualizada',
            'combinada' => 1,
        ];

        // Hacer una solicitud para actualizar la familia
        $response = $this->put("/familias/update/{$familia->id}", $newData);

        // Verificar que la familia se haya actualizado en la base de datos
        $this->assertDatabaseHas('familias', $newData);

        // Verificar que la solicitud sea redirigida a la página adecuada después de actualizar la familia (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/familias');
            
         
       
    }

    public function test_destroy_familia(): void
    {
        // Autenticar como un usuario (puedes modificar esto según tu lógica de autenticación)
        $this->actingAs(User::factory()->create());

        // Crear una familia para eliminar
        $familiaTest = [
            'nombre' => 'Whisky',
            'combinada' => 1,
        ];
        $familia = familia::create($familiaTest);
        $Data = [
            'idfamilia' => $familia->id,
           
        ];

        // Hacer una solicitud para eliminar la familia
        $response = $this->delete("/familias/destroy", $Data);

        // Verificar que la familia se haya eliminado de la base de datos
    
       $this->assertDatabaseMissing('familias', ['id' => $familia->id]);

        // Verificar que la solicitud sea redirigida a la página adecuada después de eliminar la familia (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/familias');
    }
}
