<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $fillable = ['title', 'text', 'section_id','type', 'target_id'];
}
