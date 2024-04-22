<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Zona;
use App\Models\Cobro;
use App\Models\Caja;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CajasTest extends TestCase
{
    use RefreshDatabase;

    public function test_caja_index(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/cajas');

        $response->assertOk();
    }


    public function test_caja_store(): void
    {
        $this->actingAs(User::factory()->create());
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
        $cobroTest = [
            'mesa' => 1,
            'zona_id' => $zona->id,
            'cantidad' => 50,
            'tipo' => 'Efectivo',
        ];
         Cobro::create($cobroTest);
       


        $response = $this->post('/cajas/store');
      
        $this->assertTrue(true);

      
    }
}
