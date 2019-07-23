<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $fillable = [
		'user_id',
		'partymaker',
		'title',
		'date',
		'event_category_id',
		'description',
		'participants',
		'main_photo'
	];
    //
}
