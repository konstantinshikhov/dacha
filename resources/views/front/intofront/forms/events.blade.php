
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
                    <div class="form-check" >
                        <input type="checkbox" class="form-check-input" name="{{$attr}}" id="sc-type-{{$id}}">
                        <label class="form-check-label" for="sc-type-{{$id}}">{{$attr}}</label>
                    </div>
                    @endforeach

                </div>
                @endforeach
            </div>
            <div class="col sc-main-center-content">
                <div class="row">
                    <div class="col-12 sc-events-title-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center sc-events-mark-container">
                            <div class="sc-events-mark d-flex align-items-center ">
                                <div class="sc-events-mark-blue"></div>
                                <div>Выставки</div>
                            </div>
                            <div class="sc-events-mark d-flex align-items-center">
                                <div class="sc-events-mark-red"></div>
                                <div>Фестивали</div>
                            </div>
                            <div class="sc-events-mark d-flex align-items-center">
                                <div class="sc-events-mark-yellow"></div>
                                <div>Ярмарки</div>
                            </div>
                            <div class="sc-events-mark d-flex align-items-center">
                                <div class="sc-events-mark-green"></div>
                                <div>Новости</div>
                            </div>
                            <div class="sc-events-mark d-flex align-items-center">
                                <div class="sc-events-mark-orange"></div>
                                <div>Другое</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @if($notresult)
                            <h3>{{ $notresult }}</h3>
                        @endif
                        @foreach($events as $event)
                            <div class="sc-events-card-item d-flex">
                                <img class="sc-events-card-item-img" src="/storage/app/public/{{ $event->main_photo }}" alt="">
                                <div class="sc-events-card-item-content">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="h3">{{ $event->title }}</p>
                                            <div class="sc-events-information-item">Мероприятие пройдет: <br>
                                                <span>{{ $event->date }}</span>
                                            </div>
                                            <div class="sc-events-information-item">Организатор: <br>
                                                <span>{{ $event->partymaker }}</span>
                                            </div>
                                            <div class="sc-events-information-item">Контакты организатора: <br>
                                                <span></span>
                                            </div>
                                            <div class="sc-events-information-item">Сайт: <br>
                                                <span>wsasa@sdsdsd.swd</span>
                                            </div>
                                            <div class="sc-events-information-item">Facebook: <br>
                                                <span></span>
                                            </div>
                                            <div class="sc-events-information-item">Vkontakte: <br>
                                                <span></span>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <p><b>Подробнее о мероприятии</b></p>
                                            <img class="img-fluid" src="/storage/app/public/{{ $event->main_photo }}" alt="">
                                            <div class="pt-4">
                                                {!! html_entity_decode(Illuminate\Support\Str::limit($event->description, 600)) !!}

                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ URL::to('/events/view'). '/'. $event->id }}" class="sc-events-card-item-btn">Подробнее</a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <nav class="col-12">


                        {{ $events->links() }}

                    </nav>
                </div>
            </div>
            @component('front.intofront.rightsidebar')
            @endcomponent
        </div>
    </div>
</section>
@endsection