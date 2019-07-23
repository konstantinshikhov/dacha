<aside class="main-sidebar">
  <section class="sidebar">

    <!-- Sidebar user panel (Optional) -->
    {{-- <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('adminlte/asset/admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div> --}}

    <!-- Search form (Optional) -->
    {{-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
      </div>
    </form> --}}

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      {{-- <li class="header">HEADER</li> --}}
      <!-- Optionally, you can add icons to the links -->
      {{-- <li><a href="#"><i class="fa fa-link"></i><span>Link</span></a></li> --}}
      {{-- <li><a href="#"><i class="fa fa-link"></i><span>Another Link</span></a></li> --}}

      <li class="{{ $activeMenu == 'statistics' ? 'active' : '' }} treeview">
        <a href="#"><i class="fa fa-bar-chart"></i><span>Статистика</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="/public/admin/statistics/users">Пользователи</a></li>
          <li><a href="/public/admin/statistics/chemicals">Химикаты</a></li>
          <li><a href="/public/admin/statistics/cultures">Культуры</a></li>
          <li><a href="/public/admin/statistics/sorts">Сорта</a></li>
          <li><a href="/public/admin/statistics/pests_diseases">Вредители и заболевания</a></li>
          <li><a href="/public/admin/statistics/handbooks">Справочная информация</a></li>
          <li><a href="/public/admin/statistics/events">События</a></li>
          <li><a href="/public/admin/statistics/photos">Фото</a></li>
          <li><a href="/public/admin/statistics/responses">Коментарии</a></li>
          <li><a href="/public/admin/statistics/questions">Вопросы-ответы</a></li>
          <li><a href="/public/admin/statistics/orders">Заказы</a></li>
          <li><a href="/public/admin/statistics/questionaries">Анкеты</a></li>
        </ul>
      </li>

      <li class="{{ $activeMenu == 'tables' ? 'active' : '' }} treeview">
        <a href="#"><i class="fa fa-table"></i><span>Таблицы</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">

          <li><a href="/public/admin/feedback">Письма</a></li>

          <li><a href="/public/admin/notifications">Уведомления</a></li>

          <li><a href="/public/admin/users">Пользователи</a></li>

          <li><a href="/public/admin/questionaries">Анкеты</a></li>

          <li><a href="/public/admin/tariffs">Тарифы</a></li>

          <li><a href="/public/admin/chemicals">Химикаты</a></li>
          
          <li class="treeview">
            <a href="#"><span>Культуры</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/public/admin/cultures/klumba">Клумба</a></li>
              <li><a href="/public/admin/cultures/ogorod">Огород</a></li>
              <li><a href="/public/admin/cultures/sad">Сад</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#"><span>Сорта</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/public/admin/sorts/klumba">Клумба</a></li>
              <li><a href="/public/admin/sorts/ogorod">Огород</a></li>
              <li><a href="/public/admin/sorts/sad">Сад</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#"><span>Заболевания</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/public/admin/diseases/klumba">Клумба</a></li>
              <li><a href="/public/admin/diseases/ogorod">Огород</a></li>
              <li><a href="/public/admin/diseases/sad">Сад</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#"><span>Вредители</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/public/admin/pests/klumba">Клумба</a></li>
              <li><a href="/public/admin/pests/ogorod">Огород</a></li>
              <li><a href="/public/admin/pests/sad">Сад</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#"><span>Фильтры</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              <li class="treeview">
                <a href="#"><span>Клумба</span>
                  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="/public/admin/filters/klumba">Общие фильтры</a></li>
                  <li><a href="/public/admin/filters/klumba?culture_sorts=1">Фильтры сортов культур</a></li>
                </ul>
              </li>

              <li class="treeview">
                <a href="#"><span>Огород</span>
                  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="/public/admin/filters/ogorod">Общие фильтры</a></li>
                  <li><a href="/public/admin/filters/ogorod?culture_sorts=1">Фильтры сортов культур</a></li>
                </ul>
              </li>

              <li class="treeview">
                <a href="#"><span>Сад</span>
                  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="/public/admin/filters/sad">Общие фильтры</a></li>
                  <li><a href="/public/admin/filters/sad?culture_sorts=1">Фильтры сортов культур</a></li>
                </ul>
              </li>

              {{-- <li><a href="/public/admin/filters/klumba">Клумба</a></li>
              <li><a href="/public/admin/filters/ogorod">Огород</a></li>
              <li><a href="/public/admin/filters/sad">Сад</a></li> --}}
              
              <li><a href="/public/admin/filters/pests">Вредители</a></li>
              <li><a href="/public/admin/filters/diseases">Заболевания</a></li>
              <li><a href="/public/admin/filters/chemicals">Химикаты</a></li>
              <li><a href="/public/admin/filters/handbooks">Справки</a></li>
              <li><a href="/public/admin/filters/sellers">Продавцы</a></li>
              <li><a href="/public/admin/filters/decorators">Декораторы</a></li>
              <li><a href="/public/admin/filters/events">События</a></li>
              {{-- <li><a href="/public/admin/filters/handbooks">Справочная информация</a></li> --}}
            </ul>
          </li>

          <li><a href="/public/admin/categories">Категории</a></li>

          <li><a href="/public/admin/characteristics">Характеристики</a></li>

          <li><a href="/public/admin/handbooks">Справочная информация</a></li>

          <li><a href="/public/admin/events">События</a></li>

          <li class="treeview">
            <a href="#"><span>Модерация</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/public/admin/moderate/photos">Фото</a></li>
              <li><a href="/public/admin/moderate/videos">Видео</a></li>
              <li><a href="/public/admin/moderate/responses">Коментарии</a></li>
              <li><a href="/public/admin/moderate/questions">Вопросы-ответы</a></li>
            </ul>
          </li>

          <li><a href="/public/admin/front_text">Текст на сайте</a></li>

          <li><a href="/public/admin/ethnosciences">Народный календарь</a></li>

          <li class="treeview">
            <a href="#"><span>Лунный календарь</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/public/admin/moon_phases/dates">Лунные дни</a></li>
              <li><a href="/public/admin/moon_phases/phases">Лунные фазы</a></li>
              <li><a href="/public/admin/moon_phases/actions">Действия</a></li>
              <li><a href="/public/admin/moon_phases/klumba">Клумба</a></li>
              <li><a href="/public/admin/moon_phases/ogorod">Огород</a></li>
              <li><a href="/public/admin/moon_phases/sad">Сад</a></li>
            </ul>
          </li>

          <li><a href="/public/admin/delivery_methods">Способы доставки</a></li>

        </ul>
      </li>
    </ul>

  </section>
</aside>