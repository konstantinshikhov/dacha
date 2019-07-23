
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
                    </div>
                        @endforeach
                </div>
                <div class="col sc-main-center-content">
                    <div class="row">
                        <div class="col-12 sc-events-title-container sc-events-title-container-top d-flex
                            align-items-start justify-content-between">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Флористы, декораторы и ландшафтные дизайнеры</li>
                            </ol>
                            <div class="decorator-menu__sort d-flex">
                                <div class="decorator-menu__sort-itemfirst">Сортировать по:</div>
                                <div class="decorator-menu__sort-item">Цене</div>
                                <div class="decorator-menu__sort-item">Рейтинг</div>
                                <div class="decorator-menu__sort-item">Алфавит</div>
                                <div class="decorator-menu__sort-item">Новички</div>
                            </div>
                        </div>

                        <div class="col-12">
                            @if($notresult)
                                <h3>{{ $notresult }}</h3>
                            @endif
                            @foreach($users as $user)
                            <div class="sc-decorators-card-item d-flex">
                                <img class="sc-decorators-card-item-img" src="/public/uploads/photos/{{ $user->photo }}" alt="">
                                <div class="sc-decorators-card-item-content d-flex flex-column">
                                    <p class="h3"><b>{{ $user->first_name . ' ' . $user->last_name}}</b></p>
                                    <p class="sc-decorators-card-text">{!! $user->about_me_decorator !!}</p>
                                    <div class="sc-decorators-content-more-foto d-flex align-items-center mt-auto">
                                        <div class="sc-decorators-content-more-img" style="background-image: url(images/news-img-card.jpg);"></div>
                                        <div class="sc-decorators-content-more-img" style="background-image: url(images/news-img-card.jpg);"></div>
                                        <div class="sc-decorators-content-more-img" style="background-image: url(images/news-img-card.jpg);"></div>
                                        <div class="sc-decorators-content-more-img" style="background-image: url(images/news-img-card.jpg);"></div>
                                    </div>

                                </div>
                                <div class="sc-decorators-card-item-additional d-flex align-items-center flex-column">

                                    <div class="d-flex align-items-center pt-3">
                                        <div class="d-flex ">
                                            <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                            <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                            <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                            <div class="star-rating__white"><i class="fa fa-star-o"></i></div>
                                            <div class="star-rating__white"><i class="fa fa-star-o"></i></div>
                                        </div>
                                        <div class="sc-decorators-card-item-reviews">
                                            <span>23 </span> отзыва
                                        </div>
                                    </div>
                                    <div class="sc-decorators-card-work-price">
                                        Стоимость работ

                                    </div>
                                    <a href="" class="sc-decorators-card-work-price-btn"><span>{{ $user->max_price_decorator }}</span> рублей</a>
                                </div>

                                <a href="{{ URL::to('/decorator-all/view') . '/'. $user->user_id }}" class="sc-decorators-card-item-btn">Подробнее</a>
                            </div>
                            @endforeach

                        </div>
                        <nav class="col-12">
                            {{ $users->links() }}
                        </nav>
                    </div>
                </div>
                @component('front.intofront.rightsidebar')
                @endcomponent
            </div>
        </div>
    </section>
@endsection