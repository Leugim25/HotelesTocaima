<?php

use App\Pago;
use Illuminate\Database\Seeder;

class PagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pagos = [
            [
                'pago' => 'Efectivo',
            ],
            [
                'pago' => 'Tarjeta de debito',
            ],
            [
                'pago' => 'Tarjeta de credito',
            ]
        ];

        Pago::insert($pagos);
    }
}
