<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{
    use HasFactory;

    // Necessário custom name
    protected $table = "publicacoes";

    protected $fillable = [
        'id_tipo', 'id_usuario','titulo', 'descricao', 'nm_imagem','path_imagem','dt_inicio', 'dt_fim','ativo'
    ];
}
