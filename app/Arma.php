<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arma extends Model
{
    protected $table = 'arma';
    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'numeroSerie',        
        'idSituacao',
        'idModelo'
    ];

    protected $guarded = [
        
    ];
}
