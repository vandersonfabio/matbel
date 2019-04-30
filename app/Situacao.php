<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    protected $table = 'situacao';
    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'isActive'
    ];

    protected $guarded = [
        
    ];
}
