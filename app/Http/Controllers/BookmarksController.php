<?php

namespace App\Http\Controllers;

use App\Models\Bookmarks_folder;
use App\Models\Profile;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Bookmarks;
use App\Models\Pest;
use App\Models\Disease;
use App\Models\Handbook;
use App\Models\Chemical;
use Validator;


class BookmarksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @SWG\Get(
     *     path="/bookmarks/index",
     *     operationId="Get bookmarks (without folder - unsorted)",
     *     description="Get bookmarks (without folder - unsorted)",
     *     summary="Get bookmarks",
     *     produces={"application/json"},
     *     tags={"Bookmarks"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="folder_id", required=false, description="если пусто или равно 0, то те, которые не в папках) ", in="query", type="integer"),
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index(Request $request)
    {
        $itemsforpage = 15;

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
            'folder_id'=>'integer'
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }
        $folder_id = 0;
        if (isset($request['folder_id'])) {
            $folder_id = $request->input('folder_id');
        }

        $bookmarks_count = Bookmarks::where('user_id', $user_id)
            ->where('folder_id', $folder_id)
            ->count();
        $pages = ceil($bookmarks_count / $itemsforpage);
        $page = 1;
        if (isset($request['page'])) {
            $page = $request['page'];
        }
        $take = $itemsforpage;
        $skip = $itemsforpage * ($page - 1);
        $bookmarks = Bookmarks::where('user_id', $user_id)
            ->where('folder_id', $folder_id)
            ->take($take)
            ->skip($skip)
            ->get();

        foreach ($bookmarks as $bookmark) {
            $bookmark->date = date('Y-m-d', strtotime($bookmark->created_at));
            if ($bookmark->type == 'pest') {
                $pest = Pest::find($bookmark->target_id);
                if(isset($pest)){
                    $bookmark->name = $pest->name;
                    $bookmark->photo = $_ENV['PHOTO_FOLDER'] . $pest->main_photo;
                    $bookmark->text = $pest->description;
                    $bookmark->section_id=$pest->section_id;
                }else $bookmark->name='Удаленный объект';
            } elseif ($bookmark->type == 'disease') {
                $disease = Disease::find($bookmark->target_id);
                if(isset($disease)){
                    $bookmark->name = $disease->name;
                    $bookmark->photo = $_ENV['PHOTO_FOLDER'] . $disease->main_photo;
                    $bookmark->text = $disease->description;
                    $bookmark->section_id=$disease->section_id;
                }else $bookmark->name='Удаленный объект';
            } elseif ($bookmark->type == 'handbook') {
                $handbook = Handbook::find($bookmark->target_id);
                if(isset($handbook)){
                    $bookmark->name = $handbook->title;
                    $bookmark->photo = $_ENV['PHOTO_FOLDER'] . $handbook->main_photo;
                    $bookmark->text = $handbook->description;
                    $bookmark->section_id=$handbook->section_id;
                }else $bookmark->name='Удаленный объект';
            } elseif ($bookmark->type == 'chemical') {
                $chemical = Chemical::find($bookmark->target_id);
                if(isset($chemical)){
                    $bookmark->name = $chemical->name;
                    $bookmark->photo = $_ENV['PHOTO_FOLDER'] . $chemical->main_photo;
                    $bookmark->text = $chemical->description;
                }else $bookmark->name='Удаленный объект';
            } elseif ($bookmark->type == 'seller') {
                $seller = Profile::where('user_id', $bookmark->target_id)->first();
                if (isset($seller)){
                    $bookmark->name = $seller->first_name.' '.$seller->last_name;
                    $bookmark->photo =$seller->photo;
                    $bookmark->text = $seller->about_me_seller;
                }else $bookmark->name='Удаленный объект';
            }elseif ($bookmark->type == 'decorator') {
                $decorator = Profile::where('user_id', $bookmark->target_id)->first();
                if(isset($decorator)){
                    $bookmark->name = $decorator->first_name.' '.$decorator->last_name;
                    $bookmark->photo =$decorator->photo;
                    $bookmark->text = $decorator->about_me_decorator;
                }else $bookmark->name='Удаленный объект';
            }
            elseif ($bookmark->type == 'question') {
                $question = Question::where('id', $bookmark->target_id)->first();
                if(isset($question)){
                    $bookmark->name = $question->title;
                    $bookmark->photo ='';
                    $bookmark->text = $question->text;
                    $bookmark->section_id=$question->section_id;
                }else $bookmark->name='Удаленный объект';
            }
        }
        return response()->json([
            'success' => $bookmarks ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'pages' => $pages,
            'page' => $page,
            'bookmarks' => $bookmarks,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/bookmarks/changefolder",
     *     operationId="Change folder",
     *     description="Change folder",
     *     summary="Change folder",
     *     produces={"application/json"},
     *     tags={"Bookmarks"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="bookmark_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="folder_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function changefolder(Request $request)
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
            'folder_id' => 'required|integer',
            'bookmark_id' => 'required|integer',
        ]);
        $bookmark = Bookmarks::where('user_id', $user_id)
            ->where('id', $request->bookmark_id)
            ->first();
        $folder=Bookmarks::where('user_id',$user_id)
            ->where('id', $request->folder_id)
            ->first();
        if (!isset($bookmark) || !isset($folder) ) {
            return response()->json([
                'success' => false,
            ], 400);
        }
        $bookmark->folder_id = $request->folder_id;
        $bookmark->save();
        return response()->json([
            'success' => $bookmark ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'bookmark' => $bookmark,
        ], 200);
    }

//Route::post('showfolders', 'BookmarksController@showfolders');

    /**
     * @SWG\Post(
     *     path="/bookmarks/destroy",
     *     operationId="Destroy bookmarks",
     *     description="Destroy bookmarks",
     *     summary="Destroy bookmarks",
     *     produces={"application/json"},
     *     tags={"Bookmarks"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function destroy(Request $request)
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
            'id' => 'required|integer',
        ]);
        $model = Bookmarks::where('user_id', $user_id)
            ->where('id', $request->input('id'))
            ->first();
        if(!isset($model)){
            return response()->json([
                'errors-message' => 'item not exist',
                'user_id' => $user_id,
            ], 400);
        }
        $model->delete();

        return response()->json([
            'success' => $model ? true : false,
            'success-message' => [],
            'errors-message' => [],
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/bookmarks/showfolders",
     *     operationId="Show folders",
     *     description="Show folders",
     *     summary="Show folders",
     *     produces={"application/json"},
     *     tags={"Bookmarks"},
     *     security={{"access_token":{}}},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showfolders()
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
        $folders = Bookmarks_folder::where('user_id', $user_id)
            ->get();
        return response()->json([
            'success' => $folders ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'folders' => $folders,
        ], 200);
    }
//Route::post('createfolder', 'BookmarksController@createfolder');

    /**
     * @SWG\Post(
     *     path="/bookmarks/createfolder",
     *     operationId="Create folder",
     *     description="Create folder",
     *     summary="Create folder",
     *     produces={"application/json"},
     *     tags={"Bookmarks"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="name", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function createfolder(Request $request)
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
            'name' => 'required|string',
        ]);
        $folder = new Bookmarks_folder;
        $folder->name = $request->input('name');
        $folder->user_id = $user_id;
        $folder->save();
        return response()->json([
            'success' => $folder ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'folder' => $folder,
        ], 200);
    }

//    Route::post('editfolder', 'BookmarksController@editfolder');

    /**
     * @SWG\Post(
     *     path="/bookmarks/editfolder",
     *     operationId="Edit folder",
     *     description="Edit folder",
     *     summary="Edit folder",
     *     produces={"application/json"},
     *     tags={"Bookmarks"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="folder_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="name", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function editfolder(Request $request)
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
            'name' => 'required|string',
        ]);
        $folder = Bookmarks_folder::where('user_id', $user_id)
            ->where('id', $request->input('folder_id'))
            ->first();
        if (!isset($folder)) {
            return response()->json([
                'errors-message' => 'item is not exist',
                'user_id' => $user_id,
            ], 400);
        }
        $folder->name = $request->input('name');
        $folder->save();
        return response()->json([
            'success' => $folder ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'folder' => $folder,
        ], 200);
    }
    //    Route::post('deletefolder', 'BookmarksController@deletefolder');

    /**
     * @SWG\Post(
     *     path="/bookmarks/deletefolder",
     *     operationId="Delete folder",
     *     description="Delete folder",
     *     summary="Delete folder",
     *     produces={"application/json"},
     *     tags={"Bookmarks"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="folder_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function deletefolder(Request $request)
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
        $folder = Bookmarks_folder::where('user_id', $user_id)
            ->where('id', $request->input('folder_id'))
            ->first();
        if (!isset($folder)) {
            return response()->json([
                'errors-message' => 'item is not exist',
                'user_id' => $user_id,
            ], 400);
        }
        $folder->delete();
        return response()->json([
            'success' => $folder ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'folder' => $folder,
        ], 200);
    }
}
