<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileIcon extends Model
{
    use HasFactory;

    // Necessário custom name
    protected $table = "profileicons";

    protected $fillable = [
        'nm_icon', 'ativo' 
    ];
}
