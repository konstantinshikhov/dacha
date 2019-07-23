
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content ">

                    @component('front.intofront.leftsidebar')
                    @endcomponent
                </div>
                <div class="col sc-suppliers-center-content">

                    <div class="row">

                        <div class="col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ URL::to('/sellers') }}">Поставщики</a></li>
                                <li class="breadcrumb-item active">{{ $user->first_name . ' ' . $user->last_name}}</li>
                            </ol>
                            <div class="sc-bookmark-all-container">
                                <div class="d-flex">


                                    <div class="sc-suppliers-page-article-block d-flex align-items-center">
                                        @php for($i=0;$i<floor($user->rating_seller);$i++):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star"></i></div>';
                                            endfor;
                                                if(($user->rating_seller - (floor($user->rating_seller)))!=0):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star-half-o"></i></div>';
                                                endif;
                                            for($i=0;$i<=4-round($user->rating_seller, 0, PHP_ROUND_HALF_UP);$i++):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star-o"></i></div>';
                                            endfor;
                                        @endphp
                                    </div>


                                    <div class="sc-bookmark-all ml-3"></div>
                                </div>
                            </div>
                        </div>


                        <div class="col-6 ">
                            <div class="sc-page-title-block-container">Название магазина</div>
                        </div>
                        <div class="col-6">

                        </div>
                        <div class="col-12 pb-5">
                            <div class="row">
                                <div class="col-6 sc-suppliers-foto-block">
                                    <div class="row ">
                                        <div class="col-12">
                                            <div class="sc-suppliers-main-foto" style="background-image: url({{ asset('images/news-img.jpg') }});"></div>




                                        </div>

                                        <div class="col-12 sc-supliers-shop-info">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/decorator-site-logo.png') }}" width="25" alt="" class="mr-3">
                                                <a href="#">www.florist.com</a>
                                                <div class="text-center sc-supliers-contact-info-link">
                                                    <a href="#">показать контактную информацию</a>
                                                </div>
                                                <div class="text-center sc-supliers-contact-info-link">
                                                    <a href="#">показать способы доставки</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-6 sc-content-text-container d-flex flex-column">
                                    <div class="sc-content-text-description-container sc-suppliers-scription-container">
                                        <h3>О нас</h3>
                                        <div class="sc-content-text-description">
                                            {!! $user->about_me_seller !!}
                                        </div>

                                    </div>
                                    <div class="text-center">
                                        <a href="#" class="sc-suppliers-information-button-yellow">Задать вопрос</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="sc-content-suppliers-header">
                                <ul class="d-flex">
                                    <li><a href="#">Ассортимент</a></li>
                                    <li><a href="#">Комментарии</a></li>
                                    <li><a href="#">Места продажи (<span>33</span>)</a></li>
                                </ul>
                            </div>

                            <div class="sc-suppliers-table-container position-relative">
                                <div class="sc-suppliers-table-btn-container">
                                    <a href="#" class="sc-suppliers-table-btn-filter">Растения</a>
                                    <a href="#" class="sc-suppliers-table-btn-filter">Химикаты</a>
                                </div>

                                <table>
                                    <thead>
                                    <tr>
                                        <th class="sc-suppliers-table-foto">Фото</th>
                                        <th class="sc-suppliers-table-name">Название</th>
                                        <th class="sc-suppliers-table-rate">Рейтинг</th>

                                        <th class="sc-suppliers-table-category">Категория</th>
                                        <th class="sc-suppliers-table-rate">Характеристика</th>
                                        <th class="sc-suppliers-table-quantity">В наличии <br>
                                            (кол-во)</th>
                                        <th class="">Ед.изм</th>
                                        <th class="">Стоимость <br>
                                            (за ед. изм.)</th>
                                        <th class="sc-suppliers-table-quantity-buy" >Покупаемое<br> количество</th>
                                        <th class="sc-suppliers-table-button"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user_products as $product)
                                    <tr class="product{{$product->id}}">
                                        <td><img src="{{ asset('images/profession-icon3.png') }}" alt="" width="40" class="sc-assortment-table-img"></td>
                                        <td>{{$product->name}} <a href="#" class="sc-suppliers-btn-forms">?</a></td>
                                        <td>
                                            <div class="d-flex justify-content-center sc-suppliers-table-stars">
                                                @php for($i=0;$i<floor($product->rating);$i++):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star"></i></div>';
                                            endfor;
                                                if(($product->rating - (floor($product->rating)))!=0):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star-half-o"></i></div>';
                                                endif;
                                            for($i=0;$i<=4-round($product->rating, 0, PHP_ROUND_HALF_UP);$i++):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star-o"></i></div>';
                                            endfor;
                                                @endphp
                                                {{--<div class="star-rating__dark"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star-rating__dark"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star-rating__dark"><i class="fa fa-star"></i></div>--}}
                                                {{--<div class="star-rating__white"><i class="fa fa-star-o"></i></div>--}}
                                                {{--<div class="star-rating__white"><i class="fa fa-star-o"></i></div>--}}
                                            </div>
                                        </td>
                                        <td class="type">{{$product->type}}</td>
                                        <td class="characteristic">{{$product->characteristic}}</td>
                                        <td class="quantity">{{$product->quantity}}</td>
                                        <td>{{$product->unit}}</td>
                                        <td class="price{{$product->id}}">{{$product->price}}</td>
                                        <input type="hidden" id="basket_user_id_add_product" value="{{$product->user_id}}">

                                        <td>
                                            <input type="number" value="1" class="sc-suppliers-table-quantity-buy-input basket-quantity">
                                        </td>
                                        <td>
                                            <a class="sc-suppliers-table-btn addBasketProduct" href="#" data-productId="{{$product->id}}">В корзину</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <input type="hidden" id="csrf_token" value="{{csrf_token()}}">
                                <div class="sc-suppliers-table-footer">
                                    <div class="d-flex sc-suppliers-select-container align-items-center">
                                        <div class="pr-4">Параметры заказа:</div>

                                        <select class="sc-suppliers-place-select" data-placeholder="Места продажи">
                                            <option></option>
                                            <option>1</option>
                                        </select>

                                        <select id="userMethods" class="sc-suppliers-delivery-select" data-placeholder="Способ доставки">
                                            <option></option>
                                            @foreach($delivery_methods as $method)
                                                <option value="{{$method->id}}">{{$method->name}}</option>
                                            @endforeach
                                        </select>


                                        <input class="sc-suppliers-delivery-price-input" type="text" disabled>
                                    </div>
                                    <div class="sc-suppliers-order-price">
                                        Сумма заказа: <span id="price">0</span> руб.
                                    </div>
                                    <div class="mt-3 pb-4">
                                        <a href="#" class="sc-suppliers-buy-btn" id="checkout">Оформить заказ</a>
                                    </div>
                                    <nav class="sc-suppliers-information-pagination">
                                        <ul class="pagination justify-content-center align-items-center">
                                            <li class="page-item disabled mr-3">
                                               {{ $user_products->links() }}
                                            </li>
                                        </ul>
                                    </nav>
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

                        </div>
                    </div>
                </div>
                @component('front.intofront.rightsidebar')
                @endcomponent
            </div>
        </div>
    </section>
@endsection
