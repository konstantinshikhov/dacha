
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content">
                @component('front.intofront.leftsidebar')
                @endcomponent
                </div>
                <div class="col sc-main-center-content-chemical">
                    <div class="row">
                        <div class="col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Уведомления</li>
                            </ol>
                        </div>
                        <div class="col-12">

                            <div class="notification-menu__top">
                                <label class="notification-menu__top-item" for="notification-menu-check">
                                    <input type="checkbox" class="checkbox" id="notification-menu-check">
                                    <span class="checkbox-custom"></span>
                                    <span class="label">Выбрать все уведомления</span>
                                </label>
                                <div class="notification-menu__top-item">Отметить как прочитанное</div>
                                <div class="notification-menu__top-item">Отметить как избранное</div>
                                <div class="notification-menu__top-item">Удалить</div>
                            </div>
                            <div class="notification-menu__bot-container">
                                <div class="notification-menu__bot">
                                    <div class="notification-menu__bot-item">Все уведомления</div>
                                    <div class="notification-menu__bot-item">Сообщения</div>
                                    <div class="notification-menu__bot-item">Комментарии</div>
                                    <div class="notification-menu__bot-item">Заказы</div>
                                    <div class="notification-menu__bot-item active_sort">Поддержка</div>
                                </div>
                            </div>
                            <div class="notification-list"></div>

                        </div>
                        <div class="col-12 sc-notification-comments-section">
                            <div class="sc-notification-comments-container">
                                <div class="row">
                                    <div class="col-2 sc-notification-comments-image mt-2 pr-0">
                                        <div class="sc-notification-comments-img mx-auto" style="background-image: url(images/tree.png);"></div>
                                    </div>
                                    <div class="col-8 sc-notification-comments-block">
                                        <div class="sc-notification-comments-date d-flex align-items-center">12.12.2012</div>
                                        <div class="sc-notification-comments-name">Комментарий</div>
                                        <div class="sc-notification-comments-title">Пользователь <span><a href="#">Сергеев Сергей</a></span> добавил комментарий к записи <span> <a href="#">Очень важная тема</a></span></div>
                                        <div class="sc-notification-comments-message">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae voluptas eligendi pariatur perferendis molestias veniam delectus voluptate explicabo accusantium a obcaecati cum provident perspiciatis beatae ipsam, illo dolores officia tempore praesentium tenetur vitae. Dignissimos, modi soluta iste quisquam praesentium quia id. Harum voluptatem quam adipisci iusto, facere dicta quae quibusdam.</p>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="d-flex align-items-start sc-notification-btn-container">
                                            <a href="" class="sc-notification-btn-read">Прочитано</a>
                                            <a href="" class="sc-notification-btn-deleate">Удалить</a>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="sc-notification-1">
                                                <label class="sc-notification-check-label" for="sc-notification-1"></label>
                                            </div>
                                        </div>
                                        <div class="sc-notification-btn-more-container">
                                            <a href="#" class="sc-notification-btn-more">
                                                <span class="notification-btn-text">Развернуть</span>
                                                <span class="notification-btn-arrow"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sc-notification-comments-container">
                                <div class="row">
                                    <div class="col-2 sc-notification-comments-image  mt-2 pr-0">
                                        <div class="sc-notification-comments-img mx-auto" style="background-image: url(images/tree.png);"></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="sc-notification-comments-date d-flex align-items-center">12.12.2012
                                            <span class="sc-notification-new">NEW</span> </div>
                                        <div class="sc-notification-comments-name">Сообщение Владимира Иванова</div>
                                        <div class="sc-notification-comments-title">Тема: Очень важная тема</div>
                                        <div class="sc-notification-comments-message">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae voluptas eligendi pariatur perferendis molestias veniam delectus voluptate explicabo accusantium a obcaecati cum provident perspiciatis beatae ipsam, illo dolores officia tempore praesentium tenetur vitae. Dignissimos, modi soluta iste quisquam praesentium quia id. Harum voluptatem quam adipisci iusto, facere dicta quae quibusdam.</p>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="d-flex align-items-start sc-notification-btn-container">
                                            <a href="" class="sc-notification-btn-read">Прочитано</a>
                                            <a href="" class="sc-notification-btn-deleate">Удалить</a>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="sc-notification-2">
                                                <label class="sc-notification-check-label" for="sc-notification-2"></label>
                                            </div>
                                        </div>
                                        <div class="sc-notification-btn-more-container">
                                            <a href="#" class="sc-notification-btn-more">
                                                <span class="notification-btn-text">Развернуть</span>
                                                <span class="notification-btn-arrow"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sc-notification-comments-container">
                                <div class="row">
                                    <div class="col-2 sc-notification-comments-image">
                                        <div class="sc-notification-comments-img mx-auto mt-2" style="background-image: url(images/tree.png);"></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="sc-notification-comments-date d-flex align-items-center">12.12.2012</div>
                                        <div class="sc-notification-comments-name">Комментарий</div>
                                        <div class="sc-notification-comments-title">Пользователь <span><a href="#">Сергеев Сергей</a></span> добавил комментарий к записи <span> <a href="#">Очень важная тема</a></span></div>
                                        <div class="sc-notification-comments-message">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae voluptas eligendi pariatur perferendis molestias veniam delectus voluptate explicabo accusantium a obcaecati cum provident perspiciatis beatae ipsam, illo dolores officia tempore praesentium tenetur vitae. Dignissimos, modi soluta iste quisquam praesentium quia id. Harum voluptatem quam adipisci iusto, facere dicta quae quibusdam.</p>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="d-flex align-items-start sc-notification-btn-container">
                                            <a href="" class="sc-notification-btn-read">Прочитано</a>
                                            <a href="" class="sc-notification-btn-deleate">Удалить</a>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="sc-notification-3">
                                                <label class="sc-notification-check-label" for="sc-notification-3"></label>
                                            </div>
                                        </div>
                                        <div class="sc-notification-btn-more-container">
                                            <a href="#" class="sc-notification-btn-more">
                                                <span class="notification-btn-text">Развернуть</span>
                                                <span class="notification-btn-arrow"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sc-notification-comments-container sc-notification-orders-container">
                                <div class="row">
                                    <div class="col-2 sc-notification-comments-image  mt-2 pr-0">
                                        <div class="sc-notification-comments-img mx-auto" style="background-image: url(images/tree.png);"></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="sc-notification-comments-date d-flex align-items-center">12.12.2012</div>
                                        <div class="sc-notification-orders-name">Заказ на миллион</div>
                                        <div class="sc-notification-comments-title">Заказчик: <span><a href="#">Сергеев Сергей</a></span></div>
                                        <div class="sc-notification-order-text-container">
                                            <b>Подробности заказ:</b>
                                            <div class="sc-notification-order-text pt-1">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae voluptas eligendi pariatur perferendis molestias veniam delectus voluptate explicabo accusantium a obcaecati cum provident perspiciatis beatae ipsam, illo dolores officia tempore praesentium tenetur vitae. Dignissimos, modi soluta iste quisquam praesentium quia id. Harum voluptatem quam adipisci iusto, facere dicta quae quibusdam.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="d-flex align-items-start sc-notification-btn-container">
                                            <a href="" class="sc-notification-btn-read">Прочитано</a>
                                            <a href="" class="sc-notification-btn-deleate">Удалить</a>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="sc-notification-4">
                                                <label class="sc-notification-check-label" for="sc-notification-4"></label>
                                            </div>
                                        </div>
                                        <div class="sc-notification-btn-more-container">
                                            <a href="#" class="sc-notification-btn-more">
                                                <span class="notification-btn-text">Развернуть</span>
                                                <span class="notification-btn-arrow"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <nav class="col-12">
                            <ul class="pagination justify-content-center align-items-center">
                                <li class="page-item disabled mr-3">
                                    <a class="page-link" href="#"><
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item disabled"><a class="page-link">...</a></li>
                                <li class="page-item"><a class="page-link" href="">5</a></li>
                                <li class="page-item ml-3">
                                    <a class="page-link" href="#">>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                    @component('front.intofront.rightsidebar')
                    @endcomponent
            </div>
        </div>
    </section>
@endsection