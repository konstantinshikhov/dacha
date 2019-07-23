
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
                            <ol class="breadcrumb sc-breadcrumb-bookmarks-page">
                                <li class="breadcrumb-item active">Топики</li>
                            </ol>
                            <div class="d-flex main-center__title-folder">
                                <button class="main-center__title--button"><img src="images/newBookmark.png" alt="newfolder"> <input type="text" autofocus="autofocus" placeholder="Cоздать папку" class="folders-input"></button>
                                <a href="#" class="sc-bookmarks-item-del-all d-flex align-items-center"><img src="images/delete.png" alt="newfolder" width="20"><span>Удалить все</span></a>
                            </div>
                        </div>
                        <div class="sc-bookmarks-line"></div>
                        <div class="col-12">
                            <div class="sc-bookmarks-container d-flex flex-wrap">
                                <a href="#" class="sc-bookmarks-item"><img src="images/newBookmark.png" alt="newfolder"><span>Название...</span></a>
                                <a href="#" class="sc-bookmarks-item"><img src="images/newBookmark.png" alt="newfolder"><span>Название...</span></a>
                                <a href="#" class="sc-bookmarks-item"><img src="images/newBookmark.png" alt="newfolder"><span>Название...</span></a>
                                <a href="#" class="sc-bookmarks-item"><img src="images/newBookmark.png" alt="newfolder"><span>Название...</span></a>
                                <a href="#" class="sc-bookmarks-item"><img src="images/newBookmark.png" alt="newfolder"><span>Название...</span></a>
                                <a href="#" class="sc-bookmarks-item"><img src="images/newBookmark.png" alt="newfolder"><span>Название...</span></a>
                                <a href="#" class="sc-bookmarks-item"><img src="images/newBookmark.png" alt="newfolder"><span>Название...</span></a>
                            </div>
                        </div>
                        <div class="col-12 pt-5">
                            <div class="sc-bookmarks-card-item d-flex">
                                <img class="sc-bookmarks-card-item-img" src="images/news-img-card.jpg" alt="">
                                <div class="sc-bookmarks-card-item-content">
                                    <div class="d-flex">
                                        <p class="h3"><b>Lorem ipsum dolor sit amet, consectetur.</b></p>

                                    </div>
                                    <div class="sc-bookmarks-card-date"> 22 декабря 2018</div>
                                    <p class="sc-bookmarks-card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt eius optio quis veritatis temporibus aliquam ab fuga a. Quasi ullam ea eveniet, quas, quia accusantium quibusdam?</p>
                                </div>
                                <div class="sc-bookmarks-card-close">
                                    <a href="#" class="sc-bookmarks-item-del"><img src="images/delete.png" alt="newfolder" width="20"><span>Удалить</span></a>
                                </div>
                                <a href="" class="sc-bookmarks-card-item-btn">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
                    @component('front.intofront.rightsidebar')
                    @endcomponent
            </div>
        </div>
    </section>
@endsection