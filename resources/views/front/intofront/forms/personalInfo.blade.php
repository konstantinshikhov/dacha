
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <?php if($load_photo):?>
            <input type="hidden" id="load_photo" value="1" >
        <?php endif;?>
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
                                <form action="{{ url('/personal-info') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row justify-content-between">
                                        <div class="col-4">
                                            <p class="sc-form-title-line">Персональная информация</p>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Имя" name="first_name" value="{{ $users->first_name }}" >
                                            </div>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Фамилия" name="last_name" value="{{ $users->last_name }}" >
                                            </div>
                                            <div class="form-group">
                                                <input type="date" class="form-control-info" name="birthday" value="{{ $users->birthday }}" >
                                            </div>
                                            <p class="person-info__col--style">
                                                <span class="font-span">Фото профиля</span>
                                                <label for="file" class="person-info__button-load">Загрузить</label>
                                                <input type="file" id="file" class="download" name="photo">
                                            </p>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Nickname" name="nickname" value="{{ $users->nickname }}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="sc-forn-title-relative-block"><p class="sc-form-title-line">Информация для связи</p>
                                                <a href="#" class="sc-question-btn-forms">?</a>
                                                <div class="sc-question-hide-window-forms ">укажите ваши данные для связи с другими пользователями</div>
                                            </div>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Email" name="email" value="{{ $mail }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Телефонный номер" name="phone" value="{{ $users->phone }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Адрес" name="address" value="{{ $users->address }}">
                                            </div>

                                        </div>
                                        <div class="col-4 sc-socials-form-container">
                                            <div class="sc-forn-title-relative-block"><p class="sc-form-title-line orginizer-form-title-line-socials">Социальные сети</p>
                                                <a href="#" class="sc-question-btn-forms">?</a>
                                                <div class="sc-question-hide-window-forms ">укажите адреса страниц в соц. сетях, ваших групп и блогов</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="sc-form-social" for="name-vk" style="background-image: url(images/sc-form-solcial-vk.png)"></label>
                                                <input type="text" class="form-control-info" id="name-vk" placeholder="Vkontakte" name="social_vkotakte" value="{{ $users->social_vkotakte }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="sc-form-social" for="name-fb" style="background-image: url(images/sc-form-solcial-fb.png)"></label>
                                                <input type="text" class="form-control-info" id="name-fb" placeholder="Facebook" name="social_facebook" value="{{ $users->social_facebook }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="sc-form-social" for="name-od" style="background-image: url(images/sc-form-solcial-od.png)"></label>
                                                <input type="text" class="form-control-info" id="name-od" placeholder="Odnoklasniki" name="social_odnoklasniki" value="{{ $users->social_odnoklasniki }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="sc-form-social" for="name-tw" style="background-image: url(images/sc-form-solcial-tw.png)"></label>
                                                <input type="text" class="form-control-info" id="name-tw" placeholder="Twitter" name="social_twitter" value="{{ $users->social_twitter }}" >
                                            </div>
                                            <div class="form-group">
                                                <label class="sc-form-social" for="name-in" style="background-image: url(images/sc-form-solcial-in.png)"></label>
                                                <input type="text" class="form-control-info" id="name-in" placeholder="Instagram" name="social_instagram" value="{{ $users->social_instagram  }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="sc-form-social" for="name-yt" style="background-image: url(images/sc-form-solcial-yt.png)"></label>
                                                <input type="text" class="form-control-info" id="name-yt" placeholder="Youtube" name="social_youtube" value="{{ $users->social_youtube }}">
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button class="btn sc-form-user-button sc-buyer-btn" type="submit" name="save" value="1">сохранить</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 d-flex sc-profile-container justify-content-between">
                            <div class="profile position-relative d-flex">
                                <div class="profile-image" style="background-image: url('/public/images/{{ $users->photo }}');"></div>
                                <div class="profile__verified">ВЕРЕФИЦИРОВАН</div>
                                <div>
                                    <div class="profile__name">{{ $users->first_name }} {{ $users->last_name }}</div>
                                    <ul class="profile__list">
                                        <li class="profile__list-item">34 года (21.05.1985, скорпион)</li>
                                        <li class="profile__list-item">2 года на ресурсе</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="rating">
                                <div class="rating__name">Рейтинг активности</div>
                                <div class="rating__text">Покупатель + Продавец</div>
                                <div class="rating__line">
                                    <span class="rating__line-percentages">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 sc-personal-info-statistic">
                            <div class="statistics__title pb-5">Ваша статистика</div>
                            <div class="d-flex justify-content-between">
                                <div class="statistics-user">
                                    <div class="statistics-user__title">Пользователь</div>
                                    <div class="statistics-user__items">
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Заход в день</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Время без захода</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Покупка</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Сумма покупки</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Отказ от заказа</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Отправка фото по разделам вредители и заболевания</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Комментарий к сорту или химикату</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Отзыв к продавцу или флористу</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Участие в мероприятии</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Статья на модерацию</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Видео по имеющейся статье</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Исправление статьи</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Первая созданная папка</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Первое добавленное растение</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Первая добавленная статья</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Отправленная анкета</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Каждое заполненное поле личных данных</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Создание топика вопрос-ответ</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Регистрация</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Приобретение тарифа</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-user__orders">
                                            <div class="statistics-user__orders-name">Бронирование</div>
                                            <div class="statistics-user__orders-quantity"></div>
                                        </div>
                                    </div>
                                    <div class="statistics-user__rating">
                                        <div class="statistics-user__rating-name">РЕЙТИНГ</div>
                                        <div class="statistics-user__rating-number"></div>
                                    </div>
                                    <div class="statistics-user__image-wrap"><img src="images/user756f1d6.png" alt="user" class="statistics-user__image">
                                    </div>
                                </div>
                                <div class="statistics-seller">
                                    <div class="statistics-seller__title">Продавец</div>
                                    <div class="statistics-seller__items">
                                        <div class="statistics-seller__orders">
                                            <div class="statistics-seller__orders-name">Ассортимент кол-во</div>
                                            <div class="statistics-seller__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-seller__orders">
                                            <div class="statistics-seller__orders-name">Положительные отзывы</div>
                                            <div class="statistics-seller__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-seller__orders">
                                            <div class="statistics-seller__orders-name">Отрицательные отзывы</div>
                                            <div class="statistics-seller__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-seller__orders">
                                            <div class="statistics-seller__orders-name">Объем продаж</div>
                                            <div class="statistics-seller__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-seller__orders">
                                            <div class="statistics-seller__orders-name">Бронь</div>
                                            <div class="statistics-seller__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-seller__orders">
                                            <div class="statistics-seller__orders-name">Жалоба клиента решенная в пользу клиента</div>
                                            <div class="statistics-seller__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-seller__orders">
                                            <div class="statistics-seller__orders-name">Каждое заполненное поле данных</div>
                                            <div class="statistics-seller__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-seller__orders">
                                            <div class="statistics-seller__orders-name">Отсутствие оплаты</div>
                                            <div class="statistics-seller__orders-quantity"></div>
                                        </div>
                                        <div class="statistics-seller__orders">
                                            <div class="statistics-seller__orders-name">Добавление точки продажи</div>
                                            <div class="statistics-seller__orders-quantity"></div>
                                        </div>
                                    </div>
                                    <div class="statistics-seller__rating">
                                        <div class="statistics-seller__rating-name">РЕЙТИНГ</div>
                                        <div class="statistics-seller__rating-number"></div>
                                    </div>
                                    <div class="statistics-seller__image-wrap"><img src="images/seller.a6b1bf4.png" alt="seller" class="statistics-seller__image"></div>
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