<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Familia;
use App\Models\Producto;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductosTest extends TestCase
{
    use RefreshDatabase;

    public function test_producto_index(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/productos');

        $response->assertOk();
    }

    public function test_producto_store(): void
    {
        $this->actingAs(User::factory()->create());
        $familiaTest = [
            'nombre' => 'Whisky',
            'combinada' => 1,
        ];
        $familia = familia::create($familiaTest);

        $producto = [
           
           
            'nombre' => 'JB',
            'descripcion'=> 'whisky 40º',
            'precio'=> 6,
            'iva'=> 21,
            'familia_id'=> $familia->id,
            'impresora'=> 'tickets',
        ];
        $response = $this->post('/productos/store', $producto);
            // Verificar que la producto se haya creado en la base de datos
        $this->assertDatabaseHas('productos', $producto);

        // Verificar que la solicitud sea redirigida a la página adecuada después de crear la producto (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/productos');


    }


    public function test_producto_update(): void
    {
        $this->actingAs(User::factory()->create());
        $familiaTest = [
            'nombre' => 'Whisky',
            'combinada' => 1,
        ];
        $familia = familia::create($familiaTest);

        $productoTest = [
           
           
            'nombre' => 'JB',
            'descripcion'=> 'whisky 40º',
            'precio'=> 6,
            'iva'=> 21,
            'familia_id'=> $familia->id,
            'impresora'=> 'tickets',
        ];
   
        $producto = producto::create($productoTest);
     

           // Nuevos datos de la producto
           $newData = [
            'nombre' => 'White Label',
            'descripcion'=> 'whisky 40º',
            'precio'=> 7,
            'iva'=> 21,
            'familia_id'=> $familia->id,
            'impresora'=> 'tickets',
        ];

        // Hacer una solicitud para actualizar la producto
        $response = $this->put("/productos/update/{$producto->id}", $newData);

        // Verificar que la producto se haya actualizado en la base de datos
        $this->assertDatabaseHas('productos', $newData);

        // Verificar que la solicitud sea redirigida a la página adecuada después de actualizar la producto (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/productos');
            
         
       
    }

    public function test_destroy_producto(): void
    {
        // Autenticar como un usuario (puedes modificar esto según tu lógica de autenticación)
        $this->actingAs(User::factory()->create());

        $familiaTest = [
            'nombre' => 'Whisky',
            'combinada' => 1,
        ];
        $familia = familia::create($familiaTest);

        // Crear una producto para eliminar
        $productoTest = [
           
           
            'nombre' => 'JB',
            'descripcion'=> 'whisky 40º',
            'precio'=> 6,
            'iva'=> 21,
            'familia_id'=> $familia->id,
            'impresora'=> 'tickets',
        ];
   
        $producto = producto::create($productoTest);

        $Data = [
            'idproducto' => $producto->id,
           
        ];

        // Hacer una solicitud para eliminar la producto
        $response = $this->delete("/productos/destroy", $Data);

        // Verificar que la producto se haya eliminado de la base de datos
    
       $this->assertDatabaseMissing('productos', ['id' => $producto->id]);

        // Verificar que la solicitud sea redirigida a la página adecuada después de eliminar la producto (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/productos');
    }
}
