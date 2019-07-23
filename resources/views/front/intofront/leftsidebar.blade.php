<?php

use App\Models\User;
use App\Models\Profile;
use App\Models\Sort_questionary;
use App\Models\MyPlants;
?>

    <div>
    @if((new User())->getUserId() != '')
            <a href="{{ URL::to('/my-order') }}" class="sc-basket-link-container mx-auto">
                <div class="sc-basket-container d-flex flex-column align-items-center
                        justify-content-center">
                    <img src="{{ asset('images/basket.logo.png') }}">
                    <div class="sc-basket-name">КОРЗИНА</div>
                    <div class="sc-basket-circle">0</div>
                </div>
            </a>

        <?php

        switch( (new Profile())->currentRole((new User())->getUserId()) ) {
        case 'U'; ?>
            <ul class="sc-main-left-content-menu">
                    <li><a href="{{ URL::to('/personal-info') }}">Личные данные</a></li>
                    <li><a href="{{ URL::to('/my-order') }}">Мои заказы</a></li>
                    <li>
                        <a href="{{ URL::to('/my-plants') }}">Мои растения
                            <span class="sc-main-left-content-menu-message"><?= MyPlants::getCountPlantsUser();?></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/bookmarks') }}">Мои закладки
                            <span data-v-8b9831aa="" class="sc-main-left-content-menu-message">0</span>
                        </a>
                    </li>
                    <li><a href="{{ URL::to('/notification') }}">Уведомления
                            <span class="sc-main-left-content-menu-message">0</span>
                        </a>
                    </li>
                    <li><a href="{{ URL::to('/questionnaire') }}">Мои анкеты
                            <span class="sc-main-left-content-menu-message"><?= Sort_questionary::getCountQuestionary(); ?></span>
                        </a>
                    </li>
                </ul>

            <?php break; ?>
        <?php case 'C'; ?>
            <ul class="sc-main-left-content-menu">
                <li><a href="{{ URL::to('/personal-info') }}">Личные данные</a></li>
                <li><a href="{{ URL::to('/my-order') }}">Мои заказы</a></li>
                <li>
                    <a href="{{ URL::to('/my-plants') }}">Мои растения
                        <span class="sc-main-left-content-menu-message"><?= MyPlants::getCountPlantsUser();?></span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to('/bookmarks') }}">Мои закладки
                        <span data-v-8b9831aa="" class="sc-main-left-content-menu-message">0</span>
                    </a>
                </li>
                <li><a href="{{ URL::to('/notification') }}">Уведомления
                        <span class="sc-main-left-content-menu-message">0</span>
                    </a>
                </li>
                <li><a href="{{ URL::to('/questionnaire') }}">Мои анкеты
                        <span class="sc-main-left-content-menu-message"><?= Sort_questionary::getCountQuestionary(); ?></span>
                    </a>
                </li>
            </ul>

            <?php break; ?>
        <?php case 'S'; ?>
            <ul class="sc-main-left-content-menu">
                <li><a href="{{ URL::to('/personal-info/seller') }}">Личные данные</a></li>
                <li><a href="{{ URL::to('/my-order') }}">Мои заказы</a></li>
                <li>
                    <a href="{{ URL::to('/sumtable') }}">Планирование сезонов</a>
                </li>
                <li>
                    <a href="{{ URL::to('/assortment') }}">Мои ассортимент</a>
                </li>
                <li>
                    <a href="{{ URL::to('/notification') }}">Уведомления
                        <span class="sc-main-left-content-menu-message">0</span>
                    </a>
                </li>

            </ul>

            <?php break; ?>
        <?php case 'D'; ?>
            <ul class="sc-main-left-content-menu">
                <li><a href="{{ URL::to('/personal-info/decorator') }}">Личные данные</a></li>
                <li>
                    <a href="#">Уведомления
                        <span class="sc-main-left-content-menu-message">0</span>
                    </a>
                </li>
            </ul>

            <?php break; ?>
        <?php case 'O'; ?>
            <div>
                <ul class="sc-main-left-content-menu">
                    <li><a href="{{ URL::to('/personal-info/organizer') }}">Личные данные</a></li>
                    <li><a href="#">Мои мероприятия</a></li>
                    <li>
                        <a href="{{ URL::to('/notification') }}">Уведомления
                            <span class="sc-main-left-content-menu-message">0</span>
                        </a>
                    </li>
                </ul>

                <label for="file-event" class="sc-basket-btn">Создать мероприятие</label>
                <input type="file" id="file-event" class="download">

            </div>

            <?php break; ?>

        <?php } ?>
        @else
            <a href="{{ url('/register') }}" class="sc-basket-link-container mx-auto">
                <div class="sc-basket-container d-flex flex-column align-items-center
                        justify-content-center">
                    <img src="{{ asset('images/basket.logo.png') }}">
                    <div class="sc-basket-name">КОРЗИНА</div>
                    <div class="sc-basket-circle">0</div>
                </div>
            </a>
        @endif

            </div>