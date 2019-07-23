@extends('admin.main')

@section('form')
<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить день</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление нового лунного дня</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createMoonDates", 'method' => 'post']) }}
      {{ csrf_field() }}
      <div class="modal-body">
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
          <label for="creationPhaseId">Фаза луны</label>
          <select class="form-control" name="creationPhaseId" id="creationPhaseId" autocomplete="off">
            @foreach($phases as $phase)
            <option value="{{ $phase["id"] }}">{{ $phase["title"] }} ({{ $phase["phase_type"] }})</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="creationElement">Стихия</label>
          <select class="form-control" name="creationElement" id="creationElement" autocomplete="off">
            <option value="вода">Вода</option>
            <option value="земля">Земля</option>
            <option value="огонь">Огонь</option>
            <option value="воздух">Воздух</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить день', ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="box">
  <div class="box-body">

    {{ Form::open(['id' => 'modelForm', 'action' => "AdminLTEController@updateMoonDates", 'method' => 'put']) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table">
      <thead>
        <tr>
          <th>Дата</th>
          <th>Фаза луны</th>
          <th></th>
          <th class="text-center">Стихия</th>
          <th>Удалить</th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class="col-sm-3">
            <p class="hidden">{{ $row["date"] }}</p>
            <div class="input-group date">
              <label class="input-group-addon" for="moon_date_{{ $row["id"] }}_date">
                <i class="fa fa-calendar"></i>
              </label>
              <input type="text" class="form-control pull-right" id="moon_date_{{ $row["id"] }}_date" name="moon_date_{{ $row["id"] }}_date" value="{{ $row["date"] }}" autocomplete="off">
            </div>
          </td>
          <td class="col-sm-4">
            <p class="hidden">{{ $row["phase_id"] }}</p>
            <select class="form-control" name="moon_date_{{ $row["id"] }}_phase_id" autocomplete="off">
              @foreach($phases as $phase)
              <option value="{{ $phase["id"] }}" @if($row["phase_id"] ==  $phase["id"]) selected="selected" @endif>
                {{ $phase["title"] }} ({{ $phase["phase_type"] }})
              </option>
              @endforeach
            </select>
          </td>
          <td class="col-sm-1" style="background-color: #222;">
            <img src=@php echo($_ENV['PHOTO_FOLDER'].$row['phase']['icon']);@endphp alt="{{ $row["phase"]["icon"] }}" class="image col-sm-12">
          </td>
          <td class="col-sm-3 text-center">
            <p class="hidden">{{ $row["element"] }}</p>
            <select class="form-control" name="moon_date_{{ $row["id"] }}_element" autocomplete="off">
              <option value="вода" @if($row["element"] == "вода") selected="selected" @endif>Вода</option>
              <option value="земля" @if($row["element"] == "земля") selected="selected" @endif>Земля</option>
              <option value="огонь" @if($row["element"] == "огонь") selected="selected" @endif>Огонь</option>
              <option value="воздух" @if($row["element"] == "воздух") selected="selected" @endif>Воздух</option>
            </select>
          </td>
          <td class="col-sm-1 text-center">
            <input type="checkbox" name="moon_date_{{ $row["id"] }}_for_delete" autocomplete="off">
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>Дата</th>
          <th>Фаза луны</th>
          <th></th>
          <th class="text-center">Стихия</th>
          <th>Удалить</th>
        </tr>
      </tfoot>
    </table>
    {{ Form::submit('Сохранить изменения', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}

  </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">
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
[@foreach($rows as $row){{ $row["id"] }},@endforeach].forEach(function(date_id) {
  $("#moon_date_" + date_id + "_date").datepicker({
    language: 'ru',
    autoclose: true
  });
});
$("#creationDate").datepicker({
  language: 'ru',
  autoclose: true
});

var table = $('#modelTable').dataTable({
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": true,
  "columnDefs": [{ "orderable": false, "targets": [2, 4] }],
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

$('#modelForm').on('submit', function(e) {
  var form = this;

  // Encode a set of form elements from all pages as an array of names and values
  var params = table.$('input,select,textarea').serializeArray();

  // Iterate over all form elements
  $.each(params, function() {
    // If element doesn't exist in DOM
    if(!$.contains(document, form[this.name])) {
      // Create a hidden element
      $(form).append(
        $('<input>')
          .attr('type', 'hidden')
          .attr('name', this.name)
          .val(this.value)
      );
    }
  });
});
</script>
@endsection