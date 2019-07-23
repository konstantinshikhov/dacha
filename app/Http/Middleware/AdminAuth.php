<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

use App\Models\User;

class AdminAuth
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $aToken = $request->session()->get('aToken');
        $user = User::where('remember_token', hash('sha256', $aToken))->first();

        if($user && $user->role == 'a') {
            return $next($request);
        }

        return redirect()->action('HomeController@index');

        // foreach(User::all()->where('role', 'a') as $aUser) {
        //     if(\Hash::check($aToken, $aUser->remember_token)) {
        //         return $next($request);
        //     }
        // }

        // return redirect()->action('HomeController@index');
    }
}
