<?php

namespace App\Http\Controllers;

use App\Models\Filter_attr_entity;
use App\Models\Filter_attr_value;
use App\Models\Photos;
use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\Decorator_roles;
use App\Models\Decorator_photo;
use App\Models\Decorator_project;
use App\Models\Decorator_roles_users;
use App\Models\Profile;
use App\Models\Filter_attributes;
use App\Models\Bookmarks;

use PhpParser\Node\Expr\Cast\Object_;
use Illuminate\Support\Facades\DB;

class DecoratorController extends Controller
{
    // TODO пройтись с валицацией и прочим
    /**
     * @SWG\Post(
     *     path="/decorator/index",
     *     operationId="Get all decorators",
     *     description="Get all decorators",
     *     summary="Get all decorators",
     *     produces={"application/json"},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="filter", required=false, description="25 26 48   - attribute values",  in="query", type="string"),
     *     @SWG\Parameter(name="sorting", required=false, description="1-price, 2 - rating, 3- alphabet, 4 - new",  in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index()
    {
        $itemsperpage = 10;
        //select id
        $filter_request=request()->get('filter');
        $filter_attributes_values_id=explode(' ', request()->get('filter'));
        $filter_attributes_values=Filter_attr_value::whereIN('id', $filter_attributes_values_id)
            ->get();
        $filter_attributes = Filter_attr_value::select('attribute_id')
            ->whereIn('id', $filter_attributes_values_id)
            ->distinct()
            ->get();
        $decorator_id = array();
        if (isset($filter_request)) {
            $sql = 'SELECT DISTINCT  profiles.user_id FROM profiles JOIN filter_attr_entities ON profiles.user_id = filter_attr_entities.entity_id WHERE filter_attr_entities.entity_type="decorator " ';
            foreach ($filter_attributes as $filter_attribute) {
                $sql=$sql.' AND ( filter_attr_entities.attribute_value IN (';
                foreach ($filter_attributes_values as $filter_attributes_value){
                    if ($filter_attributes_value->attribute_id==$filter_attribute->attribute_id){
                        $sql=$sql." $filter_attributes_value->id,";
                    }
                }
                $sql=substr($sql, 0, -1);
                $sql=$sql."))";
            }
            $decorators = DB::select($sql);
            foreach ($decorators as $item) {
                array_push($decorator_id, $item->user_id);
            }
            if(count($decorator_id)==0){
                return response()->json([
                    'success' => true,
                    'success-message' => [],
                    'errors-message' => [],
                    'decorators' => [],
                    'sql'=>$sql,
                ], 200);
            }
        }
        //create sql
        $sql = "select `user_id` AS id, `first_name`, `last_name`, `photo`, `rating_decorator`,`min_price_decorator`, `max_price_decorator`,`about_me_decorator` from `profiles` WHERE `is_decorator`='1'";

        if (count($decorator_id) > 0) {

            $sql = $sql . " AND profiles.user_id IN (" . implode(", ", $decorator_id) . ")";
        }
        //ordering
        $ordering = request()->get('sorting');
        if (isset($ordering)) {
            if ($ordering == 1) {
                $sql = $sql . " ORDER BY profiles.min_price_decorator ";
            } elseif ($ordering == 2) {
                $sql = $sql . " ORDER BY profiles.rating_decorator DESC";
            } elseif ($ordering == 3) {
                $sql = $sql . " ORDER BY profiles.first_name";
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
        $decorators = DB::select($sql);
        $pages = ceil(count($decorators) / $itemsperpage);

        $skip = ($page - 1) * $itemsperpage;
        $sql = $sql . "  limit " . $limit . " offset " . $skip;
        if (isset($filters) && (count($decorator_id) == 0)) {
            $sql = "SELECT DISTINCT  profiles.id FROM profiles WHERE 0";
        }
        $decorators = DB::select($sql);
        if (count($decorators) > 0) {
            foreach ($decorators as $item) {
                //$photo['path']="1";
                if (isset($item->photo))
                    $item->photo = $_ENV['PHOTO_AVA_FOLDER'] . $item->photo;
                $item->roles=Filter_attr_entity::where('entity_id', $item->id)
                    ->where('entity_type', 'decorator')
                    ->leftJoin('filter_attr_values', 'filter_attr_values.id', 'filter_attr_entities.attribute_value')
                    ->where('filter_attr_entities.attribute_id', '18')
                    ->get();
                $item->responces=Response::where('type', 'decorator')
                    ->where('item_id', $item->id)
                    ->count();
            }
        }
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'pages' => $pages,
            'page' => $page,
            'decorators' => $decorators,
        ], 200);
    }
//Route::post('showfilter', 'DecoratorController@showfilter');
    /**
     * @SWG\Post(
     *     path="/decorator/showfilter",
     *     operationId="show  filter",
     *     description="show  filter",
     *     summary="show  filter",
     *     produces={"application/json"},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="section_id", required=false, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showfilter(Request $request)
    {
        $filter = Filter_attributes::where('type', 'decorator')
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
     *     path="/decorator/show/{id}",
     *     operationId="Get decorator",
     *     description="Get decorator",
     *     summary="Get decorator",
     *     produces={"application/json"},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="id", description="user ID", required=true, in="path", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */

