
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
                                    <li class="breadcrumb-item active">Справочная информация</li>
                                </ol>
                                <div class="sc-bookmark-all-container">
                                    <div class="d-flex">
                                        <div class="sc-bookmark-all ml-3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="sc-page-title-block-container">Спавка по абрикосу</div>
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
                                                <div class=" sc-foto-gallery-element-additional-foto" style="background-image: url('/storage/app/public/{{ $reference->main_photo }}');">
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
                                            <h3>{{ $reference->title }}</h3>
                                            {!! $reference->description !!}
                                        </div>
                                        <div class="mt-auto d-flex position-relative">
                                            <a href="#" class="sc-content-text-btn-more">Отправить свою статью на модерацию</a>
                                            <a href="#" class="sc-question-btn ml-2">?</a>
                                            <div class="sc-question-hide-window sc-reference-hide-window">Станьте автором одной из статей на портале</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 sc-content-text-description-container">
                                <h3>Описание статьи</h3>
                                <div class="sc-content-text-description">
                                    {!! $reference->full_description !!}
                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/_cTGxrWdqJM" allowfullscreen></iframe>
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