
@extends('front.intofront.main')

@section('form')
    <section class="sc-main sc-main-page-content">
        <div class="container">
            <div class="row flex-nowrap">
                <div class="col-2 sc-main-left-content ">
                    @component('front.intofront.leftsidebar')
                    @endcomponent
                    <div class="sc-check-container">
                        <div class="sc-check-title">Категория топиков:</div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="sc-category-planting">
                            <label class="form-check-label" for="sc-category-planting">Посадка</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="sc-category-pruning">
                            <label class="form-check-label" for="sc-category-pruning">Обрезка</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="sc-category-processing">
                            <label class="form-check-label" for="sc-category-processing">Обработка</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="sc-category-harvesting">
                            <label class="form-check-label" for="sc-category-harvesting">Сбор урожая</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="sc-category-storage">
                            <label class="form-check-label" for="sc-category-storage">Хранение

                            </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="sc-category-recycling">
                            <label class="form-check-label" for="sc-category-recycling">Переработка</label>
                        </div>
                    </div>
                </div>
                <div class="col sc-main-center-content">
                    @component('front.intofront.tab',['cultureType'=>$cultureType])
                    @endcomponent
                        <div class="row">
                            <div class="col-12">
                                <ol class="breadcrumb">

                                    <li class="breadcrumb-item active">Вопрос-ответ</li>
                                </ol>

                                <div class="sc-search-element-container">
                                    <div class="sc-quest-text-ask">
                                        @if (empty($userId))
                                            <a href="{{ URL::to('/log-in') }}" style="color: #fff">ЗАДАТЬ ВОПРОС</a>
                                            <div class="sc-quest-text-img"></div>
                                        @else
                                            <a href="#" style="color: #fff" data-toggle="modal" data-target="#modalAddQuestion">
                                                ЗАДАТЬ ВОПРОС
                                            </a>
                                            <div class="sc-quest-text-img"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">

                                <div class="row section-pests-container">
                                    <div class="col-12">
                                        @foreach($questions as $question)
                                        <div class="sc-pests-card-item d-flex">
                                            <img class="sc-pests-card-item-img" src="{{ asset('images/' . $question->photo) }}" alt="">
                                            <div class="sc-pests-card-item-content">
                                                <div class="d-flex">
                                                    <p class="h3"><b>{{ $question->title }}</b></p>

                                                    <div class="ml-auto d-flex">
                                                        <div class="sc-information-title-answers pr-4">Ответов: <span>{{$question->count}}</span></div>
                                                        <div class="sc-information-title-date">{{\Carbon\Carbon::parse($question->date)->format('d.m.Y')}}</div>
                                                    </div>
                                                </div>
                                                <p class="sc-pests-card-text"> {{ str_limit($question->text, 200) }}</p>
                                                <a href="{{ URL::to("/question/view/") . '/' .$question->id }}" class="sc-pests-card-item-btn">Подробнее</a>
                                            </div>
                                        </div>
                                        @endforeach
                                            {{ $questions->links() }}
                                    </div>
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
    <div class="modal fade" id="modalAddQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body" style="padding: 0;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="add_question_container">
                        <div class="sc-form-user-container padding-modif">
                            <form action="">

                                <div class="row justify-content-between">
                                    <div class="col-12 text-center">
                                        <div class="sc-form-title-relative-block">
                                            <p>Задать новый вопрос</p>
                                            <a href="#" class="sc-question-btn-forms"
                                               title="Если не нашли нужной культуры или категории, воспользуйтесь формой обратной связи">?</a>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group block_selection_search">
                                            <div class="result_element_title mb-1">Найдите культуру:</div>
                                            <input class="form-control-info1" type="search" placeholder="" id="qw-search-input">
                                            <button type="button" class="search-icon-block search-icon-modif"></button>
                                        </div>

                                        <div class="form-group">
                                            <div class="result_element_title mb-1">Выберите категорию вопроса:</div>
                                            <select class="form-control-info1" id="qw-type-select">
                                                <option>Выбрать категорию</option>
                                                <option value="6">Сад</option>
                                                <option value="5">Огород</option>
                                                <option value="4">Клумба</option>
                                            </select>
                                        </div>
                                    </div>
                                        <div class="col-12 tell-about pt-4">
                                               <p class="result_element_title mb-1">Заголовок сообщения:</p>
                                               <input class="form-control-info1" type="text" id="qw-question-title">
                                        </div>
                                    <div class="col-12 tell-about pt-4">
                                        <p class="sc-form-title-line">Содержание сообщения:</p>
                                        <textarea name="з" id="qw-question-text" cols="30" rows="10"></textarea>
                                    </div>
                                    <input type="hidden" id="qw_user_id" value="{{$userId}}">
                                    <input type="hidden" id="qw_csrf_token" value="{{csrf_token()}}">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn sc-form-user-button sc-buyer-btn mr-0" id="modalSubmitAddQuestion">сохранить</button>
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