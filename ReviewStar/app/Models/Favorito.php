<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;
    protected $fillable = [
        'usuario_id',
        'id_evento',
        'nombre',
        'fecha',
        'hora',
        'lugar',
        'direccion',
        'ciudad',
        'estado',
        'pais',
        'descripcion',
        'url_imagen',
        'precio_minimo',
        'precio_maximo',
        'url_ticketmaster',
    ];

    //Hago la relacion de uno a muchos (un favorito pertenece a un usuario)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
