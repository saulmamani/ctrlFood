<?php

use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'categoria' => 'Comida',
                'nombre' => 'Pollo a la brasa 1/8',
                'precio' => '15',
                'fotografia' => 'pollo_1.jpg'
            ],
            [
                'categoria' => 'Comida',
                'nombre' => 'Pollo a la brasa 1/4',
                'precio' => '20',
                'fotografia' => 'pollo_2.jpeg'
            ], 
            [
                'categoria' => 'Bebida',
                'nombre' => 'Coca cola 2 litros.',
                'precio' => '12',
                'fotografia' => 'cocacola.jpg'
            ], 
            [
                'categoria' => 'Bebida',
                'nombre' => 'Inka cola 1/2 litros',
                'precio' => '15',
                'fotografia' => 'inkacola.jpg'
            ], 
        ]);
    }
}
