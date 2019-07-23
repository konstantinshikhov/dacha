<?php

use App\Models\User;
use App\Models\Profile;

?>
<?php

  switch (url()->current()) {
    case URL::to('/cultures/Sad');
      request()->session()->forget('urlCur');
      request()->session()->push('urlCur', url()->current());
      break;
    case URL::to('/cultures/Ogorod');
      request()->session()->forget('urlCur');
      request()->session()->push('urlCur', url()->current());
      break;
    case URL::to('/cultures/Klumba');
      request()->session()->forget('urlCur');
      request()->session()->push('urlCur', url()->current());
      break;
  }


?>
<header class="sc-header-content-page">
  <div class="container">
    <div class="row flex-nowrap justify-content-between">
      <div class="sc-header-content-items d-flex align-items-center justify-content-between">
        <a href="{{ URL::to('/cultures/Sad') }}" class="header-content-item1 @if(URL::to('/cultures/Sad') == request()->session()->get('urlCur')[0] )active @endif"></a>
        <a href="{{ URL::to('/cultures/Ogorod') }}" class="header-content-item2 @if(URL::to('/cultures/Ogorod') == request()->session()->get('urlCur')[0])active @endif"></a>
        <a href="{{ URL::to('/cultures/Klumba') }}" class="header-content-item3 @if(URL::to('/cultures/Klumba') == request()->session()->get('urlCur')[0])active @endif"></a>
      </div>
      <div class="col sc-header-center-container">
        <div class="sc-header-title">
          <p>Создай уголок своей мечты!</p>
        </div>
        <form class="form-container position-relative" method="get" action="{{ url('/search-cultures') }}">
          <div class="d-flex align-items-center sc-header-search-container">
            <select class="sc-header-content-select" name="section" data-placeholder="Разделы" required >
              <option></option>
              <option value="12" >Все разделы</option>
              <option value="6" class="sc-option-sad-color">Сад</option>
              <option value="5" class="sc-option-ogorod-color">Огород</option>
              <option value="4" class="sc-option-clumba-color">Клумба</option>
              <option value="7" >Каталог химикатов</option>
              <option value="8" >Мероприятия</option>
              <option value="9" >Артикулы</option>
              <option value="10" >Декораторы и флористы</option>
              <option value="11" >Поставщики</option>
            </select>
            <input class="sc-search-input sc-search-input-header" type="search" name="search" placeholder="Введите название">
          </div>
          <button class="form-button sc-header-search-button" type="submit"></button>
        </form>
      </div>
      <div class=" sc-header-authorization-container">
        <div class="sc-header-authorization">
          <a href="{{ URL::to('/') }}" class="sc-header-main-page">Главная страница</a>
          <div class="d-flex">
            @if((new User())->getUserId() != '')
              <a class="sc-header-enter" href="{{ URL::to('/logout') }}">Выйти</a>
            @else
              <a class="sc-header-enter" href="{{ URL::to('/log-in') }}">Войти</a>
              <a class="sc-header-registration" href="{{ URL::to('/register') }}">Регистрация</a>
            @endif

          </div>
          <ul class="sc-socials-container d-flex justify-content-between pt-2">
            <li class="sc-header-socials sc-header-socials-icon-vk"><a href=""></a></li>
            <li class="sc-header-socials sc-header-socials-icon-ins"><a href=""></a></li>
            <li class="sc-header-socials sc-header-socials-icon-tw"><a href=""></a></li>
            <li class="sc-header-socials sc-header-socials-icon-fb"><a href=""></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>