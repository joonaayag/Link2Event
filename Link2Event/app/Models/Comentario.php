<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    
    protected $fillable = ['id_usuario', 'nombre_usuario','email_usuario', 'comentario'];
    
    public function user()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}