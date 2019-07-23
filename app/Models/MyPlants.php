<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyPlants extends Model
{
    protected $table = 'my_plants';

    protected $fillable = [
        'id',
        'user_id',
        'plant_id',
    ];


    public static function getCountPlantsUser(){
        return self::where('user_id',(new User())->getUserId() )->count();
    }
}