@extends('admin.main')

@section('form')
<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#response_creation_modal">Добавить коментарий</button>
<div class="modal fade" id="response_creation_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление нового коментария</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createModerateResponses", 'method' => 'post']) }}
      {{ csrf_field() }}
      <div class="modal-body">

        <div class="form-group">
          <label for="creation_type">Тип</label>
          <select class="form-control" id="creation_type" name="creation_type" autocomplete="off">
            @foreach($types_objects as $type => $type_object)
            <option value="{{ $type }}">{{ $type_object["translated"] }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="creation_item_id">Обьект</label>
          <select class="form-control" id="creation_item_id" name="creation_item_id" autocomplete="off">
            @foreach($types_objects as $type => $type_object)
              @foreach($type_object["objects"] as $object)
              <option value="{{ $object["id"] }}" type="{{ $type }}">
                @if(isset($object["name"])){{ $object["name"] }}@endif
                @if(isset($object["email"])){{ $object["email"] }}@endif
              </option>
              @endforeach
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="creation_rating">Оценка</label>
          <input type="number" min=1 max=5 class="form-control" id="creation_rating" name="creation_rating" autocomplete="off">
        </div>

        <div class="form-group">
          <label for="creation_text">Текст</label>
          <textarea class="form-control" id="creation_text" name="creation_text" rows=6 style="width: 100%; resize: vertical;" placeholder="Введите текст коментария" autocomplete="off"></textarea>
        </div>

      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить коментарий', ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateModerateResponses",
                   'method' => 'put',
                   'id' => 'modelForm',
                   'class' => 'form-horizontal',
                   'files' => true]) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table">
      <thead>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('user', 'Пользователь', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('item', 'Обьект', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('type', 'Тип', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('text', 'Текст', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('rating', 'Оценка', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('moderator', 'Статус', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', '', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', 'Удалить', ['class' => 'col-sm-12']) }}</th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class='col-sm-1 text-center'>
            {{ $row["id"] }}
          </td>
          <td class='col-sm-1 text-center'>
            {{ $row["user"]["email"] }}
          </td>
          <td class='col-sm-1 text-center'>
            @if(isset($row["item"]["name"]))
            {{ $row["item"]["name"] }}
            @elseif(isset($row["item"]["email"]))
            {{ $row["item"]["email"] }}
            @endif
          </td>
          <td class='col-sm-1 text-center'>
            {{ $row["type"] }}
          </td>
          <td class='col-sm-4 text-center'>
            <p class="hidden">{{ $row["text"] }}<p>
            <textarea class="form-control" name="text_{{ $row["id"] }}" rows=6 style="width: 100%;" autocomplete="off">{{ $row["text"] }}</textarea>
          </td>
          <td class='col-sm-1 text-center'>
            <p class="hidden">{{ $row["rating"] }}</p>
            <input type="number" min=1 max=5 class="form-control" name="rating_{{ $row["id"] }}" value="{{ $row["rating"] }}" autocomplete="off">
          </td>
          <td class='col-sm-1' autocomplete="off">
            <p class="hidden">{{ $row["moderator"] }}<p>
            <select class="form-control" id="moderator_{{ $row["id"] }}" name="moderator_{{ $row["id"] }}" autocomplete="off">
              <option value="accepted" @if($row["moderator"] == "accepted") selected="selected" @endif>Принят</option>
              <option value="new" @if($row["moderator"] == "new") selected="selected" @endif>Новый</option>
            </select>
          </td>
          <td class="col-sm-1">
            {{ Form::button('Ответы', ['class' => 'col-sm-12 btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modal_'.$row["id"]]) }}
          </td>
          <td class="col-sm-1 text-center">
            <input type="checkbox" name="response_{{ $row["id"] }}_for_delete" autocomplete="off">
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('user', 'Пользователь', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('item', 'Обьект', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('type', 'Тип', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('text', 'Текст', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('rating', 'Оценка', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('moderator', 'Статус', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', '', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', 'Удалить', ['class' => 'col-sm-12']) }}</th>
        </tr>
      </tfoot>
    </table>
    {{ Form::submit('Сохранить изменения', ['class' => 'btn btn-primary', (!count($rows)?'disabled':'')]) }}
    {{ Form::close() }}

    @foreach($rows as $row)
    <div class="modal" id="modal_{{ $row["id"] }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel_{{ $row["id"] }}" aria-hidden="true" style="overflow-y: scroll;">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modalLabel_{{ $row["id"] }}">{{ $row["text"] }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#response_{{ $row["id"] }}_answer_creation_modal">Добавить ответ</button>

          {{ Form::open(['action' => "AdminLTEController@updateModerateResponses", 'method' => 'put']) }}
          {{ csrf_field() }}
          <input type="text" name="answers_response_id" value="{{ $row["id"] }}" class="hidden">
          <div class="modal-body">

            <table id="response_{{ $row["id"] }}_answers_table" class="table">
              <thead>
                <tr>
                  <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('user', 'Пользователь', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('response', 'Текст ответа', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('date', 'Дата', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('moderator', 'Статус', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('', 'Удалить', ['class' => 'col-sm-12']) }}</th>
                </tr>
              </thead>
              <tbody>
              @if(isset($answers[$row["id"]]))
              @foreach($answers[$row["id"]] as $answer)
                <tr>
                  <td class='col-sm-1 text-center'>
                    {{ $answer["id"] }}
                  </td>
                  <td class='col-sm-1 text-center'>
                    {{ $answer["user"]["email"] }}
                  </td>
                  <td class='col-sm-6 text-center'>
                    <p class="hidden">{{ $answer["response"] }}<p>
                    <textarea class="form-control" name="response_{{ $row["id"] }}_answer_{{ $answer["id"] }}_response" rows=6 style="width: 100%; resize: vertical;" autocomplete="off">{{ $answer["response"] }}</textarea>
                  </td>
                  <td class='col-sm-1 text-center'>
                    {{ $answer["date"] }}
                  </td>
                  <td class='col-sm-2' autocomplete="off">
                    <p class="hidden">{{ $answer["moderator"] }}<p>
                    <select class="form-control" name="response_{{ $row["id"] }}_answer_{{ $answer["id"] }}_moderator" autocomplete="off">
                      <option value="accepted" @if($answer["moderator"] == "accepted") selected="selected" @endif>Принят</option>
                      <option value="new" @if($answer["moderator"] == "new") selected="selected" @endif>Новый</option>
                    </select>
                  </td>
                  <td class="col-sm-1 text-center">
                    <input type="checkbox" name="response_{{ $row["id"] }}_answer_{{ $answer["id"] }}_for_delete" autocomplete="off">
                  </td>
                </tr>
              @endforeach
              @endif
              </tbody>
              <tfoot>
                <tr>
                  <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('user', 'Пользователь', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('response', 'Текст ответа', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('date', 'Дата', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('moderator', 'Статус', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('', 'Удалить', ['class' => 'col-sm-12']) }}</th>
                </tr>
              </tfoot>
            </table>
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

    @foreach($rows as  $row)
    <div class="modal fade" id="response_{{ $row["id"] }}_answer_creation_modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modalLabel">Добавление нового ответа</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          {{ Form::open(['action' => "AdminLTEController@createModerateResponses", 'method' => 'post']) }}
          {{ csrf_field() }}
          <div class="modal-body">
            <input type="text" name="answers_response_id" value="{{ $row["id"] }}" class="hidden">
            <div class="form-group">
              <label for="creation_response">Текст ответа</label>
              <textarea type="text" class="form-control" name="creation_response" placeholder="Введите ответ" style="resize: vertical;" rows=6></textarea> 
            </div> 
          </div>
          <div class="modal-footer">
            {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
            {{ Form::submit('Добавить ответ', ['class' => 'btn btn-primary']) }}
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
var update_creation_type = function() {
  ['sort', 'chemical', 'decorator', 'seller'].forEach(function(type) {
    $("option[type='" + type + "']").each(function (i, option) {
      $(option).hide();
    });
  });

  $("option[type='" + this.value + "']").each(function (i, option) {
    if(i == 0) {
      $(option).prop('selected', true);
    }
    $(option).show();
  });
  // $("option_you_want_to_hide").wrap('<span/>')
};
$('#creation_type').on('change', update_creation_type);
update_creation_type();

var table = $('#modelTable').dataTable({
  initComplete: function () {
    this.api().columns([3]).every( function (i) {
      var column = this;

      if(column.header().attributes[4].name == 'style') {
        var header = column.header().attributes[3].nodeValue;
      } else {
        var header = column.header().attributes[4].nodeValue;
      }
      
      var select = $('<select class="form-control"><option selected="selected" value="">' + header + '</option></select>')
        .appendTo( $(column.header()).empty() )
        .on( 'change', function () {
          var val = $.fn.dataTable.util.escapeRegex(
            $(this).val()
          );

          column
            .search( val ? '^'+val+'$' : '', true, false )
            .draw();
        });

        column.data().unique().sort().each( function ( d, j ) {
          if(column.search() === '^'+d+'$'){
            select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
          } else {
            select.append( '<option value="'+d+'">'+d+'</option>' )
          }
        });
    });
  },
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": true,
  "columnDefs": [{ "orderable": false, "targets": [3, 4, 7, 8] }],
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

[@foreach($rows as $row){{ $row["id"] }},@endforeach].forEach(function(table_id) {
  var table = $('#response_' + table_id + '_answers_table').dataTable({
    "bPaginate": true,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
    "bSort": true,
    "columnDefs": [{ "orderable": false, "targets": [2, 5] }],
    "stateSave": true,
    "scrollX": true,
    "autoWidth": false,
    "language": {
      "lengthMenu": "Показать _MENU_ записей на странице",
      "search": "Поиск:",
      "emptyTable": "Ответы отсутствуют",
      "info": "Страница _PAGE_ из _PAGES_",
      "paginate": {
          "first": "Первая",
          "last": "Последняя",
          "next": "Следующая",
          "previous": "Предыдущая"
      }
    }
  });

  $("#modal_" + table_id).on('shown.bs.modal', function() {
    table.api().columns.adjust();
  });

  $('#response_' + table_id + '_answers_table').on('submit', function(e) {
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
});

</script>
@endsection