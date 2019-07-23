<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_relation;
use App\Models\Chemical;
use App\Models\Filter_attr_value;
use App\Models\Order_Item;
use App\Models\Photos;
use App\Models\Region;
use App\Models\Сategory_relation;
use App\Models\Chemical_photos;
use App\Models\Filter_attributes;
use App\Models\Order;
use App\Models\Disease;
use App\Models\Disease_chemical;
use App\Models\Pest;
use App\Models\Pest_chemical;
use App\Models\Response;
use App\Models\Responses_answer;
use App\Models\Bookmarks;
use App\Models\Assortment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Validator;


class ChemicalController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/chemicals/index",
     *     operationId="Get chemicals  вывести все химикаты, в т ч фильтры, сортировка, номер страницы",
     *     description="Get chemicals  вывести все химикаты, в т ч фильтры, сортировка, номер страницы",
     *     summary="Get chemicals  вывести все химикаты, в т ч фильтры, сортировка, номер страницы",
     *     produces={"application/json"},
     *     tags={"Chemicals"},
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="filter", required=false, description="6 7 8 25       6-7 - attribute values",  in="query", type="string"),
     *     @SWG\Parameter(name="sorting", required=false, description="1-alphabet, 2 - manufacturer, 3- rating, 4 - topselled ",  in="query", type="string"),
     *     @SWG\Parameter(name="search_type", required=false, description="search by disease or pest",  in="query", type="string"),
     *     @SWG\Parameter(name="search_id", required=false, description="id of disease or pest",  in="query", type="string"),

     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */

    //TODO top selled сделаьб?
    public function index()
    {
        $itemsperpage = 10;
        $validator = Validator::make(request()->all(), [
            'page' => 'integer',
            'search_type'=> [ Rule::in(['disease', 'pest']),],
            'search_id'=>'integer',
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }
        $search_type=request()->get('search_type');
        $search_id=request()->get('search_id');
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
            $sql = 'SELECT DISTINCT  chemicals.id FROM chemicals JOIN filter_attr_entities ON chemicals.id = filter_attr_entities.entity_id WHERE filter_attr_entities.entity_type="chemical" ';
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
                    'pages' => 0,
                    'page' => 0,
                    'search_type'=>$search_type,
                    'search_id'=>$search_id,
                    'chemicals' => [],
                ], 200);
            }
        }elseif ($search_type && $search_id){
            $type=request()->get('search_type');
            $id=request()->get('search_id');
            $items=null;
            if($type=='pest'){
                $items=Pest_chemical::where('pest_id', $id)
                    ->select('chemical_id')
                    ->distinct()
                    ->get();
                foreach ($items as $item) {
                    array_push($item_ides, $item->chemical_id);
                }
            }else{
                $items=Disease_chemical::where('disease_id', $id)
                    ->select('chemical_id')
                    ->distinct()
                    ->get();
                foreach ($items as $item) {
                    array_push($item_ides, $item->chemiсal_id);
                }
            }
        }
        if(isset($filter_request)|| (isset($search_type) && isset($search_id))){
            if(count($item_ides)==0){
                return response()->json([
                    'success' => true,
                    'success-message' => [],
                    'errors-message' => [],
                    'pages' => 0,
                    'page' => 0,
                    'search_type'=>$search_type,
                    'search_id'=>$search_id,
                    'chemicals' => [],
                ], 200);
            }
        }
        //create sql
        $sql = "select `id`, `name`, `manufacturer`, `main_photo`, `average_price`, `topselled`, `rating`, `responses` from `chemicals`";
        if (count($item_ides) > 0) {
            $sql = $sql . " WHERE chemicals.id IN (" . implode(", ", $item_ides) . ")";
        }
        //ordering
        $ordering = request()->get('sorting');
        if (isset($ordering)) {
            if ($ordering == 1) {
                $sql = $sql . " ORDER BY chemicals.name ";
            } elseif ($ordering == 2) {
                $sql = $sql . " ORDER BY chemicals.manufacturer ";
            } elseif ($ordering == 3) {
                $sql = $sql . " ORDER BY chemicals.rating DESC";
            } elseif ($ordering == 4) {
                $sql = $sql . " ORDER BY chemicals.rating DESC";
            }
        }
        $limit = $itemsperpage;
        $page = 1;
        if (request('page') > 1) {
            $page = request('page');
        }
        //calculate pages
        $chemicals = DB::select($sql);
        $pages = ceil(count($chemicals) / $itemsperpage);

        $skip = ($page - 1) * $itemsperpage;
        $sql = $sql . "  limit " . $limit . " offset " . $skip;
        if (isset($filters) && (count($item_ides) == 0)) {
            $sql = "SELECT DISTINCT  chemicals.id FROM chemicals WHERE 0";
        }
        $chemicals = DB::select($sql);
        if (count($chemicals) > 0) {
            foreach ($chemicals as $chemical) {
                if (isset($chemical->main_photo))
                    $chemical->main_photo = $_ENV['PHOTO_FOLDER'] . $chemical->main_photo;
            }
        }
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'pages' => $pages,
            'page' => $page,
            'chemicals' => $chemicals,
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/chemicals/searchautocomplete",
     *     operationId="Get autocomplete for disease or pest",
     *     description="Get autocomplete for disease or pest",
     *     summary="Get autocomplete for disease or pest автозавершение для названия болезни или вредителя для поиска по болезни diseases, вредителю pests",
     *     produces={"application/json"},
     *     tags={"Chemicals"},
     *     @SWG\Parameter(name="text", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function searchautocomplete(Request $request)
    {
        $itemsperpage = 5;
        //select id
        $text=$request['text'];
        $this->validate($request, [
            'text' => 'string',
        ]);
        $items_d=Disease::where('name', 'LIKE', '%'.$text.'%' )
            ->select('id', 'name')
            ->orderBy('name')
            ->take($itemsperpage)
            ->get();
        $items_p=Pest::where('name', 'LIKE', '%'.$text.'%' )
            ->select('id', 'name')
            ->orderBy('name')
            ->take($itemsperpage)
            ->get();

        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'diseases' => $items_d,
            'pests' => $items_p,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/chemicals/show/{id}",
     *     operationId="Get chemical",
     *     description="Get chemical",
     *     summary="Get chemical отобразить один химикат, в нем chemical - сам химикат, pests, disease - против каких вредителей и болезней,  photos - фотки, responses - отзывы, categories - фасовка, sellers - продавцы, places - места ",
     *     produces={"application/json"},
     *     tags={"Chemicals"},
     *     @SWG\Parameter(name="id", description="Chemical ID", required=true, in="path", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function show($id)
    {
        if (!is_numeric($id)){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['id mast be integer'],
            ], 200);
        }
        $chemical = Chemical::where('id', '=', $id)
            ->get();
        if(count($chemical)==0){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['item not exist'],
                "request"=>request()->all(),
            ], 200);
        }
        $pests = Pest_chemical::where('chemical_id', '=', $id)
            ->join('pests', 'pests.id', '=', 'pest_chemicals.pest_id')
            ->select('pest_chemicals.*', 'pests.name')
            ->orderBy('name', 'asc')
            ->get();
        $disease = Disease_chemical::where('disease_chemicals.chemical_id', '=', $id)
            ->join('diseases', 'diseases.id', '=', 'disease_chemicals.disease_id')
            ->select('disease_chemicals.*', 'diseases.name')
            ->orderBy('name', 'asc')
            ->get();
        $photos = Photos::where('item_id', '=', $id)
            ->where('type', 'chemical')
            ->take(3)
            ->get();
        foreach ($photos as $photo) {
            $photo['path'] = $_ENV['PHOTO_FOLDER'] . $photo['path'];
        }
        $responses=Response::where('item_id', '=', $id)
            ->where('type', 'chemical')
            ->orderBy('date', 'desc')
            ->leftjoin('profiles', 'profiles.user_id', '=', 'responses.user_id')
            ->select('responses.*', 'profiles.first_name', 'profiles.last_name', 'profiles.photo', 'profiles.about_me')
            ->get();
        foreach ($responses as $item){
            $item->ansvers_count=Responses_answer::where('response_id',$item->id)
                ->count();
            if (isset($item->photo))
                $item->photo = $_ENV['PHOTO_AVA_FOLDER'] . $item->photo;
        }
        $categories=Category_relation::where('category_relations.target_id', $id)
            ->leftJoin('categories', 'categories.id', '=', 'category_relations.target_category')
            ->select('categories.id', 'categories.category')
            ->get();
        $sellers=Assortment::where("target_id", $id)
            ->where('assortments.type', 'chemical')
            ->distinct()
            ->leftjoin('markets', 'markets.user_id', '=', 'assortments.owner_id')
            ->select('assortments.owner_id', 'markets.name', 'markets.address','markets.phone',  'markets.lat',  'markets.lng',  'markets.rating')
            ->get();
        foreach ($sellers as $seller){
            $seller->assotrment=Assortment::where('owner_id', $seller->owner_id)
                ->where('assortments.type', 'chemical')
                ->where('target_id', $id)
                ->leftjoin('categories', "categories.id", '=', 'assortments.category_id')
                ->select('assortments.id', 'assortments.category_id', 'assortments.price', 'categories.category')
                ->get();
        }
        $places=Region::where('order_regions.item_id', $id)
            ->leftJoin('order_regions', 'regions.id', 'order_regions.region_id')
            ->where('order_regions.type', 'chemical')
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
            'success' => $chemical ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'chemical' => $chemical,
            'pests' => $pests,
            'diseases' => $disease,
            'photos' => $photos,
            'responses' =>$responses,
            'categories'=>$categories,
            'sellers'=>$sellers,
            'places' =>$places,
        ], 200);
    }

