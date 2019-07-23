<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handbook extends Model
{
	protected $fillable = [
		'title',
		'description',
		'full_description',
		'main_photo',
		'section_id',
		'category_id',
		'culture_id',
		'date',
		'comments_count',
		'user_id'
	];
    public $timestamps = false;
}
