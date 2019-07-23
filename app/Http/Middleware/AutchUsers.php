<?php
/**
 * Created by PhpStorm.
 * User: speel
 * Date: 28.01.2019
 * Time: 20:12
 */

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Models\User;


class AutchUsers
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $aToken = $request->session()->get('aToken');
        $user = User::where('remember_token', hash('sha256', $aToken))->first();

        if($user && $user->role == 'u') {
            return $next($request);
        }

        return redirect()->action('FrontController@login');

        // foreach(User::all()->where('role', 'a') as $aUser) {
        //     if(\Hash::check($aToken, $aUser->remember_token)) {
        //         return $next($request);
        //     }
        // }

        // return redirect()->action('HomeController@index');
    }
}