
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content ">
                    @component('front.intofront.leftsidebar')
                    @endcomponent
                      @foreach ($filters as $filter)
                    <div class="sc-check-container">
                        <div class="sc-check-title">{{$filter['name']}}</div>
                        @foreach ($filter['attributes'] as $id => $attr)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input pests"
                                   id="sc-leaf-damage-curled-{{$id}}" data-id="{{$id}}">
                            <label class="form-check-label" for="sc-leaf-damage-curled-{{$id}}">{{$attr}}</label>
                        </div>
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-leaf-damage-die-off">--}}
{{--                            <label class="form-check-label" for="sc-leaf-damage-die-off">Отмирают</label>--}}
{{--                        </div>--}}
                        @endforeach
                    </div>
                        @endforeach
{{--                    <div class="sc-check-container">--}}
{{--                        <div class="sc-check-title">Повреждение ствола:</div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="sc-stem-damage-bloom">--}}
{{--                            <label class="form-check-label" for="sc-stem-damage-bloom">Покрытие налетом</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="sc-check-container">--}}
{{--                        <div class="sc-check-title">Повреждение соцветий:</div>--}}

{{--                    </div>--}}
{{--                    <div class="sc-check-container">--}}
{{--                        <div class="sc-check-title">Повреждение плодов:</div>--}}

{{--                    </div>--}}
                </div>
                <div class="col sc-main-center-content">
                    @component('front.intofront.tab',['cultureType'=>$cultureType])
                    @endcomponent

                    <div class="row">
                        <div class="col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Вредители</li>
                            </ol>
                            <div class="sc-search-element-container">
                                <div class="sc-category-search-element d-flex align-items-center">

                                        <form method="get" action="{{ url('/pests/'.$cultureType) }}">
                                            <input type="search" name="search" placeholder="Поиск по вредителю">
                                            <button type="submit" class=""></button>
                                        </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row section-pests-container">
                                <div class="col-12" id="pest-container">
                                    @if($notresult)
                                        <h3>{{ $notresult }}</h3>
                                    @endif

                                    @foreach($pests as $pest)
                                        <div class="sc-pests-card-item d-flex">
                                            <img class="sc-pests-card-item-img" src="/storage/app/public/{{ $pest->main_photo }}" alt="">
                                            <div class="sc-pests-card-item-content">
                                                <p class="h3"><b>{{ $pest->name }}</b></p>
                                                <p class="sc-pests-card-text">{!! Illuminate\Support\Str::limit($pest->description, 600) !!}</p>
                                                <a href="{{ $cultureType.'/view/' . $pest->id }}" class="sc-pests-card-item-btn">Подробнее</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <nav class="col-12">
                            {{ $pests->links() }}
                        </nav>
                    </div>
                </div>
                @component('front.intofront.rightsidebar')
                @endcomponent
            </div>
        </div>
    </section>
@endsection