

<div class="sc-main-culture-menu d-flex">
    <a href="{{ URL::to('/cultures/'.$cultureType) }}" class="sc-main-culture-menu__item">Сорта</a>
    <a href="{{ URL::to('/pests/'.$cultureType) }}" class="sc-main-culture-menu__item">Вредители</a>
    <a href="{{ URL::to('/diseases/'.$cultureType) }}" class="sc-main-culture-menu__item">Заболевания</a>
    <a href="{{ URL::to('/reference-information/'.$cultureType) }}" class="sc-main-culture-menu__item">Справочная</a>
    <a href="{{ URL::to('/question/'.$cultureType) }}" class="sc-main-culture-menu__item">Вопрос-ответ</a>
</div>
