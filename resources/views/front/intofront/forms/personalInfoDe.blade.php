
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content">
                @component('front.intofront.leftsidebar')
                @endcomponent
                </div>
                <div class="col-9 sc-main-center-content sc-slider-page-width-static">
                    <div class="row">
                        <div class="col-12 sc-events-title-container sc-events-title-container-top">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Личная информация</li>
                            </ol>
                        </div>
                        <div class="col-12">
                            <div class="sc-form-user-container">
                                <form action="{{ url('/personal-info/decorator') }}" method="post" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <div class="row justify-content-between">
                                        <div class="col-4 ">
                                            <p class="sc-form-title-line">Персональная информация</p>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Имя" name="first_name" value="{{ $users->first_name }}">
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
                                                <input type="checkbox" id="checkbox1" class="form-control-check" name="avatar" value="1" <?= isset($users->is_avatar) ? 'checked': '' ?>>
                                                <label for="checkbox1" class="label-control-check">использовать изображение личного кабинета Пользователя</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Стоимость работ" name="cost"  value="<?= isset($decorator->cost) ? $decorator->cost : '' ?>" >
                                            </div>
                                            <div class="form-group d-flex">
                                                <input type="tel" class="form-control-info form-control-info-price" placeholder="От" name="min_price_decorator" value="{{ $users->min_price_decorator }}">
                                                <span>-</span>
                                                <input type="tel" class="form-control-info form-control-info-price" placeholder="До" name="max_price_decorator" value="{{ $users->max_price_decorator }}">
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
                                                <input type="tel" class="form-control-info" placeholder="Телефонный номер" name="phone" value="{{ $users->phone }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Сайт" name="site" value="{{ $users->site }}">
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
                                                <input type="text" class="form-control-info" id="name-vk" placeholder="Vkontakte" name="social_vkotakte" value="{{ $users->social_vkotakte }}">
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
                                                <input type="text" class="form-control-info" id="name-in" placeholder="Instagram" name="social_instagram" value="{{ $users->social_instagram }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="sc-form-social" for="name-yt" style="background-image: url({{ asset('images/sc-form-solcial-yt.png') }})"></label>
                                                <input type="text" class="form-control-info" id="name-yt" placeholder="Youtube" name="social_youtube" value="{{ $users->social_youtube }}">
                                            </div>
                                        </div>
                                        <div class="col-12 tell-about pt-2">
                                            <p class="sc-form-title-line">Расскажите о себе</p>
                                            <textarea name="about_me_decorator" id="" cols="30" rows="10" placeholder="Расскажите о своих достижениях">{{ $users->about_me_decorator }}</textarea>
                                        </div>
                                        <div class="col-12 pt-2 text-center">
                                            <button class="btn sc-form-user-button" type="submit" name="save" value="1">сохранить</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="slider-empty-personal-info mx-auto">
                                <div class="slider-empty-personal-cards" style="background-image: url({{ asset('images/news-img-card.jpg') }});"></div>
                                <div class="slider-empty-personal-cards" style="background-image: url({{ asset('images/news-img-card.jpg') }});"></div>
                            </div>
                        </div>
                        <div class="sc-slider-add-btn-container col-12 d-flex">
                            <button type=button class="button-item__photo">+ <span>Добавить фото</span></button>
                            <button type=button class="button-item__photo">- <span>Удалить фото</span></button>
                            <button type=button class="button-item__publish ml-auto">Опубликовать</button>
                        </div>
                        <div class="col-12 sc-decorator-page-comments">
                            <div class="comment">
                                <div class="comment-item">
                                    <div class="comment-item__stars d-flex ">
                                        <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                        <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                        <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                        <div class="star-rating__white"><i class="fa fa-star-o"></i></div>
                                        <div class="star-rating__white"><i class="fa fa-star-o"></i></div>
                                    </div>
                                    <div class="comment-item__name">Светлана</div>
                                    <div class="comment-item__date">21.02.2018</div>
                                    <div class="comment-item__text">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                            dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt mollit anim id est laborum.</p>
                                    </div>
                                </div>
                                <div class="answer">
                                    <div class="answer-line"></div>
                                    <div class="answer-name">Наталья <img src="" alt=""></div>
                                    <div class="answer-work">Менедежер компаний "Беккер"</div>
                                    <div class="answer-date">27.01.2018</div>
                                    <div class="answer-text">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                            dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt mollit anim id est laborum.</p>
                                    </div>
                                    <form action="" class="answer-form">
                                        <textarea name="" id="" cols="30" rows="10" class="answer-form__textarea"></textarea>
                                        <button class="answer-form__btn">Ответить на комментарий</button>
                                    </form>
                                </div>
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