<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sort extends Model
{
	protected $fillable = [
		'name',
		'slug',
		'vendor_code',
		'content',
		'main_photo',
		'section_id',
		'culture_id',
		'rating',
		'is_new',
		'merchantability',
		'created',
	];

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function sort_charact_relation(){
        return $this->hasMany(Sort_charact_relation::class);
    }
}
