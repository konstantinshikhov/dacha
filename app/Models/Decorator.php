<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decorator extends Model
{
    protected $table = 'decorator';

    protected $fillable = [
        'id',
        'emblem',
        'cost',
        'slider',
        'user_id'
    ];


    protected $casts = [
        'slider' => 'array',
    ];

}
