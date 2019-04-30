<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calibre extends Model
{
    protected $table = 'calibre';
    protected $primarykey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'descricao',
        'isActive'
    ];

    protected $guarded = [
        
    ];
}
