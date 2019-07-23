
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content">
                @component('front.intofront.leftsidebar')
                @endcomponent
                </div>
                <div class="col sc-main-center-content sc-event-centr-content">
                    <div class="row">
                        <div class="col-12 sc-events-title-container sc-events-title-container-top">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Личная информация</li>
                            </ol>
                        </div>
                        <div class="col-12">
                            <div class="sc-form-user-container">
                                <form action="{{ url('/personal-info/organizer') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="sc-form-user-container">
                                            <div class="sc-form-user-container">
                                                    <div class="row justify-content-between">
                                                        <div class="col-4 ">
                                                            <p class="sc-form-title-line">Персональная информация</p>
                                                            <div class="form-group">
                                                                <input type="tel" class="form-control-info" placeholder="Имя" name="first_name" value="{{ $users->first_name }}" >
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="tel" class="form-control-info" placeholder="Фамилия" name="last_name" value="{{ $users->last_name }}">
                                                            </div>
                                                            <p class="person-info__col--style">
                                                                <span class="font-span">Эмблема</span>
                                                                <label for="file" class="person-info__button-load">Загрузить</label>
                                                                <input type="file" id="file" class="download" name="emblem">
                                                            </p>
                                                            <div class="form-group d-flex align-items-center">
                                                                <input type="checkbox" id="checkbox1" class="form-control-check" name="avatar" value="1" <?= isset($organizator->is_avatar) ? 'checked': '' ?>>
                                                                <label for="checkbox1" class="label-control-check">использовать изображение личного кабинета Пользователя</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 ">
                                                            <div class="sc-forn-title-relative-block">
                                                                <p class="sc-form-title-line">Информация для связи</p>
                                                                <a href="#" class="sc-question-btn-forms">?</a>
                                                                <div class="sc-question-hide-window-forms ">укажите ваши данные для связи с другими пользователями</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="tel" class="form-control-info" placeholder="Email" name="mail" value="{{ $mail }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="tel" class="form-control-info" placeholder="Телефонный номер" name="phone" value="{{ $users->phone }}" >
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="tel" class="form-control-info" placeholder="Сайт" name="site" value="{{ $users->site }}"  >
                                                            </div>
                                                        </div>
                                                        <div class="col-4 sc-socials-form-container ">
                                                            <div class="sc-forn-title-relative-block">
                                                                <p class="sc-form-title-line orginizer-form-title-line-socials">Социальные сети</p>
                                                                <a href="#" class="sc-question-btn-forms">?</a>
                                                                <div class="sc-question-hide-window-forms ">укажите адреса страниц в соц. сетях, ваших групп и блогов</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="sc-form-social" for="name-vk" style="background-image: url({{ asset('images/sc-form-solcial-vk.png') }})"></label>
                                                                <input type="text" class="form-control-info" id="name-vk" placeholder="Vkontakte" name="social_vkotakte" value="{{ $users->social_vkotakte }}" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="sc-form-social" for="name-fb" style="background-image: url({{ asset('images/sc-form-solcial-fb.png') }})"></label>
                                                                <input type="text" class="form-control-info" id="name-fb" placeholder="Facebook" name="social_facebook" value="{{ $users->social_facebook }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="sc-form-social" for="name-od" style="background-image: url({{ asset('images/sc-form-solcial-od.png') }})"></label>
                                                                <input type="text" class="form-control-info" id="name-od" placeholder="Odnoklasniki" name="social_odnoklasniki" value="{{ $users->social_odnoklasniki }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="sc-form-social" for="name-tw" style="background-image: url({{ asset('images/sc-form-solcial-tw.png') }})"></label>
                                                                <input type="text" class="form-control-info" id="name-tw" placeholder="Twitter" name="social_twitter" value="{{ $users->social_twitter }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="sc-form-social" for="name-in" style="background-image: url({{ asset('images/sc-form-solcial-in.png') }})"></label>
                                                                <input type="text" class="form-control-info" id="name-in" placeholder="Instagram" name="social_instagram" value="{{ $users->social_instagram }}" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="sc-form-social" for="name-yt" style="background-image: url({{ asset('images/sc-form-solcial-yt.png') }})"></label>
                                                                <input type="text" class="form-control-info" id="name-yt" placeholder="Youtube" name="social_youtube" value="{{ $users->social_youtube }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 tell-about pt-2">
                                                            <p class="sc-form-title-line">Расскажите о себе</p>
                                                            <textarea name="about" id="" cols="30" rows="10" placeholder="Расскажите о своих достижениях" >{{ $organizator->about }}</textarea>
                                                        </div>
                                                        <div class="col-12 pt-2 text-center">
                                                            <button class="btn sc-form-user-button" type="submit" name="save" value="1" >сохранить</button>
                                                        </div>
                                                    </div>
                                            </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    @component('front.intofront.rightsidebar')
                    @endcomponent
            </div>
        </div>
    </section>
@endsection