@extends('admin.main')

@section('form')
<div class="box">
  <div class="box-body">
    <table id="modelTable" class="table">
      <thead>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12 text-center']) }}</th>
          <th>{{ Form::label('email', 'Электронная почта', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('first_name', 'Имя', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('last_name', 'Фамилия', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('phone', 'Телефон', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('nickname', 'Ник', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', '', ['class' => 'col-sm-12']) }}</th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class='col-sm-1 text-center'>
            {{ $row["id"] }}
          </td>
          <td class='col-sm-2'>
            {{ $row["email"] }}
          </td>
          <td class='col-sm-2'>
            {{ $row["first_name"] }}
          </td>
          <td class='col-sm-2'>
            {{ $row["last_name"] }}
          </td>
          <td class='col-sm-1'>
            {{ $row["phone"] }}
          </td>
          <td class='col-sm-2'>
            {{ $row["nickname"] }}
          </td>
          <td class="col-sm-2">
            {{ Form::button('Редактировать', ['id' => "edit_button_".$row["id"], 'class' => 'col-sm-12 btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modal_'.$row["id"] ]) }}
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12 text-center']) }}</th>
          <th>{{ Form::label('email', 'Электронная почта', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('first_name', 'Имя', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('last_name', 'Фамилия', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('phone', 'Телефон', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('nickname', 'Ник', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', '', ['class' => 'col-sm-12']) }}</th>
        </tr>
      </tfoot>
    </table>

    @foreach($rows as $row)
    <div class="modal fade" id="modal_{{ $row["id"] }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="overflow-y: scroll;">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modalLabel">
              {{ $row["first_name"] }} {{ $row["last_name"] }} @if($row["nickname"] != '')({{ $row["nickname"] }})@endif
            </h4>
            <div style="color: gray;">{{ $row["email"] }}</div>
            @if(isset($row["phone"]))<div style="color: gray;">{{ $row["phone"] }}</div>@endif
          </div>
          <div class="modal-body">
            {{ Form::open(['action' => "AdminLTEController@updateUsers", 'method' => 'put', 'files' => true]) }}
            {{ csrf_field() }}
            <input type="text" name="user_id" class="hidden" value="{{ $row["id"] }}">

            <div class="form-group">
              <label for="user_role">Роль</label>
              <select autocomplete="off" class="form-control" name="user_{{ $row["id"] }}_role">
                <option value="b" @if($row["role"]=="b")selected="selected"@endif>Заблокирован</option>
                <option value="u" @if($row["role"]=="u")selected="selected"@endif>Пользователь</option>
                <option value="a" @if($row["role"]=="a")selected="selected"@endif>Администратор</option>
              </select>
            </div>

            <div class="form-group">
              <label for="user_tariff_id">Тариф</label>
              <select class="form-control" name="user_{{ $row["id"] }}_tariff_id" autocomplete="off">
                @foreach($tariffs as $tariff)
                <option value="{{ $tariff["id"] }}" @if($row["tariff"]["id"] == $tariff["id"])selected="selected"@endif>{{ $tariff["tariff_name"] }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label>Дата окончания тарифа:</label>
              <div class="input-group date">
                <label class="input-group-addon" for="datepicker">
                  <i class="fa fa-calendar"></i>
                </label>
                <input class="form-control pull-right" id="user_{{ $row["id"] }}_tariff_end" name="user_{{ $row["id"] }}_tariff_end" type="text" autocomplete="off">
              </div>
            </div>
            <hr>

            <div class="form-group">
              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_is_buyer">Покупатель</label>
                <input type="checkbox" checked="checked" id="user_{{ $row["id"] }}_profile_is_buyer" name="user_{{ $row["id"] }}_profile_is_buyer" style="position: relative; top:3px; margin-left: 9px;">
              </div>

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_is_seller">Продавец</label>
                <input type="checkbox" {{ $row["is_seller"] ? 'checked="checked"' : ''}} id="user_{{ $row["id"] }}_profile_is_seller" name="user_{{ $row["id"] }}_profile_is_seller" autocomplete="off" style="position: relative; top:3px; margin-left: 9px;">
              </div>

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_is_decorator">Декоратор</label>
                <input type="checkbox" {{ $row["is_decorator"] ? 'checked="checked"' : ''}} id="user_{{ $row["id"] }}_profile_is_decorator" name="user_{{ $row["id"] }}_profile_is_decorator" autocomplete="off" style="position: relative; top:3px; margin-left: 9px;">
                <div class="input-group date">
                  <label class="input-group-addon" for="datepicker">
                    <i class="fa fa-calendar"></i>
                  </label>
                  <input class="form-control pull-right" id="user_{{ $row["id"] }}_profile_decorator_end" name="user_{{ $row["id"] }}_profile_decorator_end" type="text" autocomplete="off" value="{{ $row["decorator_end"] }}">
                </div>
              </div>

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_is_partymaker">Организатор</label>
                <input type="checkbox" {{ $row["is_partymaker"] ? 'checked="checked"' : ''}} id="user_{{ $row["id"] }}_profile_is_partymaker" name="user_{{ $row["id"] }}_profile_is_partymaker" style="position: relative; top:3px; margin-left: 9px;">
                <div class="input-group date">
                  <label class="input-group-addon" for="datepicker">
                    <i class="fa fa-calendar"></i>
                  </label>
                  <input class="form-control pull-right" id="user_{{ $row["id"] }}_profile_partymaker_end" name="user_{{ $row["id"] }}_profile_partymaker_end" type="text" autocomplete="off" value="{{ $row["partymaker_end"] }}">
                </div>
              </div>
            </div>
            <hr>
            
            <h4 class="text-center">Профиль пользователя</h4>
            <div class="form-group">
              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_first_name">Имя</label>
                <input type="text" class="form-control" id="user_{{ $row["id"] }}_profile_first_name" name="user_{{ $row["id"] }}_profile_first_name" value="{{ $row["first_name"] }}" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_last_name">Фамилия</label>
                <input type="text" class="form-control" id="user_{{ $row["id"] }}_profile_last_name" name="user_{{ $row["id"] }}_profile_last_name" value="{{ $row["last_name"] }}" autocomplete="off">
              </div>
            
              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_nickname">Ник</label>
                <input type="text" class="form-control" id="user_{{ $row["id"] }}_profile_nickname" name="user_{{ $row["id"] }}_profile_nickname" value="{{ $row["nickname"] }}" autocomplete="off">
              </div>
            
              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_phone">Телефон</label>
                <input type="text" class="form-control" id="user_{{ $row["id"] }}_profile_phone" name="user_{{ $row["id"] }}_profile_phone" value="{{ $row["phone"] }}" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_site">Сайт</label>
                <input type="text" class="form-control" id="user_{{ $row["id"] }}_profile_site" name="user_{{ $row["id"] }}_profile_site" value="{{ $row["site"] }}" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_about_me">Обо мне</label>
                <textarea class="form-control description" id="user_{{ $row["id"] }}_profile_about_me" name="user_{{ $row["id"] }}_profile_about_me" autocomplete="off" rows=6>{{ $row["about_me"] }}</textarea>
              </div>
            </div>

            {{-- <h4 class="text-center">Анкеты растений</h4> --}}
            <div class="form-group">
              {{-- <h5 class="text-center">Общие данные</h5> --}}

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_sort_ques_general_info_region">Регион</label>
                <input type="text" class="form-control" id="user_{{ $row["id"] }}_sort_ques_general_info_region" name="user_{{ $row["id"] }}_sort_ques_general_info_region" value="{{ $row["sort_ques_general_infos"]["region"] }}" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_sort_ques_general_info_locality">Населенный пункт</label>
                <input type="text" class="form-control" id="user_{{ $row["id"] }}_sort_ques_general_info_locality" name="user_{{ $row["id"] }}_sort_ques_general_info_locality" value="{{ $row["sort_ques_general_infos"]["locality"] }}" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_sort_ques_general_info_soil">Вид почвы</label>
                <input type="text" class="form-control" id="user_{{ $row["id"] }}_sort_ques_general_info_soil" name="user_{{ $row["id"] }}_sort_ques_general_info_soil" value="{{ $row["sort_ques_general_infos"]["soil"] }}" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_sort_ques_general_info_high">Высота над уровнем моря</label>
                <input type="number" min=0 class="form-control" id="user_{{ $row["id"] }}_sort_ques_general_info_high" name="user_{{ $row["id"] }}_sort_ques_general_info_high" value="{{ $row["sort_ques_general_infos"]["high"] }}" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_sort_ques_general_info_precipitation">Количество осадков</label>
                <input type="number" min=0 class="form-control" id="user_{{ $row["id"] }}_sort_ques_general_info_precipitation" name="user_{{ $row["id"] }}_sort_ques_general_info_precipitation" value="{{ $row["sort_ques_general_infos"]["precipitation"] }}" autocomplete="off">
              </div>
            </div>

            <div class="form-group">
              <div class="form-group">
                <p>Присланные статьи: {{ $row["handbooks_count"] }} шт</p>
              </div>

              <div class="form-group">
                <p>Присланные анкеты: {{ count($row["sort_questionaries"]) }} шт</p>
              </div>

              <div class="form-group">
                <p>Присланные фото: {{ $row["photos_count"] }} шт</p>
              </div>

              <div class="form-group">
                <p>Количество заказов: {{ $row["orders_count_buyer"] }} шт</p>
              </div>
            </div>

            <div class="form-group">
              <table id="user_{{ $row["id"] }}_sort_questionary_table" class="table">
                <thead>
                  <tr>
                    <th>Культура</th>
                    <th>Сорт</th>
                    <th>Ссылка</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($row["sort_questionaries"] as $questionary)
                  <tr>
                    <td class='col-sm-5'>
                      {{ $questionary["sort"]["culture"]["name"] }}
                    </td>
                    <td class='col-sm-5'>
                      {{ $questionary["sort"]["name"] }}
                    </td>
                    <td class="col-sm-2">
                      <a target="_blank" href="questionary?id={{ $questionary["id"] }}" style="margin-right: 6px;">
                        анкета_{{ $questionary["id"] }}.txt
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>Культура</th>
                    <th>Сорт</th>
                    <th>Ссылка</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <hr>

            <h4 class="text-center">Профиль продавца</h4>
            <div class="form-group">
              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_about_me_seller">Обо мне (продавец)</label>
                <textarea class="form-control description" id="user_{{ $row["id"] }}_profile_about_me_seller" name="user_{{ $row["id"] }}_profile_about_me_seller" autocomplete="off" rows=6>{{ $row["about_me_seller"] }}</textarea>
              </div>

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_rating_seller">Рейтинг продавца</label>
                <input type="number" class="form-control" value="{{ $row["rating_seller"] }}" id="user_{{ $row["id"] }}_profile_rating_seller" name="user_{{ $row["id"] }}_profile_rating_seller" autocomplete="off">
              </div>

              <div class="form-group">
                <p>Асортимент: {{ $row["order_sorts_count_seller"] }} сортов</p>
              </div>

              <div class="form-group">
                <p>Заказов: {{ $row["orders_count_seller"] }} шт</p>
              </div>

              <div class="form-group">
              @foreach($attributesDictionarySeller as $attributeId => $attributeName)
              @if(isset($attributeValuesDictionarySeller[$attributeId]))
                <table class="table col-sm-12">
                  <thead>
                    <tr>
                      <th class="col-sm-4">{{ $attributeName }}</th>
                      <th class="col-sm-8"></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($attributeValuesDictionarySeller[$attributeId] as $valueId => $value)
                    <tr>
                      <td class="col-sm-4"></td>
                      <td class="col-sm-4">
                        {{ $value }}
                      </td>
                      <td class="col-sm-4">
                        <input type="checkbox" name="user_{{$row["id"]}}_attribute_{{$attributeId}}_value_{{$valueId}}" @if(isset($row["attributes"][$attributeId][$valueId])) checked="checked" @endif autocomplete="off">
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
              @endforeach
              </div>
            </div>
            <hr>

            <h4 class="text-center">Профиль декоратора</h4>
            <div class="form-group">
              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_about_me_decorator">Обо мне (декоратор)</label>
                <textarea class="form-control description" id="user_{{ $row["id"] }}_profile_about_me_decorator" name="user_{{ $row["id"] }}_profile_about_me_decorator" autocomplete="off" rows=6>{{ $row["about_me_decorator"] }}</textarea>
              </div>

              <div class="form-group">
                <label for="user_{{ $row["id"] }}_profile_rating_decorator">Рейтинг декоратора</label>
                <input type="number" class="form-control" value="{{ $row["rating_decorator"] }}" id="user_{{ $row["id"] }}_profile_rating_decorator" name="user_{{ $row["id"] }}_profile_rating_decorator" autocomplete="off">
              </div>

              <div class="form-group">
              @foreach($attributesDictionaryDecorator as $attributeId => $attributeName)
              @if(isset($attributeValuesDictionaryDecorator[$attributeId]))
                <table class="table col-sm-12">
                  <thead>
                    <tr>
                      <th class="col-sm-4">{{ $attributeName }}</th>
                      <th class="col-sm-8"></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($attributeValuesDictionaryDecorator[$attributeId] as $valueId => $value)
                    <tr>
                      <td class="col-sm-4"></td>
                      <td class="col-sm-4">
                        {{ $value }}
                      </td>
                      <td class="col-sm-4">
                        <input type="checkbox" name="user_{{$row["id"]}}_attribute_{{$attributeId}}_value_{{$valueId}}" @if(isset($row["attributes"][$attributeId][$valueId])) checked="checked" @endif autocomplete="off">
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
              @endforeach
              </div>
            </div>
            <hr>

            <h4 class="text-center">Профиль организатора</h4>
            <div class="form-group">
              <div class="form-group">
                <p>Количество событий: {{ $row["events_count"] }}</p>
              </div>
            </div>
            <hr>

          </div>
          <div class="modal-footer">
            {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
            {{ Form::submit('Сохранить изменения', ['class' => 'btn btn-primary']) }}
          </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">

$('.description').wysihtml5();

$(window).ready(function() {
  @if(isset($user_id))
  var top = document.getElementById("edit_button_{{ $user_id }}").offsetTop;
  window.scrollTo(0, top);
  @endif
});

$.fn.datepicker.dates['ru'] = {
    days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
    daysShort: ["Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Сбт"],
    daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
    months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
    monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
    today: "Сегодня",
    format: 'yyyy-mm-dd',
    weekStart: 1
};


@foreach($rows as $row)
@foreach($row["sort_questionaries"] as $questionary)
['seeding_date', 'ground_transplantation_date', 'trimming_date'].forEach(function(param){
  $('#user_{{ $row["id"] }}_questionary_{{ $questionary->id }}_' + param).datepicker({
    language: 'ru',
    autoclose: true
  });
});
@endforeach
@endforeach


[@foreach($rows as $row){{ $row["id"] }},@endforeach].forEach(function(user_id) {
  var today = new Date();

  $('#user_' + user_id + '_tariff_end').datepicker({
    language: 'ru',
    autoclose: true
  });

  $('#user_' + user_id + '_tariff_end').datepicker(
    'setDate', new Date(1900+today.getYear(), today.getMonth()+1, today.getDate())
  );

  $('#user_' + user_id + '_profile_decorator_end').datepicker({
    language: 'ru',
    autoclose: true
  });
  
  $('#user_' + user_id + '_profile_decorator_end').datepicker(
    'setDate', new Date(1900+today.getYear(), today.getMonth()+1, today.getDate())
  );

  $('#user_' + user_id + '_profile_partymaker_end').datepicker({
    language: 'ru',
    autoclose: true
  });
  
  $('#user_' + user_id + '_profile_partymaker_end').datepicker(
    'setDate', new Date(1900+today.getYear(), today.getMonth()+1, today.getDate())
  );

  var user_sort_questionary_table = $('#user_' + user_id + '_sort_questionary_table').dataTable({
    "bPaginate": true,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
    "bSort": true,
    "columnDefs": [{ "orderable": false, "targets": [2] }],
    "stateSave": true,
    "scrollX": true,
    "autoWidth": false,
    "language": {
      "lengthMenu": "Показать _MENU_ анкет на странице",
      "search": "Поиск:",
      "emptyTable": "Анкеты отсутствуют",
      "info": "Страница _PAGE_ из _PAGES_",
      "paginate": {
          "first": "Первая",
          "last": "Последняя",
          "next": "Следующая",
          "previous": "Предыдущая"
      }
    }
  });

  $("#modal_" + user_id).on('shown.bs.modal', function() {
    user_sort_questionary_table.api().columns.adjust();
  });

});

var table = $('#modelTable').dataTable({
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": true,
  "columnDefs": [{ "orderable": false, "targets": [6] }],
  "stateSave": true,
  "scrollX": true,
  "autoWidth": false,
  "language": {
    "lengthMenu": "Показать _MENU_ записей на странице",
    "search": "Поиск:",
    "emptyTable": "Записи отсутствуют",
    "info": "Страница _PAGE_ из _PAGES_",
    "paginate": {
        "first": "Первая",
        "last": "Последняя",
        "next": "Следующая",
        "previous": "Предыдущая"
    }
  }
});

table.api().columns.adjust();

</script>
@endsection