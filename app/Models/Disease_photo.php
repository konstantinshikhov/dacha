<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease_photo extends Model
{
    public function disease(){
        return $this->belongsTo(Disease::class);
    }
}
