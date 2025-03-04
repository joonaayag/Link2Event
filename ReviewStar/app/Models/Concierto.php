<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concierto extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'nombre',
        'fecha',
        'hora',
        'lugar',
        'ciudad',
        'imagen',
        'genero',
        'precio',
    ];
}