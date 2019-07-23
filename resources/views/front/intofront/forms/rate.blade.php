
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

                        <div class="col-12">
                            <div class="sc-user-container">
                                <h3 class="sc-rate-first-header">Пользователь</h3>
                                <div class="sc-rate-user-block d-flex align-items-center justify-content-between">
                                    <a href="#registr" class="rate-user__item-title">РЕГИСТРАЦИЯ</a>
                                    <ul class="sc-rate-user-list">
                                        <li >регистрация БЕСПЛАТНО</li>
                                        <li >использование справочной информации и совершение покупок БЕСПЛАТНО</li>
                                        <li >получение скидок на ТАРИФЫ и сами ТАРИФЫ за активное участие в развитии портала</li>
                                    </ul>
                                    <div class="rate-user__item-img"><img src="images/user756f1d6.png" alt="" height="200"></div>
                                </div>

                            </div>


                            <div class="sc-user-container">
                                <h3 class="h3">Продавец или поставщик</h3>
                                <div class="sc-seller-user-block d-flex  justify-content-between">
                                    <div class="seller-rate-item">
                                        <div class="seller-rate-item__top">{{ $rate[0]->tariff_name }}</div>
                                        <div class="seller-rate-item__bottom">
                                            <ul class="seller-rate-item__bottom-list">
                                                <li>до {{ $rate[0]->max_sorts }} наименований растений</li>
                                                <li>до {{ $rate[0]->max_chemicals }} наименований химикатов</li>
                                            </ul>
                                            <div class="seller-rate-item__bottom-price">
                                                <span>Цена - {{ $rate[0]->price }} р.</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="seller-rate-item">
                                        <div class="seller-rate-item__top">{{ $rate[1]->tariff_name }}</div>
                                        <div class="seller-rate-item__bottom">
                                            <ul class="seller-rate-item__bottom-list">
                                                <li>до {{ $rate[1]->max_sorts }} наименований растений</li>
                                                <li>до {{ $rate[1]->max_chemicals }} наименований химикатов</li>
                                            </ul>
                                            <div class="seller-rate-item__bottom-price">
                                                <span>Цена - {{ $rate[1]->price }} р.</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="seller-rate-item">
                                        <div class="seller-rate-item__top">{{ $rate[2]->tariff_name }}</div>
                                        <div class="seller-rate-item__bottom">
                                            <ul class="seller-rate-item__bottom-list">
                                                <li>до {{ $rate[2]->max_sorts }} наименований растений</li>
                                                <li>до {{ $rate[2]->max_chemicals }} наименований химикатов</li>
                                            </ul>
                                            <div class="seller-rate-item__bottom-price">
                                                <span>Цена - {{ $rate[2]->price }} р.</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="seller-rate-item">
                                        <div class="seller-rate-item__top">{{ $rate[3]->tariff_name }}</div>
                                        <div class="seller-rate-item__bottom">
                                            <ul class="seller-rate-item__bottom-list">
                                                <li>безлимитное количество наименований растений</li>
                                                <li>безлимитное количество наименований химикатов</li>
                                            </ul>
                                            <div class="seller-rate-item__bottom-price">
                                                <span>Цена - {{ $rate[3]->price }} р.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="sc-user-container pt-5">
                                <h3 class="h3">Декоратор, флорист или ландшафтный дизайнер</h3>
                                <div class="sc-rate-user-block d-flex align-items-center justify-content-between">
                                    <a href="#registr" class="rate-decorator__item-title ">РЕГИСТРАЦИЯ</a>
                                    <div>
                                        <ul class="sc-organizer-user-list">
                                            <li >Пользование функционалом роли "Декоратор и флорист"</li>

                                        </ul>
                                        <div>Цена - 3 000 р./год</div>
                                    </div>
                                    <div class="rate-user__item-img"><img src="images/decorator-rate-img.png" alt="" height="200"></div>
                                </div>

                            </div>
                            <div class="sc-user-container pt-5">
                                <h3 class="h3">Организатор мероприятий</h3>
                                <div class="sc-rate-user-block d-flex align-items-center justify-content-between">
                                    <a href="#registr" class="rate-organizer__item-title">РЕГИСТРАЦИЯ</a>
                                    <div>
                                        <ul class="sc-organizer-user-list">
                                            <li >Пользование функционалом роли "Организатор мероприятий" </li>

                                        </ul>
                                        <div>Цена - 2 000р./год или 500р. одно мероприятие</div>
                                    </div>
                                    <div class="rate-user__item-img"><img src="images/organizer-rate.png" alt="" height="200"></div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12" id="registr">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h2>Заявка на тариф</h2>
                                </div>
                                <div class="col-8 sc-rate-form-container mx-auto">
                                    <form class="sc-form-element text-center" id="sendform" method="post" >
                                        {{ csrf_field() }}
                                        <div id="sendmessage">
                                            Ваше сообщение отправлено!
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="E-mail" name="mail" id="mail-form" required>
                                            <input type="hidden"  id="rate" name="rate" value="1">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" placeholder="Ваше сообщение" name="mess"  id="mess-form"></textarea>
                                        </div>
                                        <button type="submit" class="sc-form-button" id="send" name="submit">Отправить</button>
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