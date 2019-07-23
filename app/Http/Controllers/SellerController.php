<?php

namespace App\Http\Controllers;

use App\Models\Assortment;
use App\Models\Chemical;
use App\Models\Delivery_method;
use App\Models\Market;
use App\Models\Response;
use App\Models\Sort;
use App\Models\Filter_attributes;
use App\Models\Filter_attr_value;
use App\Models\Profile;
use App\Models\Bookmarks;


use App\Models\User_delivery_method;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;



class SellerController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/seller/index",
     *     operationId="Get sellers",
     *     description="Get sellers",
     *     summary="Get sellers",
     *     produces={"application/json"},
     *     tags={"Seller"},
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="filter", required=false, description=" 332, 333 - attribute values",  in="query", type="string"),
     *     @SWG\Parameter(name="sorting", required=false, description="1-price, 2 - rating, 3-alphabet , 4 - new ",  in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index(Request $request)
    {
        $itemsperpage = 10;
        $validator = Validator::make(request()->all(), [
            'page' => 'integer',
            'sorting'=>'integer',
        ]);
        //select id
        $filter_request=request()->get('filter');
        $filter_attributes_values_id=explode(' ', request()->get('filter'));
        $filter_attributes_values=Filter_attr_value::whereIN('id', $filter_attributes_values_id)
            ->get();
        $filter_attributes = Filter_attr_value::select('attribute_id')
            ->whereIn('id', $filter_attributes_values_id)
            ->distinct()
            ->get();
        $item_ides = array();
        if (isset($filter_request)) {
            $sql = 'SELECT DISTINCT  profiles.id FROM profiles JOIN filter_attr_entities ON profiles.id = filter_attr_entities.entity_id WHERE is_seller=1 AND filter_attr_entities.entity_type="seller"';
            foreach ($filter_attributes as $filter_attribute) {
                $sql2=$sql.' AND ( filter_attr_entities.attribute_value IN (';
                foreach ($filter_attributes_values as $filter_attributes_value){
                    if ($filter_attributes_value->attribute_id==$filter_attribute->attribute_id){
                        $sql2=$sql2." $filter_attributes_value->id,";
                    }
                }
                $sql2=substr($sql2, 0, -1);
                $sql2=$sql2."))";
                $bd_items = DB::select($sql2);
                $items_array=array();
                foreach ($bd_items as $bd_item){
                    array_push($items_array, $bd_item->id);
                }
                array_push($item_ides, $items_array);
            }
            $arr_count=count($item_ides);
            for ($i=1; $i<$arr_count; $i++){
                $item_ides[0]=array_intersect($item_ides[0], $item_ides[$i]);
            }
            return response()->json([
                'success' => true,
                'success-message' => [],
                'errors-message' => [],
                'pages' => 0,
                'page' => 0,
                'sellers' => [],
                '$item_ides' => $item_ides,
            ], 200);

            $item_ides=$item_ides[0];
            if(count($item_ides)==0){
                return response()->json([
                    'success' => true,
                    'success-message' => [],
                    'errors-message' => [],
                    'pages' => 0,
                    'page' => 0,
                    'sellers' => [],
                    'sql' => $sql,
                ], 200);
            }
        }
        //create sql
        $sql = "select user_id AS id, first_name, last_name, photo, comment_seller, rating_seller, 
            min_price_seller, max_price_seller, about_me_seller, created_at from `profiles` WHERE  is_seller=1";
        if (count($item_ides) > 0) {
            $sql = $sql . " AND profiles.id IN (" . implode(", ", $item_ides) . ")";
        }
        //ordering
        $ordering = request()->get('sorting');
        if (isset($ordering)) {
            if ($ordering == 1) {
                $sql = $sql . " ORDER BY profiles.min_price_seller ";
            } elseif ($ordering == 2) {
                $sql = $sql . " ORDER BY profiles.rating_seller DESC";
            } elseif ($ordering == 3) {
                $sql = $sql . " ORDER BY profiles.first_name ";
            } elseif ($ordering == 4) {
                $sql = $sql . " ORDER BY profiles.created_at DESC";
            }
        }
        $limit = $itemsperpage;
        $page = 1;
        if (request('page') > 1) {
            $page = request('page');
        }
        //calculate pages
        $items = DB::select($sql);
        $pages = ceil(count($items) / $itemsperpage);

        $skip = ($page - 1) * $itemsperpage;
        $sql = $sql . "  limit " . $limit . " offset " . $skip;
        $items = DB::select($sql);

        if (count($items) > 0) {
            foreach ($items as $item) {
                if (isset($item->photo))
                    $item->photo = $_ENV['PHOTO_AVA_FOLDER'] . $item->photo;
            }
        }
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'pages' => $pages,
            'page' => $page,
            'sellers' => $items,
            'sql' => $sql,
        ], 200);
    }
