<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name', 'title', 'text'];

    public function getPhotoAttribute($value)
    {
        $file = public_path() .'/uploads/sections/'. $value;
        return is_file($file) ? env('APP_URL') . '/public/uploads/sections/' . $value : null;
    }
    public function cultures(){
        return $this->hasMany(Culture::class);
    }
    public function sorts(){
        return $this->hasMany(Sort::class);
    }

}
