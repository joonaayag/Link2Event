<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained()->onDelete('cascade');
            $table->string('id_evento');
            $table->string('nombre');
            $table->timestamp('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->string('lugar')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('estado')->nullable();
            $table->string('pais')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('url_imagen')->nullable();
            $table->decimal('precio_minimo', 8, 2)->nullable();
            $table->decimal('precio_maximo', 8, 2)->nullable();
            $table->string('url_ticketmaster')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};
