<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filter_attributes extends Model
{
    protected $fillable = ['section_id', 'culture_id', 'type', 'name'];
    
    public $timestamps = false;

    public function attr_values()
    {
        return $this->hasMany('App\Models\Filter_attr_value','attribute_id','id');
    }

}
