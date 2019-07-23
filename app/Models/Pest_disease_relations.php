<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pest_disease_relations extends Model
{
	protected $fillable = [
		'item_id', 'item_type', 'pest_disease_type', 'pest_disease_id'
	];
    //
}
