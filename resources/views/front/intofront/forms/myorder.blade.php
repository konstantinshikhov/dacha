
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
                                <li class="breadcrumb-item active">Мои заказы</li>
                            </ol>
                        </div>
                        @foreach($orderInfo as $order)
                        <div class="col-12">
                            <div class="sc-orders-card">
                                <div class="orders-header">
                                    <div class="orders-header__saller-name">Покупатель: {{$order->first_name}} {{$order->last_name}} </div>

                                    <div class="orders-header__number-orders ml-auto">
                                        <span>заказ № {{$order->id}}</span>
                                        <span><a href="#">дата заказа: {{$order->created_at}}</a></span>
                                    </div>
                                </div>
                                <div class="orders-content">
                                    <div class="row">
                                        <div class="col-2 orders-content__image pr-0">
{{--                                            <img src="images/sc-my-order-flower.png" alt="flower" class="orders-content__image-flower mx-auto">--}}
                                        </div>
                                        <div class="col-10 orders-content__list">
                                            <div class="button-communication">
                                                <a href="#" class="button-communication__item">Чат с покупателем</a> <a href="#" class="button-communication__item">Отправить способы оплаты</a>
                                            </div>
                                            <div class="sc-my-order-table w-100">
                                                <table>
                                                    <thead>
                                                    <tr class="">
                                                        <td class="">Арт.</td>
                                                        <td class="sc-table-order-name">Наименование</td>
                                                        <td class="sc-table-order-change"></td>
                                                        <td class="">Количество</td>
                                                        <td class="">Ед.изм</td>
                                                        <td class="">Сумма</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="">
                                                        <td class="">{{$order->productId}}</td>
                                                        <td class="sc-table-name-product">{{$order->name}}
                                                            <span></span></td>
                                                        <td class="sc-table-order-change-seller"></td>
                                                        <td class="sc-table-order-price">{{$order->quantity}}</td>
                                                        <td class="sc-table-order-price">{{$order->unit}}</td>
                                                        <td class="sc-table-order-price">{{$order->total}}</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td class=""></td>
                                                        <td class="sc-table-name-product">{{$order->type}}, {{$order->characteristic}}
                                                            <span>тип сажанец , характеристика</span></td>
                                                        <td class="sc-table-order-change-seller"></td>
                                                        <td class="sc-table-order-price">1200 рублей</td>

                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="sc-my-order-footer d-flex align-items-center pt-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="delivery__way">Cпособ доставки: <span class="delivery__way-property">{{$order->deliveryName}}</span></div>
                                                    <div class="delivery__status">Статус доставки: <span class="delivery__status-property">{{$order->status_name}}</span>
                                                    </div>
                                                </div>
                                                <div class="confirm-order ml-auto">
                                                    <a href="#" class="confirm-order__button sc-btn-black">Отменить заказ</a>
                                                    <a href="#" class="confirm-order__button sc-btn-orange">Предложить бронирование</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <nav class="col-12">
                            <ul class="pagination justify-content-center align-items-center">
                                <li class="page-item disabled mr-3">
                                    {{ $orderInfo->links() }}
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