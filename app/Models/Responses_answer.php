<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responses_answer extends Model
{
	protected $fillable = ['response_id', 'user_id', 'profile_id', 'response', 'date', 'moderator'];
//    public function sort_response(){
//        return $this->belongsTo(Response::class);
//    }
}
