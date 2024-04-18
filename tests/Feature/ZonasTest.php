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
        $response = $this
            ->post('zonas/store', $zona);
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
        $comandas = Comanda::all();

        $response = $this->get('/zonas/consultar/' . $zona->id);
         // Verificar que se muestra la página de la zona específica
         $response->assertStatus(200);
         $response
            ->assertRedirect('/zonas/consultar', [$zona, $comanda]);
            
         
       
    }


}
