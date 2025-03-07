<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteEventsTable extends Migration
{
    public function up()
    {
        Schema::create('favorite_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade'); // Relación con la tabla users
            $table->string('event_id')->index(); // Índice para mejorar búsquedas
            $table->string('event_name');
            $table->string('event_image')->nullable();
            $table->dateTime('event_date')->nullable(); // Mejor que string para fechas
            $table->string('event_venue')->nullable();
            $table->string('event_city')->nullable();
            $table->string('event_genre')->nullable();
            $table->string('event_url')->nullable();
            $table->timestamps();

            // Evitar que un usuario guarde el mismo evento dos veces
            $table->unique(['user_id', 'event_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorite_events');
    }
}
