<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Zona;
use App\Models\Cobro;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CobrosTest extends TestCase
{
    use RefreshDatabase;

    public function test_cobro_index(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/cobros');

        $response->assertOk();
    }


    public function test_cobro_store(): void
    {
        $this->actingAs(User::factory()->create());
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
        $cobro = [
            'mesa' => 1,
            'zona_id' => $zona->id,

            'cantidad' => 5,
            'tipo' => 'Efectivo',
        ];
        $response = $this->post('/cobros/store', $cobro);
        // Verificar que la cobro se haya creado en la base de datos
        $this->assertDatabaseHas('cobros', $cobro);

        // Verificar que la solicitud sea redirigida a la página adecuada después de crear la cobro (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/comandas');
    }
}
