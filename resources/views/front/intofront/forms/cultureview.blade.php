
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content ">
                    @component('front.intofront.leftsidebar')
                    @endcomponent
                        <div class="sc-check-container" >
                            <div class="sc-check-title"></div>
                            @foreach ($filters as $filter)
                                <div class="sc-check-container">
                                    <div class="sc-check-title">{{$filter['name']}}:</div>
                                    @foreach ($filter['attributes'] as $attrId => $attrName)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                   id="sc-growing-area-houseplants{{$attrId}}" data-id="{{$attrId}}">
                                            <label class="form-check-label" for="sc-growing-area-houseplants">{{$attrName}}</label>
                                        </div>
                                        @endforeach
                                </div>
                            @endforeach
                        </div>


                </div>
                <div class="col sc-main-center-content">
                    @component('front.intofront.tab',['cultureType'=>$cultureType])
                    @endcomponent
                        <div class="row">
                            <div class="col-12 sc-sort-page-breadcrumb-bottom">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Культура</a></li>
                                    <li class="breadcrumb-item active">Сорта</li>
                                </ol>

                                <div class="sc-search-element-container">
                                    <div class="sc-category-search-element d-flex align-items-center">
                                        <form method="get" action="{{ url('/culture-all/'.$cultureType.'/view') . '/' . $id }}">
                                            <input type="search" name="search" placeholder="Поиск по сорту">
                                            <button type="submit" class=""></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="sc-sorts-category__list d-flex">
                                    <li class="sorts-category__list-item"><a href="">По популярности</a></li>
                                    <li class="sorts-category__list-item"><a href="">По рейтингу</a></li>
                                    <li class="sorts-category__list-item"><a href="">По алфавиту</a></li>
                                    <li class="sorts-category__list-item"><a href="">Новинки</a></li>
                                </ul>
                            </div>
                            <div class="col-12 sc-sorts-all-container">
                                <div class="row">
                                    @if($notresult)
                                        <h3>{{ $notresult }}</h3>
                                    @endif
                                    @foreach($sorts as $sort)
                                        <a href="{{ '/public/culture-all/view/sellers/' . $sort->id }}" class="sc-sorts-item d-flex flex-column">
                                        <div class="sorts-item__name">{{ $sort->name }}</div>
                                        <div class="sorts-item__block mt-auto">
                                            <div class="sc-sorts-item-img" style="background-image: url('/storage/app/public/{{ $sort->main_photo }} ');">
                                            </div>
                                            <div class="sorts-item__block-reviews">
                                                <div class="sorts-item__block-stars">
                                                    <div class="text-center sc-star-rating-sorts">
                                                        @php for($i=0;$i<floor($sort->rating);$i++):
                                                echo'<span class="star-rating__dark"><i class="fa fa-star"></i></span>';
                                            endfor;
                                                if(($sort->rating -(floor($sort->rating)))!=0):
                                                echo'<span class="star-rating__white"><i class="fa fa-star-half-o"></i></span>';
                                                endif;
                                            for($i=0;$i<=4-round($sort->rating, 0, PHP_ROUND_HALF_UP);$i++):
                                                echo'<span class="star-rating__white"><i class="fa fa-star-o"></i></span>';
                                            endfor;
                                                        @endphp
                                                    </div>
                                                    <div>
                                                        <div class="sorts-item__block-text"><span>4</span> отзывов
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            <nav class="col-12">
                                {{ $sorts->links() }}
                            </nav>
                        </div>

                </div>
                @component('front.intofront.rightsidebar')
                @endcomponent
            </div>
        </div>
    </section>
@endsection