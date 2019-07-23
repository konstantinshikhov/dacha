
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content ">
                    @component('front.intofront.leftsidebar')
                    @endcomponent
                </div>
                <div class="col-9 sc-main-center-content sc-slider-page-width">
                        <div class="row">
                            <div class="col-12 sc-events-title-container sc-events-title-container-top">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ URL::to('/decorator-all') }}">Декораторы и флористы</a></li>
                                    <li class="breadcrumb-item active">{{ $user->first_name . ' ' . $user->last_name}}</li>
                                </ol>
                                <div class="sc-bookmark sc-bookmark-questions"></div>
                            </div>
                            <div class="col-12">
                                <div class="sc-slider-decorator">
                                    <div class="sc-slider-decorator-foto" style="background-image: url({{ asset('images/decorator-slider.png') }});"></div>
                                    <div class="sc-slider-decorator-foto" style="background-image: url({{ asset('images/decorator-slider.png') }});"></div>
                                    <div class="sc-slider-decorator-foto" style="background-image: url({{ asset('images/decorator-slider.png') }});"></div>
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="sc-decorators-under-slider d-flex">
                                    <div class="sc-decorator-more-foto d-flex align-items-center">
                                        <p>Другие работы мастера:</p>
                                        <div class="sc-decorators-content-more-img" style="background-image: url({{ asset('images/news-img-card.jpg') }});"></div>
                                        <div class="sc-decorators-content-more-img" style="background-image: url({{ asset('images/news-img-card.jpg') }});"></div>
                                        <div class="sc-decorators-content-more-img" style="background-image: url({{ asset('images/news-img-card.jpg') }});"></div>
                                        <div class="sc-decorators-content-more-img" style="background-image: url({{ asset('images/news-img-card.jpg') }});"></div>
                                    </div>
                                    <div class="ml-auto  text-center">
                                        <div class="sc-decorators-site d-flex align-items-center">
                                            <img src="{{ asset('images/decorator-site-logo.png') }}" alt="">
                                            <a href="#">www.florist.com</a>
                                        </div>
                                        <a href="" class="sc-sc-decorators-show-tell">показать телефон</a>
                                    </div>
                                    <a href="#" class="sc-decorator-ask">Задать вопрос</a>
                                </div>
                            </div>
                            <div class="col-12 sc-decorator-description-container">
                                <h3>Информация о себе:</h3>
                                <div class="sc-decorator-text-description">
                                    {!! $user->about_me_decorator !!}
                                </div>
                            </div>
                            <div class="col-12 sc-decorator-description-container">
                                <h3>Социальные сети:</h3>
                                <div class="sc-decorator-text-description">
                                    <ul>
                                        <li><a href="#">Вконтакте</a></li>
                                        <li><a href="#">Вконтакте</a></li>
                                        <li><a href="#">Вконтакте</a></li>
                                        <li><a href="#">Вконтакте</a></li>
                                        <li><a href="#">Вконтакте</a></li>
                                        <li><a href="#">Вконтакте</a></li>
                                        <li><a href="#">Вконтакте</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 sc-decorator-page-comments">
                                <h3>Комментарии:</h3>
                                <div class="sc-decorator-reviews-block">
                                    <span class="sc-decorators-review-num">4 отзыва</span>
                                    <span class="sc-decorators-review-write">написать отзыв</span>
                                </div>
                                <div class="sc-decorator-page-comments-container">
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

                                </div>

                                <a href="#" class="sc-decorators-review-all">показать все</a>

                            </div>
                        </div>
                    </div>

                @component('front.intofront.rightsidebar')
                @endcomponent
            </div>
        </div>
    </section>
@endsection