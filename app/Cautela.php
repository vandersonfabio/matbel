<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cautela extends Model
{
    protected $table = 'cautela';
    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'data',
        'validade',
        'qtdMunicao',
        'qtdCarregador',
        'observacao',
        'idArma',
        'isOpen',
        'idRequerente',
        'idSignatario'
    ];

    protected $guarded = [
        
    ];
}
