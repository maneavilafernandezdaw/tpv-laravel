<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use App\Models\Familia;

abstract class TestFamilia extends BaseTestCase
{

    public function test_family_creation()
    {
        $familia = Familia::create(['name' => 'Italian', 'is_combined' => false]);
        
        $this->assertInstanceOf(Familia::class, $familia);
        $this->assertEquals('Italian', $familia->name);
        $this->assertFalse($familia->is_combined);
    }

    public function test_family_update()
    {
        $familia = Familia::create(['name' => 'Italian', 'is_combined' => false]);
        
        $familia->update(['name' => 'Japanese', 'is_combined' => true]);
        
        $this->assertEquals('Japanese', $familia->fresh()->name);
        $this->assertTrue($familia->fresh()->is_combined);
    }

    public function test_family_deletion()
    {
        $familia = Familia::create(['name' => 'Italian', 'is_combined' => false]);
        
        $familia->delete();
        $this->assertFalse($familia);
        
    }
}

