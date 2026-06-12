<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'produtos';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'pontos_compra',
        'pontos_resgate',
        'imagem',
    ];
}
