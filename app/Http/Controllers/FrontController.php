<?php

namespace App\Http\Controllers;

use App\Models\Chemical;
use App\Models\Decorator;
use App\Models\Feedback;
use App\Models\Main_page_info;
use App\Models\MyPlants;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\OrganizatorInfo;
use App\Models\Profile;
use App\Models\SellerInfo;
use App\Models\Sort;
use App\Models\Sort_charact_relation;
use App\Models\Sort_characteristic;
use App\Models\Sort_questionary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Vendor_code;

class FrontController extends Controller
{


    public function __construct(Request $request)
    {

        $this->middleware('autchUsers',
            [
                'except' => [
                    'index',
                    'login',
                    'learn',
                    'register',
                    'registerUp',
                    'events',
                    'eventsView',
                    'aboutUs',
                    'decoratorAll',
                    'decoratorView',
                    'mailFeedback',
                    'cultureAll',
                    'showCulturesKlumba',
                    'showCulturesOgorod',
                    'showCulturesSad',
                    'searchCultures',
                    'cultureView',
                    'cultureCurrent',
                    'chemical',
                    'chemicalView',
                    'pests',
                    'pestsView',
                    'pestsView',
                    'diseases',
                    'diseasesView',
                    'reference',
                    'referenceView',
                    'question',
                    'questionView',
                    'rate',
                    'sellers',
                    'suppliers',
                    'news',
                    'filterCatalogCulturesSad',
                    'filterCatalogPest',
                    'filterCatalogDiseases',
                    'searchNameForNewProduct'

                ]
            ]
        );

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $popularGoods = DB::table('order_items')
//            ->select('order_items.item_id as itemId',
//              //  array_sum(['order_items.quantity as quantity']),
//                'products.name',
//                'products.price as minPrice')
//            ->leftJoin('products', 'order_items.item_id','=','products.id')
//            ->groupBy('order_items.item_id')
//            ->get();
//           // ->limit(7);
//        echo'<pre>';
//        var_dump($popularGoods);
//        echo '</pre>';
//        die;

        return view('front.main', [
//            'popularGoods' => $popularGoods,
        ]);
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function aboutUs()
    {

        return view('front.forms.abouts', [
            'main_page_infos' => Main_page_info::all(),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function learn()
    {
        return view('front.forms.learn');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function events()
    {

        $notresult = false;

        if(request()->get('search')) {
            $events = DB::table('events')->where('title', 'like', '%' . request()->get('search') . '%')->orderBy('created_at','desc')->paginate(3);

            if (!isset($events[0]->title)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }

        } else {
            $events = DB::table('events')->orderBy('created_at','desc')->paginate(3);

        }

        $events_filters = DB::table('filter_attributes')
            ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
                'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
            ->leftJoin('filter_attr_values', 'filter_attributes.id', '=', 'filter_attr_values.attribute_id')
            ->where('filter_attributes.type', '=', 'event')
            ->get()
            ->toArray();

        $filters = [];
        foreach ($events_filters as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }

        return view('front.intofront.forms.events', [
            'events' => $events,
            'notresult' => $notresult,
            'title' => 'События',
            'events_filters' => $events_filters,
            'filters' => $filters,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function eventsView($id)
    {
        $event = DB::table('events')->where('id', $id)->first();


        return view('front.intofront.forms.viewspost', [
            'event' => $event
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news()
    {
        $notresult = false;

        if(request()->get('search')) {
            $events = DB::table('events')
                ->where('title', 'like', '%' . request()->get('search') . '%')
                ->orderBy('created_at','desc')
                ->paginate(3);

            if (!isset($events[0]->title)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }

        } else {
            $events = DB::table('events')
                ->orderBy('created_at','desc')
                ->paginate(3);

        }

        $events_filters = DB::table('filter_attributes')
            ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
                'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
            ->leftJoin('filter_attr_values', 'filter_attributes.id', '=', 'filter_attr_values.attribute_id')
            ->where('filter_attributes.type', '=', 'event')
            ->get()
            ->toArray();

        $filters = [];
        foreach ($events_filters as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }
     //   dd($filters);die();
        return view('front.intofront.forms.events', [
            'events' => $events,
            'notresult' => $notresult,
            'title' => 'Новости',
            'filters' => $filters,
        ]);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register(Request $request)
    {

        return view('front.intofront.forms.register');
    }


    public function registerUp(Request $request)
    {
//        $messages = [
//            'agreement.required' => 'Поле "Ознакомлен с пользовательскими соглашениями" обязательно',
//            'password.confirmed' => 'Пароль не совпадает',
//
//        ];

        $errors = Validator::make(request()->all(), [
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|confirmed|min:6',
            'agreement' => 'required'
        ])->errors();

        if (count($errors)) {

            return view('front.intofront.forms.register', [
                'success' => false,
                'errors' => $errors
            ]);
        }

        $user = User::create([
            'email' => request()->get('email'),
            'password' => Hash::make(request()->get('password')),
        ]);

        Profile::create([
            'first_name' => request()->get('first_name'),
            'last_name' => request()->get('last_name'),
            'user_id' => $user->id,
        ]);

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {

            return view('front.intofront.forms.register', [
                'success' => false,
                'errors' => 'Unauthorized user'
            ]);
        }


//        Mail::raw('успешная регестрация', function($message)
//        {
//            $message->from('Cleverdacha@gmail.com', 'Умная дача');
//
//            $message->to(request()->get('email'));
//        });

        return view('front.intofront.forms.login', [
            'success' => 'Успешная регестрация!'
        ]);


    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if($token = auth()->attempt($credentials)) {
            $user = auth()->user();
            if($user->role == 'u') {
                $request->session()->put('aToken', $token);
                $user->remember_token = hash('sha256', $token);
                $user->save();
            }
            return redirect()->action('FrontController@personalInfo');
        }


        return view('front.intofront.forms.login');
    }


    public function logout(Request $request)
    {

        $aToken = $request->session()->get('aToken');
        $user = User::where('remember_token', hash('sha256', $aToken))->first();

        if($user && $user->role == 'u') {
            $request->session()->forget('aToken');
            $user->remember_token = null;
            $user->save();
        }

        return redirect()->action('FrontController@index');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => 'Bearer ' . $token,
            'token_type' => 'bearer',
            //'expires_in' => auth()->factory()->getTTL() * 60000
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cultureAll()
    {
        //var_dump(request()->session()->get('urlCur')[0]);die('cultureAll');
        switch (request()->session()->get('urlCur')[0]) {
            case url('/cultures/Sad');
                $section_id = 6;
                $section = 'Sad';
                break;
            case url('/cultures/Ogorod');
                $section_id = 5;
                $section = 'Ogorod';
                break;
            case url('/cultures/Klumba');
                $section_id = 4;
                $section = 'Klumba';
                break;
        }
        $cultureSort = [];
        $notresult = false;
        if(request()->get('search')) {

            $cultures = DB::table('cultures')
                ->where('name', 'like', '%' . request()->get('search') . '%')
                ->orderBy('created_at','desc')
                ->paginate(30);
            if (!isset($cultures[0]->name)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }
        } else {
            $cultures = DB::table('cultures')->orderBy('created_at','desc')->paginate(30);

        }

        foreach ($cultures as $culture) {
            $culture->countsort = DB::table('sorts')->where('culture_id', $culture->id)->count();
            $cultureSort[] = $culture;
        }

        $filters_data = DB::table('filter_attributes')
            ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
                'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
            ->leftJoin('filter_attr_values', 'filter_attr_values.attribute_id', '=', 'filter_attributes.id')
            ->where('filter_attributes.type', '=', 'culture')
            ->get()
            ->toArray();

        $filters = [];
        foreach ($filters as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }


        return view('front.intofront.forms.culture' , [
            'cultureSort' => $cultureSort,
            'cultures' => $cultures,
            'notresult' => $notresult,
            'title' => 'Культуры',
            'filters_data' => $filters_data,
            'filters' => $filters,
            'cultureType' => $section

        ]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCulturesKlumba() {

        $cultureSort = [];
        $notresult = false;
        if(request()->get('search')) {
            $cultures = DB::table('cultures')->where('name', 'like', '%' . request()->get('search') . '%')->where('section_id', 4)->orderBy('created_at','desc')->paginate(30);
            if (!isset($cultures[0]->name)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }
        } else {
            $cultures = DB::table('cultures')->where('section_id', 4)->orderBy('created_at','desc')->paginate(30);

        }

        foreach ($cultures as $culture) {
            $culture->countsort = DB::table('sorts')->where('culture_id', $culture->id)->count();
            $cultureSort[] = $culture;
        }

        $filters_data = DB::table('filter_attributes')
            ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
                'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
            ->join('filter_attr_values', 'filter_attr_values.attribute_id', '=', 'filter_attributes.id')
            ->where('filter_attributes.section_id', '=', 4)
            ->where(function ($query){
                $query
                    //->where('filter_attributes.type', '=', 'sort')
                    ->orWhere('filter_attributes.type', '=', 'culture');
                   // ->orWhere('filter_attributes.type', '=', 'handbook')
                   // ->orWhere('filter_attributes.type', '=', 'question');
            })
            ->get()
            ->toArray();

        $filters = [];
        foreach ($filters_data as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }

        return view('front.intofront.forms.culture' , [
            'cultureSort' => $cultureSort,
            'cultures' => $cultures,
            'notresult' => $notresult,
            'title' => 'Клумба',
            'filters' => $filters,
            'cultureType' => 'Klumba',
        ]);

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCulturesOgorod()
    {

        $cultureSort = [];
        $notresult = false;
        if(request()->get('search')) {
            $cultures = DB::table('cultures')->where('name', 'like', '%' . request()->get('search') . '%')->where('section_id', 5)->orderBy('created_at','desc')->paginate(30);
            if (!isset($cultures[0]->name)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }
        } else {
            $cultures = DB::table('cultures')->where('section_id', 5)->orderBy('created_at','desc')->paginate(30);

        }

        foreach ($cultures as $culture) {
            $culture->countsort = DB::table('sorts')->where('culture_id', $culture->id)->count();
            $cultureSort[] = $culture;
        }

        $filters_data = DB::table('filter_attributes')
            ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
                'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
            ->join('filter_attr_values', 'filter_attr_values.attribute_id', '=', 'filter_attributes.id')
            ->where('filter_attributes.section_id', '=', 5)
            ->where(function ($query){
                $query->
                  //  where('filter_attributes.type', '=', 'sort')
                    orWhere('filter_attributes.type', '=', 'culture');
                  //  ->orWhere('filter_attributes.type', '=', 'handbook')
                  //  ->orWhere('filter_attributes.type', '=', 'question');
            })
            ->get()
            ->toArray();

        $filters = [];
        foreach ($filters_data as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }

        return view('front.intofront.forms.culture' , [
            'cultureSort' => $cultureSort,
            'cultures' => $cultures,
            'notresult' => $notresult,
            'title' => 'Огород',
            'filters' => $filters,
            'cultureType' => 'Ogorod',
        ]);


    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCulturesSad()
    {
        $cultureSort = [];
        $notresult = false;
        if(request()->get('search')) {
            $cultures = DB::table('cultures')
                ->where('name', 'like', '%' . request()->get('search') . '%')
                ->where('section_id', 6)
                ->orderBy('created_at','desc')
                ->paginate(30);
            if (!isset($cultures[0]->name)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }
        } else {
            $cultures = DB::table('cultures')
                ->where('section_id', 6)
                ->orderBy('created_at','desc')
                ->paginate(30);
        }

        foreach ($cultures as $culture) {
            $culture->countsort = DB::table('sorts')->where('culture_id', $culture->id)->count();
            $cultureSort[] = $culture;
        }

        $filters_data = DB::table('filter_attributes')
           ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
                    'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
           ->join('filter_attr_values', 'filter_attr_values.attribute_id', '=', 'filter_attributes.id')
           ->where('filter_attributes.section_id', '=', 6)
            ->where('filter_attributes.culture_id', '<>', 58)
            ->where('filter_attributes.id', '<>', 194)
           ->where(function ($query){
               $query
                   // ->where('filter_attributes.type', '=', 'sort')
                     ->orWhere('filter_attributes.type', '=', 'culture');
                   //  ->orWhere('filter_attributes.type', '=', 'handbook')
                   //  ->orWhere('filter_attributes.type', '=', 'question');
           })
           ->get()
           ->toArray();
        $filters = [];
        foreach ($filters_data as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }

        return view('front.intofront.forms.culture' , [
            'cultureSort' => $cultureSort,
            'cultures' => $cultures,
            'notresult' => $notresult,
            'title' => 'Сад',
            'filters' => $filters,
            'cultureType' => 'Sad',
        ]);

    }
    public function filterCatalogCulturesSad(){

       $id_filter_attr_values = request()->get('data');

        $cultures = DB::table('filter_attr_entities')
            ->select(['cultures.id as cultureId', 'cultures.name as cultureName',
                'cultures.photo as culturePhoto'])
            ->join('cultures', 'cultures.id', '=','filter_attr_entities.entity_id')
            ->whereIn('filter_attr_entities.attribute_value', $id_filter_attr_values)
            ->groupBy('cultures.id')
            ->get();

        foreach ($cultures as $culture) {
            $culture->countsort = DB::table('sorts')->where('culture_id', $culture->cultureId)->count();
            $cultureSort[] = $culture;
        }

        return view('front.intofront.forms.cultureall' , [
            'data' => $cultureSort,
        ]);
    }




    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchCultures()
    {

        switch (request()->get('section')) {
            case 4:
                return redirect()->action("FrontController@showCulturesKlumba", ['search' => request()->get('search')]);
                break;
            case 5:
                return redirect()->action("FrontController@showCulturesOgorod", ['search' => request()->get('search')]);
                break;
            case 6:
                return redirect()->action("FrontController@showCulturesSad", ['search' => request()->get('search')]);
                break;
            case 7:
                return redirect()->action("FrontController@chemical", ['search' => request()->get('search')]);
                break;
            case 8:
                return redirect()->action("FrontController@events", ['search' => request()->get('search')]);
                break;
            case 9:
                return 'в разработке';
                break;
            case 10:
                return redirect()->action("FrontController@decoratorAll", ['search' => request()->get('search')]);
                break;
            case 11:
                return redirect()->action("FrontController@sellers", ['search' => request()->get('search')]);
                break;
            case 12:
                return 'в разработке';
                break;
        }


    }



    /**
     * @param $id -  идентификатор сорта культуры
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cultureView($culture,$id)
    {
        $notresult = false;
      //  dd($culture);die();

        if(request()->get('search')) {

           $sorts = DB::table('sorts')
               ->where('culture_id', $id)
               ->where('name', 'like', '%' . request()->get('search') . '%')
               ->paginate(30);
            if (!isset($sorts[0]->name)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }
        } else {
            $sorts = DB::table('sorts')->where('culture_id', $id)->paginate(30);

        }

        $culture_filters = DB::table('filter_attributes')
            ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
                'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
            ->leftJoin('filter_attr_values', 'filter_attr_values.attribute_id', '=', 'filter_attributes.id')
            ->where('filter_attributes.culture_id', '=', $id)
            ->get();

        $filters = [];
        foreach ($culture_filters as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }
    //   dd($sorts);
        //die("hello");
        return view('front.intofront.forms.cultureview', [
            'sorts' => $sorts,
            'id' => $id,
            'notresult' => $notresult,
            'culture_filters' => $culture_filters,
            'filters' => $filters,
            'cultureType' => $culture,

        ]);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cultureCurrent($id)
    {

        switch (request()->session()->get('urlCur')[0]) {
            case url('/cultures/Sad');
                    $section_id = 6;
                break;
            case url('/cultures/Ogorod');
                    $section_id = 5;
                break;
            case url('/cultures/Klumba');
                    $section_id = 4;
                break;
        }
        $comments = DB::table('responses')
            ->select('responses.text','responses.rating','profiles.first_name','profiles.last_name')
            ->join('profiles','profiles.user_id','=','responses.user_id')
            ->where('item_id',$id)
            ->where('type','sort')
            ->where("moderator",'accepted')
            ->get();
    //    dd($comments);
        $characteristics = [];
        foreach (Sort::where('section_id', $section_id)->get() as $sort) {
            foreach (Sort_characteristic::all() as $charact) {
                $sort_charact = Sort_charact_relation::where('sort_id', $sort->id)
                    ->where('characteristic_id', $charact->id)
                    ->first();

                $characteristics[$sort->id][$charact->id] = [
                    'valueId' => $charact->id,
                    'name' => $charact->name,
                    'icon_path' => $charact->icon_path,
                    'value' => $sort_charact ? $sort_charact->value : ''
                ];
            }
        }



        $sorts = DB::table('sorts')->where('id', $id)->first();
        $vendor_code = DB::table('vendor_codes')->select('id')->where('sorts_id',$id)->first();

        // данные для блока Магазины
        $sellers = DB::table('products')
           ->select('products.user_id','seller_info.name','seller_info.rating','seller_info.delivery_method')
            ->join('categories','products.characteristic','=','categories.id')
            ->join('seller_info','seller_info.user_id','=','products.user_id')
            ->where('products.name','=',$id)
            ->groupBy('products.name')
          //  ->paginate(15);
            ->get();
        foreach($sellers as $seller){
            $products = DB::table('products')
                ->join('categories','products.characteristic','=','categories.id')
                ->where('products.name','=',$id)
                ->where('products.user_id','=',$seller->user_id)
                ->get();
            $seller->products = $products;
        }
       // dd($sellers);
        $monthDict = [
            1 => "Январь", 2 => "Февраль", 3 => "Март",     4 => "Апрель",   5 => "Май",     6 => "Июнь",
            7 => "Июль",   8 => "Август",  9 => "Сентябрь", 10 => "Октябрь", 11 => "Ноябрь", 12 => "Декабрь"
        ];

        return view('front.intofront.forms.culturecurrent', [
            'rows' => Sort::where('section_id', $section_id)->get(),
            'sorts' => $sorts,
            'monthDict' => $monthDict,
            'characteristics' => $characteristics,
            'user_id' => (new User())->getUserId(),
            'vendor_code' => $vendor_code->id ?? 0,
            'sellers' => $sellers,
            'comments' => $comments
        ]);
    }


    public function addPlants()
    {
        $myPlants = new MyPlants;
        $myPlants->user_id = (int)request()->get('user_id');
        $myPlants->plant_id = (int)request()->get('plant_id');
        $myPlants->save();
       if(Sort_questionary::where('user_id',(new User())->getUserId() )->where('sort_id',$myPlants->plant_id)->count() == 0) {
           $questionnair = new Sort_questionary();
           $questionnair->user_id = (int)request()->get('user_id');
           $questionnair->sort_id = (int)request()->get('plant_id');
           $questionnair->save();
       }

        return response()->json([
            'name' => request()->get('plant_id'),
            'state' => request()->get('user_id')
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rate()
    {

        $rate = DB::table('tariffs')->get();
        return view('front.intofront.forms.rate',
            [
                'rate' => $rate
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function agreement()
    {
        return view('front.intofront.forms.agreement');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pests()
    {
        $typeOfPests = request()->type;
        if($typeOfPests == 'Sad')    $section = 6;
        if($typeOfPests == 'Ogorod') $section = 5;
        if($typeOfPests == 'Klumba') $section = 4;
        $notresult = false;
        if(request()->get('search')) {
            $pests = DB::table('pests')
                ->where('name', 'like', '%' . request()->get('search') . '%')
                ->orderBy('created_at','desc')
                ->paginate(3);
         //   dd($pests);
            if (!isset($pests[0]->name)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }
        } else {
            $pests = DB::table('pests')->where('section_id','=',$section )->orderBy('created_at','desc')->paginate(5);
        }


        $pests_filters = DB::table('filter_attributes')
            ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
                'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
            ->leftJoin('filter_attr_values', 'filter_attributes.id', '=', 'filter_attr_values.attribute_id')
            ->where('filter_attributes.type', '=', 'pest')
            ->where('filter_attributes.section_id', '=',$section)
            ->get()
            ->toArray();
        $filters = [];
        foreach ($pests_filters as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }
        return view('front.intofront.forms.pests', [
            'pests' => $pests,
            'notresult' => $notresult,
            'pests_filters' => $pests_filters,
            'filters' => $filters,
            'cultureType' => $typeOfPests,
        ]);

    }
    public function filterCatalogPest(){

        $id_filter_attr_values = request()->get('data');
        $typeOfPests = request()->get('type');
        if($typeOfPests == 'Sad')    $section = 6;
        if($typeOfPests == 'Ogorod') $section = 5;
        if($typeOfPests == 'Klumba') $section = 4;

        $pests = DB::table('filter_attr_entities')
            ->select([
                'pests.id as pestId',
                'pests.name as pestsName',
                'pests.description as pestDescription',
                'pests.main_photo as pestPhoto'
            ])
            ->join('pests', 'pests.id', '=', 'filter_attr_entities.entity_id')
            ->where('pests.section_id',$section)
            ->whereIn('filter_attr_entities.attribute_value', $id_filter_attr_values)
            ->groupBy('pests.id')
            ->get();

        return view('front.intofront.forms.pestsFilter', [
            'data' => $pests,
            'typeOfPests' => $typeOfPests
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pestsView($id)
    {
        $typeOfPests = request()->type;;
        $id = request()->id;
        $Preparations = [];
        $pests = DB::table('pests')->where('id', $id)->first();
        $drugs = DB::table('pest_chemicals')->where('pest_id', $id)->select('chemical_id')->get();

        foreach ($drugs as $drug) {
            $Preparations[$drug->chemical_id] =  Chemical::where('id', $drug->chemical_id)->get();
        }
        return view('front.intofront.forms.catalogview',[
            'pests' => $pests,
            'chemicals' => $Preparations,
            'cultureType' => $typeOfPests
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function diseases()
    {
      //  die('deseases');
        $typeOfDiseases = request()->type;

        if($typeOfDiseases == 'Sad')    $section = 6;
        if($typeOfDiseases == 'Ogorod') $section = 5;
        if($typeOfDiseases == 'Klumba') $section = 4;
        $diseases_filters = DB::table('filter_attributes')
            ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
                'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
            ->leftJoin('filter_attr_values', 'filter_attributes.id', '=', 'filter_attr_values.attribute_id')
            ->where('filter_attributes.type', '=', 'disease')
            ->where('filter_attributes.section_id', '=', $section)
            ->get()
            ->toArray();

        $notresult = false;
        if(request()->get('search')) {
            $diseases = DB::table('diseases')
                ->where('name', 'like', '%' . request()->get('search') . '%')
                ->orderBy('created_at','desc')
                ->paginate(3);

            if (!isset($diseases[0]->name)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }
        } else {
            $diseases = DB::table('diseases')
                ->where('section_id','=',$section)
                ->orderBy('created_at','desc')
                ->paginate(10);
        }

        $filters = [];
        foreach ($diseases_filters as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }

        return view('front.intofront.forms.diseases',[
            'diseases' => $diseases,
            'notresult' => $notresult,
            'diseases_filters' =>  $diseases_filters,
            'filters' => $filters,
            'cultureType' => $typeOfDiseases,
        ]);

    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function diseasesView($id)
    {
       $id = request()->id;
        $typeOfDiseases = request()->type;
        $Preparations = [];
        $disease = DB::table('diseases')->where('id', $id)->first();
        $drugs = DB::table('disease_chemicals')->where('disease_id', $id)->select('chemical_id')->get();

        foreach ($drugs as $drug) {
            $Preparations[$drug->chemical_id] =  Chemical::where('id', $drug->chemical_id)->get();
        }

        return view('front.intofront.forms.diseaseview',[
            'pests' => $disease,
            'chemicals' => $Preparations,
            'cultureType' => $typeOfDiseases,
        ]);
    }

    public function filterCatalogDiseases()
    {
      //  echo "diseases"; die();
        $id_filter_attr_values = request()->get('data');
        $typeOfDiseases = request()->get('type');
        if($typeOfDiseases == 'Sad')    $section = 6;
        if($typeOfDiseases == 'Ogorod') $section = 5;
        if($typeOfDiseases == 'Klumba') $section = 4;

        $pests = DB::table('filter_attr_entities')
            ->select([
                'diseases.id as diseaseId',
                'diseases.name as diseaseName',
                'diseases.description as diseaseDescription',
                'diseases.main_photo as diseasePhoto'
            ])
            ->join('diseases', 'diseases.id', '=', 'filter_attr_entities.entity_id')
            ->where('diseases.section_id',$section)
            ->whereIn('filter_attr_entities.attribute_value', $id_filter_attr_values)
            ->groupBy('diseases.id')
            ->get();

        return view('front.intofront.forms.diseasesFilter', [
            'data' => $pests,
            'typeOfDisease' => $typeOfDiseases
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reference()
    {
        $typeOfReference = request()->type;
       // echo $typeOfReference; die();
        $notresult = false;
        if(request()->get('search')) {
            $reference = DB::table('handbooks')
                ->where('title', 'like', '%' . request()->get('search') . '%')
                ->orderBy('date','desc')
                ->paginate(3);
            if (!isset($reference[0]->title)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }
        } else {
            $reference = DB::table('handbooks')->orderBy('date','desc')->paginate(3);
        }

        $filters_reference = DB::table('filter_attributes')
        ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
        'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
        ->leftJoin('filter_attr_values', 'filter_attributes.id', '=', 'filter_attr_values.attribute_id')
        ->where('filter_attributes.type', '=', 'handbook')
            ->where('filter_attributes.section_id', '=', 0)
        ->get()
        ->toArray();

        $filters = [];
        foreach ($filters_reference as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }

        return view('front.intofront.forms.reference', [
            'references' => $reference,
            'filters_reference' =>  $filters_reference,
            'filters' => $filters,
            'notresult' => $notresult,
            'cultureType' => $typeOfReference,
        ]);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function referenceView($type,$id)
    {

        $typeOfReference = request()->type;
        $reference = DB::table('handbooks')->where('id', $id)->first();

        return view('front.intofront.forms.referenceview', [
            'reference' => $reference,
            'cultureType' => $typeOfReference,
        ]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function question()
    {
        $typeOfQuestion = request()->type;

        $questions = DB::table('questions')
            ->selectRaw('questions.*, COUNT(question_answers.id) as count, profiles.photo')
            ->join('profiles', 'profiles.user_id', '=', 'questions.user_id')
            ->leftJoin('question_answers', 'question_answers.question_id', '=', 'questions.id')
            ->where('questions.moderator', '=', 'accepted')
            ->groupBy('questions.id', 'profiles.photo')
            ->paginate(5);
    //   dd($questions);
        return view('front.intofront.forms.question',
            [
                'questions' => $questions,
                'userId' => (new User())->getUserId(),
                'cultureType' => $typeOfQuestion,
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function questionView($id)
    {
        $question =  DB::table('questions')
            ->select(['questions.*', 'profiles.first_name', 'profiles.last_name', 'profiles.photo'])
            ->join('profiles', 'profiles.user_id', '=', 'questions.user_id')
            ->where('questions.id', '=', $id)
            ->first();



        $answers = DB::table('question_answers')
            ->select(['question_answers.*', 'profiles.first_name', 'profiles.last_name', 'profiles.photo'])
            ->join('profiles', 'profiles.user_id', '=', 'question_answers.user_id')
            ->where('question_answers.question_id', '=', $id)
            ->get();


        return view('front.intofront.forms.questionview',
            [
                'question' => $question,
                'answers' => $answers,
                'userId' => (new User())->getUserId(),
                'questionId' => $question->id,
            ]
        );


    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function personalInfo(Request $request)
    {
     //   var_dump(request()->post());die();
        $users = DB::table('profiles')->where('user_id', (new User())->getUserId())->first();
        $mail = DB::table('users')->where('id', (new User())->getUserId())->first();
        $load_photo = false;
        if ( $request->hasFile('photo')){
            if ($request->file('photo')->isValid()){
                $file = $request->file('photo');
                $name = $file->getClientOriginalName();
                $file->move('images' , $name);
                $load_photo = true;
              //  echo $load_photo;
               // die($load_photo);
            }
        }

        if (request()->get('save')) {
          //   die("get");
            $users = Profile::where('user_id', (new User())->getUserId())->first();
            $users->first_name = request()->get("first_name");
            $users->last_name = request()->get("last_name");
            $users->nickname = request()->get("nickname");
            isset($name) ? $users->photo = $name : null;
            $users->phone = request()->get("phone");
            $users->address = request()->get("address");
            $users->birthday = request()->get("birthday");
            $users->social_vkotakte = request()->get("social_vkotakte");
            $users->social_facebook = request()->get("social_facebook");
            $users->social_odnoklasniki = request()->get("social_odnoklasniki");
            $users->social_twitter = request()->get("social_twitter");
            $users->social_instagram = request()->get("social_instagram");
            $users->social_youtube = request()->get("social_youtube");
            $users->save();
         //   return redirect()->action('FrontController@personalInfo');

        }

        $users = DB::table('profiles')->where('user_id', (new User())->getUserId())->first();
        $mail = DB::table('users')->where('id', (new User())->getUserId())->first();
    //   die($load_photo);
        return view('front.intofront.forms.personalInfo', [
            'users' => $users,
            'mail' => $mail->email,
            'load_photo' => $load_photo,
        ]);
    }



    public function personalInfoSeller(Request $request)
    {

        $mail = User::where('id', (new User())->getUserId())->first();
        $seller = SellerInfo::where('user_id', (new User())->getUserId())->first();
        $users = Profile::where('user_id', (new User())->getUserId())->first();

        if ($seller == null) {
            $newSell = new SellerInfo;
            $newSell->user_id = (new User())->getUserId();
            $newSell->save();
        }

        if ( $request->hasFile('emblem')){
            if ($request->file('emblem')->isValid()) {
                $file = $request->file('emblem');
                $name = $file->getClientOriginalName();
                $file->move('images' , $name);
            }
        }

        if (request()->get('save')) {

           // dd(request()->get("delivery") );
               // die('save');
            request()->get("title") ?  $seller->name = request()->get("title") : null;
            request()->get("place") ? $seller->place = request()->get("place") : null;
            request()->get("avatar") ? $seller->is_avatar = request()->get("avatar") : $seller->is_avatar = null;
            request()->get("isShop") ? $seller->is_shop = request()->get("isShop") : $seller->is_shop = null;
            isset($name) ? $seller->emblem = $name : null;
            request()->get("delivery") ? $seller->delivery_method = request()->get("delivery") : null ;
            $seller->save();

            request()->get("phone") ? $users->phone = request()->get("phone") : null;
            request()->get("address") ? $users->address = request()->get("address") : null;
            request()->get("site") ? $users->site = request()->get("site") : null;
            request()->get("about") ? $users->about_me_seller = request()->get("about") : null ;
            $users->save();
            request()->get("mail") ? $mail->email = request()->get("mail") : null;
            $mail->save();

            return redirect()->action('FrontController@personalInfoSeller');

        }
       // dd($seller->delivery_method);
        return view('front.intofront.forms.personalInfoSel', [
                'users' => $users,
                'mail' => $mail->email,
                'seller' => $seller,
            ]);
    }


    public function personalInfoOrganizer(Request $request)
    {
        $mail = User::where('id', (new User())->getUserId())->first();
        $users = Profile::where('user_id', (new User())->getUserId())->first();
        $organizator = OrganizatorInfo::where('user_id', (new User())->getUserId())->first();


        if ($organizator == null) {
            $neworganizator = new OrganizatorInfo;
            $neworganizator->user_id = (new User())->getUserId();
            $neworganizator->save();
        }

        if ( $request->hasFile('emblem')){
            if ($request->file('emblem')->isValid()) {
                $file = $request->file('emblem');
                $name = $file->getClientOriginalName();
                $file->move('images' , $name);
            }
        }


        if (request()->get('save')) {

            isset($name) ? $organizator->emblem = $name : null;
            request()->get("avatar") ? $organizator->is_avatar = request()->get("avatar") : $organizator->is_avatar = null;
            request()->get("about") ? $organizator->about = request()->get("about") : null;
            $organizator->save();

            request()->get("first_name") ? $users->first_name = request()->get("first_name") : null;
            request()->get("last_name") ? $users->last_name = request()->get("last_name") : null;
            request()->get("phone") ? $users->phone = request()->get("phone") : null;
            request()->get("address") ? $users->address = request()->get("address") : null;
            request()->get("site") ? $users->site = request()->get("site") : null;

            request()->get("social_vkotakte") ? $users->social_vkotakte = request()->get("social_vkotakte") : null;
            request()->get("social_facebook") ? $users->social_facebook = request()->get("social_facebook") : null;
            request()->get("social_odnoklasniki") ? $users->social_odnoklasniki = request()->get("social_odnoklasniki") : null;
            request()->get("social_twitter") ? $users->social_twitter = request()->get("social_twitter") : null;
            request()->get("social_instagram") ? $users->social_instagram = request()->get("social_instagram") : null;
            request()->get("social_youtube") ? $users->social_youtube = request()->get("social_youtube") : null;
            $users->save();

            request()->get("mail") ? $mail->email = request()->get("mail") : null;
            $mail->save();

            return redirect()->action('FrontController@personalInfoOrganizer');

        }


        return view('front.intofront.forms.personalInfoOr', [
            'users' => $users,
            'mail' => $mail->email,
            'organizator' => $organizator,
        ]);
    }

    public function personalInfoDecorator(Request $request)
    {
        $mail = User::where('id', (new User())->getUserId())->first();
        $users = Profile::where('user_id', (new User())->getUserId())->first();
        $decorator = Decorator::where('user_id', (new User())->getUserId())->first();


        if ($decorator == null) {
            $newdecorator = new Decorator;
            $newdecorator->user_id = (new User())->getUserId();
            $newdecorator->save();
        }

        if ( $request->hasFile('emblem')){
            if ($request->file('emblem')->isValid()) {
                $file = $request->file('emblem');
                $name = $file->getClientOriginalName();
                $file->move('images' , $name);
            }
        }


        if (request()->get('save')) {

            isset($name) ? $decorator->emblem = $name : null;
            request()->get("cost") ? $decorator->cost = request()->get("cost") : null;
            $decorator->save();

            request()->get("first_name") ? $users->first_name = request()->get("first_name") : null;
            request()->get("last_name") ? $users->last_name = request()->get("last_name") : null;
            request()->get("phone") ? $users->phone = request()->get("phone") : null;
            request()->get("address") ? $users->address = request()->get("address") : null;
            request()->get("site") ? $users->site = request()->get("site") : null;
            request()->get("avatar") ? $users->is_avatar = request()->get("avatar") : $users->is_avatar = null;

            request()->get("min_price_decorator") ? $users->min_price_decorator = request()->get("min_price_decorator") : null;
            request()->get("max_price_decorator") ? $users->max_price_decorator = request()->get("max_price_decorator") : null;

            request()->get("social_vkotakte") ? $users->social_vkotakte = request()->get("social_vkotakte") : null;
            request()->get("social_facebook") ? $users->social_facebook = request()->get("social_facebook") : null;
            request()->get("social_odnoklasniki") ? $users->social_odnoklasniki = request()->get("social_odnoklasniki") : null;
            request()->get("social_twitter") ? $users->social_twitter = request()->get("social_twitter") : null;
            request()->get("social_instagram") ? $users->social_instagram = request()->get("social_instagram") : null;
            request()->get("social_youtube") ? $users->social_youtube = request()->get("social_youtube") : null;
            request()->get("about_me_decorator") ? $users->about_me_decorator = request()->get("about_me_decorator") : null;
            $users->save();

            request()->get("mail") ? $mail->email = request()->get("mail") : null;
            $mail->save();

            return redirect()->action('FrontController@personalInfoDecorator');

        }

        return view('front.intofront.forms.personalInfoDe', [
            'users' => $users,
            'mail' => $mail->email,
            'decorator' => $decorator,
        ]);
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myOrder()
    {
        $userId = (new User())->getUserId();

        $orderInfo = DB::table('orders')
            ->select('profiles.first_name','profiles.last_name','delivery_methods.name as deliveryName',
                'order_statuses.status_name','order_items.type','order_items.quantity', 'orders.id',
                'order_items.price','order_items.total','products.name','products.characteristic',
                'products.unit', 'orders.created_at', 'products.id as productId')
            ->join('profiles','profiles.user_id','=','orders.user_id')
            ->join('delivery_methods','delivery_methods.id','=','orders.delivery_method_id')
            ->join('order_statuses','orders.status_id','=','order_statuses.id')
            ->join('order_items','order_items.order_id','=','orders.id')
            ->join('products','products.id','=','order_items.item_id')
            ->where('orders.user_id', '=', $userId)
            ->paginate(8);
     //  dd($orderInfo); die('myOrder');
        return view('front.intofront.forms.myorder', [
            'orderInfo' => $orderInfo,
    ]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function assortment()
    {
       // echo (new User())->getUserId();
        $products = DB::table('products')
            ->join('categories','products.characteristic','=','categories.id')
            ->join('sorts','sorts.id','=','products.name')
            ->where('products.user_id','=',(new User())->getUserId())
            ->paginate(15);
      // dd($products);
        // die('assortmet');
        return view('front.intofront.forms.assortment', [
            'products' => $products,
            'userId' => (new User())->getUserId(),
        ]);
    }

    /**
     * Получение данных для модального окна редактирования продукта у продавца
     * @param Request $request
     * @return mixed
     */
    public function modalGetChangeProductParams(Request $request){
        $userId = (new User())->getUserId();

        $id = $request->id;
        $products = DB::table('products')
            ->select()

            ->join('categories','categories.id','=','products.characteristic')
           ->where('products.id',$id)
            ->first();
        $category = DB::table('categories')
           ->where('type',$products->type)
            ->groupby('category')
           ->get();
       // return Response::json($userId);
      //  $type_category = DB::table('categories')->select('id','category')->where('id',)
        $feature = DB::table('categories')
            ->select('feature','id')
            ->where('category',$products->category)
            ->get();
        $data =[
            'products'=>$products,
           'category' => $category,
           'feature' => $feature
        ] ;

        return Response::json($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sumtable()
    {
        return view('front.intofront.forms.sumtable');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myPlants()
    {
        $idPlants = [];
        $cultures = DB::table('my_plants')
            ->where('user_id', (new User())->getUserId())
            ->orderBy('created_at','desc')->get();

        foreach ($cultures as $culture) {
            $idPlants[] = $culture->plant_id;
        }
       // dd($idPlants);
      //  dd($cultures);die();
         $myPlants = DB::table('sorts')
             ->whereIn('id', $idPlants)
             ->orderBy('created_at','desc')
             ->get();
       // dd($myPlants);die();
        return view('front.intofront.forms.myplants', [
            'myPlants' => $myPlants
        ]);
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bookmarks()
    {
        return view('front.intofront.forms.bookmarks');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notification()
    {
        return view('front.intofront.forms.notification');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function questionnaire()
    {

      //  $sort_questionary = Sort_questionary::all();
    //    echo Sort_questionary::where('user_id',(new User())->getUserId() )->where('sort_id',100)->count();die('sort');
      // $sort_questionary = Sort_questionary::where('user_id',(new User())->getUserId())->first();
       $sort_questionary = DB::table('sorts')
           ->select()
           ->leftJoin('sort_questionaries', 'sort_questionaries.sort_id', '=', 'sorts.id')
           ->where('sort_questionaries.user_id', '=',(new User())->getUserId() )
           ->get()
           ->first();
     //  dd($sort_questionary);die();
    //   echo ;
       // $sort =  Sort::find($sort_questionary->sort_id);
        $sort= DB::table('sorts')
            ->select('main_photo','name','slug','sort_id','sort_questionaries.id')
            ->leftJoin('sort_questionaries', 'sort_questionaries.sort_id', '=', 'sorts.id')
            ->where('sort_questionaries.user_id', '=',(new User())->getUserId() )
            ->paginate(5);
           // ->toArray();
       // $sort =  Sort::where('sort_id',$sort_questionary->sort_id);
      //  dd($sort);
    //    dd($sort_questionary);
     //  die("questionnaire");
        return view('front.intofront.forms.questionnaire',[
            'model'=>$sort_questionary,
            'sorts'=>$sort,
        ]);
    }
    public function quest(Request $request ){
      //  echo $request->sort_id;
      //  echo $request->quest_id;
        $sort_questionary = DB::table('sorts')
            ->select('name','sort_questionaries.id','generation','landing_area','landing_type','seeding_date','cultivation_type','ground_transplantation_date',
                'trimming_date','is_ill','artificial_irrigation','drip_irrigation','precipitation_from_planting','feeding_from_planting',
                'artificial_irrigation_from_planting','harvest')
            ->leftJoin('sort_questionaries', 'sort_questionaries.sort_id', '=', 'sorts.id')
            ->where('sort_questionaries.id', '=',$request->quest_id )
            ->get()
            ->toArray();
            //->first();
        return json_encode($sort_questionary);
    }
    public function updateQuest(Request $request ){
        $sort_questionary = Sort_questionary::find($request->id);
     //    echo $request->val_field;
       // var_dump($sort_questionary->generation);
       // $date = "2019.05.01";
        $sort_questionary->{$request->name_field} = $request->val_field;
      //  $sort_questionary->{$request->name_field} = $date;
       //echo $sort_questionary->generation;
        $sort_questionary->save();
       // dd($sort_questionary);
        return json_encode($sort_questionary);
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chemical()
    {

        $notresult = false;

        if(request()->get('search')) {
            $chemicals = DB::table('chemicals')
                ->where('name', 'like', '%' . request()->get('search') . '%')
                ->orderBy('created_at','desc')
                ->paginate(30);
            if (!isset($chemicals[0]->name)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }
        } else {
            $chemicals = DB::table('chemicals')
                ->orderBy('created_at','desc')
                ->paginate(30);

        }

        $chemicals_filters = DB::table('filter_attributes')
            ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
                'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
            ->leftJoin('filter_attr_values', 'filter_attributes.id', '=', 'filter_attr_values.attribute_id')
            ->where('filter_attributes.type', '=', 'chemical')
            ->get()
            ->toArray();

        $filters = [];
        foreach ($chemicals_filters as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }


        return view('front.intofront.forms.chemical', [
            'chemicals' => $chemicals,
            'notresult' => $notresult,
            'chemicals_filters' => $chemicals_filters,
            'filters' => $filters,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chemicalView($id)
    {
        $chemical = DB::table('chemicals')->where('id', $id)->first();
        $vendor_code = DB::table('vendor_codes')->select('id')->where('chemicals_id', $id)->first();
       // dd($chemical);
        return view('front.intofront.forms.chemicalview', [
            'chemical' => $chemical,
            'vendor_code' => $vendor_code->id ?? 0
        ]);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sellers($product_id = null)
    {
        $title = "Поставщики";

        $notresult = false;

        if(request()->get('search')) {

            $users = DB::table('profiles')
                ->where('is_seller', 1)
                ->where('first_name', 'like', '%' . request()->get('search') . '%')
                ->orWhere('last_name', 'like', '%' . request()->get('search') . '%')
                ->orderBy('created_at','desc')->paginate(5);

            if (!isset($users[0]->first_name)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }

        }elseif ($product_id){
            $users = DB::table('profiles')
                ->join('products','products.user_id','=','profiles.user_id')
                ->where('is_seller',1)
                ->where('products.name',$product_id)
                ->orderBy('profiles.created_at','desc')
                ->groupBy('profiles.id')
                ->paginate(5);
        } else {
            $users = DB::table('profiles')
                ->where('is_seller', 1)
                ->orderBy('created_at','desc')
                ->paginate(5);
        }
        $sellers_filters = DB::table('filter_attributes')
            ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
                'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
            ->leftJoin('filter_attr_values', 'filter_attributes.id', '=', 'filter_attr_values.attribute_id')
            ->where('filter_attributes.type', '=', 'seller')
            ->get()
            ->toArray();

        $filters = [];
        foreach ($sellers_filters as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }
        return view('front.intofront.forms.sellers', [
            'users' => $users,
            'title' => $title,
            'notresult' => $notresult,
            'sellers_filters' => $sellers_filters,
            'filters' => $filters,
        ]);
    }

    /**
     * Поставщики
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function suppliers($id)
    {

        $user = DB::table('profiles')->where('user_id', $id)->first();
       // dd($user);
        $user_products = DB::table('products')
            ->select('products.*','sorts.name','sorts.rating')
            ->join('sorts','sorts.id','=','products.name')
            ->where('user_id', $id)
            ->where('type','sort')
            ->paginate(10);
       // dd($user_products);
        $delivery_methods = DB::table('delivery_methods')
            ->get();


        return view('front.intofront.forms.suppliers', [
            'user' => $user,
            'user_products' => $user_products,
            'delivery_methods' => $delivery_methods,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function decoratorAll()
    {

        $notresult = false;

        if(request()->get('search')) {

            $users = DB::table('profiles')
                ->where('is_decorator', 1)
                ->where('first_name', 'like', '%' . request()->get('search') . '%')
                ->orWhere('last_name', 'like', '%' . request()->get('search') . '%')
                ->orderBy('created_at','desc')->paginate(5);

            if (!isset($users[0]->first_name)) {
                $notresult = 'по запросу: ' . request()->get('search') . ' ничего нет';
            }

        } else {
            $users = DB::table('profiles')->where('is_decorator', 1)->orderBy('created_at','desc')->paginate(5);

        }

        $decorator_filters = DB::table('filter_attributes')
            ->select(['filter_attributes.id as filterId', 'filter_attributes.name as filterName',
                'filter_attr_values.id as attrId', 'filter_attr_values.attribute_value as attrName'])
            ->leftJoin('filter_attr_values', 'filter_attributes.id', '=', 'filter_attr_values.attribute_id')
            ->where('filter_attributes.type', '=', 'decorator')
            ->get()
            ->toArray();

        $filters = [];
        foreach ($decorator_filters as $filter) {
            $filters[$filter->filterId]['name'] = $filter->filterName;
            $filters[$filter->filterId]['attributes'][$filter->attrId] = $filter->attrName;
        }


        return view('front.intofront.forms.decorator', [
            'users' => $users,
            'title' => 'Флористы, декораторы и ландшафтные дизайнеры',
            'notresult' => $notresult,
            'decorator_filters' => $decorator_filters,
            'filters' => $filters,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function decoratorView($id)
    {

        $user = DB::table('profiles')->where('user_id', $id)->first();

        return view('front.intofront.forms.decoratorview', [
            'user' => $user
        ]);
    }


    public function userRole($id)
    {
        $userRole = Profile::where('user_id', (new User())->getUserId())->first();
        $userRole->current_role = $id;
        $userRole->save();

        switch ($id) {
            case 'C';
                return redirect()->action('FrontController@personalInfo');
                break;
            case 'S';
                return redirect()->action('FrontController@personalInfoSeller');
                break;
            case 'O';
                return redirect()->action('FrontController@personalInfoOrganizer');
                break;
            case 'D';
                return redirect()->action('FrontController@personalInfoDecorator');
                break;
        }


    }


    public function mailFeedback()
    {


        if (request()->get('rate') == 1 ) {
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $message = '
                <html>
                <head>
                  <title>Заявка на тариф</title>
                </head>
                <body>
                  <p>Заявка на тариф</p>
                  <table>
                    <tr>
                      <th>Почта</th><th>Сообщение</th>
                    </tr>
                    <tr>
                      <td>'.request()->get('mail').'</td><td>'.request()->get('mess').'</td>
                    </tr>
                  </table>
                </body>
                </html>
            ';
            mail('Cleverdacha@gmail.com', 'Заявка на тариф', $message, $headers);
        }

        $feedback = new Feedback();
        $feedback->email = request()->get('mail');
        $feedback->text = request()->get('mess');
        $feedback->type = 'cooperation';
        $feedback->save();


    }

    public function modalAddQuestion(Request $request) {
        try {
            $input = $request->all();
            DB::table('questions')
                ->insert([
                    'user_id' => $input['userId'],
                    'section_id' => $input['questionType'],
                    'title' => $input['questionTitle'],
                    'text' => $input['questionText'],
                    'date' => date('Y-m-d'),
                    'time' => date('H:i:s'),
                    ]);


            Response::json();
        } catch (\Exception $e) {
            Response::json([$e->getMessage(), 400]);
        }
    }

    public function modalAddProduct(Request $request) {
        try {
         
            $input = $request->all();
          //  echo $input['iName'];
            DB::table('products')
                ->insert([
                    'user_id' => $input['userId'],
                    'section_id' => $input['iCategory'],
                    'name' => !empty($input['iName'])?(int)$input['iName']:"0",
                    'type' => $input['iType'],
                    'characteristic' => $input['iCharacteristic'],
                    'quantity' => $input['iQuantity'],
                    'unit' => $input['iUnit'],
                    'price' => $input['iPrice'],
                    'add_information' => $input['iTextarea'],
                ]);
      //   DB::table('products')->insert($form_data);
            Response::json();
        } catch (\Exception $e) {
            Response::json([$e->getMessage(), 400]);
        }

    }
    public function modalGetAddProductParams(Request $request){

            $input = $request->all();
            if($input['type']=='type') {
                $response = DB::table("categories")
                    ->select('category', 'id')
                    ->where('type', $input['Value'])
                    ->groupBy('category')
                    ->get();
            }elseif ($input['type']=='category'){
                $response = DB::table("categories")
                    ->select( 'id', 'feature')
                    ->where('category', $input['Value'])
                    ->get();
               // return $input['Value'];
                return Response::json($response);
            }
            return Response::json($response);


//       return Response::json($temp);
      //  echo $temp;
      //  return $temp;
    }
    public function modalAddAnswer(Request $request) {
        try {
            $input = $request->all();
            DB::table('question_answers')
                ->insert([
                    'question_id' => $input['questionId'],
                    'user_id' => $input['userId'],
                    'text' => $input['answerText'],
                    'date' => date('Y-m-d'),
                ]);
            Response::json();
        } catch (\Exception $e) {
            Response::json([$e->getMessage(), 400]);
        }
    }
    // поиск названия продуктов при создании нового продукта у продавца
    public function searchNameForNewProduct(Request $request){
        try{
            $input = $request->all();
             if($input['type']=='chemical'){
                 $chemicals = DB::table('chemicals')
                     ->select('id','name')
                     ->where('name', 'like',  $input['name'] . '%')
                    ->get();
             }elseif ($input['type']=='sort'){
                 $chemicals = DB::table('sorts')
                     ->select('id','name')
                     ->where('name', 'like',  $input['name'] . '%')
                     ->get();
             }
            $response = "";
            foreach($chemicals as $item){
                echo "\n<li data-id='$item->id'>".$item->name."</li>";
            }

            //return $chemicals;
           // return $input['type'];
        }
        catch(\Exception $e){

        }
    }

    public function modalUpProduct(Request $request) {
      //  echo "works";Response::json();
        try {
            $input = $request->all();
            DB::table('products')
                ->where('id', $input['Id'])
                ->update([
                    'user_id' => $input['userId'],
                    'section_id' => $input['iCategory'],
                    'name' => $input['iName'],
                    'type' => $input['iType'],
                    'characteristic' => $input['iCharacteristic'],
                    'quantity' => $input['iQuantity'],
                    'unit' => $input['iUnit'],
                    'price' => $input['iPrice'],
                    'add_information' => $input['iTextarea'],
                ]);
            Response::json();
        } catch (\Exception $e) {
            Response::json([$e->getMessage(), 400]);
        }

    }

    public function addBasketProduct(Request $request) {
        try {
            $input = $request->all();
            $userId = (new User())->getUserId();

            DB::table('basket')
                ->updateOrInsert([
                    'user_id'=>$userId,
                    'product_id'=>$input['productId']
                ], ['quantity'=>$input['quantity'], 'delivery_method_id'=>$input['deliveryMethods'],]);



            Response::json('Success', 200);
        } catch (\Exception $e) {
            Response::json([$e->getMessage(), 400]);
        }
    }

    public function createOrder(){
        $userId = (new User())->getUserId();

        $orderInfo = DB::table('basket')
            ->select('basket.user_id','basket.delivery_method_id','basket.product_id',
                'basket.quantity','products.price','products.type', 'products.user_id as owner_id',
                'products.section_id')
            ->join('products', 'products.id', '=', 'basket.product_id')
            ->where('basket.user_id', '=', $userId)
            ->get()->toArray();


        $order = new Order();
        $order->user_id = $orderInfo[0]->user_id;
        $order->owner_id = $orderInfo[0]->owner_id;
        $order->status_id = 1;
        $order->delivery_method_id = $orderInfo[0]->delivery_method_id;
        $order->save();


        foreach($orderInfo as $item){
            $orderItem = new Order_Item();

            $orderItem->order_id = $order->id;
            $orderItem->item_id = $item->product_id;
            $orderItem->type = $item->type;
            $orderItem->category_id = $item->section_id;
            $orderItem->quantity = $item->quantity;
            $orderItem->price = $item->price;
            $orderItem->save();


        }

        $cleanBasket = DB::table('basket')
            ->where('basket.user_id', '=', $userId)
            ->delete();

    }

    public function modalAddComment(Request $request){
        try{
            $input = $request->all();
            DB::table('responses')
                ->insert([
                    'item_id' => $input['item_id'],
                    'user_id' => $input['user_id'],
                    'text' => $input['text'],
                    'date' => date('Y-m-d'),
                    'type' => $input['type'],
                    'rating' => $input['rating']
                ]);
            Response::json();
        }catch(\Exception $e){
            Response::json([$e->getMessage(),400]);
        }
        //echo 'First comment';
    }
}

