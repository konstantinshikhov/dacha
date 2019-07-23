<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sort_photos extends Model
{
    public function sorts(){
        return $this->belongsTo(Sort::class);
    }
}
