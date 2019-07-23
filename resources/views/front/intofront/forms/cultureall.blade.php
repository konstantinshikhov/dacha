@if(count($data) > 0)
    @foreach($data as $item)
        <a href="{{'/public/cultures/Sad/view/' . $item->cultureId}}" class="sc-cul-item ">
            <p class="text-center sc-cul-item-name"> {{$item->cultureName}}</p>
            <div>
                <div class="sc-cul-item-img"
                     style="background-image: url('/storage/app/public/{{$item->culturePhoto}}');">
                </div>

                <div class="sc-cul-item__block mt-3">
                    <div class="sc-cul-item__block-quentity">{{$item->countsort}} сортов</div>
                </div>
            </div>
        </a>
    @endforeach
    {{--<nav class="col-12">--}}
        {{--{{ $data->links() }}--}}
    {{--</nav>--}}
@else
    <span>К сожалению поиск не дал результатов </span>
@endif