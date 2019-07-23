<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sort_ques_general_info extends Model
{
	protected $fillable = [
		'user_id',
		'region',
		'locality',
		'soil',
		'high',
		'precipitation'
	];
    //
}
