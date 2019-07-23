<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	protected $fillable = [
		'from',
		'to',
		'type',
		'text',
		'topic',
		'item_type',
		'item_id',
		'is_read'
	];
    //
}
