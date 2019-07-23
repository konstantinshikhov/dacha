
@extends('front.intofront.main')

@section('form')
<section class="sc-main sc-main-page-content">
    <div class="container">
        <div class="row flex-nowrap">
            <div class="col-2 sc-main-left-content ">
                @component('front.intofront.leftsidebar')
                @endcomponent
                <div class="sc-check-container">
                    <div class="sc-check-title">Тип мероприятия:</div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="sc-type-Fair">
                        <label class="form-check-label" for="sc-type-Fair">Ярмарка</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="sc-type-Festival">
                        <label class="form-check-label" for="sc-type-Festival">Фестиваль</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="sc-type-show">
                        <label class="form-check-label" for="sc-type-show">Выставка</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="sc-type-news" checked>
                        <label class="form-check-label" for="sc-type-news"  >Новости сайта</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="sc-type-other">
                        <label class="form-check-label" for="sc-type-other">Другое...</label>
                    </div>

                </div>
            </div>
            <div class="col sc-main-center-content">
                <div class="row">
                    <div class="col-12 sc-events-title-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Новости портала</li>
                        </ol>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center sc-events-mark-container">
                            <div class="sc-events-mark d-flex align-items-center ">
                                <div class="sc-events-mark-blue"></div>
                                <div>Выставки</div>
                            </div>
                            <div class="sc-events-mark d-flex align-items-center">
                                <div class="sc-events-mark-red"></div>
                                <div>Фестивали</div>
                            </div>
                            <div class="sc-events-mark d-flex align-items-center">
                                <div class="sc-events-mark-yellow"></div>
                                <div>Ярмарки</div>
                            </div>
                            <div class="sc-events-mark d-flex align-items-center">
                                <div class="sc-events-mark-green"></div>
                                <div>Новости</div>
                            </div>
                            <div class="sc-events-mark d-flex align-items-center">
                                <div class="sc-events-mark-orange"></div>
                                <div>Другое</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="sc-events-card-item d-flex">
                            <img class="sc-events-card-item-img" src="images/121.png" alt="">
                            <div class="sc-events-card-item-content">
                                <div class="row">
                                    <div class="col-4">
                                        <p class="h3">Московский международный фестиваль садов и цветов</p>
                                        <div class="sc-events-information-item">Мероприятие пройдет: <br>
                                            <span>22.12.2012</span>
                                        </div>
                                        <div class="sc-events-information-item">Организатор: <br>
                                            <span></span>
                                        </div>
                                        <div class="sc-events-information-item">Контакты организатора: <br>
                                            <span></span>
                                        </div>
                                        <div class="sc-events-information-item">Сайт: <br>
                                            <span>wsasa@sdsdsd.swd</span>
                                        </div>
                                        <div class="sc-events-information-item">Facebook: <br>
                                            <span></span>
                                        </div>
                                        <div class="sc-events-information-item">Vkontakte: <br>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <p><b>Подробнее о мероприятии</b></p>
                                        <img class="img-fluid" src="images/121.png" alt="">
                                        <div class="pt-4">
                                            <p><b>Lorem ipsum dolor sit amet, consectetur adipisicing.</b></p>
                                            <p><b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis voluptatibus corrupti repellendus rerum sint.</b></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos iure magnam esse obcaecati ea voluptates hic soluta vero cumque, inventore veritatis, asperiores consequatur explicabo, ullam est vitae commodi architecto facere in dolores modi nisi. Neque!</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ URL::to('/news/view') }}" class="sc-events-card-item-btn">Подробнее</a>
                            </div>
                        </div>
                        <div class="sc-events-card-item d-flex">
                            <img class="sc-events-card-item-img" src="images/121.png" alt="">
                            <div class="sc-events-card-item-content">
                                <div class="row">
                                    <div class="col-4">
                                        <p class="h3">Название</p>
                                        <div class="sc-events-information-item">Мероприятие пройдет: <br>
                                            <span>22.12.2012</span>
                                        </div>
                                        <div class="sc-events-information-item">Количество участников: <br>
                                            <span>34</span>
                                        </div>

                                    </div>
                                    <div class="col-8">
                                        <p><b>Подробнее о мероприятии</b></p>

                                        <div class="pt-4">
                                            <p><b>Lorem ipsum dolor sit amet, consectetur adipisicing.</b></p>
                                            <p><b>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis voluptatibus corrupti repellendus rerum sint.</b></p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos iure magnam esse obcaecati ea voluptates hic soluta vero cumque, inventore veritatis, asperiores consequatur explicabo, ullam est vitae commodi architecto facere in dolores modi nisi. Neque!</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ URL::to('/news/view') }}" class="sc-events-card-item-btn">Подробнее</a>
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