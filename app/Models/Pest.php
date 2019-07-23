<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pest extends Model
{
    protected $fillable = ['culture_id', 'section_id', 'name', 'slug', 'main_photo', 'description', 'fight', 'date'];

    public function filter_attributes()
    {
        return $this->hasMany('App\Models\Filter_attr_entity','entity_id','id')
            ->where('entity_type', 'pest')
            //->select('attribute_value')
            ;
    }



    public function pest_chemical(){
        return $this->hasMany(Pest_chemical::class);
    }
    public function pest_photo(){
        return $this->hasMany(Pest_photo::class);
    }




}
