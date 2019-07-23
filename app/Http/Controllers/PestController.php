<?php

namespace App\Http\Controllers;

use App\Models\Pest_disease_relations;
use App\Models\Photos;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Pest;
use App\Models\Pest_chemical;
use App\Models\Bookmarks;
use App\Models\Chemical;
use App\Models\Filter_attributes;
use App\Models\Filter_attr_entity;
use App\Models\Filter_attr_value;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;


class PestController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/pest/index",
     *     operationId="Get pests",
     *     description="Get pests",
     *     summary="Get pests",
     *     produces={"application/json"},
     *     tags={"Pests"},
     *     @SWG\Parameter(name="section_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="filter", required=false, description="25 26 27 6-7 - attribute values",  in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index(){
        $itemsperpage=5;
        $validator = Validator::make(request()->all(), [
            'page' => 'integer',
            'section_id'=>'integer|required',
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }
        $section_id = request()->get('section_id');
        $section=Section::find($section_id );
        if(!isset($section)){
            return response()->json([
                'errors-message' => 'wrong section_id',
            ], 400);
        }
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
        if (isset($filter_request)){
            $sql='SELECT DISTINCT  pests.id FROM pests JOIN filter_attr_entities ON pests.id = filter_attr_entities.entity_id WHERE filter_attr_entities.entity_type="pest" ';
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
                        'success' => $item_ides ? true : false,
                        'success-message' => [],
                        'errors-message' => [],
                        'qql' =>$sql,
                        'pages' => 0,
                        'page' => 0,
                        'pests' => [],
                    ], 200);
                }
        }
        //create sql
        $sql="select `id`, `name`, `slug`, `main_photo`, `description`, `date` from `pests`";
            $sql=$sql.' where `section_id` = '.$section_id;

        if (count($item_ides)>0){
            $sql=$sql." and pests.id IN (".implode(", ", $item_ides).")";
        }
        $limit =$itemsperpage;
        $page =1;
        if(request('page') > 1){
            $page=request('page');
        }
        //calculate pages
        $pests=DB::select($sql);
        $pages=ceil(count($pests)/$itemsperpage);

        $skip=($page-1)*$itemsperpage;
        $sql =$sql."  limit ".$limit." offset ".$skip;

        $pests=DB::select($sql);

        if (count($pests)>0) {
            foreach ($pests as $pest) {
                //$photo['path']="1";
                if (isset($pest->main_photo))
                    $pest->main_photo = $_ENV['PHOTO_FOLDER'] . $pest->main_photo;
            }
        }
        return response()->json([
            'success' => $pests ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'pages' => $pages,
            'page' => $page,
            'sql' =>$sql,
            'pests' => $pests,
        ], 200);
    }


    /**
     * @SWG\Post(
     *     path="/pest/show/{id}",
     *     operationId="Get pest",
     *     description="Get pest",
     *     summary="Get pest",
     *     produces={"application/json"},
     *     tags={"Pests"},
     *     @SWG\Parameter(name="id", description="pest ID", required=true, in="path", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function show($id)
    {
        $pest = Pest::where('id', '=', $id)
            ->get();
        if(count($pest)<1){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['item is not exist'],
            ], 200);
        }
        //select photos
        $photos = Photos::where('item_id', '=', $id)
            ->where('moderator', '=', 'accepted')
            ->where('type', '=', 'pest')
            ->orderBy('is_main', 'desc')
            ->take(3)
            ->get();
        foreach ($photos as $photo) {
            //$photo['path']="1";
            $photo['path'] = $_ENV['PHOTO_FOLDER'] . $photo['path'];
        }
        //characteristics
        $chemical = Pest_chemical::where('pest_id', '=', $id)
            ->join('chemicals', 'chemicals.id', '=', 'pest_chemicals.chemical_id')
            ->select('pest_chemicals.*', 'chemicals.name', 'chemicals.manufacturer')
            ->orderBy('name', 'asc')
            ->get();

        $cultures=Pest_disease_relations::where('pest_disease_type', 'pest')
            ->where('item_type', 'culture')
            ->where('pest_disease_id', $id)
            ->leftJoin('cultures', 'cultures.id', 'pest_disease_relations.item_id')
            ->get();

        return response()->json([
            'success' => $pest ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'pest' => $pest,
            'photos' => $photos,
            'chemicals' => $chemical,
            'cultures'=>$cultures,
        ], 200);

    }

    /**
     * @SWG\Post(
     *     path="/pest/addphoto",
     *     operationId="Add photo",
     *     description="Add photo",
     *     summary="Add photo",
     *     produces={"application/json"},
     *     tags={"Pests"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="pest_id", description="pest ID", required=true, in="formData", type="integer"),
     *     @SWG\Parameter(name="photo", description="pest photo", required=true, in="formData", type="file"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function add_photo(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user()->load('profile');
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authorizated',
            ], 200);
        }


        $this->validate($request, [
            'pest_id' => 'required',
            'photo' => 'image|max:1999'
        ]);
        // Get filename with extension
        $pest_id = $request->input('pest_id');
        $item=Pest::find($pest_id);
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 200);
        }
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filename = uniqid('pest'.$pest_id.'_photo_').".$extension";
        $request->file('photo')->storeAs("public", "pest/$filename");
        $photo_obj = Photos::create([
            'item_id' => $pest_id,
            'type' => 'pest',
            'is_main' => 0,
            'moderator' => 'new',
            'user_id'=>$user_id,
            'path' => "pest/$filename"
        ]);
        $photo_obj->save();
        return response()->json([
            'photo' => $photo_obj,
            'user_id' => $user_id,
        ], 200);
    }


    //Route::post('addtobookmark', 'PestController@addtobookmark');
    /**
     * @SWG\Post(
     *     path="/pest/addtobookmark",
     *     operationId="Add to user bookmark",
     *     description="Add to user bookmark",
     *     summary="Add to user bookmark",
     *     produces={"application/json"},
     *     tags={"Pests"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="pest_id", description="pest ID", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function addtobookmark(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user()->load('profile');
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authorizated',
                'request'=>$request->all(),
            ], 400);
        }
        $this->validate($request, [
            'pest_id' => 'required|integer',
        ]);
        $item=Pest::find($request->input('pest_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 200);
        }
        // Get filename with extension
        $bookmark=new Bookmarks;
        $bookmark->type='pest';
        $bookmark->user_id=$user_id;
        $bookmark->folder_id=0;
        $bookmark->target_id=$request->input('pest_id');
        $bookmark->save();
        return response()->json([
            'success' => $bookmark ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'bookmark' => $bookmark,
        ], 200);
    }
//Route::post('checkisbookmarked', 'PestController@checkisbookmarked');
    /**
     * @SWG\Post(
     *     path="/pest/checkisbookmark",
     *     operationId="check is pest in users bookmark",
     *     description="check is pest in users bookmark",
     *     summary="check is pest in users bookmark",
     *     produces={"application/json"},
     *     tags={"Pests"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="pest_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function checkisbookmark(Request $request){
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
        $user_pest_bookmark=Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('pest_id'))
            ->where('type', 'pest')
            ->get();
        $count=$user_pest_bookmark->count();
        $ansver=false;
        if ($count>0){
            $ansver=true;
        }
        return response()->json([
            'is_bookmarked' => $ansver,
            'request'=>$request->all(),
        ], 200);
    }


//Route::post('deletefrombookmark', 'PestController@deletefrombookmark');
    /**
     * @SWG\Post(
     *     path="/pest/deletefrombookmark",
     *     operationId="delete from user pest bookmark",
     *     description="delete from user pest bookmark",
     *     summary="delete from user pest bookmark",
     *     produces={"application/json"},
     *     tags={"Pests"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="pest_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function deletefrombookmark(Request $request){
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
            'pest_id' => 'required|integer',
        ]);
        //check if exist
        $item=Pest::find($request->input('pest_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 400);
        }

        $user_bookmark=Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('pest_id'))
            ->where('type', 'pest')
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
     *     path="/pest/showpestfilter",
     *     operationId="show pest filter",
     *     description="show pest filter",
     *     summary="show pest filter",
     *     produces={"application/json"},
     *     tags={"Pests"},
     *     @SWG\Parameter(name="section_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showpestfilter(Request $request){
            $this->validate($request, [
                'section_id' => 'required|integer',
            ]);
            $section=Section::find($request->input('section_id'));
            if(!isset($section)){
                return response()->json([
                    'errors-message' => 'wrong section id',
                ], 400);
            }
            $filter=Filter_attributes::where('type', 'pest')
                ->where('section_id', $request->input('section_id'))
                ->with('attr_values')
                ->get();
            return response()->json([
                'success' => $filter ? true : false,
                'success-message' => [],
                'errors-message' => [],
                'filter'=>$filter,
            ], 200);
    }
}
