<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $fillable = [
		'user_id',
		'section_id',
		'title',
		'text',
		'date',
		'time',
		'comments_count',
		'moderator',
		'is_closed'
	];
    //
}
