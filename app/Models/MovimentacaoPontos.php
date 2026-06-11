<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentacaoPontos extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'movimentacoes_pontos';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'cliente_id',
        'tipo',
        'pontos',
        'descricao',
    ];
}
