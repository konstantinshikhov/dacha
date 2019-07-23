<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Category_relation;
use App\Models\Chemical;
use App\Models\Chemical_photos;
use App\Models\Culture;
use App\Models\Delivery_method;
use App\Models\Disease;
use App\Models\Disease_chemical;
use App\Models\Ethnoscience;
use App\Models\Ethnoscience_month;
use App\Models\Event;
use App\Models\Event_participant;
use App\Models\Feedback;
use App\Models\Footer;
use App\Models\Filter_attr_entity;
use App\Models\Filter_attr_value;
use App\Models\Filter_attributes;
use App\Models\Handbook;
use App\Models\Handbook_videolinks;
use App\Models\Handbook_photo;
use App\Models\Main_page_info;
use App\Models\Moon_action;
use App\Models\Moon_date;
use App\Models\Moon_phase;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\Order_status;
use App\Models\Order_status_rel;
use App\Models\Pest;
use App\Models\Pest_chemical;
use App\Models\Pest_disease_relations;
use App\Models\Photos;
use App\Models\Profile;
use App\Models\Response;
use App\Models\Responses_answer;
use App\Models\Section;
use App\Models\Sort;
use App\Models\Sort_calendar;
use App\Models\Sort_operation;
use App\Models\Sort_characteristic;
use App\Models\Sort_charact_relation;
use App\Models\Sort_questionary;
use App\Models\Sort_ques_general_info;
use App\Models\Tariff;
use App\Models\User;
use App\Models\Question;
use App\Models\Question_answer;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor_code;

