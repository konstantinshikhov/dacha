<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_delivery_method extends Model
{
    protected $fillable = [
        'user_id',
        'method_id'
    ];
}
