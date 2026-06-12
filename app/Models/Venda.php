<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'valor_total',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vincularCliente(Cliente $cliente)
    {
        $this->cliente()->associate($cliente);
        $this->save();

        return $this;
    }

    public function itens()
    {
        return $this->hasMany(ItemVenda::class, 'venda_id');
    }
}
