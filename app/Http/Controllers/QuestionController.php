<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Question;
use App\Models\Question_answer;
use App\Models\Filter_attributes;
use App\Models\Filter_attr_value;
use App\Models\Filter_attr_entity;
use App\Models\Bookmarks;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Validator;


class QuestionController extends Controller
{
//Route::get('index', 'QuestionController@index');
    /**
     * @SWG\Post(
     *     path="/question/index",
     *     operationId="show questions",
     *     description="show questions",
     *     summary="show questions",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     @SWG\Parameter(name="section_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="filter", required=false, description="15 25 15   attribute values,  числа строкой через пробел",  in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index(Request $request)
    {
        $itemsperpage = 10;
        //select id
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
            ], 400);
        }
        $section=Section::find($request->input('section_id'));
        if(!isset($section)){
            return response()->json([
                'errors-message' => 'wrong section id',
            ], 400);
        }
        $filter_request=request()->get('filter');
        $filter_attributes_values_id=explode(' ', request()->get('filter'));
        $filter_attributes_values=Filter_attr_value::whereIN('id', $filter_attributes_values_id)
            ->get();
        $filter_attributes = Filter_attr_value::select('attribute_id')
            ->whereIn('id', $filter_attributes_values_id)
            ->distinct()
            ->get();
        $items_ides = array();
        $items=0;
        if (isset($filter_request)) {
            $sql = "SELECT DISTINCT  questions.id FROM questions JOIN filter_attr_entities ON questions.id = filter_attr_entities.entity_id WHERE questions.moderator='accepted' AND filter_attr_entities.entity_type='question'";
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
            if (count($items_ides)==0){
                return response()->json([
                    'success' => true,
                    'success-message' => [],
                    'errors-message' => [],
                    'pages' => 0,
                    'page' => 0,
                    'questions' => [],
                ], 200);
            }
        }
        //create sql
        $sql = "select `id`, `user_id`, `title`, `text`, `time`, `date`, `comments_count` from `questions` WHERE questions.moderator='accepted' AND section_id=". $request['section_id'];
        if (count($items_ides) > 0) {
            $sql = $sql . " AND questions.id IN (" . implode(", ", $items_ides) . ")";
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
        $sql=$sql.'  ORDER BY  `id` DESC ';
        $sql = $sql . "  limit " . $limit . " offset " . $skip;
        $items = DB::select($sql);
        if (count($items) > 0) {
            foreach ($items as $item){
                $item->user=Profile::where('user_id', $item->user_id)
                    ->select('first_name', 'last_name', 'about_me', 'photo')
                    ->get();
            }
        }
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'pages' => $pages,
            'page' => $page,
            'questions' => $items,
        ], 200);
    }

//Route::post('showfilter', 'QuestionController@showfilter');
    /**
     * @SWG\Post(
     *     path="/question/showfilter",
     *     operationId="show filter",
     *     description="show filter",
     *     summary="show filter",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     @SWG\Parameter(name="section_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showfilter(Request $request)
    {
        $this->validate($request, [
            'section_id' => 'required|integer',
        ]);
        $section=Section::find($request->input('section_id'));
        if(!isset($section)){
            return response()->json([
                'errors-message' => 'wrong section id',
            ], 400);
        }
        $filters = Filter_attributes::where('section_id', $request['section_id'])
            ->where('type', 'question')
            ->get();
        foreach ($filters as $filter) {
            $filter->attributes=Filter_attr_value::where('attribute_id', $filter->id)
                ->get();
        }
        return response()->json([
            'success' => $filters ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'question' => $filters,
        ], 200);
    }
//Route::get('show/{id}', 'QuestionController@show');
    /**
     * @SWG\Post(
     *     path="/question/show/{id}",
     *     operationId="Get question",
     *     description="Get question",
     *     summary="Get question",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     @SWG\Parameter(name="id", required=true, in="path", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function show($id)
    {
        $question = Question::find($id);
        if(!isset($question)){
            return response()->json([
                'errors-message' => 'wrong id',
            ], 400);
        }
        $question->user=Profile::select('first_name', 'last_name', 'photo', 'about_me')
            ->where('user_id', $question->user_id)->first();
        $question->answers=Question_answer::where('question_id', $id)
            ->where('moderator', 'accepted')
            ->leftjoin('profiles', 'profiles.user_id' , 'question_answers.user_id')
            ->select('question_answers.id','question_answers.question_id','question_answers.user_id','profiles.first_name','profiles.last_name','profiles.about_me','profiles.photo' ,'question_answers.text','question_answers.date', 'question_answers.is_best')
            ->orderBy('question_answers.id', "DESC")
            ->orderBy('question_answers.is_best', "DESC")
            ->get();
        foreach ($question->answers as $item){
            if (isset($item->photo)) $item->photo = $_ENV['PHOTO_AVA_FOLDER'] . $item->photo;
        }
        $question->filter=Filter_attr_entity::where('entity_id', $id)
            ->where('entity_type', 'question')
            ->leftjoin('filter_attr_values', 'filter_attr_values.id' , 'filter_attr_entities.attribute_value')
            ->get();
        return response()->json([
            'success' => $question ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'question' => $question,
        ], 200);
    }
//Route::post('create', 'QuestionController@create');
    /**
     * @SWG\Post(
     *     path="/question/create",
     *     operationId="Create new question",
     *     description="Create new question",
     *     summary="Create new question",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="title", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="text", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="section_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="filters", required=false, description="[1, 2, 5] - array attributes values", in="query", type="string"),
     *     @SWG\Parameter(name="date", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="time", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function create()
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
        $this->validate(request(), [
            'title' => 'required|string',
            'text' => 'required|string',
            'section_id' => 'required|integer',
            'date'=>'required|date_format:Y-m-d',
            'time'=>'required|date_format:H:i',
        ]);
        $section=Section::find(request()->input('section_id'));
        if(!isset($section)){
            return response()->json([
                'errors-message' => 'wrong section id',
            ], 400);
        }
        $question=new Question;
        $question->user_id=$user_id;
        $question->title=request()->get('title');
        $question->text=request()->get('text');
        $question->section_id=request()->get('section_id');
        $question->date=request()->get('date');
        $question->time=request()->get('time');
        $question->save();
        $filters=request()->get('filters');
        if(isset($filters)){
            $filters = json_decode($filters);
            foreach ($filters as $filter) {
                $filter_attr_value=Filter_attr_value::find($filter);
                $filter_item=new Filter_attr_entity;
                $filter_item->entity_id=$question->id;
                $filter_item->entity_type='question';
                $filter_item->attribute_id=$filter_attr_value->attribute_id;
                $filter_item->attribute_value=$filter_attr_value->id;
                $filter_item->save();
            }
        }
        return response()->json([
            'success' =>  $question ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'question' => $question,
        ], 200);
    }
//Route::post('edit', 'QuestionController@edit');
    /**
     * @SWG\Post(
     *     path="/question/edit",
     *     operationId="edit question",
     *     description="edit question",
     *     summary="edit question",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="question_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="title", required=false, in="query", type="string"),     *
     *     @SWG\Parameter(name="text", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="filters", required=false, description="[1, 2, 5] - array attributes values", in="query", type="string"),
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
        if (!isset($user_id)) {
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id' => $user_id,
            ], 400);
        }
        $this->validate($request, [
            'question_id' => 'required|integer',
        ]);

        $question=Question::where('id', $request['question_id'])
            ->where('user_id', $user_id)
            ->first();
        if(!isset($question)){
            return response()->json([
                'errors-message' => 'wrong id',
            ], 400);
        }


        if(isset($request['title'])){
            $question->title=$request['title'];
        }
        if(isset($request['text'])){
            $question->title=$request['text'];
        }
        $question->save();
        $filters=request()->get('filters');
        if(isset($filters)){
            $filters = json_decode($filters);
            $filter_del=Filter_attr_entity::where('entity_id', $question->id)
                ->where('entity_type', 'question')
                ->delete();
            foreach ($filters as $filter) {
                $filter_attr_value=Filter_attr_value::find($filter);
                $filter_item=new Filter_attr_entity;
                $filter_item->entity_id=$question->id;
                $filter_item->entity_type='question';
                $filter_item->attribute_id=$filter_attr_value->attribute_id;
                $filter_item->attribute_value=$filter_attr_value->id;
                $filter_item->save();
            }
        }
        return response()->json([
            'success' =>  $question ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'question' => $question,
        ], 200);
    }
//Route::post('delete', 'QuestionController@delete');
    /**
     * @SWG\Post(
     *     path="/question/delete",
     *     operationId="delete question",
     *     description="delete question",
     *     summary="delete question",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="question_id", required=true, in="query", type="integer"),
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
        if (!isset($user_id)) {
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id' => $user_id,
            ], 400);
        }
        $question=Question::where('id', $request['question_id'])
            ->where('user_id', $user_id)
            ->delete();
        $answers=Question_answer::where('question_id',  $request['question_id'])
            ->get();
        foreach ($answers as $answer){
            $likes=Question_like::where('target_id',$answer->id)
                ->where('type', 'answer')
                ->delete();
        }
        $answers=Question_answer::where('question_id',  $request['question_id'])
            ->delete();
        //delete from filters
        $filters = Filter_attr_entity::where('entity_id', $request['question_id'])
            ->where('entity_type', 'question')
            ->delete();
        return response()->json([
            'success' =>  $question ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'question' => $question,
        ], 200);
    }

//Route::post('createanswer', 'QuestionController@createanswer');
    /**
     * @SWG\Post(
     *     path="/question/createanswer",
     *     operationId="Create new answer",
     *     description="Create new answer",
     *     summary="Create new answer",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="question_id", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="text", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="date", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function createanswer()
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
        $this->validate(request(), [
            'text' => 'required|string',
            'question_id' => 'required|integer',
            'date'=>'required|date_format:Y-m-d',
        ]);
        $question= Question::find(request()->get('question_id'));
        if(!isset($question)){
            return response()->json([
                'errors-message' => 'wrong question id',
            ], 400);
        }
        if ($question->is_closed==1){
            return response()->json([
                'success' => false,
                'errors-message' => ['question is closed'],
            ], 200);
        }
        $answer=new Question_answer;
        $answer->user_id=$user_id;
        $answer->question_id=request()->get('question_id');
        $answer->text=request()->get('text');
        $answer->date=request()->get('date');
        $answer->save();
        return response()->json([
            'success' =>  $answer ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'question' => $answer,
        ], 200);
    }
//Route::post('editanswer', 'QuestionController@editanswer');
    /**
     * @SWG\Post(
     *     path="/question/editanswer",
     *     operationId="edit answer",
     *     description="edit answer",
     *     summary="edit answer",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="answer_id", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="text", required=true, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function editanswer(Request $request)
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
        $answer=Question_answer::where('id', $request['answer_id'])
            ->where('user_id', $user_id)
            ->first();
        if(isset($request['title'])){
            $answer->text=$request['text'];
        }
        $answer->save();
        return response()->json([
            'success' =>  $answer ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'question' => $answer,
        ], 200);
    }
//Route::post('deleteanswer', 'QuestionController@deleteanswer');
    /**
     * @SWG\Post(
     *     path="/question/deleteanswer",
     *     operationId="delete answer",
     *     description="delete answer",
     *     summary="delete answer",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="answer_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function deleteanswer(Request $request)
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
        $answer=Question_answer::where('id', $request['answer_id'])
            ->where('user_id', $user_id)->first();

        $question=Question::find($answer->question_id);
        $answer=Question_answer::where('id', $request['answer_id'])
            ->where('user_id', $user_id)
            ->delete();
        $question->comments_count=Question_answer::where("question_id", $question->id)
            ->where('moderator', 'accepted')
            ->count();
        $question->save();
        return response()->json([
            'success' =>  $answer ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'question' => $answer,
        ], 200);
    }
    //Route::post('addtobookmark', 'QuestionController@addtobookmark');
    /**
     * @SWG\Post(
     *     path="/question/addtobookmark",
     *     operationId="Add to user bookmark",
     *     description="Add to user bookmark",
     *     summary="Add to user bookmark",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="question_id", required=true, in="query", type="integer"),
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
            'question_id' => 'required|integer',
        ]);
        // Get filename with extension
        $item=Question::find($request->input('question_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 400);
        }

        $bookmark = new Bookmarks;
        $bookmark->type = 'question';
        $bookmark->user_id = $user_id;
        $bookmark->folder_id = 0;
        $bookmark->target_id = $request->input('question_id');
        $bookmark->save();
        return response()->json([
            'success' => $bookmark ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'bookmark' => $bookmark,
        ], 200);
    }
//Route::post('checkisbookmark', 'QuestionController@checkisbookmark');
    /**
     * @SWG\Post(
     *     path="/question/checkisbookmark",
     *     operationId="check is in users bookmark",
     *     description="check is in users bookmark",
     *     summary="check is in users bookmark",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="question_id", required=true, in="query", type="integer"),
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
                'request' => $request->all(),
            ], 400);
        }

        $this->validate($request, [
            'question_id' => 'required|integer',
        ]);
        // Get filename with extension
        $item=Question::find($request->input('question_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 400);
        }
        $user_bookmark = Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('question_id'))
            ->where('type', 'question')
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
//Route::post('deletefrombookmark', 'QuestionController@deletefrombookmark');
    /**
     * @SWG\Post(
     *     path="/question/deletefrombookmark",
     *     operationId="delete from bookmark",
     *     description="delete from bookmark",
     *     summary="delete from user bookmark",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="question_id", required=true, in="query", type="integer"),
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
            'question_id' => 'required|integer',
        ]);
        // Get filename with extension
        $item=Question::find($request->input('question_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 400);
        }          $user_pest_bookmark = Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('question_id'))
            ->where('type', 'question')
            ->delete();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'request' => $request->all(),
        ], 200);
    }
//Route::post('addtolike', 'QuestionController@addtolike');
    /**
     * @SWG\Post(
     *     path="/question/addtolike",
     *     operationId="Add to like",
     *     description="Add to like",
     *     summary="Add to like",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="item_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function addtolike(Request $request)
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
            'item_id' => 'required|integer',
        ]);
        // Get filename with extension
        $item=Question_answer::find($request->input('item_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 400);
        }
        // Get filename with extension
        $answer=Question_answer::find($request->input('item_id'));
        $question=Question::find($answer->question_id);

        if($question->user_id<>$user_id || $question->is_closed==1){
            return response()->json([
                'success' => false,
                'errors-message' => ['You are not author of this question or question is closed'],
            ], 200);
        }
        $answer->is_best=1;
        $answer->save();
        $question->is_closed=1;
        $question->save();

        return response()->json([
            'success' => $question ? true : false,
            'success-message' => [],
            'errors-message' => [],
        ], 200);
    }

//Route::post('deletefromlike', 'QuestionController@deletefromlike');
    /**
     * @SWG\Post(
     *     path="/question/deletefromlike",
     *     operationId="delete from likes",
     *     description="delete from likes",
     *     summary="delete from user likes",
     *     produces={"application/json"},
     *     tags={"QuestionAnswer"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="item_id", required=true, in="query", type="integer"),
     *     @SWG\Parameter(name="type", required=false, description="question, if empty, or answer, if 1", in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function deletefromlike(Request $request)
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
            'item_id' => 'required|integer',
        ]);
        // Get filename with extension
        $item=Question_answer::find($request->input('item_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 400);
        }
        // Get filename with extension
        $answer=Question_answer::find($request->input('item_id'));
        $question=Question::find($answer->question_id);
        if($question->user_id<>$user_id){
            return response()->json([
                'success' => false,
                'errors-message' => ['You are not author of this question'],
            ], 200);
        }
        $answer->is_best=0;
        $answer->save();
        $question->is_closed=0;
        $question->save();

        return response()->json([
            'success' => $question ? true : false,
            'success-message' => [],
            'errors-message' => [],
        ], 200);
    }
}
