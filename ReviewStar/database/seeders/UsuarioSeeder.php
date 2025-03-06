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
        //Genero el usuario
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
        $usuario->rol = 'USUARIO';
        $usuario->save();

        //Genero el admin
        $adminTroyi = new Usuario();
        $adminTroyi->nombre = 'Alberto';
        $adminTroyi->apellidos = 'Troyano Viñas';
        $adminTroyi->edad = 27;
        $adminTroyi->pais = 'España';
        $adminTroyi->tipo_identificacion = 'DNI';
        $adminTroyi->num_identificacion = '88888888G';
        $adminTroyi->direccion = 'Calle Picasso, 1, 28001, Madrid';
        $adminTroyi->email = 'adminTroyi@gmail.com';
        $adminTroyi->password = Hash::make('adminTroyi');
        $adminTroyi->rol = 'ADMIN';
        $adminTroyi->save();

        //Genero el admin
        $adminJonay = new Usuario();
        $adminJonay->nombre = 'Jonay';
        $adminJonay->apellidos = 'Aguilar Menéndez';
        $adminJonay->edad = 19;
        $adminJonay->pais = 'España';
        $adminJonay->tipo_identificacion = 'DNI';
        $adminJonay->num_identificacion = '77777777E';
        $adminJonay->direccion = 'Calle Picasso, 1, 28001, Madrid';
        $adminJonay->email = 'adminJonay@gmail.com';
        $adminJonay->password = Hash::make('adminJonay');
        $adminJonay->rol = 'ADMIN';
        $adminJonay->save();

        //Genero el admin
        $adminKoke = new Usuario();
        $adminKoke->nombre = 'Koke';
        $adminKoke->apellidos = 'Millán Estévez';
        $adminKoke->edad = 32;
        $adminKoke->pais = 'España';
        $adminKoke->tipo_identificacion = 'DNI';
        $adminKoke->num_identificacion = '66666666E';
        $adminKoke->direccion = 'Calle Picasso, 1, 28001, Madrid';
        $adminKoke->email = 'adminKoke@gmail.com';
        $adminKoke->password = Hash::make('adminKoke');
        $adminKoke->rol = 'ADMIN';
        $adminKoke->save();
    }
}
