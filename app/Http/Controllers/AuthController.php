<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use App\Mail\PasswordForgotMail;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Profile;
use App\Models\PasswordResets;
use App\Models\User_entrance;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',
            ['except' =>
                [
                    'login',
                    'register',
                    'forgotPassword',
                    'resetPassword'
                ]
            ]);
    }

    /**
     * @SWG\Post(
     *     path="/auth/login",
     *     operationId="Auth",
     *     description="Auth",
     *     summary="Login user",
     *     produces={"application/json"},
     *     tags={"Auth"},
     *     @SWG\Parameter(name="email", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="password", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized",
     *     )
     * )
     */
    public function login()
    {
        $errors = Validator::make(request()->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ])->errors();

        if (count($errors)) {
            return response([
                'success' => false,
                'errors' => $errors
            ], 401);
        }


        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user=auth()->user();
        $user_role=$user->role;

        if($user_role=='b'){
            auth()->logout();
            return response()->json(['message' => 'User banned']);
        }

        $user_id = $user['id'];
        $profile=Profile::where('user_id', $user_id)->first();
        if(!$profile){
            $profile=new Profile;
            $profile->user_id=$user_id;
            $profile->first_name="Имя";
            $profile->last_name="Фамилия";
            $profile->save();
        }



        $current_day = date('Y-m-d');

        $current_entrance = User_entrance::where('date',$current_day)
            ->where('user_id', '=', $user_id)
            ->get();
        $count=$current_entrance->count();
        if ($count==0){
            $user_entrance=new User_entrance;
            $user_entrance->user_id=$user_id;
            $user_entrance->date=$current_day;
            $user_entrance->save();
        }
        //check tariff
        $profile=Profile::where('user_id', $user->id)
            ->first();
        if($profile->tariff_id>1){
            if($profile->tariff_end<date('Y-m-d')){
                $profile->tariff_id=1;
                $profile->tariff_end='3000-01-20';
                $profile->save();
            }
        }
        return $this->respondWithToken($token);
    }

    /**
     * @SWG\Post(
     *     path="/auth/register",
     *     operationId="Register",
     *     description="Register",
     *     summary="Register user",
     *     produces={"application/json"},
     *     tags={"Auth"},
     *     @SWG\Parameter(name="first_name", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="last_name", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="email", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="password", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="password_confirmation", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function register()
    {
        $errors = Validator::make(request()->all(), [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ])->errors();

        if (count($errors)) {
            return response([
                'success' => false,
                'errors' => $errors
            ], 401);
        }

        $user = User::create([
            'email' => request()->get('email'),
            'password' => Hash::make(request()->get('password')),
        ]);

        Profile::create([
            'first_name' => request()->get('first_name'),
            'last_name' => request()->get('last_name'),
            'user_id' => $user->id,
        ]);

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'errors' => 'Unauthorized user'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user' => auth()->user()->load('profile'),
            'token' => $this->respondWithToken($token),
            'errors' => false
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/auth/logout",
     *     operationId="Logged out",
     *     description="Logged out",
     *     summary="Logged out",
     *     produces={"application/json"},
     *     tags={"Auth"},
     *     security={{"access_token":{}}},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @SWG\Post(
     *     path="/auth/refresh",
     *     operationId="Refresh",
     *     description="Refresh",
     *     summary="Refresh",
     *     produces={"application/json"},
     *     tags={"Auth"},
     *     security={{"access_token":{}}},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * @SWG\Post(
     *     path="/auth/change-password",
     *     operationId="Change password",
     *     description="Change password",
     *     summary="Change password",
     *     produces={"application/json"},
     *     tags={"Auth"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="current_password", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="new_password", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="new_password_confirmation", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function changePassword()
    {
        $errors = Validator::make(request()->all(), [
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ])->errors();

        if (count($errors)) {
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => $errors
            ], 400);
        }

        $currentPassword = auth()->user()->password;

        if (Hash::check(request()->get('current_password'), $currentPassword)) {
            $user = User::find(auth()->user()->id);
            $user->password = Hash::make(request()->get('new_password'));
            $user->save();

            return response()->json([
                'success' => true,
                'success-message' => [
                    'Password change!'
                ],
                'errors-message' => []
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => [
                    'Current password is wrong!'
                ]
            ], 400);
        }
    }

    /**
     * @SWG\Post(
     *     path="/auth/forgot-password",
     *     operationId="Forgot password",
     *     description="Forgot password",
     *     summary="Forgot password",
     *     produces={"application/json"},
     *     tags={"Auth"},
     *     @SWG\Parameter(name="email", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function forgotPassword()
    {

        $errors = Validator::make(request()->all(), [
            'email' => 'required|email|max:255',
        ])->errors();




        if (count($errors)) {
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => $errors
            ], 400);
        }


        $user = User::where('email', request()->get('email'))->first();
//
//        if ($user) {
//            $token = Password::getRepository()->create($user);
//            $url = url(config('app.front_url') . '/password/reset/' . $token);
//            Mail::to($user->email)->send(new PasswordForgotMail($url));
//            return response()->json([
//                'success' => true,
//                'success-message' => [
//                    'Send email!'
//                ],
//                'errors-message' => []
//            ], 200);
//        } else {
//            return response()->json([
//                'success' => false,
//                'success-message' => [],
//                'errors-message' => [
//                    'Not send email!'
//                ]
//            ], 400);
//        }


        if ($user) {
            $url = url(config('app.front_url') . '/login');
            $hashed_random_password = str_random(15);
            $user->password= Hash::make($hashed_random_password);
            $user->save();
            Mail::to($user->email)->send(new PasswordForgotMail($url, $hashed_random_password));
            return response()->json([
                'success' => true,
                'success-message' => [
                    'Send email!'
                ],
                'errors-message' => []
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => [
                    'Not send email!'
                ]
            ], 400);
        }
    }

    /**
     * @SWG\Post(
     *     path="/auth/reset-password",
     *     operationId="Reset password",
     *     description="Reset password",
     *     summary="Reset password",
     *     produces={"application/json"},
     *     tags={"Auth"},
     *     @SWG\Parameter(name="email", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="password", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="password_confirmation", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="token", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function resetPassword()
    {
        $errors = Validator::make(request()->all(), [
            'password' => 'required|confirmed|min:6',
        ])->errors();

        if (count($errors)) {
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => $errors
            ], 400);
        }

        $reset = PasswordResets::where('email', request()->get('email'))->first();

        if($reset) {
            if(Hash::check(request()->get('token'), $reset->token)) {
                $user = User::where('email', request()->get('email'))->first();
                $user->password = Hash::make(request()->get('password'));
                $user->save();
                $reset->delete();

                Mail::to($user->email)->send(new PasswordResetMail($user));

                return response()->json([
                    'success' => true,
                    'success-message' => [
                        'Password reset!'
                    ],
                    'errors-message' => []
                ], 200);
            }
        }

        return response()->json([
            'success' => false,
            'success-message' => [],
            'errors-message' => [
                'Invalid token or email or expired code!'
            ]
        ], 400);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => 'Bearer ' . $token,
            'token_type' => 'bearer',
            //'expires_in' => auth()->factory()->getTTL() * 60000
        ]);
    }
}
