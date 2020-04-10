<?php

use Illuminate\Database\Seeder;

class UsersSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'luas0_1@yahoo.es',
                'password' => \Hash::make('654321'),
                'rol' => 'Administrador',
                'name' => 'Saul Mamani M.',
                'fotografia' => 'foto_base.png',
            ],
            [
                'email' => 'lidia@yahoo.es',
                'password' => \Hash::make('123456'),
                'rol' => 'Vendedor',
                'name' => 'Lidia Marce Barrios',
                'fotografia' => 'foto_base.png',
            ],
        ]);
    }
}
