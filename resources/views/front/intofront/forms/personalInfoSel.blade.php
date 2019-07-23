
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
                                <form action="{{ url('/personal-info/seller') }}" method="post" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <div class="sc-form-user-container">
                                            <div class="row sc-seller-form">
                                                <div class="col-seller-form">
                                                    <p class="sc-form-title-line">Персональная информация</p>
                                                    <div class="form-group">
                                                        <input type="tel" class="form-control-info" placeholder="Название" name="title" value="<?= isset($seller->name) ? $seller->name : '' ?>">
                                                    </div>

                                                    <p class="person-info__col--style">
                                                        <span class="font-span">Эмблема</span>
                                                        <label for="file" class="person-info__button-load">Загрузить</label>
                                                        <input type="file" id="file" class="download" name="emblem">
                                                    </p>
                                                    <div class="form-group d-flex align-items-center">
                                                        <input type="checkbox" id="checkbox1" class="form-control-check" name="avatar" value="1" <?= $seller->is_avatar ? 'checked': '' ?>>
                                                        <label for="checkbox1" class="label-control-check">использовать изображение личного кабинета Пользователя</label>
                                                    </div>
                                                    <div class="form-group" id="sc-input-more-place-container">
                                                        @if($seller->place == null)
                                                            <input type="text" class="form-control-info" placeholder="Места продажи" name="place[]">
                                                        @else
                                                            @for($i =0; count($seller->place) > $i; $i++)
                                                                @if($seller->place[$i] != null)
                                                                    <input type="text" class="form-control-info" placeholder="Места продажи" name="place[]" value="{{ $seller->place[$i] }}">
                                                                @endif
                                                            @endfor
                                                        @endif


                                                    </div>
                                                    <div class="text-center">
                                                        <a href="#" class="btn sc-btn-add-place">Добавить</a>
                                                    </div>
                                                </div>
                                                <div class="col-seller-form">
                                                    <div class="sc-forn-title-relative-block"><p class="sc-form-title-line">Информация для связи</p>
                                                        <a href="#" class="sc-question-btn-forms sc-question-btn-forms-seller">?</a>
                                                        <div class="sc-question-hide-window-forms ">укажите ваши данные для связи с другими пользователями</div>
                                                    </div>


                                                    <div class="form-group">
                                                        <input type="email" class="form-control-info" placeholder="Email" name="mail" value="{{ $mail }}" >
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="tel" class="form-control-info" placeholder="Телефонный номер" name="phone" value="{{ $users->phone }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control-info" placeholder="Адрес" name="address" value="{{ $users->address }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="url" class="form-control-info" placeholder="Сайт" name="site" value="{{ $users->site }}">
                                                    </div>
                                                    <div class="form-group d-flex align-items-center">
                                                        <input type="checkbox" id="internet-shop" class="form-control-check" name="isShop" value="1" <?= $seller->is_shop ? 'checked': '' ?>>
                                                        <label for="internet-shop" class="label-control-shop">Наличие интернет магазина</label>
                                                    </div>

                                                </div>
                                                <div class="col ">
                                                    <div class="sc-forn-title-relative-block">
                                                        <p class="sc-form-title-line">Способ доставки</p>
                                                        <a href="#" class="sc-question-btn-forms sc-question-btn-forms-seller">?</a>
                                                        <div class="sc-question-hide-window-forms ">укажите поддерживаемые вами способы доставки товаров</div>
                                                    </div>

                                                    <div class="form-group d-flex align-items-center">
                                                        <input type="checkbox" id="sc-delivery-method1" class="form-control-check" name="delivery[method1]" onclick="$('#sc-delivery-method1').val($('#way_one').val())" <?= isset($seller->delivery_method['method1']) ? 'checked': '' ?> value="<?= isset($seller->delivery_method['method1']) ? $seller->delivery_method['method1'] : '' ?>">
                                                        <input type="text" class="form-control-info ml-2" placeholder="Способ №1" id="way_one" value="<?= isset($seller->delivery_method['method1']) ? $seller->delivery_method['method1'] : '' ?>">
                                                    </div>

                                                    <div class="form-group d-flex align-items-center">
                                                        <input type="checkbox" id="sc-delivery-method2" class="form-control-check" name="delivery[method2]" onclick="$('#sc-delivery-method2').val($('#way_two').val())" <?= isset($seller->delivery_method['method2']) ? 'checked': '' ?> value="<?= isset($seller->delivery_method['method2']) ? $seller->delivery_method['method2'] : '' ?>">
                                                        <input type="text" class="form-control-info ml-2" placeholder="Способ №2" id="way_two" value="<?= isset($seller->delivery_method['method2']) ? $seller->delivery_method['method2'] : '' ?>">
                                                    </div>
                                                    <div class="form-group d-flex align-items-center sc-form-delivery-check">
                                                        <input type="checkbox" id="sc-delivery-method3" class="form-control-check" name="delivery[rf]" value="Почта РФ" <?= isset($seller->delivery_method['rf']) ? 'checked': '' ?>>
                                                        <label for="sc-delivery-method3" class="label-control-delivery-shop">Почта РФ</label>
                                                    </div>
                                                    <div class="form-group d-flex align-items-center sc-form-delivery-check">
                                                        <input type="checkbox" id="sc-delivery-method4" class="form-control-check" name="delivery[kur]" value="Курьерская доставка" <?= isset($seller->delivery_method['kur']) ? 'checked': '' ?>>
                                                        <label for="sc-delivery-method4" class="label-control-delivery-shop">Курьерская доставка</label>
                                                    </div>
                                                    <div class="form-group d-flex align-items-center sc-form-delivery-check">
                                                        <input type="checkbox" id="sc-delivery-method5" class="form-control-check" name="delivery[sam]" value="Самовывоз" <?= isset($seller->delivery_method['sam']) ? 'checked': '' ?>>
                                                        <label for="sc-delivery-method5" class="label-control-delivery-shop">Самовывоз</label>
                                                    </div>


                                                </div>
                                                <div class="col-price-form">
                                                    <p class="sc-form-title-line">Стоимость</p>
                                                    <div class="form-group d-flex">
                                                        <input type="text" class="form-control-info" placeholder="0" name="delivery[0]" value="{{ $seller->delivery_method['0'] }}">
                                                    </div>
                                                    <div class="form-group d-flex">
                                                        <input type="text" class="form-control-info" placeholder="600" name="delivery[600]" value="{{ $seller->delivery_method['600'] }}">
                                                    </div>
                                                    <div class="form-group d-flex">
                                                        <input type="text" class="form-control-info" placeholder="350" name="delivery[350]" value="{{ $seller->delivery_method['350'] }}">

                                                    </div>
                                                    <div class="form-group d-flex">
                                                        <input type="text" class="form-control-info" placeholder="500" name="delivery[500]" value="{{ $seller->delivery_method['500'] }}">

                                                    </div>
                                                    <div class="form-group d-flex">
                                                        <input type="text" class="form-control-info" placeholder="800" name="delivery[800]" value="{{ $seller->delivery_method['800'] }}">

                                                    </div>

                                                </div>
                                                <div class="col-seller-form">
                                                    <div class="sc-forn-title-relative-block">
                                                        <p class="sc-form-title-line">Платежная информаци</p>
                                                        <a href="#" class="sc-question-btn-forms sc-question-btn-forms-seller">?</a>
                                                        <div class="sc-question-hide-window-forms ">укажите удобные вам споcобы оплаты товаров</div>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" class="form-control-info" placeholder="№1" name="delivery[№1]" value="{{ $seller->delivery_method['№1'] }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control-info" placeholder="№2" name="delivery[№2]" value="{{ $seller->delivery_method['№2'] }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control-info" placeholder="№3" name="delivery[№3]" value="{{ $seller->delivery_method['№3'] }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control-info" placeholder="№4" name="delivery[№4]" value="{{ $seller->delivery_method['№4'] }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control-info" placeholder="№5" name="delivery[№5]" value="{{ $seller->delivery_method['№5'] }}" >
                                                    </div>

                                                </div>
                                                <div class="col-12 tell-about pt-2">
                                                    <p class="sc-form-title-line">Расскажите о себе</p>
                                                    <textarea id="" cols="30" rows="10" placeholder="Расскажите о своих достижениях" name="about" >{{ $users->about_me_seller }}</textarea>
                                                </div>
                                                <div class="col-12 text-center mt-2">
                                                    <button class="btn sc-form-user-button" type="submit" name="save" value="1" >сохранить</button>
                                                </div>
                                            </div>
                                    </div>
                                </form>
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
                                    <div class="statistics-user__image-wrap"><img src="{{ asset('images/user756f1d6.png') }}" alt="user" class="statistics-user__image">
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
                                    <div class="statistics-seller__image-wrap"><img src="{{ asset('images/seller.a6b1bf4.png') }}" alt="seller" class="statistics-seller__image"></div>
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