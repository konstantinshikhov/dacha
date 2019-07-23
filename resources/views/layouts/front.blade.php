<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Умная дача</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/common.css')}}">
</head>

<body class="d-flex flex-column">
<header class="sc-main-header">

    <div class="sc-header-dark-bg d-none d-lg-block">
        <div class="container d-flex align-items-center">
            <nav class="sc-header-dark-nav">
                <a href="">Календарь мероприятий</a>
                <a href="">События</a>
                <a href="">Контакты</a>
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
                <a href="#" class="sc-header-menu-btn">
                    <i class="fa fa-bars fa-2x"></i>
                </a>
            </div>
            <div class="d-none d-lg-block">
                <div class="sc-header-waves-container d-flex align-items-center">
                    <a href="#"><img src="images/header-logo-main.png" alt="company logo" width="125" height="60"> </a>
                    <nav class="sc-header-waves-nav">
                        <a href="">Каталоги</a>
                        <a href="">Поставщики</a>
                        <a href="">Декораторы и флористы</a>
                        <a href="">Тарифы</a>

                    </nav>
                    <div class="ml-auto sc-header-waves-right d-flex">
                        <div class="basket-container d-flex">
                            <div class="sc-header-waves-basket">
                                <div class="sc-header-basket-quantity">3</div>
                            </div>
                            <span class="sc-header-basket-price pl-3"> 0 руб.</span>
                        </div>
                        <div class="sc-header-waves-reg d-flex">
                            <a class="sc-header-enter" href="">Войти</a>
                            <a class="sc-header-registration" href="">Регистрация</a>

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
                <form class="form-container">
                    <div class="d-flex align-items-center">
                        <select class="sc-main-select" data-placeholder="Pазделы">
                            <option></option>
                            <option class="sc-option-sad-color">Сад</option>
                            <option class="sc-option-ogorod-color">Огород</option>
                            <option class="sc-option-clumba-color">Клумба</option>
                        </select>
                        <input class="sc-search-input" type="search" placeholder="Введите название">

                    </div>
                    <button class="form-button mt-4" type="button"><b>Найти</b></button>
                </form>
            </div>
        </div>
    </div>
