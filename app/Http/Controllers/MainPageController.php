<?php

namespace App\Http\Controllers;

use App\Models\Assortment;
use App\Models\Bookmarks;
use App\Models\Category_relation;
use App\Models\Chemical;
use App\Models\Culture;
use App\Models\Disease;
use App\Models\Disease_chemical;
use App\Models\Event_participant;
use App\Models\Feedback;
use App\Models\Filter_attr_entity;
use App\Models\Filter_attr_value;
use App\Models\Footer;
use App\Models\Handbook;
use App\Models\Handbook_photo;
use App\Models\Handbook_videolinks;
use App\Models\Main_page_info;
use App\Models\Market;
use App\Models\Pest;
use App\Models\Pest_chemical;
use App\Models\Photos;
use App\Models\Profile;
use App\Models\Question;
use App\Models\Section;
use App\Models\Sort;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Filter_attributes;
use Illuminate\Support\Facades\Storage;
use App\Models\Search;
use App\Models\Event;
use Illuminate\Validation\Rule;


class MainPageController extends Controller
{
//
//Route::post('index', 'MainPageController.php@index');
    /**
     * @SWG\Post(
     *     path="/mainpage/index",
     *     operationId="get main page data",
     *     description="get main page data",
     *     summary="get main page data",
     *     produces={"application/json"},
     *     tags={"Mainpage"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index()
    {
        $sections = Section::all();
        $current_day = date('Y-m-d');

        $news = Event::where('date', ">=", $current_day)
            ->take(3)
            ->get();
        if (count($news) < 3) {
            $news = Event::orderBy('id', 'desc')
                ->take(3)
                ->get();
        }

        if (count($news) > 0) {
            foreach ($news as $item) {
                if (isset($item->main_photo))
                    $item->main_photo = $_ENV['PHOTO_FOLDER'] . $item->main_photo;
            }
        }
//        $most_discussed=Handbook::orderBy('comments_count', 'desc')->take(4)->get();
//        if (count($most_discussed)>0) {
//            foreach ($most_discussed as $item) {
//                if (isset($item->main_photo))
//                    $item->main_photo = $_ENV['PHOTO_FOLDER'] . $item->main_photo;
//            }
//        }

        $most_discussed = Question::where('moderator', 'accepted')
            ->orderBy('comments_count', 'desc')->take(4)->get();
        if (count($most_discussed) > 0) {
            foreach ($most_discussed as $item) {
                $item->description = $item->text;


//                if (isset($item->main_photo))
//                    $item->main_photo = $_ENV['PHOTO_FOLDER'] . $item->main_photo;
            }
        }


        $top_selled = Sort::orderBy('merchantability', 'desc')->take(4)->get();
        if (count($top_selled) > 0) {
            foreach ($top_selled as $item) {
                if (isset($item->main_photo))
                    $item->main_photo = $_ENV['PHOTO_FOLDER'] . $item->main_photo;
            }
        }
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'sections' => $sections,
            'news' => $news,
            'most_discussed' => $most_discussed,
            'top_selled' => $top_selled,
        ], 200);
    }
//Route::post('search', 'MainPageController.php@search');

    /**
     * @SWG\Post(
     *     path="/mainpage/search",
     *     operationId="search",
     *     description="search",
     *     summary="search",
     *     produces={"application/json"},
     *     tags={"Mainpage"},
     *     @SWG\Parameter(name="text", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="category", required=false, description="section4, section5, section6, chemical, event, vendor_code, decorator, seller", in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function search(Request $request)
    {
        $itemsperpage = 20;
        $this->validate($request, [
            'text' => 'required',
        ]);
        $word = $request['text'];
        if (strlen($word) < 2) {
            return response()->json([
                'success' => false,
                'errors-message' => 'word very short',
            ], 400);
        }
        //parse string
        $separator = '\'\" .,?!@#$%^&*()_=+';
        $array_words = array();
        $tok = strtok($word, $separator);
        while ($tok) {
            $array_words[] = $tok;
            $tok = strtok($separator);
        }
        //make constraints
        $sql = '1 ';
        foreach ($array_words as $item){
            if (strlen($item)>=2){
                $sql=$sql." AND (title LIKE '%$item%' OR text LIKE '%$item%') ";
            }
        }


        if (isset($request['category'])) {
            if ($request['category'] == 'section4') {
                $sql = $sql . " AND section_id=4";
            } elseif ($request['category'] == 'section5') {
                $sql = $sql . " AND section_id=5";
            } elseif ($request['category'] == 'section6') {
                $sql = $sql . " AND section_id=6";
            } elseif ($request['category'] == 'chemical') {
                $sql = $sql . " AND type='chemical'";
            } elseif ($request['category'] == 'event') {
                $sql = $sql . " AND type='event'";
            } elseif ($request['category'] == 'vendor_code') {
                $sql = "target_id=".$array_words[0]." AND (type='sort' or type='chemical')";
            } elseif ($request['category'] == 'decorator') {
                $sql = $sql . " AND type='decorator'";
            } elseif ($request['category'] == 'seller') {
                $sql = $sql . " AND type='seller'";
            }
        }

      //  return $sql;

        $items = Search::whereRaw($sql)
            ->orderBy('created_at', 'desc')
            ->take($itemsperpage)
            ->get();

        return response()->json([
            'success' => $items ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'items' => $items,
            'sql' => $sql,
            'array_words'=>$array_words,
        ], 200);
    }
//Route::post('searchlocal', 'MainPageController@searchlocal');
    /**
     * @SWG\Post(
     *     path="/mainpage/searchlocal",
     *     operationId="search on page",
     *     description="search on page",
     *     summary="search on page  поиск на соответствующих страницах",
     *     produces={"application/json"},
     *     tags={"Mainpage"},
     *     @SWG\Parameter(name="text", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="type", required=true, description="culture, pest, sort, disease, handbook, question", in="query", type="string"),
     *     @SWG\Parameter(name="section_id", required=false, description=" нужен для всех, кроме сортов", in="query", type="integer"),
     *     @SWG\Parameter(name="culture_id", required=false, description="нужен для сортов", in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function searchlocal(Request $request)
    {
        $itemsperpage = 20;
        $this->validate($request, [
            'text' => 'required',
            'section_id'=>'integer',
            'culture_id'=>'integer',
            'type'=>['required', Rule::in(['culture','sort','pest','disease', 'handbook', 'question']),],
        ]);
        $word = $request['text'];
        if (strlen($word) < 2) {
            return response()->json([
                'success' => false,
                'errors-message' => 'word very short',
            ], 400);
        }
        //parse string
        $separator = '\'\" .,?!@#$%^&*()_=+';
        $array_words = array();
        $tok = strtok($word, $separator);
        while ($tok) {
            $array_words[] = $tok;
            $tok = strtok($separator);
        }
        //make constraints
        $sql = '1 ';
        foreach ($array_words as $item){
            if (strlen($item)>=2){
                $sql=$sql." AND (title LIKE '%$item%' OR text LIKE '%$item%') ";
            }
        }
        $type=$request->input('type');
        if($type=='sort'){
            $culture_id=$request->input('culture_id');
            if(!isset($culture_id)){
                return response()->json([
                    'success' => false,
                    'errors-message' => 'for sort searching needs culture_id',
                ], 400);
            }
            $culture=Culture::find($culture_id);
            if(!isset($culture)){
                return response()->json([
                    'success' => false,
                    'errors-message' => 'wrong culture_id',
                ], 400);
            }
            $sql='1 ';
            foreach ($array_words as $item){
                if (strlen($item)>=2){
                    $sql=$sql." AND (name LIKE '%$item%' OR slug LIKE '%$item%' OR content LIKE '%$item%') ";
                }
            }
            $items = Sort::whereRaw($sql)
                ->where('culture_id', $culture_id)
                ->orderBy('name', 'asc')
                ->take($itemsperpage)
                ->get();

            return response()->json([
                'success' => $items ? true : false,
                'success-message' => [],
                'errors-message' => [],
                'items' => $items,
                'sql' => $sql,
                'array_words'=>$array_words,
            ], 200);
        }
        $section_id=$request->input('section_id');
        if(!isset($section_id)){
            return response()->json([
                'success' => false,
                'errors-message' => 'for searching needs section_id',
            ], 400);
        }
        $section=Section::find($section_id);
        if(!isset($section_id)){
            return response()->json([
                'success' => false,
                'errors-message' => 'wrong section_id',
            ], 400);
        }
        $type=$request->input('type');
        $items = Search::whereRaw($sql)
            ->where('type', $type)
            ->where('section_id', $request->input('section_id'))
            ->orderBy('title', 'asc')
            ->take($itemsperpage)
            ->get();

        return response()->json([
            'success' => $items ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'items' => $items,
            'sql' => $sql,
            'array_words'=>$array_words,
        ], 200);
    }





//Route::post('feedback', 'MainPageController.php@feedback')

    /**
     * @SWG\Post(
     *     path="/mainpage/feedback",
     *     operationId="send feedback",
     *     description="send feedback",
     *     summary="send feedback",
     *     produces={"application/json"},
     *     tags={"Mainpage"},
     *     @SWG\Parameter(name="email", required=true, in="query", type="string"),
     *     @SWG\Parameter(name="text", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="type", required=false, description="cooperation or tariff", in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function feedback(Request $request)
    {
        $feedback = new Feedback;
        $this->validate($request, [
            'email' => 'required|email',
            'text' => 'string',
            'type'=> ['required', Rule::in(['cooperation', 'tariff']),],
        ]);

        $feedback->email = $request->email;
        $feedback->text = $request->text;
        //cooperation in default
        if (isset($request->type)) {
            if ($request->type == 'tariff') $feedback->type = 'tariff';
        }
        $feedback->save();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
        ], 200);
    }
//Route::post('refreshindex', 'MainPageController@refreshindex');

    /**
     * @SWG\Post(
     *     path="/mainpage/refreshindex",
     *     operationId="refresh index",
     *     description="refresh index",
     *     summary="refresh index",
     *     produces={"application/json"},
     *     tags={"Mainpage"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function refreshindex(Request $request)
    {


        //chemical
        $indexes=Chemical::select('id')->get();
        foreach ($indexes as $index){
            $item=Chemical::find($index->id);
            $text = '';
            if (isset($item->manufacturer)) $text = $text . ' ' . $item->manufacturer;
            if (isset($item->composition)) $text = $text . ' ' . $item->composition;
            if (isset($item->description)) $text = $text . ' ' . $item->description;
            if (isset($item->characteristics)) $text = $text . ' ' . $item->characteristics;
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'chemical'],
                ['title' => $item->name, 'text' => $text, 'section_id' => '0']
            );
        }
        $indexes=Search::select('searches.id','target_id', 'chemicals.name')
            ->where('type', 'chemical')
            ->leftJoin('chemicals', 'chemicals.id', 'searches.target_id')
            ->whereNull('chemicals.name')
            ->get();
        foreach ($indexes as $index){
            Search::destroy($index->id);
        }
        //cultures
        $indexes=Culture::select('id')->get();
        foreach ($indexes as $index){
            $item=Culture::find($index->id);
            $text = '';
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'culture'],
                ['title' => $item->name, 'text' => $text, 'section_id' => $item->section_id]
            );
        }
        $indexes=Search::select('searches.id','target_id', 'cultures.name')
            ->where('type', 'culture')
            ->leftJoin('cultures', 'cultures.id', 'searches.target_id')
            ->whereNull('cultures.name')
            ->get();
        foreach ($indexes as $index){
            Search::destroy($index->id);
        }
        //decorator
        $indexes=Profile::select('user_id')
            ->where('is_decorator', 1)
            ->get();
        foreach ($indexes as $index){
            $item=Profile::where('user_id', $index->user_id)->first();
            $entity = Search::updateOrCreate(
                ['target_id' => $item->user_id, 'type' => 'decorator'],
                ['title' => $item->first_name . ' ' . $item->last_name, 'text' => $item->about_me_decorator, 'section_id' => '0']
            );
        }
        $indexes=Search::select('searches.id','target_id', 'profiles.user_id', 'profiles.is_decorator')
            ->where('type', 'decorator')
            ->leftJoin('profiles', 'profiles.user_id', 'searches.target_id')
            ->where('profiles.is_decorator', 0)
            ->get();
        foreach ($indexes as $index){
            Search::destroy($index->id);
        }
        //diseases
        $indexes=Disease::select('id')->get();
        foreach ($indexes as $index){
            $item=Disease::find($index->id);
            $text = '';
            if (isset($item->description)) $text = $text . ' ' . $item->description;
            if (isset($item->fight)) $text = $text . ' ' . $item->fight;
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'disease'],
                ['title' => $item->name, 'text' => $text, 'section_id' => $item->section_id]
            );
        }
        $indexes=Search::select('searches.id','target_id', 'diseases.name')
            ->where('type', 'disease')
            ->leftJoin('diseases', 'diseases.id', 'searches.target_id')
            ->whereNull('diseases.name')
            ->get();
        foreach ($indexes as $index){
            Search::destroy($index->id);
        }
        //events
        $indexes=Event::select('id')->get();
        foreach ($indexes as $index){
            $item=Event::find($index->id);
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'event'],
                ['title' => $item->title, 'text' => $item->description, 'section_id' => '0']
            );
        }
        $indexes=Search::select('searches.id','target_id', 'events.title')
            ->where('type', 'event')
            ->leftJoin('events', 'events.id', 'searches.target_id')
            ->whereNull('events.title')
            ->get();
        foreach ($indexes as $index){
            Search::destroy($index->id);
        }
        //handbooks
        $indexes=Handbook::select('id')->get();
        foreach ($indexes as $index){
            $item=Handbook::find($index->id);
            $text = '';
            if (isset($item->description)) $text = $text . ' ' . $item->description;
            if (isset($item->full_description)) $text = $text . ' ' . $item->full_description;
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'handbook'],
                ['title' => $item->title, 'text' => $text, 'section_id' => $item->section_id]
            );
        }
        $indexes=Search::select('searches.id','target_id', 'handbooks.title')
            ->where('type', 'handbook')
            ->leftJoin('handbooks', 'handbooks.id', 'searches.target_id')
            ->whereNull('handbooks.title')
            ->get();
        foreach ($indexes as $index){
            Search::destroy($index->id);
        }
        //pests
        $indexes=Pest::select('id')->get();
        foreach ($indexes as $index){
            $item=Pest::find($index->id);
            $text = '';
            if (isset($item->description)) $text = $text . ' ' . $item->description;
            if (isset($item->fight)) $text = $text . ' ' . $item->fight;
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'pest'],
                ['title' => $item->name, 'text' => $text, 'section_id' => $item->section_id]
            );
        }
        $indexes=Search::select('searches.id','target_id', 'pests.name')
            ->where('type', 'pest')
            ->leftJoin('pests', 'pests.id', 'searches.target_id')
            ->whereNull('pests.name')
            ->get();
        foreach ($indexes as $index){
            Search::destroy($index->id);
        }
        //questions
        $indexes=Question::select('id')->where('moderator', 'accepted')->get();
        foreach ($indexes as $index){
            $item=Question::find($index->id);
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'question'],
                ['title' => $item->title, 'text' => $item->text, 'section_id' => $item->section_id]
            );
        }
        $indexes=Search::select('searches.id','target_id', 'questions.title')
            ->where('type', 'question')
            ->leftJoin('questions', 'questions.id', 'searches.target_id')
            ->whereNull('questions.title')
            ->get();
        foreach ($indexes as $index){
            Search::destroy($index->id);
        }

        //seller
        $indexes=Profile::select('user_id')
            ->where('is_seller', 1)
            ->get();
        foreach ($indexes as $index){
            $item=Profile::where('user_id', $index->user_id)->first();
            $entity = Search::updateOrCreate(
                ['target_id' => $item->user_id, 'type' => 'seller'],
                ['title' => $item->first_name . ' ' . $item->last_name, 'text' => $item->about_me_seller, 'section_id' => '0']
            );
        }
        $indexes=Search::select('searches.id','target_id', 'profiles.user_id', 'profiles.is_seller')
            ->where('type', 'seller')
            ->leftJoin('profiles', 'profiles.user_id', 'searches.target_id')
            ->where('profiles.is_seller', 0)
            ->get();
        foreach ($indexes as $index){
            Search::destroy($index->id);
        }
        //sorts
        $indexes=Sort::select('id')->get();
        foreach ($indexes as $index){
            $item=Sort::find($index->id);
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'sort'],
                ['title' => $item->name, 'text' => $item->content, 'section_id' => $item->section_id]
            );
        }
        $indexes=Search::select('searches.id','target_id', 'sorts.name')
            ->where('type', 'sort')
            ->leftJoin('sorts', 'sorts.id', 'searches.target_id')
            ->whereNull('sorts.name')
            ->get();
        foreach ($indexes as $index){
            Search::destroy($index->id);
        }

        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'indexes'=>$indexes,
        ], 200);

    }
    /**
     * @SWG\Post(
     *     path="/mainpage/footer",
     *     operationId="footer",
     *     description="footer",
     *     summary="footer",
     *     produces={"application/json"},
     *     tags={"Mainpage"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function footer()
    {
        $footer = Footer::orderBy('order')
            ->get();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'footer' => $footer,
        ], 200);
    }
    //    Route::post('generalinfo', 'MainPageController@generalinfo');
    /**
     * @SWG\Post(
     *     path="/mainpage/generalinfo",
     *     operationId="generalinfo",
     *     description="generalinfo",
     *     summary="general info   информация разделов ""О НАС"", ""ОБУЧЕНИЕ"" и др",
     *     produces={"application/json"},
     *     tags={"Mainpage"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function generalinfo()
    {
        $footer = Main_page_info::all();
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'footer' => $footer,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/mainpage/dbclearing",
     *     operationId="clearing db",
     *     description="clearing db",
     *     summary="clearing db очистка базы данных от висячих строк",
     *     produces={"application/json"},
     *     tags={"Mainpage"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function dbclearing()
    {
        $items="";
        Assortment::where('type', 'sort')
            ->leftJoin('sorts', 'sorts.id', 'assortments.target_id')
            ->whereNull('sorts.name')
            ->delete();
        Assortment::where('type', 'chemical')
            ->leftJoin('chemicals', 'chemicals.id', 'assortments.target_id')
            ->whereNull('chemicals.name')
            ->delete();

        Bookmarks::where('type', 'sort')
            ->leftJoin('sorts', 'sorts.id', 'bookmarks.target_id')
            ->whereNull('sorts.name')
            ->delete();
        Bookmarks::where('type', 'disease')
            ->leftJoin('diseases', 'diseases.id', 'bookmarks.target_id')
            ->whereNull('diseases.name')
            ->delete();
        Bookmarks::where('type', 'pest')
            ->leftJoin('pests', 'pests.id', 'bookmarks.target_id')
            ->whereNull('pests.name')
            ->delete();
        Bookmarks::where('type', 'handbook')
            ->leftJoin('handbooks', 'handbooks.id', 'bookmarks.target_id')
            ->whereNull('handbooks.title')
            ->delete();
        Bookmarks::where('type', 'chemical')
            ->leftJoin('chemicals', 'chemicals.id', 'bookmarks.target_id')
            ->whereNull('chemicals.name')
            ->delete();
        Bookmarks::where('type', 'question')
            ->leftJoin('questions', 'questions.id', 'bookmarks.target_id')
            ->whereNull('questions.title')
            ->delete();

        Category_relation::where('type', 'sort')
            ->leftJoin('sorts', 'sorts.id', 'category_relations.target_id')
            ->whereNull('sorts.name')
            ->delete();
        Category_relation::where('type', 'chemical')
            ->leftJoin('chemicals', 'chemicals.id', 'category_relations.target_id')
            ->whereNull('chemicals.name')
            ->delete();
        Category_relation::leftJoin('categories', 'categories.id', 'category_relations.target_category')
            ->whereNull('categories.category')
            ->delete();

        Disease_chemical::leftJoin('diseases', 'diseases.id', 'disease_chemicals.disease_id')
            ->whereNull('diseases.id')
            ->delete();
        Disease_chemical::leftJoin('chemicals', 'chemicals.id', 'disease_chemicals.chemical_id')
            ->whereNull('chemicals.id')
            ->delete();

        Event_participant::leftJoin('events', 'events.id', 'event_participants.event_id')
            ->whereNull('events.id')
            ->delete();

        Filter_attr_value::leftJoin('filter_attributes','filter_attributes.id', 'filter_attr_values.attribute_id')
            ->whereNull('filter_attributes.id')
            ->delete();

        Filter_attr_entity::leftJoin('filter_attr_values', 'filter_attr_values.id', 'filter_attr_entities.attribute_value')
            ->whereNull('filter_attr_values.id')
            ->delete();
        Filter_attr_entity::where('entity_type', 'chemical')
            ->leftJoin('chemicals', 'chemicals.id', 'filter_attr_entities.entity_id')
            ->whereNull( 'chemicals.id')
            ->delete();
        Filter_attr_entity::where('entity_type', 'disease')
            ->leftJoin('diseases', 'diseases.id', 'filter_attr_entities.entity_id')
            ->whereNull( 'diseases.id')
            ->delete();
        Filter_attr_entity::where('entity_type', 'event')
            ->leftJoin('events', 'events.id', 'filter_attr_entities.entity_id')
            ->whereNull( 'events.id')
            ->delete();
        Filter_attr_entity::where('entity_type', 'handbook')
            ->leftJoin('handbooks', 'handbooks.id', 'filter_attr_entities.entity_id')
            ->whereNull( 'handbooks.id')
            ->delete();
        Filter_attr_entity::where('entity_type', 'pest')
            ->leftJoin('pests', 'pests.id', 'filter_attr_entities.entity_id')
            ->whereNull( 'pests.id')
            ->delete();
        Filter_attr_entity::where('entity_type', 'question')
            ->leftJoin('questions', 'questions.id', 'filter_attr_entities.entity_id')
            ->whereNull('questions.id')
            ->delete();

        $items=Handbook_photo::leftJoin('handbooks', 'handbooks.id', 'handbook_photos.handbook_id')
            ->whereNull('handbooks.id')
            ->get();
        foreach ($items as $item){
            if(isset($item->path)){
                Storage::delete("public/$item->path");
            }
            $item->delete();
        }
        Handbook_photo::leftJoin('handbooks', 'handbooks.id', 'handbook_photos.handbook_id')
            ->whereNull('handbooks.id')
            ->delete();
        Handbook_videolinks::leftJoin('handbooks', 'handbooks.id', 'handbook_videolinks.handbook_id')
            ->whereNull('handbooks.id')
            ->delete();
        Market::leftJoin('profiles', 'profiles.user_id', 'markets.user_id')
            ->whereNull('profiles.user_id')
            ->delete();


        Pest_chemical::leftJoin('pests', 'pests.id', 'pest_chemicals.pest_id')
            ->whereNull('pests.id')
            ->delete();
        Pest_chemical::leftJoin('chemicals', 'chemicals.id', 'pest_chemicals.chemical_id')
            ->whereNull('chemicals.id')
            ->delete();

        $items=Photos::where('type', 'chemical')
            ->leftJoin('chemicals', 'chemicals.id', 'photos.item_id')
            ->whereNull('chemicals.id')
            ->get();
        foreach ($items as $item){
            if(isset($item->path)){
                Storage::delete("public/$item->path");
            }
            $item->delete();
        }
        $items=Photos::where('type', 'chemical')
            ->leftJoin('chemicals', 'chemicals.id', 'photos.item_id')
            ->whereNull('chemicals.id')
            ->delete();
        //-------------------------------
        $items=Photos::where('type', 'disease')
            ->leftJoin('diseases', 'diseases.id', 'photos.item_id')
            ->whereNull('diseases.id')
            ->get();
        foreach ($items as $item){
            if(isset($item->path)){
                Storage::delete("public/$item->path");
            }
            $item->delete();
        }
        $items=Photos::where('type', 'disease')
            ->leftJoin('diseases', 'diseases.id', 'photos.item_id')
            ->whereNull('diseases.id')
            ->delete();
//---------------------------------------------
        $items=Photos::where('type', 'event')
            ->leftJoin('events', 'events.id', 'photos.item_id')
            ->whereNull('events.id')
            ->get();
        foreach ($items as $item){
            if(isset($item->path)){
                Storage::delete("public/$item->path");
            }
            $item->delete();
        }
        $items=Photos::where('type', 'event')
            ->leftJoin('events', 'events.id', 'photos.item_id')
            ->whereNull('events.id')
            ->delete();
//------------------------------------------------


// TODO допилить очистку













        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'items'=>$items,
        ], 200);
    }

}
