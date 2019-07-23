<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sort_charact_relation extends Model
{
	protected $fillable = ['sort_id', 'characteristic_id', 'order', 'value'];
	
    public function sort_characteristic(){
        return $this->belongsTo(Sort_characteristic::class);
    }
    public function sort(){
        return $this->belongsTo(Sort::class);
    }
}
