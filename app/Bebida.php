<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bebida extends Model
{
    protected $fillable = [ 
        'nome', 'preco', 'foto', 'categoria'
    ];

    const PREMIUM = 0;
    const GERAL = 1;

    const CATEGORIA_BEBIBAS = [
        self::PREMIUM => 'Cervejas Premium',
        self::GERAL => 'Bebidas em Geral'
    ];
}
