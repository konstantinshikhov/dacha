<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease_chemical extends Model
{
	protected $fillable = ['disease_id', 'chemical_id'];

    public function diseases(){
        return $this->belongsTo(Disease::class);
    }
    public function chemicals(){
        return $this->belongsTo(Chemical::class);
    }
}
