<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuario = new Usuario();
        $usuario->nombre = 'Amador';
        $usuario->apellidos = 'Rivas Vilchez';
        $usuario->edad = 45;
        $usuario->pais = 'España';
        $usuario->tipo_identificacion = 'DNI';
        $usuario->num_identificacion = '12345638G';
        $usuario->direccion = 'Calle Picasso, 1, 28001, Madrid';
        $usuario->email = 'amador@gmail.com';
        $usuario->password = Hash::make('Password');
        $usuario->save();

    }
}
