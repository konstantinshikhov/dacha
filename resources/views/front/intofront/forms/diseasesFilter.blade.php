@if(count($data) > 0)
    @foreach($data as $item)

        <div class="sc-pests-card-item d-flex">
            <img class="sc-pests-card-item-img" src="/storage/app/public/{{ $item->diseasePhoto }}" alt="">
            <div class="sc-pests-card-item-content">
                <p class="h3"><b>{{ $item->diseaseName }}</b></p>
                <p class="sc-pests-card-text">{!! Illuminate\Support\Str::limit($item->diseaseDescription, 600) !!}</p>
                <a href="{{ $typeOfDisease.'/view/' . $item->diseaseId }}" class="sc-pests-card-item-btn">Подробнее</a>
            </div>
        </div>

    @endforeach
@else
    <span>К сожалению поиск не дал результатов </span>
@endif