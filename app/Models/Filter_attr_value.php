<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filter_attr_value extends Model
{
    public $timestamps = false;
    protected $fillable = ['attribute_id', 'attribute_value'];
}