class AdminLTEController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminAuth', ['except' => ['login', 'getCalendarData']]);
    }

    public function show()
    {
        return view('admin.main', [
            'activeMenu' => 'tables'
        ]);
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Admin authentication                                                    │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if($token = auth()->attempt($credentials)) {
            $user = auth()->user();
            if($user->role == 'a') {
                $request->session()->put('aToken', $token);
                $user->remember_token = hash('sha256', $token);
                $user->save();
            }
        } else {
            redirect()->action('HomeController@index');
        }

        return redirect()->action('AdminLTEController@showSortsKlumba');
    }

    public function logout(Request $request)
    {

        $aToken = $request->session()->get('aToken');
        $user = User::where('remember_token', hash('sha256', $aToken))->first();

        if($user && $user->role == 'a') {
            $request->session()->forget('aToken');
            $user->remember_token = null;
            $user->save();
        }

        return redirect()->action('HomeController@index');
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Feedback processing                                                     │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function showFeedback()
    {
        return view('admin.forms.feedback', [
            'activeMenu' => 'tables',
            'modelName' => 'Письма',
            'rows' => Feedback::all(),
            'typesDictionary' => [
                'cooperation' => 'Сотрудничество',
                'tariff' => 'Заявка на тариф'
            ]
        ]);
    }

    public function updateFeedback(Request $request)
    {
        foreach (Feedback::all() as $feedback) {
            if($request->input("feedback_{$feedback->id}_for_delete")) {
                $feedback->delete();
                continue;
            }
            $feedback->is_read = $request->input("feedback_{$feedback->id}_is_read") ?? 0;
            $feedback->save();
        }
        $request->session()->flash('success', 'Письма обновлены');
        return redirect()->action("AdminLTEController@showFeedback");
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Notifications processing                                                │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function createNotifications(Request $request)
    {
        if($request->input('createNotificationForEmail')) {
            foreach (User::all() as $user) {
                if($user->role != 'b' && $request->input("notification_for_user_{$user->id}")) {
                    $text = $request->input('creationText') ?? '';
                    $topic = $request->input('creationTopic') ?? 'Рассылка';
                    $email = $user->email;

                    \Mail::raw($text, function(\Illuminate\Mail\Message $mail) use ($topic, $email) {
                        $mail->subject("Умная дача: $topic");
                        $mail->from($_ENV['MAIL_USERNAME'], 'Администрация');
                        $mail->to($email);
                    });
                }
            }
        }
        if($request->input('createNotificationForSite')) {
            foreach (User::all() as $user) {
                if($user->role != 'b' && $request->input("notification_for_user_{$user->id}")) {
                    Notification::create([
                        'from' => 0,
                        'to' => $user->id,
                        'type' => 'support',
                        'text' => $request->input('creationText') ?? '',
                        'topic' =>  $request->input('creationTopic') ?? '',
                        'item_type' => null,
                        'item_id' => null,
                        'is_read' => 0
                    ]);
                }
            }
        }

        $request->session()->flash('success', 'Уведомление добавлено');
        return redirect()->action("AdminLTEController@showNotifications");
    }

    public function showNotifications()
    {
        $item_type_class = [
            'sort' => Sort::class,
            'chemical' => Chemical::class,
            'decorator' => User::class
        ];
        $item_type_dictionary = [
            'sort' => 'Сорт',
            'chemical' => 'Химикат',
            'decorator' => 'Декоратор'
        ];
        $notification_type_dictionary = [
            'order' => 'Заказ',
            'notification' => 'Уведомление',
            'support' => 'Уведомление от администрации',
            'response' => 'Ответ'
        ];
        $rows = [];
        foreach (Notification::all() as $notification) {
            $rows[$notification->id] = [
                'id' => $notification->id,
                'from' => User::find($notification->from),
                'to' => User::find($notification->to),
                'type' => $notification->type,
                'text' => $notification->text,
                'topic' => $notification->topic,
                'item_type' => $notification->item_type,
                'item_id' => $notification->item_type ? $item_type_class[$notification->item_type]::find($notification->item_id) : null
            ];
        }

        $users = [];
        foreach (User::all() as $user) {
            $profile = Profile::where('user_id', $user->id)->first();
            $users[$user->id] = [
                'id' => $user->id,
                'email' => $user->email,
                'first_name' => $profile ? $profile->first_name : '',
                'last_name' => $profile ? $profile->last_name : ''
            ];
        }

        return view('admin.forms.notifications', [
            'activeMenu' => 'tables',
            'modelName' => 'Уведомления',
            'rows' => $rows,
            'item_type_dictionary' => $item_type_dictionary,
            'notification_type_dictionary' => $notification_type_dictionary,
            'users' => $users
        ]);
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Users processing                                                        │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function showUsers(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $request->session()->forget('user_id');
        Profile::where('tariff_id','>', 1)
            ->where('tariff_end','<', date('Y-m-d'))
            ->update(['tariff_id'=>1,
                'tariff_end'=>'3000-01-01']);

        $attributesDictionaryDecorator = [];
        foreach (Filter_attributes::where('type', 'decorator')->get() as $attribute) {
            $attributesDictionaryDecorator[$attribute->id] = $attribute->name;
        }

        $attributeValuesDictionaryDecorator = [];
        foreach ($attributesDictionaryDecorator as $attributeId => $attribute) {
            foreach (Filter_attr_value::where('attribute_id', $attributeId)->get() as $value) {
                $attributeValuesDictionaryDecorator[$attributeId][$value->id] = $value->attribute_value;
            }
        }

        $attributesDictionarySeller = [];
        foreach (Filter_attributes::where('type', 'seller')->get() as $attribute) {
            $attributesDictionarySeller[$attribute->id] = $attribute->name;
        }

        $attributeValuesDictionarySeller = [];
        foreach ($attributesDictionarySeller as $attributeId => $attribute) {
            foreach (Filter_attr_value::where('attribute_id', $attributeId)->get() as $value) {
                $attributeValuesDictionarySeller[$attributeId][$value->id] = $value->attribute_value;
            }
        }

        $rows = [];
        foreach (User::all() as $user) {
            $profile = Profile::where('user_id', $user->id)->first();
            if($profile) {

                $attributes = [];
                foreach ($attributesDictionaryDecorator as $id => $attribute) {
                    foreach (Filter_attr_entity::where('attribute_id', $id)
                                               ->where('entity_type', 'decorator')
                                               ->where('entity_id', $user->id)->get() as $value) {
                        $attributes[$id][$value->attribute_value] = $value;
                    }
                }
                foreach ($attributesDictionarySeller as $id => $attribute) {
                    foreach (Filter_attr_entity::where('attribute_id', $id)
                                               ->where('entity_type', 'seller')
                                               ->where('entity_id', $user->id)->get() as $value) {
                        $attributes[$id][$value->attribute_value] = $value;
                    }
                }

                $sort_questionaries = [];
                foreach (Sort_questionary::where('user_id', $user->id)->get() as $sort_questionary) {
                    $sort_questionaries[$sort_questionary->id] = $sort_questionary;
                    $sort_questionaries[$sort_questionary->id]['sort'] = Sort::find($sort_questionary->sort_id);
                    $sort_questionaries[$sort_questionary->id]['sort']['culture'] = Culture::find(
                        Sort::find($sort_questionary->sort_id)->culture_id
                    );
                }

                $rows[$user->id] = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role,
                    'photo' => $profile->photo,
                    'first_name' => $profile->first_name,
                    'last_name' => $profile->last_name,
                    'nickname' => $profile->nickname,
                    'phone' => $profile->phone,
                    'site' => $profile->site,
                    'about_me' => $profile->about_me,
                    'is_partymaker' => $profile->is_partymaker,
                    'partymaker_end' => $profile->partymaker_end,
                    'is_seller' => $profile->is_seller,
                    'rating_seller' => $profile->rating_seller,
                    'about_me_seller' => $profile->about_me_seller,
                    'is_decorator' => $profile->is_decorator,
                    'rating_decorator' => $profile->rating_decorator,
                    'about_me_decorator' => $profile->about_me_decorator,
                    'decorator_end' => $profile->decorator_end,
                    'tariff' => Tariff::where('id', $profile->tariff_id)->first(),
                    'tariff_end' => $profile->tariff_end,
                    'sort_ques_general_infos' => Sort_ques_general_info::where('user_id', $user->id)->first(),
                    'sort_questionaries' => $sort_questionaries,
                    'photos_count' => Photos::where('user_id', $user->id)->count(),
                    'handbooks_count' => Handbook::where('user_id', $user->id)->count(),
                    'orders_count_buyer' => Order_status_rel::where('order_status_id', 7)->whereIn(
                        'order_id', Order::where('user_id', $user->id)->get()->pluck('id')->toArray()
                    )->count(),
                    'orders_count_seller' => Order_status_rel::where('order_status_id', 7)->whereIn(
                        'order_id', Order::where('owner_id', $user->id)->get()->pluck('id')->toArray()
                    )->count(),
                    'order_sorts_count_seller' => count(array_unique(Order_Item::where('type', 'sort')->whereIn(
                        'order_id', Order::where('owner_id', $user->id)->get()->pluck('id')->toArray()
                    )->get()->pluck('item_id')->toArray())),
                    'events_count' => Event::where('user_id', $user->id)->count(),
                    'attributes' => $attributes
                ];
            }
        }

        return view('admin.forms.users', [
            'activeMenu' => 'tables',
            'modelName' => 'Пользователи',
            'rows' => $rows,
            'tariffs' => Tariff::all(),
            'user_id' => $user_id,
            'attributesDictionaryDecorator' => $attributesDictionaryDecorator,
            'attributeValuesDictionaryDecorator' => $attributeValuesDictionaryDecorator,
            'attributesDictionarySeller' => $attributesDictionarySeller,
            'attributeValuesDictionarySeller' => $attributeValuesDictionarySeller
        ]);
    }

    public function updateUsers(Request $request)
    {
        $user = User::where('id', $request->input("user_id"))->first();

        // update user profile data
        if($profile = Profile::where('user_id', $user->id)->first()) {
            $profile->first_name = $request->input("user_{$user->id}_profile_first_name");
            $profile->last_name = $request->input("user_{$user->id}_profile_last_name");
            $profile->nickname = $request->input("user_{$user->id}_profile_nickname");
            $profile->phone = $request->input("user_{$user->id}_profile_phone");
            $profile->site = $request->input("user_{$user->id}_profile_site");
            $profile->about_me = $request->input("user_{$user->id}_profile_about_me");
            $profile->is_partymaker = $request->input("user_{$user->id}_profile_is_partymaker") ? true : false;
            $profile->partymaker_end = $request->input("user_{$user->id}_profile_partymaker_end");
            $profile->is_seller = $request->input("user_{$user->id}_profile_is_seller") ? true : false;
            $profile->rating_seller = $request->input("user_{$user->id}_profile_rating_seller");
            $profile->about_me_seller = $request->input("user_{$user->id}_profile_about_me_seller");
            $profile->is_decorator = $request->input("user_{$user->id}_profile_is_decorator") ? true : false;
            $profile->rating_decorator = $request->input("user_{$user->id}_profile_rating_decorator");
            $profile->about_me_decorator = $request->input("user_{$user->id}_profile_about_me_decorator");
            $profile->decorator_end = $request->input("user_{$user->id}_profile_decorator_end");

            $profile->save();
        }

        // update decorator filters
        $oldValues = array_map(function($id) {
            return intval($id);
        }, Filter_attr_entity::where('entity_type', 'decorator')
                             ->where('entity_id', $user->id)
                             ->get()
                             ->pluck('attribute_value')
                             ->toArray());
        $newValues = [];
        foreach (Filter_attributes::where('type', 'decorator')->get() as $attribute) {
            foreach (Filter_attr_value::where('attribute_id', $attribute->id)->get() as $value) {
                if($request->input("user_{$user->id}_attribute_{$attribute->id}_value_{$value->id}")) {
                    array_push($newValues, $value->id);
                }
            }
        }

        foreach (array_diff($oldValues, $newValues) as $valueIdForDelete) {
            Filter_attr_entity::where('entity_type', 'decorator')
                              ->where('entity_id', $user->id)
                              ->where('attribute_value', $valueIdForDelete)
                              ->first()
                              ->delete();
        }
        foreach (array_diff($newValues, $oldValues) as $valueIdForAdding) {
            Filter_attr_entity::create([
                'entity_id' => $user->id,
                'entity_type' => 'decorator',
                'attribute_id' => Filter_attr_value::where('id', $valueIdForAdding)->first()->attribute_id,
                'attribute_value' => $valueIdForAdding,
            ]);
        }

        // update seller filters
        $oldValues = array_map(function($id) {
            return intval($id);
        }, Filter_attr_entity::where('entity_type', 'seller')
                             ->where('entity_id', $user->id)
                             ->get()
                             ->pluck('attribute_value')
                             ->toArray());
        $newValues = [];
        foreach (Filter_attributes::where('type', 'seller')->get() as $attribute) {
            foreach (Filter_attr_value::where('attribute_id', $attribute->id)->get() as $value) {
                if($request->input("user_{$user->id}_attribute_{$attribute->id}_value_{$value->id}")) {
                    array_push($newValues, $value->id);
                }
            }
        }

        foreach (array_diff($oldValues, $newValues) as $valueIdForDelete) {
            Filter_attr_entity::where('entity_type', 'seller')
                              ->where('entity_id', $user->id)
                              ->where('attribute_value', $valueIdForDelete)
                              ->first()
                              ->delete();
        }
        foreach (array_diff($newValues, $oldValues) as $valueIdForAdding) {
            Filter_attr_entity::create([
                'entity_id' => $user->id,
                'entity_type' => 'seller',
                'attribute_id' => Filter_attr_value::where('id', $valueIdForAdding)->first()->attribute_id,
                'attribute_value' => $valueIdForAdding,
            ]);
        }


        $request->session()->put('user_id', $user->id);

        $user->role = $request->input("user_{$user->id}_role");
        if($user->role == 'b') {
            $text = 'Для восстановления аккаунта можете написать нам через форму обратной связи на главной странице';
            $email = $user->email;
            \Mail::raw($text, function(\Illuminate\Mail\Message $mail) use ($email) {
                $mail->subject('Умная дача: Ваш аккаунт был заблокирован');
                $mail->from($_ENV['MAIL_USERNAME'], 'Администрация');
                $mail->to($email);
            });
            $profile=Profile::where('user_id', $user->id)->first();
            $profile->is_seller=0;
            $profile->is_decorator=0;
            $profile->save();
        }

        $new_tariff_id = $request->input("user_{$user->id}_tariff_id");
        if($new_tariff_id != $profile->tariff_id) {
            //create history record
            $history=new Tarif_history;
            $history->user_id=$user->id;
            $history->tariff_id=$new_tariff_id;
            $history->save();

            $text = $new_tariff_id > $profile->tariff_id ? 'Вы перешли на улучшенный тариф. Спасибо за оказанное доверие. Умная дача постарается не подвести вас.' : 'Вы понизили тариф. Приносим извинения, если в чем-то Вас разочаровали. Будем исправляться. Можете написать нам через форму обратной связи на главной странице.';

            $email = $user->email;
            $profile->tariff_id = $request->input("user_{$user->id}_tariff_id");

            \Mail::raw($text, function(\Illuminate\Mail\Message $mail) use ($email) {
                $mail->subject('Умная дача: Новый тариф подтвержден');
                $mail->from($_ENV['MAIL_USERNAME'], 'Администрация');
                $mail->to($email);
            });
        }

        $new_tariff_end = $request->input("user_{$user->id}_tariff_end");
        if($new_tariff_end != $profile->tariff_end) {
            $profile->tariff_end = $new_tariff_end ?? new \DateTime("+1 months");
        }

        $user->save();
        $profile->save();

        // update general questionaries info
        if($info = Sort_ques_general_info::where('user_id', $user->id)->first()) {
            $info->region = $request->input("user_{$user->id}_sort_ques_general_info_region") ?? '';
            $info->locality = $request->input("user_{$user->id}_sort_ques_general_info_locality") ?? '';
            $info->soil = $request->input("user_{$user->id}_sort_ques_general_info_soil") ?? '';
            $info->high = $request->input("user_{$user->id}_sort_ques_general_info_high") ?? 0;
            $info->precipitation = $request->input("user_{$user->id}_sort_ques_general_info_precipitation") ?? 0;

            $info->save();
        } else {
            Sort_ques_general_info::create([
                'user_id' => $user->id,
                'region' => $request->input("user_{$user->id}_sort_ques_general_info_region") ?? '',
                'locality' => $request->input("user_{$user->id}_sort_ques_general_info_locality") ?? '',
                'soil' => $request->input("user_{$user->id}_sort_ques_general_info_soil") ?? '',
                'high' => $request->input("user_{$user->id}_sort_ques_general_info_high") ?? 0,
                'precipitation' => $request->input("user_{$user->id}_sort_ques_general_info_precipitation") ?? 0
            ]);
        }

        $request->session()->flash('success', 'Параметры пользователя обновлены');
        return redirect()->action("AdminLTEController@showUsers");
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Questionaries processing                                                │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function showQuestionaries()
    {
        $rows = [];
        foreach (Sort_questionary::all() as $questionary) {
            $sort = Sort::find($questionary->sort_id);
            $user = User::find($questionary->user_id);
            $profile = Profile::where('user_id', $questionary->user_id)->first();

            $rows[$questionary->id] = $questionary;
            $rows[$questionary->id]["sort"] = $sort;
            $rows[$questionary->id]["culture"] = Culture::find($sort->culture_id);
            $rows[$questionary->id]["user"] = array_merge(
                $user ? $user->toArray() : [],
                $profile ? $profile->toArray() : []
            );
        }

        return view('admin.forms.questionaries', [
            'activeMenu' => 'tables',
            'modelName' => 'Анкеты',
            'rows' => $rows
        ]);
    }

    public function updateQuestionaries(Request $request)
    {
        foreach (Sort_questionary::all() as $q) {
            if($request->input("questionary_{$q->id}_for_delete")) {
                $q->delete();
                continue;
            }

            $q->generation = $request->input("questionary_{$q->id}_generation") ?? 1;
            $q->landing_area = $request->input("questionary_{$q->id}_landing_area") ?? 0;
            $q->landing_type = $request->input("questionary_{$q->id}_landing_type") ?? '';
            $q->seeding_date = $request->input("questionary_{$q->id}_seeding_date") ?? new \DateTime();
            $q->cultivation_type = $request->input("questionary_{$q->id}_cultivation_type") ?? '';
            $q->ground_transplantation_date = $request->input("questionary_{$q->id}_ground_transplantation_date") ?? new \DateTime();
            $q->trimming_date = $request->input("questionary_{$q->id}_trimming_date") ?? new \DateTime();
            $q->is_ill = $request->input("questionary_{$q->id}_is_ill") ? true : false;
            $q->artificial_irrigation = $request->input("questionary_{$q->id}_artificial_irrigation") ? true : false;
            $q->drip_irrigation = $request->input("questionary_{$q->id}_drip_irrigation") ? true : false;
            $q->precipitation_from_planting = $request->input("questionary_{$q->id}_precipitation_from_planting") ?? 0;
            $q->feeding_from_planting = $request->input("questionary_{$q->id}_feeding_from_planting") ?? 0;
            $q->artificial_irrigation_from_planting = $request->input("questionary_{$q->id}_artificial_irrigation_from_planting") ?? 0;
            $q->harvest = $request->input("questionary_{$q->id}_harvest") ?? 0;

            $q->save();
        }

        $request->session()->flash('success', 'Анкеты обновлены');
        return redirect()->action("AdminLTEController@showQuestionaries");
    }
    public function updateQuestionary(Request $request){
       
        return "works";
    }
    public function getQuestionaryFile(Request $request)
    {
        if($questionary = Sort_questionary::find($request["id"])) {
            $sort = Sort::find($questionary->sort_id);
            $culture = Culture::find($sort->culture_id);
            $section = Section::find($sort->section_id);
            $user = User::find($questionary->user_id);
            $profile = Profile::where('user_id', $questionary->user_id)->first();
            $date = $questionary["created_at"] ?? $questionary["updated_at"];
            $phone = ($profile["phone"] ? ", {$profile["phone"]}" : "");

            $content = "Анкета №{$questionary["id"]}" . ($date ? ", {$date}" : "") . "\r\n" .
                       "Пользователь: {$profile["first_name"]} {$profile["last_name"]} ({$user["email"]}{$phone})\r\n" .
                       "Секция: {$section["name"]}\r\n" .
                       "Культура: {$culture["name"]}\r\n" .
                       "Сорт: {$sort["name"]}\r\n" .
                       "Семейное поколение растений от покупки посадочного материала: {$questionary["generation"]}\r\n" .
                       "Посадочная площадь: {$questionary["landing_area"]} ({$questionary["landing_type"]})\r\n" .
                       "Дата посадки: {$questionary["seeding_date"]}\r\n" .
                       "Место посадки: {$questionary["cultivation_type"]}\r\n" .
                       "Дата пересадки на грунт: {$questionary["ground_transplantation_date"]}\r\n" .
                       "Дата проведения обрезки: {$questionary["trimming_date"]}\r\n" .
                       "Болеет ли растение: " . ($questionary["is_ill"] ? "Да" : "Нет") . "\r\n" .
                       "Наличие искуственного полива: " . ($questionary["artificial_irrigation"] ? "Да" : "Нет") . "\r\n" .
                       "Наличие капельного палива: " . ($questionary["drip_irrigation"] ? "Да" : "Нет") . "\r\n" .
                       "Количество осадков с момента посадки: {$questionary["precipitation_from_planting"]}\r\n" .
                       "Количество подкормок с момента посадки: {$questionary["feeding_from_planting"]}\r\n" .
                       "Количество искуственного полива с момента посадки: {$questionary["artificial_irrigation_from_planting"]}\r\n" .
                       "Полученный сумарный урожай: {$questionary["harvest"]}";

            return response($content)
                   ->header('Content-type', 'text/txt')
                   ->header('Content-Disposition', "attachment; filename=\"анкета_{$questionary->id}.txt\"");
        } else {
            return abort(404);
        }
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Tariffs processing                                                      │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function showTariffs()
    {
        return view('admin.forms.tariffs', [
            'activeMenu' => 'tables',
            'modelName' => 'Тарифы',
            'rows' => Tariff::all(),
            'primaryKey' => 'id',
            'attributes' => ['id', 'tariff_name', 'max_sorts', 'max_chemicals', 'created_at', 'updated_at']
        ]);
    }

    public function updateTariffs(Request $request)
    {
        $tariffs = Tariff::all();
        $attributes = array_keys($tariffs->first()->getAttributes());
        foreach ($tariffs as $tariff) {
            foreach ($attributes as $attribute) {
                $tariff->$attribute = $request->input($attribute.'_'.$tariff->id);
            }

            $tariff->save();
        }
        $request->session()->flash('success', 'Тарифы обновлены');
        return redirect()->action("AdminLTEController@showTariffs");
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Chemicals processing                                                    │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function createChemical(Request $request)
    {
        $chemical = Chemical::create([
            'name' => $request->input('creationName') ?? '',
            'manufacturer' => $request->input('creationManufacturer') ?? '',
            'manufacturer_site' => $request->input('creationManufacturerSite') ?? '',
            'logo_path' => '', // $request->input('creationLogoPath') ?? '',
            'vendor_code' => '', //$request->input('creationVendorCode') ?? '',
            'main_photo' => '',
            'composition' => $request->input('creationComposition') ?? '',
            'average_price' => 0.0,
            'currency' => '',
            'description' => $request->input('creationDescription') ?? '',
            'characteristics' => $request->input('creationCharacteristics') ?? '',
            'merchantability' => 0,
            'topselled' => 0,
            'rating' => 0.0,
            'responses' => 0
        ]);

        if($request->file("creationPhotos")) {
            foreach ($request->file("creationPhotos") as $key => $photo) {
                $extension = $photo->getClientOriginalExtension();

                $filename = uniqid('chemical_'.$chemical->id.'_photo_').".$extension";
                $photo->storeAs("public", "chemical/$filename");

                $photo_obj = Photos::create([
                    'item_id' => $chemical->id,
                    'type' => 'chemical',
                    'is_main' => $key ? 0 : 1,
                    'moderator' => 'accepted',
                    'path' => "chemical/$filename"
                ]);

                $photo_obj->save();

                if($photo_obj->is_main) {
                    $chemical->main_photo = $photo_obj->path;
                }
            }
        }

        foreach (Filter_attributes::where('type', 'chemical')->get()->pluck('id')->toArray() as $attr_id) {
            foreach (Filter_attr_value::where('attribute_id', $attr_id)->get() as $filter_attr_value) {
                $filter_attr_checked = $request->input("filter_attr_value_$filter_attr_value->id");
                if($filter_attr_checked) {
                    if( ! Filter_attr_entity::where('entity_id', $chemical->id)
                                            ->where('attribute_id', $attr_id)
                                            ->where('attribute_value', $filter_attr_value->id)
                                            ->first()) {
                        $attr_entity = Filter_attr_entity::create([
                            'entity_id' => $chemical->id,
                            'entity_type' => 'chemical',
                            'attribute_id' => $attr_id,
                            'attribute_value' => $filter_attr_value->id
                        ]);
                    }
                } else {
                    if(Filter_attr_entity::where('entity_id', $chemical->id)
                                         ->where('attribute_id', $attr_id)
                                         ->where('attribute_value', $filter_attr_value->id)
                                         ->first()) {
                        Filter_attr_entity::where('entity_id', $chemical->id)
                                          ->where('entity_type', 'chemical')
                                          ->where('attribute_id', $attr_id)
                                          ->where('attribute_value', $filter_attr_value->id)
                                          ->first()
                                          ->delete();
                    }
                }
            }
        }

        foreach (Category::where('type', 'chemical')->get() as $category) {
            $categoryChecked = $request->input('creation_category_'.$category->id);
            if($categoryChecked) {
                Category_relation::create([
                    'type' => 'chemical',
                    'target_id' => $chemical->id,
                    'target_category' => $category->id
                ]);
            }
        }

        $chemical->save();

        $vendore_code = new Vendor_code();
        $vendore_code->chemicals_id = $chemical->id;
        $vendore_code->save();

        $request->session()->flash('success', 'Новый химикат добавлен');
        return redirect()->action("AdminLTEController@showChemicals");
    }

    public function showChemicals(Request $request)
    {
        $chemical_id = $request->session()->get('chemical_id');
        $request->session()->forget('chemical_id');

        $chemical_photos = [];
        foreach (Chemical::all() as $key => $chemical) {
            $chemical_photos[$chemical->id] = Photos::where('item_id', $chemical->id)
                                                    ->where('type', 'chemical')
                                                    ->where('moderator', 'accepted')
                                                    ->pluck('path')->toArray();
        }

        $filter_attr_values = [];
        foreach (Filter_attributes::where('type', 'chemical')->get() as $attribute) {
            $filter_attr_values[$attribute->name] = Filter_attr_value::where('attribute_id', $attribute->id)->get();
        }

        $filter_attr_entities = [];
        foreach (Filter_attr_entity::where('entity_type', 'chemical')->get() as $attr_entity_value) {
            if( ! array_key_exists($attr_entity_value->entity_id, $filter_attr_entities)) {
                $filter_attr_entities[$attr_entity_value->entity_id] = [];
            }
            array_push($filter_attr_entities[$attr_entity_value->entity_id], $attr_entity_value->attribute_value);
        }

        $categories = [];
        foreach (Category::where('type', 'chemical')->get() as $category) {
            $categories[$category->id] = $category->category;
        }

        $categoriesRelations = [];
        foreach (Chemical::all() as $chemical) {
            foreach (Category_relation::where('type', 'chemical')
                                      ->where('target_id', $chemical->id)->get() as $key => $relation) {
                $categoriesRelations[$chemical->id][$relation->target_category - 1] = $relation;
            }
        }

        return view('admin.forms.chemicals', [
            'activeMenu' => 'tables',
            'modelName' => 'Химикаты',
            'rows' => Chemical::all(),
            'chemicals_photos' => $chemical_photos,
            'filter_attributes' => Filter_attributes::where('type', 'chemical')->get(),
            'filter_attr_values' => $filter_attr_values,
            'filter_attr_entities' => $filter_attr_entities,
            'categories' => $categories,
            'categoriesRelations' => $categoriesRelations,
            'chemical_id' => $chemical_id
        ]);
    }

    public function updateChemicals(Request $request)
    {
        $id = $request->input('id');
        $chemical = Chemical::find($id);

        $request->session()->put('chemical_id', $id);

        if($chemical) {

            $chemical->name = $request->input("name_$id") ?? '';
            $chemical->manufacturer = $request->input("manufacturer_$id") ?? '';
            $chemical->manufacturer_site = $request->input("manufacturer_site_$id") ?? '';
            // $chemical->logo_path = $request->input("logo_path_$id") ?? '';
            // $chemical->vendor_code = $request->input("vendor_code_$id") ?? '';
            $chemical->composition = $request->input("composition_$id") ?? '';
            $chemical->description = $request->input("description_$id") ?? '';
            $chemical->characteristics = $request->input("characteristics_$id") ?? '';

            $chemical->save();

            if($request->input('is_main')) {
                $chemical_photo = Photos::where('item_id', $chemical->id)
                                        ->where('type', 'chemical')
                                        ->where('path', $chemical->main_photo)
                                        ->first();
                if($chemical_photo) {
                    $chemical_photo->is_main = 0;
                    $chemical_photo->save();
                }

                $chemical->main_photo = $request->input('is_main');
                $chemical->save();

                $chemical_photo = Photos::where('item_id', $chemical->id)
                                        ->where('type', 'chemical')
                                        ->where('path', $chemical->main_photo)
                                        ->first();
                $chemical_photo->is_main = 1;
                $chemical_photo->save();
            }

            foreach (Photos::where('item_id', $chemical->id)
                           ->where('type', 'chemical')
                           ->pluck('path') as $photoPath) {
                $exploded = explode('.', $photoPath);
                $constructedPath = $exploded[0].'_'.end($exploded);

                if($request->input("for_delete_$constructedPath") === '1') {
                    $chemical_photo = Photos::where('path', $photoPath)
                                            ->where('type', 'chemical')
                                            ->first();
                    Storage::delete("public/$chemical_photo->path");
                    $chemical_photo->delete();
                }
            }

            if($request->file("chemical_photos_$id")) {
                foreach ($request->file("chemical_photos_$id") as $chemical_photo) {
                    $extension = $chemical_photo->getClientOriginalExtension();

                    $filename = uniqid('chemical_'.$id.'_photo_').".$extension";
                    $chemical_photo->storeAs("public", "chemical/$filename");

                    $chemical_photo_obj = Photos::create([
                        'item_id' => $id,
                        'type' => 'chemical',
                        'is_main' => 0,
                        'moderator' => 'accepted',
                        'path' => "chemical/$filename"
                    ]);

                    $chemical_photo_obj->save();
                }
            }

            foreach (Filter_attributes::where('type', 'chemical')->get()->pluck('id')->toArray() as $attr_id) {
                foreach (Filter_attr_value::where('attribute_id', $attr_id)->get() as $filter_attr_value) {
                    $filter_attr_checked = $request->input("chemical_$chemical->id".
                                                           "_filter_attr_value_$filter_attr_value->id");
                    if($filter_attr_checked) {
                        if( ! Filter_attr_entity::where('entity_id', $chemical->id)
                                                ->where('attribute_id', $attr_id)
                                                ->where('attribute_value', $filter_attr_value->id)
                                                ->first()) {
                            $attr_entity = Filter_attr_entity::create([
                                'entity_id' => $chemical->id,
                                'entity_type' => 'chemical',
                                'attribute_id' => $attr_id,
                                'attribute_value' => $filter_attr_value->id
                            ]);
                        }
                    } else {
                        if(Filter_attr_entity::where('entity_id', $chemical->id)
                                             ->where('attribute_id', $attr_id)
                                             ->where('attribute_value', $filter_attr_value->id)
                                             ->first()) {
                            Filter_attr_entity::where('entity_id', $chemical->id)
                                              ->where('entity_type', 'chemical')
                                              ->where('attribute_id', $attr_id)
                                              ->where('attribute_value', $filter_attr_value->id)
                                              ->first()
                                              ->delete();
                        }
                    }
                }
            }

            foreach (Category::where('type', 'chemical')->get() as $key => $category) {
                $categoryChecked = $request->input('chemical_'.$id.'_category_'.$category->id);
                $categoryRelation = Category_relation::where('type', 'chemical')
                                                     ->where('target_id', $id)
                                                     ->where('target_category', $category->id)
                                                     ->first();

                if($categoryChecked) {
                    if( ! $categoryRelation) {
                        Category_relation::create([
                            'type' => 'chemical',
                            'target_id' => $id,
                            'target_category' => $category->id
                        ]);
                    }
                } else {
                    if($categoryRelation) {
                        $categoryRelation->delete();
                    }
                }

            }

            $request->session()->flash('success', 'Химикат обновлен');
        } else {
            $request->session()->flash('danger', 'Химикат с данным id отсутствует.');
        }

        return redirect()->action("AdminLTEController@showChemicals");
    }

    public function deleteChemical(Request $request)
    {
        $id = $request->input('id');

        Filter_attr_entity::where('entity_id', $id)->where('entity_type', 'chemical')->delete();

        foreach (Photos::where('item_id', $id)->where('type', 'chemical')->get() as $photo) {
            Storage::delete("public/$photo->path");
            $photo->delete();
        }

        Chemical::find($id)->delete();
        Vendor_code::where('chemicals_id',$id)->delete();
        $request->session()->flash('success', 'Химикат удалён');
        return redirect()->action("AdminLTEController@showChemicals");
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Cultures processing                                                     │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    private function createCulture(Request $request, $section, $sectionId)
    {
        $culture = Culture::create([
            'photo' => '',
            'name' => $request->input('creationName'),
            'section_id' => $sectionId
        ]);

        $photo = $request->file('creationPhoto');

//        echo '<pre>';
//        var_dump(!empty($photo));die;
        if(!empty($photo)) {
            $extension = $photo->getClientOriginalExtension();
            $filename = strtolower($section).'_'.$culture->id.'_photo.'.$extension;

            $photo->storeAs("public", "culture/$filename");

            $culture_photo_obj = Photos::create([
                'path' => $filename,
                'is_main' => 1,
                'item_id' => $culture->id,
                'type' => 'culture',
                'moderator' => 'accepted',
                'path' => "culture/$filename"
            ]);

            $culture->photo = "culture/$filename";
            $culture->save();
        }

        foreach (Filter_attributes::where('type', 'culture')->get()->pluck('id')->toArray() as $attr_id) {
            foreach (Filter_attr_value::where('attribute_id', $attr_id)->get() as $filter_attr_value) {
                $filter_attr_checked = $request->input("filter_attr_value_$filter_attr_value->id");
                if($filter_attr_checked) {
                    if( ! Filter_attr_entity::where('entity_id', $culture->id)
                                            ->where('attribute_id', $attr_id)
                                            ->where('attribute_value', $filter_attr_value->id)
                                            ->first()) {
                        $attr_entity = Filter_attr_entity::create([
                            'entity_id' => $culture->id,
                            'entity_type' => 'culture',
                            'attribute_id' => $attr_id,
                            'attribute_value' => $filter_attr_value->id
                        ]);
                    }
                } else {
                    if(Filter_attr_entity::where('entity_id', $culture->id)
                                         ->where('attribute_id', $attr_id)
                                         ->where('attribute_value', $filter_attr_value->id)
                                         ->first()) {
                        Filter_attr_entity::where('entity_id', $culture->id)
                                          ->where('entity_type', 'culture')
                                          ->where('attribute_id', $attr_id)
                                          ->where('attribute_value', $filter_attr_value->id)
                                          ->first()
                                          ->delete();
                    }
                }
            }
        }

        $culture->save();

        $request->session()->flash('success', 'Новая культура добавлена');
        return redirect()->action("AdminLTEController@showCultures$section");
    }

    private function showCultures(Request $request, $section, $sectionId, $sectionName)
    {
        $culture_id = $request->session()->get('culture_id');
        $request->session()->forget('culture_id');

        $filter_attributes = Filter_attributes::where('type', 'culture')
                                              ->where('section_id', $sectionId)
                                              ->where('culture_id', 0)
                                              ->get();

        $filter_attr_values = [];
        foreach ($filter_attributes as $attribute) {
            $filter_attr_values[$attribute->name] = Filter_attr_value::where('attribute_id', $attribute->id)->get();
        }

        $filter_attr_entities = [];
        foreach (Filter_attr_entity::where('entity_type', 'culture')->get() as $attr_entity_value) {
            if( ! array_key_exists($attr_entity_value->entity_id, $filter_attr_entities)) {
                $filter_attr_entities[$attr_entity_value->entity_id] = [];
            }
            array_push($filter_attr_entities[$attr_entity_value->entity_id], $attr_entity_value->attribute_value);
        }

        $unique_filter_attributes = [];
        foreach (Filter_attributes::where('type', 'culture')
                                  ->where('section_id', $sectionId)
                                  ->where('culture_id', '!=', 0)->get() as $attribute) {
            $unique_filter_attributes[$attribute->culture_id][$attribute->name] =
                Filter_attr_value::where('attribute_id', $attribute->id)->get();
        }

        return view('admin.forms.cultures', [
            'activeMenu' => 'tables',
            'section' => $section,
            'modelName' => "$sectionName (культуры)",
            'rows' => Culture::where('section_id', $sectionId)->get(),
            'filter_attributes' => $filter_attributes,
            'filter_attr_values' => $filter_attr_values,
            'filter_attr_entities' => $filter_attr_entities,
            'unique_filter_attributes' => $unique_filter_attributes,
            'culture_id' => $culture_id
        ]);
    }

    private function updateCultures(Request $request, $section, $sectionId)
    {
        $id = $request->input('id');

        $request->session()->put('culture_id', $id);

        $culture = Culture::find($id);
        if($culture) {
            $culture->name = $request->input("name_$id");
            $culture->save();

            if($request->file("culture_photo_$id")) {
                Storage::delete("public/$culture->photo");

                $culture_photo = $request->file("culture_photo_$id");
                $extension = $culture_photo->getClientOriginalExtension();

                $filename = uniqid('culture_'.$id.'_photo_').".$extension";
                $culture_photo->storeAs("public", "culture/$filename");

                $culture_photo_obj = Photos::create([
                    'path' => $filename,
                    'is_main' => 1,
                    'item_id' => $id,
                    'type' => 'culture',
                    'moderator' => 'accepted',
                    'path' => "culture/$filename"
                ]);

                $culture->photo = "culture/$filename";
                $culture->save();
            }

            foreach (Filter_attributes::where('type', 'culture')->get()->pluck('id')->toArray() as $attr_id) {
                foreach (Filter_attr_value::where('attribute_id', $attr_id)->get() as $filter_attr_value) {
                    $filter_attr_checked = $request->input("culture_$culture->id".
                                                           "_filter_attr_value_$filter_attr_value->id");
                    if($filter_attr_checked) {
                        if( ! Filter_attr_entity::where('entity_id', $culture->id)
                                                ->where('attribute_id', $attr_id)
                                                ->where('attribute_value', $filter_attr_value->id)
                                                ->first()) {
                            $attr_entity = Filter_attr_entity::create([
                                'entity_id' => $culture->id,
                                'entity_type' => 'culture',
                                'attribute_id' => $attr_id,
                                'attribute_value' => $filter_attr_value->id
                            ]);
                        }
                    } else {
                        if(Filter_attr_entity::where('entity_id', $culture->id)
                                             ->where('attribute_id', $attr_id)
                                             ->where('attribute_value', $filter_attr_value->id)
                                             ->first()) {
                            Filter_attr_entity::where('entity_id', $culture->id)
                                              ->where('entity_type', 'culture')
                                              ->where('attribute_id', $attr_id)
                                              ->where('attribute_value', $filter_attr_value->id)
                                              ->first()
                                              ->delete();
                        }
                    }
                }
            }

            $request->session()->flash('success', 'Культура обновлена');
        } else {
            $request->session()->flash('danger', 'Культура с данным id отсутствует.');
        }

        return redirect()->action("AdminLTEController@showCultures$section");
    }

    private function deleteCulture(Request $request, $section, $sectionId)
    {
        $id = $request->input('id');

        Filter_attr_entity::where('entity_id', $id)->where('entity_type', 'culture')->delete();

        foreach (Photos::where('item_id', $id)->where('type', 'culture')->get() as $photo) {
            Storage::delete("public/$photo->path");
            $photo->delete();
        }

        Culture::find($id)->delete();

        $request->session()->flash('success', 'Культура удалена');
        return redirect()->action("AdminLTEController@showCultures$section");
    }


    public function createCultureKlumba(Request $request) {
        return self::createCulture($request, 'Klumba', 4);
    }
    public function showCulturesKlumba(Request $request) {
        return self::showCultures($request, 'Klumba', 4, 'Клумба');
    }
    public function updateCulturesKlumba(Request $request) {
        return self::updateCultures($request, 'Klumba', 4);
    }
    public function deleteCultureKlumba(Request $request) {
        return self::deleteCulture($request, 'Klumba', 4);
    }


    public function createCultureOgorod(Request $request) {
        return self::createCulture($request, 'Ogorod', 5);
    }
    public function showCulturesOgorod(Request $request) {
        return self::showCultures($request, 'Ogorod', 5, 'Огород');
    }
    public function updateCulturesOgorod(Request $request) {
        return self::updateCultures($request, 'Ogorod', 5);
    }
    public function deleteCultureOgorod(Request $request) {
        return self::deleteCulture($request, 'Ogorod', 5);
    }


    public function createCultureSad(Request $request) {
        return self::createCulture($request, 'Sad', 6);
    }
    public function showCulturesSad(Request $request) {
        return self::showCultures($request, 'Sad', 6, 'Сад');
    }
    public function updateCulturesSad(Request $request) {
        return self::updateCultures($request, 'Sad', 6);
    }
    public function deleteCultureSad(Request $request) {
        return self::deleteCulture($request, 'Sad', 6);
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Sorts processing                                                        │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    private function createSort(Request $request, $section, $sectionId)
    {
        $culture = Culture::where('name', $request->input('creationCulture'))->first();

        $sort = Sort::create([
            'name' => $request->input('creationName') ?? '',
            'slug' => $request->input('creationName') ?? '',
            'vendor_code' => '', //$request->input('creationVendorCode') ?? '',
            'content' => $request->input('creationContent') ?? '',
            'main_photo' => '',
            'section_id' => $sectionId,
            'culture_id' => $culture ? $culture->id : 0,
            'rating' => 0.0,
            'is_new' => 1,
            'merchantability' => 0,
            'created' => date('Y-m-d H:i:s')
        ]);

        if($request->file("creationPhotos")) {
            foreach ($request->file("creationPhotos") as $key => $photo) {
                $extension = $photo->getClientOriginalExtension();

                $filename = uniqid('sort_'.$sort->id.'_photo_').".$extension";
                $photo->storeAs("public", "sort/$filename");

                $photo_obj = Photos::create([
                    'item_id' => $sort->id,
                    'type' => 'sort',
                    'is_main' => $key ? 0 : 1,
                    'moderator' => 'accepted',
                    'path' => "sort/$filename"
                ]);

                $photo_obj->save();

                if($photo_obj->is_main) {
                    $sort->main_photo = $photo_obj->path;
                }
            }
        }

        foreach (Filter_attributes::where('type', 'sort')->get()->pluck('id')->toArray() as $attr_id) {
            foreach (Filter_attr_value::where('attribute_id', $attr_id)->get() as $filter_attr_value) {
                $filter_attr_checked = $request->input("filter_attr_value_$filter_attr_value->id");
                if($filter_attr_checked) {
                    if( ! Filter_attr_entity::where('entity_id', $sort->id)
                                            ->where('attribute_id', $attr_id)
                                            ->where('attribute_value', $filter_attr_value->id)
                                            ->first()) {
                        $attr_entity = Filter_attr_entity::create([
                            'entity_id' => $sort->id,
                            'entity_type' => 'sort',
                            'attribute_id' => $attr_id,
                            'attribute_value' => $filter_attr_value->id
                        ]);
                    }
                } else {
                    if(Filter_attr_entity::where('entity_id', $sort->id)
                                         ->where('attribute_id', $attr_id)
                                         ->where('attribute_value', $filter_attr_value->id)
                                         ->first()) {
                        Filter_attr_entity::where('entity_id', $sort->id)
                                          ->where('entity_type', 'sort')
                                          ->where('attribute_id', $attr_id)
                                          ->where('attribute_value', $filter_attr_value->id)
                                          ->first()
                                          ->delete();
                    }
                }
            }
        }

        foreach (Category::where('type', 'sort')->get() as $category) {
            $categoryChecked = $request->input('creation_category_'.$category->id);
            if($categoryChecked) {
                Category_relation::create([
                    'type' => 'sort',
                    'target_id' => $sort->id,
                    'target_category' => $category->id
                ]);
            }
        }

        foreach (Sort_characteristic::all() as $charact) {
            $value = $request->input('creation_charact_'.$charact->id);

            if($value != '') {
                Sort_charact_relation::create([
                    'sort_id' => $sort->id,
                    'characteristic_id' => $charact->id,
                    'order' => 1,
                    'value' => $value
                ]);
            }
        }

        foreach (range(1, 4) as $year) {
            $params = ['sort_id' => $sort->id, 'year' => $year];
            foreach (range(1, 12) as $month) {
                $inputValue = request()->input('creation_calendar_year_'.$year.'_month_'.$month);
                $params["m$month"] = intval($inputValue);
            }
            Sort_calendar::create($params);
        }

        $sort->save();
        $vendore_code = new Vendor_code();
        $vendore_code->sorts_id = $sort->id;
        $vendore_code->save();
        $request->session()->flash('success', 'Новый сорт добавлен');
        return redirect()->action("AdminLTEController@showSorts$section");
    }

    private function showSorts(Request $request, $section, $sectionId, $sectionName)
    {
        $sort_id = $request->session()->get('sort_id');
        $request->session()->forget('sort_id');

        $sort_photos = [];
        foreach (Sort::all() as $key => $sort) {
            $sort_photos[$sort->id] = Photos::where('item_id', $sort->id)
                                            ->where('type', 'sort')
                                            ->where('moderator', 'accepted')
                                            ->pluck('path')->toArray();
        }

        $filter_attr_values = [];
        foreach (Filter_attributes::where('type', 'sort')
                                  ->where('section_id', $sectionId)->get() as $attribute) {
            $filter_attr_values[$attribute->name] = Filter_attr_value::where('attribute_id', $attribute->id)->get();
        }

        $filter_attr_entities = [];
        foreach (Filter_attr_entity::where('entity_type', 'sort')->get() as $attr_entity_value) {
            if( ! array_key_exists($attr_entity_value->entity_id, $filter_attr_entities)) {
                $filter_attr_entities[$attr_entity_value->entity_id] = [];
            }
            array_push($filter_attr_entities[$attr_entity_value->entity_id], $attr_entity_value->attribute_value);
        }

        $calendars = [];
        foreach (Sort::where('section_id', $sectionId)->get() as $sort) {
            foreach (range(1, 12) as $month) {
                foreach (range(1, 4) as $year) {
                    $calendars[$sort->id][$month][$year] = Sort_calendar::where('sort_id', $sort->id)
                                                                        ->where('year', $year)
                                                                        ->pluck("m$month")
                                                                        ->first() ?? '';
                }
            }
        }

        $operations = [];
        foreach (Sort_operation::all() as $operation) {
            $operations[$operation->id] = $operation->operation_name;
        }

        $cultures = [];
        foreach (Culture::where('section_id', $sectionId)->get() as $culture) {
            $cultures[$culture->id] = $culture->name;
        }

        $categories = [];
        foreach (Category::where('type', 'sort')->get() as $category) {
            $categories[$category->id] = $category->category;
        }

        $categoriesRelations = [];
        foreach (Sort::where('section_id', $sectionId)->get() as $sort) {
            foreach (Category_relation::where('type', 'sort')
                                      ->where('target_id', $sort->id)->get() as $key => $relation) {
                $categoriesRelations[$sort->id][$relation->target_category - 1] = $relation;
            }
        }

        $characteristics = [];
        $characteristicsPrototype = [];
        foreach (Sort::where('section_id', $sectionId)->get() as $sort) {
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
                $characteristicsPrototype[$charact->id] = [
                    'name' => $charact->name,
                    'icon_path' => $charact->icon_path,
                ];
            }
        }

        $monthDict = [
            1 => "Январь", 2 => "Февраль", 3 => "Март",     4 => "Апрель",   5 => "Май",     6 => "Июнь",
            7 => "Июль",   8 => "Август",  9 => "Сентябрь", 10 => "Октябрь", 11 => "Ноябрь", 12 => "Декабрь"
        ];

        $unique_filter_attributes = [];
        foreach (Sort::where('section_id', $sectionId)->get() as $sort) {
            foreach (Filter_attributes::where('type', 'sort')
                                      ->where('section_id', $sectionId)
                                      ->where('culture_id', '!=', 0)->get() as $attribute) {
                $unique_filter_attributes[$attribute->culture_id][$attribute->name] =
                    Filter_attr_value::where('attribute_id', $attribute->id)->get();
            }
        }

        return view('admin.forms.sorts', [
            'activeMenu' => 'tables',
            'section' => $section,
            'modelName' => "$sectionName (сорта)",
            'rows' => Sort::where('section_id', $sectionId)->get(),
            'cultures' => $cultures,
            'sort_photos' => $sort_photos,
            'filter_attributes' => Filter_attributes::where('type', 'sort')
                                                    ->where('section_id', $sectionId)
                                                    ->where('culture_id', 0)->get(),
            'filter_attr_values' => $filter_attr_values,
            'filter_attr_entities' => $filter_attr_entities,
            'calendars' => $calendars,
            'operations' => $operations,
            'categories' => $categories,
            'categoriesRelations' => $categoriesRelations,
            'characteristics' => $characteristics,
            'characteristicsPrototype' => $characteristicsPrototype,
            'monthDict' => $monthDict,
            'unique_filter_attributes' => $unique_filter_attributes,
            'sort_id' => $sort_id
        ]);
    }

    private function updateSorts(Request $request, $section, $sectionId)
    {
        $id = $request->input('id');
        $sectionSort = Sort::find($id);

        $request->session()->put('sort_id', $id);

        if($sectionSort) {

            $sectionSort->name = $request->input("name_$id");
            // $sectionSort->vendor_code = $request->input("vendor_code_$id") ?? '';
            $sectionSort->culture_id = $request->input("culture_id_$id") ?? 0;
            $sectionSort->content = $request->input("content_$id") ?? '';

            $sectionSort->save();

            if($request->input('is_main')) {
                $sort_photo = Photos::where('item_id', $id)
                                    ->where('type', 'sort')
                                    ->where('path', $sectionSort->main_photo)
                                    ->first();

                if($sort_photo) {
                    $sort_photo->is_main = 0;
                    $sort_photo->save();
                }

                $sectionSort->main_photo = $request->input('is_main');
                $sectionSort->save();

                $sort_photo = Photos::where('item_id', $id)
                                    ->where('type', 'sort')
                                    ->where('path', $sectionSort->main_photo)
                                    ->first();
                $sort_photo->is_main = 1;
                $sort_photo->save();
            }

            foreach (Photos::where('item_id', $id)
                           ->where('type', 'sort')
                           ->get()
                           ->pluck('path') as $photoPath) {
                $exploded = explode('.', $photoPath);
                $constructedPath = $exploded[0].'_'.end($exploded);

                if($request->input("for_delete_$constructedPath") === '1') {
                    $sort_photo = Photos::where('path', $photoPath)->first();
                    Storage::delete("public/$sort_photo->path");
                    $sort_photo->delete();
                }
            }

            if($request->file("sort_photos_$id")) {
                foreach ($request->file("sort_photos_$id") as $sort_photo) {
                    $extension = $sort_photo->getClientOriginalExtension();

                    $filename = uniqid('sort_'.$id.'_photo_').".$extension";
                    $sort_photo->storeAs("public", "sort/$filename");

                    $sort_photo_obj = Photos::create([
                        'path' => $filename,
                        'is_main' => 0,
                        'item_id' => $id,
                        'type' => 'sort',
                        'moderator' => 'accepted',
                        'path' => "sort/$filename"
                    ]);

                    $sort_photo_obj->save();
                }
            }

            foreach (Filter_attributes::where('type', 'sort')->get()->pluck('id')->toArray() as $attr_id) {
                foreach (Filter_attr_value::where('attribute_id', $attr_id)->get() as $filter_attr_value) {
                    $filter_attr_checked = $request->input("sort_$sectionSort->id".
                                                           "_filter_attr_value_$filter_attr_value->id");
                    if($filter_attr_checked) {
                        if( ! Filter_attr_entity::where('entity_id', $sectionSort->id)
                                                ->where('attribute_id', $attr_id)
                                                ->where('attribute_value', $filter_attr_value->id)
                                                ->first()) {
                            $attr_entity = Filter_attr_entity::create([
                                'entity_id' => $sectionSort->id,
                                'entity_type' => 'sort',
                                'attribute_id' => $attr_id,
                                'attribute_value' => $filter_attr_value->id
                            ]);
                        }
                    } else {
                        if(Filter_attr_entity::where('entity_id', $sectionSort->id)
                                             ->where('attribute_id', $attr_id)
                                             ->where('attribute_value', $filter_attr_value->id)
                                             ->first()) {
                            Filter_attr_entity::where('entity_id', $sectionSort->id)
                                              ->where('entity_type', 'sort')
                                              ->where('attribute_id', $attr_id)
                                              ->where('attribute_value', $filter_attr_value->id)
                                              ->first()
                                              ->delete();
                        }
                    }
                }
            }

            foreach (Category::where('type', 'sort')->get() as $key => $category) {
                $categoryChecked = $request->input('sort_'.$id.'_category_'.$category->id);
                $categoryRelation = Category_relation::where('type', 'sort')
                                                     ->where('target_id', $id)
                                                     ->where('target_category', $category->id)
                                                     ->first();

                if($categoryChecked) {
                    if( ! $categoryRelation) {
                        Category_relation::create([
                            'type' => 'sort',
                            'target_id' => $id,
                            'target_category' => $category->id
                        ]);
                    }
                } else {
                    if($categoryRelation) {
                        $categoryRelation->delete();
                    }
                }

            }

            foreach (range(1, 4) as $year) {
                $sortCalendar = Sort_calendar::where('sort_id', $id)
                                             ->where('year', $year)
                                             ->first();
                if( ! is_null($sortCalendar)) {
                    foreach (range(1, 12) as $month) {
                        $inputValue = $request->input('calendar_'.$id.'_year_'.$year.'_month_'.$month);
                        $sortCalendar["m$month"] = $inputValue;
                    }
                    $sortCalendar->save();
                } else {
                    $params = ['sort_id' => $id, 'year' => $year];
                    foreach (range(1, 12) as $month) {
                        $inputValue = $request->input('calendar_'.$id.'_year_'.$year.'_month_'.$month);
                        $params["m$month"] = $inputValue;
                    }
                    Sort_calendar::create($params);
                }
            }

            foreach (Sort_characteristic::all() as $charact) {
                $sort_charact = Sort_charact_relation::where('sort_id', $id)
                                                     ->where('characteristic_id', $charact->id)
                                                     ->first();

                $new_value = $request->input('sort_'.$id.'_charact_'.$charact->id);//.'_value_'.$sort_charact->id);

                if($new_value != '') {
                    if($sort_charact) {
                        $sort_charact->value = $new_value;
                        $sort_charact->save();
                    } else {
                        Sort_charact_relation::create([
                            'sort_id' => $id,
                            'characteristic_id' => $charact->id,
                            'order' => 1,
                            'value' => $new_value
                        ]);
                    }
                }
                if ($new_value == '' && $sort_charact) {
                    Sort_charact_relation::where('sort_id', $id)
                                         ->where('characteristic_id', $charact->id)
                                         ->delete();
                }
            }

            $request->session()->flash('success', 'Сорт обновлен');
        } else {
            $request->session()->flash('danger', 'Сорт с данным id отсутствует.');
        }

        return redirect()->action("AdminLTEController@showSorts$section");
    }

    private function deleteSort(Request $request, $section, $sectionId)
    {
        $id = $request->input('id');

        Sort_calendar::where('sort_id', $id)->delete();

        Filter_attr_entity::where('entity_id', $id)->where('entity_type', 'sort')->delete();

        foreach (Photos::where('item_id', $id)->where('type', 'sort')->get() as $photo) {
            Storage::delete("public/$photo->path");
            $photo->delete();
        }

        Category_relation::where('type', 'sort')->where('target_id', $id)->delete();

        Sort_charact_relation::where('sort_id', $id)->delete();

        Sort::find($id)->delete();
        Vendor_code::where('sorts_id',$id)->delete();
        $request->session()->flash('success', 'Сорт удалён');
        return redirect()->action("AdminLTEController@showSorts$section");
    }


    public function createSortKlumba(Request $request) {
        return self::createSort($request, 'Klumba', 4);
    }
    public function showSortsKlumba(Request $request) {
        return self::showSorts($request, 'Klumba', 4, 'Клумба');
    }
    public function updateSortsKlumba(Request $request) {
        return self::updateSorts($request, 'Klumba', 4);
    }
    public function deleteSortKlumba(Request $request) {
        return self::deleteSort($request, 'Klumba', 4);
    }


    public function createSortOgorod(Request $request) {
        return self::createSort($request, 'Ogorod', 5);
    }
    public function showSortsOgorod(Request $request) {
        return self::showSorts($request, 'Ogorod', 5, 'Огород');
    }
    public function updateSortsOgorod(Request $request) {
        return self::updateSorts($request, 'Ogorod', 5);
    }
    public function deleteSortOgorod(Request $request) {
        return self::deleteSort($request, 'Ogorod', 5);
    }


    public function createSortSad(Request $request) {
        return self::createSort($request, 'Sad', 6);
    }
    public function showSortsSad(Request $request) {
        return self::showSorts($request, 'Sad', 6, 'Сад');
    }
    public function updateSortsSad(Request $request) {
        return self::updateSorts($request, 'Sad', 6);
    }
    public function deleteSortSad(Request $request) {
        return self::deleteSort($request, 'Sad', 6);
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Diseases processing                                                     │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    private function createDiseases(Request $request, $section, $sectionId)
    {
        $disease = Disease::create([
            'culture_id' => 0,
            'section_id' => $sectionId,
            'name' => $request->input('creationName') ?? '',
            'slug' => $request->input('creationName') ?? '',
            'main_photo' => '',
            'description' => $request->input('creationDescription') ?? '',
            'fight' => $request->input('creationFight') ?? '',
            'date' => date('Y-m-d H:i:s')
        ]);

        $disease_cultures = array_map(function($id) {
            return intval($id);
        }, $request->input("creationCultures") ?? []);
        foreach ($disease_cultures as $culture_id) {
            Pest_disease_relations::create([
                'item_id' => $culture_id,
                'item_type' => 'culture',
                'pest_disease_type' => 'disease',
                'pest_disease_id' => $disease->id,
            ]);
        }

        $disease_sorts = array_map(function($id) {
            return intval($id);
        }, $request->input("creationSorts") ?? []);
        foreach ($disease_sorts as $sort_id) {
            Pest_disease_relations::create([
                'item_id' => $sort_id,
                'item_type' => 'sort',
                'pest_disease_type' => 'disease',
                'pest_disease_id' => $disease->id,
            ]);
        }

        $disease_chemicals = array_map(function($id) {
            return intval($id);
        }, $request->input("creationChemicals") ?? []);
        foreach ($disease_chemicals as $chemical_id) {
            Disease_chemical::create([
                'disease_id' => $disease->id,
                'chemical_id' => $chemical_id
            ]);
        }

        if($request->file("creationPhotos")) {
            foreach ($request->file("creationPhotos") as $key => $photo) {
                $extension = $photo->getClientOriginalExtension();

                $filename = uniqid('disease_'.$disease->id.'_photo_').".$extension";
                $photo->storeAs("public", $filename);

                $photo_obj = Photos::create([
                    'item_id' => $disease->id,
                    'type' => 'disease',
                    'is_main' => $key ? 0 : 1,
                    'moderator' => 'accepted',
                    'path' => $filename
                ]);

                $photo_obj->save();

                if($photo_obj->is_main) {
                    $disease->main_photo = $photo_obj->path;
                }
            }
        }

        foreach (Filter_attributes::where('type', 'disease')->get()->pluck('id')->toArray() as $attr_id) {
            foreach (Filter_attr_value::where('attribute_id', $attr_id)->get() as $filter_attr_value) {
                $filter_attr_checked = $request->input("filter_attr_value_$filter_attr_value->id");
                if($filter_attr_checked) {
                    if( ! Filter_attr_entity::where('entity_id', $disease->id)
                                            ->where('attribute_id', $attr_id)
                                            ->where('attribute_value', $filter_attr_value->id)
                                            ->first()) {
                        $attr_entity = Filter_attr_entity::create([
                            'entity_id' => $disease->id,
                            'entity_type' => 'disease',
                            'attribute_id' => $attr_id,
                            'attribute_value' => $filter_attr_value->id
                        ]);
                    }
                } else {
                    if(Filter_attr_entity::where('entity_id', $disease->id)
                                         ->where('attribute_id', $attr_id)
                                         ->where('attribute_value', $filter_attr_value->id)
                                         ->first()) {
                        Filter_attr_entity::where('entity_id', $disease->id)
                                          ->where('entity_type', 'disease')
                                          ->where('attribute_id', $attr_id)
                                          ->where('attribute_value', $filter_attr_value->id)
                                          ->first()
                                          ->delete();
                    }
                }
            }
        }

        $disease->save();

        $request->session()->flash('success', 'Новое заболевание добавлено');
        return redirect()->action("AdminLTEController@showDiseases$section");
    }

    private function showDiseases(Request $request, $section, $sectionId, $sectionName)
    {
        $disease_id = $request->session()->get('disease_id');
        $request->session()->forget('disease_id');

        $diseases_photos = [];
        foreach (Disease::where('section_id', $sectionId)->get() as $key => $disease) {
            $diseases_photos[$disease->id] = Photos::where('item_id', $disease->id)
                                                   ->where('type', 'disease')
                                                   ->where('moderator', 'accepted')
                                                   ->pluck('path')->toArray();
        }

        $filter_attr_values = [];
        foreach (Filter_attributes::where('type', 'disease')->get()->where('section_id', $sectionId) as $attribute) {
            $filter_attr_values[$attribute->name] = Filter_attr_value::where('attribute_id', $attribute->id)->get();
        }

        $filter_attr_entities = [];
        foreach (Filter_attr_entity::where('entity_type', 'disease')->get() as $attr_entity_value) {
            if( ! array_key_exists($attr_entity_value->entity_id, $filter_attr_entities)) {
                $filter_attr_entities[$attr_entity_value->entity_id] = [];
            }
            array_push($filter_attr_entities[$attr_entity_value->entity_id], $attr_entity_value->attribute_value);
        }

        $cultures = [];
        foreach (Culture::where('section_id', $sectionId)->get()as $culture) {
            $cultures[$culture->id] = $culture->name;
        }

        $disease_cultures = [];
        foreach (Pest_disease_relations::where('item_type', 'culture')
                                       ->where('pest_disease_type', 'disease')->get() as $disease_relation) {
            if( ! isset($disease_cultures[$disease_relation->pest_disease_id])) {
                $disease_cultures[$disease_relation->pest_disease_id] = [];
            }
            array_push($disease_cultures[$disease_relation->pest_disease_id], $disease_relation->item_id);
        }

        $disease_sorts = [];
        foreach (Pest_disease_relations::where('item_type', 'sort')
                                       ->where('pest_disease_type', 'disease')->get() as $disease_relation) {
            if( ! isset($disease_sorts[$disease_relation->pest_disease_id])) {
                $disease_sorts[$disease_relation->pest_disease_id] = [];
            }
            array_push($disease_sorts[$disease_relation->pest_disease_id], $disease_relation->item_id);
        }

        $disease_chemicals = [];
        foreach (Disease_chemical::all() as $disease_chemical) {
            if( ! isset($disease_chemicals[$disease_chemical->disease_id])) {
                $disease_chemicals[$disease_chemical->disease_id] = [];
            }
            array_push($disease_chemicals[$disease_chemical->disease_id], $disease_chemical->chemical_id);
        }

        return view('admin.forms.diseases', [
            'activeMenu' => 'tables',
            'section' => $section,
            'modelName' => $sectionName,
            'rows' => Disease::where('section_id', $sectionId)->get(),
            'diseases_photos' => $diseases_photos,
            'filter_attributes' => Filter_attributes::where('type', 'disease')->where('section_id', $sectionId)->get(),
            'filter_attr_values' => $filter_attr_values,
            'filter_attr_entities' => $filter_attr_entities,
            'cultures' => $cultures,
            'sorts' => Sort::where('section_id', $sectionId)->get(),
            'chemicals' => Chemical::all(),
            'disease_cultures' => $disease_cultures,
            'disease_sorts' => $disease_sorts,
            'disease_chemicals' => $disease_chemicals,
            'disease_id' => $disease_id
        ]);
    }


    private function updateDiseases(Request $request, $section, $sectionId)
    {
        $id = $request->input('id');
        $disease = Disease::find($id);

        $request->session()->put('disease_id', $id);

        if($disease) {

            $disease->name = $request->input("name_$id");
            $disease->slug = $request->input("name_$id");
            $disease->culture_id = $request->input("culture_id_$id") ?? 0;
            $disease->description = $request->input("description_$id") ?? '';
            $disease->fight = $request->input("fight_$id") ?? '';

            $disease->save();

            // Disease cultures update
            $disease_old_cultures = Pest_disease_relations::where('pest_disease_type', 'disease')
                                                          ->where('pest_disease_id', $id)
                                                          ->where('item_type', 'culture')
                                                          ->get()
                                                          ->pluck('item_id')
                                                          ->toArray();
            $disease_new_cultures = array_map(function($id) {
                return intval($id);
            }, $request->input("disease_cultures") ?? []);
            foreach (array_diff($disease_old_cultures, $disease_new_cultures) as $culture_id_for_delete) {
                Pest_disease_relations::where('item_id', $culture_id_for_delete)->delete();
            }
            foreach (array_diff($disease_new_cultures, $disease_old_cultures) as $culture_id_for_adding) {
                Pest_disease_relations::create([
                    'item_id' => $culture_id_for_adding,
                    'item_type' => 'culture',
                    'pest_disease_type' => 'disease',
                    'pest_disease_id' => $id,
                ]);
            }

            // Disease sorts update
            $disease_old_sorts = Pest_disease_relations::where('pest_disease_type', 'disease')
                                                       ->where('pest_disease_id', $id)
                                                       ->where('item_type', 'sort')
                                                       ->get()
                                                       ->pluck('item_id')
                                                       ->toArray();
            $disease_new_sorts = array_map(function($id) {
                return intval($id);
            }, $request->input("disease_sorts") ?? []);
            foreach (array_diff($disease_old_sorts, $disease_new_sorts) as $sort_id_for_delete) {
                Pest_disease_relations::where('item_id', $sort_id_for_delete)->delete();
            }
            foreach (array_diff($disease_new_sorts, $disease_old_sorts) as $sort_id_for_adding) {
                Pest_disease_relations::create([
                    'item_id' => $sort_id_for_adding,
                    'item_type' => 'sort',
                    'pest_disease_type' => 'disease',
                    'pest_disease_id' => $id,
                ]);
            }

            // Disease chemicals update
            $disease_old_chemicals = Disease_chemical::where('disease_id', $id)
                                                     ->get()
                                                     ->pluck('chemical_id')
                                                     ->toArray();
            $disease_new_chemicals = array_map(function($id) {
                return intval($id);
            }, $request->input("disease_chemicals") ?? []);
            foreach (array_diff($disease_old_chemicals, $disease_new_chemicals) as $chemical_id_for_delete) {
                Disease_chemical::where('chemical_id', $chemical_id_for_delete)->delete();
            }
            foreach (array_diff($disease_new_chemicals, $disease_old_chemicals) as $chemical_id_for_adding) {
                Disease_chemical::create([
                    'disease_id' => $id,
                    'chemical_id' => $chemical_id_for_adding
                ]);
            }

            if($request->input('is_main')) {
                $disease_photo = Photos::where('item_id', $id)
                                       ->where('type', 'disease')
                                       ->where('path', $disease->main_photo)
                                       ->first();

                if($disease_photo) {
                    $disease_photo->is_main = 0;
                    $disease_photo->save();
                }

                $disease->main_photo = $request->input('is_main');
                $disease->save();

                $disease_photo = Photos::where('item_id', $id)
                                       ->where('type', 'disease')
                                       ->where('path', $disease->main_photo)
                                       ->first();
                $disease_photo->is_main = 1;
                $disease_photo->save();
            }

            foreach (Photos::where('item_id', $id)
                           ->where('type', 'disease')
                           ->get()
                           ->pluck('path') as $photoPath) {
                $exploded = explode('.', $photoPath);
                $constructedPath = $exploded[0].'_'.end($exploded);

                if($request->input("for_delete_$constructedPath") === '1') {
                    $disease_photo = Photos::where('path', $photoPath)->first();
                    Storage::delete("public/$disease_photo->path");
                    $disease_photo->delete();
                }
            }

            if($request->file("diseases_photos_$id")) {
                foreach ($request->file("diseases_photos_$id") as $disease_photo) {
                    $extension = $disease_photo->getClientOriginalExtension();

                    $filename = uniqid('disease_'.$id.'_photo_').".$extension";
                    $disease_photo->storeAs("public", $filename);

                    $sort_photo_obj = Photos::create([
                        'path' => $filename,
                        'is_main' => 0,
                        'item_id' => $id,
                        'type' => 'disease',
                        'moderator' => 'accepted'
                    ]);

                    $sort_photo_obj->save();
                }
            }

            foreach (Filter_attributes::where('type', 'disease')->get()->pluck('id')->toArray() as $attr_id) {
                foreach (Filter_attr_value::where('attribute_id', $attr_id)->get() as $filter_attr_value) {
                    $filter_attr_checked = $request->input("disease_$disease->id".
                                                           "_filter_attr_value_$filter_attr_value->id");
                    if($filter_attr_checked) {
                        if( ! Filter_attr_entity::where('entity_id', $disease->id)
                                                ->where('attribute_id', $attr_id)
                                                ->where('attribute_value', $filter_attr_value->id)
                                                ->first()) {
                            $attr_entity = Filter_attr_entity::create([
                                'entity_id' => $disease->id,
                                'entity_type' => 'disease',
                                'attribute_id' => $attr_id,
                                'attribute_value' => $filter_attr_value->id
                            ]);
                        }
                    } else {
                        if(Filter_attr_entity::where('entity_id', $disease->id)
                                             ->where('attribute_id', $attr_id)
                                             ->where('attribute_value', $filter_attr_value->id)
                                             ->first()) {
                            Filter_attr_entity::where('entity_id', $disease->id)
                                              ->where('entity_type', 'disease')
                                              ->where('attribute_id', $attr_id)
                                              ->where('attribute_value', $filter_attr_value->id)
                                              ->first()
                                              ->delete();
                        }
                    }
                }
            }

        $request->session()->flash('success', 'Заболевание обновлено');
        } else {
            $request->session()->flash('danger', 'Заболевание с данным id отсутствует.');
        }

        return redirect()->action("AdminLTEController@showDiseases$section");
    }

    private function deleteDiseases(Request $request, $section, $sectionId)
    {
        $id = $request->input('id');

        Filter_attr_entity::where('entity_id', $id)->where('entity_type', 'disease')->delete();

        foreach (Photos::where('item_id', $id)->where('type', 'disease')->get() as $photo) {
            Storage::delete("public/$photo->path");
            $photo->delete();
        }

        foreach(Disease_chemical::where('disease_id', $id)->get() as $disease_chemical) {
            $disease_chemical->delete();
        }

        foreach(Pest_disease_relations::where('pest_disease_type', 'disease')
                                      ->where('pest_disease_id', $id)->get() as $relation) {
            $relation->delete();
        }

        Disease::find($id)->delete();

        $request->session()->flash('success', 'Заболевание удалено');
        return redirect()->action("AdminLTEController@showDiseases$section");
    }


    public function createDiseasesKlumba(Request $request) {
        return self::createDiseases($request, 'Klumba', 4);
    }
    public function showDiseasesKlumba(Request $request) {
        return self::showDiseases($request, 'Klumba', 4, 'Клумба (заболевания)');
    }
    public function updateDiseasesKlumba(Request $request) {
        return self::updateDiseases($request, 'Klumba', 4);
    }
    public function deleteDiseasesKlumba(Request $request) {
        return self::deleteDiseases($request, 'Klumba', 4);
    }


    public function createDiseasesOgorod(Request $request) {
        return self::createDiseases($request, 'Ogorod', 5);
    }
    public function showDiseasesOgorod(Request $request) {
        return self::showDiseases($request, 'Ogorod', 5, 'Огород (заболевания)');
    }
    public function updateDiseasesOgorod(Request $request) {
        return self::updateDiseases($request, 'Ogorod', 5);
    }
    public function deleteDiseasesOgorod(Request $request) {
        return self::deleteDiseases($request, 'Ogorod', 5);
    }


    public function createDiseasesSad(Request $request) {
        return self::createDiseases($request, 'Sad', 6);
    }
    public function showDiseasesSad(Request $request) {
        return self::showDiseases($request, 'Sad', 6, 'Сад (заболевания)');
    }
    public function updateDiseasesSad(Request $request) {
        return self::updateDiseases($request, 'Sad', 6);
    }
    public function deleteDiseasesSad(Request $request) {
        return self::deleteDiseases($request, 'Sad', 6);
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Pests processing                                                        │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    private function createPests(Request $request, $section, $sectionId)
    {
        $pest = Pest::create([
            'culture_id' => 0,
            'section_id' => $sectionId,
            'name' => $request->input('creationName') ?? '',
            'slug' => $request->input('creationName') ?? '',
            'main_photo' => '',
            'description' => $request->input('creationDescription') ?? '',
            'fight' => $request->input('creationFight') ?? '',
            'date' => date('Y-m-d H:i:s')
        ]);

        $pest_cultures = array_map(function($id) {
            return intval($id);
        }, $request->input("creationCultures") ?? []);
        foreach ($pest_cultures as $culture_id) {
            Pest_disease_relations::create([
                'item_id' => $culture_id,
                'item_type' => 'culture',
                'pest_disease_type' => 'pest',
                'pest_disease_id' => $pest->id,
            ]);
        }

        $pest_sorts = array_map(function($id) {
            return intval($id);
        }, $request->input("creationSorts") ?? []);
        foreach ($pest_sorts as $sort_id) {
            Pest_disease_relations::create([
                'item_id' => $sort_id,
                'item_type' => 'sort',
                'pest_disease_type' => 'pest',
                'pest_disease_id' => $pest->id,
            ]);
        }

        $pest_chemicals = array_map(function($id) {
            return intval($id);
        }, $request->input("creationChemicals") ?? []);
        foreach ($pest_chemicals as $chemical_id) {
            Disease_chemical::create([
                'disease_id' => $pest->id,
                'chemical_id' => $chemical_id
            ]);
        }

        if($request->file("creationPhotos")) {
            foreach ($request->file("creationPhotos") as $key => $photo) {
                $extension = $photo->getClientOriginalExtension();

                $filename = uniqid('pest_'.$pest->id.'_photo_').".$extension";
                $photo->storeAs("public", $filename);

                $photo_obj = Photos::create([
                    'item_id' => $pest->id,
                    'type' => 'pest',
                    'is_main' => $key ? 0 : 1,
                    'moderator' => 'accepted',
                    'path' => $filename
                ]);

                $photo_obj->save();

                if($photo_obj->is_main) {
                    $pest->main_photo = $photo_obj->path;
                }
            }
        }

        foreach (Filter_attributes::where('type', 'pest')->get()->pluck('id')->toArray() as $attr_id) {
            foreach (Filter_attr_value::where('attribute_id', $attr_id)->get() as $filter_attr_value) {
                $filter_attr_checked = $request->input("filter_attr_value_$filter_attr_value->id");
                if($filter_attr_checked) {
                    if( ! Filter_attr_entity::where('entity_id', $pest->id)
                                            ->where('attribute_id', $attr_id)
                                            ->where('attribute_value', $filter_attr_value->id)
                                            ->first()) {
                        $attr_entity = Filter_attr_entity::create([
                            'entity_id' => $pest->id,
                            'entity_type' => 'pest',
                            'attribute_id' => $attr_id,
                            'attribute_value' => $filter_attr_value->id
                        ]);
                    }
                } else {
                    if(Filter_attr_entity::where('entity_id', $pest->id)
                                         ->where('attribute_id', $attr_id)
                                         ->where('attribute_value', $filter_attr_value->id)
                                         ->first()) {
                        Filter_attr_entity::where('entity_id', $pest->id)
                                          ->where('entity_type', 'pest')
                                          ->where('attribute_id', $attr_id)
                                          ->where('attribute_value', $filter_attr_value->id)
                                          ->first()
                                          ->delete();
                    }
                }
            }
        }

        $pest->save();

        $request->session()->flash('success', 'Новое заболевание добавлено');
        return redirect()->action("AdminLTEController@showPests$section");
    }

    private function showPests(Request $request, $section, $sectionId, $sectionName)
    {
        $pest_id = $request->session()->get('pest_id');
        $request->session()->forget('pest_id');

        $pests_photos = [];
        foreach (Pest::where('section_id', $sectionId)->get() as $key => $pest) {
            $pests_photos[$pest->id] = Photos::where('item_id', $pest->id)
                                                   ->where('type', 'pest')
                                                   ->where('moderator', 'accepted')
                                                   ->pluck('path')->toArray();
        }

        $filter_attr_values = [];
        foreach (Filter_attributes::where('type', 'pest')->where('section_id', $sectionId)->get() as $attribute) {
            $filter_attr_values[$attribute->name] = Filter_attr_value::where('attribute_id', $attribute->id)->get();
        }

        $filter_attr_entities = [];
        foreach (Filter_attr_entity::where('entity_type', 'pest')->get() as $attr_entity_value) {
            if( ! array_key_exists($attr_entity_value->entity_id, $filter_attr_entities)) {
                $filter_attr_entities[$attr_entity_value->entity_id] = [];
            }
            array_push($filter_attr_entities[$attr_entity_value->entity_id], $attr_entity_value->attribute_value);
        }

        $cultures = [];
        foreach (Culture::where('section_id', $sectionId)->get() as $culture) {
            $cultures[$culture->id] = $culture->name;
        }

        $pest_cultures = [];
        foreach (Pest_disease_relations::where('item_type', 'culture')
                                       ->where('pest_disease_type', 'pest')->get() as $pest_relation) {
            if( ! isset($pest_cultures[$pest_relation->pest_disease_id])) {
                $pest_cultures[$pest_relation->pest_disease_id] = [];
            }
            array_push($pest_cultures[$pest_relation->pest_disease_id], $pest_relation->item_id);
        }

        $pest_sorts = [];
        foreach (Pest_disease_relations::where('item_type', 'sort')
                                       ->where('pest_disease_type', 'pest')->get() as $pest_relation) {
            if( ! isset($pest_sorts[$pest_relation->pest_disease_id])) {
                $pest_sorts[$pest_relation->pest_disease_id] = [];
            }
            array_push($pest_sorts[$pest_relation->pest_disease_id], $pest_relation->item_id);
        }

        $pest_chemicals = [];
        foreach (Pest_chemical::all() as $pest_chemical) {
            if( ! isset($pest_chemicals[$pest_chemical->pest_id])) {
                $pest_chemicals[$pest_chemical->pest_id] = [];
            }
            array_push($pest_chemicals[$pest_chemical->pest_id], $pest_chemical->chemical_id);
        }

        return view('admin.forms.pests', [
            'activeMenu' => 'tables',
            'section' => $section,
            'modelName' => $sectionName,
            'rows' => Pest::where('section_id', $sectionId)->get(),
            'pests_photos' => $pests_photos,
            'filter_attributes' => Filter_attributes::where('type', 'pest')->where('section_id', $sectionId)->get(),
            'filter_attr_values' => $filter_attr_values,
            'filter_attr_entities' => $filter_attr_entities,
            'cultures' => $cultures,
            'sorts' => Sort::where('section_id', $sectionId)->get(),
            'chemicals' => Chemical::all(),
            'pest_cultures' => $pest_cultures,
            'pest_sorts' => $pest_sorts,
            'pest_chemicals' => $pest_chemicals,
            'pest_id' => $pest_id
        ]);
    }


    private function updatePests(Request $request, $section, $sectionId)
    {
        $id = $request->input('id');
        $pest = Pest::find($id);

        $request->session()->put('pest_id', $id);

        if($pest) {

            $pest->name = $request->input("name_$id");
            $pest->slug = $request->input("name_$id");
            $pest->culture_id = $request->input("culture_id_$id") ?? 0;
            $pest->description = $request->input("description_$id") ?? '';
            $pest->fight = $request->input("fight_$id") ?? '';

            $pest->save();

            // Pest cultures update
            $pest_old_cultures = Pest_disease_relations::where('pest_disease_type', 'pest')
                                                       ->where('pest_disease_id', $id)
                                                       ->where('item_type', 'culture')
                                                       ->get()
                                                       ->pluck('item_id')
                                                       ->toArray();
            $pest_new_cultures = array_map(function($id) {
                return intval($id);
            }, $request->input("pest_cultures") ?? []);
            foreach (array_diff($pest_old_cultures, $pest_new_cultures) as $culture_id_for_delete) {
                Pest_disease_relations::where('item_id', $culture_id_for_delete)->delete();
            }
            foreach (array_diff($pest_new_cultures, $pest_old_cultures) as $culture_id_for_adding) {
                Pest_disease_relations::create([
                    'item_id' => $culture_id_for_adding,
                    'item_type' => 'culture',
                    'pest_disease_type' => 'pest',
                    'pest_disease_id' => $id,
                ]);
            }

            // Pest sorts update
            $pest_old_sorts = Pest_disease_relations::where('pest_disease_type', 'pest')
                                                    ->where('pest_disease_id', $id)
                                                    ->where('item_type', 'sort')
                                                    ->get()
                                                    ->pluck('item_id')
                                                    ->toArray();
            $pest_new_sorts = array_map(function($id) {
                return intval($id);
            }, $request->input("pest_sorts") ?? []);
            foreach (array_diff($pest_old_sorts, $pest_new_sorts) as $sort_id_for_delete) {
                Pest_disease_relations::where('item_id', $sort_id_for_delete)->delete();
            }
            foreach (array_diff($pest_new_sorts, $pest_old_sorts) as $sort_id_for_adding) {
                Pest_disease_relations::create([
                    'item_id' => $sort_id_for_adding,
                    'item_type' => 'sort',
                    'pest_disease_type' => 'pest',
                    'pest_disease_id' => $id,
                ]);
            }

            // Pest chemicals update
            $pest_old_chemicals = Pest_chemical::where('pest_id', $id)
                                               ->get()
                                               ->pluck('chemical_id')
                                               ->toArray();
            $pest_new_chemicals = array_map(function($id) {
                return intval($id);
            }, $request->input("pest_chemicals") ?? []);
            foreach (array_diff($pest_old_chemicals, $pest_new_chemicals) as $chemical_id_for_delete) {
                Pest_chemical::where('chemical_id', $chemical_id_for_delete)->delete();
            }
            foreach (array_diff($pest_new_chemicals, $pest_old_chemicals) as $chemical_id_for_adding) {
                Pest_chemical::create([
                    'pest_id' => $id,
                    'chemical_id' => $chemical_id_for_adding
                ]);
            }

            if($request->input('is_main')) {
                $pest_photo = Photos::where('item_id', $id)
                                    ->where('type', 'pest')
                                    ->where('path', $pest->main_photo)
                                    ->first();

                if($pest_photo) {
                    $pest_photo->is_main = 0;
                    $pest_photo->save();
                }

                $pest->main_photo = $request->input('is_main');
                $pest->save();

                $pest_photo = Photos::where('item_id', $id)
                                    ->where('type', 'pest')
                                    ->where('path', $pest->main_photo)
                                    ->first();
                $pest_photo->is_main = 1;
                $pest_photo->save();
            }

            foreach (Photos::where('item_id', $id)
                           ->where('type', 'pest')
                           ->pluck('path') as $photoPath) {
                $exploded = explode('.', $photoPath);
                $constructedPath = $exploded[0].'_'.end($exploded);

                if($request->input("for_delete_$constructedPath") === '1') {
                    $pest_photo = Photos::where('path', $photoPath)->first();
                    Storage::delete("public/$pest_photo->path");
                    $pest_photo->delete();
                }
            }

            if($request->file("pests_photos_$id")) {
                foreach ($request->file("pests_photos_$id") as $pest_photo) {
                    $extension = $pest_photo->getClientOriginalExtension();

                    $filename = uniqid('pest_'.$id.'_photo_').".$extension";
                    $pest_photo->storeAs("public", $filename);

                    $sort_photo_obj = Photos::create([
                        'path' => $filename,
                        'is_main' => 0,
                        'item_id' => $id,
                        'type' => 'pest',
                        'moderator' => 'accepted'
                    ]);

                    $sort_photo_obj->save();
                }
            }

            foreach (Filter_attributes::where('type', 'pest')->get()->pluck('id')->toArray() as $attr_id) {
                foreach (Filter_attr_value::where('attribute_id', $attr_id)->get() as $filter_attr_value) {
                    $filter_attr_checked = $request->input("pest_$pest->id".
                                                           "_filter_attr_value_$filter_attr_value->id");
                    if($filter_attr_checked) {
                        if( ! Filter_attr_entity::where('entity_id', $pest->id)
                                                ->where('attribute_id', $attr_id)
                                                ->where('attribute_value', $filter_attr_value->id)
                                                ->first()) {
                            $attr_entity = Filter_attr_entity::create([
                                'entity_id' => $pest->id,
                                'entity_type' => 'pest',
                                'attribute_id' => $attr_id,
                                'attribute_value' => $filter_attr_value->id
                            ]);
                        }
                    } else {
                        if(Filter_attr_entity::where('entity_id', $pest->id)
                                             ->where('attribute_id', $attr_id)
                                             ->where('attribute_value', $filter_attr_value->id)
                                             ->first()) {
                            Filter_attr_entity::where('entity_id', $pest->id)
                                              ->where('entity_type', 'pest')
                                              ->where('attribute_id', $attr_id)
                                              ->where('attribute_value', $filter_attr_value->id)
                                              ->first()
                                              ->delete();
                        }
                    }
                }
            }

        $request->session()->flash('success', 'Вредитель обновлён');
        } else {
            $request->session()->flash('danger', 'Вредитель с данным id отсутствует.');
        }

        return redirect()->action("AdminLTEController@showPests$section");
    }

    private function deletePests(Request $request, $section, $sectionId)
    {
        $id = $request->input('id');

        Filter_attr_entity::where('entity_id', $id)->where('entity_type', 'pest')->delete();

        foreach (Photos::where('item_id', $id)->where('type', 'pest')->get() as $photo) {
            Storage::delete("public/$photo->path");
            $photo->delete();
        }

        foreach(Pest_chemical::where('pest_id', $id)->get() as $pest_chemical) {
            $pest_chemical->delete();
        }

        foreach(Pest_disease_relations::where('pest_disease_type', 'pest')
                                      ->where('pest_disease_id', $id)->get() as $relation) {
            $relation->delete();
        }

        Pest::find($id)->delete();

        $request->session()->flash('success', 'Вредитель удалён');
        return redirect()->action("AdminLTEController@showPests$section");
    }


    public function createPestsKlumba(Request $request) {
        return self::createPests($request, 'Klumba', 4);
    }
    public function showPestsKlumba(Request $request) {
        return self::showPests($request, 'Klumba', 4, 'Клумба (вредители)');
    }
    public function updatePestsKlumba(Request $request) {
        return self::updatePests($request, 'Klumba', 4);
    }
    public function deletePestsKlumba(Request $request) {
        return self::deletePests($request, 'Klumba', 4);
    }


    public function createPestsOgorod(Request $request) {
        return self::createPests($request, 'Ogorod', 5);
    }
    public function showPestsOgorod(Request $request) {
        return self::showPests($request, 'Ogorod', 5, 'Огород (вредители)');
    }
    public function updatePestsOgorod(Request $request) {
        return self::updatePests($request, 'Ogorod', 5);
    }
    public function deletePestsOgorod(Request $request) {
        return self::deletePests($request, 'Ogorod', 5);
    }


    public function createPestsSad(Request $request) {
        return self::createPests($request, 'Sad', 6);
    }
    public function showPestsSad(Request $request) {
        return self::showPests($request, 'Sad', 6, 'Сад (вредители)');
    }
    public function updatePestsSad(Request $request) {
        return self::updatePests($request, 'Sad', 6);
    }
    public function deletePestsSad(Request $request) {
        return self::deletePests($request, 'Sad', 6);
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Filters processing                                                      │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function createFilterAttributes(Request $request)
    {
        $sectionName = $request->input('creationSection');

        $section = Section::where('id', intval($request->input('creationSectionId')))
                          ->first();
        $section_id = $section ? $section->id : 0;

        $type = $request->input('creationType');
        $name = $request->input('creationName');



        if(count((array)$request->input('creationCulture')) == 0) {
            if( ! in_array(null, [$type, $name]) ) {
                $filter_attribute = Filter_attributes::create([
                    'section_id' => $section_id,
                    'culture_id' => 0,
                    'type' => $type,
                    'name' => $name
                ]);

                $request->session()->put('attrId', $filter_attribute->id);

                $request->session()->flash('success', 'Новые фильтры сорта добавлены');
            } else {
                $request->session()->flash('danger', 'Параметры нового фильтра заданы неверно');
            }
        } else {
            foreach ($request->input('creationCulture') as $culture_id) {
               if( ! in_array(null, [$type, $name]) ) {
                    $filter_attribute = Filter_attributes::create([
                        'section_id' => $section_id,
                        'culture_id' => $culture_id,
                        'type' => $type,
                        'name' => $name
                    ]);
                    $request->session()->put('culture_sorts', true);
                } else {
                    $request->session()->flash('danger', 'Параметры фильтра заданы неверно');
                }
            }
            $request->session()->flash('success', 'Новые фильтры добавлены');
        }

        return redirect()->action("AdminLTEController@showFilters$sectionName");
    }

    private function createFilter(Request $request, $section, $sectionId)
    {
        $attrId = $request->input('create_attr_id');
        $attrVal = $request->input('create_attr_val');

        $request->session()->put('attrId', $attrId);

        if(Filter_attributes::find($attrId)->culture_id != 0) {
            $request->session()->put('culture_sorts', true);
        }

        if($attrId && $attrVal) {
            $filterAttrVal = Filter_attr_value::create([
                'attribute_id' => $attrId,
                'attribute_value' => $attrVal
            ]);
            $request->session()->flash('success', 'Новое значение фильтра добавлено');
        } else {
            $request->session()->flash('danger', 'Введите значение фильтра');
        }

        return redirect()->action("AdminLTEController@showFilters$section");
    }

    private function showFilters(Request $request, $section, $sectionId, $sectionName, $type=null)
    {
        $attr_id = $request->session()->get('attrId');
        $request->session()->forget('attrId');

        $culture_sorts = $request->session()->get('culture_sorts') || $request->input('culture_sorts');
        $request->session()->forget('culture_sorts');

        $typesDictionary = $type ? [
            'pest' => 'Вредитель',
            'disease' => 'Заболевание',
            'chemical' => 'Химикат',
            'handbook' => 'Справочная',
            'seller' => 'Продавец',
            'decorator' => 'Декоратор',
            'event' => 'Событие'
        ] : [
            'culture' => 'Культура',
            'sort' => 'Сорт',
            'question' => 'Вопросы-ответы',
            'handbook' => 'Справочная'
        ];

        $attributes = [];
        if($type) {
            foreach (Filter_attributes::where('section_id', $sectionId)
                                      ->where('type', $type)->get() as $attr) {
                $attributes[$attr->id] = [
                    'name' => $attr->name,
                    'type' => $typesDictionary[$attr->type]
                ];
            }
        } else {
            foreach (Filter_attributes::where('section_id', $sectionId)
                                      ->whereNotIn('type', ['pest', 'disease'])->get() as $attr) {
                $attributes[$attr->id] = [
                    'name' => $attr->name,
                    'type' => $typesDictionary[$attr->type],
                    'culture' => Culture::find($attr->culture_id) ? Culture::find($attr->culture_id)->name : null
                ];
            }
        }
        if($type == 'pest' || $type == 'disease') {
            foreach (Filter_attributes::where('type', $type)->get() as $attr) {
                $attributes[$attr->id] = [
                    'name' => $attr->name,
                    'type' => $type,
                    'section' => Section::where('id', $attr->section_id)->first() ? Section::where('id', $attr->section_id)->first()->name : null
                ];
            }
        }

        $values = [];
        foreach ($attributes as $attrId => $attr) {
            foreach(Filter_attr_value::where('attribute_id', $attrId)->get() as $val) {
                $values[$attrId][$val->id] = $val->attribute_value;
            }
        }

        $cultures = [];
        foreach (Culture::where('section_id', $sectionId)->get() as $culture) {
            $cultures[$culture->id] = $culture;
        }

        $sections = [];
        foreach (Section::all() as $sectionObj) {
            $sections[$sectionObj->id] = $sectionObj->name;
        }

        return view('admin.forms.filters', [
            'activeMenu' => 'tables',
            'section' => $section,
            'sectionId' => $sectionId,
            'modelName' => $sectionName,
            'attributes' => $attributes,
            'values' => $values,
            'types' => $type ? [$type => $typesDictionary[$type]] : $typesDictionary,
            'attr_id' => $attr_id,
            'cultures' => $cultures,
            'sections' => $sections,
            'culture_sorts' => $culture_sorts ? true : false
        ]);
    }

    private function updateFilters(Request $request, $section, $sectionId, $type=null)
    {
        $attr_id = $request->input('attr_id');
        $attr_name = $request->input("attr_{$attr_id}_name");
        if($attr_id && $attr_name) {
            $filter_attribute = Filter_attributes::where('id', $request->input('attr_id'))->first();
            $filter_attribute->name = $request->input("attr_{$filter_attribute->id}_name");
            $filter_attribute->save();

            $request->session()->flash('success', 'Название фильтра обновлено');

            $request->session()->put('attrId', $request->input('attr_id'));
            if($filter_attribute->culture_id != 0) {
                $request->session()->put('culture_sorts', true);
            }

            return redirect()->action("AdminLTEController@showFilters$section");
        }

        $request->session()->put('attrId', $request->input('attr_id'));

        if ($type) {
            if($type == 'pest' || $type == 'disease') {
                $attributes = Filter_attributes::where('type', $type)->get();
            } else {
               $attributes = Filter_attributes::where('section_id', $sectionId)->where('type', $type)->get();
            }
        } else {
            $attributes = Filter_attributes::where('section_id', $sectionId)->get();
        }

        foreach ($attributes as $attr) {
            foreach(Filter_attr_value::where('attribute_id', $attr->id)->get() as $val) {
                $input = $request->input('attr_'.$attr->id.'_val_'.$val->id);
                $filterVal = Filter_attr_value::where('id', $val->id)
                                              ->where('attribute_id', $attr->id)
                                              ->first();
                if($input && $filterVal) {
                    $filterVal->attribute_value = $input;
                    $filterVal->save();
                }

                if ($request->input('attr_'.$attr->id.'_val_'.$val->id.'_delete')) {
                    Filter_attr_value::where('id', $val->id)->first()->delete();
                    Filter_attr_entity::where('attribute_value', $val->id)->delete();
                }
            }
        }

        $request->session()->flash('success', 'Значения фильтров обновлены');
        return redirect()->action("AdminLTEController@showFilters$section");
    }

    public function deleteFilter(Request $request)
    {
        $section = $request->input('section');
        $filter_id = $request->input('filter_id');

        if(Filter_attributes::find($filter_id)->culture_id != 0) {
            $request->session()->put('culture_sorts', true);
        }

        $fliter_values = Filter_attr_value::where('attribute_id', $filter_id);
        if($fliter_values) {
            $fliter_values->delete();
        }
        $fliter_entities = Filter_attr_entity::where('attribute_id', $filter_id);
        if($fliter_entities) {
            $fliter_entities->delete();
        }
        Filter_attributes::find($filter_id)->delete();

        $request->session()->flash('success', 'Фильтр удалён');
        return redirect()->action("AdminLTEController@showFilters$section");
    }


    public function createFilterKlumba(Request $request) {
        return self::createFilter($request, 'Klumba', 4);
    }
    public function showFiltersKlumba(Request $request) {
        return self::showFilters($request, 'Klumba', 4, 'Клумба (фильтры)');
    }
    public function updateFiltersKlumba(Request $request) {
        return self::updateFilters($request, 'Klumba', 4);
    }


    public function createFilterOgorod(Request $request) {
        return self::createFilter($request, 'Ogorod', 5);
    }
    public function showFiltersOgorod(Request $request) {
        return self::showFilters($request, 'Ogorod', 5, 'Огород (фильтры)');
    }
    public function updateFiltersOgorod(Request $request) {
        return self::updateFilters($request, 'Ogorod', 5);
    }


    public function createFilterSad(Request $request) {
        return self::createFilter($request, 'Sad', 6);
    }
    public function showFiltersSad(Request $request) {
        return self::showFilters($request, 'Sad', 6, 'Сад (фильтры)');
    }
    public function updateFiltersSad(Request $request) {
        return self::updateFilters($request, 'Sad', 6);
    }


    public function createFilterPests(Request $request) {
        return self::createFilter($request, 'Pests', 0);
    }
    public function showFiltersPests(Request $request) {
        return self::showFilters($request, 'Pests', 0, 'Вредители (фильтры)', 'pest');
    }
    public function updateFiltersPests(Request $request) {
        return self::updateFilters($request, 'Pests', 0, 'pest');
    }


    public function createFilterDiseases(Request $request) {
        return self::createFilter($request, 'Diseases', 0);
    }
    public function showFiltersDiseases(Request $request) {
        return self::showFilters($request, 'Diseases', 0, 'Заболевания (фильтры)', 'disease');
    }
    public function updateFiltersDiseases(Request $request) {
        return self::updateFilters($request, 'Diseases', 0, 'disease');
    }


    public function createFilterChemicals(Request $request) {
        return self::createFilter($request, 'Chemicals', 0);
    }
    public function showFiltersChemicals(Request $request) {
        return self::showFilters($request, 'Chemicals', 0, 'Химикаты (фильтры)', 'chemical');
    }
    public function updateFiltersChemicals(Request $request) {
        return self::updateFilters($request, 'Chemicals', 0, 'chemical');
    }


    public function createFilterHandbooks(Request $request) {
        return self::createFilter($request, 'Handbooks', 0);
    }
    public function showFiltersHandbooks(Request $request) {
        return self::showFilters($request, 'Handbooks', 0, 'Справочная информация (фильтры)', 'handbook');
    }
    public function updateFiltersHandbooks(Request $request) {
        return self::updateFilters($request, 'Handbooks', 0, 'handbook');
    }


    public function createFilterSellers(Request $request) {
        return self::createFilter($request, 'Sellers', 0);
    }
    public function showFiltersSellers(Request $request) {
        return self::showFilters($request, 'Sellers', 0, 'Продавцы (фильтры)', 'seller');
    }
    public function updateFiltersSellers(Request $request) {
        return self::updateFilters($request, 'Sellers', 0, 'seller');
    }


    public function createFilterDecorators(Request $request) {
        return self::createFilter($request, 'Decorators', 0);
    }
    public function showFiltersDecorators(Request $request) {
        return self::showFilters($request, 'Decorators', 0, 'Декораторы (фильтры)', 'decorator');
    }
    public function updateFiltersDecorators(Request $request) {
        return self::updateFilters($request, 'Decorators', 0, 'decorator');
    }


    public function createFilterEvents(Request $request) {
        return self::createFilter($request, 'Events', 0);
    }
    public function showFiltersEvents(Request $request) {
        return self::showFilters($request, 'Events', 0, 'События (фильтры)', 'event');
    }
    public function updateFiltersEvents(Request $request) {
        return self::updateFilters($request, 'Events', 0, 'event');
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Categories processing                                                   │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function createCategories(Request $request)
    {
        Category::create([
            'type' => $request->input('creationType'),
            'category' => $request->input('creationCategory') ?? '',
            'feature' => $request->input('creationCategoryFeature') ?? ''
        ]);

        $request->session()->flash('success', 'Новая категория добавлена');
        return redirect()->action("AdminLTEController@showCategories");
    }

    public function showCategories()
    {

        return view('admin.forms.categories', [
            'activeMenu' => 'tables',
            'modelName' => 'Категории',
            'rows' => Category::all(),
            'types' => ['sort' => 'Сорт', 'chemical' => 'Химикат']
        ]);
    }

    public function updateCategories(Request $request)
    {
        foreach (Category::all() as $category) {
            if($request->input("category_{$category->id}_for_delete")) {
                $category->delete();
                continue;
            }

            $category->type = $request->input("category_{$category->id}_type");
            $category->category = $request->input("category_{$category->id}_category") ?? '';
            $category->feature = $request->input("feature_{$category->id}_category") ?? '';

            $category->save();
        }

        $request->session()->flash('success', 'Категории обновлены');
        return redirect()->action("AdminLTEController@showCategories");
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Characteristics processing                                              │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function createCharacteristics(Request $request)
    {
        $name = $request->input('creationName');
        $charact = Sort_characteristic::create([
            'name' => $name,
            'icon_path' => ''
        ]);

        $icon_path = $request->file('creationIconPath');
        if($icon_path) {
            $extension = $icon_path->getClientOriginalExtension();
            $filename = 'characteristic_'.$charact->id.'_photo.'.$extension;

            $charact->icon_path = $filename;

            $icon_path->storeAs("public", $filename);
        }

        $charact->save();

        $request->session()->flash('success', 'Новая характеристика добавлена');
        return redirect()->action("AdminLTEController@showCharacteristics");
    }

    public function showCharacteristics()
    {
        return view('admin.forms.characteristics', [
            'activeMenu' => 'tables',
            'modelName' => 'Характеристики',
            'rows' => Sort_characteristic::all()
        ]);
    }

    public function updateCharacteristics(Request $request)
    {
        foreach (Sort_characteristic::all() as $characteristic) {
            $forDelete = $request->input('characteristic_'.$characteristic->id.'_delete');

            if($forDelete) {
                Storage::delete("public/$characteristic->icon_path");
                $characteristic->delete();
                continue;
            }

            $name = $request->input("name_$characteristic->id");
            if($name) {
                $characteristic->name = $name;
            }

            $icon_path = $request->file('icon_path_'.$characteristic->id);
            if($icon_path) {
                $extension = $icon_path->getClientOriginalExtension();
                $filename = 'characteristic_'.$characteristic->id.'_photo.'.$extension;

                $characteristic->icon_path = $filename;

                $icon_path->storeAs("public", $filename);
            }

            $characteristic->save();
        }

        $request->session()->flash('success', 'Характеристики обновлены');
        return redirect()->action("AdminLTEController@showCharacteristics");
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Handbooks processing                                                    │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function createHandbooks(Request $request)
    {
        $handbook = Handbook::create([
            'title' => $request->input("creationTitle") ?? '',
            'description' => $request->input("creationDescription") ?? '',
            'full_description' => $request->input("creationFullDescription") ?? '',
            'main_photo' => '',
            'section_id' => $request->input("creationSectionId"),
            'category_id' => $request->input("creationCategoryId"),
            'culture_id' => $request->input("creationCultureId"),
            'date' => new \DateTime(),
            'comments_count' => 0,
            'user_id' => 0
        ]);

        if($main_photo = $request->file("creationMainPhoto")) {
            $extension = $main_photo->getClientOriginalExtension();
            $filename = "handbook_{$handbook->id}_photo.{$extension}";

            $main_photo->storeAs("public", $filename);

            $culture_photo_obj = Photos::create([
                'path' => $filename,
                'is_main' => 1,
                'item_id' => $handbook->id,
                'type' => 'handbook',
                'moderator' => 'accepted',
                'path' => $filename
            ]);

            $handbook->main_photo = $filename;
            $handbook->save();
        }

        $newValues = [];
        foreach (Filter_attributes::where('type', 'handbook')->get() as $attribute) {
            foreach (Filter_attr_value::where('attribute_id', $attribute->id)->get() as $value) {
                if($request->input("creation_attribute_{$attribute->id}_value_{$value->id}")) {
                    array_push($newValues, $value->id);
                }
            }
        }

        foreach ($newValues as $valueIdForAdding) {
            Filter_attr_entity::create([
                'entity_id' => $handbook->id,
                'entity_type' => 'handbook',
                'attribute_id' => Filter_attr_value::where('id', $valueIdForAdding)->first()->attribute_id,
                'attribute_value' => $valueIdForAdding,
            ]);
        }

        $request->session()->flash('success', 'Справочная информация добавлена');
        return redirect()->action("AdminLTEController@showHandbooks");
    }

    public function showHandbooks(Request $request)
    {

        $handbook_id = $request->session()->get('id');
        $request->session()->forget('handbook_id');

        $attributesDictionary = [];
        foreach (Filter_attributes::where('type', 'handbook')->where('section_id', 0)->get() as $attribute) {
            $attributesDictionary[$attribute->id] = $attribute->name;
        }

        $attributeValuesDictionary = [];
        foreach ($attributesDictionary as $attributeId => $attribute) {
            foreach (Filter_attr_value::where('attribute_id', $attributeId)->get() as $value) {
                $attributeValuesDictionary[$attributeId][$value->id] = $value->attribute_value;
            }
        }

        $rows = [];
        foreach (Handbook::all() as $handbook) {

            $attributes = [];
            foreach ($attributesDictionary as $id => $attribute) {
                foreach (Filter_attr_entity::where('attribute_id', $id)
                                           ->where('entity_type', 'handbook')
                                           ->where('entity_id', $handbook->id)->get() as $value) {
                    $attributes[$id][$value->attribute_value] = $value;
                }
            }

            $rows[$handbook->id] = $handbook;
            $rows[$handbook->id]["user"] = User::find($handbook->user_id);
            $rows[$handbook->id]["photos"] = Photos::where('type', 'handbook')->where('item_id', $handbook->id)->get();
            $rows[$handbook->id]["attributes"] = $attributes;
        }

        $sections = [];
        foreach (Section::all() as $section) {
            $sections[$section->id] = $section;
        }

        $cultures = [];
        foreach (Culture::all() as $culture) {
            $cultures[$culture->id] = $culture;
        }

        $categories = [];
        foreach (Filter_attr_value::whereIn('attribute_id', Filter_attributes::where('type', 'handbook')
                                                                             ->where('section_id', '!=', 0)
                                                                             ->get()
                                                                             ->pluck('id')
                                                                             ->toArray())->get() as $category) {
            $categories[$category->id] = $category;
            $categories[$category->id]["section_id"] = Filter_attributes::find($category->attribute_id)->section_id;
        }

        $handbook_files = [];
        foreach (Article::all() as $article) {
            $handbook_files[$article->id] = $article;
            $handbook_files[$article->id]["user"] = User::find($article->user_id);
        }

        return view('admin.forms.handbooks', [
            'activeMenu' => 'tables',
            'modelName' => 'Справочная информация',
            'rows' => $rows,
            'handbook_id' => $handbook_id,
            'sections' => $sections,
            'cultures' => $cultures,
            'categories' => $categories,
            'handbook_files' => $handbook_files,
            'attributesDictionary' => $attributesDictionary,
            'attributeValuesDictionary' => $attributeValuesDictionary
        ]);
    }

    public function updateHandbooks(Request $request)
    {
        if($request->input("handbookFilesUpdating")) {
            foreach(Article::all() as $article) {
                if($request->input("handbook_file_{$article->id}_for_delete")) {
                    Storage::delete("public/{$article->path}");
                    $article->delete();
                    continue;
                }
                if($request->input("handbook_file_{$article->id}_moderator")) {
                    $article->moderator = $request->input("handbook_file_{$article->id}_moderator");
                    $article->save();
                }
            }

            $request->session()->flash('success', 'Справочная информация обновлена');
            return redirect()->action("AdminLTEController@showHandbooks");
        }

        $id = $request->input('id');
        $request->session()->put('handbook_id', $id);

        if($handbook = Handbook::find($id)) {
            $handbook->title = $request->input("title_{$id}") ?? '';
            $handbook->description = $request->input("description_{$id}") ?? '';
            $handbook->full_description = $request->input("full_description_{$id}") ?? '';

            $handbook->save();
        }

        if($handbook_new_photos = $request->file("handbook_photos_{$id}")) {
            foreach ($handbook_new_photos as $new_photo) {
                $extension = $new_photo->getClientOriginalExtension();
                $filename = uniqid("handbook_{$id}_photo_").".$extension";
                $new_photo->storeAs("public", $filename);

                Photos::create([
                    'path' => $filename,
                    'is_main' => 0,
                    'item_id' => $id,
                    'type' => 'handbook',
                    'moderator' => 'accepted'
                ]);
            }
        }

        foreach (Photos::where('type', 'handbook')->where('item_id', $id)->get() as $photo) {
            if($request->input("for_delete_{$photo->id}")) {
                Storage::delete("public/{$photo->path}");
                Photos::find($photo->id)->delete();
                continue;
            }
        }

        if($main_photo_id = $request->input("is_main")) {
            $main_photo = Photos::find($main_photo_id);
            $main_photo->is_main = 1;
            $main_photo->save();

            $handbook = Handbook::find($id);
            $handbook->main_photo = $main_photo->path;
            $handbook->save();
        }

        $oldValues = array_map(function($id) {
            return intval($id);
        }, Filter_attr_entity::where('entity_type', 'handbook')
                             ->where('entity_id', $id)
                             ->get()
                             ->pluck('attribute_value')
                             ->toArray());
        $newValues = [];
        foreach (Filter_attributes::where('type', 'handbook')->where('section_id', 0)->get() as $attribute) {
            foreach (Filter_attr_value::where('attribute_id', $attribute->id)->get() as $value) {
                if($request->input("handbook_{$id}_attribute_{$attribute->id}_value_{$value->id}")) {
                    array_push($newValues, $value->id);
                }
            }
        }
        // dd($oldValues, $newValues);

        foreach (array_diff($oldValues, $newValues) as $valueIdForDelete) {
            Filter_attr_entity::where('entity_type', 'handbook')
                              ->where('entity_id', $id)
                              ->where('attribute_value', $valueIdForDelete)
                              ->first()
                              ->delete();
        }
        foreach (array_diff($newValues, $oldValues) as $valueIdForAdding) {
            Filter_attr_entity::create([
                'entity_id' => $id,
                'entity_type' => 'handbook',
                'attribute_id' => Filter_attr_value::where('id', $valueIdForAdding)->first()->attribute_id,
                'attribute_value' => $valueIdForAdding,
            ]);
        }

        $request->session()->flash('success', 'Справочная информация обновлена');
        return redirect()->action("AdminLTEController@showHandbooks");
    }

    public function deleteHandbooks(Request $request)
    {
        $handbook_id = $request->input('id');

        foreach (Photos::where('type', 'handbook')->where('item_id', $handbook_id)->get() as $photo) {
            Storage::delete("public/$photo->path");
            $photo->delete();
        }
        Handbook::find($handbook_id)->delete();

        $request->session()->flash('success', 'Справочная информация удалена');
        return redirect()->action("AdminLTEController@showHandbooks");
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Events processing                                                       │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function createEvents(Request $request)
    {
        $event = Event::create([
            'user_id' => 0,
            'partymaker' => $request->input('partymaker'),
            'title' => $request->input('creationTitle') ?? '',
            'date' => $request->input('creationDate') ?? new \DateTime(),
            'event_category_id' => 0,// $request->input('creationEventCategoryId'),
            'description' => $request->input('creationDescription') ?? '',
            'participants' => 0,
            'main_photo' => ''
        ]);

        $main_photo = $request->file('creationMainPhoto');
        if($main_photo) {
            $extension = $main_photo->getClientOriginalExtension();
            $filename = uniqid('event_'.$event->id.'_photo_').".$extension";
            $main_photo->storeAs("public", $filename);

            Photos::create([
                'path' => $filename,
                'is_main' => 1,
                'item_id' => $event->id,
                'type' => 'event',
                'moderator' => 'accepted'
            ]);

            $event->main_photo = $filename;
        }

        $newValues = [];
        foreach (Filter_attributes::where('type', 'event')->get() as $attribute) {
            foreach (Filter_attr_value::where('attribute_id', $attribute->id)->get() as $value) {
                if($request->input("creation_attribute_{$attribute->id}_value_{$value->id}")) {
                    array_push($newValues, $value->id);
                }
            }
        }

        foreach ($newValues as $valueIdForAdding) {
            Filter_attr_entity::create([
                'entity_id' => $event->id,
                'entity_type' => 'event',
                'attribute_id' => Filter_attr_value::where('id', $valueIdForAdding)->first()->attribute_id,
                'attribute_value' => $valueIdForAdding,
            ]);
        }

        $event->save();


        $request->session()->flash('success', 'Новое событие добавлено');
        return redirect()->action("AdminLTEController@showEvents");
    }

    public function showEvents(Request $request)
    {


        $event_id = $request->session()->get('event_id');
        $request->session()->forget('event_id');

        $attributesDictionary = [];
        foreach (Filter_attributes::where('type', 'event')->get() as $attribute) {
            $attributesDictionary[$attribute->id] = $attribute->name;
        }

        $attributeValuesDictionary = [];
        foreach ($attributesDictionary as $attributeId => $attribute) {
            foreach (Filter_attr_value::where('attribute_id', $attributeId)->get() as $value) {
                $attributeValuesDictionary[$attributeId][$value->id] = $value->attribute_value;
            }
        }



        $rows = [];
        foreach (Event::all() as $event) {

            $attributes = [];
            foreach ($attributesDictionary as $id => $attribute) {
                foreach (Filter_attr_entity::where('attribute_id', $id)
                                           ->where('entity_type', 'event')
                                           ->where('entity_id', $event->id)->get() as $value) {
                    $attributes[$id][$value->attribute_value] = $value;
                }
            }

            $rows[$event->id] = [
                'id' => $event->id,
                'user' => User::where('id', $event->user_id)->first(),
                'partymaker' => $event->partymaker,
                'profile' => Profile::where('user_id', $event->user_id)->first(),
                'title' => $event->title,
                'date' => $event->date,
                'attributes' => $attributes,
                'description' => $event->description,
                'participants' => $event->participants,
                'main_photo' => $event->main_photo
            ];
        }
        $partymaker = [];
        foreach (DB::select('select * from profiles where is_partymaker = ?', [1]) as $userParty) {
            $partymaker[$userParty->user_id] = $userParty->first_name . ' ' . $userParty->last_name;
        }



        return view('admin.forms.events', [
            'activeMenu' => 'tables',
            'modelName' => 'События',
            'rows' => $rows,
            'categories' => array_unique(Event::all()->pluck('event_category_id')->toArray()),
            'attributesDictionary' => $attributesDictionary,
            'attributeValuesDictionary' => $attributeValuesDictionary,
            'event_id' => $event_id,
            'partymaker' => $partymaker
        ]);
    }

    public function updateEvents(Request $request)
    {
        $id = $request->input('event_id');

        $request->session()->put('event_id', $id);

        $event = Event::where('id', $id)->first();
        $event->title = $request->input('event_title') ?? '';
        $event->description = $request->input('event_description') ?? '';
        $event->partymaker = $request->input('partymaker');

        $main_photo = $request->file('event_main_photo');
        if($main_photo) {
            if($old_photo = Photos::where('type', 'event')->where('item_id', $id)->first()) {
                Storage::delete("public/$old_photo->path");
                $old_photo->delete();
            }

            $extension = $main_photo->getClientOriginalExtension();
            $filename = uniqid('event_'.$id.'_photo_').".$extension";
            $main_photo->storeAs("public", $filename);

            Photos::create([
                'path' => $filename,
                'is_main' => 1,
                'item_id' => $id,
                'type' => 'event',
                'moderator' => 'accepted'
            ]);

            $event->main_photo = $filename;
        }

        $oldValues = array_map(function($id) {
            return intval($id);
        }, Filter_attr_entity::where('entity_type', 'event')
                             ->where('entity_id', $id)
                             ->get()
                             ->pluck('attribute_value')
                             ->toArray());
        $newValues = [];
        foreach (Filter_attributes::where('type', 'event')->get() as $attribute) {
            foreach (Filter_attr_value::where('attribute_id', $attribute->id)->get() as $value) {
                if($request->input("event_{$id}_attribute_{$attribute->id}_value_{$value->id}")) {
                    array_push($newValues, $value->id);
                }
            }
        }

        foreach (array_diff($oldValues, $newValues) as $valueIdForDelete) {
            Filter_attr_entity::where('entity_type', 'event')
                              ->where('entity_id', $id)
                              ->where('attribute_value', $valueIdForDelete)
                              ->first()
                              ->delete();
        }
        foreach (array_diff($newValues, $oldValues) as $valueIdForAdding) {
            Filter_attr_entity::create([
                'entity_id' => $id,
                'entity_type' => 'event',
                'attribute_id' => Filter_attr_value::where('id', $valueIdForAdding)->first()->attribute_id,
                'attribute_value' => $valueIdForAdding,
            ]);
        }

        $event->save();

        $request->session()->flash('success', 'События обновлены');
        return redirect()->action("AdminLTEController@showEvents");
    }

    public function deleteEvents(Request $request)
    {
        $event_id = $request->input('event_id');

        foreach (Photos::where('item_id', $event_id)->where('type', 'event')->get() as $photo) {
            Storage::delete("public/$photo->path");
            $photo->delete();
        }

        Event::where('id', $event_id)->first()->delete();
        foreach(Event_participant::where('event_id', $event_id)->get() as $event_participant) {
            $event_participant->delete();
        }

        $request->session()->flash('success', 'Событие удалено');
        return redirect()->action("AdminLTEController@showEvents");
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Moderate processing                                                     │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function createModeratePhotos(Request $request)
    {
        $creation_type = $request->input("creation_type");
        $creation_item_id = $request->input("creation_item_id");
        $creation_photo = $request->file("creation_photo");

        $extension = $creation_photo->getClientOriginalExtension();

        $filename = uniqid("{$creation_type}_{$creation_item_id}_photo_").".$extension";
        $creation_photo->storeAs("public", $filename);

        $photo = Photos::create([
            'path' => $filename,
            'is_main' => 0,
            'item_id' => $creation_item_id,
            'type' => $creation_type,
            'moderator' => 'accepted'
        ]);

        $photo->save();

        $request->session()->flash('success', 'Новое фото добавлено');
        return redirect()->action("AdminLTEController@showModeratePhotos");
    }

    public function createModerateResponses(Request $request)
    {
        $answers_response_id = $request->input('answers_response_id');
        if($answers_response_id) {
            Responses_answer::create([
                'response_id' => $answers_response_id,
                'user_id' => 0,
                'profile_id' => 0,
                'response' => $request->input('creation_response') ?? '',
                'date' => date('Y-m-d'),
                'moderator' => 'accepted'
            ]);
            $request->session()->flash('success', 'Новый ответ добавлен');
        } else {
            Response::create([
                'user_id' => 0,
                'item_id' => $request->input('creation_item_id'),
                'type' => $request->input('creation_type'),
                'text' => $request->input('creation_text') ?? '',
                'rating' => $request->input('creation_rating') ?? 1,
                'date' => date('Y-m-d'),
                'moderator' => 'accepted'
            ]);
            $request->session()->flash('success', 'Новый коментарий добавлен');
        }

        return redirect()->action("AdminLTEController@showModerateResponses");
    }

    public function createModerateQuestions(Request $request)
    {
        $answers_question_id = $request->input('answers_question_id');
        if($answers_question_id) {
            Question_answer::create([
                'question_id' => $answers_question_id,
                'user_id' => 0,
                'text' => $request->input('creation_text') ?? '',
                'date' => date('Y-m-d'),
                'is_best' => 0,
                'moderator' => 'accepted'
            ]);

            $question = Question::find($answers_question_id);
            $question->comments_count += 1;
            $question->save();

            $request->session()->flash('success', 'Новый ответ добавлен');
        } else {
            Question::create([
                'user_id' => 0,
                'section_id' => $request->input('creation_section_id') ?? 0,
                'title' => $request->input('creation_title') ?? '',
                'text' => $request->input('creation_text') ?? '',
                'date' => date('Y-m-d'),
                'time' => date('H:i:s'),
                'comments_count' => 0,
                'moderator' => 'accepted',
                'is_closed' => 0
            ]);
            $request->session()->flash('success', 'Новый вопрос добавлен');
        }

        return redirect()->action("AdminLTEController@showModerateQuestions");
    }


    public function showModeratePhotos()
    {
        $rows = [];
        $itemTypes = [
            'sort' => Sort::class,
            'culture' => Culture::class,
            'chemical' => Chemical::class,
            'pest' => Pest::class,
            'disease' => Disease::class,
            'event' => Event::class,
            'handbook' => Handbook::class
        ];
        foreach (Photos::all() as $photo) {
            $rows[$photo->id] = [
                'id' => $photo->id,
                'path' => $photo->path,
                'is_main' => $photo->is_main,
                'item' => $itemTypes[$photo->type]::where('id', $photo->item_id)->first(),
                'type' => $photo->type,
                'moderator' => $photo->moderator,
                'user' => $photo->user_id != 0 ? User::where('id', $photo->user_id)->first() : ['email' => 'admin'],
            ];
        }

        $types_objects = [
            'pest' => ['translated' => 'Вредитель', 'objects' => Pest::all()],
            'disease' => ['translated' => 'Заболевание', 'objects' => Disease::all()],
            'culture' => ['translated' => 'Культура', 'objects' => Culture::all()],
            'sort' => ['translated' => 'Сорт', 'objects' => Sort::all()],
            'chemical' => ['translated' => 'Химикат', 'objects' => Chemical::all()],
            'event' => ['translated' => 'Событие', 'objects' => Event::all()],
            'handbook' => ['translated' => 'Справка', 'objects' => Handbook::all()]
        ];

        return view('admin.forms.moderate_photos', [
            'activeMenu' => 'tables',
            'rows' => $rows,
            'modelName' => 'Фото (модерация)',
            'types_objects' => $types_objects
        ]);
    }

    public function showModerateVideos()
    {
        $rows = [];
        foreach (Handbook_videolinks::all() as $video) {
            $rows[$video->id] = $video;
            $rows[$video->id]["user"] = User::find($video->user_id);
            $rows[$video->id]["handbook"] = Handbook::find($video->handbook_id);
        }

        return view('admin.forms.moderate_videos', [
            'activeMenu' => 'tables',
            'rows' => $rows,
            'modelName' => 'Видео (модерация)'
        ]);
    }

    public function showModerateResponses()
    {
        $rows = [];
        $answers = [];
        $typesDictionary = [
            'sort' => Sort::class,
            'chemical' => Chemical::class,
            'decorator' => User::class,
            'seller' => User::class,
        ];
        $typesNamesDictionary = [
            'sort' => 'Сорт',
            'chemical' => 'Химикат',
            'decorator' => 'Декоратор',
            'seller' => 'Продавец'
        ];
        foreach (Response::all() as $response) {
            $rows[$response->id] = [
                'id' => $response->id,
                'user' => $response->user_id!=0 ? User::where('id', $response->user_id)->first() : ['email' => 'admin'],
                'item' => $typesDictionary[$response->type]::where('id', $response->item_id)->first(),
                'type' => $typesNamesDictionary[$response->type],
                'text' => $response->text,
                'rating' => $response->rating,
                'moderator' => $response->moderator
            ];

            $response_answers = Responses_answer::where('response_id', $response->id)->get();
            if( ! isset($answers[$response->id])) {
                $answers[$response->id] = [];
                foreach ($response_answers as $answer) {
                    array_push($answers[$response->id], [
                        'id' => $answer->id,
                        'user' => $answer->user_id!=0 ? User::where('id', $answer->user_id)->first() : ['email' => 'admin'],
                        'response' => $answer->response,
                        'date' => $answer->date,
                        'moderator' => $answer->moderator
                    ]);
                };
            }
        }

        $types_objects = [
            'sort' => ['translated' => 'Сорт', 'objects' => Sort::all()],
            'chemical' => ['translated' => 'Химикат', 'objects' => Chemical::all()],
            'decorator' => ['translated' => 'Декоратор', 'objects' => User::all()],
            'seller' => ['translated' => 'Продавец', 'objects' => User::all()]
        ];

        return view('admin.forms.moderate_responses', [
            'activeMenu' => 'tables',
            'modelName' => 'Коментарии (модерация)',
            'rows' => $rows,
            'answers' => $answers,
            'types_objects' => $types_objects
        ]);
    }

    public function showModerateQuestions()
    {
        $rows = [];
        $answers = [];
        foreach (Question::all() as $question) {
            $rows[$question->id] = [
                'id' => $question->id,
                'user' => $question->user_id!=0 ? User::where('id', $question->user_id)->first() : ['email' => 'admin'],
                'section' => $question->section_id!=0 ? Section::where('id', $question->section_id)->first() : ['name'=>''],
                'title' => $question->title,
                'text' => $question->text,
                'moderator' => $question->moderator,
                'is_closed' => $question->is_closed
            ];

            $question_answers = Question_answer::where('question_id', $question->id)->get();
            if( ! isset($answers[$question->id])) {
                $answers[$question->id] = [];
                foreach ($question_answers as $answer) {
                    array_push($answers[$question->id], [
                        'id' => $answer->id,
                        'user' => $answer->user_id!=0 ? User::where('id', $answer->user_id)->first() : ['email' => 'admin'],
                        'text' => $answer->text,
                        'date' => $answer->date,
                        'is_best' => $answer->is_best,
                        'moderator' => $answer->moderator
                    ]);
                };
            }
        }

        $sections = [];
        foreach (Section::all() as $section) {
            $sections[$section->id] = $section;
        }

        return view('admin.forms.moderate_questions', [
            'activeMenu' => 'tables',
            'modelName' => 'Вопросы-ответы (модерация)',
            'rows' => $rows,
            'answers' => $answers,
            'sections' => $sections
        ]);
    }


    public function updateModeratePhotos(Request $request)
    {
        $itemTypes = [
            'sort' => Sort::class,
            'culture' => Culture::class,
            'chemical' => Chemical::class,
            'pest' => Pest::class,
            'disease' => Disease::class,
            'event' => Event::class,
            'handbook' => Handbook::class
        ];
        foreach (Photos::all() as $photo) {
            // dd($request->input());
            if($request->input("photo_$photo->id"."_for_delete")) {
                Storage::delete("public/$photo->path");
                Photos::find($photo->id)->delete();
                continue;
            } else {
                if($request->input("is_main_$photo->id")) {
                    $photo->is_main = 1;
                    if($item = $itemTypes[$photo->type]::where('id', $photo->item_id)->first()) {
                        if($photo->type == 'culture') {
                            $item->photo = $photo->path;
                        } else {
                            $item->main_photo = $photo->path;
                        }
                        $item->save();
                    }
                } else {
                    $photo->is_main = 0;
                }
                $photo->is_main = $request->input("is_main_$photo->id") ? 1 : 0;

                $photo->moderator = $request->input("moderator_$photo->id") ?? $photo->moderator;
                $photo->save();
            }
        }

        $request->session()->flash('success', 'Фото обновлены');
        return redirect()->action("AdminLTEController@showModeratePhotos");
    }

    public function updateModerateVideos(Request $request)
    {
        foreach (Handbook_videolinks::all() as $video) {
            if($request->input("video_$video->id"."_for_delete")) {
                $video->delete();
                continue;
            }

            $video->moderator = $request->input("moderator_$video->id");
            $video->title = $request->input("title_$video->id");

            $video->save();
        }

        $request->session()->flash('success', 'Видео обновлены');
        return redirect()->action("AdminLTEController@showModerateVideos");
    }

    public function updateModerateResponses(Request $request)
    {
        $answers_response_id = $request->input('answers_response_id');
        if($answers_response_id) {
            foreach (Responses_answer::where('response_id', $answers_response_id)->get() as $answer) {
                if($request->input("response_{$answers_response_id}_answer_{$answer->id}_for_delete")) {
                    $answer->delete();
                    continue;
                }
                $new_response = $request->input("response_{$answers_response_id}_answer_{$answer->id}_response");
                $new_moderator = $request->input("response_{$answers_response_id}_answer_{$answer->id}_moderator");

                $answer->response = $new_response;
                $answer->moderator = $new_moderator;

                $answer->save();
            }
            $request->session()->flash('success', 'Ответы на коментарии обновлены');
        } else {
            foreach (Response::all() as $response) {
                if($request->input("response_{$response->id}_for_delete")) {
                    Responses_answer::where('response_id', $response->id)->delete();
                    $response->delete();
                    continue;
                }
                $response->text = $request->input("text_{$response->id}") ?? '';
                $response->moderator = $request->input("moderator_{$response->id}");
                $response->rating = $request->input("rating_{$response->id}");

                $response->save();
            }
            $request->session()->flash('success', 'Коментарии обновлены');
        }

        $request->session()->flash('success', 'Коментарии обновлены');
        return redirect()->action("AdminLTEController@showModerateResponses");
    }


    public function updateModerateQuestions(Request $request)
    {
        $answers_question_id = $request->input('answers_question_id');
        if($answers_question_id) {
            foreach (Question_answer::where('question_id', $answers_question_id)->get() as $answer) {
                if($request->input("question_{$answers_question_id}_answer_{$answer->id}_for_delete")) {
                    $answer->delete();

                    $question = Question::find($answers_question_id);
                    $question->comments_count -= 1;
                    $question->save();

                    continue;
                }
                $new_text = $request->input("question_{$answers_question_id}_answer_{$answer->id}_text");
                $new_moderator = $request->input("question_{$answers_question_id}_answer_{$answer->id}_moderator");
                $new_is_best = $request->input("question_{$answers_question_id}_answer_{$answer->id}_is_best");

                $answer->text = $new_text;
                $answer->moderator = $new_moderator;
                $answer->is_best = $new_is_best;

                $answer->save();
            }
            $request->session()->flash('success', 'Ответы на вопросы обновлены');
        } else {
            foreach (Question::all() as $question) {
                if($request->input("question_{$question->id}_for_delete")) {
                    Question_answer::where('question_id', $question->id)->delete();
                    $question->delete();
                    continue;
                }
                $question->title = $request->input("title_{$question->id}") ?? '';
                $question->text = $request->input("text_{$question->id}") ?? '';
                $question->moderator = $request->input("moderator_{$question->id}");
                $question->is_closed = $request->input("is_closed_{$question->id}");
                $question->save();
            }
            $request->session()->flash('success', 'Вопросы обновлены');
        }

        return redirect()->action("AdminLTEController@showModerateQuestions");
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ FrontText processing                                                    │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function showFrontText()
    {
        return view('admin.forms.front_text', [
            'activeMenu' => 'tables',
            'main_page_infos' => Main_page_info::all(),
            'sections' => Section::all(),
            'footers' => Footer::all()
        ]);
    }

    public function updateFrontText(Request $request)
    {
        foreach (Main_page_info::all() as $main_page_info) {
            $main_page_info->title = $request->input("main_page_info_{$main_page_info->id}_title") ?? '';
            $main_page_info->text = $request->input("main_page_info_{$main_page_info->id}_text") ?? '';
            $main_page_info->save();
        }

        foreach (Section::all() as $section) {
            $section->title = $request->input("section_{$section->id}_title") ?? '';
            $section->text = $request->input("section_{$section->id}_text") ?? '';
            $section->save();
        }

        foreach (Footer::all() as $footer) {
            $footer->order = $request->input("footer_{$footer->id}_order") ?? 0;
            $footer->text = $request->input("footer_{$footer->id}_text") ?? '';
            $footer->save();
        }

        $request->session()->flash('success', 'Текст обновлен');
        return redirect()->action("AdminLTEController@showFrontText");
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Ethnosciences processing                                                │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function createEthnosciences(Request $request)
    {
        $ethnoscience = Ethnoscience::create([
            'title' => $request->input("creationTitle") ?? '',
            'description' => $request->input("creationDescription") ?? '',
            'start_day' => $request->input("creationStartDay") ?? 1,
            'start_month' => $request->input("creationStartMonth") ?? 1,
            'end_day' => $request->input("creationEndDay") ?? 1,
            'end_month' => $request->input("creationEndMonth") ?? 1,
        ]);

        $start = $ethnoscience->start_month;
        $end = $ethnoscience->end_month;

        $new_months = $start <= $end ? range($start, $end) : array_merge(range($start, 12), range(1, $end));

        foreach($new_months as $month_to_add) {
            Ethnoscience_month::create([
                'ethnoscience_id' => $ethnoscience->id,
                'month' => $month_to_add
            ]);
        }

        $request->session()->flash('success', 'Новая примета добавлена');
        return redirect()->action('AdminLTEController@showEthnosciences');
    }

    public function showEthnosciences()
    {
        $rows = [];
        foreach (Ethnoscience::all() as $ethnoscience) {
            $id = $ethnoscience->id;
            $rows[$id] = $ethnoscience;
            $rows[$id]["months"] = Ethnoscience_month::where('ethnoscience_id', $id)->get();
        }

        return view('admin.forms.ethnosciences', [
            'activeMenu' => 'tables',
            'modelName' => 'Народный календарь',
            'rows' => $rows
        ]);
    }

    public function updateEthnosciences(Request $request)
    {
        foreach (Ethnoscience::all() as $ethnoscience) {
            $id = $ethnoscience->id;

            if($request->input("ethnoscience_{$id}_for_delete")) {
                foreach(Ethnoscience_month::where('ethnoscience_id', $id)->get() as $month) {
                    $month->delete();
                }
                $ethnoscience->delete();
                continue;
            }

            $ethnoscience->title = $request->input("ethnoscience_{$id}_title") ?? '';
            $ethnoscience->description = $request->input("ethnoscience_{$id}_description") ?? '';
            $ethnoscience->start_day = intval($request->input("ethnoscience_{$id}_start_day")) ?? 1;
            $ethnoscience->start_month = intval($request->input("ethnoscience_{$id}_start_month")) ?? 1;
            $ethnoscience->end_day = intval($request->input("ethnoscience_{$id}_end_day")) ?? 1;
            $ethnoscience->end_month = intval($request->input("ethnoscience_{$id}_end_month")) ?? 1;

            $ethnoscience->save();

            $start = $ethnoscience->start_month;
            $end = $ethnoscience->end_month;

            $cur_months = Ethnoscience_month::where('ethnoscience_id', $id)->get()->pluck('month')->toArray();
            $new_months = $start <= $end ? range($start, $end) : array_merge(range($start, 12), range(1, $end));

            foreach(array_diff($new_months, $cur_months) as $month_to_add) { // Add months
                Ethnoscience_month::create(['ethnoscience_id' => $id, 'month' => $month_to_add]);
            }
            foreach(array_diff($cur_months, $new_months) as $month_to_remove) { // Remove months
                Ethnoscience_month::where('ethnoscience_id', $id)->where('month', $month_to_remove)->first()->delete();
            }
        }

        $request->session()->flash('success', 'Приметы обновлены');
        return redirect()->action("AdminLTEController@showEthnosciences");
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ MoonPhases processing                                                   │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function createMoonDates(Request $request)
    {
        Moon_date::create([
            'date' => $request->input("creationDate") ?? new \DateTime(),
            'phase_id' => $request->input("creationPhaseId"),
            'element' => $request->input("creationElement")
        ]);

        $request->session()->flash('success', 'Новый лунный день добавлен');
        return redirect()->action("AdminLTEController@showMoonDates");
    }

    public function showMoonDates()
    {
        $rows = [];
        foreach (Moon_date::all() as $date) {
            $rows[$date->id] = $date;
            $rows[$date->id]['phase'] = Moon_phase::find($date->phase_id);
        }

        return view('admin.forms.moon_dates', [
            'activeMenu' => 'tables',
            'modelName' => 'Лунные дни',
            'rows' => $rows,
            'phases' => Moon_phase::all()
        ]);
    }

    public function updateMoonDates(Request $request)
    {
        foreach (Moon_date::all() as $date) {
            if($request->input("moon_date_{$date->id}_for_delete")) {
                $date->delete();
                continue;
            }
            $date->date = $request->input("moon_date_{$date->id}_date") ?? new \DateTime();
            $date->phase_id = $request->input("moon_date_{$date->id}_phase_id");
            $date->element = $request->input("moon_date_{$date->id}_element");

            $date->save();
        }
        $request->session()->flash('success', 'Лунные дни обновлены');
        return redirect()->action("AdminLTEController@showMoonDates");
    }


    public function createMoonPhases(Request $request)
    {
        $name = $request->input('creationTitle') ?? '';
        $phase = Moon_phase::create([
            'title' => $request->input('creationTitle') ?? '',
            'phase_type' => $request->input('creationPhaseType') ?? '',
            'icon' => ''
        ]);

        if($icon = $request->file('creationIcon')) {
            $extension = $icon->getClientOriginalExtension();
            $filename = "{$phase->id}.{$extension}";
            $phase->icon = $filename;
            $icon->storeAs("public", $filename);
        }

        $phase->save();

        $request->session()->flash('success', 'Новая лунная фаза добавлена');
        return redirect()->action("AdminLTEController@showMoonPhases");
    }

    public function showMoonPhases()
    {
        return view('admin.forms.moon_phases', [
            'activeMenu' => 'tables',
            'modelName' => 'Фазы луны',
            'rows' => Moon_phase::all()
        ]);
    }

    public function updateMoonPhases(Request $request)
    {
        foreach (Moon_phase::all() as $phase) {
            if($request->input("moon_phase_{$phase->id}_for_delete")) {
                Storage::delete("public/moon/$phase->icon");
                $phase->delete();
                continue;
            }

            if($new_icon = $request->file("moon_phase_{$phase->id}_new_icon")) {
                $extension = $new_icon->getClientOriginalExtension();
                $filename = "{$phase->id}.{$extension}";
                $phase->icon = $filename;
                $new_icon->storeAs("public", $filename);
            }

            $phase->title = $request->input("moon_phase_{$phase->id}_title") ?? '';
            $phase->phase_type = $request->input("moon_phase_{$phase->id}_phase_type");

            $phase->save();
        }

        $request->session()->flash('success', 'Фазы лунного календаря обновлены');
        return redirect()->action("AdminLTEController@showMoonPhases");
    }


    public function showMoonActions()
    {
        return view('admin.forms.moon_actions', [
            'activeMenu' => 'tables',
            'modelName' => 'Действия',
            'rows' => Sort_operation::all()
        ]);
    }

    public function updateMoonActions(Request $request)
    {
        foreach(Sort_operation::all() as $action) {
            if($request->input("action_{$action->id}_for_delete")) {
                Storage::delete("public/$action->icon_path");
                $action->delete();
                continue;
            }

            $action->operation_name = $request->input("action_{$action->id}_operation_name") ?? '';

            if($icon_path = $request->file("action_{$action->id}_icon_path")) {
                $extension = $icon_path->getClientOriginalExtension();
                $filename = "{$action->id}.{$extension}";

                $action->icon_path = "actions/{$filename}";

                $icon_path->storeAs("public", "actions/{$filename}");
            }

            $action->save();
        }

        $request->session()->flash('success', 'Действия для лунного календаря обновлены');
        return redirect()->action("AdminLTEController@showMoonActions");
    }


    protected function showMoonPhasesSection(Request $request, $section, $sectionId, $sectionName)
    {
        $filter_attribute = Filter_attributes::where('section_id', $sectionId)
                                             ->where('type', 'culture')
                                             ->where('culture_id', 0)
                                             ->where('name', $section == 'Klumba' ? 'По назначению' : 'По морфологическому признаку')
                                             ->first();
        $filtered_plants = [];
        $plant_operations = [];
        if($filter_attribute) {
            $elementDict = ['вода' => 'water', 'земля' => 'earth', 'огонь' => 'fire', 'воздух' => 'air'];
            $phaseDict = ['полнолуние' => 'full', 'растущая' => 'growing', 'убывающая' => 'waning', 'новолуние' => 'new'];
            $typeDict = ['рекомендовано' => 'good', 'не рекомендовано' => 'bad', 'нейтрально' => ''];

            $plants = Filter_attr_value::where('attribute_id', $filter_attribute->id)->get();
            foreach($plants as $plant) {
                $filtered_plants[$plant->id] = $plant;
            }

            foreach(Moon_action::whereIn('plant_attribute', $plants->pluck('id')->toArray())->get() as $action) {
                $key = "plant_{$action->plant_attribute}_{$elementDict[$action->element]}_{$phaseDict[$action->phase_type]}_moon_{$typeDict[$action->value]}_operations";
                if(! isset($plant_operations[$key])) {
                    $plant_operations[$key] = [];
                }
                array_push($plant_operations[$key], $action->sort_operation_id);
            }
        }

        $operations = Sort_operation::all();

        return view('admin.forms.moon_phases_section', [
            'activeMenu' => 'tables',
            'modelName' => $sectionName,
            'section' => $section,
            'filtered_plants' => $filtered_plants,
            'operations' => $operations,
            'plant_operations' => $plant_operations
        ]);
    }

    protected function updateMoonPhasesSection(Request $request, $section, $sectionId, $sectionName)
    {
        $filter_attribute = Filter_attributes::where('section_id', $sectionId)
                                             ->where('type', 'culture')
                                             ->where('culture_id', 0)
                                             ->where('name', $section == 'Klumba' ? 'По назначению' : 'По морфологическому признаку')
                                             ->first();
        if($filter_attribute) {
            $elementDict = ['water' => 'вода', 'earth' => 'земля', 'fire' => 'огонь', 'air' => 'воздух'];
            $phaseDict = ['full' => 'полнолуние', 'growing' => 'растущая', 'waning' => 'убывающая', 'new' => 'новолуние'];
            $all_ops = Sort_operation::all();

            foreach(Filter_attr_value::where('attribute_id', $filter_attribute->id)->get() as $plant) {
                foreach($elementDict as $element => $translatedElement) {
                    foreach($phaseDict as $phase => $translatedPhase) {
                        $new_good_ops = array_map(function($op_id) {
                            return intval($op_id);
                        }, $request->input("plant_{$plant->id}_{$element}_{$phase}_moon_good_operations") ?? []);
                        $new_bad_ops = array_map(function($op_id) {
                            return intval($op_id);
                        }, $request->input("plant_{$plant->id}_{$element}_{$phase}_moon_bad_operations") ?? []);

                        foreach ($all_ops as $op) {
                            if(in_array($op->id, $new_good_ops)) {
                                $value = 'рекомендовано';
                            }
                            if(in_array($op->id, $new_bad_ops)) {
                                $value = 'не рекомендовано';
                            }
                            if(! in_array($op->id, array_merge($new_good_ops, $new_bad_ops))) {
                                $value = 'нейтрально';
                            }

                            if($action = Moon_action::where('phase_type', $translatedPhase)
                                                    ->where('element', $translatedElement)
                                                    ->where('plant_attribute', $plant->id)
                                                    ->where('sort_operation_id', $op->id)
                                                    ->first()) {
                                $action->value = $value;
                                $action->save();
                            } else {
                                Moon_action::create([
                                    'phase_type' => $translatedPhase,
                                    'element' => $translatedElement,
                                    'plant_attribute' => $plant->id,
                                    'sort_operation_id' => $op->id,
                                    'value' => $value
                                ]);
                            }
                        }
                    }
                }
            }
        }

        $request->session()->flash('success', 'Лунный календарь обновлён');
        return redirect()->action("AdminLTEController@showMoonPhases{$section}");
    }


    public function showMoonPhasesKlumba(Request $request)
    {
        return self::showMoonPhasesSection($request, 'Klumba', 4, 'Клумба (лунный календарь)');
    }
    public function updateMoonPhasesKlumba(Request $request)
    {
        return self::updateMoonPhasesSection($request, 'Klumba', 4, 'Клумба (лунный календарь)');
    }

    public function showMoonPhasesOgorod(Request $request)
    {
        return self::showMoonPhasesSection($request, 'Ogorod', 5, 'Огород (лунный календарь)');
    }
    public function updateMoonPhasesOgorod(Request $request)
    {
        return self::updateMoonPhasesSection($request, 'Ogorod', 5, 'Огород (лунный календарь)');
    }

    public function showMoonPhasesSad(Request $request)
    {
        return self::showMoonPhasesSection($request, 'Sad', 6, 'Сад (лунный календарь)');
    }
    public function updateMoonPhasesSad(Request $request)
    {
        return self::updateMoonPhasesSection($request, 'Sad', 6, 'Сад (лунный календарь)');
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ DeliveryMethods processing                                              │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    public function createDeliveryMethods(Request $request)
    {
        Delivery_method::create([
            'name' => $request->input("creationName") ?? ''
        ]);

        $request->session()->flash('success', 'Новый метод доставки добавлен');
        return redirect()->action("AdminLTEController@showDeliveryMethods");
    }

    public function showDeliveryMethods()
    {
        return view('admin.forms.delivery_methods', [
            'activeMenu' => 'tables',
            'modelName' => 'Методы доставки',
            'rows' => Delivery_method::all()
        ]);
    }

    public function updateDeliveryMethods(Request $request)
    {
        foreach (Delivery_method::all() as $delivery_method) {
            if($request->input("delivery_method_{$delivery_method->id}_for_delete")) {
                $delivery_method->delete();
                continue;
            }
            $delivery_method->name = $request->input("delivery_method_{$delivery_method->id}_name") ?? '';
            $delivery_method->save();
        }

        $request->session()->flash('success', 'Методы доставки обновлены');
        return redirect()->action("AdminLTEController@showDeliveryMethods");
    }

    /*
    ┌─────────────────────────────────────────────────────────────────────────┐
    │ Statistics processing                                                   │
    └─────────────────────────────────────────────────────────────────────────┘
    */
    private function getCountByCultures($sectionId, $classObjects)
    {
        $cultures = [];
        foreach (Culture::where('section_id', $sectionId)->get() as $culture) {
            $cultures[$culture->id] = $culture;
        }

        $countByCultures = [];
        foreach($classObjects as $object) {
            if(! isset($countByCultures[$cultures[$object->culture_id ?? $object->item_id]->name])) {
                $countByCultures[$cultures[$object->culture_id ?? $object->item_id]->name] = 0;
            }
            $countByCultures[$cultures[$object->culture_id ?? $object->item_id]->name] += 1;
        }

        return $countByCultures;
    }

    private function getCountByFilters($filtersArray, $getFilterIdFunc, $sectionId = null)
    {
        $countByFilters = [];
        foreach($filtersArray as $key => $value) {
            $filterId = $sectionId ? $getFilterIdFunc($value, $sectionId) : $getFilterIdFunc($value);

            $filterValues = [];
            foreach(Filter_attr_value::where('attribute_id', $filterId)->get() as $value) {
                $filterValues[$value->id] = $value;
            }

            $countByFilters[$key] = [];
            foreach(Filter_attr_entity::where('attribute_id', $filterId)
                                      ->get() as $entity) {
                if(! isset($countByFilters[$key][$filterValues[$entity->attribute_value]->attribute_value])) {
                    $countByFilters[$key][$filterValues[$entity->attribute_value]->attribute_value] = 0;
                }
                $countByFilters[$key][$filterValues[$entity->attribute_value]->attribute_value] += 1;
            }
        }
        return $countByFilters;
    }

    public function showStatisticsUsers()
    {
        $tariffs_count = [];
        foreach(range(1, 4) as $i) {
            $tariffs_count[Tariff::find($i)->tariff_name] = Profile::where('tariff_id', $i)->count();
        }

        return view('admin.forms.statistics_users', [
            'activeMenu' => 'statistics',
            'modelName' => 'Статистика пользователей',
            'tariffs_count' => $tariffs_count,
            'users_count' => Profile::all()->count(),
            'sellers_count' => Profile::where('is_seller', 1)->count(),
            'decorators_count' => Profile::where('is_decorator', 1)->count(),
            'partymakers_count' => Profile::where('is_partymaker', 1)->count()
        ]);
    }

    public function showStatisticsChemicals()
    {
        $chemicals_count_filters = self::getCountByFilters(
            ['type' => 'Тип', 'manufacturer' => 'Производитель'],
            function($translatedFilter) {
                return Filter_attributes::where('type', 'chemical')
                                        ->where('name', $translatedFilter)
                                        ->first()->id;
            }
        );

        return view('admin.forms.statistics_chemicals', [
            'activeMenu' => 'statistics',
            'modelName' => 'Статистика химикатов',
            'chemicals_count' => Chemical::all()->count(),
            'chemicals_count_filters' => $chemicals_count_filters
        ]);
    }

    public function showStatisticsCultures()
    {
        $viewArray = [];
        $sum = 0;
        $sections = [
            'klumba' => [
                'translated' => 'Клумба',
                'filters' => ['type' => 'Тип области выращивания', 'target' => 'Назначение']
            ],
            'ogorod' => [
                'translated' => 'Огород',
                'filters' => ['morph' => 'По морфологическому признаку']
            ],
            'sad' => [
                'translated' => 'Сад',
                'filters' => ['type' => 'Тип плода', 'morph' => 'По морфологическому признаку']]
        ];

        foreach($sections as $section => $sectionArray) {
            $id = Section::where('name', $sectionArray['translated'])->first()->id;
            $viewArray["{$section}_cultures_count"] = Culture::where('section_id', $id)->count();
            $viewArray["{$section}_cultures_count_filters"] = self::getCountByFilters(
                $sectionArray['filters'],
                function($translatedFilter, $sectionId) {
                    return Filter_attributes::where('type', 'culture')
                                            ->where('section_id', $sectionId)
                                            ->where('name', $translatedFilter)
                                            ->first()->id;
                }, $id
            );
            $sum += $viewArray["{$section}_cultures_count"];
        }

        return view('admin.forms.statistics_cultures', array_merge([
            'activeMenu' => 'statistics',
            'modelName' => "Статистика культур. Всего: {$sum}",
        ], $viewArray));
    }

    public function showStatisticsSorts()
    {
        $viewArray = [];
        $sum = 0;

        foreach (['klumba' => 'Клумба', 'ogorod' => 'Огород', 'sad' => 'Сад'] as $section => $translated) {
            $id = Section::where('name', $translated)->first()->id;
            $viewArray["{$section}_sorts_count"] = Sort::where('section_id', $id)->count();
            $viewArray["{$section}_sorts_count_cultures"] = self::getCountByCultures(
                $id, Sort::where('section_id', $id)->get()
            );
            $sum += $viewArray["{$section}_sorts_count"];
        }

        return view('admin.forms.statistics_sorts', array_merge([
            'activeMenu' => 'statistics',
            'modelName' => "Статистика сортов. Всего: {$sum}"
        ], $viewArray));
    }

    public function showStatisticsPestsDiseases()
    {
        $viewArray = [];

        foreach (['klumba' => 'Клумба', 'ogorod' => 'Огород', 'sad' => 'Сад'] as $section => $translated) {
            $id = Section::where('name', $translated)->first()->id;
            foreach(['pest' => Pest::class, 'disease' => Disease::class] as $type => $class) {
                $ids = $class::where('section_id', $id)->get()->pluck('id')->toArray();
                $viewArray["{$section}_{$type}_count"] = $class::where('section_id', $id)->count();
                $viewArray["{$section}_{$type}_count_cultures"] = self::getCountByCultures(
                    $id, Pest_disease_relations::whereIn('pest_disease_id', $ids)
                                                      ->where('pest_disease_type', $type)
                                                      ->where('item_type', 'culture')
                                                      ->get()
                );
            }
        }

        return view('admin.forms.statistics_pests_diseases', array_merge([
            'activeMenu' => 'statistics',
            'modelName' => 'Статистика вредителей и заболеваний'
        ], $viewArray));
    }

    public function showStatisticsHandbooks()
    {
        $viewArray = [];
        $sum = 0;

        foreach (['klumba' => 'Клумба', 'ogorod' => 'Огород', 'sad' => 'Сад'] as $section => $translated) {
            $id = Section::where('name', $translated)->first()->id;
            $viewArray["{$section}_handbooks_count"] = Handbook::where('section_id', $id)->count();
            $viewArray["{$section}_handbooks_count_cultures"] = self::getCountByCultures(
                $id, Handbook::where('section_id', $id)->get()
            );
            $sum += $viewArray["{$section}_handbooks_count"];
        }

        return view('admin.forms.statistics_handbooks', array_merge([
            'activeMenu' => 'statistics',
            'modelName' => "Статистика справочных статей. Всего: {$sum}"
        ], $viewArray));
    }

    public function showStatisticsEvents()
    {
        $events_count_filters = self::getCountByFilters(
            ['type' => 'Тип'],
            function($translatedFilter) {
                return Filter_attributes::where('type', 'event')
                                        ->where('name', $translatedFilter)
                                        ->first()->id;
            }
        );

        return view('admin.forms.statistics_events', [
            'activeMenu' => 'statistics',
            'modelName' => 'Статистика событий',
            'events_count' => Event::all()->count(),
            'events_count_filters' => $events_count_filters,
            'participants_avg' => intval(Event::all()->avg('participants'))
        ]);
    }

    public function showStatisticsPhotos()
    {
        $typeDict = [
            'sort' => 'Сорт', 'chemical' => 'Химикат', 'decorator' => 'Декоратор',
            'seller' => 'Продавец', 'culture' => 'Культура', 'pest' => 'Вредитель',
            'disease' => 'Заболевание', 'event' => 'Событие', 'handbook' => 'Справка'
        ];

        $photos_count_types = [];
        foreach(Photos::all() as $photo) {
            if(! isset($photos_count_types[$typeDict[$photo->type]])) {
                $photos_count_types[$typeDict[$photo->type]] = 0;
            }
            $photos_count_types[$typeDict[$photo->type]] += 1;
        }

        return view('admin.forms.statistics_photos', [
            'activeMenu' => 'statistics',
            'modelName' => 'Статистика фотографий',
            'photos_count' => Photos::all()->count(),
            'photos_count_types' => $photos_count_types,
            'photos_count_new' => Photos::where('moderator', 'new')->count(),
            'photos_count_accepted' => Photos::where('moderator', 'accepted')->count(),
        ]);
    }

    public function showStatisticsResponses()
    {
        $typeDict = [
            'sort' => 'Сорт', 'chemical' => 'Химикат', 'decorator' => 'Декоратор',
            'seller' => 'Продавец', 'culture' => 'Культура', 'pest' => 'Вредитель',
            'disease' => 'Заболевание', 'event' => 'Событие', 'handbook' => 'Справка'
        ];

        $responses_count_types = [];
        foreach(Response::all() as $response) {
            if(! isset($responses_count_types[$typeDict[$response->type]])) {
                $responses_count_types[$typeDict[$response->type]] = 0;
            }
            $responses_count_types[$typeDict[$response->type]] += 1;
        }

        return view('admin.forms.statistics_responses', [
            'activeMenu' => 'statistics',
            'modelName' => 'Статистика коментариев',
            'responses_count' => Response::all()->count(),
            'responses_count_types' => $responses_count_types,
            'responses_count_new' => Response::where('moderator', 'new')->count(),
            'responses_count_accepted' => Response::where('moderator', 'accepted')->count(),
            'rating_avg' => intval(Response::all()->avg('rating'))
        ]);
    }

    public function showStatisticsQuestions()
    {
        $viewArray = [];
        foreach (['klumba' => 'Клумба', 'ogorod' => 'Огород', 'sad' => 'Сад'] as $section => $translated) {
            $id = Section::where('name', $translated)->first()->id;
            $viewArray["{$section}_questions_count"] = Question::where('section_id', $id)->count();
        }

        return view('admin.forms.statistics_questions', array_merge([
            'activeMenu' => 'statistics',
            'modelName' => 'Статистика вопросов-ответов',
            'questions_count' => Question::all()->count(),
            'questions_count_open' => Question::where('is_closed', 0)->count(),
            'questions_count_closed' => Question::where('is_closed', 1)->count(),
            'questions_count_without_comments' => Question::where('comments_count', 0)->count(),
            'questions_count_new' => Question::where('moderator', 'new')->count(),
            'questions_count_accepted' => Question::where('moderator', 'accepted')->count()
        ], $viewArray));
    }

    public function showStatisticsOrders()
    {
        $sectionDict = [];
        foreach (Section::all() as $section) {
            $sectionDict[$section->id] = $section->name;
        }

        $cultureDict = [];
        foreach (Culture::all() as $culture) {
            $cultureDict[$culture->id] = $culture->name;
        }

        $statusDict = [];
        foreach (Order_status::all() as $status) {
            $statusDict[$status->id] = $status->status_name;
        }

        $deliveryDict = [];
        foreach (Delivery_method::all() as $delivery) {
            $deliveryDict[$delivery->id] = $delivery->name;
        }

        $chemicalsTypeDict = [];
        $chemicalsTypeFilterId = Filter_attributes::where('type', 'chemical')
                                                  ->where('name', 'Тип')
                                                  ->first()->id;
        foreach (Filter_attr_value::where('attribute_id', $chemicalsTypeFilterId)->get() as $value) {
            $chemicalsTypeDict[$value->id] = $value->attribute_value;
        }

        $chemicalsManufacturerDict = [];
        $chemicalsManufacturerFilterId = Filter_attributes::where('type', 'chemical')
                                                          ->where('name', 'Производитель')
                                                          ->first()->id;
        foreach (Filter_attr_value::where('attribute_id', $chemicalsManufacturerFilterId)->get() as $value) {
            $chemicalsManufacturerDict[$value->id] = $value->attribute_value;
        }

        $orders_count_statuses = [];
        $orders_count_deliveries = [];
        $orders_count_sorts_sections = ['Клумба' => 0, 'Огород' => 0, 'Сад' => 0];
        $orders_count_sorts_cultures = ['Клумба' => [], 'Огород' => [], 'Сад' => []];
        $orders_count_chemicals_types = [];
        $orders_count_chemicals_manufacturers = [];
        foreach (Order::all() as $order) {
            if(! isset($orders_count_statuses[$statusDict[$order->status_id]])) {
                $orders_count_statuses[$statusDict[$order->status_id]] = 0;
            }
            $orders_count_statuses[$statusDict[$order->status_id]] += 1;

            if(! isset($orders_count_deliveries[$deliveryDict[$order->delivery_method_id]])) {
                $orders_count_deliveries[$deliveryDict[$order->delivery_method_id]] = 0;
            }
            $orders_count_deliveries[$deliveryDict[$order->delivery_method_id]] += 1;

            foreach(Order_Item::where('order_id', $order->id)->where('quantity', '!=', 0)->get() as $item) {
                if($item->type == 'sort') {
                    $sort = Sort::find($item->item_id);

                    $section_key = $sectionDict[$sort->section_id];
                    // if(! isset($orders_count_sorts_sections[$section_key])) {
                    //     $orders_count_sorts_sections[$section_key] = 0;
                    // }
                    $orders_count_sorts_sections[$section_key] += 1; // $item->quantity;

                    $culture_key = $cultureDict[$sort->culture_id];
                    if(! isset($orders_count_sorts_cultures[$section_key][$culture_key])) {
                        $orders_count_sorts_cultures[$section_key][$culture_key] = 0;
                    }
                    $orders_count_sorts_cultures[$section_key][$culture_key] += 1; // $item->quantity;
                } elseif ($item->type == 'chemical') {
                    $chemical = Chemical::find($item->item_id);

                    foreach(Filter_attr_entity::where('entity_type', 'chemical')
                                              ->where('entity_id', $item->item_id)
                                              ->where('attribute_id', $chemicalsTypeFilterId)
                                              ->get() as $entity) {
                        $type_key = $chemicalsTypeDict[$entity->attribute_value];
                        if(! isset($orders_count_chemicals_types[$type_key])) {
                            $orders_count_chemicals_types[$type_key] = 0;
                        }
                        $orders_count_chemicals_types[$type_key] += 1; // $item->quantity;
                    }

                    foreach(Filter_attr_entity::where('entity_type', 'chemical')
                                              ->where('entity_id', $item->item_id)
                                              ->where('attribute_id', $chemicalsManufacturerFilterId)
                                              ->get() as $entity) {
                        $manufacturer_key = $chemicalsManufacturerDict[$entity->attribute_value];
                        if(! isset($orders_count_chemicals_manufacturers[$manufacturer_key])) {
                            $orders_count_chemicals_manufacturers[$manufacturer_key] = 0;
                        }
                        $orders_count_chemicals_manufacturers[$manufacturer_key] += 1; // $item->quantity;
                    }
                }
            }
        }

        $orders_count = Order_Item::whereIn('order_id', array_unique(Order::all()->pluck('id')->toArray()))
                                  ->where('quantity', '!=', 0)->count();
        $orders_count_chemicals = array_sum(
            array_merge($orders_count_chemicals_types, $orders_count_chemicals_manufacturers)
        );

        return view('admin.forms.statistics_orders', [
            'activeMenu' => 'statistics',
            'modelName' => 'Статистика заказов',
            'orders_count' => $orders_count,
            'orders_count_chemicals' => $orders_count_chemicals,
            'orders_count_statuses' => $orders_count_statuses,
            'orders_count_deliveries' => $orders_count_deliveries,
            'orders_count_sorts_sections' => $orders_count_sorts_sections,
            'orders_count_sorts_cultures' => $orders_count_sorts_cultures,
            'orders_count_chemicals_types' => $orders_count_chemicals_types,
            'orders_count_chemicals_manufacturers' => $orders_count_chemicals_manufacturers
        ]);
    }

    public function showStatisticsQuestionaries()
    {
        $cultures = [];
        foreach (Culture::where('section_id', '!=', Section::where('name', 'Клумба')->first()->id)->get() as $culture) {
            $cultures[$culture->id] = $culture;
        }

        $sorts = [];
        $questionaries_count = [];
        $harvest_from_one_landing = [];
        $harvest_from_all_landing = [];
        foreach (Sort::where('section_id', '!=', Section::where('name', 'Клумба')->first()->id)->get() as $sort) {
            $sorts[$sort->id] = $sort;
            $questionaries_count[$sort->id] = 0;
            $harvest_from_one_landing[$sort->id] = [];
            $harvest_from_all_landing[$sort->id] = [];
        }

        foreach (Sort_questionary::all() as $questionary) {
            $questionaries_count[$questionary->sort_id] += 1;

            if(! isset($harvest_from_one_landing[$questionary->sort_id][$questionary->landing_type])) {
                $harvest_from_one_landing[$questionary->sort_id][$questionary->landing_type] = [];
            }
            array_push(
                $harvest_from_one_landing[$questionary->sort_id][$questionary->landing_type],
                [$questionary->landing_area ?? 0, $questionary->harvest ?? 0]
            );

            array_push(
                $harvest_from_all_landing[$questionary->sort_id],
                $questionary->harvest ?? 0
            );
        }

        foreach (Sort::where('section_id', '!=', Section::where('name', 'Клумба')->first()->id)->get() as $sort) {
            /* harvest from one landing calculations */
            foreach($harvest_from_one_landing[$sort->id] as $landing_type => $landing_areas_harvests) {
                foreach($landing_areas_harvests as $area_harvest) {
                    if(! isset($harvest_from_one_landing[$sort->id][$landing_type]['statistics'])) {
                        $harvest_from_one_landing[$sort->id][$landing_type]['statistics'] = [];
                    }
                    if($area_harvest[0] != 0) {
                        array_push(
                            $harvest_from_one_landing[$sort->id][$landing_type]['statistics'],
                            $area_harvest[1] / $area_harvest[0]
                        );
                    }
                }
                $harvest_from_one_landing[$sort->id][$landing_type] =
                $harvest_from_one_landing[$sort->id][$landing_type]['statistics'];

                $sum = array_sum($harvest_from_one_landing[$sort->id][$landing_type]);
                $count = count($harvest_from_one_landing[$sort->id][$landing_type]);
                $harvest_from_one_landing[$sort->id][$landing_type] = [
                    'min' => $count == 0 ? 0 : intval(min($harvest_from_one_landing[$sort->id][$landing_type])),
                    'avg' => $count == 0 ? 0 : intval($sum / $count),
                    'max' => $count == 0 ? 0 : intval(max($harvest_from_one_landing[$sort->id][$landing_type]))
                ];
            }

            /* harvest from many landing calculations */
            $sum = array_sum($harvest_from_all_landing[$sort->id]);
            $count = count($harvest_from_all_landing[$sort->id]);
            $harvest_from_all_landing[$sort->id] = [
                'min' => $count == 0 ? 0 : intval(min($harvest_from_all_landing[$sort->id])),
                'avg' => $count == 0 ? 0 : intval($sum / $count),
                'max' => $count == 0 ? 0 : intval(max($harvest_from_all_landing[$sort->id]))
            ];
        }

        $klumba_id = Section::where('name', 'Клумба')->first()->id;
        $ogorod_id = Section::where('name', 'Огород')->first()->id;
        $sad_id = Section::where('name', 'Сад')->first()->id;

        return view('admin.forms.statistics_questionaries', [
            'activeMenu' => 'statistics',
            'modelName' => 'Статистика анкет',
            'cultures' => $cultures,
            'sorts' => $sorts,
            'questionaries_count' => $questionaries_count,
            'harvest_from_one_landing' => $harvest_from_one_landing,
            'harvest_from_all_landing' => $harvest_from_all_landing,
            'klumba_cultures' => Culture::where('section_id', $klumba_id)->get(),
            'ogorod_cultures' => Culture::where('section_id', $ogorod_id)->get(),
            'sad_cultures' => Culture::where('section_id',$sad_id)->get()
        ]);
    }

    public function getStatisticsQuestionariesAjax(Request $request)
    {
        $from = $request["from"];
        $to = $request["to"];
        $cultures = array_merge(
            $request["cultures_klumba"] ?? [],
            $request["cultures_ogorod"] ?? [],
            $request["cultures_sad"] ?? []
        );
        $statistics = $request["statistics"] ?? [];

        $result_statistics = [];
        foreach(['landing_area', 'seeding_date', 'ground_transplantation_date', 'trimming_date',
                 'is_ill', 'artificial_irrigation', 'drip_irrigation', 'precipitation_from_planting',
                 'feeding_from_planting', 'artificial_irrigation_from_planting', 'harvest'] as $statistic) {
            $result_statistics[$statistic] = in_array($statistic, $statistics) ? [] : null;
        }

        foreach (Sort_questionary::all() as $ques) {
            $culture_id = Sort::find($ques->sort_id)->culture_id;

            if(!in_array($culture_id, $cultures)) {
                continue;
            }

            if(($ques->seeding_date >= $from                && $ques->seeding_date <= $to) ||
               ($ques->ground_transplantation_date >= $from && $ques->ground_transplantation_date <= $to) ||
               ($ques->seeding_date >= $from                && $ques->seeding_date <= $to)) {
                foreach ([
                    'landing_area' => null,
                    'seeding_date' => 'seeding_date',
                    'ground_transplantation_date' => 'ground_transplantation_date',
                    'trimming_date' => 'trimming_date',
                    'is_ill' => null,
                    'artificial_irrigation' => null,
                    'drip_irrigation' => null,
                    'precipitation_from_planting' => null,
                    'feeding_from_planting' => null,
                    'artificial_irrigation_from_planting' => null,
                    'harvest' => null,
                ] as $statistic => $special_date) {
                    if($result_statistics[$statistic] !== null) {
                        $culture_name = Culture::find($culture_id)->name;
                        $date = $ques[$special_date ?? 'seeding_date'];
                        if(! isset($result_statistics[$statistic][$culture_name][$date])) {
                            $result_statistics[$statistic][$culture_name][$date] = 0;
                        }
                        $result_statistics[$statistic][$culture_name][$date] += $special_date ? 1 : $ques[$statistic];
                    }
                }
            }
        }

        return response()->json([
            'success' => true,
            'success-message' => [],
            'errors-message' => [],
            'result_statistics' => $result_statistics,
            'cultures' => Culture::whereIn('id', $cultures)->get()->pluck('name')->toArray()
        ], 200);
    }
}