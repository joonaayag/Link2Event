<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concierto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 
        'fecha', 
        'hora', 
        'lugar', 
        'ciudad', 
        'genero', 
        'precio', 
        'imagen', 
        'url'
    ];
}