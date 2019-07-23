<?php

namespace App\Providers;

use App\Models\Assortment;
use App\Models\Chemical;
use App\Models\Culture;
use App\Models\Disease;
use App\Models\Handbook;
use App\Models\Notification;
use App\Models\Pest;
use App\Models\Profile;
use App\Models\Question;
use App\Models\Question_answer;
use App\Models\Response;
use App\Models\Responses_answer;
use App\Models\Search;
use App\Models\Sort;
use App\Models\Event as Events;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Assortment::created(function ($item) {
            $profile = Profile::where('user_id', $item->owner_id)
                ->first();
            $profile->min_price_seller = Assortment::where('owner_id', $item->owner_id)
                ->where('quantity', '>', '0')
                ->min('price');
            $profile->max_price_seller = Assortment::where('owner_id', $item->owner_id)
                ->where('quantity', '>', '0')
                ->max('price');
            $profile->save();
        });
        Assortment::deleted(function ($item) {
            $profile = Profile::where('user_id', $item->owner_id)
                ->first();
            $profile->min_price_seller = Assortment::where('owner_id', $item->owner_id)
                ->where('quantity', '>', '0')
                ->min('price');
            $profile->max_price_seller = Assortment::where('owner_id', $item->owner_id)
                ->where('quantity', '>', '0')
                ->max('price');
            $profile->save();
        });
        Assortment::updated(function ($item) {
            $profile = Profile::where('user_id', $item->owner_id)
                ->first();
            $profile->min_price_seller = Assortment::where('owner_id', $item->owner_id)
                ->where('quantity', '>', '0')
                ->min('price');
            $profile->max_price_seller = Assortment::where('owner_id', $item->owner_id)
                ->where('quantity', '>', '0')
                ->max('price');
            $profile->save();
        });

        Culture::created(function ($item) {
            $text = '';
            $entity = Search::create([
                'title' => $item->name,
                'text' => $text,
                'section_id' => $item->section_id,
                'type' => 'culture',
                'target_id' => $item->id,
            ]);
        });
        Culture::deleted(function ($item) {
            $entity = Search::where('type', 'culture')
                ->where('target_id', $item->id)
                ->delete();
        });
        Culture::updated(function ($item) {
            $text = '';
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'culture'],
                ['title' => $item->name, 'text' => $text, 'section_id' => $item->section_id]
            );
        });
        Chemical::created(function ($item) {
            $text = '';
            if (isset($item->manufacturer)) $text = $text . ' ' . $item->manufacturer;
            if (isset($item->composition)) $text = $text . ' ' . $item->composition;
            if (isset($item->description)) $text = $text . ' ' . $item->description;
            if (isset($item->characteristics)) $text = $text . ' ' . $item->characteristics;

            $entity = Search::create([
                'title' => $item->name,
                'text' => $text,
                'section_id' => 0,
                'type' => 'chemical',
                'target_id' => $item->id,
            ]);
        });
        Chemical::deleted(function ($item) {
            $entity = Search::where('type', 'chemical')
                ->where('target_id', $item->id)
                ->delete();
        });
        Chemical::updated(function ($item) {
            $text = '';
            if (isset($item->manufacturer)) $text = $text . ' ' . $item->manufacturer;
            if (isset($item->composition)) $text = $text . ' ' . $item->composition;
            if (isset($item->description)) $text = $text . ' ' . $item->description;
            if (isset($item->characteristics)) $text = $text . ' ' . $item->characteristics;
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'chemical'],
                ['title' => $item->name, 'text' => $text, 'section_id' => '0']
            );
        });



        Disease::created(function ($item) {
            $text = '';
            if (isset($item->description)) $text = $text . ' ' . $item->description;
            if (isset($item->fight)) $text = $text . ' ' . $item->fight;
            $entity = Search::create([
                'title' => $item->name,
                'text' => $text,
                'section_id' => $item->section_id,
                'type' => 'disease',
                'target_id' => $item->id,
            ]);
        });
        Disease::deleted(function ($item) {
            $entity = Search::where('type', 'disease')
                ->where('target_id', $item->id)
                ->delete();
        });
        Disease::updated(function ($item) {
            $text = '';
            if (isset($item->description)) $text = $text . ' ' . $item->description;
            if (isset($item->fight)) $text = $text . ' ' . $item->fight;
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'disease'],
                ['title' => $item->name, 'text' => $text, 'section_id' => $item->section_id,]
            );
        });

        Events::created(function ($item) {
            $entity = Search::create([
                'title' => $item->title,
                'text' => $item->description,
                'section_id' => 0,
                'type' => 'event',
                'target_id' => $item->id,
            ]);
        });
        Events::deleted(function ($item) {
            $entity = Search::where('type', 'event')
                ->where('target_id', $item->id)
                ->delete();
        });
        Events::updated(function ($item) {
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'event'],
                ['title' => $item->title, 'text' => $item->description, 'section_id' => '0']
            );
        });

        Handbook::created(function ($item) {
            $text = '';
            if (isset($item->description)) $text = $text . ' ' . $item->description;
            if (isset($item->full_description)) $text = $text . ' ' . $item->full_description;
            $entity = Search::create([
                'title' => $item->title,
                'text' => $text,
                'section_id' => $item->section_id,
                'type' => 'handbook',
                'target_id' => $item->id,
            ]);
        });
        Handbook::deleted(function ($item) {
            $entity = Search::where('type', 'handbook')
                ->where('target_id', $item->id)
                ->delete();
        });
        Handbook::updated(function ($item) {
            $text = '';
            if (isset($item->description)) $text = $text . ' ' . $item->description;
            if (isset($item->full_description)) $text = $text . ' ' . $item->full_description;
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'handbook'],
                ['title' => $item->title, 'text' => $text, 'section_id' => $item->section_id,]
            );
        });

        Question::created(function ($item) {
            if($item->moderator=='accepted')
            $entity = Search::create([
                'title' => $item->title,
                'text' => $item->text,
                'section_id' => $item->section_id,
                'type' => 'question',
                'target_id' => $item->id,
            ]);
        });
        Question::updated(function ($item) {
            if($item->moderator=='accepted')
                $entity = Search::create([
                    'title' => $item->title,
                    'text' => $item->text,
                    'section_id' => $item->section_id,
                    'type' => 'question',
                    'target_id' => $item->id,
                ]);
        });
        Question::deleted(function ($item) {
            $entity = Search::where('type', 'question')
                ->where('target_id', $item->id)
                ->delete();
        });

        Question_answer::created(function ($item) {
            if($item->moderator=='accepted'){
                $comments_count=Question_answer::where('question_id',$item->question_id )
                    ->where('moderator', 'accepted')
                    ->count();
                $sql='UPDATE questions SET comments_count='.$comments_count.' WHERE id='.$item->question_id;
                DB::update($sql);
            }
        });
        Question_answer::updated(function ($item) {
            if($item->moderator=='accepted'){
                $comments_count=Question_answer::where('question_id',$item->question_id )
                    ->where('moderator', 'accepted')
                    ->count();
                $sql='UPDATE questions SET comments_count='.$comments_count.' WHERE id='.$item->question_id;
                DB::update($sql);
            }
        });
        Question_answer::deleted(function ($item) {
            $comments_count=Question_answer::where('question_id',$item->question_id )
                ->where('moderator', 'accepted')
                ->count();
            $sql='UPDATE questions SET comments_count='.$comments_count.' WHERE id='.$item->question_id;
                DB::update($sql);
        });

        Pest::created(function ($item) {
            $text = '';
            if (isset($item->description)) $text = $text . ' ' . $item->description;
            if (isset($item->fight)) $text = $text . ' ' . $item->fight;
            $entity = Search::create([
                'title' => $item->name,
                'text' => $text,
                'section_id' => $item->section_id,
                'type' => 'pest',
                'target_id' => $item->id,
            ]);
        });
        Pest::deleted(function ($item) {
            $entity = Search::where('type', 'pest')
                ->where('target_id', $item->id)
                ->delete();
        });
        Pest::updated(function ($item) {
            $text = '';
            if (isset($item->description)) $text = $text . ' ' . $item->description;
            if (isset($item->fight)) $text = $text . ' ' . $item->fight;
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'pest'],
                ['title' => $item->name, 'text' => $text, 'section_id' => $item->section_id,]
            );
        });

        Profile::created(function ($item) {
            if ($item->is_seller == 1) {
                $entity = Search::create([
                    'title' => $item->first_name . ' ' . $item->last_name,
                    'text' => $item->about_me_seller,
                    'section_id' => 0,
                    'type' => 'seller',
                    'target_id' => $item->user_id,
                ]);
            }
            if ($item->is_decorator == 1) {
                $entity = Search::create([
                    'title' => $item->first_name . ' ' . $item->last_name,
                    'text' => $item->about_me_decorator,
                    'section_id' => 0,
                    'type' => 'decorator',
                    'target_id' => $item->user_id,
                ]);
            }
        });
        Profile::deleted(function ($item) {
            $entity = Search::where('type', 'seller')
                ->where('target_id', $item->user_id)
                ->delete();
            $entity = Search::where('type', 'decorator')
                ->where('target_id', $item->user_id)
                ->delete();
        });
        Profile::updated(function ($item) {
            if ($item->is_seller == 1) {
                $entity = Search::updateOrCreate(
                    ['target_id' => $item->user_id, 'type' => 'seller'],
                    ['title' => $item->first_name . ' ' . $item->last_name, 'text' => $item->about_me_seller, 'section_id' => '0']
                );
            } else {
                $entity = Search::where('type', 'seller')
                    ->where('target_id', $item->user_id)
                    ->delete();
            }
            if ($item->is_decorator == 1) {
                $entity = Search::updateOrCreate(
                    ['target_id' => $item->user_id, 'type' => 'decorator'],
                    ['title' => $item->first_name . ' ' . $item->last_name, 'text' => $item->about_me_decorator, 'section_id' => '0']
                );
            } else {
                $entity = Search::where('type', 'decorator')
                    ->where('target_id', $item->user_id)
                    ->delete();
            }
        });

        Response::created(function($item){
            $this->responseModerator($item);
        });
        Response::updated(function($item){
            $this->responseModerator($item);
        });
        Response::deleted(function($item){
            $this->responseModerator($item);
        });

        Responses_answer::created(function($item){
            $this->responseAnswerModerator($item);
        });
        Responses_answer::updated(function($item){
            $this->responseAnswerModerator($item);
        });

        Sort::created(function ($item) {
            $entity = Search::create([
                'title' => $item->name,
                'text' => $item->content,
                'section_id' => $item->section_id,
                'type' => 'sort',
                'target_id' => $item->id,
            ]);
        });
        Sort::deleted(function ($item) {
            $entity = Search::where('type', 'sort')
                ->where('target_id', $item->id)
                ->delete();
        });
        Sort::updated(function ($item) {
            $entity = Search::updateOrCreate(
                ['target_id' => $item->id, 'type' => 'sort'],
                ['title' => $item->name, 'text' => $item->content, 'section_id' => $item->section_id]
            );
        });




    }

    //function for  moderating
    function responseModerator($entity){
        if ($entity->moderator=='accepted'){
            if($entity->type=='sort'){
                $item=Sort::find($entity->item_id);
                if(isset($item)){
                    $item->rating=Response::where('item_id', $entity->item_id)
                        ->where('type', 'sort')
                        ->where('moderator', 'accepted')
                        ->avg('rating');
                    if(is_null($item->rating)) $item->rating=0;
                    $item->save();
                }
            }elseif($entity->type=='chemical'){


                $item=Chemical::find($entity->item_id);

                if(isset($item)){
                    $item->rating=Response::where('item_id', $entity->item_id)
                        ->where('type', 'chemical')
                        ->where('moderator', 'accepted')
                        ->avg('rating');
                    if(is_null($item->rating)) $item->rating=0;
                    $item->responses=Response::where('item_id', $entity->item_id)
                        ->where('type', 'chemical')
                        ->where('moderator', 'accepted')
                        ->count();
                    if(is_null($item->responses)) $item->responses=0;

                    $item->save();
                }
            }elseif($entity->type=='decorator'){
                $item=Profile::where('user_id', $entity->item_id)
                    ->first();
                if(isset($item)){
                    $item->rating_decorator=Response::where('item_id', $entity->item_id)
                        ->where('type', 'decorator')
                        ->where('moderator', 'accepted')
                        ->avg('rating');
                    if(is_null($item->rating_decorator)) $item->rating_decorator=0;
                    $item->save();
                }
            }elseif($entity->type=='seller'){
                $item=Profile::where('user_id', $entity->item_id)
                    ->first();
                if(isset($item)){
                    $item->rating_seller=Response::where('item_id', $entity->item_id)
                        ->where('type', 'seller')
                        ->where('moderator', 'accepted')
                        ->avg('rating');
                    if(is_null($item->rating_seller)) $item->rating_seller=0;
                    $item->save();
                }
            }
        }
    }
//responseAnswerModerator
    function responseAnswerModerator($entity){
        if ($entity->moderator=='accepted'){
            $response=Response::where('id',$entity->response_id)->first();
            $response_type=$response->type;
            $profile=Profile::where('user_id', $entity->user_id)->first();
            $name="";
            if (isset($profile->first_name)) $name=$name.$profile->first_name;
            if (isset($profile->last_name)) $name=$name.$profile->last_name;
            $text = $entity->user_id==0 ? 'Администратор прокоментировал Ваш отзыв' : 'Пользователь '.$name.' прокоментировал Ваш отзыв';
            $notification=Notification::Create([
                'from'=>$entity->user_id,
                'to'=>$response->user_id,
                'type'=>'response',
                'topic'=>$text,
                'text'=>$entity->response,
                'item_type'=>$response->type,
                'item_id'=>$response->item_id
            ]);
        }
    }
}
