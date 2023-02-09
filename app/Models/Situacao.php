<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    use HasFactory;

    // Necessário custom name
    protected $table = "situacoes";

    protected $fillable = [
        'nm_situacao',
    ];
}
