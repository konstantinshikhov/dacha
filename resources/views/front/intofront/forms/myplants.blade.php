
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content">
                @component('front.intofront.leftsidebar')
                @endcomponent
                </div>
                <div class="col sc-main-center-content-my-plants">

                    <div class="row">
                        <div class="col-12 sc-my-plants-breadcrumb-bottom">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item active">Мои растения</li>
                            </ol>

                            <div class="sc-buttons-element-container d-flex">
                                <div class="sc-buttons-element-container-inner d-flex">
                                    <a href="#"  class="sc-my-plants-btn-img" style="background-image: url(images/svodnaya.png);">
                                    </a>
                                    <a href="#"  class="sc-my-plants-btn-img" style="background-image: url(images/statistica-cultur.png);">
                                    </a>
                                    <a href="#"  class="sc-my-plants-btn-img" style="background-image: url(images/lunnyj.png);">
                                    </a>

                                </div>
                                <a href="#"  class="sc-my-plants-btn-img" style="background-image: url(images/prognoz-urozhay.png);">
                                </a>
                                <a href="#" class="sc-my-plants-btn-img" style="background-image: url(images/virtualnyj-sad.png">
                                </a>

                            </div>
                        </div>

                        <div class="col-12 sc-my-plants-all-container">
                            <div class="row">
                                @foreach($myPlants as $myPlant)
                                    <a href="{{ '/public/culture-all/view/sellers/' . $myPlant->id }}" class="sc-sorts-item d-flex flex-column">
                                    <div class="sorts-item__name">{{ $myPlant->name }}</div>
                                    <div class="sorts-item__block mt-auto">
                                        <div class="sc-sorts-item-img position-relative" style="background-image: url('/storage/app/public/{{ $myPlant->main_photo }}');">
                                            <span class="sorts-item-quantity">0</span>
                                        </div>
                                        <div class="sorts-item__block-reviews">
                                            <div class="sorts-item__block-stars">
                                                <div class="text-center sc-star-rating-sorts">
                                                    <span class="star-rating__dark"><i class="fa fa-star"></i></span>
                                                    <span class="star-rating__dark"><i class="fa fa-star"></i></span>
                                                    <span class="star-rating__dark"><i class="fa fa-star"></i></span>
                                                    <span class="star-rating__white"><i class="fa fa-star-o"></i></span>
                                                    <span class="star-rating__white"><i class="fa fa-star-o"></i></span>
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

                    </div>
                </div>
                    @component('front.intofront.rightsidebar')
                    @endcomponent
            </div>
        </div>
    </section>
@endsection