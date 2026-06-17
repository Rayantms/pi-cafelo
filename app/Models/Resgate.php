<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resgate extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'resgates';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'cliente_id',
        'produto_id',
        'pontos_utilizados',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
