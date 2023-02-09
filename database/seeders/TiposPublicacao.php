<?php

namespace Database\Seeders;

use App\Models\Tipo_Publicacao;
use Illuminate\Database\Seeder;

class TiposPublicacao extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos_publicacoes = [
            ['nm_tipo' => 'Pix'],
            ['nm_tipo' => 'Entrega'],
            ['nm_tipo' => 'Ambos'],
        ];

        foreach ($tipos_publicacoes as $tipo) {
            Tipo_Publicacao::create($tipo);
        }
    }
}
