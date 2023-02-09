<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Seeder;

class TiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            ['nm_tipo' => 'Usuário'],
            ['nm_tipo' => 'Projeto'],
            ['nm_tipo' => 'Administrador'],
        ];

        foreach ($tipos as $tipo) {
            Tipo::create($tipo);
        }
    }
}
