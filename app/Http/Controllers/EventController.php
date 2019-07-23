<?php

namespace App\Http\Controllers;

use App\Models\Bookmarks;
use App\Models\Filter_attr_entity;
use App\Models\Filter_attr_value;
use App\Models\Filter_attributes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Event_category;
use App\Models\Event_participant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Validator;


class EventController extends Controller
{

//Route::post('index', 'EventController@index');
    /**
     * @SWG\Post(
     *     path="/event/index",
     *     operationId="show all ivents",
     *     description="show all ivents",
     *     summary="show all ivents",
     *     produces={"application/json"},
     *     tags={"Event"},
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="year", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="month", required=false, in="query", type="integer"),
     *     @SWG\Parameter(name="filter", required=false, description="25 26 27   6-7 - attribute values",  in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index(Request $request)
    {
        $itemsperpage=5;
        //dates
        $validator = Validator::make(request()->all(), [
            'page' => 'integer',
            'year' => "integer|required",
            'month' => "integer|required",
        ]);
        if($validator->fails()){
            return response()->json([
                'validator'=>$validator,
                'fail'=>$validator->fails(),
                'errors'=>$validator->errors(),
            ], 200);
        }
        $year = $request->input('year');
        $month = $request->input('month');
        if(!isset($year) || !isset($month)){
            $year=date('Y');
            $month=date('m');
        }
        $date_string=$year.'-'.$month;
        $start_date=$date_string=$year.'-'.$month.'-01';
        $start_date=date("Y-m-d", strtotime($start_date));
        $end_date=date("Y-m-t", strtotime($start_date));
        //select id
        $filter_request=request()->get('filter');
        $filter_attributes_values_id=explode(' ', request()->get('filter'));
        $filter_attributes_values=Filter_attr_value::whereIN('id', $filter_attributes_values_id)
            ->get();
        $filter_attributes = Filter_attr_value::select('attribute_id')
            ->whereIn('id', $filter_attributes_values_id)
            ->distinct()
            ->get();
        $items_id=array();
        $sql2='';
        if (isset($filter_request)){
            $sql='SELECT DISTINCT  events.id FROM events JOIN filter_attr_entities ON events.id = filter_attr_entities.entity_id WHERE filter_attr_entities.entity_type="event" ';
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
            $sql=$sql.' AND (events.date BETWEEN "'.$start_date. '" AND "'.$end_date.'")';
            $events=DB::select($sql);
            foreach ($events as $item){
                array_push($items_id, $item->id);
            }
            $sql2=$sql;
            if(count($items_id)==0){
                return response()->json([
                    'success' => $events ? true : false,
                    'success-message' => [],
                    'errors-message' => [],
                    'request'=>$request->all(),
                    'start'=>$date_string,
                    'end'=>$end_date,
                    'events'=>[],
                    'sql'=>$sql2,
                ], 200);
            }
        }

        //create sql
        $sql="select * from `events`";
        $sql_events_with_dates="select id, date from `events`";
        $sql=$sql.' WHERE (events.date BETWEEN "'.$start_date. '" AND "'.$end_date.'")';
        $sql_events_with_dates=$sql_events_with_dates.' WHERE (events.date BETWEEN "'.$start_date. '" AND "'.$end_date.'")';

        if (count($items_id)>0){
            $sql=$sql." and events.id IN (".implode(", ", $items_id).")";
            $sql_events_with_dates=$sql_events_with_dates." and events.id IN (".implode(", ", $items_id).")";

        }
        //ordering
        //$ordering=request()->get('sorting');
        $sql=$sql." ORDER BY events.date ";
        $sql_events_with_dates=$sql_events_with_dates." ORDER BY events.date ";

        $limit =$itemsperpage;
        $page =1;
        $pages=ceil(count(DB::select($sql))/$itemsperpage);
        if(request('page') > 1){
            $page=request('page');
        }
        $skip=($page-1)*$itemsperpage;
        $sql =$sql."  limit ".$limit." offset ".$skip;

         if(isset($filters) && (count($items_id)==0)){
            $sql = "SELECT DISTINCT  events.id FROM events WHERE 0";
            $sql_events_with_dates = "SELECT DISTINCT  events.id FROM events WHERE 0";

         }
        $events=DB::select($sql);
        $events_with_dates=DB::select($sql_events_with_dates);
        if (count($events)>0) {
            foreach ($events as $item) {
                if (isset($item->main_photo))
                    $item->main_photo = $_ENV['PHOTO_FOLDER'] . $item->main_photo;
                $item->categories=Filter_attr_entity::where('entity_type', 'event')
                    ->where('entity_id', $item->id)
                    ->where('filter_attr_entities.attribute_id', 92)
                    ->leftJoin('filter_attr_values', 'filter_attr_values.id', 'filter_attr_entities.attribute_value')
                    ->get();
            }
        }
        if (count($events_with_dates)>0) {
            foreach ($events_with_dates as $item) {
                $item->categories=Filter_attr_entity::where('entity_type', 'event')
                    ->where('entity_id', $item->id)
                    ->where('filter_attr_entities.attribute_id', 92)
                    ->leftJoin('filter_attr_values', 'filter_attr_values.id', 'filter_attr_entities.attribute_value')
                    ->get();
            }
        }
        return response()->json([
            'success' => $events ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'events'=>$events,
            'events_with_dates'=>$events_with_dates,
            'pages'=>$pages,
        ], 200);
    }


//Route::post('show', 'EventController@show');
    /**
     * @SWG\Post(
     *     path="/event/show",
     *     operationId="show ivent",
     *     description="show ivent",
     *     summary="show ivent",
     *     produces={"application/json"},
     *     tags={"Event"},
     *     @SWG\Parameter(name="event_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function show(Request $request)
    {
        $this->validate($request, [
            'event_id' => 'required|integer',
        ]);
        $event_id=$request->input('event_id');
        $event=Event::find($event_id);
        if(!isset($event)){
            return response()->json([
                'success' => false,
                'success-message' => [],
                'errors-message' => ['item is not exist'],
            ], 200);
        }

        $event->main_photo=$_ENV['PHOTO_FOLDER'].$event->main_photo;
        $filter_attributes=Filter_attr_entity::where('entity_type', 'event')
            ->where('entity_id', $event_id)
            ->leftJoin('filter_attr_values', 'filter_attr_values.id', 'filter_attr_entities.attribute_value')
            ->get();
        return response()->json([
            'success' => $event ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'request'=>$request->all(),
            'event'=>$event,
            'filter_attributes'=>$filter_attributes,
        ], 200);
    }


    /**
     * @SWG\Post(
     *     path="/event/create",
     *     operationId="create event",
     *     description="create event",
     *     summary="create event",
     *     produces={"application/json"},
     *     tags={"Event"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="title", required=true, in="formData", type="string"),
     *     @SWG\Parameter(name="date", required=true, in="formData", type="string"),
     *     @SWG\Parameter(name="description", required=true, in="formData", type="string"),
     *     @SWG\Parameter(name="filter", required=false, description="{'filter':[] }  - attribute values",  in="query", type="string"),
     *     @SWG\Parameter(name="photo", required=true, in="formData", type="file"),
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
                'errors-message' => 'not authentificated',
                'request'=>$request->all(),
            ], 400);
        }
        $this->validate($request, [
            'photo' => 'image|max:1999|required',
            'title' => 'string|required',
            'description' => 'string|required',
            'date'=>'required|date'
        ]);
        $event=new Event;
        $event->user_id=$user_id;
        $event->title=$request->input('title');
        $event->date=$request->input('date');
        $event->description=$request->input('description');
        $event->event_category_id=0;
        //add photo
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filename = uniqid('event_'.$event->id.'_photo_').".$extension";
        $request->file('photo')->storeAs('public', "event/$filename");
        $event->main_photo="event/$filename";
        $event->save();
        //filter
        $filters=$request->input('filter');
        if($filters){
            $filters=json_decode($filters);
            foreach ($filters as $filter){
                foreach ($filter as $item){
                    $attribute=Filter_attr_value::find($item);
                    $entity=Filter_attr_entity::create([
                        'entity_id'=>$event->id,
                        'entity_type'=>'event',
                        'attribute_id'=>$attribute->attribute_id,
                        'attribute_value'=>$item,
                    ]);
                }
            }
        }
        return response()->json([
            'success' => $event ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
            'event'=>$event,
            'filter'=>$filters,
        ], 200);
    }

//Route::post('edit', 'EventController@edit');
    /**
     * @SWG\Post(
     *     path="/event/edit",
     *     operationId="edit event",
     *     description="edit event",
     *     summary="edit event",
     *     produces={"application/json"},
     *     tags={"Event"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="event_id", required=true, in="formData", type="string"),
     *     @SWG\Parameter(name="title", required=false, in="formData", type="string"),
     *     @SWG\Parameter(name="date", required=false, in="formData", type="string"),
     *     @SWG\Parameter(name="description", required=false, in="formData", type="string"),
     *     @SWG\Parameter(name="filter", required=false, description="{'filter':[] }  - attribute values",  in="query", type="string"),
     *     @SWG\Parameter(name="photo", required=false, in="formData", type="file"),
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
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'request'=>$request->all(),
            ], 400);
        }
        $this->validate($request, [
            'photo' => 'image|max:1999',
            'title' => 'string',
            'description' => 'string',
            'date'=>'date',
            'event_id'=>'integer|required',
        ]);
        $event=Event::find($request->input('event_id'));
        if(!isset($event)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 400);
        }
        $user_id_event=$event->user_id;
        if($user_id!=$user_id_event){
            if(!isset($user_id)){
                return response()->json([
                    'errors-message' => 'this event created by another user',
                    'request'=>$request->all(),
                ], 400);
            }
        }
        $title=$request->input('title');
        if (isset($title)){
            $event->title=$request->input('title');
        }
        $date=$request->input('date');
        if (isset($date)){
            $event->date=$request->input('date');
        }
        $description=$request->input('description');
        if (isset($description)){
            $event->description=$request->input('description');
        }

        $category_id=$request->input('category_id');
        if (isset($category_id)){
            $event->event_category_id=$request->input('category_id');
        }
        $photo=$request->input('photo');
        if (isset($request['photo'])){
            $this->validate($request, [
                'photo' => 'image|max:1999'
            ]);
            $main_photo=$event->main_photo;
            Storage::delete($main_photo);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = uniqid('event_'.$event->id.'_photo_').".$extension";
            $request->file('photo')->storeAs('public', "event/$filename");
            $event->main_photo="event/$filename";
            $event->save();
        }
        $event->save();
        //edit filters
        //filter
        $filters=Filter_attr_entity::where('entity_type', 'event')
            ->where('entity_id', $event->id)
            ->delete();
        $filters=$request->input('filter');
        if($filters){
            $filters=json_decode($filters);
            foreach ($filters as $filter){
                foreach ($filter as $item){
                    $attribute=Filter_attr_value::find($item);
                    $entity=Filter_attr_entity::create([
                        'entity_id'=>$event->id,
                        'entity_type'=>'event',
                        'attribute_id'=>$attribute->attribute_id,
                        'attribute_value'=>$item,
                    ]);
                }
            }
        }

        return response()->json([
            'success' => $event ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
            'event'=>$event,
        ], 200);
    }
//Route::post('delete', 'EventController@delete');
    /**
     * @SWG\Post(
     *     path="/event/delete",
     *     operationId="delete event",
     *     description="delete event",
     *     summary="delete event",
     *     produces={"application/json"},
     *     tags={"Event"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="event_id", required=true, in="query", type="integer"),
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
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'request'=>$request->all(),
            ], 400);
        }
        $this->validate($request, [
            'event_id' => 'required|integer',
        ]);
        $event=Event::find($request->input('event_id'));
        if(!isset($event)){
            return response()->json([
                'errors-message' => 'item is not exist',
            ], 200);
        }
        $user_id_event=$event->user_id;
        if($user_id!=$user_id_event){
            if(!isset($user_id)){
                return response()->json([
                    'errors-message' => 'this event created by another user',
                    'request'=>$request->all(),
                ], 400);
            }
        }
        $main_photo=$event->main_photo;
        Storage::delete($main_photo);
        $event_id=$event->id;
        $filters=Filter_attr_entity::where('entity_type', 'event')
            ->where('entity_id', $event_id)
            ->delete();
        $participants=Event_participant::where('event_id', $event_id)
            ->delete();
        $event->delete();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
        ], 200);
    }


//        Route::post('takepart', 'EventController@takepart');
    /**
     * @SWG\Post(
     *     path="/event/takepart",
     *     operationId="take part in event",
     *     description="take part in event",
     *     summary="take part in event",
     *     produces={"application/json"},
     *     tags={"Event"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="event_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function takepart(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'request'=>$request->all(),
            ], 400);
        }
        $this->validate($request, [
            'event_id' => 'required|integer',
        ]);
        $event=Event::find($request->input('event_id'));
        if(!isset($event)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 200);
        }

        //check ezisting as participant
        $event_participant=Event_participant::where('event_id', $request->input('event_id'))
            ->where('participant_id', $user_id)
            ->get();
        if ($event_participant->count()>=1){
            return response()->json([
                'errors-message' => 'you are participant yet',
                'request'=>$request->all(),
            ], 400);
        }
        //add partisipants in sub table
        $event_participant=new Event_participant;
        $event_participant->event_id=$request->input('event_id');
        $event_participant->participant_id=$user_id;
        $event_participant->save();
        //update number of participants
        $event=Event::find($request->input('event_id'));
        $count=Event_participant::where('event_id', $request->input('event_id'))
            ->get()
            ->count();
        $event->participants=$count;
        $event->save();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('checkpart', 'EventController@checkpart');
    /**
     * @SWG\Post(
     *     path="/event/checkpart",
     *     operationId="check take part in event",
     *     description="check take part in event",
     *     summary="check  take part in event",
     *     produces={"application/json"},
     *     tags={"Event"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="event_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function checkpart(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'request'=>$request->all(),
            ], 400);
        }
        $this->validate($request, [
            'event_id' => 'required|integer',
        ]);
        $event=Event::find($request->input('event_id'));
        if(!isset($event)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 200);
        }

        //check ezisting as participant
        $event_participant=Event_participant::where('event_id', $request->input('event_id'))
            ->where('participant_id', $user_id)
            ->get();
        $ansver=false;
        if ($event_participant->count()>=1){
            $ansver=true;
        }
        //add partisipants in sub table
        return response()->json([
            'is_bookmarked' => $ansver,
            'request' => $request->all(),
        ], 200);
    }

//Route::post('untakepart', 'EventController@untakepart');
    /**
     * @SWG\Post(
     *     path="/event/untakepart",
     *     operationId="untake part in event",
     *     description="untake part in event",
     *     summary="untake part in event",
     *     produces={"application/json"},
     *     tags={"Event"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="event_id", required=true, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function untakepart(Request $request)
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        if(!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'request'=>$request->all(),
            ], 400);
        }
        $this->validate($request, [
            'event_id' => 'required|integer',
        ]);
        $event=Event::find($request->input('event_id'));
        if(!isset($event)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 200);
        }
        //check ezisting as participant
        $event_participant=Event_participant::where('event_id', $request->input('event_id'))
            ->where('participant_id', $user_id)
            ->first();
        if(isset($event_participant)){
            $event_participant->delete();
        }
        //update number of participants
        $event=Event::find($request->input('event_id'));
        $count=Event_participant::where('event_id', $request->input('event_id'))
            ->get()
            ->count();
        $event->participants=$count;
        $event->save();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'user_id'=>$user_id,
            'request'=>$request->all(),
        ], 200);
    }

//        Route::post('showfilter', 'EventController@showfilter');
    /**
     * @SWG\Post(
     *     path="/event/showfilter",
     *     operationId="show event filter",
     *     description="show event filter",
     *     summary="show event filter",
     *     produces={"application/json"},
     *     tags={"Event"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function showfilter(Request $request)
    {
        $filter = Filter_attributes::where('type', 'event')
            ->with('attr_values')
            ->get();

        return response()->json([
            'success' => $filter ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'event_categories'=>$filter,
            'request'=>$request->all(),
        ], 200);
    }
//Route::post('addtobookmark', 'EventController@addtobookmark');
//Route::post('checkisbookmark', 'EventController@checkisbookmark');
//Route::post('deletefrombookmark', 'EventController@deletefrombookmark');

    /**
     * @SWG\Post(
     *     path="/event/addtobookmark",
     *     operationId="Add to user bookmark",
     *     description="Add to user bookmark",
     *     summary="Add to user bookmark",
     *     produces={"application/json"},
     *     tags={"Event"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="event_id", description="event ID", required=true, in="query", type="integer"),
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
            'event_id' => 'required|integer',
        ]);
        $item=Event::find($request->input('event_id'));
        if(!isset($item)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'request'=>$request->all(),
            ], 200);
        }

        // Get filename with extension
        $bookmark=new Bookmarks;
        $bookmark->type='event';
        $bookmark->user_id=$user_id;
        $bookmark->folder_id=0;
        $bookmark->target_id=$request->input('event_id');
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
     *     path="/event/checkisbookmark",
     *     operationId="check is in users bookmark",
     *     description="check is in users bookmark",
     *     summary="check is in users bookmark",
     *     produces={"application/json"},
     *     tags={"Event"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="event_id", required=true, in="query", type="integer"),
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
            'event_id' => 'required|integer',
        ]);
        //check if exist
        $user_bookmark=Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('event_id'))
            ->where('type', 'event')
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


//Route::post('deletefrombookmark', 'PestController@deletefrombookmark');
    /**
     * @SWG\Post(
     *     path="/event/deletefrombookmark",
     *     operationId="delete from user bookmark",
     *     description="delete from user bookmark",
     *     summary="delete from user bookmark",
     *     produces={"application/json"},
     *     tags={"Event"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="event_id", required=true, in="query", type="integer"),
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
            'event_id' => 'required|integer',
        ]);
        //check if exist
        $user_pest_bookmark=Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('event_id'))
            ->where('type', 'event')
            ->first();
        if(!isset($user_pest_bookmark)){
            return response()->json([
                'errors-message' => 'item is not exist',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }

        $user_pest_bookmark=Bookmarks::where('user_id', $user_id)
            ->where('target_id', $request->input('event_id'))
            ->where('type', 'event')
            ->delete();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'request'=>$request->all(),
        ], 200);
    }
}
