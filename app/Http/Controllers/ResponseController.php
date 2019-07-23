<?php

namespace App\Http\Controllers;


use App\Models\Response;
use App\Models\Responses_answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;


class ResponseController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/response/index",
     *     operationId="Get responses",
     *     description="Get responses",
     *     summary="Get responses",
     *     produces={"application/json"},
     *     tags={"Response"},
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="item_type", required=true, description="sort, chemical, seller, decorator",  in="query", type="string"),
     *     @SWG\Parameter(name="item_id", required=true, description="item id",  in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index(Request $request)
    {
        $itemsperpage=3;

        $validator=Validator::make($request->all(),[
           'page'=>'integer',
           'item_type'=>['required', Rule::in(['sort', 'chemical', 'seller', 'decorator'])],
           'item_id'=>'required|integer'
        ]);
        if ($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }
       // return 'wqert';
        $count=Response::where('type', $request->item_type)
            ->where('item_id', $request->item_id)
            ->where('moderator', 'accepted')
            ->count();
        $pages=ceil($count/$itemsperpage);
        $page=isset($request->page) ? $request->page : 1;
        $responses=Response::where('item_id', '=',  $request->item_id)
            ->where('type',  $request->item_type)
            ->where('moderator', 'accepted')
            ->take($itemsperpage)
            ->skip($itemsperpage*($page-1))
            ->orderBy('date', 'desc')
            ->leftjoin('profiles', 'profiles.user_id', '=', 'responses.user_id')
            ->select('responses.*', 'profiles.first_name', 'profiles.last_name', 'profiles.photo', 'profiles.about_me')
            ->get();
        foreach ($responses as $item){
            $item->ansvers_count=Responses_answer::where('response_id',$item->id)
                ->where('moderator', 'accepted')
                ->count();
            if (isset($item->photo))
                $item->photo = $_ENV['PHOTO_AVA_FOLDER'] . $item->photo;
        }

        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'pages'=>$pages,
            'page' => $page,
            'responses' => $responses,
        ], 200);

    }

    /**
     * @SWG\Post(
     *     path="/response/answers",
     *     operationId="Get  answers for  response",
     *     description="Get  answers for  response",
     *     summary="Get  answers for  response  получить комментарии к отзыву" ,
     *     produces={"application/json"},
     *     tags={"Response"},
     *     @SWG\Parameter(name="id", description="response id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function answers(Request $request){
        //$id - id of response
        $validator=Validator::make($request->all(),[
            'id'=>'required|integer',
            'page'=>'integer',
        ]);
        $id=$request->id;
        $ansvers = Responses_answer::where('response_id', '=', $id)
            ->join('profiles', 'profiles.id', '=', 'responses_answers.profile_id')
            ->select('responses_answers.*', 'profiles.first_name','profiles.last_name', 'profiles.photo')
            ->where('responses_answers.moderator', 'accepted')
            ->orderBy('date', 'asc')
            ->get();
        foreach ($ansvers as $item) {
            if (isset($item->photo))
                $item->photo = $_ENV['PHOTO_AVA_FOLDER'] . $item->photo;
        }
        return response()->json([
            'success' => $ansvers ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'response_id' => $id,
            'ansvers'=>$ansvers,
        ], 200);
    }

    //    Route::post('addresponse', 'SortController@addresponse');
    /**
     * @SWG\Post(
     *     path="/response/addresponse",
     *     operationId="Add  response",
     *     description="Add  response",
     *     summary="Add  response",
     *     produces={"application/json"},
     *     tags={"Response"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="item_type", required=true, description="sort, chemical, seller, decorator",  in="query", type="string"),
     *     @SWG\Parameter(name="item_id", required=true, description="item id",  in="query", type="integer"),
     *     @SWG\Parameter(name="rating", description="rating", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="text", description="response text", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function addresponse(Request $request){
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $rating = $request->input('rating');
        if (!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated ',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $validator=Validator::make($request->all(),[
            'item_type'=>['required', Rule::in(['sort', 'chemical', 'seller', 'decorator'])],
            'item_id'=>'required|integer',
            'rating'=>'required|integer|between:0,5',
        ]);

        if ($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }

        $responce=new Response();
        $responce->user_id=$user_id;
        $responce->item_id=$request->input('item_id');
        $responce->rating=$request->input('rating');;
        $responce->text=$request->input('text');
        $responce->date=date("Y-m-d");
        $responce->moderator='new';
        $responce->save();

        return response()->json([
            'success' => $responce ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'responce' => $responce,
        ], 200);
    }





}
