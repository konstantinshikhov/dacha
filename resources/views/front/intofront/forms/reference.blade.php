
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
                        @foreach($filter['attributes'] as $attrId => $attrName)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="sc-leaf-damage-curled">
                            <label class="form-check-label" for="sc-leaf-damage-curled">{{$attrName}}</label>
                        </div>
                        @endforeach
                    </div>
                     @endforeach
                </div>
                <div class="col sc-main-center-content">
                    @component('front.intofront.tab',['cultureType'=>$cultureType])
                    @endcomponent

                    <div class="row">
                        <div class="col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Справочная</li>
                            </ol>
                            <div class="sc-search-element-container">
                                <div class="sc-category-search-element d-flex align-items-center">
                                    <form method="get" action="{{ url('/reference-information/'.$cultureType) }}" >
                                        <input type="search" name="search" placeholder="Поиск по справочной">
                                        <button type="submit" class=""></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row section-pests-container">
                                <div class="col-12">
                                    @if($notresult)
                                        <h3>{{ $notresult }}</h3>
                                    @endif
                                    @foreach($references as $reference)
                                        <div class="sc-pests-card-item d-flex">
                                            <img class="sc-pests-card-item-img" src="/storage/app/public/{{ $reference->main_photo }}" alt="">
                                            <div class="sc-pests-card-item-content">
                                                <p class="h3"><b>{{ $reference->title }}</b></p>
                                                <p class="sc-pests-card-text">{!! Illuminate\Support\Str::limit($reference->description, 600) !!}</p>
                                                <a href="{{ url("reference-information/$cultureType/view/" . $reference->id) }}" class="sc-pests-card-item-btn">Подробнее</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <nav class="col-12">
                            {{ $references->links() }}
                        </nav>
                    </div>
                </div>
                @component('front.intofront.rightsidebar')
                @endcomponent
            </div>
        </div>
    </section>
@endsection