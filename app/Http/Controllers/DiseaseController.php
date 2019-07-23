<?php

namespace App\Http\Controllers;

use App\Models\Pest_disease_relations;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\Photos;
use App\Models\Disease_chemical;
use App\Models\Chemical;
use App\Models\Profile;
use App\Models\Bookmarks;
use App\Models\Filter_attributes;
use App\Models\Filter_attr_value;
use Illuminate\Support\Facades\DB;
use Validator;

class DiseaseController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/disease/index",
     *     operationId="Get diseases",
     *     description="Get diseases",
     *     summary="Get diseases",
     *     produces={"application/json"},
     *     tags={"Disease"},
     *     @SWG\Parameter(name="section_id", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="filter", required=false, description="25 26 48   - attribute values",  in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index()
    {
        $itemsperpage=5;
        $validator = Validator::make(request()->all(), [
            'page' => 'integer',
            'section_id'=>'integer|required',
        ]);

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
            $sql='SELECT DISTINCT  diseases.id FROM diseases JOIN filter_attr_entities ON diseases.id = filter_attr_entities.entity_id WHERE filter_attr_entities.entity_type="disease" ';
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
                    'diseases' => [],
                ], 200);
            }

        }
        //create sql
        $sql="select `id`, `name`, `slug`, `main_photo`, `description`, `date` from `diseases`";
        $sql=$sql.' where `section_id` = '.$section_id;
        if (count($item_ides)>0){
            $sql=$sql." and diseases.id IN (".implode(", ", $item_ides).")";
        }
        $limit =$itemsperpage;
        $page =1;
        if(request('page') > 1){
            $page=request('page');
        }
        //calculate pages
        $diseases=DB::select($sql);
        $pages=ceil(count($diseases)/$itemsperpage);
        $skip=($page-1)*$itemsperpage;
        $sql =$sql."  limit ".$limit." offset ".$skip;
        $diseases=DB::select($sql);

        if (count($diseases)>0) {
            foreach ($diseases as $disease) {
                if (isset($disease->main_photo))
                    $disease->main_photo = $_ENV['PHOTO_FOLDER'] . $disease->main_photo;
            }
        }
        return response()->json([
            'success' => $diseases ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'qql' =>$sql,
            'pages' => $pages,
            'page' => $page,
            'diseases' => $diseases,
        ], 200);
    }



    /**
     * @SWG\Post(
     *     path="/disease/show/{id}",
     *     operationId="Get disease",
     *     description="Get disease",
     *     summary="Get disease",
     *     produces={"application/json"},
     *     tags={"Disease"},
     *     @SWG\Parameter(name="id", description="disease ID", required=true, in="path", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function show($id)
    {
        $disease = Disease::where('id', '=', $id)
            ->first();
        if(!isset($disease)){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['item is not exist'],
            ], 401);
        }
        //select photos
        $photos = Photos::where('item_id', '=', $id)
            ->where('moderator', '=', 'accepted')
            ->orderBy('is_main', 'desc')
            ->take(3)
            ->get();
        foreach ($photos as $photo) {
            $photo['path'] = $_ENV['PHOTO_FOLDER'] . $photo['path'];
        }
        //characteristics
        $chemical = Disease_chemical::where('disease_id', $id)
            ->leftJoin('chemicals', 'chemicals.id', 'disease_chemicals.chemical_id')
            ->select('disease_chemicals.*', 'chemicals.name', 'chemicals.manufacturer')
            ->orderBy('name', 'asc')
            ->get();

        $cultures=Pest_disease_relations::where('pest_disease_type', 'disease')
            ->where('item_type', 'culture')
            ->where('pest_disease_id', $id)
            ->leftJoin('cultures', 'cultures.id', 'pest_disease_relations.item_id')
            ->get();


        return response()->json([
            'success' => $disease ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'disease' => $disease,
            'photos' => $photos,
            'chemicals' => $chemical,
            'cultures'=>$cultures,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/disease/addphoto",
     *     operationId="Add photo",
     *     description="Add photo",
     *     summary="Add photo,  добавить фото, фото не обображается, пока не подтвердит админ",
     *     produces={"application/json"},
     *     tags={"Disease"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="disease_id", description="disease ID", required=true, in="formData", type="integer"),
     *     @SWG\Parameter(name="photo", description="disease photo", required=true, in="formData", type="file"),
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
            'disease_id' => 'required|integer',
            'photo' => 'image|max:1999'
        ]);
        // Get filename with extension
        $disease_id = $request->input('disease_id');
        $disease=Disease::find($disease_id);
        if(!isset($disease)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 200);
        }
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filename = uniqid('disease'.$disease_id.'_photo_').".$extension";
        $request->file('photo')->storeAs("public", "disease/$filename");
        $photo_obj = Photos::create([
            'item_id' => $disease_id,
            'type' => 'disease',
            'is_main' => 0,
            'moderator' => 'new',
            'user_id'=>$user_id,
            'path' => "disease/$filename"
        ]);
        $photo_obj->save();
        return response()->json([
            'photo' => $photo_obj,
            'user_id' => $user_id,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/disease/addtobookmark",
     *     operationId="Add to user bookmark",
     *     description="Add to user bookmark",
     *     summary="Add to user bookmark",
     *     produces={"application/json"},
     *     tags={"Disease"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="disease_id", description="disease ID", required=true, in="query", type="integer"),
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
            'disease_id' => 'required|integer',
        ]);
        $disease=Disease::find($request->input('disease_id'));
        if(!isset($disease)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 400);
        }

        // Get filename with extension
        $bookmark=new Bookmarks;
        $bookmark->type='disease';
        $bookmark->user_id=$user_id;
        $bookmark->folder_id=0;
        $bookmark->target_id=$request->input('disease_id');
        $bookmark->save();
        return response()->json([
            'success' => $bookmark ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'bookmark' => $bookmark,
        ], 200);
    }
//Route::post('checkisbookmark', 'DiseaseController@checkisbookmark');

    /**
     * @SWG\Post(
     *     path="/disease/checkisbookmark",
     *     operationId="check is disease in users bookmark",
     *     description="check is disease in users bookmark",
     *     summary="check is disease in users bookmark",
     *     produces={"application/json"},
     *     tags={"Disease"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="disease_id", required=true, in="query", type="integer"),
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
        $this->validate($request, [
            'disease_id' => 'required|integer',
        ]);
        //check if exist
        $user_disease_bookmark=Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('disease_id'))
            ->where('type', 'disease')
            ->get();
        $count=$user_disease_bookmark->count();
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
     *     path="/disease/deletefrombookmark",
     *     operationId="delete from user disease bookmark",
     *     description="delete from user disease bookmark",
     *     summary="delete from user disease bookmark",
     *     produces={"application/json"},
     *     tags={"Disease"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="disease_id", required=true, in="query", type="integer"),
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
            'disease_id' => 'required|integer',
        ]);
        //check if exist
        $user_pest_bookmark=Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('disease_id'))
            ->where('type', 'disease')
            ->first();
        if(!isset($user_pest_bookmark)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }

        $user_pest_bookmark=Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('disease_id'))
            ->where('type', 'disease')
            ->delete();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'request'=>$request->all(),
        ], 200);
    }


    //        Route::post('showdiseasefilter', 'DiseaseController@showdiseasefilter');
    /**
     * @SWG\Post(
     *     path="/disease/showdiseasefilter",
     *     operationId="show disease filter",
     *     description="show disease filter",
     *     summary="show disease filter",
     *     produces={"application/json"},
     *     tags={"Disease"},
     *     @SWG\Parameter(name="section_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showdiseasefilter(Request $request){
        $this->validate($request, [
            'section_id' => 'required|integer',
        ]);
        $section=Section::find($request->input('section_id'));
        if(!isset($section)){
            return response()->json([
                'errors-message' => 'wrong section id',
            ], 400);
        }

        $filter=Filter_attributes::where('type', 'disease')
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
