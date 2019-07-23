<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moon_action extends Model
{
	protected $fillable = [
		'phase_type', 'element', 'plant_attribute', 'sort_operation_id', 'value'
	];
    //
}
