<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;



    public function __construct(array $attributes = [])
    {
        set_error_handler(null);
        set_exception_handler(null);
        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function isAdmin()
    {
        return $this->getAttribute('role') === 'a';
    }

    public function getUserId()
    {
        $aToken = session()->get('aToken');

        if ($aToken){
            $user = User::where('remember_token', hash('sha256', $aToken))->first();
            return $user->id;
        } else {
            return '';
        }


    }
}