    public function show($id)
    {
        $user_id= $id;
        $profile=Profile::where('user_id', $user_id)
            ->get();
        $projects=Decorator_project::where('user_id',$user_id)
            ->where('is_published', '1')
            ->get();
        foreach ($projects as $project){
            $project['main_photo']=$_ENV['PHOTO_FOLDER'].$project['main_photo'];
        }

        $responses=Response::where('item_id', '=', $id)
            ->where('type', 'decorator')
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

        return response()->json([
            'user_id'=>$user_id,
            'profile'=>$profile,
            'responses' =>$responses,
            'projects'=>$projects,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/decorator/showproject/{id}",
     *     operationId="Get project",
     *     description="Get project",
     *     summary="Get project",
     *     produces={"application/json"},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="id", description="project ID", required=true, in="path", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */

    public function showproject($id)
    {
        $project=Decorator_project::where('id', $id)
            ->where('is_published', '1')
            ->first();
        $project['main_photo']=$_ENV['PHOTO_FOLDER'].$project['main_photo'];
        $photos=Photos::where('project_id', $id)
            ->get();
        foreach ($photos as $photo){
            $photo['path']=$_ENV['PHOTO_FOLDER'].$photo['path'];
        }

        return response()->json([
            'success' => $project ? true : false,
            'success-message' => [],
            'errors-message' => [],
            '$project'=>$project,
            'photos'=>$photos,
        ], 200);
    }



//Route::post('become/{id}', 'DecoratorController@become');//become decorator

    /**
     * @SWG\Post(
     *     path="/decorator/become",
     *     operationId="become decorator",
     *     description="become decorator",
     *     summary="become decorator",
     *     produces={"application/json"},
     *     security={{"access_token":{}}},
     *     tags={"Decorator"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */

    public function become()
    {
        $this->middleware('auth:api');
        $user=auth()->user()->load('profile');
        $user_id = $user['id'];
        $profile=Profile::where('user_id', $user_id)->first();
        $profile->is_decorator=1;
        $profile->save();

        return response()->json([
            'success' => $profile ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
        ], 200);
    }

    //Route::post('isdecorator/{id}', 'DecoratorController@isdecorator');//is decorator
    /**
     * @SWG\Post(
     *     path="/decorator/isdecorator/{id}",
     *     operationId="Check, is user decorator",
     *     description="Check, is user decorator",
     *     summary="Check, is user decorator",
     *     produces={"application/json"},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="id", description="user ID", required=true, in="path", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function isdecorator($id)
    {
        $profile=Profile::where('user_id', $id)->first();
        $result = ($profile->is_decorator==1) ? 'true' : 'false';
        return response()->json([
            'success' => $profile ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'isdecorator'=>$result,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/decorator/break",
     *     operationId="break status as decorator",
     *     description="break status as decorator",
     *     summary="break status as decorator",
     *     produces={"application/json"},
     *     security={{"access_token":{}}},
     *     tags={"Decorator"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
//Route::post('break', 'DecoratorController@break');//break decorator
    public function break()
    {
        $this->middleware('auth:api');
        $user=auth()->user()->load('profile');
        $user_id = $user['id'];
        $profile=Profile::where('user_id', $user_id)->first();
        $profile->is_decorator=0;
        $profile->save();
        $sql='UPDATE decorator_projects SET is_published=0 WHERE user_id='.$user_id;
        DB::statement($sql);
        return response()->json([
            'success' => $profile ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/decorator/getuserfilter",
     *     operationId="get user filter",
     *     description="get user filter",
     *     summary="get user filter",
     *     produces={"application/json"},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="user_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function getuserfilter(Request $request)
    {
        $user_id = $request->input('user_id');
        $profile=Profile::where('user_id', $user_id)->first();
        if($profile->is_decorator==0){
            return response()->json([
                'errors-message' => 'user is not decorator',
                'user_id'=>$user_id,
            ], 200);
        };
        $filterAtributesId=Filter_attr_entity::where('entity_type', 'decorator')
            ->where('entity_id', $user_id)
            ->distinct()
            ->pluck('attribute_id');
        $filterAtributes=Filter_attributes::whereIn('id', $filterAtributesId)->get();
        foreach ($filterAtributes as $filterAtribute) {
            $filterAtribute->values=Filter_attr_entity::where('entity_id', $user_id)
                ->where('entity_type', 'decorator')
                ->where('filter_attr_entities.attribute_id', $filterAtribute->id)
                ->leftJoin('filter_attr_values', 'filter_attr_values.id', 'filter_attr_entities.attribute_value')
                ->get();

        }
        return response()->json([
            'success' => $filterAtributesId ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'decorator_roles_users'=>$filterAtributes,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/decorator/setroles",
     *     operationId="set decorators role (согласовать с Д)",
     *     description="set decorators role (согласовать с Д)" ,
     *     summary="set decorators role (согласовать с Д)",
     *     produces={"application/json"},
     *     security={{"access_token":{}}},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="role_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
//Route::post('setroles', 'DecoratorController@setroles');
    public function setroles(Request $request)
    {
        $this->middleware('auth:api');
        $user=auth()->user();
        $user_id = $user['id'];
        $profile=Profile::where('user_id', $user_id)->first();
        if($profile->is_decorator==0){
            return response()->json([
                'errors-message' => 'user is not decorator',
                'user_id'=>$user_id,
            ], 200);
        };
        $decorator=Decorator::where('user_id', $user_id)->first();
        $decorator_id = $decorator->id;

        return response()->json([
            'success' => $profile ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/decorator/unsetroles",
     *     operationId="unset decorators role (согласовать с Д)",
     *     description="unset decorators role (согласовать с Д)",
     *     summary="unset decorators role (согласовать с Д)",
     *     produces={"application/json"},
     *     security={{"access_token":{}}},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="role_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
//Route::post('unsetroles', 'DecoratorController@setroles');
    public function unsetroles(Request $request)
    {
        $role_id=$request->input('role_id');
        $this->middleware('auth:api');
        $user=auth()->user();
        $user_id = $user['id'];
        $profile=Profile::where('user_id', $user_id)->first();

        $decorator=Decorator::where('user_id', $user_id)->first();
        $decorator_id = $decorator->id;
        $role=Decorator_roles_users::where('decorator_id', $decorator_id)
            ->where('decorator_roles_id',$role_id)
            ->first();
        $role->delete();
        $count=$role->count();
        if($role->count()==0){
            $decorator_roles_users=new Decorator_roles_users;
            $decorator_roles_users->decorator_id=$decorator_id;
            $decorator_roles_users->decorator_roles_id=$role_id;
            $decorator_roles_users->save();
        }
        $decorator_roles_users=Decorator_roles_users::where('decorator_id', $decorator_id)
            ->get();
        return response()->json([
            'success' => $profile ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'decorator_roles_users'=>$decorator_roles_users,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/decorator/createproject",
     *     operationId="create project",
     *     description="create project",
     *     summary="create project",
     *     produces={"application/json"},
     *     security={{"access_token":{}}},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="project_title", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="project_description", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
//Route::post('createproject', 'DecoratorController@createproject');//createproject decorator
    public function createproject(Request $request)
    {
        $project_title=$request->input('project_title');
        $project_description=$request->input('project_description');
        $this->middleware('auth:api');
        $user=auth()->user();
        $user_id = $user['id'];
        //return $user_id;
        $profile=Profile::where('user_id', $user_id)->first();
        if($profile->is_decorator==0){
            return response()->json([
                'errors-message' => 'user is not decorator',
                'user_id'=>$user_id,
            ], 200);
        };
        $decorator_project=new Decorator_project;
        $decorator_project->user_id=$user_id;
        $decorator_project->project_title=$project_title;
        $decorator_project->main_photo='';
        $decorator_project->description=$project_description;
        $decorator_project->save();

        return response()->json([
            'success' => $decorator_project ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'decorator_project'=>$decorator_project,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/decorator/editproject",
     *     operationId="editproject project",
     *     description="editproject project",
     *     summary="editproject project",
     *     produces={"application/json"},
     *     security={{"access_token":{}}},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="project_id", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="project_title", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="project_description", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="project_publish", required=false, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
//Route::post('editproject', 'DecoratorController@editproject');//editproject decorator
    public function editproject(Request $request)
    {
        $project_id=$request->input('project_id');
        $project_title=$request->input('project_title');
        $project_description=$request->input('project_description');
        $project_publish = $request->input('project_publish');
        $this->middleware('auth:api');
        $user=auth()->user();
        $user_id = $user['id'];
        $decorator_project=Decorator_project::find($project_id);
        if (isset($project_title)){
            $decorator_project->project_title=$project_title;
        }
        if (isset($project_description)){
            $decorator_project->description=$project_description;
        }
        if (isset($project_publish)){
            $decorator_project->is_published=$project_publish;
        }
        $decorator_project->save();

        return response()->json([
            'success' => $decorator_project ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'decorator_project'=>$decorator_project,
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/decorator/deleteproject",
     *     operationId="deleteproject",
     *     description="deleteproject",
     *     summary="deleteproject",
     *     produces={"application/json"},
     *     security={{"access_token":{}}},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="project_id", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
//Route::post('deleteproject', 'DecoratorController@deleteproject');
    public function deleteproject(Request $request)
    {
        $project_id=$request->input('project_id');
        $this->middleware('auth:api');
        $user=auth()->user();
        $user_id = $user['id'];
        if(empty($user_id)){
            return response()->json([
                'success' => $user_id ? true : false,
                'success-message' => [],
                'errors-message' => 'not authentificated',
            ], 200);
        }
        $decorator_project=Decorator_project::find($project_id);
        $decorator_project->delete();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/decorator/addphoto",
     *     operationId="addphoto",
     *     description="addphoto",
     *     summary="addphoto",
     *     produces={"application/json"},
     *     security={{"access_token":{}}},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="project_id", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="photo", required=true, in="formData", type="file"),
     *     @SWG\Parameter(name="is_main", required=false, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
//Route::post('addphoto', 'DecoratorController@addphoto');//
    public function addphoto(Request $request){
        $this->middleware('auth:api');
        $user=auth()->user()->load('profile');
        $user_id = $user['id'];
        // Get filename with extension
        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $project_id=$request->input('project_id');
        $filenameToStore = 'decorators/'.$project_id.'/'.time().'.'.$extension;
        $path= $request->file('photo')->storeAs('public',$filenameToStore);
        $photo = new Decorator_photo;
        $photo->project_id = $request->input('project_id');
        $photo->path =  $filenameToStore;
        $photo->save();
        if(!empty($request->input('is_main'))){
            if(($request->input('is_main'))==1){
                $project = Decorator_project::find($request->input('project_id'));
                $project->main_photo=$filenameToStore;
                $project->save();
            }
        }
        return response()->json([
            'filenameToStore'=>$filenameToStore,
            'photo'=>$photo,
            'user_id'=>$user_id,
            'path' =>$path,
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/decorator/editphoto",
     *     operationId="editphoto",
     *     description="editphoto",
     *     summary="editphoto",
     *     produces={"application/json"},
     *     security={{"access_token":{}}},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="photo_id", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="photo", required=false, in="formData", type="file"),
     *     @SWG\Parameter(name="is_main", required=false, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
//    Route::post('editphoto', 'DecoratorController@editphoto');//
    public function editphoto(Request $request){
        $this->middleware('auth:api');
        $user=auth()->user()->load('profile');
        $user_id = $user['id'];
        // Get filename with extension
        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $pest_id=$request->input('pest_id');
        $filenameToStore = 'pest/'.$pest_id.'/'.time().$filename.'.'.$extension;
        $path= $request->file('photo')->storeAs('public',$filenameToStore);
        $photo = new Pest_photo;
        $photo->pest_id = $request->input('pest_id');
        $photo->is_main = 0;
        $photo->path =  $filenameToStore;
        $photo->user_id =$user_id;
        $photo->save();
        return response()->json([
            'filenameToStore'=>$filenameToStore,
            'photo'=>$photo,
            'user_id'=>$user_id,
            'path' =>$path,
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/decorator/deletephoto",
     *     operationId="delete photo",
     *     description="delete photo",
     *     summary="delete photo",
     *     produces={"application/json"},
     *     security={{"access_token":{}}},
     *     tags={"Decorator"},
     *     @SWG\Parameter(name="photo_id", required=true, in="formData", type="file"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
//Route::post('deletephoto', 'DecoratorController@deletephoto');//
    public function deletephoto(Request $request){
        $this->middleware('auth:api');
        $user=auth()->user();
        $user_id = $user['id'];
        // Get filename with extension



        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('photo')->getClientOriginalExtension();
        $pest_id=$request->input('pest_id');
        $filenameToStore = 'pest/'.$pest_id.'/'.time().$filename.'.'.$extension;
        $path= $request->file('photo')->storeAs('public',$filenameToStore);
        $photo = new Pest_photo;
        $photo->pest_id = $request->input('pest_id');
        $photo->is_main = 0;
        $photo->path =  $filenameToStore;
        $photo->user_id =$user_id;
        $photo->save();

        return response()->json([
            'filenameToStore'=>$filenameToStore,
            'photo'=>$photo,
            'user_id'=>$user_id,
            'path' =>$path,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/decorator/addtobookmark",
     *     operationId="Add to user bookmark",
     *     description="Add to user bookmark",
     *     summary="Add to user bookmark",
     *     produces={"application/json"},
     *     tags={"Decorator"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="decorator_id", description="decorator ID", required=true, in="query", type="integer"),
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
        $this->validate($request, [
            'decorator_id' => 'required',
        ]);
        // Get filename with extension
        $bookmark=new Bookmarks;
        $bookmark->type='decorator';
        $bookmark->user_id=$user_id;
        $bookmark->folder_id=0;
        $bookmark->target_id=$request->input('decorator_id');
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
     *     path="/decorator/checkisbookmark",
     *     operationId="check is in bookmark",
     *     description="check is in bookmark",
     *     summary="check is in bookmark",
     *     produces={"application/json"},
     *     tags={"Decorator"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="decorator_id", required=true, in="query", type="integer"),
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
        $user_bookmark=Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('decorator_id'))
            ->where('type', 'decorator')
            ->get();
        $count=$user_bookmark->count();
        $ansver=false;
        if ($count>0){
            $ansver=true;
        }
        return response()->json([
            'is_bookmarked' => $ansver,
            'request'=>$request->all(),
        ], 200);
    }


    /**
     * @SWG\Post(
     *     path="/decorator/deletefrombookmark",
     *     operationId="delete from user handbook bookmark",
     *     description="delete from user handbook bookmark",
     *     summary="delete from user handbook bookmark",
     *     produces={"application/json"},
     *     tags={"Decorator"},
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
        //check if exist
        $user_bookmark=Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('decorator_id'))
            ->where('type', 'decorator')
            ->delete();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('sendmessage', 'DecoratorController@sendmessage');
    /**
     * @SWG\Post(
     *     path="/decorator/sendmessage",
     *     operationId="Send message",
     *     description="Send message",
     *     summary="Send message",
     *     produces={"application/json"},
     *     tags={"Decorator"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="decorator_id", required=true, in="query", type="integer"),
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
        $notification->to=$request->input('decorator_id');
        $notification->type='decorator';
        $notification->text=$request->input('message');
        $notification->save();

        return response()->json([
            'success' => $notification ? true : false,
            'success-message' => [],
            'errors-message' => [],
        ], 200);
    }
}
