<?php

use App\Models\User;
use App\Models\Profile;

?>

<div class="col sc-main-right-content">
    <div class="d-flex align-items-center sc-right-buttons-container position-relative">
        <div class="sc-right-professions-buttons-main">
            <div class="sc-right-professions-buttons <?php if ((new User())->getUserId() != '' and (new Profile())->currentRole((new User())->getUserId()) != 'C'): ?> sc-close-item-img <?php endif; ?>"
                    style="background-image: url({{ asset('images/profession-icon1.png') }});">

            </div>
            <div class="sc-right-professions-buttons @if((new Profile())->currentRole((new User())->getUserId()) != 'S') sc-close-item-img @endif"
                    style="background-image: url({{ asset('images/profession-icon2.png') }});">

            </div>
            <div class="sc-right-professions-buttons @if((new Profile())->currentRole((new User())->getUserId()) != 'O') sc-close-item-img @endif"
                 style="background-image: url({{ asset('images/profession-icon3.png') }});"></div>

            <div class="sc-right-professions-buttons @if((new Profile())->currentRole((new User())->getUserId()) != 'D') sc-close-item-img @endif"
                 style="background-image: url({{ asset('images/profession-icon4.png') }});"></div>

        </div>
        <div class="sc-right-professions-buttons-absolute">
            <a href="{{ URL::to('/user-role') . '/C' }} " class="sc-right-professions-buttons-hover">
                <img src="{{ asset('images/profission-mini-1.png') }}" alt="" style="width: 83%;">
            </a>
            <a href="@if((new Profile())->isSeller((new User())->getUserId()) == 1){{ URL::to('/user-role') . '/S' }}@else #@endif" class="sc-right-professions-buttons-hover"
               style="@if((new Profile())->isSeller((new User())->getUserId()) != 1)background: #b3b3b39e;@endif">
                <img src="{{ asset('images/profission-mini-2.png') }}" alt=""
                     style="width: 65%;@if((new Profile())->isSeller((new User())->getUserId()) != 1)opacity:0.5;@endif">
            </a>
            <a href="@if((new Profile())->isPartymaker((new User())->getUserId()) == 1){{ URL::to('/user-role') . '/O' }}@else # @endif" class="sc-right-professions-buttons-hover"
               style="@if((new Profile())->isPartymaker((new User())->getUserId()) != 1)background: #b3b3b39e;@endif">
                <img src="{{ asset('images/profission-mini-3.png') }}" alt=""
                     style="width: 57%;@if((new Profile())->isPartymaker((new User())->getUserId()) != 1)opacity:0.5;@endif">
            </a>
            <a href="@if((new Profile())->isDecorator((new User())->getUserId()) == 1){{ URL::to('/user-role') . '/D' }}@else #@endif" class="sc-right-professions-buttons-hover"
               style="@if((new Profile())->isDecorator((new User())->getUserId()) != 1)background: #b3b3b39e; @endif">
                <img src="{{ asset('images/profission-mini-4.png') }}" alt=""
                     style="width: 80%;
                     @if((new Profile())->isDecorator((new User())->getUserId()) != 1)opacity:0.5; @endif
                    ">
            </a>
        </div>
    </div>
    <ul class="sc-right-category-buttons-container d-fle">
        <li class="sc-right-category-buttons d-flex align-items-center justify-content-center"><a href="{{ URL::to('/cultures/Sad') }}">Каталог <br> растений</a></li>
        <li class="sc-right-category-buttons d-flex align-items-center justify-content-center"><a href="{{ URL::to('/chemical') }}"> Каталог препаратов и химикатов</a></li>
        <li class="sc-right-category-buttons d-flex align-items-center justify-content-center"><a href="{{ URL::to('/rate') }}">Тарифы</a></li>
        <li class="sc-right-category-buttons d-flex align-items-center justify-content-center"><a href="{{ URL::to('/events') }}">События и мероприятия</a></li>
        <li class="sc-right-category-buttons d-flex align-items-center justify-content-center"><a href="{{ URL::to('/decorator-all') }}">Декораторы и флористы</a></li>
    </ul>
</div>