<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    protected $fillable = [
        'name',
        'countsort',
        'slug',
        'section_id',
    ];

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function sorts(){
        return $this->hasMany(Sort::class);
    }


}
