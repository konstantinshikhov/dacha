<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Assortment;
use App\Models\Bookmarks;
use App\Models\Bookmarks_folder;
use App\Models\Delivery_method;
use App\Models\Event_participant;
use App\Models\Handbook;
use App\Models\Handbook_videolinks;
use App\Models\Market;
use App\Models\Notification;
use App\Models\Order_Item;
use App\Models\Photos;
use App\Models\Profile;
use App\Models\Question;
use App\Models\Question_answer;
use App\Models\Response;
use App\Models\Sort_questionary;
use App\Models\Tarif_history;
use App\Models\User_delivery_method;
use App\Models\User_entrance;
use App\Models\User_sorts;
use Illuminate\Http\Request;
use App\Models\Order;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @SWG\Get(
     *     path="/user/index",
     *     operationId="Get user data",
     *     description="Get user data",
     *     summary="Get user data",
     *     produces={"application/json"},
     *     tags={"User"},
     *     security={{"access_token":{}}},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function index()
    {
        $this->middleware('auth:api');
        $user = auth()->user();
        $user_id = $user['id'];
        $delivery_methods=User_delivery_method::select('user_delivery_methods.method_id', 'name')
            ->where('user_id', $user_id)
            ->leftJoin('delivery_methods', 'delivery_methods.id', 'user_delivery_methods.method_id')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'user' => auth()->user()->load('profile'),
            'delivery_methods'=>$delivery_methods,
        ], 200);
    }

    /**
     * @SWG\Post(
     *     path="/user/update",
     *     operationId="Update user data",
     *     description="Update user data",
     *     summary="Update user data",
     *     produces={"application/json"},
     *     consumes={"multipart/form-data"},
     *     tags={"User"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="email", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="first_name", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="last_name", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="phone", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="birthday", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="address", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="photo", required=false, in="formData", type="file"),
     *     @SWG\Parameter(name="site", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="social_vkotakte", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="social_facebook", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="social_odnoklasniki", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="social_twitter", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="social_instagram", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="social_youtube", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="about_me", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="is_seller", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="about_me_seller", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="inn_seller", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="kpp_seller", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="r_s_seller", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="is_decorator", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="min_price_decorator", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="max_price_decorator", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="about_me_decorator", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="region_id", required=false, in="query", type="string"),
     *     @SWG\Parameter(name="nickname", required=false, in="query", type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function update()
    {
        if (request()->has('email')) {
            auth()->user()->update(['email' => request()->get('email')]);
        }
        $profile = Profile::where('user_id', auth()->user()->id)->first();
        if (request()->hasFile('photo')) {
            $photo = request()->file('photo');
            $image = time() . '.' . $photo->getClientOriginalExtension();
            $path = public_path('/uploads/photos');
            $photo->move($path, $image);
            $profile->update(['photo' => $image]);
        }
        $profile->update(request()->except(['email', 'photo']));
        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'user' => auth()->user()->load('profile'),
            'request'=>request()->all(),
        ], 200);
    }

    //    Route::post('mysorts', 'UserController@mysorts');
    /**
     * @SWG\Post(
     *     path="/user/mysorts",
     *     operationId="show user plants/sorts",
     *     description="show user plants/sorts",
     *     summary="show user plants/sorts",
     *     produces={"application/json"},
     *     tags={"User"},
     *     security={{"access_token":{}}},
     *     @SWG\Parameter(name="page", required=false, in="query", type="integer"),
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function mysorts(Request $request){
        $itemsPerPage=15;
        $this->middleware('auth:api');
        $user = auth()->user()->load('profile');
        $user_id = $user['id'];
        if (!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }

        $sort_user_bookmarks=User_sorts::select('id')
            ->where('user_id', $user_id)
            ->get();
        $pages = ceil(count($sort_user_bookmarks) / $itemsPerPage);
        $page = 1;
        $take = $itemsPerPage;
        if(request('page') > 1){
            $page=request('page');
        }
        $skip=($page-1)*$itemsPerPage;
        $sort_user_bookmarks = User_sorts::where('user_id', $user_id)
            ->leftJoin('sorts', 'sorts.id', '=', 'user_sorts.sort_id' )
            ->skip($skip)
            ->take($take)
            ->orderBy('user_sorts.id', 'desc')
            ->select('user_sorts.id','user_sorts.sort_id','user_sorts.sort_id','sorts.id AS sort_id','sorts.name','sorts.main_photo', 'sorts.section_id')
            ->get();
        foreach ($sort_user_bookmarks as $item){
            if(isset($item->main_photo)){
                $item->main_photo=$_ENV['PHOTO_FOLDER'].$item->main_photo;
            }
        }


        return response()->json([
            'success' => $sort_user_bookmarks ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'pages'=>$pages,
            'page'=>$page,
            'user_sort_bookmarks'=>$sort_user_bookmarks,
            'request'=>$request->all(),
        ], 200);
    }
    //      Route::post('alerts', 'UserController@alerts');
    /**
     * @SWG\Post(
     *     path="/user/alerts",
     *     operationId="show user alerts",
     *     description="show user alerts",
     *     summary="show user alerts",
     *     produces={"application/json"},
     *     tags={"User"},
     *     security={{"access_token":{}}},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function alerts(Request $request){
        $itemsPerPage=15;
        $this->middleware('auth:api');
        $user = auth()->user()->load('profile');
        $user_id = $user['id'];
        if (!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        $nullorder=Order::where('user_id', $user_id)
            ->whereNull('owner_id')
            ->first();
        $basket=0;
        if($nullorder){
            $basket=Order_Item::where('order_id',$nullorder->id)
                ->count();
        }

        $sort=User_sorts::where('user_id', $user_id)
            ->count();
        $bookmarks=Bookmarks::where('user_id', $user_id)
            ->count();
        $notifitations=Notification::where('is_read', '0')
            ->count();
        $questionaries=Sort_questionary::where('user_id', $user_id)
            ->count();
        return response()->json([
            'success' => $user_id ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'basket'=>$basket,
            'sorts'=>$sort,
            'bookmarks'=>$bookmarks,
            'notifitations'=>$notifitations,
            'questionaries'=>$questionaries,
        ], 200);
    }
    /**
     * @SWG\Post(
     *     path="/user/rating",
     *     operationId="show user rating",
     *     description="show user rating",
     *     summary="show user rating",
     *     produces={"application/json"},
     *     tags={"User"},
     *     security={{"access_token":{}}},
     *     @SWG\Response(
     *         response=200,
     *         description="Success",
     *     )
     * )
     */
    public function rating(Request $request){
        $this->middleware('auth:api');
        $user = auth()->user()->load('profile');
        $user_id = $user['id'];
        if (!isset($user_id)){
            return response()->json([
                'errors-message' => 'not authentificated',
                'user_id'=>$user_id,
                'request'=>$request->all(),
            ], 400);
        }
        //rating as customer
        $customer=(object)[];
        $customer->entrances=User_entrance::where('user_id', $user_id)->count();
        //without entrances
        $firstEntrance=User_entrance::where('user_id', $user_id)->first();
        $lastEntrance=User_entrance::where('user_id', $user_id)->orderBy('id', 'desc')->first();
        $customer->without_entrances=-round((strtotime($lastEntrance->date)-strtotime($firstEntrance->date))/(60*60*24))+1-$customer->entrances;
        //orders
        $customer->orders=Order::where('user_id', $user_id)
            ->where('status_id', 7)->count();
        //
        $orders=Order::where('user_id', $user_id)
            ->where('status_id', 7)
            ->get();
        $customer->summ=0;//TODO-коэфициент
        foreach($orders as $order){
            $items=Order_Item::where('order_id', $order->id)
            ->get();
            foreach ($items as $item){
                $customer->summ=$customer->summ+$item->quantity*$item->price;
            };
        }
        //photos
        $pest_photos=Photos::where('user_id', $user_id)
            ->where('moderator', 'accepted')
            ->where('type', 'pest')
            ->count();
        $disease_photos=Photos::where('user_id', $user_id)
            ->where('moderator', 'accepted')
            ->where('type', 'disease')
            ->count();
        $customer->photos=3*($pest_photos+$disease_photos);
        //
        $customer->rejected_orders=-2*Order::where('user_id', $user_id)
            ->where('status_id', 8)->count();
        //comments to sort or chemic
        $customer->responses_sort=Response::where('user_id', $user_id)
            ->whereRaw('type="sort" or type="chemical"')
            ->where('moderator', 'accepted')
            ->count();
        $customer->responses_seller=Response::where('user_id', $user_id)
            ->whereRaw('type="seller" or type="decorator"')
            ->where('moderator', 'accepted')
            ->count();
        $customer->participant=Event_participant::where("participant_id", $user_id)
            ->count();
        $customer->article=2*Handbook::where('user_id', $user_id)
            ->count();
        $customer->video_link=2*Handbook_videolinks::where('user_id', $user_id)
                ->where('moderator', 'accepted')
                ->count();
        $customer->article_edit=0;//TODO-add functionality
        $customer->first_folder=0;
        $folder=Bookmarks_folder::where('user_id', $user_id)
            ->first();
        if($folder) $customer->first_folder=1;
        $customer->first_folder=0;
        $folder=Bookmarks_folder::where('user_id', $user_id)
            ->first();
        if(isset($folder)) $customer->first_folder=1;
        $customer->user_sort=0;
        $sort=User_sorts::where('user_id', $user_id)
            ->first();
        if(isset($sort)) $customer->user_sort=1;
        $customer->first_article=0;
        $article=Article::where('user_id', $user_id)
            ->where('moderator', 'accepted')
            ->first();
        if(isset($sort)) $customer->first_article=1;
        $customer->questionaries=3*Sort_questionary::where('user_id', $user_id)
            ->count();
        $customer->personal_info=0;
        $profile=Profile::where('user_id', $user_id)->first();
        if (isset($profile->first_name)) $customer->personal_info++;
        if (isset($profile->last_name)) $customer->personal_info++;
        if (isset($profile->phone)) $customer->personal_info++;
        if (isset($profile->birthday)) $customer->personal_info++;
        if (isset($profile->address)) $customer->personal_info++;
        if (isset($profile->photo)) $customer->personal_info++;
        if (isset($profile->site)) $customer->personal_info++;
        if (isset($profile->social_vkotakte)) $customer->personal_info++;
        if (isset($profile->social_facebook)) $customer->personal_info++;
        if (isset($profile->social_odnoklasniki)) $customer->personal_info++;
        if (isset($profile->social_twitter)) $customer->personal_info++;
        if (isset($profile->social_instagram)) $customer->personal_info++;
        if (isset($profile->social_youtybe)) $customer->personal_info++;
        if (isset($profile->about_me)) $customer->personal_info++;
        if (isset($profile->nickname)) $customer->personal_info++;
        $customer->question=Question::where('user_id', $user_id)
            ->where('moderator','accepted')
            ->count();
        $customer->registration=2;
        $customer->tariff=Tarif_history::where('user_id', $user_id)
            ->count();
        $customer->reserv=Order::where('user_id', $user_id)
            ->where('status_id', 4)
            ->count();
        $customer_rating=0;
        foreach ($customer as $key => $value) {
            $customer_rating+=$value;
        }
        //seller rating
        $seller=(object)[];
        $koef=1;//TODO
        $seller->assortment=$koef*Assortment::where('owner_id', $user_id)
            ->where('quantity', '>', '0')
            ->count();
        $seller->positive_feedback=Response::where('item_id', $user_id)
            ->where('type', 'seller')
            ->where('rating', '>', 3)
            ->count();
        $seller->negative_feedback=-Response::where('item_id', $user_id)
            ->where('type', 'seller')
            ->where('rating', '<', 3)
            ->count();
        $seller->sell_value=Assortment::where('owner_id', $user_id)
            ->sum('selled');
        $seller->reserv=Order::where('user_id', $user_id)
            ->whereRaw('status_id=4 or status_id=11')
            ->count();
        $seller->complaint=-0;//TODO жалобы где фиксировать и брать
        $seller->markets=Market::where('user_id', $user_id)
            ->count();
        $seller_rating=0;
        foreach ($seller as $key => $value) {
            $seller_rating+=$value;
        }
        return response()->json([
            'success' => $user_id ? true : false,
            'success-message' => [],
            'errors-message' => [],
            'customer'=>$customer,
            'customer_rating'=>$customer_rating,
            'seller'=>$seller,
            'seller_rating'=>$seller_rating,
        ], 200);
    }




}
