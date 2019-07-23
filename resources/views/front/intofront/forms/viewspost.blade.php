
@extends('front.intofront.main')

@section('form')


    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content">
                    @component('front.intofront.leftsidebar')
                    @endcomponent
                </div>
                <div class="col-9 sc-main-center-content sc-slider-page-width">
                    <div class="row">
                        <div class="col-12 sc-events-title-container sc-events-title-container-top">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('events/') }}">События</a></li>
                                <li class="breadcrumb-item active"> {!! $event->title !!}</li>
                            </ol>
                            <div class="sc-bookmark sc-bookmark-questions"></div>
                        </div>
                        <div class="col-12 sc-slider-event">
                            <div class="sc-slider-event-foto" style="background-image: url('/storage/app/public/{{ $event->main_photo }}')"></div>
                        </div>

                        <div class="col-12 sc-events-information-container">
                            {!! $event->description !!}
                        </div>
                        <div class="col-12 sc-events-information-buttons">
                            <a href="#" class="sc-events-information-button-yellow">Задать вопрос</a>
                        </div>
                    </div>
                </div>
                @component('front.intofront.rightsidebar')
                @endcomponent
            </div>
        </div>
    </section>
@endsection