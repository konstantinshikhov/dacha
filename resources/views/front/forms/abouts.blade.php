@extends('front.main')

@section('form')


    <section class="sc-main sc-learningpage-container mt-5">
        <div class="container">
            <div class="row">

                <?php  $i=0 ?>
                @foreach($main_page_infos as $main_page_info)
                    @if($i == 5)  @break  @endif
                        <div class="col-12 sc-learningpage-article-container pb-5">
                            <div class="text-center">
                                <h2>{{ $main_page_info->title }}</h2>
                            </div>
                            <div class="sc-learningpage-article @if($i == 4){{ 'text-center' }}@endif">
                                <p>{{ $main_page_info->text }}</p>
                                @if($i == 3)
                                    <div class="text-center pt-3">
                                        <a href="#" iddiv="box_1" class="sc-learningpage-article-help-link">ПОМОЧЬ</a>
                                    </div>
                                @endif
                            </div>

                        </div>

                    <?php $i++ ?>
                @endforeach
                  {{--<div id="myfond_gris" opendiv=""></div>--}}
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2>Мы готовы к сотрудничеству</h2>
                        </div>
                        <div class="col-8 sc-rate-form-container mx-auto">
                            <form class="sc-form-element text-center" id="sendform" method="post">
                                {{ csrf_field() }}
                                <div id="sendmessage">
                                    Ваше сообщение отправлено!
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="E-mail" name="mail" id="mail-form" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" placeholder="Ваше сообщение" name="mess"  id="mess-form"></textarea>
                                </div>
                                <button type="submit" class="sc-form-button" id="send" name="submit">Отправить</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection