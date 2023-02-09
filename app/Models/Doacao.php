<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    use HasFactory;

    // Necessário custom name
    protected $table = "doacoes";

    protected $fillable = [
        'id_usuario', 'id_publicacao','id_status'
    ];
}