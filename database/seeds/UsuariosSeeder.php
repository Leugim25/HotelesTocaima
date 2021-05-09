<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Miguel Alejandro Ibañez Moreno',
            'email' => 'miguel@correo.com',
            'password' => Hash::make('123456789'),
            'is_admin' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Luis Alejandro Sanabria Sandoval',
            'email' => 'luis@correo.com',
            'password' => Hash::make('123456789'),
            'is_admin' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'El admin 1',
            'email' => 'admin@correo.com',
            'password' => Hash::make('123456789'),
            'is_admin' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //DB::table('users')->insert([
        //'name' => 'Luis Alejandro Sanabria Sandoval',
        //'email' => 'sanabria@correo.com',
        //'password' => Hash::make('123456789luis'),
        //'created_at' => date('Y-m-d H:i:s'),
        //'updated_at' => date('Y-m-d H:i:s'),
        //]);

        //DB::table('users')->insert([
        //'name' => 'Lina Doncel Ramos',
        //'email' => 'lina@correo.com',
        //'password' => Hash::make('123456789lina'),
        //'created_at' => date('Y-m-d H:i:s'),
        //'updated_at' => date('Y-m-d H:i:s'),
        //]);
    }
}
