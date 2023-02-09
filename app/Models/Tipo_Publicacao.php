<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Publicacao extends Model
{
    use HasFactory;

    // Necessário custom name
    protected $table = "tipos_publicacao";

    protected $fillable = [
        'nm_tipo',
    ];
}
