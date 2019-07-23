
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content ">
                    @component('front.intofront.leftsidebar')
                    @endcomponent
                </div>
                <div class="col sc-main-center-content">
                    @component('front.intofront.tab')
                    @endcomponent
                    <div class="row">
                            <div class="col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Культуры</a></li>
                                    <li class="breadcrumb-item">
                                        <a href="#">Вопрос-ответ</a></li>
                                    <li class="breadcrumb-item active">Пропадает</li>
                                </ol>
                                <div class="sc-bookmark sc-bookmark-questions"></div>
                            </div>
                            <div class="col-12">
                                <div class="sc-questions-card-item">
                                    <div class="sc-pests-card-item d-flex">
                                        <img class="sc-pests-card-item-img" src="{{ asset('images/' . $question->photo) }}" alt="">
                                        <div class="sc-question-card-item-content">
                                            {{--<p class="h3"><b>Lorem ipsum dolor sit amet consectetur.Lorem ipsum dolor sit amet, consectetur.</b></p>--}}
                                            <p>{{ $question->title }}<p>
                                            <div class="sc-question-person-name">
                                                <span>{{$question->first_name}} {{$question->last_name}}</span>
                                                <span class="sc-question-date">Вопрос задан: <span>{{$question->time}} {{$question->date}}</span></span>
                                            </div>
                                                {{ $question->text }}
                                            <div class="col-9 px-0 d-flex justify-content-between sc-question-block-footer">
                                                <div class="sc-question-footer-btn-container">
                                                    <a href="" class="sc-question-like-btn"><i class="fa fa-thumbs-up pr-1"></i>Нравится <span>12</span></a>
                                                    @if(empty($userId))
                                                        <a href="{{ URL::to('/log-in') }}" class="sc-question-answer-btn">Ответить</a>
                                                    @else
                                                    <a href="" class="sc-question-answer-btn"
                                                       data-toggle="modal" data-target="#modalAddAnswer">Ответить</a>
                                                    @endif
                                                </div>
                                                <div class="sc-question-block-footer-socials d-flex align-items-center">
                                                    Поделиться:
                                                    <ul class="sc-socials-container sc-question-footer-socials d-flex">
                                                        <li class="sc-header-socials sc-header-socials-icon-vk"><a href=""></a></li>
                                                        <li class="sc-header-socials sc-header-socials-icon-ins"><a href=""></a></li>
                                                        <li class="sc-header-socials sc-header-socials-icon-tw"><a href=""></a></li>
                                                        <li class="sc-header-socials sc-header-socials-icon-fb"><a href=""></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($answers as $answer)
                                <div class="sc-questions-answer-container pt-4">

                                    <div class="sc-answers">
                                        <div class="row">
                                            <div class="col-12 sc-answers-header d-flex align-items-center justify-content-between pb-3">
                                                <div class="sc-answers-header-name">{{$answer->first_name}} {{$answer->last_name}}</div>
                                                <div class="sc-answers-header-date">22.08.2018</div>
                                            </div>
                                            <div class="col-12 sc-answers-content-container d-flex pb-3">
                                                <div class="row">
                                                    <div class="col-2 sc-answers-content-photo">
                                                        <img src="{{ asset('images/' .$answer->photo) }}" alt="">

                                                    </div>
                                                    <div class="col sc-answers-content-text d-flex align-items-center">
                                                        {{$answer->text}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 sc-answers-content-footer text-right pb-3">
                                                <a href="" class="sc-answer-like-btn"><i class="fa fa-thumbs-up pr-1"></i>Нравится <span>12</span></a>
                                            </div>
                                        </div>
                                    </div>
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
    <!-- Modal -->
    <div class="modal fade" id="modalAddAnswer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="add_product_container">
                        <div class="sc-form-user-container padding-modif">
                            <form action="">
                                <div class="row justify-content-between">

                                    <div class="col-12 tell-about1 pt-4">
                                        <p class="sc-form-title-line">Содержание сообщения:</p>
                                        <textarea id="qw-answer-text" cols="20" rows="10"></textarea>
                                    </div>
                                    <input type="hidden" id="qw_question_answer_id" value="{{$questionId}}">
                                    <input type="hidden" id="qw_user_answer_id" value="{{$userId}}">
                                    <input type="hidden" id="qw_csrf_answer_token" value="{{csrf_token()}}">
                                    <div class="col-12 text-center">
                                        <button class="btn sc-form-user-button sc-buyer-btn mr-0" id="modalSubmitAddAnswer">отправить</button>
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