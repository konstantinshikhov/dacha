
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content ">
                    @component('front.intofront.leftsidebar')
                    @endcomponent
                </div>
                <div class="col sc-main-center-content">
                    @component('front.intofront.tab',['cultureType'=>$cultureType])
                    @endcomponent
                    <div class="row">
                        <div class="col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url::to('pests') }}">Заболевания</a></li>
                                <li class="breadcrumb-item active">{{ $pests->name }}</li>
                            </ol>
                        </div>
                        <div class="col-6 ">
                            <div class="sc-page-title-block-container"> {{ $pests->name }}</div>
                        </div>
                        <div class="col-6">
                            <div class="sc-bookmark"></div>
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
                                            <div class=" sc-foto-gallery-element-additional-foto" style="background-image: url('/storage/app/public/{{ $pests->main_photo }}');">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class=" sc-foto-gallery-element-additional-foto" style="background-image: url({{ asset('images/news-img.jpg') }});">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class=" sc-foto-gallery-element-additional-foto" style="background-image: url({{ asset('images/news-img.jpg') }});">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 sc-content-text-container d-flex flex-column">
                                   <div class="sc-content-text-inform pb-4">
                                        <h3>Как бороться с вредителем:</h3>
                                        {!! $pests->fight !!}
                                    </div>
                                    <div class="sc-content-text-products">
                                        <h3>Какие препараты использовать:</h3>
                                        <ul class="sc-content-text-products-list">
                                            @foreach($chemicals as $chemical)
                                                <li><a href="/public/chemical/view/{{$chemical[0]->id}}">{{ $chemical[0]->name }}</a>
                                                    <div class="d-flex sc-product-list-stars">
                                                        @php for($i=0;$i<floor($chemical[0]->rating);$i++):
                                                            echo'<div class="star-rating__dark"><i class="fa fa-star"></i></div>';
                                                        endfor;
                                                            if(($chemical[0]->rating -(floor($chemical[0]->rating)))!=0):
                                                            echo'<div class="star-rating__dark"><i class="fa fa-star-half-o"></i></div>';
                                                            endif;
                                                        for($i=0;$i<=4-round($chemical[0]->rating, 0, PHP_ROUND_HALF_UP);$i++):
                                                            echo'<div class="star-rating__dark"><i class="fa fa-star-o"></i></div>';
                                                        endfor;
                                                        @endphp

                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="mt-auto d-flex position-relative pt-4">
                                        <a href="#" class="sc-content-text-btn-more">Загрузить дополнительное фото</a>
                                        <a href="#" class="sc-question-btn ml-3">?</a>
                                        <div class="sc-question-hide-window">Загрузить фото для обучения ИИ</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 sc-content-text-description-container">
                            <h3>Описание статьи</h3>
                            <div class="sc-content-text-description">
                                <p>{!! $pests->description !!}</p>
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