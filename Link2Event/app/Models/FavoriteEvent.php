<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'event_name',
        'event_image',
        'event_date',
        'event_venue',
        'event_city',
        'event_genre',
        'event_url'
    ];

    // Relación con el usuario
    public function user()
{
    return $this->belongsTo(Usuario::class, 'user_id');
}
}
