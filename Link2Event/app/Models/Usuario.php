<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'edad',
        'pais',
        'tipo_identificacion',
        'num_identificacion',
        'direccion',
        'email',
        'foto_perfil',
        'password',
    ];

    /**
     * Los atributos que deben ocultarse en la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben convertirse a otros tipos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function favoriteEvents()
    {
        return $this->hasMany(FavoriteEvent::class, 'user_id');
    }
    
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_usuario');
    }

}
