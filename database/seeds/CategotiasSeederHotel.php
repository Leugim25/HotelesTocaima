<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategotiasSeederHotel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_hoteles')->insert([
            'nombre' => 'Alojamiento básico',
            'descripcion' => 'Habitaciones con 1 o máximo 2 camas, mobiliario básico con camas, ventilador, mesa de noche, productos de aseo (jabón de cuerpo, toalla y shampoo).',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_hoteles')->insert([
            'nombre' => 'Alojamiento estandar',
            'descripcion' => 'Habitación con 1 o 2 camas, mobiliario con camas, mesa de noche, lamparás, ventilador o aire acondicionado, televisión mínima de 21 pulgadas con servicio de tv cable local o satelital, servicio de internet (opcional), productos de aseo (jabón de baño, jabón de manos, shampoo, acondicionador, toalla del cuerpo, toalla de mano) servicio de restaurante, piscina o jacuzzi (si cuentan con ello).',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_hoteles')->insert([
            'nombre' => 'Alojamiento superior',
            'descripcion' => 'Habitación con un máximo predeterminado por el hotel, mobiliario con camas, mesa de noche, closet o guarda ropas, televisión mínima de 21 pulgadas con televisión satelital y servicio de wifi, implementos de aseo (toallas, jabón de mano, jabón de cuerpo, toalla de mano, toallas extra) servicio de mini bar con nevera con todos sus productos, servicio de Restaurante con menú especializado, servicio de jacuzzi o piscina, servicio al cuarto y servicio de bar.',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]); 
    }
}
