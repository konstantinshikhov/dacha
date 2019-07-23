<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sort_characteristic extends Model
{
	protected $fillable = ['name', 'icon_path'];

    public function sort_charact_relation(){
        return $this->hasMany(Sort_charact_relation::class);
    }
}
