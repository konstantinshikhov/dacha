<?php

namespace App\Http\Controllers;

use App\Models\Assortment;
use App\Models\Category_relation;
use App\Models\Chemical;
use App\Models\Category;
use App\Models\Profile;
use App\Models\User_delivery_method;
use Illuminate\Http\Request;
use App\Models\Sort;
use App\Models\Tariff;
use App\Models\Market;
use Illuminate\Validation\Rule;
use Validator;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class AssortmentController extends Controller
{
//Route::post('index', 'AssortmentController@index');

    /**
     * @SWG\Post(
     *     path="/assortment/index",
     *     operationId="Show  assortment",
     *     description="Show  assortment",
     *     summary="Show  assortment отобразить продаваемые сотра или химикаты",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="type", required=true, description="sort or chemical", in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index(Request $request)
    {
        $itemsPerPage=5;
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authorizated',
                'request'=>$request->all(),
            ], 200);
        }
        $validator = Validator::make($request->all(), [
            'page' => 'integer',
            'type'=> ['required', Rule::in(['sort', 'chemical']),],
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }

        //select
        $items=Assortment::select('target_id')
            ->distinct()
            ->where('owner_id', $user_id)
            ->where('type', $request->input('type'))
            ->get();
        $count=$items->count();
        $pages = ceil($count / $itemsPerPage);
        $page = 1;
        $take = $itemsPerPage;
        if($request['page'] > 1){
            $page=$request['page'];
        }
        $skip=($page-1)*$itemsPerPage;
        $items=Assortment::select('target_id')
            ->where('owner_id', $user_id)
            ->where('type', $request->input('type'))
            ->skip($skip)
            ->take($take)
            ->distinct()
            ->get();
        foreach ($items as $item) {
            $entity='';
            if ($request->input('type')) {
                $entity=Sort::select('name', 'main_photo')
                    ->where('id', $item->target_id)
                    ->first();
            }else{
                $entity=Chemical::select('name', 'main_photo')
                    ->where('id', $item->target_id)
                    ->first();
            }

            $item->name=isset($entity->name) ? $entity->name : 'Unknown item';
            $item->main_photo =isset($entity->main_photo) ? $_ENV['PHOTO_FOLDER'] . $entity->main_photo : '';
            $item->categories=Assortment::where('owner_id', $user_id)
                ->where('target_id', $item->target_id)
                ->where('type', $request->input('type'))
                ->get();;
        }
        return response()->json([
            'success' => $items ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'pages' =>$pages,
            'page' =>$page,
            'count'=>$count,
            'items'=>$items,
            'user_id'=>$user_id,
            'request'=>$request->all(),
        ], 200);
    }

//        Route::post('indexreserves', 'AssortmentController@indexreserves');
    /**
     * @SWG\Post(
     *     path="/assortment/indexreserves",
     *     operationId="Show reserved objects",
     *     description="Show reserved objects",
     *     summary="Show reserved objects показать забронированное",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function indexreserves(Request $request)
    {
        $itemsPerPage=5;
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authorizated',
                'request'=>$request->all(),
            ], 200);
        }
        $validator = Validator::make($request->all(), [
            'page' => 'integer',
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }

        //select sorts
            $items=Assortment::select('target_id')
            ->distinct()
            ->where('owner_id', $user_id)
            ->where('type', 'chemical')
            ->get();
        $count=$items->count();
        $pages = ceil($count / $itemsPerPage);
        $page = 1;
        $take = $itemsPerPage;
        if($request['page'] > 1){
            $page=$request['page'];
        }
        $skip=($page-1)*$itemsPerPage;
        $items=Assortment::select('target_id')
            ->where('owner_id', $user_id)
            ->where('type', 'chemical')
            ->skip($skip)
            ->take($take)
            ->distinct()
            ->get();
        foreach ($items as $item) {
            $chemical=Chemical::select('chemicals.name', 'chemicals.main_photo')
                ->where('chemicals.id', $item->target_id)
                ->first();
            $item->name=$chemical->name;
            $item->main_photo = $_ENV['PHOTO_FOLDER'] . $chemical->main_photo;
            $assortments = Assortment::where('owner_id', $user_id)
                ->where('target_id', $item->target_id)
                ->where('type', 'chemical')
                ->get();
            $item->categories=$assortments;
        }
        return response()->json([
            'success' => $items ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'pages' =>$pages,
            'page' =>$page,
            'count'=>$count,
            'items'=>$items,
            'user_id'=>$user_id,
        ], 200);
    }

//
//    public function index_groups(Request $request)
//    {
//        $itemsPerPage=6;
//        $this->middleware('auth:api');
//        $user = auth()->user();
//        $user_id = $user['id'];
//        if(!isset($user_id)){
//            return response()->json([
//                'errors-message' => 'not authorizated',
//                'request'=>$request->all(),
//            ], 200);
//        }
//        $validator = Validator::make($request->all(), [
//            'page' => 'integer',
//        ]);
//        if($validator->fails()){
//            return response()->json([
//                'validator'=>$validator,
//                'fail'=>$validator->fails(),
//                'errors'=>$validator->errors(),
//            ], 200);
//        }
//
//        $items=Assortment::select('sort_id')
//            ->where('owner_id', $user_id)
//            ->get();
//        $count=$items->count();
//        $pages = ceil(count($items) / $itemsPerPage);
//        $page = 1;
//        $take = $itemsPerPage;
//        if(request('page') > 1){
//            $page=request('page');
//        }
//        $skip=($page-1)*$itemsPerPage;
//        $items=Assortment::select('sort_id')
//            ->where('owner_id', $user_id)
//            ->skip($skip)
//            ->take($take)
//            ->leftJoin('sorts','sorts.id', '=', 'assortments.sort_id')
//            ->select('assortments.*', 'sorts.name', 'sorts.main_photo')
//            ->get();
//
//        foreach ($items as $item) {
//            if(isset($item->main_photo)){
//                $item->main_photo=$_ENV['PHOTO_FOLDER'] .$item->main_photo;
//            }
//            $category_id=$item->sort_category_id;
//            $category=Category::find($category_id);
//            $item->sort_category=$category;
//        }
//        return response()->json([
//            'success' => $items ? true : false,
//            'success-message' => [],
//            'errors-message' => [],
//            'pages' =>$pages,
//            'count'=>$count,
//            'items'=>$items,
//            'user_id'=>$user_id,
//            'request'=>$request->all(),
//        ], 200);
//    }

//Route::post('showitemlist', 'AssortmentController@showitemlist');

    /**
     * @SWG\Post(
     *     path="/assortment/showitemlist",
     *     operationId="Show  items",
     *     description="Show  items",
     *     summary="Show  assortment отобразить все существующие сорта или химикаты",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="type", required=true, description="sort or chemical", in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showitemlist(Request $request)
    {
        $itemsPerPage=3;
        $validator = Validator::make($request->all(), [
            'page' => 'integer',
            'type'=> ['required', Rule::in(['sort', 'chemical']),],
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }
        $tems=[];
        $type=$request->input('type');
        $count=0;
        if($type=='sort'){
            $count=Sort::count();
        }else{
            $count=Chemical::count();
        }
        $pages = ceil($count / $itemsPerPage);
        $page=$request->input('page');
        $page=isset($page) ? $page : 1;
        $skip=($page-1)*$itemsPerPage;
        if($type=='sort'){
            $items=Sort::orderBy('name')
                ->take($itemsPerPage)
                ->skip($skip)
                ->get();
        }else{
            $items=Chemical::orderBy('name')
                ->take($itemsPerPage)
                ->skip($skip)
                ->get();
        }
        foreach ($items as $item) {
            $item->main_photo =isset($item->main_photo) ? $_ENV['PHOTO_FOLDER'] . $item->main_photo : '';
        }
        return response()->json([
            'success' => $items ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'pages' =>$pages,
            'page' =>$page,
            'count'=>$count,
            'items'=>$items,
            'request'=>$request->all(),
        ], 200);
    }
//        Route::post('showitemcategories', 'AssortmentController@showitemcategories');

    /**
     * @SWG\Post(
     *     path="/assortment/showitemcategories",
     *     operationId="Show  item categories",
     *     description="Show  item categories",
     *     summary="Show  categories отобразить категории для конкретного сорта или химикаты",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     @SWG\Parameter(name="item_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="type", required=true, description="sort or chemical", in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showitemcategories(Request $request)
    {
        $itemsPerPage=3;
        $validator = Validator::make($request->all(), [
            'item_id' => 'integer|required',
            'type'=> ['required', Rule::in(['sort', 'chemical']),],
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }
        $tems=[];
        $type=$request->input('type');
        $count=0;
        if($type=='sort'){
            $count=Sort::count();
        }else{
            $count=Chemical::count();
        }
        if($count<1){
            return response()->json([
                'errors-message' => 'wrong item id',
                'request'=>$request->all(),
            ], 200);
        }
        $categories=Category_relation::select('categories.*')
            ->where('category_relations.type', $request->input('type'))
            ->where('target_id', $request->input('item_id'))
            ->leftJoin('categories', 'categories.id', 'category_relations.target_category')
            ->get();
        return response()->json([
            'success' => $categories ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'categories'=>$categories,
            'request'=>$request->all(),
        ], 200);
    }

    /**
 * @SWG\Post(
 *     path="/assortment/create",
 *     operationId="create assortment item",
 *     description="create assortment item",
 *     summary="create assortment item",
 *     produces={"application/json"},
 *     tags={"Assortment"},
 *     security={{"access_token":{}}},
 *     @SWG\Parameter(name="item_id", required=true, in="query", type="integer"),
       @SWG\Parameter(name="type", description="sort or chemical", required=true, in="query", type="string"),
 *     @SWG\Parameter(name="category_id", required=true, in="query", type="integer"),
 *     @SWG\Parameter(name="quantity", required=false, in="query", type="string"),
 *     @SWG\Parameter(name="price", required=true, in="query", type="string"),
 *     @SWG\Response(
 *         response=200,
 *         description="Success",
 *     )
 * )
 */
    public function create(Request $request)
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
        if(isset($requestData['price'])){
            $requestData['price'] = str_replace(",",".", $requestData['price']);
        }
        if(isset($requestData['quantity'])){
            $requestData['quantity'] = str_replace(",",".", $requestData['quantity']);
        }
        $validator = Validator::make($requestData, [
            'item_id' => 'required|integer',
            'type'=> ['required', Rule::in(['sort', 'chemical']),],
            'category_id'=>'required|integer',
            'price'=>'required|numeric',
            'quantity'=>'numeric'
        ]);


        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }

        $assortment=Assortment::where('owner_id', $user_id)
            ->where('target_id', $request->input('item_id'))
            ->where('category_id', $request->input('category_id'))
            ->where('type', $request->input('type'))
            ->get();
        $count=$assortment->count();
        //return $count;

        if($count>0){
            return response()->json([
                'errors-message' => 'this item already exist',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 200);
        }
        //check max number of items
        $count=Assortment::select('target_id')
        ->where('owner_id', $user_id)
        ->where('category_id', $request->input('category_id'))
        ->distinct()
        ->count();
        $max_count=Profile::leftJoin('tariffs', 'tariffs.id', '=', 'profiles.tariff_id' )
            ->where('user_id', $user_id)
            ->select('profiles.user_id', 'profiles.tariff_id', 'tariffs.tariff_name', 'tariffs.max_sorts')
            ->first();
        $max_count=$max_count->max_sorts;
        if($count>=$max_count){
            return response()->json([
                'errors-message' => 'you rich max number of sorts or chemicals',
                'user_id'=>$user_id,
                'request'=>$request->all(),
                'max_count'=>$max_count,
            ], 200);
        }
        $assortment=new Assortment;
        $assortment->owner_id=$user_id;
        $assortment->target_id=$requestData['item_id'];
        $assortment->category_id=$requestData['category_id'];
        $assortment->type=$requestData['type'];
        $assortment->price=$requestData['price'];
        $assortment->quantity= isset($requestData['quantity']) ? $requestData['quantity'] : 0;
        $assortment->save();

        //recalculate price
        if ($assortment->type=='chemical' && $assortment->quantity>0){
            $chemical=Chemical::find($assortment->target_id);
            $chemical->average_price=Assortment::where('type', 'chemical')
                ->where('target_id',$assortment->target_id)
                ->where('quantity','>', '0' )
                ->avg('price');
            $chemical->save();
        }

        return response()->json([
            'success' => $assortment ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'max_count'=>$max_count,
            'count'=>$count,
            'request'=>$request->all(),
            'assortment_item'=>$assortment,
        ], 200);
    }



    /**
     * @SWG\Post(
     *     path="/assortment/edit",
     *     operationId="edit assortment item",
     *     description="edit assortment item",
     *     summary="edit assortment item",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="assortment_id", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="quantity", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="price", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function edit(Request $request)
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
        $assortment_id=$request->input('assortment_id');
        $assortment=Assortment::find($assortment_id);
        $owner_id=$assortment->owner_id;
        if($user_id!=$owner_id){
            return response()->json([
                'errors-message' => 'this item fot another user',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $quantity=$request->input('quantity');
        if(isset($quantity)){
            $assortment->quantity=$quantity;
        }
        $price=$request->input('price');
        if(isset($price)){
            $assortment->price=$price;
        }
        $assortment->save();
        //recalculate price
        if ($assortment->type=='chemical' && $assortment->quantity>0){
            $chemical=Chemical::find($assortment->target_id);
            $chemical->average_price=Assortment::where('type', 'chemical')
                ->where('target_id',$assortment->target_id)
                ->where('quantity','>', '0' )
                ->avg('price');
            $chemical->save();
        }
        return response()->json([
            'success' => $assortment ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
            'assortment_item'=>$assortment,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/assortment/delete",
     *     operationId="delete assortment item",
     *     description="delete assortment item",
     *     summary="delete assortment item, удалить из ассортимента. Удаление возможно, если не было брони или продаж.",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="assortment_id", required=true, in="query", type="string"),
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
        if (!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $this->validate($request, [
            'assortment_id' => 'required|integer',
        ]);
        $assortment_id=$request->input('assortment_id');
        $assortment=Assortment::find($assortment_id);
        if(!isset($assortment)){
            return response()->json([
                'errors-message' => 'this item is not exist',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $owner_id=$assortment->owner_id;
        if($user_id!=$owner_id){
            return response()->json([
                'errors-message' => 'this item fot another user',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $selled=$assortment->selled;
        $not_done=$assortment->not_done;
        if($selled!=0 || $not_done!=0){
            return response()->json([
                'errors-message' => 'item with orders can not to be deleted',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $assortment->delete();
        //recalculate price
        if ($assortment->type=='chemical' ){
            $chemical=Chemical::find($assortment->target_id);
            $chemical->average_price=Assortment::where('type', 'chemical')
                ->where('target_id',$assortment->target_id)
                ->where('quantity','>', '0' )
                ->avg('price');
            $chemical->save();
        }
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
        ], 200);
    }



    /**
     * @SWG\Post(
     *     path="/assortment/showcategories",
     *     operationId="Show categories",
     *     description="Show categories",
     *     summary="Show categories отобразить существующие категории для сортов и химикатов, н-р, ростки, расскада, урожай, пр",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    //Route::post('showcategories', 'AssortmentController@showcategories');
    public function showcategories(){
        $categories_sorts=Category::where('type', 'sort')
            ->orderBy('category')
            ->get();
        $categories_chemicals=Category::where('type', 'chemical')
            ->orderBy('category')
            ->get();

        return response()->json([
            'success' => $categories_sorts ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'categories_sorts'=>$categories_sorts,
            'categories_chemicals'=>$categories_chemicals,
        ], 200);
    }

//Route::post('showtariffs', 'AssortmentController@showtariffs');
    /**
     * @SWG\Post(
     *     path="/assortment/showtariffs",
     *     operationId="Show tariffs",
     *     description="Show tariffs",
     *     summary="Show tariffs отобразить тарифы для продавцов",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showtariffs(){
        $tariffs=Tariff::take(4)->get();
//        foreach ($tariffs as $tariff){
//            if($tariff->max_sorts>100000) $tariff->max_sorts='неограничено';
//            if($tariff->max_chemicals>100000) $tariff->max_chemicals='неограничено';
//        }
        return response()->json([
            'success' => $tariffs ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'tariffs'=>$tariffs,
        ], 200);
    }

//Route::post('createmarket', 'AssortmentController@createmarket');
    /**
     * @SWG\Post(
     *     path="/assortment/createmarket",
     *     operationId="create market",
     *     description="create market",
     *     summary="create market  создать магазин, один продавец может иметь несколько магазинов с одинаковым ассортиментом",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="name", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="address", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="description", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="phone", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="lat", required=false, in="query", type="number"),
     *     @SWG\Parameter(name="lng", required=false, in="query", type="number"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
//Route::post('createmarket', 'AssortmentController@createmarket');
    public function createmarket(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not autorized',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $requestData=$request->all();
        if(isset($requestData['lat'])) $requestData['lat'] = str_replace(",",".", $requestData['lat']);
        if(isset($requestData['lng'])) $requestData['lng'] = str_replace(",",".", $requestData['lng']);
        $validator = Validator::make($requestData, [
            'name' => 'required|string',
            'address'=> 'required|string',
            'phone'=>'required|string',
            'lat'=>'numeric',
            'lng'=>'numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'errors'=>$validator->errors(),
            ], 200);
        }

        $market=new Market;
        $market->user_id=$user_id;
        $market->name=$request->input('name');
        $market->address=$request->input('address');
        $market->phone=$request->input('phone');
        $market->description=$request->input('description');
        $market->lat=$request->input('lat');
        $market->lng=$request->input('lng');
        $market->save();
        return response()->json([
            'success' => $market ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
            '$arket'=>$market,
        ], 200);
    }
//Route::post('editmarket', 'AssortmentController@editmarket');
    /**
     * @SWG\Post(
     *     path="/assortment/editmarket",
     *     operationId="edit market",
     *     description="edit market",
     *     summary="edit market",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="market_id", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="name", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="address", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="description", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="phone", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="lat", required=false, in="query", type="number"),
     *     @SWG\Parameter(name="lng", required=false, in="query", type="number"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function editmarket(Request $request)
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
        $requestData=$request->all();
        if(isset($requestData['lat'])) $requestData['lat'] = str_replace(",",".", $requestData['lat']);
        if(isset($requestData['lng'])) $requestData['lng'] = str_replace(",",".", $requestData['lng']);
        $validator = Validator::make($requestData, [
            'market_id' => 'required|integer',
            'lat'=>'numeric',
            'lng'=>'numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'errors'=>$validator->errors(),
            ], 200);
        }

        $market_id=$request->input('market_id');
        $market=Market::find($market_id);
        if(!isset($market)){
            return response()->json([
                'errors-message' => 'item not exist',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $owner_id=$market->user_id;
        if($user_id!=$owner_id){
            return response()->json([
                'errors-message' => 'this item fot another user',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        if(isset($request['name'])){
            $market->name=$request["name"];
        }
        if(isset($request['lat'])){
            $market->lat=$request["lat"];
        }
        if(isset($request['lng'])){
            $market->lng=$request["lng"];
        }
        if(isset($request['address'])){
            $market->address=$request["address"];
        }
        if(isset($request['phone'])){
            $market->phone=$request["phone"];
        }
        if(isset($request['description'])){
            $market->phone=$request["description"];
        }
        $market->save();
        return response()->json([
            'success' => $market ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
            'market'=>$market,
        ], 200);
    }
//Route::post('deletemarket', 'AssortmentController@deletemarket');
    /**
     * @SWG\Post(
     *     path="/assortment/deletemarket",
     *     operationId="delete market",
     *     description="delete market",
     *     summary="delete market",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="market_id", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function deletemarket(Request $request)
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
            'market_id' => 'required|integer',
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'errors'=>$validator->errors(),
            ], 200);
        }
        $market_id=$request->input('market_id');
        $market=Market::find($market_id);
        if(!isset($market)){
            return response()->json([
                'errors-message' => 'this item not exist',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $owner_id=$market->user_id;
        if($user_id!=$owner_id){
            return response()->json([
                'errors-message' => 'this item fot another user',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $market->delete();
        return response()->json([
            'success' => $market ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
            'market'=>$market,
        ], 200);
    }
    //        Route::post('showmarketsbyproduct', 'AssortmentController@showmarketsbyproduct');
    /**
     * @SWG\Post(
     *     path="/assortment/showmarketsbyproduct",
     *     operationId="show markets by product",
     *     description="show markets by product",
     *     summary="show markets by product отобразить магазины по продукту, фильтрация по фасовке, категориям",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     @SWG\Parameter(name="item_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="item_type", required=true, description="sort or chemical", in="query", type="string"),
     *     @SWG\Parameter(name="category_id", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showmarketsbyproduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|integer',
            'item_type' => ['required', Rule::in('sort', 'chemical')],
            'category_id' => 'integer',
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'errors'=>$validator->errors(),
            ], 200);
        }
        $where=' 1';
        $category_id=$request->input('category_id');
        if(isset($category_id)){
            $where='category_id ='.$category_id;
        }
        $owners=Assortment::where('target_id', $request->input('item_id'))
            ->where('type', $request->input('item_type'))
            ->where('quantity','>', '0')
            ->leftJoin('profiles', 'profiles.user_id', 'assortments.owner_id')
            ->where('profiles.is_seller', '1')
            ->whereRaw($where)
            ->pluck('owner_id');
        $markets=Market::whereIn('user_id', $owners)
            ->orderBy('rating', 'desc')
            ->get();
        foreach ($markets as $market){
            $user_id=$market->user_id;
            if (isset($user_id)){
                if(isset($category_id)){
                    $market->assortments=Assortment::where('owner_id', $user_id)
                        ->where('assortments.type', $request->input('item_type'))
                        ->where('category_id', $category_id)
                        ->leftJoin('categories', 'categories.id', 'assortments.category_id')
                        ->get();
                }else{
                    $market->assortments=Assortment::where('owner_id', $user_id)
                        ->where('assortments.type', $request->input('item_type'))
                        ->leftJoin('categories', 'categories.id', 'assortments.category_id')
                        ->get();
                }
                $market->delivery=User_delivery_method::where('user_id',$user_id)
                    ->leftJoin('delivery_methods', 'delivery_methods.id', 'user_delivery_methods.method_id')
                    ->select('delivery_methods.*')
                    ->orderBy('delivery_methods.name')
                    ->get();
            }
        }
        return response()->json([
            'success' => $markets ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'market'=>$markets,
        ], 200);
    }
    //Route::post('export', 'AssortmentController@export');
    /**
     * @SWG\Post(
     *     path="/assortment/export",
     *     operationId="export to excel",
     *     description="export to excel",
     *     summary="export to excel",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     security={{"access_token":{}}},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function export(Request $request)
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
        $assortments=Assortment::where('owner_id', $user_id)
            ->get();
        $table=[['id','тип', 'Название', 'Категория','Количество','Цена']];
        foreach ($assortments as $item){
            $category=Category::find($item->category_id);
            if(!isset($category)){
                $item->category='категория удалена';
            }else{
                $item->category=$category->category;
            }
            if($item->type=='sort'){
                $entity=Sort::find($item->target_id);
                $item->name=isset($entity) ? $entity->name : 'Неизвестный сорт';
                $element=[$item->id,'сорт',$item->name, $item->category, $item->quantity, $item->price];
            }else{
                $entity=Chemical::find($item->target_id);
                $item->name=isset($entity) ? $entity->name : 'Неизвестный химикат';
                $element=[$item->id,'химикат',$item->name, $item->category, $item->quantity, $item->price];
            }
        }
        $assortments->sortBy('category')->sortBy('name')->sortBy('type');
        $sorted = $assortments->sort(function($a, $b) {
            if($a->type === $b->type) {
                if($a->name === $b->name) {
                    if ($a->category === $b->category){
                        return 0;
                    }
                    return $a->category < $b->category ? -1:1;
                }
                return $a->name < $b->name ? -1 : 1;
            }
            return $a->type > $b->type ? -1 : 1;
        });
        foreach ($sorted as $item){
            $type = $item->type=='sort' ? 'сорт' : 'химикат';
            $element=[$item->id,$type,$item->name, $item->category, $item->quantity, $item->price];
            array_push($table, [$item->id,$type,$item->name, $item->category, $item->quantity, $item->price]);
        }
        Excel::create('Export Data', function($excel) use ($table) {
            $excel->sheet('Sheetname', function($sheet) use($table) {
                $sheet->fromArray($table, null, 'A1', false, false);
            });
        })->export('xls');
        return response()->json([
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
            'assortments'=>$assortments,
        ], 200);
    }
//        Route::post('import', 'AssortmentController@import');
    /**
     * @SWG\Post(
     *     path="/assortment/import",
     *     operationId="import from excel",
     *     description="import from excel",
     *     summary="import from excel",
     *     produces={"application/json"},
     *     tags={"Assortment"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="file", required=true, in="formData", type="file"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function import(Request $request)
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
            'file' => 'required|file',
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'errors'=>$validator->errors(),
            ], 200);
        }
        $file = Input::file('file');
        $file_name = $file->getClientOriginalName();
        $file->move('files', $file_name);
        $results=Excel::load('files/'.$file_name)->get();
        foreach ($results as $item){
            $assortment=Assortment::where('owner_id', $user_id)
                ->where('id', $item->id)
                ->first();

            if($assortment){
                $assortment->quantity=0;
                if (!is_null($item->kolichestvo)){
                    $assortment->quantity=str_replace(",",".", $item->kolichestvo);
                }
                $assortment->price=floatval(str_replace(",",".", $item->tsena));
                $assortment->save();
                //recalculate price
                if ($assortment->type=='chemical' && $assortment->quantity>0){
                    $chemical=Chemical::find($assortment->target_id);
                    if($chemical){
                        $chemical->average_price=Assortment::where('type', 'chemical')
                            ->where('target_id',$assortment->target_id)
                            ->where('quantity','>', '0' )
                            ->avg('price');
                        $chemical->save();
                    }
                }
            }
        }
        return response()->json([
            'success-message' => [],
            'errors-message' => [],
            'request'=>$request->all(),
            'file_name'=>$file_name,
        ], 200);
    }
}
