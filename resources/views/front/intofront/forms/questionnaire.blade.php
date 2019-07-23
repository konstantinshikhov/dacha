
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content">
                @component('front.intofront.leftsidebar')
                @endcomponent
                </div>
                <div class="col sc-main-center-content sc-event-centr-content">
                    <div class="row">
                        <div class="col-12 sc-events-title-container sc-events-title-container-top">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Анкеты растений</li>
                            </ol>
                        </div>
                        <div class="col-12 mb-5">
                            <div class="sc-form-user-container">
                                <form action="">
                                    <div class="row justify-content-between sc-plant-question-form">
                                        <div class="col-12 text-center"><h3>Общие данные анкет</h3>
                                        </div>
                                        <div class="col-3">
                                            <p class="sc-plant-question-form-title">Местоположение</p>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Регион">
                                            </div>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Населеный пункт">
                                            </div>
                                            <a href="#" class="sc-question-form-link">Посмотреть тут</a>
                                        </div>
                                        <div class="col-3">
                                            <p class="sc-plant-question-form-title">Вид почвы</p>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="№1">
                                            </div>
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="№2">
                                            </div>
                                            <a href="#" class="sc-question-form-link">Посмотреть тут</a>
                                        </div>
                                        <div class="col-3 sc-form-no-title">
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Высота над ур-ем моря">
                                            </div>
                                            <a href="#" class="sc-question-form-link">Посмотреть тут</a>
                                        </div>
                                        <div class="col-3 sc-form-no-title">
                                            <div class="form-group">
                                                <input type="tel" class="form-control-info" placeholder="Количество осадков">
                                            </div>
                                            <a href="#" class="sc-question-form-link">Посмотреть тут</a>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button class="btn sc-form-user-button sc-buyer-btn mt-5">сохранить</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="product-image">

                                @foreach($sorts as $sort)

                                    <div class="product-image__item <?php if($sort->id == $model->id)echo"active";?> d-flex align-items-center" data-sort="{{$sort->sort_id}}" data-questionnaire="{{$sort->id}}">
                                        <img src="/storage/app/public/{{$sort->main_photo}}" alt="">
                                        <div class="product-image__item-name">{{$sort->name}}<br>{{$sort->slug}}
                                            <div class="form-check-item sc-items-chek">
                                                <input type="checkbox" class="form-check-input-item" <?php if($sort->id == $model->id)echo"checked";?>>
                                                <label class="form-check-label-item"></label>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                                    {{$sorts->links()}}
                            </div>
                            {{--<nav>--}}
                                {{--<ul class="pagination justify-content-center align-items-center">--}}
                                    {{--<li class="page-item disabled mr-3">--}}
                                        {{--<a class="page-link" href="{{$sorts->link}}"><--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
                                    {{--<li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                                    {{--<li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                                    {{--<li class="page-item disabled"><a class="page-link">...</a></li>--}}
                                    {{--<li class="page-item"><a class="page-link" href="">5</a></li>--}}
                                    {{--<li class="page-item ml-3">--}}
                                        {{--<a class="page-link" href="#">>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</nav>--}}
                        </div>
                        <div class="col-7">
                            {{--{{$model}}--}}
                            <form method="post" action="questionaries" id="questionanaire_form">
                                <table class="product-table">
                                <tr>
                                    <th colspan="4">
                                       Карточка   <span id="card" > {{$model->name}} </span>
                                        <span class="sc-table-title-year">
                                            <span><i class="fa fa-angle-up"></i></span>
                                            2018 год
                                            <span><i class="fa fa-angle-down"></i></span>
                                        </span>
                                    </th>
                                </tr>
                                <tr class="product-table__tr">
                                    <td class="product-table__bigtd">Семейное поколение растений от покупки посадочного материала</td>
                                    <td class="product-table__middletd">{{$model->generation}}</td>
                                    <td class="product-table__smalltd"><button class="product-table__smalltd-minus">-</button> <span class="product-table__smalltd-counter">{{$model->generation}}</span> <button class="product-table__smalltd-plus">+</button></td>
                                    <td class="product-table__btn">  <button class="product-table__smalltd-refresh" data-name="generation">Обновить</button></td>
                                </tr>
                                <tr class="product-table__tr">
                                    <td class="product-table__bigtd">Посадочная прощадь</td>
                                    <td class="product-table__middletd">м<sup>2</sup> или куст дерево</td>
                                    <td class="product-table__smalltd"><input type="text"name="landing_area" value="{{$model->landing_area}}"></td>
                                    <td class="product-table__btn">
                                        <button class="product-table__smalltd-refresh text_field" data-name="landing_area">Обновить</button>
                                    </td>
                                </tr>
                                <tr class="product-table__tr">
                                    <td class="product-table__bigtd">Дата на посадки на расскаду</td>
                                    <td class="product-table__middletd"><?= date("d.m.Y",strtotime($model->seeding_date));?></td>
                                    <td class="product-table__smalltd">
                                        <input type="text"  name="seeding_date"  class="datepicker-here" value="<?= date("d.m.Y",$model->seeding_date); ?>">
                                    </td>
                                    <td class="product-table__btn">
                                        <button class="product-table__smalltd-refresh date_picker" data-name="seeding_date">Обновить</button>
                                    </td>
                                </tr>
                                <tr class="product-table__tr">
                                    <td class="product-table__bigtd">Дата посадки на открытую площадку</td>
                                    <td class="product-table__middletd"><?= date("d.m.Y",strtotime($model->ground_transplantation_date));?></td>
                                    <td class="product-table__smalltd">
                                        <input type="text" class="datepicker-here" name="ground_transplantation_date" value="{{$model->ground_transplantation_date}}">
                                    </td>
                                    <td class="product-table__btn">
                                        <button class="product-table__smalltd-refresh date_picker" data-name="ground_transplantation_date">Обновить</button>
                                    </td>

                                </tr>
                                <tr class="product-table__tr" data-name="cultivation_type">
                                    <td class="product-table__bigtd">
                                        {{--<select class="sc-plant-form-select" data-placeholder="Условия выращивания">--}}
                                            {{--<option></option>--}}
                                            {{--<option value="1">Открытый грунт</option>--}}
                                            {{--<option value="2">Теплица</option>--}}
                                            {{--<option value="3">Комнатная посадка</option>--}}
                                        {{--</select>--}}
                                        Условия выращивания
                                    </td>
                                    <td class="product-table__middletd">-</td>
                                    <td class="product-table__smalltd">
                                        {{--<input type="text"> --}}
                                        <select class="form-select" name="cultivation_type">
                                            <option></option>
                                            <option value="1" <?php if($model->cultivation_type == 1)echo "selected";?>>Открытый грунт</option>
                                            <option value="2" <?php if($model->cultivation_type == 2)echo "selected";?>>Теплица</option>
                                            <option value="3" <?php if($model->cultivation_type == 3)echo "selected";?>>Комнатная посадка</option>
                                        </select>
                                    </td>
                                    <td class="product-table__btn">
                                        <button class="product-table__smalltd-refresh select_field" data-name="cultivation_type">Обновить</button>
                                    </td>
                                </tr>
                                <tr class="product-table__tr">
                                    <td class="product-table__bigtd">Дата пересадки на грунт</td>
                                    <td class="product-table__middletd">-</td>
                                    <td class="product-table__smalltd"><input type="text" class="datepicker-here"></td>
                                    <td class="product-table__btn">  <button class="product-table__smalltd-refresh">Обновить</button></td>
                                </tr>
                                <tr class="product-table__tr" data-name="trimming_date">
                                    <td class="product-table__bigtd">Дата проведения обрезки</td>
                                    <td class="product-table__middletd"><?= date("d.m.Y",strtotime($model->trimming_date));?></td>
                                    <td class="product-table__smalltd"><input type="text" class="datepicker-here" name="trimming_date" value="{{$model->trimming_date}}"></td>
                                    <td class="product-table__btn">  <button class="product-table__smalltd-refresh date_picker" data-name="trimming_date">Обновить</button></td>
                                </tr>
                                <tr class="product-table__tr">
                                    <td class="product-table__bigtd">Дата проведения обработки</td>
                                    <td class="product-table__middletd">25.03.2018</td>
                                    <td class="product-table__smalltd">
                                        <input type="text" class="datepicker-here">

                                    </td>
                                    <td class="product-table__btn">
                                        <button class="product-table__smalltd-refresh">Обновить</button>
                                    </td>
                                </tr>
                                <tr class="product-table__tr" data-name="is_ill">
                                    <td class="product-table__bigtd">Болеет ли растение</td>
                                    <td class="product-table__middletd"><?php if($model->is_ill){echo "Да";} else echo"Нет";?></td>
                                    <td class="product-table__smalltd">
                                        {{--<input type="text">--}}
                                        <select class="form-select" name="is_ill" >
                                            <option value></option>
                                            <option value="1"<?php if($model->is_ill)echo "selected";?>>Да</option>
                                            <option value="0"<?php if(!$model->is_ill)echo "selected";?>>Нет</option>
                                        </select>
                                    </td>
                                    <td class="product-table__btn">
                                        <button class="product-table__smalltd-refresh select_field" data-name="is_ill">Обновить</button>
                                    </td>
                                </tr>
                                <tr class="product-table__tr" data-name="artificial_irrigation">
                                    <td class="product-table__bigtd">Наличие искуственного полива</td>
                                    <td class="product-table__middletd"><?php if($model->artificial_irrigation){echo "Да";} else echo"Нет";?></td>
                                    <td class="product-table__smalltd">
                                        {{--<input type="text">--}}
                                        <select class="form-select" name="artificial_irrigation" >
                                            <option value></option>
                                            <option value="1" <?php if($model->artificial_irrigation)echo "selected";?>>Да</option>
                                            <option value="0" <?php if(!$model->artificial_irrigation)echo "selected";?>>Нет</option>
                                        </select>
                                    </td>
                                    <td class="product-table__btn">
                                        <button class="product-table__smalltd-refresh select_field" data-name="artificial_irrigation">Обновить</button>
                                    </td>
                                </tr>
                                <tr class="product-table__tr" data-name="drip_irrigation">
                                    <td class="product-table__bigtd">Наличие капельного полива</td>
                                    <td class="product-table__middletd"><?php if($model->drip_irrigation){echo "Да";} else echo"Нет";?></td>
                                    <td class="product-table__smalltd">
                                        {{--<input type="text">--}}
                                        <select class="form-select" name="drip_irrigation" id="drip_irrigation" >
                                            <option value></option>
                                            <option value="1" <?php if($model->drip_irrigation)echo "selected";?>>Да</option>
                                            <option value="0" <?php if(!$model->drip_irrigation)echo "selected";?>>Нет</option>
                                        </select>
                                    </td>
                                    <td class="product-table__btn">
                                        <button class="product-table__smalltd-refresh select_field" data-name="drip_irrigation">Обновить</button>
                                    </td>
                                </tr>
                                <tr class="product-table__tr" data-name="precipitation_from_planting">
                                    <td class="product-table__bigtd">Количество осадков с момента посадки</td>
                                    <td class="product-table__middletd"><?= $model->precipitation_from_planting;?></td>
                                    <td class="product-table__smalltd"><button class="product-table__smalltd-minus">-</button>
                                        <span class="product-table__smalltd-counter"><?= $model->precipitation_from_planting;?></span>
                                        <button class="product-table__smalltd-plus">+</button>
                                    </td>
                                    <td class="product-table__btn">
                                        <button class="product-table__smalltd-refresh" data-name="precipitation_from_planting">Обновить</button>
                                    </td>
                                </tr>
                                <tr class="product-table__tr" data-name="feeding_from_planting">
                                    <td class="product-table__bigtd">Количество подкормок с момента посадки</td>
                                    <td class="product-table__middletd"><?= $model->feeding_from_planting;?></td>
                                    <td class="product-table__smalltd"><button class="product-table__smalltd-minus">-</button>
                                        <span class="product-table__smalltd-counter"><?= $model->feeding_from_planting;?></span>
                                        <button class="product-table__smalltd-plus">+</button>
                                    </td>
                                    <td class="product-table__btn">
                                        <button class="product-table__smalltd-refresh"data-name="feeding_from_planting">Обновить</button>
                                    </td>
                                </tr>
                                <tr class="product-table__tr" data-name="artificial_irrigation_from_planting">
                                    <td class="product-table__bigtd">Количество искуственного полива с момента посадки</td>
                                    <td class="product-table__middletd"><?= $model->artificial_irrigation_from_planting;?></td>
                                    <td class="product-table__smalltd">
                                        <button class="product-table__smalltd-minus">-</button>
                                        <span class="product-table__smalltd-counter">
                                            <?= $model->artificial_irrigation_from_planting;?>
                                        </span>
                                        <button class="product-table__smalltd-plus">+</button>
                                    </td>
                                    <td class="product-table__btn">
                                        <button class="product-table__smalltd-refresh" data-name="artificial_irrigation_from_planting">Обновить</button>
                                    </td>
                                </tr>
                                <tr class="product-table__tr">
                                    <td class="product-table__bigtd">Полученный сумарный урожай</td>
                                    <td class="product-table__middletd">{{$model->harvest}} кг</td>
                                    <td class="product-table__smalltd">
                                        <input type="text" name="harvest" value="{{$model->harvest}}">
                                    </td>
                                    <td class="product-table__btn">
                                        <button class="product-table__smalltd-refresh text_field" data-name="harvest">Обновить</button>
                                    </td>
                                </tr>
                            </table>


                                <div class="text-center">
                                    <a  href="#" class="product-table__button mt-4">Отправить</a>
                                    <button type="submit">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    @component('front.intofront.rightsidebar')
                    @endcomponent
            </div>
        </div>
    </section>
@endsection