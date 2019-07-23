<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizatorInfo extends Model
{
    protected $table = 'organizator_info';

    protected $fillable = [
        'id',
        'emblem',
        'is_avatar',
        'about',
        'user_id'
    ];

}
