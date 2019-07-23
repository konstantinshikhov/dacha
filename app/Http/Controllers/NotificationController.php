<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Profile;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class NotificationController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/notification/index",
     *     operationId="Show notification",
     *     description="Show notification",
     *     summary="Show notification",
     *     produces={"application/json"},
     *     tags={"Notification"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="type", required=false, description="1 message, 2 comment, 3- order, 4- support", in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index(Request $request)
    {
        $itemsPerPage=20;
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authorizated',
            ], 400);
        }
        //select notifications
        $this->validate($request, [
            'page' => 'integer',
            'type' => 'integer',
        ]);
        $take=$itemsPerPage;
        $skip=0;
        if($request->input('page')){
            $skip=($request->input('page')-1)*$itemsPerPage;
        }
        $filter='%';
        if($request->input('type')){
            if ($request->input('type')=='1'){
                $filter='message';
            }else if ($request->input('type')=='2') {
                $filter = 'comment';
            }else if ($request->input('type')=='3') {
                $filter = 'order';
            }elseif ($request->input('type')=='4') {
                $filter = 'support';
            }else{
                return response()->json([
                    'errors-message' => 'wrong type',
                ], 400);
            }
        }
        $notificationsCount=Notification::where('to', $user_id)
            ->where('type', 'like', $filter)
            ->take($take)
            ->skip($skip)
            ->count();
        $pages=ceil($notificationsCount/$itemsPerPage);
        $notifications=Notification::where('to', $user_id)
            ->where('type', 'like', $filter)
            ->take($take)
            ->skip($skip)
            ->orderBy('id', 'desc')
            ->get();
        foreach ($notifications as $notification){
            $sender_id= $notification->from;
            if(isset($sender_id)){
                if ($sender_id==0){
                    $notification->sender='Администрация';
                }else{
                    $profile=Profile::where('user_id', $sender_id)->first();
                    $notification->sender=isset($profile) ? $profile->first_name.' '.$profile->last_name : '';
                }
            }
        }

        return response()->json([
            'success' => $notifications ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'pages' =>$pages,
            'notifications'=>$notifications,
            'user_id'=>$user_id,
            'request'=>$request->all(),
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/notification/markasread",
     *     operationId="mark as read",
     *     description="mark as read",
     *     summary="mark as read",
     *     produces={"application/json"},
     *     tags={"Notification"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="notification_ides", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function markasread(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authorizated',
                'request'=>$request->all(),
            ], 400);
        }
        $this->validate($request, [
            'notification_ides' => 'required',
        ]);
        $notification_ides=explode(' ', request()->get('notification_ides'));
        $notifications=Notification::where('to', $user_id)
            ->whereIn('id', $notification_ides)
            ->update(['is_read'=>1]);

        return response()->json([
            'success' => $notifications ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'notifications'=>$notifications,
            'request'=>$request->all(),
        ], 200);
    }
    //    Route::post('markasread', 'NotificationController@markasread');
    /**
     * @SWG\Post(
     *     path="/notification/markasreadall",
     *     operationId="mark as read all",
     *     description="mark as read all",
     *     summary="mark as read all",
     *     produces={"application/json"},
     *     tags={"Notification"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="type", required=false, description="1 message, 2 comment, 3- order, 4- support", in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function markasreadall(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authorizated',
                'request'=>$request->all(),
            ], 400);
        }
        $filter='%';
        if($request->input('type')){
            if ($request->input('type')=='1'){
                $filter='message';
            }else if ($request->input('type')=='2') {
                $filter = 'response';
            }else if ($request->input('type')=='3') {
                $filter = 'order';
            }elseif ($request->input('type')=='4') {
                $filter = 'support';
            }
        }
        $notifications=Notification::where('to', $user_id)
            ->where('type', 'like', $filter)
            ->update(['is_read' => '1']);
        return response()->json([
            'success' => $notifications ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/notification/delete",
     *     operationId="delete",
     *     description="delete",
     *     summary="delete",
     *     produces={"application/json"},
     *     tags={"Notification"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="notification_ides", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function delete(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authorizated',
                'request'=>$request->all(),
            ], 400);
        }
        $this->validate($request, [
            'notification_ides' => 'required',
        ]);
        $notification_ides=explode(' ', request()->get('notification_ides'));
        $notifications=Notification::where('to', $user_id)
            ->whereIn('id', $notification_ides)
            ->delete();

        return response()->json([
            'success' => $notifications ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'notifications'=>$notifications,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('deleteall', 'NotificationController@deleteall');
    /**
     * @SWG\Post(
     *     path="/notification/deleteall",
     *     operationId="delete all",
     *     description="delete all",
     *     summary="delete all удалить все уведомления",
     *     produces={"application/json"},
     *     tags={"Notification"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="type", required=false, description="1 message, 2 comment, 3- order, 4- support", in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function deleteall(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authorizated',
                'request'=>$request->all(),
            ], 400);
        }
        $filter='%';
        if($request->input('type')){
            if ($request->input('type')=='1'){
                $filter='message';
            }else if ($request->input('type')=='2') {
                $filter = 'response';
            }else if ($request->input('type')=='3') {
                $filter = 'order';
            }elseif ($request->input('type')=='4') {
                $filter = 'support';
            }
        }
        $notifications=Notification::where('to', $user_id)
            ->where('type', 'like', $filter)
            ->delete();
        return response()->json([
            'success' => $notifications ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
        ], 200);
    }



}
