<?php

namespace Database\Seeders;

use App\Models\Comentario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // protected $fillable = ['id_usuario', 'nombre_usuario','email_usuario', 'comentario'];
        $comentario = new Comentario();
        $comentario->id_usuario = 1;
        $comentario->nombre_usuario = 'Amador';
        $comentario->email_usuario = 'amador@gmail.com';
        $comentario->comentario = 'Acabo de ver el partido de baloncesto en el WiZink Center y ha sido IN-CRE-I-BLE!!!';
        $comentario->save();

        $comentario2 = new Comentario();
        $comentario2->id_usuario = 1;
        $comentario2->nombre_usuario = 'Amador';
        $comentario2->email_usuario = 'amador@gmail.com';
        $comentario2->comentario = 'Conseguí ver a Lebron James en primera fila.';
        $comentario2->save();
        
        $comentario3 = new Comentario();
        $comentario3->id_usuario = 2;
        $comentario3->nombre_usuario = 'Paco';
        $comentario3->email_usuario = 'paco@gmail.com';
        $comentario3->comentario = 'El espectáculo de luces y sonido me pareció impresionante.';
        $comentario3->save();
        
        $comentario4 = new Comentario();
        $comentario4->id_usuario = 2;
        $comentario4->nombre_usuario = 'Paco';
        $comentario4->email_usuario = 'paco@gmail.com';
        $comentario4->comentario = 'Me encantó la variedad de aperitivos que ofrecían en el estadio.';
        $comentario4->save();
        
        $comentario5 = new Comentario();
        $comentario5->id_usuario = 3;
        $comentario5->nombre_usuario = 'Julián';
        $comentario5->email_usuario = 'julian@gmail.com';
        $comentario5->comentario = 'La organización del evento fue impecable, enhorabuena al equipo de Link 2 event.';
        $comentario5->save();

        $comentario6 = new Comentario();
        $comentario6->id_usuario = 3;
        $comentario6->nombre_usuario = 'Julián';
        $comentario6->email_usuario = 'julian@gmail.com';
        $comentario6->comentario = 'Me pareció genial que tuvieran zonas de descanso en el estadio, fue un gran acierto.';
        $comentario6->save();
    }
}
