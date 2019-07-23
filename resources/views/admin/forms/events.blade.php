@extends('admin.main')





@section('form')


<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить событие</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление нового события</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createEvents", 'method' => 'post', 'files' => true]) }}
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
          <label for="creationMainPhoto">Выбрать главное изображение</label>
          <input type="file" name="creationMainPhoto" id="creationMainPhoto">
        </div>
        <hr>
        <div class="form-group">
          <label for="creationTitle">Название</label>
          <input type="text" class="form-control" id="creationTitle" name="creationTitle" placeholder="Введите название">
        </div>
        <div class="form-group">
          <label for="creationTitle">Организатор</label>
          <select name="partymaker">
            <option value="нету организатора">нету организатора</option>
            @foreach($partymaker as $value )
            <option value="{{ $value }}">{{ $value }}</option>
            @endforeach
          </select>

        </div>
        <div class="form-group">
          <label for="creationDate">Дата</label>
          <div class="input-group date">
            <label class="input-group-addon" for="creationDate">
              <i class="fa fa-calendar"></i>
            </label>
            <input class="form-control pull-right" id="creationDate" name="creationDate" type="text" autocomplete="off">
          </div>
        </div>
        <div class="form-group">
          @foreach($attributesDictionary as $attributeId => $attributeName)
          @if(isset($attributeValuesDictionary[$attributeId]))
            <table class="table col-sm-12">
              <thead>
                <tr>
                  <th class="col-sm-4">{{ $attributeName }}</th>
                  <th class="col-sm-8"></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($attributeValuesDictionary[$attributeId] as $valueId => $value)
                <tr>
                  <td class="col-sm-4"></td>
                  <td class="col-sm-4">
                    {{ $value }}
                  </td>
                  <td class="col-sm-4">
                    <input type="checkbox" name="creation_attribute_{{$attributeId}}_value_{{$valueId}}" autocomplete="off">
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          @endif
          @endforeach
        </div>
        <div class="form-group">
          <label for="creationDescription">Описание</label>
          <textarea class="form-control description" id="creationDescription" name="creationDescription" placeholder="Введите описание" autocomplete="off" rows=15></textarea>
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить событие', ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="box">
  <div class="box-body">
    <table id="modelTable" class="table">
      <thead>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('user', 'Организатор', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('title', 'Название', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('date', 'Дата', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('participants', 'Кол-во участников', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', '', ['class' => 'col-sm-12']) }}</th>
          <th class="text-center">{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class='col-sm-1 text-center'>
            {{ $row["id"] }}
          </td>
          <td class='col-sm-2'>
           {{ $row['partymaker'] }}
          </td>
          <td class='col-sm-3'>
            {{ $row["title"] }}
          </td>
          <td class='col-sm-1'>
            {{ $row["date"] }}
          </td>
          <td class='col-sm-1'>
            {{ $row["participants"] }}
          </td>
          <td class="col-sm-1">
            <input type="button" class="col-sm-12 btn btn-primary" id="edit_button_{{ $row["id"] }}" data-toggle="modal" data-target="#modal_{{ $row["id"] }}" value="Редактировать">
          </td>
          <td class="col-sm-1 text-center">
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete_event_{{ $row["id"] }}" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal fade" id="delete_event_{{ $row["id"] }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">Подтверждение удаления</h4>
                  </div>
                  {{ Form::open(['action' => "AdminLTEController@deleteEvents", 'method' => 'delete']) }}
                  {{ csrf_field() }}
                  <input type="text" name="event_id" value="{{ $row["id"] }}" class="hidden">
                  <div class="modal-footer">
                    {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
                    {{ Form::submit('Удалить событие', ['class' => 'btn btn-danger']) }}
                  </div>
                  {{ Form::close() }}
                </div>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('user', 'Организатор', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('title', 'Название', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('date', 'Дата', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('participants', 'Кол-во участников', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', '', ['class' => 'col-sm-12']) }}</th>
          <th class="text-center">{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </tfoot>
    </table>

    @foreach($rows as $row)
    <div class="modal fade" id="modal_{{ $row["id"] }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="overflow-y: scroll;">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modalLabel">{{ $row["title"] }}</h4>
            @if(isset($row["profile"]) && isset($row["user"]))
            <div style="color: gray;">Организатор: {{ $row["profile"]["first_name"] }} {{ $row["profile"]["last_name"] }} ({{ $row["user"]["email"] }}, @if(isset($row["profile"]["phone"])){{ $row["profile"]["phone"] }}@endif)</div>
            @endif
          </div>
          {{ Form::open(['action' => "AdminLTEController@updateEvents", 'method' => 'put', 'files' => true]) }}
          {{ csrf_field() }}
          <div class="modal-body">
            <input type="text" name="event_id" class="hidden" value="{{ $row["id"] }}">
            <div class="form-group">
              <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$row["main_photo"]);@endphp>
                <img src=@php echo($_ENV['PHOTO_FOLDER'].$row["main_photo"]);@endphp class='col-sm-12' alt='{{ $row["main_photo"] }}' style="width: 100%;">
              </a>
            </div>
            <div class="form-group">
              <label for="event_main_photo">Загрузить новое фото</label>
              <input type="file" name="event_main_photo" id="event_main_photo">
            </div>
            <hr>
            <div class="form-group">
              <label for="event_title">Название</label>
              <input type="text" class="form-control" id="event_title" name="event_title" placeholder="Введите название" value="{{ $row["title"] }}">
            </div>
            <div class="form-group">
              <label for="creationTitle">Организатор</label>
              <select name="partymaker">
                <option value="нету организатора">нету организатора</option>
                @foreach($partymaker as $value )
                  <option value="{{ $value }}"  >{{ $value }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="event_description">Описание</label>
              <textarea class="form-control description" id="event_description" name="event_description" placeholder="Введите описание" rows="12" style="resize: vertical;">{{ $row["description"] }}</textarea>
            </div>
            <div class="form-group">
              @foreach($attributesDictionary as $attributeId => $attributeName)
              @if(isset($attributeValuesDictionary[$attributeId]))
                <table class="table col-sm-12">
                  <thead>
                    <tr>
                      <th class="col-sm-4">{{ $attributeName }}</th>
                      <th class="col-sm-8"></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($attributeValuesDictionary[$attributeId] as $valueId => $value)
                    <tr>
                      <td class="col-sm-4"></td>
                      <td class="col-sm-4">
                        {{ $value }}
                      </td>
                      <td class="col-sm-4">
                        <input type="checkbox" name="event_{{$row["id"]}}_attribute_{{$attributeId}}_value_{{$valueId}}" @if(isset($row["attributes"][$attributeId][$valueId])) checked="checked" @endif autocomplete="off">
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
              @endforeach
            </div>
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
$(window).ready(function() {
  @if(isset($event_id))
  var top = document.getElementById("edit_button_{{ $event_id }}").offsetTop;
  window.scrollTo(0, top);
  @endif
});

$('.description').wysihtml5();

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
var datepicker = $('#creationDate').datepicker({
  language: 'ru',
  autoclose: true
});

var table = $('#modelTable').dataTable({
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": true,
  "columnDefs": [{ "orderable": false, "targets": [5, 6] }],
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