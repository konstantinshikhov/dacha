
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
                                <li class="breadcrumb-item active">Мои ассортимент</li>
                            </ol>
                            <div class="sc-button-assortment-container">
                                <a href="#" class="sc-auxiliary-button__item"
                                   data-toggle="modal" data-target="#modalAddProduct">
                                    Добавить новую позицию
                                </a>
                                <a href="#" class="sc-auxiliary-button__item">Обновить остаток</a>
                                <a href="#" class="sc-auxiliary-button__item">Обновить через файл</a>
                            </div>
                            <div class="sc-search-element-container-assortment">
                                <div class="sc-category-search-element d-flex align-items-center">
                                    <input type="search" placeholder="Поиск по ассортименту">
                                    <button type="button" class=""></button>
                                </div>
                            </div>
                            <div class="sc-assortment-table-container">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="sc-assortment-table-foto"></th>
                                        <th class="sc-assortment-table-name">Название</th>
                                        <th class="sc-assortment-table-type">Тип</th>
                                        <th class="sc-assortment-table-category">Категория</th>
                                        <th class="sc-assortment-table">Характеристика</th>
                                        <th class="sc-assortment-table-quantity">В наличии <br>
                                            (кол-во)</th>
                                        <th class="">Ед.изм</th>
                                        <th class="">Стоимость <br>
                                            (за единицу измерения)</th>
                                        <th class="sc-assortment-table-inform">Дополнительная<br> информация</th>
                                        <th class="sc-assortment-table-button"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td><img src="images/profession-icon3.png" alt="" width="40" class="sc-assortment-table-img"></td>
                                        <td>{{ $product->name}}</td>
                                        <td>{{ $product->type}}</td>
                                        <td>{{ $product->category}}</td>
                                        <td>{{ $product->feature}}</td>
                                        <td>{{ $product->quantity}}</td>
                                        <td>{{ $product->unit}}</td>
                                        <td>{{ $product->price}}</td>
                                        <td>{{ $product->add_information}}</td>
                                        <td><a class="sc-assortment-table-btn" href="#" data-toggle="modal"
                                               data-target="#modalUpProduct" data-product="{{json_encode($product)}}">
                                                изменить
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                @component('front.intofront.rightsidebar')
                @endcomponent
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="modalAddProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                {{--</div>--}}
                <div class="modal-body" style="padding-bottom: 0;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="add_product_container">
                        <div class="sc-form-user-container padding-modif">
                            <form action="">
                                <div class="row justify-content-between">
                                    <div class="col-12 text-center">
                                        <div class="sc-form-title-relative-block">
                                            <p>Добавление новой позиции</p>
                                            <a href="#" class="sc-question-btn-forms" title="Если не нашли нужного наименования, воспользуйтесь формой обратной связи">?</a>
                                            <div class="sc-question-hide-window-forms ">укажите ваши данные для связи с другими пользователями</div>
                                        </div>
                                    </div>
                                    <div class="block_selection">
                                        <p class="block_selection_title">Подбор</p>
                                        <div class="form-group">
                                            <select class="form-control-info1" id="mw-type-select">
                                                <option>Выберите тип</option>
                                                <option value="sort">Культура</option>
                                                <option value="chemical">Химикаты</option>
                                            </select>
                                        </div>
                                        <div class="form-group block_selection_search">
                                            <input type="hidden" name="name" value="" id="name_product">
                                            <input class="form-control-info1 who" type="search" placeholder="Поиск" id="mw-search-input">
                                            <button type="button" class="search-icon-block"></button>
                                            <ul class="search_result"></ul>
                                        </div>
                                        <div class="form-group" >
                                            <select class="form-control-info1" id="mw-category-select">
                                                <option>Категория</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{--<input class="form-control-info1" placeholder="Характеристика" id="mw-characteristic-select">--}}
                                            <select class="form-control-info1" id="mw-characteristic-select">
                                                <option>Характеристика</option>
                                            </select>
                                        </div>

                                        <div class="form-group d-flex justify-content-between">
                                            <input class="form-control-info1 form-control-quantity" type="text" id="mw-quantity" placeholder="Кол-во">
                                            <input class="form-control-info1 form-control-quantity" type="text" id="mw-unit" placeholder="Ед. изм.">
                                        </div>
                                        <div class="form-group d-flex align-items-center">
                                            <input class="form-control-info1 form-control-quantity" type="text"  id="mw-price" placeholder="Цена">
                                            <span>руб.</span>

                                        </div>
                                    </div>
                                    <div class="d-flex flex-column arrow-container">
                                        <div  class="arrow-block-img"></div>
                                        <div  class="arrow-block-img"></div>
                                        <div  class="arrow-block-img"></div>
                                        <div  class="arrow-block-img"></div>
                                        <div  class="arrow-block-img"></div>
                                        <div  class="arrow-block-img"></div>
                                    </div>
                                    <div class="block_result">
                                        <p class="block_selection_title">Что будет добавлено</p>

                                        <div class="result_element">
                                            <div class="result_element_title">Тип позиции:</div>
                                            <div class="result_element_content mw-type-select"></div>
                                        </div>
                                        <div class="result_element">
                                            <div class="result_element_title">Название позиции:</div>
                                            <div class="result_element_content searchcontent1"></div>
                                        </div>
                                        <div class="result_element">
                                            <div class="result_element_title">Категории позиции:</div>
                                            <div class="result_element_content mw-category-select"></div>
                                        </div>
                                        <div class="result_element">
                                            <div class="result_element_title">Характеристика позиции:</div>
                                            <div class="result_element_content mw-characteristic-select">
                                            </div>
                                        </div>
                                        <div class="result_element">
                                            <div class="result_element_title">Добавляемые позиции:</div>
                                            <div class="d-flex">
                                                <div class="result_element_content content-quantity"></div><div class="mw-unit ml-2"></div>
                                            </div>
                                        </div>
                                        <div class="result_element">
                                            <div class="result_element_title">Цена за единицу:</div>
                                            <div class="result_element_content content-price"></div>
                                        </div>
                                    </div>
                                    <div class="w-100 tell-about pt-4">
                                        <p class="sc-form-title-line">Дополнительная информация:</p>
                                        <textarea name="" id="mw-text-area" cols="30" rows="10"></textarea>
                                    </div>
                                    <input type="hidden" id="mw_user_add_product_id" value="{{$userId}}">
                                    <input type="hidden" id="mw_csrf_token" value="{{csrf_token()}}">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn sc-form-user-button sc-buyer-btn mr-0" id="modalSubmitAddProduct">сохранить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update product-->
    <div class="modal fade" id="modalUpProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                {{--</div>--}}
                <div class="modal-body" style="padding-bottom: 0px">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="add_product_container">
                        <div class="sc-form-user-container padding-modif">
                            <form action="">
                                <div class="row justify-content-between">
                                    <div class="col-12 text-center">
                                        <div class="sc-form-title-relative-block">
                                            <p>Изменение данных о позиции</p>
                                            <a href="#" class="sc-question-btn-forms" title="Если не нашли нужного наименования, воспользуйтесь формой обратной связи">?</a>
                                            <div class="sc-question-hide-window-forms ">укажите ваши данные для связи с другими пользователями</div>
                                        </div>
                                    </div>
                                    <div class="block_selection">
                                        <p class="block_selection_title">Подбор</p>

                                        <div class="form-group block_selection_search">
                                            <input class="form-control-info1" type="search" placeholder="Поиск" id="up-search-input">
                                            <button type="button" class="search-icon-block"></button>
                                        </div>

                                        <div class="form-group">

                                            <select class="form-control-info1" id="up-type-select">
                                                <option>Выберите тип</option>
                                                <option value="sort">Сорт</option>
                                                <option value="chemical">Химикаты</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control-info1" id="up-category-select">
                                                <option>Категория</option>
                                                <option value="6">Сад</option>
                                                <option value="5">Огород</option>
                                                <option value="4">Клумба</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{--<input class="form-control-info1" placeholder="Характеристика" id="up-characteristic-select">--}}
                                            <select class="form-control-info1" id="up-characteristic-select">
                                                <option>Характеристика</option>
                                                {{--<option value="6">Сад</option>--}}
                                                {{--<option value="5">Огород</option>--}}
                                                {{--<option value="4">Клумба</option>--}}
                                            </select>
                                        </div>

                                        <div class="form-group d-flex justify-content-between">
                                            <input class="form-control-info1 form-control-quantity" type="text" id="up-quantity" placeholder="Кол-во">
                                            <input class="form-control-info1 form-control-quantity" type="text" id="up-unit" placeholder="Ед. изм.">
                                        </div>
                                        <div class="form-group d-flex align-items-center">
                                            <input class="form-control-info1 form-control-quantity" type="text"  id="up-price" placeholder="Цена">
                                            <span>руб.</span>

                                        </div>
                                    </div>
                                    <div class="d-flex flex-column arrow-container">
                                        <div  class="arrow-block-img"></div>
                                        <div  class="arrow-block-img"></div>
                                        <div  class="arrow-block-img"></div>
                                        <div  class="arrow-block-img"></div>
                                        <div  class="arrow-block-img"></div>
                                        <div  class="arrow-block-img"></div>
                                    </div>
                                    <div class="block_result">
                                        <p class="block_selection_title">Что будет изменено</p>
                                        <div class="result_element">
                                            <div class="result_element_title">Название позиции:</div>
                                            <div class="result_element_content searchcontent1"></div>
                                        </div>
                                        <div class="result_element">
                                            <div class="result_element_title">Тип позиции:</div>
                                            <div class="result_element_content mw-type-select"></div>
                                        </div>
                                        <div class="result_element">
                                            <div class="result_element_title">Категории позиции:</div>
                                            <div class="result_element_content mw-category-select"></div>
                                        </div>
                                        <div class="result_element">
                                            <div class="result_element_title">Характеристика позиции:</div>
                                            <div class="result_element_content mw-characteristic-select">
                                            </div>
                                        </div>
                                        <div class="result_element">
                                            <div class="result_element_title">Добавляемые позиции:</div>
                                            <div class="d-flex">
                                                <div class="result_element_content content-quantity"></div><div class="mw-unit ml-2"></div>
                                            </div>
                                        </div>
                                        <div class="result_element">
                                            <div class="result_element_title">Цена за единицу:</div>
                                            <div class="result_element_content content-price"></div>
                                        </div>
                                    </div>
                                    <div class="w-100 tell-about pt-4">
                                        <p class="sc-form-title-line">Дополнительная информация:</p>
                                        <textarea name="" id="up-text-area" cols="30" rows="10"></textarea>
                                    </div>
                                    <input type="hidden" id="up_add_product_id">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn sc-form-user-button sc-buyer-btn mr-0" id="modalSubmitUpProduct">сохранить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection