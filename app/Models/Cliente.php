<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'clientes';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'saldo_pontos',
    ];
}
