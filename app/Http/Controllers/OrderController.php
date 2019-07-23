<?php

namespace App\Http\Controllers;

use App\Models\Assortment;
use App\Models\Chemical;
use App\Models\Notification;
use App\Models\Order_Item;
use App\Models\Order_region;
use App\Models\Order_status_rel;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Sort;
use App\Models\Category;
use App\Models\Profile;

//TODO все перепилить
class OrderController extends Controller
{


//Route::post('index', 'OrderController@index');
//показать оформлен заказы
    /**
     * @SWG\Post(
     *     path="/order/index",
     *     operationId="Show orders",
     *     description="Show orders",
     *     summary="Show orders",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="page", required=false, in="query", type="string"),
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
        //show orders
        $order_count=Order::where('user_id', $user_id)
            ->where('status_id', '<>', '1')
            ->count();
        $pages = ceil($order_count / $itemsPerPage);
        $page = 1;
        $take = $itemsPerPage;
        if(request('page') > 1){
            $page=request('page');
        }
        $skip=($page-1)*$itemsPerPage;
        $orders = Order::where('user_id', $user_id)
            ->where('status_id', '<>', '1')
            ->leftJoin('order_statuses', 'order_statuses.id', '=', 'orders.status_id' )
            ->skip($skip)
            ->take($take)
            ->orderBy('orders.id', 'desc')
            ->select('orders.*', 'order_statuses.status_name')
            ->get();
        foreach ($orders as $order) {
            if (isset($order->owner_id)) {
                $owner = Profile::where('user_id', $order->owner_id)->first();
                $order->seller_first_name = $owner->first_name;
                $order->seller_last_name = $owner->last_name;
            }
            $order->items = Order_Item::where('order_id', $order->id)
                ->get();

            foreach ($order->items as $item) {
                if ($item->type === 'sort') {
                    $entity = Sort::find($item->item_id);
                    if (isset($entity->main_photo)) {
                        $item->photo = $_ENV['PHOTO_FOLDER'] . $entity->main_photo;
                    }
                    if (isset($entity->name)) {
                        $item->name = $entity->name;
                    }
                    if (isset($item->category_id)) {
                        $category=Category::find($item->category_id);
                        $item->category = $category->category;
                    }
                }
                if ($item->type === 'chemical') {
                    $entity = Chemical::find($item->item_id);
                    if (isset($entity->main_photo)) {
                        $item->photo = $_ENV['PHOTO_FOLDER'] . $entity->main_photo;
                    }
                    if (isset($entity->name)) {
                        $item->name = $entity->name;
                    }
                    if (isset($item->category_id)) {
                        $category=Category::find($item->category_id);
                        $item->category = $category->category;
                    }
                }
            }
        }
        return response()->json([
            'success' => $orders ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'pages' =>$pages,
            'order'=>$orders,
            'user_id'=>$user_id,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('indexnewitems', 'OrderController@indexnewitems');
//новые объекты в заказе
    /**
     * @SWG\Post(
     *     path="/order/indexnewitems",
     *     operationId="Show new items",
     *     description="Show new items",
     *     summary="Show new items",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function indexnewitems(Request $request)
    {
        $itemsPerPage=20;
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        //select new items without order
        $noorders=Order::where('user_id', $user_id)
            ->whereNull('owner_id')
            ->first();
        if($noorders){
            $noorders->items=Order_Item::where('order_id', $noorders->id)
                ->get();
            foreach ($noorders->items as $item){
                if ($item->type=='sort'){
                    $sort=Sort::find($item->item_id);
                    $item->name=$sort->name;
                    $item->photo = $_ENV['PHOTO_FOLDER'] . $sort->main_photo;
                }elseif ($item->type=='chemical'){
                    $chemical=Chemical::find($item->item_id);
                    $item->name=$chemical->name;
                    $item->photo = $_ENV['PHOTO_FOLDER'] . $chemical->main_photo;
                }
            }
        }
        return response()->json([
            'success' => $noorders ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('showsellers', 'OrderController@showsellers');
//показать продавцов
    /**
     * @SWG\Post(
     *     path="/order/showsellers",
     *     operationId="Show sellers",
     *     description="Show sellers",
     *     summary="Show sellers",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     @SWG\Parameter(name="item_id", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="category_id", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="page", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showsellers(Request $request)
    {
        $itemsperpage=10;

        $order_item = Order_Item::find($request->input('item_id'));
        $order = Order::find($order_item->order_id);
        $owner_id=$order->owner_id;
        if(!is_null($owner_id)){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['you can not change seller'],
                'order'=>$order->owner_id,
                'request'=>$request->all(),
            ], 200);
        }
        $category_id=$request->input('category_id');
        $owner_count=Assortment::where('target_id', $order_item->item_id)
            ->where('type', $order_item->type)
            ->where('quantity', '>', '0')
            ->where('category_id', $category_id)
            ->distinct('owner_id')
            ->count();
        $owners=Assortment::where('target_id', $order_item->item_id)
            ->where('type', $order_item->type)
            ->where('quantity', '>', '0')
            ->where('category_id', $category_id)
            ->distinct('owner_id')
            ->select('owner_id')
            ->get();
        $pages=ceil($owner_count/$itemsperpage);
        $take=$itemsperpage;
        $skip=0;
        $page=$request->input('page');
        if(isset($page)){
            $skip=($page-1)*$itemsperpage;
        }
        $sellers=Profile::whereIn('user_id', $owners)
            ->take($take)
            ->skip($skip)
            ->select('user_id AS id', 'first_name', 'last_name', 'photo', 'comment_seller', 'rating_seller',
            'min_price_seller', 'max_price_seller', 'about_me_seller', 'created_at')
            ->get();
        if (count($sellers) > 0) {
            foreach ($sellers as $item) {
                if (isset($item->photo))
                    $item->photo = $_ENV['PHOTO_AVA_FOLDER'] . $item->photo;
            }
            $item->item=Assortment::where('owner_id', $item->id)
                ->where('target_id',$order_item->item_id )
                ->where('type', $order_item->type)
                ->where('category_id', $category_id)
                ->first();
        }
        return response()->json([
            'success' => $sellers ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'sellers'=>$sellers,
            'owners'=>$owners,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('chooseseller', 'OrderController@index');
//выбор продавца
    /**
     * @SWG\Post(
     *     path="/order/chooseseller",
     *     operationId="choose seller",
     *     description="choose seller",
     *     summary="choose seller",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="item_id", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="seller_id", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function chooseseller(Request $request)
    {
        $itemsPerPage=20;
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $seller_id=$request->input('seller_id');
        $item_id=$request->input('item_id');
        $item=Order_Item::find($item_id);
        $assortment=Assortment::where('owner_id', $seller_id)
            ->where('type', $item->type)
            ->where('category_id', $item->category_id)
            ->where('target_id', $item->item_id)
            ->first();
        $order=new Order;
        $order->user_id=$user_id;
        $order->owner_id=$request->input('seller_id');
        $order->status_id=2;
        $order->save();
        $item->order_id=$order->id;
        $item->price=$assortment->price;
        $item->save();

        return response()->json([
            'success' => $item ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'order'=>$order,
            'item'=>$item,
            'request'=>$request->all(),
        ], 200);
    }

//Route::post('combine', 'OrderController@combine');
//объединить заказы с одним продавцом
    /**
     * @SWG\Post(
     *     path="/order/combine",
     *     operationId="combine orders",
     *     description="combine orders",
     *     summary="combine orders",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="main_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="secondary_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function combine(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $main_order=Order::where('user_id', $user_id)
            ->where('id', $request->input('main_id'))
            ->first();
        $secondary_order=Order::where('user_id', $user_id)
            ->where('id', $request->input('secondary_id'))
            ->first();

        if($main_order->owner_id<>$secondary_order->owner_id || $main_order->status_id<>2  || $secondary_order->status_id<>2){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['different sellers or without sellers'],
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 200);
        }
        $items=Order_Item::where('order_id', $secondary_order->id)
            ->get();
        foreach ($items as $item){
            $item->order_id=$main_order->id;
            $item->save();
        }
        $secondary_order->delete();
        return response()->json([
            'success' => $main_order ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'order'=>$main_order,
            'item'=>$item,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('editdelivery', 'OrderController@editdelivery');
    /**
     * @SWG\Post(
     *     path="/order/editdelivery",
     *     operationId="edit delivery",
     *     description="edit delivery",
     *     summary="edit delivery",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="order_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="delivery_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="address", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function editdelivery(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $order=Order::where('user_id', $user_id)
            ->where('id', $request->input('order_id'))
            ->first();
        $order->delivery_method_id=$request->input('delivery_id');
        $order->address=$request->input('address');
        $order->save();
        return response()->json([
            'success' => $order ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'order'=>$order,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('edititem', 'OrderController@edititem');
    /**
     * @SWG\Post(
     *     path="/order/edititem",
     *     operationId="edit item",
     *     description="edit item",
     *     summary="edit item",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="item_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="quantity", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function edititem(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $order_item=Order_Item::find($request->input('item_id'));
        $order=Order::where('user_id', $user_id)
            ->where('id', $order_item->order_id)
            ->first();
        if($order->status_id!=1 || $order->status_id!=2 ){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['Для заказа в таком статусе редактировать компоненты нельзя'],
                'user_id'=>$user_id,
                ], 200);
        }
        $order_item->quantity=$request->input('quantity');
        $order_item->save();
        return response()->json([
            'success' => $order ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'order'=>$order,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('deleteitem', 'OrderController@deleteitem');
    /**
     * @SWG\Post(
     *     path="/order/deleteitem",
     *     operationId="delete item",
     *     description="delete item",
     *     summary="delete item удалить из корзины или заказа",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="item_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function deleteitem(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $order_item=Order_Item::find($request->input('item_id'));
        $order=Order::where('user_id', $user_id)
            ->where('id', $order_item->order_id)
            ->first();
        if($order->status_id==1 || $order->status_id==2 ){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['Для заказа в таком статусе редактировать компоненты нельзя'],
                'user_id'=>$user_id,
                'order'=>$order,
                'request'=>$request->all(),
            ], 200);
        }
        $order_item->delete();
        return response()->json([
            'success' => $order ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
        ], 200);
    }


//Route::post('agreement', 'OrderController@agreement');
//на согласование
    /**
     * @SWG\Post(
     *     path="/order/agreement",
     *     operationId="set status to agreement",
     *     description="set status to agreement",
     *     summary="set status to agreement",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="order_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function agreement(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $profile=Profile::where('user_id', $user_id)->first();
        $order=Order::where('id',$request->input('order_id'))
            ->where('user_id', $user_id)
            ->first();
        $result=true;
        if($order->status_id<>2 || is_null($order->owner_id)){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['bed order parameters'],
                'user_id'=>$user_id,
                'order'=>$order->owner_id,
                'request'=>$request->all(),
            ], 200);
        }
        $items=Order_Item::where('order_id', $order->id)
            ->get();
        foreach ($items as $item){
            if($item->quantity==0 || $item->price==0){
                $result=false;
            }
        }
        if($result){
            $order->status_id=3;
            $notification=new Notification;
            $notification->from=$user_id;
            $notification->to=$order->owner_id;
            $notification->type='order';
            $notification->topic='Заказ '.$profile->first_name. " ".$profile->last_name;
            $text = "Подробности заказа";
            foreach ($items as $item){
                if ($item->type=='sort'){
                    $sort=Sort::find($item->item_id);
                    $text=$text.'<br> '.$sort->name.' '. $item->quantity. ' ' . $item->price;
                }
            }
            $notification->text=$text;
            $notification->save();
            $order->save();
        }
        return response()->json([
            'success' => $result ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'order'=>$order,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('reject', 'OrderController@reject');
//продавец отказывает
    /**
     * @SWG\Post(
     *     path="/order/reject",
     *     operationId="set status to reject",
     *     description="set status to reject",
     *     summary="set status to reject",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="order_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="note", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function reject(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $order=Order::where('id',$request->input('order_id'))
            ->whereRaw('(user_id='.$user_id.' OR owner_id='.$user_id.')')
            ->first();
        $items=Order_Item::where('order_id', $order->id)
            ->get();
        if($order->user_id==$user_id){
            //user rejecting
            $order->status_id=8;
            $order->save();
            $notification=new Notification;
            $profile=Profile::where('user_id', $order->user_id)->first();
            $notification->from=$order->user_id;
            $notification->to=$order->owner_id;
            $notification->type='order';
            $notification->topic='Отказ заказа №'.$order->id.'. Заказчик '.$profile->first_name. " ".$profile->last_name;
            $text = "Подробности заказа";
            foreach ($items as $item){
                if ($item->type=='sort'){
                    $sort=Sort::find($item->item_id);
                    $text=$text.'<br> '.$sort->name.' '. $item->quantity. ' ' . $item->price;
                }
            }
            if(isset($request['note'])){
                $text=$text.'<br> Комментарий заказчика: '.$request['note'];
            }
            $notification->text=$text;
            $notification->save();

        } else{
            //seller rejecting
            $order->status_id=10;
            $order->save();
            $notification=new Notification;
            $profile=Profile::where('user_id', $order->owner_id)->first();
            $notification->from=$order->owner_id;
            $notification->to=$order->user_id;
            $notification->type='order';
            $notification->topic='Отказ заказа №'.$order->id.'. Продавец '.$profile->first_name. " ".$profile->last_name;
            $text = "Подробности заказа";
            foreach ($items as $item){
                if ($item->type=='sort'){
                    $sort=Sort::find($item->item_id);
                    $text=$text.'<br> '.$sort->name.' '. $item->quantity. ' ' . $item->price;
                }
            }
            if(isset($request['note'])){
                $text=$text.'<br> Комментарий продавца: '.$request['note'];
            }
            $notification->text=$text;
            $notification->save();
        }
        $history_record=new Order_status_rel;
        $history_record->order_id=$order->id;
        $history_record->order_status_id=$order->status_id;
        $history_record->date=date('Y-m-d');
        $history_record->save();
        return response()->json([
            'success' => $order ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'order'=>$order,
            'notification'=>$notification,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('accept', 'OrderController@reject');
//принять
    /**
     * @SWG\Post(
     *     path="/order/accept",
     *     operationId="set status to accept",
     *     description="set status to accept",
     *     summary="set status to accept",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="order_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function accept(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $order=Order::where('id',$request->input('order_id'))
            ->whereRaw('(user_id='.$user_id.' OR owner_id='.$user_id.')')
            ->first();
        $order->status_id=6;
        $order->save();
        $notification=new Notification;
        $profile=Profile::where('user_id', $order->owner_id)->first();
        $notification->from=$order->owner_id;
        $notification->to=$order->user_id;
        $notification->type='order';
        $notification->topic='Заказ №'.$order->id.' принят. Продавец '.$profile->first_name. " ".$profile->last_name;
        $text = "Подробности заказа";
        $items=Order_Item::where('order_id', $order->id)
            ->get();
        foreach ($items as $item){
            if ($item->type=='sort'){
                $sort=Sort::find($item->item_id);
                $text=$text.'<br> '.$sort->name.' '. $item->quantity. ' ' . $item->price;
            }
        }
        $notification->text=$text;
        $notification->save();
        $history_record=new Order_status_rel;
        $history_record->order_id=$order->id;
        $history_record->order_status_id=$order->status_id;
        $history_record->date=date('Y-m-d');
        $history_record->save();
        return response()->json([
            'success' => $order ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'order'=>$order,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('toreserv', 'OrderController@toreserv');
    /**
     * @SWG\Post(
     *     path="/order/toreserv",
     *     operationId="set status to toreserv",
     *     description="set status to toreserv",
     *     summary="set status to toreserv",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="order_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function toreserv(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $order=Order::where('id',$request->input('order_id'))
            ->where('owner_id', $user_id)
            ->first();
        $order->status_id=9;
        $order->save();
        $notification=new Notification;
        $profile=Profile::where('user_id', $order->owner_id)->first();
        $notification->from=$order->owner_id;
        $notification->to=$order->user_id;
        $notification->type='order';
        $notification->topic='Предложено забронировать заказ №'.$order->id.'. Продавец '.$profile->first_name. " ".$profile->last_name;
        $text = "Подробности заказа";
        $items=Order_Item::where('order_id', $order->id)
            ->get();
        foreach ($items as $item){
            if ($item->type=='sort'){
                $sort=Sort::find($item->item_id);
                $text=$text.'<br> '.$sort->name.' '. $item->quantity. ' ' . $item->price;
            }
        }
        $notification->text=$text;
        $notification->save();
        $history_record=new Order_status_rel;
        $history_record->order_id=$order->id;
        $history_record->order_status_id=$order->status_id;
        $history_record->date=date('Y-m-d');
        $history_record->save();

        return response()->json([
            'success' => $order ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'order'=>$order,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('reserved', 'OrderController@reserved');
    /**
     * @SWG\Post(
     *     path="/order/reserved",
     *     operationId="set status to reserved",
     *     description="set status to reserved",
     *     summary="set status to reserved",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="order_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function reserved(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $order=Order::where('id',$request->input('order_id'))
            ->where('user_id', $user_id)
            ->first();
        $order->status_id=4;
        $order->save();
        $notification=new Notification;
        $profile=Profile::where('user_id', $order->user_id)->first();
        $notification->from=$order->user_id;
        $notification->to=$order->owner_id;
        $notification->type='order';
        $notification->topic='Принято предложение забронировать заказ №'.$order->id.'. Покупатель '.$profile->first_name. " ".$profile->last_name;
        $text = "Подробности заказа";
        $items=Order_Item::where('order_id', $order->id)
            ->get();
        foreach ($items as $item){
            if ($item->type=='sort'){
                $sort=Sort::find($item->item_id);
                $text=$text.'<br> '.$sort->name.' '. $item->quantity. ' ' . $item->price;
            }
        }
        $notification->text=$text;
        $notification->save();
        $history_record=new Order_status_rel;
        $history_record->order_id=$order->id;
        $history_record->order_status_id=$order->status_id;
        $history_record->date=date('Y-m-d');
        $history_record->save();
        return response()->json([
            'success' => $order ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'order'=>$order,
            'request'=>$request->all(),
        ], 200);
    }
//confirm_reserved
//подтвердить готовность получить забронир заказ
    /**
     * @SWG\Post(
     *     path="/order/confirm_reserved",
     *     operationId="set status to confirm_reserved",
     *     description="set status to confirm_reserved",
     *     summary="set status to confirm_reserved",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="order_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function confirm_reserved(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $order=Order::where('id',$request->input('order_id'))
            ->where('user_id', $user_id)
            ->first();
        $order->status_id=11;
        $order->save();
        $notification=new Notification;
        $profile=Profile::where('user_id', $order->owner_id)->first();
        $notification->from=$order->owner_id;
        $notification->to=$order->user_id;
        $notification->type='order';
        $notification->topic='Забронированный заказ №'.$order->id.' готов. Продавец '.$profile->first_name. " ".$profile->last_name;
        $text = "Подробности заказа";
        $items=Order_Item::where('order_id', $order->id)
            ->get();
        foreach ($items as $item){
            if ($item->type=='sort'){
                $sort=Sort::find($item->item_id);
                $text=$text.'<br> '.$sort->name.' '. $item->quantity. ' ' . $item->price;
            }
        }
        $notification->text=$text;
        $notification->save();
        $history_record=new Order_status_rel;
        $history_record->order_id=$order->id;
        $history_record->order_status_id=$order->status_id;
        $history_record->date=date('Y-m-d');
        $history_record->save();
        return response()->json([
            'success' => $order ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'order'=>$order,
            'request'=>$request->all(),
        ], 200);
    }

//Route::post('sended', 'OrderController@sended');
    /**
     * @SWG\Post(
     *     path="/order/sended",
     *     operationId="set status to sended",
     *     description="set status to sended",
     *     summary="set status to sended",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="order_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function sended(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $order=Order::where('id',$request->input('order_id'))
            ->where('owner_id', $user_id)
            ->first();
        $order->status_id=5;
        $order->save();
        $notification=new Notification;
        $profile=Profile::where('user_id', $order->owner_id)->first();
        $notification->from=$order->owner_id;
        $notification->to=$order->user_id;
        $notification->type='order';
        if($order->delivery_method_id==1){
            $notification->topic='Заказ №'.$order->id.' готов к выдаче. Продавец '.$profile->first_name. " ".$profile->last_name;
        } else{
            $notification->topic='Заказ №'.$order->id.' отправлен. Продавец '.$profile->first_name. " ".$profile->last_name;
        }
        $text = "Подробности заказа";
        $items=Order_Item::where('order_id', $order->id)
            ->get();
        foreach ($items as $item){
            if ($item->type=='sort'){
                $sort=Sort::find($item->item_id);
                $text=$text.'<br> '.$sort->name.' '. $item->quantity. ' ' . $item->price;
            }
        }
        $notification->text=$text;
        $notification->save();
        $history_record=new Order_status_rel;
        $history_record->order_id=$order->id;
        $history_record->order_status_id=$order->status_id;
        $history_record->date=date('Y-m-d');
        $history_record->save();
        return response()->json([
            'success' => $order ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'order'=>$order,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('relised', 'OrderController@relised');
    /**
     * @SWG\Post(
     *     path="/order/relised",
     *     operationId="set status to relised",
     *     description="set status to relised",
     *     summary="set status to relised",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="order_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function relised(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $profile=Profile::where('user_id', $user_id)->first();
        $region=$profile->region_id;
        $order=Order::where('id',$request->input('order_id'))
            ->where('user_id', $user_id)
            ->first();
        if($order->status_id==7){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['this order yet realized'],
                'user_id'=>$user_id,
                'order'=>$order,
                'request'=>$request->all(),
            ], 200);
        }
        $order->status_id=7;
        $order->save();

        $notification=new Notification;
        $profile=Profile::where('user_id', $order->user_id)->first();
        $notification->from=$order->user_id;
        $notification->to=$order->owner_id;
        $notification->type='order';
        $notification->topic='Заказ №'.$order->id.' получен. Покупатель '.$profile->first_name. " ".$profile->last_name;
        $text = "Подробности заказа";
        $items=Order_Item::where('order_id', $order->id)
            ->get();
        foreach ($items as $item){
            if ($item->type=='sort'){
                $sort=Sort::find($item->item_id);
                $text=$text.'<br> '.$sort->name.' '. $item->quantity. ' ' . $item->price;
            }
        }
        $notification->text=$text;
        $notification->save();
        $history_record=new Order_status_rel;
        $history_record->order_id=$order->id;
        $history_record->order_status_id=$order->status_id;
        $history_record->date=date('Y-m-d');
        $history_record->save();

        $items=Order_Item::where('order_id', $order->id)->get();
        foreach ($items as $item){
            $order_region=Order_region::where('item_id', $item->item_id)
                ->where('type', $item->type)
                ->where('region_id', $region)
                ->first();
            if(count($order_region)<1){
                $order_region=new Order_region;
                $order_region->item_id=$item->item_id;
                $order_region->type=$item->type;
                $order_region->region_id=$region;
                $order_region->count=0;
            }
            $order_region->count=$order_region->count+$item->quantity;
            $order_region->save();
        }
        //set merchantability
        foreach ($items as $item){
            if ($item->type=='sort'){
                $sort=Sort::find($item->item_id);
                if(isset($sort)){
                    $sort->merchantability=$sort->merchantability+$item->quantity;
                    $sort->save();
                }
            }elseif($item->type=='chemical') {
                $chemical = Chemical::find($item->item_id);
                if (isset($chemical)) {
                    $chemical->merchantability = $chemical->merchantability + $item->quantity;
                    $chemical->save();
                }
            }
        }

        return response()->json([
            'success' => $order ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'order'=>$order,
            'request'=>$request->all(),
        ], 200);
    }
    //Route::post('sendmessage', 'OrderController@sendmessage');
    /**
     * @SWG\Post(
     *     path="/order/sendmessage",
     *     operationId="Send message",
     *     description="Send message",
     *     summary="Send message",
     *     produces={"application/json"},
     *     tags={"Order"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="seller_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="order_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="message", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function sendmessage(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        //create notification
        $notification= new Notification;
        $notification->from=$user_id;
        $notification->to=$request->input('seller_id');
        $notification->type='order';
        $notification->text=$request->input('message');
        $notification->save();

        return response()->json([
            'success' => $notification ? true : false,
            'success-message' => [],
            'errors-message' => [],
        ], 200);
    }

}
