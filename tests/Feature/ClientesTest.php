<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Cliente;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientesTest extends TestCase
{
    use RefreshDatabase;

    public function test_cliente_index(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/clientes');

        $response->assertOk();
    }

    public function test_cliente_store(): void
    {
        $this->actingAs(User::factory()->create());

        $cliente = [
            'cif'=> '00000000S',
            'nombre' => 'Minibar S.L.',
            'direccion' => 'c/ Sevilla, 4, 41710 Utrera (sevilla)',
            'email' => 'minibarutrera@minibar.com',
        ];
        $response = $this->post('/clientes/store', $cliente);
            // Verificar que la cliente se haya creado en la base de datos
        $this->assertDatabaseHas('clientes', $cliente);

        // Verificar que la solicitud sea redirigida a la página adecuada después de crear la cliente (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/clientes');


    }


    public function test_cliente_update(): void
    {
        $this->actingAs(User::factory()->create());
        $clienteTest = [
            'cif'=> '00000000S',
            'nombre' => 'Minibar S.L.',
            'direccion' => 'c/ Sevilla, 4, 41710 Utrera (sevilla)',
            'email' => 'minibarutrera@minibar.com',
        ];
        $cliente = Cliente::create($clienteTest);
     

           // Nuevos datos de la cliente
           $newData = [
            'cif'=> '10000000S',
            'nombre' => 'Minibar SL',
            'direccion' => 'c/ Sevilla, 11, 41710 Utrera (sevilla)',
            'email' => 'minibarutrera@minibar.es',
        ];

        // Hacer una solicitud para actualizar la cliente
        $response = $this->put("/clientes/update/{$cliente->id}", $newData);

        // Verificar que la cliente se haya actualizado en la base de datos
        $this->assertDatabaseHas('clientes', $newData);

        // Verificar que la solicitud sea redirigida a la página adecuada después de actualizar la cliente (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/clientes');
            
         
       
    }

    public function test_destroy_cliente(): void
    {
        // Autenticar como un usuario (puedes modificar esto según tu lógica de autenticación)
        $this->actingAs(User::factory()->create());

        // Crear una cliente para eliminar
        $clienteTest = [
            'cif'=> '00000000S',
            'nombre' => 'Minibar S.L.',
            'direccion' => 'c/ Sevilla, 4, 41710 Utrera (sevilla)',
            'email' => 'minibarutrera@minibar.com',
        ];
        $cliente = Cliente::create($clienteTest);
        $Data = [
            'idcliente' => $cliente->id,
           
        ];

        // Hacer una solicitud para eliminar la cliente
        $response = $this->delete("/clientes/destroy", $Data);

        // Verificar que la cliente se haya eliminado de la base de datos
    
       $this->assertDatabaseMissing('clientes', ['id' => $cliente->id]);

        // Verificar que la solicitud sea redirigida a la página adecuada después de eliminar la cliente (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/clientes');
    }
}
