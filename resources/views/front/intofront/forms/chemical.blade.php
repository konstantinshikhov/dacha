
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content ">
                    @component('front.intofront.leftsidebar')
                    @endcomponent
                        @foreach($filters as $filter)
                    <div class="sc-check-container">
                        <div class="sc-check-title">{{$filter['name']}}:</div>
                             @foreach($filter['attributes'] as $id => $attr)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="sc-type-herbicides">
                            <label class="form-check-label" for="sc-type-herbicides">{{$attr}}</label>
                        </div>
                             @endforeach
                    </div>
                        @endforeach
{{--                    <div class="sc-check-container">--}}
{{--                        <div class="sc-check-title">Производитель:</div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-producer-GREEN-BELT">--}}
{{--                            <label class="form-check-label" for="sc-producer-GREEN-BELT">GREEN BELT</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-producer-agroprogres">--}}
{{--                            <label class="form-check-label" for="sc-producer-agroprogres">ООО "Компания Агропрогресс"</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-producer-sammit-agro">--}}
{{--                            <label class="form-check-label" for="sc-producer-sammit-agro">"Саммит Агро"</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-producer-singenta">--}}
{{--                            <label class="form-check-label" for="sc-producer-singenta">ООО «Сингента»</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="sc-check-container">--}}
{{--                        <div class="sc-check-title">Основное вещество:</div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-substance-nitrogen">--}}
{{--                            <label class="form-check-label" for="sc-substance-nitrogen">Азот</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-substance-potassium">--}}
{{--                            <label class="form-check-label" for="sc-substance-potassium">Калий</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-substance-magnesium">--}}
{{--                            <label class="form-check-label" for="sc-substance-magnesium">Магний</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-substance-phosphorus">--}}
{{--                            <label class="form-check-label" for="sc-substance-phosphorus">Фосфор</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-substance-iron">--}}
{{--                            <label class="form-check-label" for="sc-substance-iron">Железо</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-substance-sulfur">--}}
{{--                            <label class="form-check-label" for="sc-substance-sulfur">Сера</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-substance-copper">--}}
{{--                            <label class="form-check-label" for="sc-substance-copper">Медь</label>--}}
{{--                        </div>--}}

{{--                    </div>--}}
                </div>
                <div class="col sc-main-center-content-chemical" >
                    <div class="row">
                        <div class="col-12 sc-sort-page-breadcrumb-bottom">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item active">Химикаты</li>
                            </ol>

                            <div class="sc-search-element-container">
                                <div class="sc-category-search-element d-flex align-items-center">
                                    <form method="get" action="{{ url('/chemical') }}">
                                        <input type="search" name="search" placeholder="Поиск по химикату">
                                        <button type="submit" class=""></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="sc-sorts-category__list d-flex">
                                <li class="sorts-category__list-item"><a href="">По алфавиту</a></li>
                                <li class="sorts-category__list-item"><a href="">По производителю</a></li>
                                <li class="sorts-category__list-item"><a href="">По рейтингу</a></li>
                                <li class="sorts-category__list-item"><a href="">Самые продаваемые</a></li>
                            </ul>
                        </div>
                        <div class="col-12 sc-chemical-all-container">
                            @if($notresult)
                                <h3>{{ $notresult }}</h3>
                            @endif
                            <div class="row">
                                @foreach($chemicals as $chemical)
                                    <a href="{{ URL::to('/chemical/view') . '/' . $chemical->id }}" class="sc-chemical-element d-flex flex-column">

                                        <div class="sc-chemical-item-img" style="background-image: url('/storage/app/public/{{ $chemical->main_photo }}')"></div>
                                        <div class="chemical-item__name">{{ $chemical->name }}</div>
                                        <div class="chemical-item__title">{!! Illuminate\Support\Str::limit($chemical->description, 200) !!} </div>
                                        <div class="mt-auto">
                                            <div class="sorts-item__block-stars">
                                                <div class="text-center sc-star-rating-sorts">
                                                    <span class="star-rating__dark"><i class="fa fa-star"></i></span>
                                                    <span class="star-rating__dark"><i class="fa fa-star"></i></span>
                                                    <span class="star-rating__dark"><i class="fa fa-star"></i></span>
                                                    <span class="star-rating__white"><i class="fa fa-star-o"></i></span>
                                                    <span class="star-rating__white"><i class="fa fa-star-o"></i></span>
                                                </div>

                                            </div>
                                            <span class="chemical-item-reviews">Отзывы: 0</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <nav class="col-12">
                        {{ $chemicals->links() }}
                    </nav>
                </div>
            </div>
            @component('front.intofront.rightsidebar')
            @endcomponent
        </div>
    </section>
@endsection