<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategotiasSeederHotel::class);

        $this->call(UsuariosSeeder::class);

        $this->call(DisponibilidadHabitacionSeeder::class);

        $this->call(PagosSeeder::class);

        $this->call(PreciosSeeder::class);
    }
}
