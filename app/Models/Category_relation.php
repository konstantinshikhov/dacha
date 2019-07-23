<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_relation extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['type', 'target_id', 'target_category'];
}
