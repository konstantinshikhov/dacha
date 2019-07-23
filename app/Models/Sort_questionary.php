<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Sort_questionary extends Model
{
    protected $table = 'sort_questionaries';
	protected $fillable = [
		'user_id',
		'general_info_id',
		'sort_id',
		'generation',
		'landing_area',
		'seeding_date',
		'cultivation_type',
		'ground_transplantation_date',
		'trimming_date',
		'is_ill',
		'artificial_irrigation',
		'drip_irrigation',
		'precipitation_from_planting',
		'feeding_from_planting',
		'artificial_irrigation_from_planting',
		'harvest'
	];

	public static function getCountQuestionary(){
	   // die();
	    return self::where('user_id',(new User())->getUserId() )->count();
      //  return 4;
    }
    //
}
