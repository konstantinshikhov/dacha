<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
	protected $fillable = ['user_id', 'item_id', 'type', 'text', 'rating', 'date', 'moderator'];

  //  public function sort_responses_answers(){
 //       return $this->hasMany(Responses_answer::class);
 //   }

}