</header>
<main class="main">
    <section class="sc-section-navigation">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Умная навигация разделов</h2>
                </div>
                <div class="col-12 sc-section-navigation-container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6 col-lg-4 sc-section-navigation-card mb-5">
                            <div class="sc-section-card-bg d-flex flex-column">
                                <div class="text-center pt-4">
                                    <img src="images/logo-sad.png" alt="">
                                </div>
                                <div class="sc-section-card-content ">
                                    <h3>Раздел «Сад»</h3>
                                    <p>Выбирайте растения данного раздела и создайте сад таким, каким видите его Вы. А мы поможем реализовать Вашу мечту.</p>
                                    <p>Примеры того, что можно найти:</p>
                                    <ul>
                                        <li>Вишня</li>
                                        <li>Вредители садовых культур</li>
                                        <li>Грунт для винограда</li>
                                    </ul>
                                </div>
                                <a class="sc-section-card-button align-self-start " href="">Перейти в раздел</a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 sc-section-navigation-card  mb-5">
                            <div class="sc-section-card-bg d-flex flex-column">
                                <div class="text-center pt-4">
                                    <img src="images/logo-ogorod.png" alt="">
                                </div>
                                <div class="sc-section-card-content sc-ogorod-card">
                                    <h3>Раздел «Огород»</h3>
                                    <p>Здесь Вы найдете информацию о сельскохозяйственных культурах, а также как посадить, как ухаживать, как удобрять и т.д.
                                    </p>
                                    <p>Примеры того, что можно найти:</p>
                                    <ul>
                                        <li>Химикат «Парус»</li>
                                        <li>Базилик</li>
                                        <li>Заболевание листьев капусты</li>
                                    </ul>
                                </div>
                                <a class="sc-section-card-button sc-button-ogorod  align-self-start " href="">Перейти в раздел</a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 sc-section-navigation-card  mb-5">
                            <div class="sc-section-card-bg d-flex flex-column">
                                <div class="text-center pt-4">
                                    <img src="images/logo-clumba.png" alt="">
                                </div>
                                <div class="sc-section-card-content sc-clumba-card">
                                    <h3>Раздел «Клумба»</h3>
                                    <p>Данный раздел подходит для любителей цветов. Украшайте дом, клумбы, дорожки и беседки. Осталось лишнее? Продавайте!
                                    </p>
                                    <p>Примеры того, что можно найти:</p>
                                    <ul>
                                        <li>Бархатцы</li>
                                        <li>Для букетов</li>
                                        <li>Декоративно-цветущие</li>
                                    </ul>
                                </div>
                                <a class="sc-section-card-button sc-button-clumba align-self-start " href="">Перейти в раздел</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sc-section-offers">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2>Наши предложения</h2>
                </div>
                <div class="col-12 text-center">
                    <div class="d-block mx-auto d-md-flex justify-content-between mt-3">
                        <div>
                            <div class="sc-offers-items">
                                <h4>Удобный поиск</h4>
                                <p>У нас вы найдете всю необходимую информацию по садоводству в одном месте.</p>
                                <img class="icon-offer-1" src="images/icon-offer-1.png" alt="">
                            </div>
                            <div class="sc-offers-items">
                                <h4>Выгодная возможность</h4>
                                <p>У нас вы можете реализовать свое хобби и получить выгоду от своей деятельности.</p>
                                <img class="icon-offer-3" src="images/icon-offer-3.png" alt="">
                            </div>
                        </div>
                        <div>
                            <div class=" sc-offers-items">
                                <h4>Уникальность</h4>
                                <p>Вам предоставится возможность создать свой неповторимый состав сада и украшения жилья.</p>
                                <img class="icon-offer-2" src="images/icon-offer-2.png" alt="">
                            </div>
                            <div class=" sc-offers-items">
                                <h4>Разнообразный функционал</h4>
                                <p>Просмотр инфографики, статистики,информации всех культур, календаря мероприятий и др.</p>
                                <img class="icon-offer-4" src="images/icon-offer-4.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img class="girl-table-png" src="images/girl-table-png.png" alt="">
        </div>
    </section>
    <section class="sc-section-how-it-works">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Как это работает?</h2>
                    <div class="col-12 col-md-8 mx-auto">
                        <p>На портале реализовано 4 роли пользователей. Выбери подходящую роль и зарегистрируйся!
                            Если ты всерьез решил заработать с помощью «Умной дачи», мы предлагаем тебе несколько тарифов!
                        </p>
                    </div>

                </div>
                <div class="sc-how-it-works-items-containers col-12">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3 sc-how-it-works-items-container">
                            <div class="sc-section-how-it-works-items">
                                <img class="main-howIt" src="images/main-howIt-1.png" alt="">
                                <h3>Покупатель</h3>
                                <p>Основная роль. Нужно пройти регистрацию и Вы сможете добавлять товар в корзину, бронировать и покупать. </p>

                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 sc-how-it-works-items-container">
                            <div class="sc-section-how-it-works-items">
                                <img class="main-howIt" src="images/main-howIt-2.png" alt="">
                                <h3>Организатор</h3>
                                <p>Позволяет выкладывать информацию о мероприятиях, выставках и фестивалях по тематике ресурса.</p>

                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 sc-how-it-works-items-container">
                            <div class="sc-section-how-it-works-items">
                                <img class="main-howIt" src="images/main-howIt-3.png" alt="">
                                <h3>Флорист</h3>
                                <p>Для пользователей, желающих продемонстрировать свое мастерство и увеличить объем своих заказов.</p>

                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 sc-how-it-works-items-container">
                            <div class="sc-section-how-it-works-items">
                                <img class="main-howIt" src="images/main-howIt-4.png" alt="">
                                <h3>Продавец</h3>
                                <p>Эта роль точно Вам подходит, если Вы хотите начать зарабатывать с помощью портала “Умной дачи”.   </p>

                            </div>
                        </div>
                    </div>
                </div>
                <a class="section-how-it-works-button mx-auto" href="#">Подробнее о тарифах</a>
            </div>
        </div>

    </section>
    <section class="sc-section-popular">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Популярные товары</h2>
                </div>
                <div class="sc-slider-popular-container col-9 mx-auto d-none d-lg-block">
                    <div class="px-3 py-3">
                        <div class="sc-popular-slider-item ">

                            <div class="sc-popular-slider-item-container">
                                <img src="images/tree.png" width="225" height="225" alt="">
                                <div class="sc-slider-item-content">
                                    <h4>Дерево апельсин</h4>
                                    <a class="sc-slider-item-button" href="">от 2600<i class="fa fa-rub"></i></a>
                                    <div class="sc-slider-stars-icon"></div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="px-3 py-3">
                        <div class="sc-popular-slider-item ">

                            <div class="sc-popular-slider-item-container">
                                <img src="images/tree.png" width="225" height="225" alt="">
                                <div class="sc-slider-item-content">
                                    <h4>Дерево апельсин</h4>
                                    <a class="sc-slider-item-button sc-element-clumba-color" href="">от 2600<i class="fa fa-rub"></i></a>
                                    <div class="sc-slider-stars-icon sc-element-clumba-color" ></div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="px-3 py-3">
                        <div class="sc-popular-slider-item ">

                            <div class="sc-popular-slider-item-container">
                                <img src="images/tree.png" width="225" height="225" alt="">
                                <div class="sc-slider-item-content">
                                    <h4>Дерево апельсин</h4>
                                    <a class="sc-slider-item-button" href="">от 2600<i class="fa fa-rub"></i></a>
                                    <div class="sc-slider-stars-icon"></div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="px-3 py-3">
                        <div class="sc-popular-slider-item ">

                            <div class="sc-popular-slider-item-container">
                                <img src="images/tree.png" width="225" height="225" alt="">
                                <div class="sc-slider-item-content">
                                    <h4>Дерево апельсин</h4>
                                    <a class="sc-slider-item-button sc-element-ogorod-color" href="">от 2600<i class="fa fa-rub"></i></a>
                                    <div class="sc-slider-stars-icon sc-element-ogorod-color"></div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <div class="d-flex d-lg-none pb-4 flex-wrap justify-content-center">
                    <div class="px-3 py-3">
                        <div class="sc-popular-slider-item ">

                            <div class="sc-popular-slider-item-container">
                                <img src="images/tree.png" width="225" height="225" alt="">
                                <div class="sc-slider-item-content">
                                    <h4>Дерево апельсин</h4>
                                    <a class="sc-slider-item-button" href="">от 2600<i class="fa fa-rub"></i></a>
                                    <div class="sc-slider-stars-icon"></div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="px-3 py-3">
                        <div class="sc-popular-slider-item ">

                            <div class="sc-popular-slider-item-container">
                                <img src="images/tree.png" width="225" height="225" alt="">
                                <div class="sc-slider-item-content">
                                    <h4>Дерево апельсин</h4>
                                    <a class="sc-slider-item-button sc-element-clumba-color" href="">от 2600<i class="fa fa-rub"></i></a>
                                    <div class="sc-slider-stars-icon sc-element-clumba-color" ></div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="px-3 py-3">
                        <div class="sc-popular-slider-item ">

                            <div class="sc-popular-slider-item-container">
                                <img src="images/tree.png" width="225" height="225" alt="">
                                <div class="sc-slider-item-content">
                                    <h4>Дерево апельсин</h4>
                                    <a class="sc-slider-item-button" href="">от 2600<i class="fa fa-rub"></i></a>
                                    <div class="sc-slider-stars-icon"></div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="px-3 py-3">
                        <div class="sc-popular-slider-item ">

                            <div class="sc-popular-slider-item-container">
                                <img src="images/tree.png" width="225" height="225" alt="">
                                <div class="sc-slider-item-content">
                                    <h4>Дерево апельсин</h4>
                                    <a class="sc-slider-item-button sc-element-ogorod-color" href="">от 2600<i class="fa fa-rub"></i></a>
                                    <div class="sc-slider-stars-icon sc-element-ogorod-color"></div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a class="section-how-it-works-button" href="#">Перейти в каталог</a>
            </div>
        </div>
    </section>
    <section class="sc-section-form">
        <div class="container position-relative">
            <diw class="row">
                <div class="col-12 text-center">
                    <h2>Мы готовы к сотрудничеству</h2>
                </div>
                <img class="sc-section-form-img-vase" src="images/221.png" alt="">
                <div class="col-0 col-md-8 col-lg-6 mx-auto">
                    <div class="sc-section-form-leaf"></div>

                    <form class="sc-form-element text-center" action="">
                        <div class="form-group">

                            <input type="email" class="form-control" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="Ваше сообщение"></textarea>
                        </div>
                        <button type="button" class="sc-form-button" href="#">Отправить</button>
                    </form>

                </div>
            </diw>

        </div>


    </section>

