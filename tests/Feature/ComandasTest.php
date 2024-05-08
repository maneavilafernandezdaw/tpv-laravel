<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Comanda;
use App\Models\Zona;
use App\Models\Familia;
use App\Models\Producto;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComandasTest extends TestCase
{
    use RefreshDatabase;

    public function test_comanda_index(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/comandas');

        $response->assertOk();
    }

    public function test_comanda_cuenta(): void
    {
        $user = User::factory()->create();
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);

        $response = $this
            ->actingAs($user)
            ->get('/comandas/cuenta/'.$zona->id.'/1');

        $response->assertOk();
    }

    public function test_comanda_show(): void
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
                $response->assertSeeText($zona->mesas);
                
          
    }

    public function test_comanda_create(): void
    {
        $this->actingAs(User::factory()->create());
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
       
     
                // Hacer una solicitud para ver una zona específica por su ID
                $response = $this->get('/comandas/create/' . $zona->id. '/1/2');

                // Verificar que se muestra la página de la zona específica
                $response->assertStatus(200);
               
                
          
    }

    public function test_comanda_consultarCuenta(): void
    {
        $this->actingAs(User::factory()->create());
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
       
     
                // Hacer una solicitud para ver una zona específica por su ID
                $response = $this->get('/comandas/cuenta/' . $zona->id. '/1');

                // Verificar que se muestra la página de la zona específica
                $response->assertStatus(200);
               
                
          
    }
    public function test_comanda_pedido(): void
    {
        $this->actingAs(User::factory()->create());
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
       
     
                // Hacer una solicitud para ver una zona específica por su ID
                $response = $this->get('/comandas/pedido/' . $zona->id. '/1/1');

                // Verificar que se muestra la página de la zona específica
                $response->assertStatus(200);
               
                
          
    }

    public function test_comanda_store(): void
    {
        $this->actingAs(User::factory()->create());
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
        $familiaTest = [
            'nombre' => 'Whisky',
            'combinada' => 0,
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

        $comanda = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,
        'producto_id'  => $producto->id,
        'refresco' => 'Solo',
        'cantidad'  => 1,
        'precio'  => 5.00,
        'estado' => 'No enviado',
       
        
    ];


        $response = $this->post('/comandas/store', $comanda);
            // Verificar que la comanda se haya creado en la base de datos
        $this->assertDatabaseHas('comandas', $comanda);

        // Verificar que la solicitud sea redirigida a la página adecuada después de crear la comanda (puedes modificar esto según tu aplicación)
       
        $response = $this->get('/comandas/create/1/1/todo');


    }
    public function test_comanda_incrementar(): void
    {
        $this->actingAs(User::factory()->create());
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
        $familiaTest = [
            'nombre' => 'Whisky',
            'combinada' => 0,
        ];
        $familia = Familia::create($familiaTest);

        $productoTest = [
           
           
            'nombre' => 'JB',
            'descripcion'=> 'whisky 40º',
            'precio'=> 6,
            'iva'=> 21,
            'familia_id'=> $familia->id,
            'impresora'=> 'tickets',
        ];
   
        $producto = Producto::create($productoTest);

        $comandaTest = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,
        'producto_id'  => $producto->id,
        'refresco' => 'Solo',
        'cantidad'  => 1,
        'precio'  => 5.00,
        'estado' => 'No enviado',
       
        
    ];
    $comanda = Comanda::create($comandaTest);
    $incrementarcomanda = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,   
        'comanda_id' => $comanda->id,
        'familia'  => $familia->id,
    
    ];
    $comandaincrementada = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,
        'producto_id'  => $producto->id,
        'refresco' => 'Solo',
        'cantidad'  => 2,
        'precio'  => 5.00,
        'estado' => 'No enviado',
       
        
    ];
   
        $response = $this->post('/comandas/incrementar', $incrementarcomanda);
            // Verificar que la comanda se haya creado en la base de datos
        $this->assertDatabaseHas('comandas', $comandaincrementada);

        // Verificar que la solicitud sea redirigida a la página adecuada después de crear la comanda (puedes modificar esto según tu aplicación)
       
        $response = $this->get('/comandas/create/1/1/todo');


    }

    public function test_comanda_decrementar(): void
    {
        $this->actingAs(User::factory()->create());
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
        $familiaTest = [
            'nombre' => 'Whisky',
            'combinada' => 0,
        ];
        $familia = Familia::create($familiaTest);

        $productoTest = [
           
           
            'nombre' => 'JB',
            'descripcion'=> 'whisky 40º',
            'precio'=> 6,
            'iva'=> 21,
            'familia_id'=> $familia->id,
            'impresora'=> 'tickets',
        ];
   
        $producto = Producto::create($productoTest);

        $comandaTest = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,
        'producto_id'  => $producto->id,
        'refresco' => 'Solo',
        'cantidad'  => 2,
        'precio'  => 5.00,
        'estado' => 'No enviado',
       
        
    ];
    $comanda = Comanda::create($comandaTest);
    $decrementarcomanda = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,   
        'comanda_id' => $comanda->id,
        'familia'  => $familia->id,
    
    ];
    $comandadecrementada = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,
        'producto_id'  => $producto->id,
        'refresco' => 'Solo',
        'cantidad'  => 1,
        'precio'  => 5.00,
        'estado' => 'No enviado',
       
        
    ];
   
        $response = $this->post('/comandas/decrementar', $decrementarcomanda);
            // Verificar que la comanda se haya creado en la base de datos
        $this->assertDatabaseHas('comandas', $comandadecrementada);

        // Verificar que la solicitud sea redirigida a la página adecuada después de crear la comanda (puedes modificar esto según tu aplicación)
       
        $response = $this->get('/comandas/create/1/1/todo');


    }

    public function test_comanda_incrementarTabla(): void
    {
        $this->actingAs(User::factory()->create());
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
        $familiaTest = [
            'nombre' => 'Whisky',
            'combinada' => 0,
        ];
        $familia = Familia::create($familiaTest);

        $productoTest = [
           
           
            'nombre' => 'JB',
            'descripcion'=> 'whisky 40º',
            'precio'=> 6,
            'iva'=> 21,
            'familia_id'=> $familia->id,
            'impresora'=> 'tickets',
        ];
   
        $producto = Producto::create($productoTest);

        $comandaTest = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,
        'producto_id'  => $producto->id,
        'refresco' => 'Solo',
        'cantidad'  => 1,
        'precio'  => 5.00,
        'estado' => 'No enviado',
       
        
    ];
    $comanda = Comanda::create($comandaTest);
    $incrementarcomanda = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,   
        'comanda_id' => $comanda->id,
        'familia'  => $familia->id,
    
    ];
    $comandaincrementada = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,
        'producto_id'  => $producto->id,
        'refresco' => 'Solo',
        'cantidad'  => 2,
        'precio'  => 5.00,
        'estado' => 'No enviado',
       
        
    ];
   
        $response = $this->post('/comandas/incrementarTabla', $incrementarcomanda);
            // Verificar que la comanda se haya creado en la base de datos
        $this->assertDatabaseHas('comandas', $comandaincrementada);

        // Verificar que la solicitud sea redirigida a la página adecuada después de crear la comanda (puedes modificar esto según tu aplicación)
       
        $response = $this->get('/comandas/pedido/1/1/todo');


    }

    public function test_comanda_decrementarTabla(): void
    {
        $this->actingAs(User::factory()->create());
        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
        $familiaTest = [
            'nombre' => 'Whisky',
            'combinada' => 0,
        ];
        $familia = Familia::create($familiaTest);

        $productoTest = [
           
           
            'nombre' => 'JB',
            'descripcion'=> 'whisky 40º',
            'precio'=> 6,
            'iva'=> 21,
            'familia_id'=> $familia->id,
            'impresora'=> 'tickets',
        ];
   
        $producto = Producto::create($productoTest);

        $comandaTest = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,
        'producto_id'  => $producto->id,
        'refresco' => 'Solo',
        'cantidad'  => 2,
        'precio'  => 5.00,
        'estado' => 'No enviado',
       
        
    ];
    $comanda = Comanda::create($comandaTest);
    $decrementarcomanda = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,   
        'comanda_id' => $comanda->id,
        'familia'  => $familia->id,
    
    ];
    $comandadecrementada = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,
        'producto_id'  => $producto->id,
        'refresco' => 'Solo',
        'cantidad'  => 1,
        'precio'  => 5.00,
        'estado' => 'No enviado',
       
        
    ];
   
        $response = $this->post('/comandas/decrementarTabla', $decrementarcomanda);
            // Verificar que la comanda se haya creado en la base de datos
        $this->assertDatabaseHas('comandas', $comandadecrementada);

        // Verificar que la solicitud sea redirigida a la página adecuada después de crear la comanda (puedes modificar esto según tu aplicación)
       
        $response = $this->get('/comandas/pedido/1/1/todo');


    }

    public function test_eliminar_comanda(): void
    {
        // Autenticar como un usuario (puedes modificar esto según tu lógica de autenticación)
        $this->actingAs(User::factory()->create());

        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
        $familiaTest = [
            'nombre' => 'Whisky',
            'combinada' => 0,
        ];
        $familia = Familia::create($familiaTest);

        $productoTest = [
           
           
            'nombre' => 'JB',
            'descripcion'=> 'whisky 40º',
            'precio'=> 6,
            'iva'=> 21,
            'familia_id'=> $familia->id,
            'impresora'=> 'tickets',
        ];
   
        $producto = Producto::create($productoTest);

        $comandaTest = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,
        'producto_id'  => $producto->id,
        'refresco' => 'Solo',
        'cantidad'  => 2,
        'precio'  => 5.00,
        'estado' => 'No enviado',
       
        
    ];
    $comanda = Comanda::create($comandaTest);

    $Data = [
        'zona_id' => $zona->id,
        'mesa' => 1,
        'familia' => 'todo',     
    ];

        // Hacer una solicitud para eliminar la zona
        $response = $this->post("/comandas/eliminar", $Data);

        // Verificar que la zona se haya eliminado de la base de datos
    
       $this->assertDatabaseMissing('comandas', ['id' => $comanda->id]);

        // Verificar que la solicitud sea redirigida a la página adecuada después de eliminar la zona (puedes modificar esto según tu aplicación)
        $response->assertRedirect('/comandas/create/1/1/todo');
    }

    public function test_eliminar_cuenta(): void
    {
        // Autenticar como un usuario (puedes modificar esto según tu lógica de autenticación)
        $this->actingAs(User::factory()->create());

        $zonaTest = [
            'nombre' => 'Interior',
            'mesas' => 10,
        ];
        $zona = Zona::create($zonaTest);
        $familiaTest = [
            'nombre' => 'Whisky',
            'combinada' => 0,
        ];
        $familia = Familia::create($familiaTest);

        $productoTest = [
           
           
            'nombre' => 'JB',
            'descripcion'=> 'whisky 40º',
            'precio'=> 6,
            'iva'=> 21,
            'familia_id'=> $familia->id,
            'impresora'=> 'tickets',
        ];
   
        $producto = Producto::create($productoTest);

        $comandaTest = [
      
        'mesa' => 1,
        'zona_id'  => $zona->id,
        'producto_id'  => $producto->id,
        'refresco' => 'Solo',
        'cantidad'  => 2,
        'precio'  => 5.00,
        'estado' => 'No enviado',
       
        
    ];
    $comanda = Comanda::create($comandaTest);

    $Data = [
        'zona_id' => $zona->id,
        'mesa' => 1,
        'familia' => 'todo',     
    ];

        // Hacer una solicitud para eliminar la zona
        $response = $this->post("/comandas/eliminar/cuenta", $Data);

        // Verificar que la zona se haya eliminado de la base de datos
    
       $this->assertDatabaseMissing('comandas', ['id' => $comanda->id]);

       
    }

}