//    public function answers($id){
//        //$id - id of response
//        $ansvers = Responses_answer::where('response_id', '=', $id)
//            ->join('profiles', 'profiles.id', '=', 'responses_answers.profile_id')
//            ->select('responses_answers.*', 'profiles.first_name','profiles.last_name', 'profiles.photo')
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

//Route::post('createorder', 'ChemicalController@createorder');

    /**
     * @SWG\Post(
     *     path="/chemicals/createorder",
     *     operationId="create order",
     *     description="create order",
     *     summary="create order положить в корзину",
     *     produces={"application/json"},
     *     tags={"Chemicals"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="chemical_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="chemical_category_id", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="quantity", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function createorder(Request $request)
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
        $requestData=$request->all();
        if(isset($requestData['quantity'])){
            $requestData['quantity'] = str_replace(",",".", $requestData['quantity']);
        }
        if(isset($requestData['quantity'])){
            $requestData['quantity'] = str_replace(",",".", $requestData['quantity']);
        }
        $validator = Validator::make($requestData, [
            'chemical_id' => 'integer|required',
            'chemical_category_id'=> 'integer',
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
        $category_id=$request->input('chemical_category_id');
        if(isset($category_id)){
            $category=Category::find($request->input('chemical_category_id'));
            if(!isset($category)){
                return response()->json([
                    'errors-message' => 'wrong chemical_category_id',
                    'request'=>$request->all(),
                ], 200);
            }
        }
        $chemical=Chemical::find($request->input('chemical_id'));
        if(!isset($chemical)){
            return response()->json([
                'errors-message' => 'this chemical not exist',
                'request'=>$request->all(),
            ], 200);
        }

        $item = new Order_Item;
        $item->order_id=$order->id;
        $item->item_id=$request->input('chemical_id');
        $item->type='chemical';
        $category_id=$request->input('chemical_category_id');
        if (isset($category_id)){
            $item->category_id=$request->input('chemical_category_id');
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
//Route::post('checkisordered', 'ChemicalController@checkisordered');

    /**
     * @SWG\Post(
     *     path="/chemicals/checkisordered",
     *     operationId="check is chemicals in users order",
     *     description="check is chemicals in users order",
     *     summary="check is chemicals in users order  проверить, лежит ли в корзине",
     *     produces={"application/json"},
     *     tags={"Chemicals"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="chemical_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function checkisordered(Request $request)
    {
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
        $validator = Validator::make($request->all(), [
            'chemical_id' => 'integer|required',
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }
        //check if exist
        $order=Order::where('user_id', $user_id)
            ->whereNull('owner_id')
            ->first();
        $ansver=false;
        if($order){
            $order_item_count=Order_Item::where('order_id', $order->id)
                ->where('item_id', $request->input('chemical_id'))
                ->where('type', 'chemical')
                ->count();
            if($order_item_count>0) $ansver=true;
        }
        return response()->json([
            'is_ordered' => $ansver,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('addtobookmark', 'ChemicalController@addtobookmark');

    /**
     * @SWG\Post(
     *     path="/chemicals/addtobookmark",
     *     operationId="Add to user bookmark",
     *     description="Add to user bookmark",
     *     summary="Add to user bookmark  добавить в закладки",
     *     produces={"application/json"},
     *     tags={"Chemicals"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="chemical_id", required=true, in="query", type="integer"),
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
            'chemical_id' => 'integer|required',
        ]);
        $chemical=Chemical::find($request->input('chemical_id'));
        if(!isset($chemical)){
            return response()->json([
                'errors-message' => 'this item not exist',
                'request'=>$request->all(),
            ], 200);
        }
        $bookmark = new Bookmarks;
        $bookmark->type = 'chemical';
        $bookmark->user_id = $user_id;
        $bookmark->folder_id = 0;
        $bookmark->target_id = $request->input('chemical_id');
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
     *     path="/chemicals/checkisbookmark",
     *     operationId="check is chemicals in users bookmark",
     *     description="check is chemicals in users bookmark",
     *     summary="check is chemicals in users bookmark  проверить, есть ли в закладках",
     *     produces={"application/json"},
     *     tags={"Chemicals"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="chemical_id", required=true, in="query", type="integer"),
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
            'chemical_id' => 'integer|required',
        ]);
        //check if exist
        $user_disease_bookmark = Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('chemical_id'))
            ->where('type', 'chemical')
            ->get();
        $count = $user_disease_bookmark->count();
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
     *     path="/chemicals/deletefrombookmark",
     *     operationId="delete from user chemicals bookmark",
     *     description="delete from user chemicals bookmark",
     *     summary="delete from user chemicals bookmark удалить из закладок",
     *     produces={"application/json"},
     *     tags={"Chemicals"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="chemical_id", required=true, in="query", type="integer"),
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
            'chemical_id' => 'integer|required',
        ]);
        //check if exist
        $count = Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('chemical_id'))
            ->where('type', 'chemical')
            ->count();
        if(!$count){
            return response()->json([
                'errors-message' => 'item is not exist',
                'user_id' => $user_id,
                'request' => $request->all(),
            ], 400);
        }
        $user_bookmark = Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('chemical_id'))
            ->where('type', 'chemical')
            ->delete();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'request' => $request->all(),
        ], 200);
    }

//    Route::post('showchemicalfilter', 'ChemicalController@showchemicalfilter');

    /**
     * @SWG\Post(
     *     path="/chemicals/showchemicalfilter",
     *     operationId="show chemical filter",
     *     description="show chemical filter",
     *     summary="show chemical filter вывести фильтр химикатов",
     *     produces={"application/json"},
     *     tags={"Chemicals"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showchemicalfilter(Request $request)
    {
        $filter = Filter_attributes::where('type', 'chemical')
            ->with('attr_values')
            ->get();
        return response()->json([
            'success' => $filter ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'filter' => $filter,
        ], 200);
    }
}
