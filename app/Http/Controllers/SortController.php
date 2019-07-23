<?php

namespace App\Http\Controllers;

use App\Models\Assortment;
use App\Models\Culture;
use App\Models\Disease;
use App\Models\Filter_attr_entity;
use App\Models\Filter_attr_value;
use App\Models\Moon_action;
use App\Models\Moon_date;
use App\Models\Moon_phase;
use App\Models\Pest;
use App\Models\Pest_disease_relations;
use App\Models\Region;
use App\Models\Sort;
use App\Models\Sort_calendar;
use App\Models\Sort_operation;
use App\Models\Photos;
use App\Models\Sort_characteristic;
use App\Models\Sort_charact_relation;
use App\Models\Response;
use App\Models\Responses_answer;
use App\Models\Category;
use App\Models\Category_relation;
use App\Models\Sort_ques_general_info;
use App\Models\Sort_questionary;
use App\Models\Filter_attributes;

use App\Models\Order;
use App\Models\Order_Item;
use App\Models\User_sorts;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;






class SortController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/sort/index",
     *     operationId="Get sorts",
     *     description="Get sorts",
     *     summary="Get sorts",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     @SWG\Parameter(name="culture_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="filter", required=false, description="25 26 85  6-7 - attribute values",  in="query", type="string"),
     *     @SWG\Parameter(name="sorting", required=false, description="1-popylarity(not worked), 2 - rating, 3-alphabet , 4 - new ",  in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index(Request $request)
    {

        $itemsperpage = 10;

        $validator = Validator::make($request->all(), [
            'page' => 'integer',
            'culture_id'=>'integer|required',
        ]);
        $culture_id=$request['culture_id'];


        //select id
        $filter_request=request()->get('filter');
        $filter_attributes_values_id=explode(' ', request()->get('filter'));
        $filter_attributes_values=Filter_attr_value::whereIN('id', $filter_attributes_values_id)
            ->get();
        $filter_attributes = Filter_attr_value::select('attribute_id')
            ->whereIn('id', $filter_attributes_values_id)
            ->distinct()
            ->get();
        $item_ides=array();
        if (isset($filter_request)) {
            $sql = 'SELECT DISTINCT  sorts.id FROM sorts JOIN filter_attr_entities ON sorts.id = filter_attr_entities.entity_id WHERE sorts.culture_id='.$culture_id.' AND filter_attr_entities.entity_type="sort" ';
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
            $item_ides=$item_ides[0];
            if(count($item_ides)==0){
                return response()->json([
                    'success' => true,
                    'success-message' => [],
                    'errors-message' => [],
                    'sorts' => [],
                    'sql'=>$sql,
                ], 200);
            }
        }

        //create sql
        $sql = "select id,name, slug, main_photo, rating, is_new, created  from `sorts` where sorts.culture_id=".$culture_id;
        if (count($item_ides) > 0) {
            $sql = $sql . " AND sorts.id IN (" . implode(", ", $item_ides) . ")";
        }
        //ordering
        $ordering = request()->get('sorting');
        if (isset($ordering)) {
            if ($ordering == 1) {
                $sql = $sql . " ORDER BY sorts.name ";
            } elseif ($ordering == 2) {
                $sql = $sql . " ORDER BY sorts.rating DESC";
            } elseif ($ordering == 3) {
                $sql = $sql . " ORDER BY sorts.name ";
            } elseif ($ordering == 4) {
                $sql = $sql . " ORDER BY sorts.created DESC";
            }
        }
        $limit = $itemsperpage;
        $page = 1;
        if (request('page') > 1) {
            $page = request('page');
        }
        //calculate pages
        $sorts = DB::select($sql);
        $pages = ceil(count($sorts) / $itemsperpage);

        $skip = ($page - 1) * $itemsperpage;
        $sql = $sql . "  limit " . $limit . " offset " . $skip;
        $sorts = DB::select($sql);
        if (count($sorts) > 0) {
            foreach ($sorts as $sort) {
                if (isset($sort->main_photo))
                    $sort->main_photo = $_ENV['PHOTO_FOLDER'] . $sort->main_photo;
                $sort->responses_count=Response::where('item_id', $sort->id)
                    ->where('type', 'sort')
                    ->where('moderator', 'accepted')
                    ->count();
            }
        }
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'pages'=>$pages,
            'page' => $page,
            'cultures' => $sorts,
            'sql' =>$sql,
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/sort/showfilter",
     *     operationId="show sort filter",
     *     description="show sort filter",
     *     summary="show sort filter",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     @SWG\Parameter(name="culture_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showfilter(Request $request){

        $culture=Culture::find($request->input('culture_id'));
        $filter=Filter_attributes::where('type', 'sort')
            ->whereRaw("((section_id=$culture->section_id AND culture_id=0) OR culture_id=$culture->id)" )
            ->with('attr_values')
            ->get();
        return response()->json([
            'success' => $filter ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'filter'=>$filter,
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/sort/show/{id}",
     *     operationId="Get sort",
     *     description="Get sort",
     *     summary="Get sort",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     @SWG\Parameter(name="id", description="sort ID", required=false, in="path", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function show($id)
    {
        $sort = Sort::where('id', '=', $id)
            ->first();
        //select photos
        $photos=Photos::where('item_id', '=', $id)
            ->where('type', 'sort')
            ->where('moderator', 'accepted')
            ->orderBy('is_main', 'desc')
            ->take(3)
            ->get();
        foreach ($photos as $photo){
            $photo['path']=$_ENV['PHOTO_FOLDER'].$photo['path'];
        }
        //calendar
        $operations=Sort_operation::all();
        $calendar=Sort_calendar::where('sort_id', $id)
            ->orderBy('year')
            ->get();
        //pests and diseases
        $pests=Pest_disease_relations::whereRaw(" pest_disease_type='pest' AND ((item_type = 'culture' AND item_id= ?) OR (item_type = 'sort' AND item_id= ?))", [$sort->culture_id, $sort->id]  )
            ->distinct()
            ->select('pest_disease_id')
            ->get();
        foreach ($pests as $item){
            $pest=Pest::find($item->pest_disease_id);
            if($pest){
                $item->name=$pest->name;
            }
        }
        $diseases=Pest_disease_relations::whereRaw(" pest_disease_type='disease' AND ((item_type = 'culture' AND item_id= ?) OR (item_type = 'sort' AND item_id= ?))", [$sort->culture_id, $sort->id]  )
            ->distinct()
            ->select('pest_disease_id')
            ->get();
        foreach ($pests as $item){
            $disease=Disease::find($item->pest_disease_id);
            if($disease){
                $item->name=$disease->name;
            }
        }

        //characteristics
        $characrteristics = Sort_charact_relation::where('sort_id', '=', $id)
            ->join('sort_characteristics', 'sort_characteristics.id', '=', 'sort_charact_relations.characteristic_id')
            ->orderBy('order', 'asc')
            ->get();
        foreach ($characrteristics as $characrteristic){
            $characrteristic['icon_path']=$_ENV['PHOTO_FOLDER'].$characrteristic['icon_path'];
        }
        //responses
        $responses_count=Response::where('item_id', '=', $id)
            ->where('type', 'sort')
            ->where('moderator', 'accepted')
            ->count();
        $categories=Category_relation::where('category_relations.target_id', $id)
            ->leftJoin('categories', 'categories.id', '=', 'category_relations.target_category')
            ->select('categories.id', 'categories.category')
            ->get();
        //sellers
        $sellers=Assortment::where("target_id", $id)
            ->where('assortments.type', 'sort')
            ->distinct()
            ->leftjoin('markets', 'markets.user_id', '=', 'assortments.owner_id')
            //->select('assortments.owner_id', 'markets.name', 'markets.address','markets.phone',  'markets.lat',  'markets.lng',  'markets.rating')
            ->select('assortments.owner_id', 'markets.*')
            ->orderBy('markets.rating', 'desc')
            ->get();
        foreach ($sellers as $seller){
            $seller->assotrment=Assortment::where('owner_id', $seller->owner_id)
                ->where('assortments.type', 'sort')
                ->where('target_id', $id)
                ->leftjoin('categories', "categories.id", '=', 'assortments.category_id')
                ->select('assortments.id', 'assortments.category_id', 'assortments.price', 'categories.category')
                ->get();
        }
        $places=Region::where('order_regions.item_id', $id)
            ->leftJoin('order_regions', 'regions.id', 'order_regions.region_id')
            ->where('order_regions.type', 'sort')
            ->select('regions.region_name','regions.id','order_regions.region_id','order_regions.count')
            ->get();
        $maxSells=Region::where('order_regions.item_id', $id)
            ->leftJoin('order_regions', 'regions.id', 'order_regions.region_id')
            ->where('order_regions.type', 'sort')
            ->select('regions.region_name','regions.id','order_regions.region_id','order_regions.count')
            ->max('order_regions.count');
        foreach ($places as $place){
            if($maxSells>0){
                $place->percent=$place->count/$maxSells*100;
            }else $place->percent=0;
        }

        return response()->json([
            'success' => $sort ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'sort' => $sort,
            'photos'=>$photos,
            'operations'=>$operations,
            'calendar'=>$calendar,
            'pests'=>$pests,
            'characteristics'=>$characrteristics,
            'categories'=>$categories,
            'responses_count' => $responses_count,
            'sellers'=>$sellers,
            'places'=>$places,
            'maxSells'=>$maxSells,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/sort/getCalendarChartData/{id}",
     *     operationId="Get  CalendarChartData",
     *     description="Get  CalendarChartData",
     *     summary="Get  CalendarChartData",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     @SWG\Parameter(name="id", description="sort ID", required=true, in="path", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */

    public function getCalendarChartData($id)
    {
        $sort_id = $id;

        $sort = Sort::where('id', $sort_id)->first();

        if( ! $sort ) {
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['Sort not found'],
                'data' => null
            ], 404);
        }

        $colorsDict = [
            0 => "transparent", 1 => "#286928", 2 => "#7c956c",   3 => "#b4b52a",
            4 => "#e17a0b",     5 => "#ab2b23", 6 => "#1f5d9d", 7 => "#7b1b61", 8 => "#2c3d22"
        ];
        $monthDict = [
            1 => "Январь", 2 => "Февраль", 3 => "Март",     4 => "Апрель",   5 => "Май",     6 => "Июнь",
            7 => "Июль",   8 => "Август",  9 => "Сентябрь", 10 => "Октябрь", 11 => "Ноябрь", 12 => "Декабрь"
        ];
        $operationDict = [];
        foreach (Sort_operation::all() as $operation) {
            $operationDict[$operation->id] = $operation->operation_name;
        }

        $data = [];
        $data[0] = [
            "nodeData" => ["age" => "", "color" => "transparent", "angle" => 320/13],
            "subData" => [[
                "nodeData" => ["age" => "4", "color" =>" transparent", "angle" => 320/13],
                "subData" => [[
                    "nodeData" => [ "age" => "3", "color" => "transparent", "angle" => 320/13],
                    "subData" => [[
                        "nodeData" => ["age" => "2", "color" => "transparent", "angle" => 320/13],
                        "subData" => [[
                            "nodeData" => ["age" => "1", "color" => "transparent", "angle" => 320/13],
                            "subData" => [[
                                "nodeData" => ["age" => "Год", "color" => "transparent", "angle" => 320/13]
                            ]]
                        ]]
                    ]]
                ]]
            ]]
        ];

        $years = [];
        foreach(Sort_calendar::all()->where('sort_id', $sort_id) as $year) {
            foreach (range(1, 12) as $month) {
                $years[$year->year][$month] = $year["m$month"] ?? 0;
            }
        }

        foreach (range(1, 12) as $month) {
            $yearColor = [
                1 => isset($years[1]) ? $colorsDict[$years[1][$month]] : "transparent",
                2 => isset($years[2]) ? $colorsDict[$years[2][$month]] : "transparent",
                3 => isset($years[3]) ? $colorsDict[$years[3][$month]] : "transparent",
                4 => isset($years[4]) ? $colorsDict[$years[4][$month]] : "transparent"
            ];
            $data[$month] = [
                "nodeData" => ["age" => "", "color" => "transparent", "angle" => 320/13],
                "subData" => [[
                    "nodeData" => ["age" => "", "color" => $yearColor[4], "angle" => 320/13, "text" => (isset($years[4][$month]) && $years[4][$month] != 0) ? "{$monthDict[$month]} 4 года: {$operationDict[$years[4][$month]]}" : ''],
                    "subData" => [[
                        "nodeData" => ["age" => "", "color" => $yearColor[3], "angle" => 320/13, "text" => (isset($years[3][$month]) && $years[3][$month] != 0) ? "{$monthDict[$month]} 3 года: {$operationDict[$years[3][$month]]}" : ''],
                        "subData" => [[
                            "nodeData" => ["age" => "", "color" => $yearColor[2], "angle" => 320/13, "text" => (isset($years[2][$month]) && $years[2][$month] != 0) ? "{$monthDict[$month]} 2 года: {$operationDict[$years[2][$month]]}" : ''],
                            "subData" => [[
                                "nodeData" => ["age" => "", "color" => $yearColor[1], "angle" => 320/13, "text" => (isset($years[1][$month]) && $years[1][$month] != 0) ? "{$monthDict[$month]} 1 года: {$operationDict[$years[1][$month]]}" : ''],
                                "subData" => [[
                                    "nodeData" => ["age" => $monthDict[$month], "color" => "transparent", "angle" => 320/13]
                                ]]
                            ]]
                        ]]
                    ]]
                ]]
            ];
        }

        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'data' => $data
        ], 200);
    }



//    public function answers($id){
//        //$id - id of response
//        $ansvers = Responses_answer::where('response_id', '=', $id)
//            ->join('profiles', 'profiles.id', '=', 'responses_answers.profile_id')
//            ->select('responses_answers.*', 'profiles.first_name','profiles.last_name', 'profiles.photo')
//            ->where('responses_answers.moderator', 'accepted')
//            ->orderBy('date', 'asc')
//            ->get();
//        foreach ($ansvers as $item) {
//            if (isset($item->photo))
//                $item->photo = $_ENV['PHOTO_AVA_FOLDER'] . $item->photo;
//        }
//        return response()->json([
//            'success' => $ansvers ? true : false,
//            'success-message' => [],
//            'errors-message' => [],
//            'response_id' => $id,
//            'ansvers'=>$ansvers,
//        ], 200);
//    }


    /**
     * @SWG\Post(
     *     path="/sort/createorder",
     *     operationId="createorder",
     *     description="createorder",
     *     summary="createorder",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="sort_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="sort_category_id", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="quantity", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function createorder(Request $request){
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authorizated',
                'request'=>$request->all(),
            ], 200);
        }
        $requestData=$request->all();
        if(isset($requestData['quantity'])){
            $requestData['quantity'] = str_replace(",",".", $requestData['quantity']);
        }
        if(isset($requestData['quantity'])){
            $requestData['quantity'] = str_replace(",",".", $requestData['quantity']);
        }
        $validator = Validator::make($requestData, [
            'sort_id' => 'integer|required',
            'sort_category_id'=> 'integer',
            'quantity'=>'numeric',
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }


        //parent order
        $order=Order::whereNull('owner_id')
            ->where('user_id', $user_id)
            ->first();
        if (!$order){
            $order=new Order;
            $order->user_id=$user_id;
            $order->status_id=1;
            $order->save();
        }
        $category_id=$request->input('sort_category_id');
        if(isset($category_id)){
            $category=Category::find($request->input('sort_category_id'));
            if(!isset($category)){
                return response()->json([
                    'errors-message' => 'wrong sort_category_id',
                    'request'=>$request->all(),
                ], 200);
            }
        }
        $sort=Sort::find($request->input('sort_id'));
        if(!isset($sort)){
            return response()->json([
                'errors-message' => 'this sort not exist',
                'request'=>$request->all(),
            ], 200);
        }

        $item = new Order_Item;
        $item->order_id=$order->id;
        $item->item_id=$request->input('sort_id');
        $item->type='sort';
        $category_id=$request->input('sort_category_id');
        if (isset($category_id)){
            $item->category_id=$request->input('sort_category_id');
        }
        if (isset($requestData['quantity'])){
            $item->quantity=$requestData['quantity'];
        }
        $item->save();
        return response()->json([
            'success' => $item ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'order_item'=>$item,
        ], 200);
    }

    //    Route::post('checkisordered', 'SortController@checkisordered');
    /**
     * @SWG\Post(
     *     path="/sort/checkisordered",
     *     operationId="check is sort in users order",
     *     description="check is sort in users order",
     *     summary="check is sort in users order",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="sort_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function checkisordered(Request $request){
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
        //check if exist
        $order=Order::where('user_id', $user_id)
            ->whereNull('owner_id')
            ->first();
        $ansver=false;
        if($order){
            $order_item_count=Order_Item::where('order_id', $order->id)
                ->where('item_id', $request->input('sort_id'))
                ->where('type', 'sort')
                ->count();
            if($order_item_count>0) $ansver=true;

        }

        return response()->json([
            'is_ordered' => $ansver,
            'request'=>$request->all(),
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/sort/addtousersort",
     *     operationId="add to user sort bookmark",
     *     description="add to user sort bookmark",
     *     summary="add to user sort bookmark",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="sort_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function addtousersort(Request $request){
        $this->middleware('auth:api');
        $user = auth()->user()->load('profile');
        $user_id = $user['id'];
        if (!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        //check if exist
        $user_sort_bookmark=User_sorts::where('user_id', $user_id)
            ->where('sort_id', $request->input('sort_id'))
            ->get();
        $count=$user_sort_bookmark->count();
        if ($count>0){
            return response()->json([
                'errors-message' => 'this item already exist',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $user_sort_bookmark=new User_sorts;
        $user_sort_bookmark->user_id=$user_id;
        $user_sort_bookmark->sort_id=$request->input('sort_id');
        $user_sort_bookmark->save();

        return response()->json([
            'success' => $user_sort_bookmark ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_sort_bookmark'=>$user_sort_bookmark,
            'request'=>$request->all(),
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/sort/deletefromsersort",
     *     operationId="delete from user sort bookmark",
     *     description="delete from user sort bookmark",
     *     summary="delete from user sort bookmark",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="sort_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function deletefromsersort(Request $request){
        $this->middleware('auth:api');
        $user = auth()->user()->load('profile');
        $user_id = $user['id'];
        if (!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        //check if exist
        $user_sort_bookmark=User_sorts::where('user_id', $user_id)
            ->where('sort_id', $request->input('sort_id'))
            ->delete();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'request'=>$request->all(),
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/sort/checkisusersort",
     *     operationId="check is sort in users",
     *     description="check is sort in users",
     *     summary="check is sort in users",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="sort_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function checkisusersort(Request $request){
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
        //check if exist
        $user_sort_bookmark=User_sorts::where('user_id', $user_id)
            ->where('sort_id', $request->input('sort_id'))
            ->get();
        $count=$user_sort_bookmark->count();
        $ansver=false;
        if ($count>0){
            $ansver=true;
        }

        return response()->json([
            'is_bookmarked' => $ansver,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('addtobookmark', 'SortController@addtobookmark');
//Route::post('checkisbookmark', 'SortController@checkisbookmark');
//Route::post('deletefrombookmark', 'SortController@deletefrombookmark');
    /**
     * @SWG\Post(
     *     path="/sort/addtobookmark",
     *     operationId="Add to user bookmark",
     *     description="Add to user bookmark",
     *     summary="Add to user bookmark  добавить в закладки",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="sort_id", required=true, in="query", type="integer"),
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
            ], 200);
        }
        $this->validate($request, [
            'sort_id' => 'integer|required',
        ]);
        $sort=Sort::find($request->input('sort_id'));
        if(!isset($sort)){
            return response()->json([
                'errors-message' => 'this item not exist',
                'request'=>$request->all(),
            ], 200);
        }
        $bookmark = new Bookmarks;
        $bookmark->type = 'sort';
        $bookmark->user_id = $user_id;
        $bookmark->folder_id = 0;
        $bookmark->target_id = $request->input('sort_id');
        $bookmark->save();
        return response()->json([
            'success' => $bookmark ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'bookmark' => $bookmark,
        ], 200);
    }

//Route::post('checkisbookmark', 'ChemicalController@checkisbookmark');

    /**
     * @SWG\Post(
     *     path="/sorts/checkisbookmark",
     *     operationId="check is sort in users bookmark",
     *     description="check is sort in users bookmark",
     *     summary="check is sort in users bookmark  проверить, есть ли в закладках",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="sort_id", required=true, in="query", type="integer"),
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
        if (!isset($user_id)) {
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id' => $user_id,
            ], 400);
        }
        $this->validate($request, [
            'sort_id' => 'integer|required',
        ]);
        //check if exist
        $user_bookmark = Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('sort_id'))
            ->where('type', 'sort')
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
//Route::post('deletefrombookmark', 'ChemicalController@deletefrombookmark');

    /**
     * @SWG\Post(
     *     path="/sort/deletefrombookmark",
     *     operationId="delete from user bookmark",
     *     description="delete from user bookmark",
     *     summary="delete from user bookmark удалить из закладок",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="sort_id", required=true, in="query", type="integer"),
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
        if (!isset($user_id)) {
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id' => $user_id,
                'request' => $request->all(),
            ], 400);
        }
        $this->validate($request, [
            'sort_id' => 'integer|required',
        ]);
        //check if exist
        $count = Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('sort_id'))
            ->where('type', 'sort')
            ->count();
        if(!$count){
            return response()->json([
                'errors-message' => 'item is not exist',
                'user_id' => $user_id,
                'request' => $request->all(),
            ], 400);
        }
        $user_bookmark = Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('sort_id'))
            ->where('type', 'sort')
            ->delete();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'request' => $request->all(),
        ], 200);
    }

//Route::post('showgeneralinfo', 'SortController@showgeneralinfo');
    /**
     * @SWG\Post(
     *     path="/sort/showgeneralinfo",
     *     operationId="show table with generalinfo",
     *     description="show table with generalinfo",
     *     summary="show table with generalinfo",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showgeneralinfo(Request $request){
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
        $general_info=Sort_ques_general_info::where('user_id', $user_id)->first();
        return response()->json([
            'success' => $general_info ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'general_info' => $general_info,
            'request'=>$request->all(),
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/sort/creategeneralinfo",
     *     operationId="create table with generalinfo",
     *     description="create table with generalinfo",
     *     summary="create table with generalinfo",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="region", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="locality", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="soil", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="high", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="precipitation", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function creategeneralinfo(Request $request){
        $this->middleware('auth:api');
        $user = auth()->user()->load('profile');
        $user_id = $user['id'];
        if (!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $general_info=new Sort_ques_general_info;
        $general_info->user_id=$user_id;
        $general_info->region=$request->input('region');
        $general_info->locality=$request->input('locality');
        $general_info->soil=$request->input('soil');
        $general_info->high=$request->input('high');
        $general_info->precipitation=$request->input('precipitation');
        $general_info->save();
        return response()->json([
            'success' => $general_info ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'general_info' => $general_info,
            'request'=>$request->all(),
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/sort/editgeneralinfo",
     *     operationId="edit table with generalinfo",
     *     description="edit table with generalinfo",
     *     summary="edit table with generalinfo",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="region", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="locality", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="soil", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="high", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="precipitation", required=false, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
* )
*/
    public function editgeneralinfo(Request $request){
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
        $general_info=Sort_ques_general_info::where('user_id', $user_id)->first();
        $region=$request->input('region');
        if (isset($region)){$general_info->region=$region;}
        $locality=$request->input('locality');
        if (isset($locality)){$general_info->locality=$locality;}
        $soil=$request->input('soil');
        if (isset($soil)){$general_info->soil=$soil;}
        $high=$request->input('high');
        if (isset($high)){$general_info->high=$high;}
        $precipitation=$request->input('precipitation');
        if (isset($precipitation)){$general_info->precipitation=$precipitation;}

        $general_info->user_id=$user_id;
        $general_info->region=$request->input('region');
        $general_info->locality=$request->input('locality');
        $general_info->soil=$request->input('soil');
        $general_info->high=$request->input('high');
        $general_info->precipitation=$request->input('precipitation');
        $general_info->save();
        return response()->json([
            'success' => $general_info ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'general_info' => $general_info,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('delgeneralinfo', 'SortController@delgeneralinfo');
    /**
     * @SWG\Post(
     *     path="/sort/delgeneralinfo",
     *     operationId="delete table with generalinfo",
     *     description="delete table with generalinfo",
     *     summary="delete table with generalinfo",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function delgeneralinfo(Request $request){
        $this->middleware('auth:api');
        $user = auth()->user()->load('profile');
        $user_id = $user['id'];
        if (!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $general_info=Sort_ques_general_info::where('user_id', $user_id)->first();
        $general_info->delete();

        return response()->json([
            'success' => $general_info ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'general_info' => $general_info,
            'request'=>$request->all(),
        ], 200);
    }
//    Route::post('indexquestionaries', 'SortController@indexquestionaries');
    /**
     * @SWG\Post(
     *     path="/sort/indexquestionaries",
     *     operationId="show all questionaries",
     *     description="show all with questionaries",
     *     summary="show all with questionaries",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function indexquestionaries(Request $request){
        $itemsperpage=5;

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
        $count=Sort_questionary::where('user_id', $user_id)->count();
        $pages=ceil($count/$itemsperpage);
        $page=1;
        if(isset($request['page'])){
            $page=$request['page'];
        }
        $take=$itemsperpage;
        $skip=($page-1)*$itemsperpage;
        $questionaries=Sort_questionary::where('user_id', $user_id)
            ->select('sort_questionaries.id', 'sort_questionaries.sort_id')
            ->take($take)
            ->skip($skip)
            ->get();



        foreach ($questionaries as $questionary){
            $sort=Sort::find($questionary->sort_id);
            $questionary->name=$sort->name;
            $questionary->photo=$_ENV['PHOTO_FOLDER'].$sort->main_photo;
        }

        return response()->json([
            'success' => $questionaries ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'page'=>$page,
            'pages'=>$pages,
            '$questionaries' => $questionaries,
            'request'=>$request->all(),
        ], 200);
    }

//Route::post('showquestionaries', 'SortController@showquestionaries');
    /**
     * @SWG\Post(
     *     path="/sort/showquestionaries",
     *     operationId="show questionary",
     *     description="show questionary",
     *     summary="show questionary",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="questionary_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showquestionaries(Request $request){
        $itemsperpage=5;

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
        $questionary_id=$request->input('questionary_id');
        $questionary=Sort_questionary::find($questionary_id);
        $sort=Sort::find($questionary->sort_id);
        $questionary->name=$sort->name;
        $questionary->photo=$_ENV['PHOTO_FOLDER'].$sort->main_photo;


        return response()->json([
            'success' => $questionary ? true : false,
            'success-message' => [],
            'errors-message' => [],
            '$questionary' => $questionary,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('createquestionaries', 'SortController@createquestionaries');

    /**
     * @SWG\Post(
     *     path="/sort/createquestionaries",
     *     operationId="create table with questionaries",
     *     description="create table with questionaries",
     *     summary="create table with questionaries",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="sort_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="generation", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="landing_area", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="seeding_date", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="cultivation_type", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="ground_transplantation_date", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="trimming_date", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="is_ill", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="artificial_irrigation", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="drip_irrigation", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="precipitation_from_planting", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="feeding_from_planting", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="artificial_irrigation_from_planting", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="harvest", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function createquestionaries(Request $request){
        $this->middleware('auth:api');
        $user = auth()->user()->load('profile');
        $user_id = $user['id'];
        if (!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $questionary=new Sort_questionary;
        $questionary->user_id=$user_id;
        $questionary->sort_id=$request->input('sort_id');
        $questionary->generation=$request->input('generation');
        $questionary->landing_area=$request->input('landing_area');
        $questionary->cultivation_type=$request->input('cultivation_type');
        $questionary->ground_transplantation_date=$request->input('ground_transplantation_date');
        $questionary->trimming_date=$request->input('trimming_date');
        $questionary->is_ill=$request->input('is_ill');
        $questionary->artificial_irrigation=$request->input('artificial_irrigation');
        $questionary->drip_irrigation=$request->input('drip_irrigation');
        $questionary->precipitation_from_planting=$request->input('precipitation_from_planting');
        $questionary->feeding_from_planting=$request->input('feeding_from_planting');
        $questionary->artificial_irrigation_from_planting=$request->input('artificial_irrigation_from_planting');
        $questionary->harvest=$request->input('harvest');
        $questionary->save();
        return response()->json([
            'success' => $questionary ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'general_info' => $questionary,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('editquestionaries', 'SortController@editquestionaries');
    /**
     * @SWG\Post(
     *     path="/sort/editquestionaries",
     *     operationId="edit table with questionaries",
     *     description="edit table with questionaries",
     *     summary="edit table with questionaries",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="questionary_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="generation", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="landing_area", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="seeding_date", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="cultivation_type", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="ground_transplantation_date", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="trimming_date", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="is_ill", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="artificial_irrigation", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="drip_irrigation", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="precipitation_from_planting", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="feeding_from_planting", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="artificial_irrigation_from_planting", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="harvest", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function editquestionaries(Request $request){
        $this->middleware('auth:api');
        $user = auth()->user()->load('profile');
        $user_id = $user['id'];
        if (!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $questionary=Sort_questionary::find($request->input('questionary_id'));
        $generation=$request->input('generation');
        if(isset($generation)){
            $questionary->generation=$request->input('generation');
        }
        $landing_area=$request->input('landing_area');
        if(isset($landing_area)){
            $questionary->landing_area=$request->input('landing_area');
        }
        $cultivation_type=$request->input('cultivation_type');
        if(isset($cultivation_type)){
            $questionary->cultivation_type=$request->input('cultivation_type');
        }
        $ground_transplantation_date=$request->input('ground_transplantation_date');
        if(isset($ground_transplantation_date)){
            $questionary->ground_transplantation_date=$request->input('ground_transplantation_date');
        }
        $trimming_date=$request->input('trimming_date');
        if(isset($trimming_date)){
            $questionary->trimming_date=$request->input('trimming_date');
        }
        $is_ill=$request->input('is_ill');
        if(isset($is_ill)){
            $questionary->is_ill=$request->input('is_ill');
        }
        $artificial_irrigation=$request->input('artificial_irrigation');
        if(isset($artificial_irrigation)){
            $questionary->artificial_irrigation=$request->input('artificial_irrigation');
        }
        $drip_irrigation=$request->input('drip_irrigation');
        if(isset($drip_irrigation)){
            $questionary->drip_irrigation=$request->input('drip_irrigation');
        }
        $precipitation_from_planting=$request->input('precipitation_from_planting');
        if(isset($precipitation_from_planting)){
            $questionary->precipitation_from_planting=$request->input('precipitation_from_planting');
        }
        $feeding_from_planting=$request->input('feeding_from_planting');
        if(isset($feeding_from_planting)){
            $questionary->feeding_from_planting=$request->input('feeding_from_planting');
        }
        $artificial_irrigation_from_planting=$request->input('artificial_irrigation_from_planting');
        if(isset($artificial_irrigation_from_planting)){
            $questionary->artificial_irrigation_from_planting=$request->input('artificial_irrigation_from_planting');
        }
        $harvest=$request->input('harvest');
        if(isset($harvest)){
            $questionary->harvest=$request->input('harvest');
        }
        $questionary->save();
        return response()->json([
            'success' => $questionary ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'general_info' => $questionary,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('delquestionaries', 'SortController@delquestionaries');
    /**
     * @SWG\Post(
     *     path="/sort/delquestionaries",
     *     operationId="delete table with questionaries",
     *     description="delete table with questionaries",
     *     summary="delete table with questionaries",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="questionary_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function delquestionaries(Request $request){
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
        $questionary=Sort_questionary::find($request->input('questionary_id'));
        $questionary->delete();
        return response()->json([
            'success' => $questionary ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'general_info' => $questionary,
            'request'=>$request->all(),
        ], 200);
    }

    //    Route::post('mooncalendar', 'SortController@mooncalendar');
    /**
     * @SWG\Post(
     *     path="/sort/mooncalendar",
     *     operationId="show moon calendar",
     *     description="show moon calendar",
     *     summary="show moon calendar",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="date", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function mooncalendar(Request $request){
        //morf_attribute
        $mord_attributes=[50, 51];


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

        $moon_phase=Moon_date::where('date', $request->input('date'))
            ->leftJoin('moon_phases', 'moon_phases.id', 'moon_dates.phase_id')
            ->first();
        $moon_phase->icon=$_ENV['PHOTO_FOLDER'].$moon_phase->icon;
        //sorts
        $sorts=User_sorts::where('user_id', $user_id)
            ->leftJoin('sorts', 'sorts.id', 'user_sorts.sort_id')
            ->orderBy('name')
            ->get();


        foreach ($sorts as $sort){
            $sort->main_photo=$_ENV['PHOTO_FOLDER'].$sort->main_photo;
            $sort->mothp_attribute=Filter_attr_entity::where('entity_type', 'culture')
                ->where('entity_id', $sort->culture_id)
                ->whereIn('filter_attr_entities.attribute_id', $mord_attributes)
                ->leftJoin('filter_attr_values','filter_attr_values.id', 'filter_attr_entities.attribute_value')
                ->first();
            if(isset($sort->mothp_attribute->attribute_id)){
                $sort->moon_date=Moon_date::where('date', $request->input('date'))
                    ->leftJoin('moon_phases', 'moon_phases.id', 'moon_dates.phase_id')
                    ->first();
                if(isset($sort->moon_date)){
                    $sort->moon_date->icon=$_ENV['PHOTO_FOLDER'].$sort->moon_date->icon;
                    $sort->actions=Moon_action::where('phase_type',$sort->moon_date->phase_type)
                        ->where('element', $sort->moon_date->element)
                        ->where('plant_attribute', $sort->mothp_attribute->id)
                        ->leftJoin('sort_operations', 'sort_operations.id', 'moon_actions.sort_operation_id')
                        ->get();
                    foreach ($sort->actions as $item){
                        $item->icon_path=$_ENV['PHOTO_FOLDER'].$item->icon_path;
                    }
                }
            }
        }
        return response()->json([
            'success' => $moon_phase ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'moon_phase' => $moon_phase,
            'sorts'=>$sorts,
            'request'=>$request->all(),
        ], 200);
    }
//    Route::post('pivottable', 'SortController@pivottable');
    /**
     * @SWG\Post(
     *     path="/sort/pivottable",
     *     operationId="show pivo ttable",
     *     description="show pivot table",
     *     summary="show pivot table сводная таблица",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function pivottable(Request $request){
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
        $user_sorts=User_sorts::where('user_id', $user_id)
            ->leftJoin('sorts', 'sorts.id', 'user_sorts.sort_id')
             ->get();
        foreach ($user_sorts as $item){
            $item->main_photo=$_ENV['PHOTO_FOLDER'].$item->main_photo;
            if(isset($item->sort_id)){
                $item->operations=Sort_calendar::where('sort_id', $item->sort_id)
                    ->orderBy('year', 'asc')
                    ->get();
                foreach ($item->operations as $operations){
                    if($operations->m1){
                        $operations->m1=Sort_operation::find($operations->m1);
                        $operations->m1->icon_path=$_ENV['PHOTO_FOLDER'].$operations->m1->icon_path;
                    }
                    if($operations->m2){
                        $operations->m2=Sort_operation::find($operations->m2);
                        $operations->m2->icon_path=$_ENV['PHOTO_FOLDER'].$operations->m2->icon_path;
                    }
                    if($operations->m3){
                        $operations->m3=Sort_operation::find($operations->m3);
                        $operations->m3->icon_path=$_ENV['PHOTO_FOLDER'].$operations->m3->icon_path;
                    }
                    if($operations->m4){
                        $operations->m4=Sort_operation::find($operations->m4);
                        $operations->m4->icon_path=$_ENV['PHOTO_FOLDER'].$operations->m4->icon_path;
                    }
                    if($operations->m5){
                        $operations->m5=Sort_operation::find($operations->m5);
                        $operations->m5->icon_path=$_ENV['PHOTO_FOLDER'].$operations->m5->icon_path;
                    }
                    if($operations->m6){
                        $operations->m6=Sort_operation::find($operations->m6);
                        $operations->m6->icon_path=$_ENV['PHOTO_FOLDER'].$operations->m6->icon_path;
                    }
                    if($operations->m7){
                        $operations->m7=Sort_operation::find($operations->m7);
                        $operations->m7->icon_path=$_ENV['PHOTO_FOLDER'].$operations->m7->icon_path;
                    }
                    if($operations->m8){
                        $operations->m8=Sort_operation::find($operations->m8);
                        $operations->m8->icon_path=$_ENV['PHOTO_FOLDER'].$operations->m8->icon_path;
                    }
                    if($operations->m9){
                        $operations->m9=Sort_operation::find($operations->m9);
                        $operations->m9->icon_path=$_ENV['PHOTO_FOLDER'].$operations->m9->icon_path;
                    }
                    if($operations->m10){
                        $operations->m10=Sort_operation::find($operations->m10);
                        $operations->m10->icon_path=$_ENV['PHOTO_FOLDER'].$operations->m10->icon_path;
                    }
                    if($operations->m11){
                        $operations->m11=Sort_operation::find($operations->m11);
                        $operations->m11->icon_path=$_ENV['PHOTO_FOLDER'].$operations->m11->icon_path;
                    }
                    if($operations->m12){
                        $operations->m12=Sort_operation::find($operations->m12);
                        $operations->m12->icon_path=$_ENV['PHOTO_FOLDER'].$operations->m12->icon_path;
                    }
                }
            }
        }
        $operations=Sort_operation::all();
        return response()->json([
            'success' => $user_sorts ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'sotrs' => $user_sorts,
            'opeartions'=>$operations,
        ], 200);
    }
    //    Route::post('pivottable', 'SortController@pivottable');
    /**
     * @SWG\Post(
     *     path="/sort/activity",
     *     operationId="sort activity",
     *     description="sort activity",
     *     summary="sort activity",
     *     produces={"application/json"},
     *     tags={"Sorts"},
     *     security={{"access_token":{}}},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function activity(Request $request){
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
        $user_sorts=User_sorts::where('user_id', $user_id)
            ->leftJoin('sorts', 'sorts.id', 'user_sorts.sort_id')
            ->get();
        foreach ($user_sorts as $item){
            $item->main_photo=$_ENV['PHOTO_FOLDER'].$item->main_photo;
            if(isset($item->sort_id)){
                $item->data=Category_relation::where('target_id', $item->sort_id)
                    ->leftJoin('categories', 'categories.id', 'category_relations.target_category')
                    ->get();
                foreach ($item->data as $category){
                    $category->popularity=Order_Item::where('type', 'sort')
                        ->where('item_id', $item->sort_id)
                        ->where('category_id',$category->target_category)
                        ->leftJoin('orders','order_items.order_id', 'orders.id' )
                        ->where('orders.status_id', '7')
                        ->sum('quantity');
                    $category->middle_price=Assortment::where('type', 'sort')
                        ->where('target_id', $item->sort_id)
                        ->where('category_id',$category->target_category)
                        ->leftJoin('profiles', 'profiles.user_id', 'assortments.owner_id')
                        ->where('profiles.is_seller', 1)
                        ->avg('price');
                    $category->min_price=Assortment::where('type', 'sort')
                        ->where('target_id', $item->sort_id)
                        ->where('category_id',$category->target_category)
                        ->leftJoin('profiles', 'profiles.user_id', 'assortments.owner_id')
                        ->where('profiles.is_seller', 1)
                        ->min('price');
                    $category->avg_order=Order_Item::where('type', 'sort')
                        ->where('item_id', $item->sort_id)
                        ->where('category_id',$category->target_category)
                        ->leftJoin('orders','order_items.order_id', 'orders.id' )
                        ->where('orders.status_id', '7')
                        ->avg('quantity');
                }
            }
        }
        $operations=Sort_operation::all();
        return response()->json([
            'success' => $user_sorts ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'sotrs' => $user_sorts,
            'opeartions'=>$operations,
        ], 200);
    }



}
