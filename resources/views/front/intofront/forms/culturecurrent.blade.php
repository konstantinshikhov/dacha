
@extends('front.intofront.main')
@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content ">
                    @component('front.intofront.leftsidebar')
                    @endcomponent
                </div>
                <div class="col sc-main-center-content-chemical">
                    <div class="row">
                        <div class="col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Сорта</a></li>
                                <li class="breadcrumb-item active">{{ $sorts->name }}</li>
                            </ol>
                            <div class="sc-bookmark-all-container sc-bookmark-all-container-article">
                                <div class="d-flex position-relative align-items-center">
                                    <div>
                                        <div class="sc-chemical-page-article">Артикул:<span> {{$vendor_code}}</span></div>
                                        <div class="sc-suppliers-page-article-block d-flex align-items-center">

                                            @php for($i=0;$i<floor($sorts->rating);$i++):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star"></i></div>';
                                            endfor;
                                                if(($sorts->rating -(floor($sorts->rating)))!=0):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star-half-o"></i></div>';
                                                endif;
                                            for($i=0;$i<=4-round($sorts->rating, 0, PHP_ROUND_HALF_UP);$i++):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star-o"></i></div>';
                                            endfor;
                                            @endphp
                                        </div>
                                    </div>
                                    <div class="sc-bookmark-all ml-3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <div class="sc-page-title-block-container">{{ $sorts->name }}</div>
                        </div>
                        <div class="col-12 pb-5">
                            <div class="row">
                                <div class="col-6 sc-foto-gallery-container">
                                    <div class="row ">
                                        <div class="col-12 mb-3">
                                            <div class="sc-foto-gallery-element-main-foto" style="">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class=" sc-foto-gallery-element-additional-foto" style="background-image: url('/storage/app/public/{{ $sorts->main_photo }}');">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class=" sc-foto-gallery-element-additional-foto" style="background-image: url({{ asset('images/chemical-foto.jpg') }});">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class=" sc-foto-gallery-element-additional-foto" style="background-image: url({{ asset('images/chemical-foto.jpg') }});">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 sc-content-text-container d-flex flex-column">
                                    <div class="sc-chemicat-description-container">
                                        <div id="sunburst_chart_{{ $sorts->id }}" class="sunburst_chart"></div>
                                    </div>
                                    <div class="mt-auto d-flex position-relative pt-5">
                                        <a href="#" class="sc-content-text-btn-more" id="add-my-plans">Добавить в Мои растения</a>
                                        <a href="#" class="sc-question-btn ml-3">?</a>
                                        <div class="sc-question-hide-window sc-question-hide-window-sort">Добавьте в свои растения, чтобы открыть дополнительный функционал с ними</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="sc-content-chemical-header" id="#menu_sort">
                                <ul class="d-flex">
                                    <li><a href="#description">Описание</a></li>
                                    <li><a href="#specifications">Характеристики</a></li>
                                    <li><a href="#comment">Комментарии</a></li>
                                    <li><a href="#place_of_sale">Места продажи (<span>33</span>)</a></li>
                                </ul>
                            </div>
                            <div class="sc-content-text-description-container pb-4" id="description">
                                <h3>Описание</h3>
                                <div class="sc-content-text-description">
                                    {!! $sorts->content !!}
                                </div>
                            </div>
                            <div class="sc-content-text-description-container pb-4" id="specifications">
                                <h3>ХАРАКТЕРИСТИКИ</h3>
                                <ul class="table-char__list">
                                    @foreach($characteristics[$sorts->id] as $charactId => $charact)
                                        <li class="table-char__item">
                                            <img src=@php echo($_ENV['PHOTO_FOLDER'].$charact['icon_path']);@endphp  width="40px">
                                            <div class="table-char__item-name">{{ $charact['name'] }}</div>
                                            <div class="table-char__item-about">{{ $charact['value'] }}</div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="sc-decorator-page-comments sc-chemicat-comments" id="comment">
                                <h3>Комментарии</h3>
                                <div class="sc-decorator-reviews-block pl-0">
                                    <span class="sc-decorators-review-num"> {{count($comments)}}отзыва</span>
                                    <a class="sc-decorators-review-write" href="#" data-toggle="modal" data-target="#modalAddComment">написать отзыв</a>
                                </div>
                                <div class="sc-decorator-page-comments-container mb-5">
                                    @foreach($comments as $comment)
                                    <div class="sc-decorators-review-card">
                                        <div class="row">
                                            <div class="col-12 sc-decorators-review-card-header d-flex align-items-center justify-content-between pb-3">
                                                <div class="sc-decorators-review-card-header-name">{{$comment->first_name.' '.$comment->last_name}}</div>
                                            </div>
                                            <div class="col-12 sc-decorators-review-card-container d-flex pb-3">
                                                <div class="row">
                                                    <div class="col-2 sc-decorators-review-card-photo">
                                                        <img src="{{ asset('images/news-img-card.jpg') }}" alt="">
                                                    </div>
                                                    <div class="col-8 sc-decorators-review-card-text d-flex align-items-center">
                                                        <p>{{$comment->text}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 sc-decorators-review-card-rate">
                                                <div class="d-flex justify-content-center">
                                                    @php for($i=0;$i<floor($comment->rating);$i++):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star"></i></div>';
                                            endfor;
                                                if(($comment->rating -(floor($comment->rating)))!=0):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star-half-o"></i></div>';
                                                endif;
                                            for($i=0;$i<=4-round($comment->rating, 0, PHP_ROUND_HALF_UP);$i++):
                                                echo'<div class="star-rating__dark"><i class="fa fa-star-o"></i></div>';
                                            endfor;
                                                    @endphp
                                            
                                                </div>
                                                <div class="sc-decorators-review-card-date text-center">2 месяца назад</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{--<div class="sc-decorators-review-card">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-12 sc-decorators-review-card-header d-flex align-items-center justify-content-between pb-3">--}}
                                                {{--<div class="sc-decorators-review-card-header-name">Татьяна Сергеевна</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-12 sc-decorators-review-card-container d-flex pb-3">--}}
                                                {{--<div class="row">--}}
                                                    {{--<div class="col-2 sc-decorators-review-card-photo">--}}
                                                        {{--<img src="{{ asset('images/news-img-card.jpg') }}" alt="">--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col-8 sc-decorators-review-card-text d-flex align-items-center">--}}
                                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates teneturLorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates teneturLorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates teneturLorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates teneturLorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates teneturLorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates teneturLorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur voluptates tenetur</p>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-2 sc-decorators-review-card-rate">--}}
                                                {{--<div class="d-flex justify-content-center">--}}
                                                    {{--<div class="star-rating__dark"><i class="fa fa-star"></i></div>--}}
                                                    {{--<div class="star-rating__dark"><i class="fa fa-star"></i></div>--}}
                                                    {{--<div class="star-rating__dark"><i class="fa fa-star"></i></div>--}}
                                                    {{--<div class="star-rating__white"><i class="fa fa-star-o"></i></div>--}}
                                                    {{--<div class="star-rating__white"><i class="fa fa-star-o"></i></div>--}}
                                                {{--</div>--}}
                                                {{--<div class="sc-decorators-review-card-date text-center">2 месяца назад</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <a href="#" class="sc-decorators-review-all">показать все</a>
                                </div>
                            </div>
                            <div class="sc-decorator-page-comments sc-chemicat-comments" id="place_of_sale">
                                <h3>Магазины</h3>
                                {{--<ul class="sc-chemical-shop-category__list d-flex">--}}
                                    {{--<li class="sc-chemical-shop-category__list-item"><a href="">Вторичная переработка</a></li>--}}
                                    {{--<li class="sc-chemical-shop-category__list-item"><a href="">Рассада</a></li>--}}
                                    {{--<li class="sc-chemical-shop-category__list-item"><a href="">Росток</a></li>--}}
                                    {{--<li class="sc-chemical-shop-category__list-item"><a href="">Семена</a></li>--}}
                                    {{--<li class="sc-chemical-shop-category__list-item"><a href="">Урожай</a></li>--}}
                                {{--</ul>--}}
                            </div>
                            @foreach($sellers as $seller)
                            <div class="sc-chemical-shop-list">
                                <div class="sc-chemical-shop-list-header d-flex align-items-center justify-content-center position-relative">
                                    <div class="sc-sellers-delivery sc-chemical-delivery d-flex align-items-center">
                                        <div class="pr-3">Доставка:</div>
                                        <ul class="d-flex">
                                            <li class="sc-chemical-delivery-img" style="background-image: url({{ asset('images/dhl.jpg') }});"></li>
                                            <li class="sc-chemical-delivery-img" style="background-image: url({{ asset('images/dhl.jpg') }});"></li>
                                            <li class="sc-chemical-delivery-img" style="background-image: url({{ asset('images/dhl.jpgg') }});"></li>
                                        </ul>
                                    </div>
                                    <div>{{$seller->name}}</div>
                                    <div class="sc-chemical-shop-list-header-rate">
                                        <div class="d-flex justify-content-center">
                                            <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                            <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                            <div class="star-rating__dark"><i class="fa fa-star"></i></div>
                                            <div class="star-rating__white"><i class="fa fa-star-o"></i></div>
                                            <div class="star-rating__white"><i class="fa fa-star-o"></i></div>
                                        </div>
                                        <div class="sc-chemical-shop-list-header-reviews text-center"><span>2</span> отзыва</div>
                                    </div>
                                </div>

                                <div class="sc-chemical-shop-list-content">
                                    <div class="sc-chemical-shop-list-info">
                                        <span>Категория</span>
                                        <span>Характеристика</span>
                                    </div>
                                    @foreach($seller->products as $product)
                                    <div class="sc-shop-list-content-element d-flex justify-content-between align-items-center">
                                        <div class="sc-shop-list-content-element-name">{{$product->category}}</div>
                                        <div class="sc-shop-list-content-element-name">{{$product->feature}}</div>
                                        <div class="sc-shop-list-content-element-price"><span>{{$product->price}}</span> рублей</div>
                                    </div>
                                    @endforeach
                                    {{--<div class="sc-shop-list-content-element d-flex justify-content-between align-items-center">--}}
                                        {{--<div class="sc-shop-list-content-element-name">Росток</div>--}}
                                        {{--<div class="sc-shop-list-content-element-price"><span>707.65</span> рублей</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="sc-shop-list-content-element d-flex justify-content-between align-items-center">--}}
                                        {{--<div class="sc-shop-list-content-element-name">Росток</div>--}}
                                        {{--<div class="sc-shop-list-content-element-price"><span>707.65</span> рублей</div>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="sc-chemical-shop-list-footer">
                                    <div class="d-flex align-items-center sc-chemical-shop-list-footer-phone">
                                        <i class="fa fa-phone"></i>
                                        <div class="property-shop__phone-number">+789******</div>
                                        <a href="#" class="property-shop__phone-show">
                                            Показать телефон
                                        </a>
                                    </div>
                                    <a href="{{url('sellers/view/'.$seller->user_id)}}" class="property-shop__phone-btn">В Магазин</a>
                                </div>
                                <a href="{{url('/sellers/'.$sorts->id)}}" class="sc-decorators-review-all">показать все</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @component('front.intofront.rightsidebar')
                @endcomponent
            </div>
        </div>

    </section>
    <div id="modalAddComment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        {{--<div class="sc-form-user-container padding-modif">--}}
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body" style="padding: 0;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="add_comment_container">
                       <div class="sc-form-user-container padding-modif" >
                             <form action="#" id="comment_form">
                <input type="hidden"  name="rating" value="0" id="comment_rating">
                <input type="hidden" id="user_id" name="user_id" value="{{$user_id}}">
                <input type="hidden" id="item_id" name="item_id" value="{{$sorts->id}}">
                <input type="hidden" id="type" name="type" value="sort">
                <div class="row justify-content-between">

                    <div class="col-10">

                        <div class="form-group mb-0">

                            <div class="result_element_title1 mb-1"><p class="sc-form-title-line">Поставьте вашу оценку:</p></div>
                            <div class="sorts-item__block-stars">
                                <div class="sc-star-rating-sorts">
                                    <span class="star-rating__dark"><i class="fa fa-star-o set" data-id="1"></i></span>
                                    <span class="star-rating__dark"><i class="fa fa-star-o set" data-id="2"></i></span>
                                    <span class="star-rating__dark"><i class="fa fa-star-o set" data-id="3"></i></span>
                                    <span class="star-rating__white"><i class="fa fa-star-o set" data-id="4"></i></span>
                                    <span class="star-rating__white"><i class="fa fa-star-o set" data-id="5"></i></span>
                                </div>
                                <div>
                                    <div class="sorts-item__block-text">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 tell-about pt-4">
                        <p class="sc-form-title-line">Содержание сообщения:</p>
                        <textarea name="text" id="comment_message" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn sc-form-user-button sc-buyer-btn mr-0" id="send_comment">отправить</button>
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


@section('script')
    @parent
    <script src="{{ asset('adminlte/asset/d3.min.js') }}"></script>
    <script>
        $('#add-my-plans').click(function () {
            $.ajax({
                url: "{{ url('/add-plants ') }}",
                type: "POST",
                data: {
                    plant_id:"{{ $sorts->id }}",
                    user_id: "{{ $user_id }}",
                    _token: '{{csrf_token()}}'
                },
                success: function(data){
                    alert('Добавлено !')

                    console.log(data);
                }
            })
        })


        function drawChart(nodeId, json) {
            var data = json;

            var width = 640,
                height = 500,
                maxRadius = Math.min(width, height) / 2;

            var svg = d3.select(nodeId).append("svg")
                .attr("width", width)
                .attr("height", height)
                .attr("viewBox", "0 0 " + width + " " + height)
                .attr("perserveAspectRatio", "xMinYMin meet")
                .append("g")
                .attr("transform", "translate(" + ((width / 2) - 70) + "," + ((height / 2) - 60) + ")");

            var multiLevelData = [];
            var setMultiLevelData = function(data) {
                if (data == null)
                    return;
                var level = data.length,
                    counter = 0,
                    index = 0,
                    currentLevelData = [],
                    queue = [];
                for (var i = 0; i < data.length; i++) {
                    queue.push(data[i]);
                };

                while (!queue.length == 0) {
                    var node = queue.shift();
                    currentLevelData.push(node);
                    level--;

                    if (node.subData) {
                        for (var i = 0; i < node.subData.length; i++) {
                            queue.push(node.subData[i]);
                            counter++;
                        };
                    }
                    if (level == 0) {
                        level = counter;
                        counter = 0;            multiLevelData.push(currentLevelData);
                        currentLevelData = [];
                    }
                }
            }

            var drawPieChart = function(_data, index) {
                var pie = d3.layout.pie()
                    .sort(null)
                    .value(function(d) {
                        return d.nodeData.angle;
                    });
                var arc = d3.svg.arc()
                    .outerRadius((index + 1) * pieWidth - 1)
                    .innerRadius(index * pieWidth);

                var fake_arc = d3.svg.arc()
                    .outerRadius((index + 1) * pieWidth + 20)
                    .innerRadius(index * pieWidth);

                var g = svg.selectAll(".arc" + index).data(pie(_data)).enter().append("g")
                    .attr("class", "arc" + index)
                    .attr("transform", "rotate(-13)");

                g.append("path").attr("d", arc)
                    .style("fill", function(d) {
                        return d.data.nodeData.color;
                    })
                    .append("svg:title")
                    .text(function(d) {
                        return d.data.nodeData.text;
                    });

                g.append("text").attr("transform", function(d) {
                    return "translate(" + fake_arc.centroid(d) + ") rotate(13)";
                })
                    .attr("dy", ".65em")
                    .style("text-anchor", "middle")
                    .style("font-family", "sans-serif")
                    .style("font-size", "12px")
                    .style("fill", function(d) {
                        return (d.data.nodeData.age == "1" ||
                            d.data.nodeData.age == "2" ||
                            d.data.nodeData.age == "3" ||
                            d.data.nodeData.age == "4" ) ? "blue" : "black";
                    })
                    .text(function(d) {
                        return d.data.nodeData.age;
                    });

                // Black arc
                g.append("path").attr("d", arc)
                    .attr("fill", "black")
                    .attr("d", d3.svg.arc()
                        .innerRadius((index + 0.5) * pieWidth - 19)
                        .outerRadius(index * pieWidth-1)
                    );

                // Legend
                var legendG = svg.selectAll(".legend")
                    .data([{'x': `<tspan x="14" y="10">Посадка в грунт</tspan>`, 'c': '#286928', 'y': '0'},
                        {'x': `<tspan x="14" y="10">Посадка на рассаду</tspan>`, 'c': '#7c956c', 'y': '0'},
                        {'x': `<tspan x="14" y="10">Посадка рассады</tspan>`, 'c': '#b4b52a', 'y': '0'},
                        {'x': `<tspan x="14" y="10">Цветение</tspan>`, 'c': '#e17a0b', 'y': '0'},
                        {'x': `<tspan x="14" y="10">Сбор урожа</tspan>я`, 'c': '#ab2b23', 'y': '0'},
                        {'x': `<tspan x="14" y="10">Обрезка/уход</tspan>`, 'c': '#1f5d9d', 'y': '0'},
                        {'x': `<tspan x="14" y="10">Подкормка/обработка</tspan>
                    <tspan x="14" y="24">от вредителей</tspan>`, 'c': '#7b1b61', 'y': '0'},
                        {'x': `<tspan x="14" y="20">Посадка в грунт</tspan>
                    <tspan x="14" y="34">Посадка на рассаду</tspan>`, 'c': '#2c3d22', 'y': '10'}])
                    .enter().append("g")
                    .attr("transform", function(d,i){
                        console.log(i);
                        if (i < 4) {
                            return "translate(" + (-150) + "," + (i * 20 + 230) + ")";
                        } else {
                            return "translate(" + (-10) + "," + (i * 20 + 150) + ")";
                        }

                    })
                    .attr("class", "legend");

                legendG.append("rect")
                    .attr("width", 12)
                    .attr("height", 12)
                    .attr("y", function(d) {
                        return d.y;
                    })
                    .attr("fill", function(d, i) {
                        return d.c;
                    });

                legendG.append("text")
                    .html(function(d){
                        return d.x;
                    })
                    .style("font-family", "sans-serif")
                    .style("font-size", "12px")
                    .attr("y", function(d) {
                        return d.y;
                    })
                    .attr("x", 14);
            }

            setMultiLevelData(data);

            var pieWidth = parseInt(maxRadius / multiLevelData.length) - multiLevelData.length;

            for (var i = 0; i < multiLevelData.length; i++) {
                var _cData = multiLevelData[i];
                drawPieChart(_cData, i);
            }
        }

        [@foreach($rows as $row){{ $row['id'] }},@endforeach].forEach(function(sort_id) {
            $.ajax({
                method: 'post',
                url: "/public/api/sort/getCalendarChartData/" + sort_id,
            }).done(function(response) {
                drawChart("#sunburst_chart_" + sort_id, response.data);
            });
        });

    </script>

@endsection