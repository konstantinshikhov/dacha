
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
                                <div class="sc-check-title">{{$filter['name']}}:</div>
                                @foreach ($filter['attributes'] as $attrId => $attrName)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input sort"
                                               id="sc-growing-area-houseplants-{{$attrId}}" data-id="{{$attrId}}">
                                        <label class="form-check-label" for="sc-growing-area-houseplants-{{$attrId}}">{{$attrName}}</label>
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
                                <li class="breadcrumb-item active">{{ $title }}</li>
                            </ol>
                            <div class="sc-search-element-container">
                                <div class="sc-category-search-element d-flex align-items-center">
                                    <form method="get" action="{{ url('/culture-all/'.$cultureType) }}">
                                        <input type="search" name="search" placeholder="Поиск по культуре">
                                        <button type="submit" class=""></button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 sc-culture-all-container d-flex flex-wrap">
                                @if($notresult)
                                    <h3>{{ $notresult }}</h3>
                                @endif
                                
                                @for ($i = 0; count($cultureSort) > $i; $i++)
                                    <a href="{{ url(Request::path().'/view/' . $cultureSort[$i]->id) }}" class="sc-cul-item ">
                                        <p class="text-center sc-cul-item-name">{{ $cultureSort[$i]->name }}</p>
                                        <div>
                                            <div class="sc-cul-item-img" style="background-image: url('/storage/app/public/{{ $cultureSort[$i]->photo }} ');">
                                            </div>

                                            <div class="sc-cul-item__block mt-3">
                                                <div class="sc-cul-item__block-quentity">{{ $cultureSort[$i]->countsort }} сортов</div>
                                            </div>
                                        </div>
                                    </a>
                                @endfor

                        </div>

                    </div>
                    <nav class="col-12">
                        {{ $cultures->links() }}
                    </nav>
                </div>
                @component('front.intofront.rightsidebar')
                @endcomponent
            </div>
        </div>
    </section>
@endsection