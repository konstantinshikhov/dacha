<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'current_role',
        'phone',
        'birthday',
        'address',
        'photo',
        'site',
        'social_vkotakte',
        'social_facebook',
        'social_odnoklasniki',
        'social_twitter',
        'social_instagram',
        'social_youtube',
        'about_me',
        'is_seller',
        'comment_seller',
        'about_me_seller',
        'inn_seller',
        'kpp_seller',
        'r_s_seller',
        'is_decorator',
        'min_price_decorator',
        'max_price_decorator',
        'about_me_decorator',
        'nickname',
        'user_id',
    ];

    public function getPhotoAttribute($value)
    {
        $file = public_path() .'/uploads/photos/'. $value;
        return is_file($file) ? env('APP_URL') . '/public/uploads/photos/' . $value : null;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function currentRole($id)
    {
        $userRole = Profile::where('user_id', $id)->first();
        return $userRole ? $userRole->current_role: 'U';
    }

    public function isSeller($id)
    {
        if ($id) {
            $userRole = Profile::where('user_id', $id)->first();
            return $userRole->is_seller;
        } else {
            return 0;
        }

    }

    public function isDecorator($id)
    {
        if ($id) {
            $userRole = Profile::where('user_id', $id)->first();
            return $userRole->is_decorator;
        } else {
            return 0;
        }

    }

    public function isPartymaker($id)
    {
        if ($id) {
            $userRole = Profile::where('user_id', $id)->first();
            return $userRole->is_partymaker;
        } else {
            return 0;
        }

    }
}