</main>
<footer class="sc-footer-section">
    <div class="container">
        <div class="row justify-content-between justify-content-lg-start">
            <div class="col col-md-2 pr-md-0">
                <img class="sc-logo-footer" src="images/footer-logo.png" width="100" height="49" alt="">
                <div class="pt-4 sc-socials-absolute-block">
                    <h4>Социальные сети:</h4>
                    <ul class="sc-socials-container d-flex">
                        <li class="sc-footer-socials sc-footer-socials-icon-vk"><a href=""></a></li>
                        <li class="sc-footer-socials sc-footer-socials-icon-ins"><a href=""></a></li>
                        <li class="sc-footer-socials sc-footer-socials-icon-tw"><a href=""></a></li>
                        <li class="sc-footer-socials sc-footer-socials-icon-fb"><a href=""></a></li>
                        <li class="sc-footer-socials sc-footer-socials-icon-gp"><a href=""></a></li>
                    </ul>
                </div>
            </div>
            <div class="d-none d-lg-block col-2 offset-1 pr-0">
                <h4>Навигация:</h4>
                <nav class="sc-footer-nav">
                    <ul>
                        <li><a href="">Главная</a></li>
                        <li><a href="">Каталог</a></li>
                        <li><a href="">Поставщики</a></li>
                        <li><a href="">Декораторы и флористы</a></li>
                        <li><a href="">Календарь мероприятий</a></li>
                        <li><a href="">Тарифы</a></li>
                        <li><a href="">О нас</a></li>
                        <li><a href="">Обучение</a></li>
                    </ul>
                </nav>

            </div>
            <div class=" d-none d-lg-block col-1 offset-1  pr-md-0">
                <h4>Разделы:</h4>
                <nav class="sc-footer-nav-sections">
                    <ul>
                        <li><a href="">Сад</a></li>
                        <li><a href="">Огород</a></li>
                        <li><a href="">Клумба</a></li>
                    </ul>
                </nav>

            </div>
            <div class="col-6 col-sm-4 col-lg-2 offset-lg-2 pr-lg-0 pl-0 pl-md-3">
                <h4>Наши контакты:</h4>
                <ul class="sc-footer-contacts">
                    <li class="sc-footer-contacts-phone"><a href="">+7 925-206-51-11</a></li>
                    <li class="sc-footer-contacts-mail"><a href="mailto:cleverdacha@gmail.com">Cleverdacha@gmail.com</a></li>

                </ul>
                <div class="pt-4">© Все права защищены</div>

            </div>

        </div>
    </div>
