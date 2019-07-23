

@if(count($data) > 0)
    @foreach($data as $item)

    <div class="sc-pests-card-item d-flex">
        <img class="sc-pests-card-item-img" src="/storage/app/public/{{ $item->pestPhoto }}" alt="">
        <div class="sc-pests-card-item-content">
            <p class="h3"><b>{{ $item->pestName }}</b></p>
            <p class="sc-pests-card-text">{!! Illuminate\Support\Str::limit($item->pestDescription, 600) !!}</p>
            <a href="{{ $typeOfPests.'/view/' . $item->pestId }}" class="sc-pests-card-item-btn">Подробнее</a>
        </div>
    </div>

    @endforeach
@else
    <span>К сожалению поиск не дал результатов </span>
@endif