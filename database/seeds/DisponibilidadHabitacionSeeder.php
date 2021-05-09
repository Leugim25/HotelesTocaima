<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisponibilidadHabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('disponibilidad_habitacion')->insert([
            'estado' => 'Disponible',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('disponibilidad_habitacion')->insert([
            'estado' => 'Ocupada',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('disponibilidad_habitacion')->insert([
            'estado' => 'Reservada',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('disponibilidad_habitacion')->insert([
            'estado' => 'En espera',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('disponibilidad_habitacion')->insert([
            'estado' => 'Cancelada',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
