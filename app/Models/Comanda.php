<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    use HasFactory;
    protected $fillable = [
        'mesa',
        'zona_id',
        'producto_id',
        'cantidad',
        'estado',
    ];
}