</footer>
<div class="sc-mobile-menu-section d-none">
    <div class="sc-main-mobile">
        <div class="container position-relative">
            <div class="row">
                <nav class="col-8 mx-auto sc-mobile-catalog-nav">
                    <a href="#">Календарь мероприятий</a>
                    <a href="#">События</a>
                    <a href="#">Контакты</a>
                </nav>
            </div>
            <a class="apc-button-close-mobile"><i class="fa fa-times fa-2x"></i></a>
        </div>
    </div>
    <div class="sc-header-mobile-nav-container">
        <div class="container position-relative">
            <div class="row">

                <nav class="col-8 mx-auto sc-header-mobile-nav">
                    <a href="">Каталоги</a>
                    <a href="">Поставщики</a>
                    <a href="">Декораторы и флористы</a>
                    <a href="">Тарифы</a>
                </nav>
            </div>
        </div>
    </div>

    <div class="col-10 mx-auto arc-footer-mobile text-center">
        <div class="mx-auto sc-header-waves-reg-mobile d-flex justify-content-center mb-3">
            <a class="sc-header-enter" href="">Войти</a>
            <a class="sc-header-registration" href="">Регистрация</a>
        </div>
        <div class="text-center">
            <a class="sc-header-mobile-tell" href="tel:+79205663391">+7 925-206-51-11</a>

            <a class="sc-header-mobile-mail" href="mailto:cleverdacha@gmail.com">Cleverdacha@gmail.com</a>
        </div>

    </div>
</div>
<script src="{{asset('js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/slick.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery.formstyler.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/common.js')}}" type="text/javascript"></script>
</body>
</html>