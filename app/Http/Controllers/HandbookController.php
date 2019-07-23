<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Filter_attr_value;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Handbook;
use App\Models\Handbook_photo;
use App\Models\Handbook_category;
use App\Models\Handbook_videolinks;
use App\Models\Bookmarks;
use App\Models\Filter_attributes;
use Illuminate\Support\Facades\DB;


class HandbookController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/handbook/index",
     *     operationId="Get handbooks",
     *     description="Get handbooks",
     *     summary="Get handbooks",
     *     produces={"application/json"},
     *     tags={"Handbook"},
     *     @SWG\Parameter(name="section_id", required=true, in="query", type="integer"),     *
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="filter", required=false, description="25 56  6-7 - attribute values",  in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index()
    {
        $itemsperpage=5;
        $this->validate(request(), [
            'section_id' => 'required|integer',
            'page'=>'integer',
        ]);

        $section_id = request()->get('section_id');
        $section=Section::find(request()->input('section_id'));
        if(!isset($section)){
            return response()->json([
                'errors-message' => 'section is not exist',
            ], 200);
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
            $sql='SELECT DISTINCT  handbooks.id FROM handbooks JOIN filter_attr_entities ON handbooks.id = filter_attr_entities.entity_id WHERE filter_attr_entities.entity_type="handbook" ';
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
                    'pages'=>0,
                    'page'=>0,
                    'handbooks' => [],
                ], 200);
            }
        }
        //create sql
        $sql="select `id`, `title`, `main_photo`, `description`, `date` from `handbooks`";
        $sql=$sql.' where `section_id` = '.$section_id;
        if (count($item_ides)>0){
            $sql=$sql." and handbooks.id IN (".implode(", ", $item_ides).")";
        }
        $limit =$itemsperpage;
        $page =1;
        if(request('page') > 1){
            $page=request('page');
        }
        if(isset($filters) && (count($item_ides)==0)){
            $sql = "SELECT DISTINCT  handbooks.id FROM handbooks WHERE 0";
        }

        //calculate pages
        $handbooks=DB::select($sql);
        $pages=ceil(count($handbooks)/$itemsperpage);

        $skip=($page-1)*$itemsperpage;
        $sql =$sql."  limit ".$limit." offset ".$skip;
        $handbooks=DB::select($sql);

        if (count($handbooks)>0) {
            foreach ($handbooks as $handbook) {
                if (isset($handbook->main_photo))
                    $handbook->main_photo = $_ENV['PHOTO_FOLDER'] . $handbook->main_photo;
            }
        }
        return response()->json([
            'success' => $handbooks ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'pages'=>$pages,
            'page'=>$page,
            'handbooks' => $handbooks,
        ], 200);
    }



    /**
     * @SWG\Post(
     *     path="/handbook/show/{id}",
     *     operationId="Get handbook",
     *     description="Get handbook",
     *     summary="Get handbook",
     *     produces={"application/json"},
     *     tags={"Handbook"},
     *     @SWG\Parameter(name="id", description="handbook ID", required=true, in="path", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function show($id)
    {
        $handbook = Handbook::where('id', '=', $id)
            ->get();
        if(count($handbook)==0){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['item is not exist'],
            ], 200);
        }

        foreach ($handbook as $item){
            $item->main_photo=$_ENV['PHOTO_FOLDER'].$item->main_photo;
        }

        //select photos
        $photos=Handbook_photo::where('handbook_id', '=', $id)
            //->where('moderator', '=', 'accepted')
            ->orderBy('is_main', 'desc')
            ->get();

        foreach ($photos as $photo){
            $photo['path']=$_ENV['PHOTO_FOLDER'].$photo['path'];
        }

        $videolinks = Handbook_videolinks::where('handbook_id', '=', $id)
            ->where('moderator', '=', 'accepted')
            ->orderBy('id', 'desc')
            ->get();


        return response()->json([
            'success' => $handbook ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'handbook' => $handbook,
            'photos'=>$photos,
            'videolinks'=>$videolinks,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/handbook/addvideolink",
     *     operationId="Work in POSTMAN",
     *     description="Add video link",
     *     summary="Work in POSTMAN",
     *     produces={"application/json"},
     *     tags={"Handbook"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="handbook_id", description="handbook ID", required=true, in="formData", type="integer"),
     *     @SWG\Parameter(name="title", description="link's title", required=true, in="formData", type="string"),
     *     @SWG\Parameter(name="link", description="link", required=true, in="formData", type="string"),
     *     @SWG\Parameter(name="photo", description="Нафиг не надо, но без него не работате", required=false, in="formData", type="file"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */


    public function addvideolink(Request $request)
    {
        $this->middleware('auth:api');
        $user=auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authorizated',
                'request'=>$request->all(),
            ], 200);
        }
        $this->validate($request, [
            'handbook_id' => 'required',
            'title' => 'required',
            'link' => 'required',
        ]);
        $item=Handbook::find($request->input('handbook_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
            ], 200);
        }
        $videolink = new Handbook_videolinks();
        $videolink->handbook_id = $request->input('handbook_id');
        $videolink->title = $request->input('title');
        $videolink->link =  $request->input('link');;
        $videolink->user_id =$user_id;
        $videolink->save();

        return response()->json([
            'user_id'=>$user_id,
            'videolink' =>$videolink,
        ], 200);
    }

    //Route::post('addtobookmark', 'PestController@addtobookmark');
    /**
     * @SWG\Post(
     *     path="/handbook/addtobookmark",
     *     operationId="Add to user bookmark",
     *     description="Add to user bookmark",
     *     summary="Add to user bookmark",
     *     produces={"application/json"},
     *     tags={"Handbook"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="handbook_id", description="handbook ID", required=true, in="query", type="integer"),
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
            'handbook_id' => 'required|integer',
        ]);
        $item=Handbook::find($request->input('handbook_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
            ], 200);
        }
        $bookmark=new Bookmarks;
        $bookmark->type='handbook';
        $bookmark->user_id=$user_id;
        $bookmark->folder_id=0;
        $bookmark->target_id=$request->input('handbook_id');
        $bookmark->save();
        return response()->json([
            'success' => $bookmark ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'bookmark' => $bookmark,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/handbook/checkisbookmark",
     *     operationId="check is handbook in users bookmark",
     *     description="check is handbook in users bookmark",
     *     summary="check is handbook in users bookmark",
     *     produces={"application/json"},
     *     tags={"Handbook"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="handbook_id", required=true, in="query", type="integer"),
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
            'handbook_id' => 'required|integer',
        ]);
        //check if exist
        $item=Handbook::find($request->input('handbook_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
            ], 200);
        }

        $user_pest_bookmark=Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('handbook_id'))
            ->where('type', 'handbook')
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
     *     path="/handbook/deletefrombookmark",
     *     operationId="delete from user handbook bookmark",
     *     description="delete from user handbook bookmark",
     *     summary="delete from user handbook bookmark",
     *     produces={"application/json"},
     *     tags={"Handbook"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="handbook_id", required=true, in="query", type="integer"),
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
            'handbook_id' => 'required|integer',
        ]);
        $item=Handbook::find($request->input('handbook_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
            ], 200);
        }


        //check if exist
        $user_pest_bookmark=Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('handbook_id'))
            ->where('type', 'handbook')
            ->delete();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'request'=>$request->all(),
        ], 200);
    }
//        Route::post('showfilter', 'HandbookController@showfilter');
    /**
     * @SWG\Post(
     *     path="/handbook/showfilter",
     *     operationId="show handbook filter",
     *     description="show handbook filter",
     *     summary="show handbook filter",
     *     produces={"application/json"},
     *     tags={"Handbook"},
     *     @SWG\Parameter(name="section_id", required=false, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showfilter(Request $request){
        $this->validate($request, [
            'section_id' => 'required|integer',
        ]);
        $item=Section::find($request->input('section_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
            ], 200);
        }
        $filter=Filter_attributes::where('type', 'handbook')
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
//Route::post('addarticle', 'HandbookController@addarticle');
    /**
     * @SWG\Post(
     *     path="/handbook/addarticle",
     *     operationId="Add article",
     *     description="Add particle",
     *     summary="Add article",
     *     produces={"application/json"},
     *     tags={"Handbook"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="article", description="doc, docs, pdf or other", required=true, in="formData", type="file"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function addarticle(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user()->load('profile');
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authorizated',
                'request'=>$request->all(),
            ], 200);
        }
        // Get filename with extension
        $extension = $request->file('article')->getClientOriginalExtension();
        $filename = uniqid('article_').".$extension";
        $request->file('article')->storeAs("public", "article/$filename");
        $article_obj=new Article;
        $article_obj->user_id=$user_id;
        $article_obj->path= "article/$filename";
        $article_obj->save();
        return response()->json([
            'article_obj' => $article_obj,
            'user_id' => $user_id,
        ], 200);
    }
}