//Route::post('showfilter', 'SellerController@showfilter');

    /**
     * @SWG\Post(
     *     path="/seller/showfilter",
     *     operationId="show filter",
     *     description="show filter",
     *     summary="show filter",
     *     produces={"application/json"},
     *     tags={"Seller"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showfilter()
    {
        $filter = Filter_attributes::where('type', 'seller')
            ->with('attr_values')
            ->get();
        return response()->json([
            'success' => $filter ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'filter' => $filter,
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/seller/show",
     *     operationId="Get seller",
     *     description="Get seller",
     *     summary="Get seller",
     *     produces={"application/json"},
     *     tags={"Seller"},
     *     @SWG\Parameter(name="user_id", description="61", required=true, in="query", type="integer"),
     *
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function show(Request $request)
    {
        $seller = Profile::where('user_id', $request['user_id'])
            ->select('user_id', 'first_name', 'last_name', 'photo', 'about_me_seller', 'site')
            ->get();
        if(count($seller)<1){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['item is not exist'],
            ], 400);
        }
        if (isset($seller->photo))
            $seller->photo = $_ENV['PHOTO_AVA_FOLDER'] . $seller->photo;
            //select assortment
        $itemsPerPage = 1000000;
        $user_id = $request['user_id'];
        $assortment_sort = Assortment::select('target_id')
            ->distinct()
            ->where('owner_id', $user_id)
            ->where('type', 'sort')
            ->get();
        $count = $assortment_sort->count();
        $pages = ceil($count / $itemsPerPage);
        $page = 1;
        $take = $itemsPerPage;
        if ($request['page'] > 1) {
            $page = $request['page'];
        }
        $skip = ($page - 1) * $itemsPerPage;
        $assortment_sort = Assortment::select('target_id')
            ->where('owner_id', $user_id)
            ->where('type', 'sort')
            ->where('quantity', '>','0')
            ->skip($skip)
            ->take($take)
            ->distinct()
            ->get();
        foreach ($assortment_sort as $item) {
            $sort = Sort::select('sorts.name', 'sorts.main_photo')
                ->where('sorts.id', $item->target_id)
                ->first();
            if($sort){
                $item->name = $sort->name;
                $item->main_photo = $_ENV['PHOTO_FOLDER'] . $sort->main_photo;
                $assortments = Assortment::where('owner_id', $user_id)
                    ->where('target_id', $item->target_id)
                    ->where('assortments.type', 'sort')
                    ->leftJoin('categories', 'categories.id', 'assortments.category_id')
                    ->get();
                $item->categories = $assortments;
            }
        }
        $assortment_chemical = Assortment::select('target_id')
            ->where('owner_id', $user_id)
            ->where('type', 'chemical')
            ->where('quantity', '>','0')
            ->skip($skip)
            ->take($take)
            ->distinct()
            ->get();
        foreach ($assortment_chemical as $item) {
            $chemical = Chemical::select('chemicals.name', 'chemicals.main_photo')
                ->where('chemicals.id', $item->target_id)
                ->first();
            if($chemical){
                $item->name = $chemical->name;
                $item->main_photo = $_ENV['PHOTO_FOLDER'] . $chemical->main_photo;
                $assortments = Assortment::where('owner_id', $user_id)
                    ->where('target_id', $item->target_id)
                    ->where('assortments.type', 'chemical')
                    ->leftJoin('categories', 'categories.id', 'assortments.category_id')
                    ->get();
                $item->categories = $assortments;
            }
        }
        $comments = Response::where('type', 'seller')
            ->where('item_id', $user_id)
            ->leftJoin('profiles', 'profiles.user_id', 'responses.user_id')
            ->select('responses.id', 'responses.user_id', 'responses.rating', 'responses.text', 'responses.created_at',
                'profiles.first_name', 'profiles.last_name', 'profiles.photo')
            ->orderBy('id', 'desc')
            ->get();
        if (count($comments) > 0) {
            foreach ($comments as $item) {
                if (isset($item->photo))
                    $item->photo = $_ENV['PHOTO_AVA_FOLDER'] . $item->photo;
            }
        }
        $markets = Market::where('user_id', $user_id)->get();
        return response()->json([
            'success' => $seller ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'seller' => $seller,
            'assortment' => $assortment_sort,
            'assortment_chemical'=> $assortment_chemical,
            'markets' => $markets,
            'comments' => $comments,
        ], 200);
    }
//Route::post('addtobookmark', 'SellerController@addtobookmark');

    /**
     * @SWG\Post(
     *     path="/seller/addtobookmark",
     *     operationId="Add to bookmark",
     *     description="Add to bookmark",
     *     summary="Add to bookmark",
     *     produces={"application/json"},
     *     tags={"Seller"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="seller_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function addtobookmark(Request $request)
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
            'seller_id' => 'required|integer',
        ]);
        // Get filename with extension
        $profile=Profile::where('user_id', $request->input('seller_id'))->first();


        if(!isset($profile)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 400);
        }




        $bookmark = new Bookmarks;
        $bookmark->type = 'seller';
        $bookmark->user_id = $user_id;
        $bookmark->folder_id = 0;
        $bookmark->target_id = $request->input('seller_id');
        $bookmark->save();
        return response()->json([
            'success' => $bookmark ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'bookmark' => $bookmark,
        ], 200);
    }

//Route::post('checkisbookmark', 'SellerController@checkisbookmark');

    /**
     * @SWG\Post(
     *     path="/seller/checkisbookmark",
     *     operationId="check is in  bookmark",
     *     description="check is in bookmark",
     *     summary="check is in bookmark",
     *     produces={"application/json"},
     *     tags={"Seller"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="seller_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function checkisbookmark(Request $request)
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
            'seller_id' => 'required|integer',
        ]);
        // Get filename with extension
        $profile=Profile::where('user_id', $request->input('seller_id'))->first();
        if(!isset($profile)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 400);
        }
        $user_bookmark = Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('seller_id'))
            ->where('type', 'seller')
            ->get();
        $count = $user_bookmark->count();
        $ansver = false;
        if ($count > 0) {
            $ansver = true;
        }
        return response()->json([
            'is_bookmarked' => $ansver,
            'request' => $request->all(),
        ], 200);
    }
//Route::post('deletefrombookmark', 'SellerController@deletefrombookmark');
    /**
     * @SWG\Post(
     *     path="/seller/deletefrombookmark",
     *     operationId="delete from user chemicals bookmark",
     *     description="delete from user chemicals bookmark",
     *     summary="delete from user chemicals bookmark",
     *     produces={"application/json"},
     *     tags={"Seller"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="seller_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function deletefrombookmark(Request $request)
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
            'seller_id' => 'required|integer',
        ]);
        // Get filename with extension
        $profile=Profile::where('user_id', $request->input('seller_id'))->first();
        if(!isset($profile)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 400);
        }
        $user_bookmark = Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('seller_id'))
            ->where('type', 'seller')
            ->delete();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'request' => $request->all(),
        ], 200);
    }

    //Route::post('showdeliverymethods', 'UserController@showdeliverymethods');
    /**
     * @SWG\Post(
     *     path="/seller/showdeliverymethods",
     *     operationId="show showdeliverymethods",
     *     description="show showdeliverymethods",
     *     summary="show showdeliverymethods    отобразить все сущетсвующие методы доставки",
     *     produces={"application/json"},
     *     tags={"Seller"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showdeliverymethods(Request $request){
        $methods=Delivery_method::orderBy('name')->get();
        return response()->json([
            'success' => $methods ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'methods'=>$methods,
        ], 200);
    }
//Route::post('updatedeliverymethods', 'UserController@updatedeliverymethods');
    /**
     * @SWG\Post(
     *     path="/seller/updatedeliverymethods",
     *     operationId="update delivery methods",
     *     description="update delivery methods",
     *     summary="update delivery methods  обновить методы доставки",
     *     produces={"application/json"},
     *     tags={"Seller"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="id", required=false, in="query", description=" 51 16 строкой через пробел",type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function updatedeliverymethods(Request $request){
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if (!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        User_delivery_method::where('user_id', $user_id)
            ->delete();
        $id_string=$request->get('id');
        if(isset($id_string)){
            $id_array=explode(' ', request()->get('id'));
            foreach ($id_array as $item){
                $model=User_delivery_method::create([
                    'user_id'=>$user_id,
                    'method_id'=>$item,
                ]);
            }
        }
        return response()->json([
            'success' => $user_id ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'request'=>$request->all(),
            'deliveres_id'=>$id_string,
        ], 200);
    }


}
