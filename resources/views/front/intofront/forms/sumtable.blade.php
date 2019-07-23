
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
                        <div class="col-12 sc-assortment-page-breadcrumb-bottom">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Сводная таблица</li>
                            </ol>
                            <a href="javascript:(print());" class="sc-reservation-print sc-reservation-print-sumtable  d-flex align-items-center">
                                <i class="fa fa-print"></i> Печать
                            </a>
                            <div class="sc-summ-table-container">
                                <table>
                                    <thead>
                                    <tr class="table-head">
                                        <td class="table-head--radiusfirst">Наименования продукта</td>
                                        <td class="table-head--year">Год</td>
                                        <td class="table-head--month ">Янв</td>
                                        <td class="table-head--month ">Фев</td>
                                        <td class="table-head--month">Март</td>
                                        <td class="table-head--month">Апр</td>
                                        <td class="table-head--month">Май</td>
                                        <td class="table-head--month">Июнь</td>
                                        <td class="table-head--month">Июль</td>
                                        <td class="table-head--month">Авг</td>
                                        <td class="table-head--month">Сент</td>
                                        <td class="table-head--month">Окт</td>
                                        <td class="table-head--month">Ноя</td>
                                        <td class="table-head--radiusend">Дек</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="table-body">
                                        <td class="table-body--first">
                                            <img class="table-body__img" src="images/tree.png" alt="">
                                            <div class="table-body__text">Яблоня садовая</div>
                                        </td>
                                        <td class="table-body--year"><span>Введите год вашего растения</span><input type="text"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month table-body--right"></td>
                                    </tr>
                                    <tr class="table-body">
                                        <td class="table-body--first">
                                            <div class="table-body__img"><img src="/front/static/img/fruct.96a83a1.png" alt=""></div>
                                            <div class="table-body__text">Яблоня садовая</div>
                                        </td>
                                        <td class="table-body--year"><span>Введите год вашего растения</span><input type="text"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month back-red"></td>
                                        <td class="table-body--month back-red"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month table-body--right"></td>
                                    </tr>
                                    <tr class="table-body">
                                        <td class="table-body--first">
                                            <div class="table-body__img"><img src="/front/static/img/fruct.96a83a1.png" alt=""></div>
                                            <div class="table-body__text">Яблоня садовая</div>
                                        </td>
                                        <td class="table-body--year"><span>Введите год вашего растения</span><input type="text"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month back-red"></td>
                                        <td class="table-body--month back-red"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month table-body--right"></td>
                                    </tr>
                                    <tr class="table-body">
                                        <td class="table-body--first">
                                            <div class="table-body__img"><img src="/front/static/img/fruct.96a83a1.png" alt=""></div>
                                            <div class="table-body__text">Яблоня садовая</div>
                                        </td>
                                        <td class="table-body--year"><span>Введите год вашего растения</span><input type="text"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month table-body--right"></td>
                                    </tr>
                                    <tr class="table-body">
                                        <td class="table-body--first">
                                            <div class="table-body__img"><img src="/front/static/img/fruct.96a83a1.png" alt=""></div>
                                            <div class="table-body__text">Яблоня садовая</div>
                                        </td>
                                        <td class="table-body--year"><span>Введите год вашего растения</span><input type="text"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month  back-yellow"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month table-body--right"></td>
                                    </tr>
                                    <tr class="table-body">
                                        <td class="table-body--first">
                                            <div class="table-body__img"><img src="/front/static/img/fruct.96a83a1.png" alt=""></div>
                                            <div class="table-body__text">Яблоня садовая</div>
                                        </td>
                                        <td class="table-body--year"><span>Введите год вашего растения</span><input type="text"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month back-yellow"></td>
                                        <td class="table-body--month table-body--right"></td>
                                    </tr>
                                    <tr class="table-body">
                                        <td class="table-body--first">
                                            <div class="table-body__img"><img src="/front/static/img/fruct.96a83a1.png" alt=""></div>
                                            <div class="table-body__text">Яблоня садовая</div>
                                        </td>
                                        <td class="table-body--year"><span>Введите год вашего растения</span><input type="text"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month table-body--right"></td>
                                    </tr>
                                    <tr class="table-body">
                                        <td class="table-body--first">
                                            <div class="table-body__img"><img src="/front/static/img/fruct.96a83a1.png" alt=""></div>
                                            <div class="table-body__text">Яблоня садовая</div>
                                        </td>
                                        <td class="table-body--year"><span>Введите год вашего растения</span><input type="text"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month table-body--right"></td>
                                    </tr>
                                    <tr class="table-body">
                                        <td class="table-body--first">
                                            <div class="table-body__img"><img src="/front/static/img/fruct.96a83a1.png" alt=""></div>
                                            <div class="table-body__text">Яблоня садовая</div>
                                        </td>
                                        <td class="table-body--year"><span>Введите год вашего растения</span><input type="text"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month table-body--right"></td>
                                    </tr>
                                    <tr class="table-body">
                                        <td class="table-body--first">
                                            <div class="table-body__img"><img src="/front/static/img/fruct.96a83a1.png" alt=""></div>
                                            <div class="table-body__text">Яблоня садовая</div>
                                        </td>
                                        <td class="table-body--year"><span>Введите год вашего растения</span><input type="text"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month back-blue"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month"></td>
                                        <td class="table-body--month table-body--right"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="sc-sumtable-colors-element d-flex align-items-center">
                                <nav class="sc-sumtable-pagination">
                                    <ul class="pagination justify-content-center align-items-center">
                                        <li class="page-item disabled mr-3">
                                            <a class="page-link" href="#">&lt;
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item disabled"><a class="page-link">...</a></li>
                                        <li class="page-item"><a class="page-link" href="">5</a></li>
                                        <li class="page-item ml-3">
                                            <a class="page-link" href="#">&gt;
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                <ul class="sc-sumtable-colors-element-list d-flex flex-wrap ml-5">
                                    <li><span class="sc-sumtable-color sc-sumtable-color1"></span>Сбор урожая</li>
                                    <li><span class="sc-sumtable-color sc-sumtable-color2"></span>Посадка рассады</li>
                                    <li><span class="sc-sumtable-color sc-sumtable-color3"></span>Обрезка/уход</li>
                                    <li><span class="sc-sumtable-color sc-sumtable-color4"></span>Посадка в грунт</li>
                                    <li><span class="sc-sumtable-color sc-sumtable-color5"></span>Цветение</li>
                                    <li><span class="sc-sumtable-color sc-sumtable-color6"></span>Посадка на рассаду</li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <a href="#" class="btn sc-form-user-button">Сформировать</a>
                        </div>
                    </div>
                </div>
                    @component('front.intofront.rightsidebar')
                    @endcomponent
            </div>
        </div>
    </section>
@endsection