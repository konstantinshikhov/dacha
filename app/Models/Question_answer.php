<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question_answer extends Model
{
	protected $fillable = [
		'question_id',
		'user_id',
		'text',
		'date',
		'is_best',
		'moderator'
	];
    //
}
