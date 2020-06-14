<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lanche extends Model
{
    protected $fillable = ['nome', 'preco', 'descricao', 'categoria', 'foto', ];

    const ENTRADA = 0;
    const ESPECIAIS = 1;
    const CHEFE = 2;
    const TRADICIONAL = 3;

    const CATEGORIA_LANCHES = [
        self::ENTRADA => 'Entradas e saladas',
        self::ESPECIAIS => 'Lanches Especiais',
        self::CHEFE => 'Burgers do chefe',
        self::TRADICIONAL => 'Lanches Tradicionais'
    ];
}
