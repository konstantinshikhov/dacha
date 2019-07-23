
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content ">
                    @component('front.intofront.leftsidebar')
                    @endcomponent
                </div>
                <div class="col sc-main-center-content-chemical">
                    <div class="row">
                        <div class="col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/chemical') }}">Химикаты</a></li>
                                <li class="breadcrumb-item active">{{ $chemical->name }}</li>
                            </ol>
                            <div class="sc-bookmark-all-container sc-bookmark-all-container-article">
                                <div class="d-flex position-relative align-items-center">
                                    <div>
                                        <div class="sc-chemical-page-article">Артикул:<span> {{$vendor_code}}</span>
                                        </div>
                                        <div class="sc-suppliers-page-article-block d-flex align-items-center">
                                            @php for($i=0;$i<floor($chemical->rating);$i++):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star"></i></div>';
                                            endfor;
                                                if(($chemical->rating- (floor($chemical->rating)))!=0):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star-half-o"></i></div>';
                                                endif;
                                            for($i=0;$i<=4-round($chemical->rating, 0, PHP_ROUND_HALF_UP);$i++):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star-o"></i></div>';
                                            endfor;
                                            @endphp
                                        </div>
                                    </div>
                                    <div class="sc-bookmark-all ml-3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <div class="sc-page-title-block-container">{{ $chemical->name }}</div>
                        </div>
                        <div class="col-12 pb-5">
                            <div class="row">
                                <div class="col-6 sc-foto-gallery-container">
                                    <div class="row ">
                                        <div class="col-12 mb-3">
                                            <div class="sc-foto-gallery-element-main-foto" style="">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class=" sc-foto-gallery-element-additional-foto" style="background-image: url('/storage/app/public/{{ $chemical->main_photo }}');">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class=" sc-foto-gallery-element-additional-foto" style="background-image: url({{ asset('images/chemical-foto.jpg') }});">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class=" sc-foto-gallery-element-additional-foto" style="background-image: url({{ asset('images/chemical-foto.jpg') }});">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 sc-content-text-container d-flex flex-column">
                                    <div class="sc-chemicat-description-container">
                                        <table class="sc-chemicat-description-table">
                                            <tbody>
                                            <tr>
                                                <td class="first-block">Производитель:</td>
                                                <td class="second-block">{{ $chemical->manufacturer }}</td>
                                            </tr>
                                            <tr>
                                                <td class="first-block">Сайт производителя:</td>
                                                <td class="second-block">{{ $chemical->manufacturer_site }}</td>
                                            </tr>
                                            <tr>
                                                <td class="first-block">Тип:</td>
                                                <td class="second-block"></td>
                                            </tr>
                                            <tr>
                                                <td class="first-block">От каких вредителей/заболеваний:</td>
                                                <td class="second-block">Универсальное ЭКОУниверсальное ЭКО Универсальное ЭКОУниверсальное ЭКО</td>
                                            </tr>
                                            <tr>
                                                <td class="first-block">Характеристика:</td>
                                                <td class="second-block">{!! $chemical->characteristics  !!} </td>
                                            </tr>
                                            <tr>
                                                <td class="first-block">Средняя стоимость:</td>
                                                <td class="second-block"><span class="second-block--price">{{ $chemical->average_price }}</span></td>
                                            </tr>
                                            <tr>
                                                <td class="first-block">Краткая инструкция по применению:</td>
                                                <td class="second-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit accusantium sequi voluptate maiores distinctio consequatur, dicta itaque nemo, dignissimos nisi, nesciunt laborum. Commodi blanditiis accusantium, corporis labore quas impedit dolores voluptas quae, omnis itaque repudiandae. Rem dolore expedita libero cumque officiis est recusandae amet omnis nihil accusamus eos autem, totam inventore blanditiis? Consequuntur sapiente, mollitia quae, ratione non ipsam repudiandae illum excepturi, esse magnam praesentium, sed doloremque fugit culpa impedit. Laboriosam, error, exercitationem magnam quisquam repellat accusantium cum numquam eligendi voluptatibus. Voluptatum officia officiis commodi, nemo ex quos. Deleniti ea iste aliquam consequuntur explicabo, temporibus, velit ut obcaecati eaque quaerat.</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="sc-content-chemical-header">
                                <ul class="d-flex">
                                    <li><a href="#">Описание</a></li>
                                    <li><a href="#">Доп.информация</a></li>
                                    <li><a href="#">Комментарии</a></li>
                                    <li><a href="#">Места продажи (<span>33</span>)</a></li>
                                </ul>
                            </div>
                            <div class="sc-content-text-description-container pb-4">
                                <h3>Описание</h3>
                                <div class="sc-content-text-description">
                                    {!! $chemical->description !!}
                                </div>
                            </div>
                            <div class="sc-content-text-description-container pb-4">
                                <h3>Дополнительная информация</h3>
                                <div class="sc-content-text-description">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus maxime alias laboriosam temporibus tempore facere sit. Quia quisquam amet repellat, maxime. Eum sequi libero recusandae repudiandae aliquid ipsum ad, quas nam laborum facilis quasi ipsa, quia vitae nisi nobis ipsam accusantium. Vero incidunt qui sit eligendi, quia recusandae quas accusamus debitis amet ipsam asperiores error placeat accusantium optio nam ipsum quis autem ea ratione cumque maxime, saepe deleniti necessitatibus nihil! Deleniti explicabo ipsam quam in assumenda quae asperiores fugiat, suscipit laborum, quod ipsa ullam cum quibusdam! Repellendus ducimus dicta facere esse eos sunt quaerat culpa explicabo? Id dolore quaerat ab?</p>
                                </div>
                            </div>
                            <div class="sc-decorator-page-comments sc-chemicat-comments">
                                <h3>Комментарии</h3>
                                <div class="sc-decorator-reviews-block pl-0">
                                    <span class="sc-decorators-review-num">4 отзыва</span>
                                    <span class="sc-decorators-review-write">написать отзыв</span>
                                </div>
                                <div class="sc-decorator-page-comments-container mb-5">
                                    <div class="sc-decorators-review-card">
                                        <div class="row">
                                            <div class="col-12 sc-decorators-review-card-header d-flex align-items-center justify-content-between pb-3">
                                                <div class="sc-decorators-review-card-header-name">Татьяна Сергеевна</div>
                                            </div>
                                            <div class="col-12 sc-decorators-review-card-container d-flex pb-3">
                                                <div class="row">
                                                    <div class="col-2 sc-decorators-review-card-photo">
                                                        <img src="{{ asset('images/news-img-card.jpg') }}" alt="">
                                                    </div>
                                                    <div class="col-8 sc-decorators-review-card-text d-flex align-items-center">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates tenetur</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 sc-decorators-review-card-rate">
                                                <div class="d-flex justify-content-center">
                                                    <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                                    <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                                    <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                                    <div class="star-rating__white"><i class="fa fa-star-o"></i></div>
                                                    <div class="star-rating__white"><i class="fa fa-star-o"></i></div>
                                                </div>
                                                <div class="sc-decorators-review-card-date text-center">2 месяца назад</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sc-decorators-review-card">
                                        <div class="row">
                                            <div class="col-12 sc-decorators-review-card-header d-flex align-items-center justify-content-between pb-3">
                                                <div class="sc-decorators-review-card-header-name">Татьяна Сергеевна</div>
                                            </div>
                                            <div class="col-12 sc-decorators-review-card-container d-flex pb-3">
                                                <div class="row">
                                                    <div class="col-2 sc-decorators-review-card-photo">
                                                        <img src="{{ asset('images/news-img-card.jpg') }}" alt="">
                                                    </div>
                                                    <div class="col-8 sc-decorators-review-card-text d-flex align-items-center">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates teneturLorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates teneturLorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates teneturLorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates teneturLorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates teneturLorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates teneturLorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates tenetur</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 sc-decorators-review-card-rate">
                                                <div class="d-flex justify-content-center">
                                                    <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                                    <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                                    <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                                    <div class="star-rating__white"><i class="fa fa-star-o"></i></div>
                                                    <div class="star-rating__white"><i class="fa fa-star-o"></i></div>
                                                </div>
                                                <div class="sc-decorators-review-card-date text-center">2 месяца назад</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="sc-decorators-review-all">показать все</a>
                                </div>
                            </div>
                            <div class="sc-decorator-page-comments sc-chemicat-comments">
                                <h3>Магазины</h3>
                            </div>
                            <div class="sc-chemical-shop-list">
                                <div class="sc-chemical-shop-list-header d-flex align-items-center justify-content-center position-relative">
                                    <div class="sc-sellers-delivery sc-chemical-delivery d-flex align-items-center">
                                        <div class="pr-3">Доставка:</div>
                                        <ul class="d-flex">
                                            <li class="sc-chemical-delivery-img" style="background-image: url({{ asset('images/dhl.jpg') }});"></li>
                                            <li class="sc-chemical-delivery-img" style="background-image: url({{ asset('images/dhl.jpg') }});"></li>
                                            <li class="sc-chemical-delivery-img" style="background-image: url({{ asset('images/dhl.jpg') }});"></li>
                                        </ul>
                                    </div>
                                    <div>Название магазина</div>
                                    <div class="sc-chemical-shop-list-header-rate">
                                        <div class="d-flex justify-content-center">
                                            <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                            <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                            <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                            <div class="star-rating__white"><i class="fa fa-star-o"></i></div>
                                            <div class="star-rating__white"><i class="fa fa-star-o"></i></div>
                                        </div>
                                        <div class="sc-chemical-shop-list-header-reviews text-center"><span>2</span> отзыва</div>
                                    </div>
                                </div>
                                <div class="sc-chemical-shop-list-content">
                                    <div class="sc-chemical-shop-list-info">
                                        <span>Категория</span>
                                        <span>Характеристика</span>
                                    </div>
                                    <div class="sc-shop-list-content-element d-flex justify-content-between align-items-center">
                                        <div class="sc-shop-list-content-element-name">Росток</div>
                                        <div class="sc-shop-list-content-element-price"><span>707.65</span> рублей</div>
                                    </div>
                                    <div class="sc-shop-list-content-element d-flex justify-content-between align-items-center">
                                        <div class="sc-shop-list-content-element-name">Росток</div>
                                        <div class="sc-shop-list-content-element-price"><span>707.65</span> рублей</div>
                                    </div>
                                    <div class="sc-shop-list-content-element d-flex justify-content-between align-items-center">
                                        <div class="sc-shop-list-content-element-name">Росток</div>
                                        <div class="sc-shop-list-content-element-price"><span>707.65</span> рублей</div>
                                    </div>
                                </div>
                                <div class="sc-chemical-shop-list-footer">
                                    <div class="d-flex align-items-center sc-chemical-shop-list-footer-phone">
                                        <i class="fa fa-phone"></i>
                                        <div class="property-shop__phone-number">+789******</div>
                                        <a href="#" class="property-shop__phone-show">
                                            Показать телефон
                                        </a>
                                    </div>
                                    <a href="#" class="property-shop__phone-btn">В Магазин</a>
                                </div>
                                <a href="#" class="sc-decorators-review-all">показать все</a>
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