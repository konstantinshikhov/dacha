
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content">
                    @component('front.intofront.leftsidebar')
                    @endcomponent
                    @foreach($filters as $filter)
                    <div class="sc-check-container">
                        <div class="sc-check-title">{{$filter['name']}}:</div>
                        @foreach($filter['attributes'] as $id => $attr)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="sc-specialization-Celebrations">
                            <label class="form-check-label" for="sc-specialization-Celebrations">{{$attr}}</label>
                        </div>
                        @endforeach
                    @endforeach
                    </div>
{{--                    <div class="sc-check-container">--}}
{{--                        <div class="sc-check-title">Область работы мастера:</div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-work-area-Florist">--}}
{{--                            <label class="form-check-label" for="sc-work-area-Florist">Флорист</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-work-area-Landscape">--}}
{{--                            <label class="form-check-label" for="sc-work-area-Landscape">Ландшафтный дизайнер</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-work-area-decorator">--}}
{{--                            <label class="form-check-label" for="sc-work-area-decorator">Декоратор</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="col sc-main-center-content-chemical">

                    <div class="row">
                        <div class="col-12 sc-sellers-page-breadcrumb-bottom">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item active">{{ $title }}</li>
                            </ol>

                            <div class="sc-search-element-container">
                                <div class="sc-category-search-element d-flex align-items-center">
                                    <form method="get" action="{{ url('/sellers') }}">
                                        <input type="search" name="search" placeholder="Поиск по продавцам">
                                        <button type="submit" class=""></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="sc-sellers-category__list d-flex">
                                <li class="sellers-category__list-item"><a href="">Цена</a></li>
                                <li class="sellers-category__list-item"><a href="">Рейтинг</a></li>
                                <li class="sellers-category__list-item"><a href="">Алфавит</a></li>
                                <li class="sellers-category__list-item"><a href="">Новые</a></li>
                            </ul>
                        </div>
                        <div class="col-12 sc-sellers-all-container">
                            @if($notresult)
                                <h3>{{ $notresult }}</h3>
                            @endif
                            @foreach($users as $user)
                                <div class="sc-sellers-card-item d-flex">
                                    <img class="sc-sellers-card-item-img" src="/public/uploads/photos/{{ $user->photo }}" alt="">
                                    <div class="sc-sellers-card-item-content d-flex flex-column">
                                        <p class="h3"><b>{{ $user->first_name . ' ' . $user->last_name}}</b></p>
                                        <p class="sc-decorators-card-text">{!! $user->about_me_seller !!}</p>
                                        <div class="sc-sellers-delivery d-flex align-items-center mt-auto">
                                            <div class="pr-3 sc-sellers-content-delivery-mail">Доставка:</div>
                                            <ul class="d-flex">
                                                <li class="sc-sellers-delivery-img" style="background-image: url(images/dhl.jpg);"></li>
                                                <li class="sc-sellers-delivery-img" style="background-image: url(images/dhl.jpg);"></li>
                                                <li class="sc-sellers-delivery-img" style="background-image: url(images/dhl.jpg);"></li>
                                                <li class="sc-sellers-delivery-img" style="background-image: url(images/dhl.jpg);"></li>
                                                <li class="sc-sellers-delivery-img" style="background-image: url(images/dhl.jpg);"></li>
                                            </ul>


                                        </div>

                                    </div>
                                    <div class="sc-sellers-card-item-additional d-flex align-items-center flex-column">

                                        <div class="d-flex align-items-center pt-3">
                                            <div class="d-flex ">
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
                                            <div class="sc-sellers-card-item-reviews">
                                                <span>23 </span> отзыва
                                            </div>
                                        </div>
                                        <div class="sc-sellers-card-work-price">
                                            Стоимость товаров

                                        </div>
                                        <a href="" class="sc-sellers-card-work-price-btn"><span>{{ $user->max_price_seller }}</span> рублей</a>
                                    </div>

                                    <a href="{{ URL::to('/sellers/view') . '/'. $user->user_id }}" class="sc-sellers-card-item-btn">Подробнее</a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <nav class="col-12">

                        {{ $users->links() }}
                    </nav>
                </div>
                @component('front.intofront.rightsidebar')
                @endcomponent
            </div>
        </div>
    </section>
@endsection