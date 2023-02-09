<?php

namespace Database\Seeders;

use App\Models\Situacao;
use Illuminate\Database\Seeder;

class SituacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $situacoes = [
            ['nm_situacao' => 'Pendente'],
            ['nm_situacao' => 'Confirmado'],
            ['nm_situacao' => 'Cancelado'],
        ];

        foreach ($situacoes as $situacao) {
            Situacao::create($situacao);
        }
    }
}
