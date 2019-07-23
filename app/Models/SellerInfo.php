<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerInfo extends Model
{
    protected $table = 'seller_info';

    protected $fillable = [
        'id',
        'name',
        'is_avatar',
        'is_shop',
        'emblem',
        'place',
        'delivery_method',
        'user_id',
    ];

    protected $casts = [
        'place' => 'array',
        'delivery_method' => 'array'
    ];


}
