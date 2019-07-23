<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handbook_videolinks extends Model
{
	protected $fillable = [
		'handbook_id',
		'title',
		'link',
		'user_id',
		'moderator'
	];
    //
}
