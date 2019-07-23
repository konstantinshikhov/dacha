<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handbook_photo extends Model
{
	protected $fillable = [
		'handbook_id',
		'path',
		'is_main'
	];
    //
}
