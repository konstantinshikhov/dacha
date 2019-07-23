<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pest_chemical extends Model
{
	protected $fillable = ['pest_id', 'chemical_id'];

    public function pests(){
        return $this->belongsTo(Pest::class);
    }
    public function chemicals(){
        return $this->belongsTo(Chemical::class);
    }
}
