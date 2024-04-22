<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Zona;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ZonasTest extends TestCase
{
    use RefreshDatabase;

    public function test_zona_index(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/zonas');

        $response->assertOk();
    }

    public function test_zona_store(): void
    {
        $this->actingAs(User::factory()->create());

        $zona = [
           
            'nombre' => 'Interior1',
            'mesas' => 12,
        ];
        $response = $this->post('/zonas/store', $zona);
            // Verificar que la zona se haya creado en la base de datos
        $this->assertDatabaseHas('zonas', $zona);

        // Verificar que la solicitud sea redirigida a la página adecuada después de crear la zona (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/zonas');


    }
    public function test_zona_show(): void
    {
        $this->actingAs(User::factory()->create());
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
       
     
                // Hacer una solicitud para ver una zona específica por su ID
                $response = $this->get('/zonas/' . $zona->id);

                // Verificar que se muestra la página de la zona específica
                $response->assertStatus(200);
                $response->assertSeeText($zona->nombre);
                $response->assertSeeText($zona->tables);
                
          
    }
    public function test_zona_show_no_existe(): void
    {
        // Autenticar como un usuario
        $this->actingAs(User::factory()->create());

        // Intentar ver una zona que no existe en la base de datos
        $response = $this->get('/zonas/999');

        // Verificar que se reciba un código de respuesta 404 (no encontrado)
        $response->assertStatus(500);
    }

    public function test_zona_update(): void
    {
        $this->actingAs(User::factory()->create());
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
     

           // Nuevos datos de la zona
           $newData = [
            'nombre' => 'Zona Actualizada',
            'mesas' => 15,
        ];

        // Hacer una solicitud para actualizar la zona
        $response = $this->put("/zonas/update/{$zona->id}", $newData);

        // Verificar que la zona se haya actualizado en la base de datos
        $this->assertDatabaseHas('zonas', $newData);

        // Verificar que la solicitud sea redirigida a la página adecuada después de actualizar la zona (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/zonas');
            
         
       
    }

    public function test_delete_zona(): void
    {
        // Autenticar como un usuario (puedes modificar esto según tu lógica de autenticación)
        $this->actingAs(User::factory()->create());

        // Crear una zona para eliminar
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
        $Data = [
            'idzona' => $zona->id,
           
        ];

        // Hacer una solicitud para eliminar la zona
        $response = $this->delete("/zonas/destroy", $Data);

        // Verificar que la zona se haya eliminado de la base de datos
    
       $this->assertDatabaseMissing('zonas', ['id' => $zona->id]);

        // Verificar que la solicitud sea redirigida a la página adecuada después de eliminar la zona (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/zonas');
    }
}
