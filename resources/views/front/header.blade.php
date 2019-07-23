<?php

use App\Models\User;
use App\Models\Profile;

?>
<header class="sc-main-header">

  <div class="sc-header-dark-bg d-none d-lg-block">
    <div class="container d-flex align-items-center">
      <nav class="sc-header-dark-nav">
        <a href="{{ URL::to('/events') }}">Календарь мероприятий</a>
        <a href="{{ URL::to('/news') }}">Новости портала</a>
        <a href="{{ URL::to('/about-us') }}">Контакты</a>
      </nav>
      <div class="ml-auto sc-header-dark-contacts d-flex align-items-center">
        <a class="sc-header-tell" href="tel:+79205663391">+7 925-206-51-11</a>

        <a class="sc-header-email" href="mailto:cleverdacha@gmail.com">Cleverdacha@gmail.com</a>
      </div>

    </div>
  </div>
  <div class="sc-header-waves-bg">
    <div class="container">
      <div class="sc-mobile-menu-container text-center position-relative py-3 d-lg-none">
        <img src="images/header-logo-main.png" alt="" width="170">
        <a href="{{ URL::to('/') }}" class="sc-header-menu-btn">
          <i class="fa fa-bars fa-2x"></i>
        </a>
      </div>
      <div class="d-none d-lg-block">
        <div class="sc-header-waves-container d-flex align-items-center">
          <a href="{{ URL::to('/') }}"><img src="images/header-logo-main.png" alt="company logo" width="125" height="60"> </a>
          <nav class="sc-header-waves-nav">
            <a href="{{ URL::to('cultures/Sad') }}">Каталог</a>
            <a href="{{ URL::to('/sellers') }}">Поставщики</a>
            <a href="{{ URL::to('/decorator-all') }}">Декораторы и флористы</a>
            <a href="{{ URL::to('/rate') }}">Тарифы</a>

          </nav>
          <div class="ml-auto sc-header-waves-right d-flex">
            <div class="basket-container d-flex">
              <div class="sc-header-waves-basket">
                <div class="sc-header-basket-quantity">3</div>
              </div>
              <span class="sc-header-basket-price pl-3"> 0 руб.</span>
            </div>
            <div class="sc-header-waves-reg d-flex">
              @if((new User())->getUserId() != '')
                <a class="sc-header-enter" href="{{ URL::to('/logout') }}">Выйти</a>
              @else
                <a class="sc-header-enter" href="{{ URL::to('/log-in') }}">Войти</a>
                <a class="sc-header-registration" href="{{ URL::to('/register') }}">Регистрация</a>
              @endif


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12 col-md-7 sc-header-content">
        <h1>Современный информационный  портал о садоводстве</h1>
        <p><b>Создай уголок своей мечты!</b> Просто выбери подходящий <br> раздел или введи нужное название!
        </p>
        <form class="form-container" method="get" action="{{ url('/search-cultures') }}">
          <div class="d-flex align-items-center">
            <select class="sc-main-select" data-placeholder="Pазделы" name="section" required >
              <option></option>
              <option value="6" class="sc-option-sad-color">Сад</option>
              <option value="5" class="sc-option-ogorod-color">Огород</option>
              <option value="4" class="sc-option-clumba-color">Клумба</option>
            </select>
            <input class="sc-search-input" type="search" name="search" placeholder="Введите название">

          </div>
          <button class="form-button mt-4" type="submit"><b>Найти</b></button>
        </form>
      </div>
    </div>
  </div>
</header>