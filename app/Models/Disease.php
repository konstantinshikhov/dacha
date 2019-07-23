<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
	protected $fillable = ['culture_id', 'section_id', 'name', 'slug', 'main_photo', 'description', 'fight', 'date'];

    public function disease_chemical(){
        return $this->hasMany(Disease_chemical::class);
    }
    public function disease_photo(){
        return $this->hasMany(Disease_photo::class);
    }
}
