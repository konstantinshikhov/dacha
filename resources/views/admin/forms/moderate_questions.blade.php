@extends('admin.main')

@section('form')
<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#question_creation_modal">Добавить вопрос</button>
<div class="modal fade" id="question_creation_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление нового вопроса</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createModerateQuestions", 'method' => 'post']) }}
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
          <label for="creation_title">Заголовок</label>
          <input type="text" class="form-control" name="creation_title" placeholder="Введите заголовок вопроса">
        </div>
        <div class="form-group">
          <label for="creation_title">Секция</label>
          <select class="form-control" name="creation_section_id" autocomplete="off">
            <option value="0">Отсутствует</option>
            @foreach($sections as $section_id => $section)
            <option value="{{ $section_id }}">{{ $section->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="creation_text">Текст</label>
          <textarea class="form-control" name="creation_text" rows=6 style="width: 100%; resize: vertical;" placeholder="Введите текст вопроса" autocomplete="off"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить вопрос', ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateModerateQuestions",
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
          <th>{{ Form::label('section', 'Секция', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('title', 'Заголовок', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('text', 'Текст вопроса', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('moderator', 'Статус', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('is_closed', 'Закрыт', ['class' => 'col-sm-12']) }}</th>
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
            {{ $row["section"]["name"] }}
          </td>
          <td class='col-sm-1 text-center'>
            <p class="hidden">{{ $row["title"] }}<p>
            <input class="form-control" type="text" name="title_{{ $row["id"] }}" value="{{ $row["title"] }}">
          </td>
          <td class='col-sm-4 text-center'>
            <p class="hidden">{{ $row["text"] }}<p>
            <textarea class="form-control" name="text_{{ $row["id"] }}" rows=6 style="width: 100%;" autocomplete="off">{{ $row["text"] }}</textarea>
          </td>
          <td class='col-sm-1' autocomplete="off">
            <p class="hidden">{{ $row["moderator"] }}<p>
            <select class="form-control" id="moderator_{{ $row["id"] }}" name="moderator_{{ $row["id"] }}" autocomplete="off">
              <option value="accepted" @if($row["moderator"] == "accepted") selected="selected" @endif>Принят</option>
              <option value="new" @if($row["moderator"] == "new") selected="selected" @endif>Новый</option>
            </select>
          </td>
          <td class='col-sm-1' autocomplete="off">
            <p class="hidden">{{ $row["is_closed"] }}<p>
            <select class="form-control" id="is_closed_{{ $row["id"] }}" name="is_closed_{{ $row["id"] }}" autocomplete="off">
              <option value="1" @if($row["is_closed"] == 1) selected="selected" @endif>Закрыт</option>
              <option value="0" @if($row["is_closed"] == 0) selected="selected" @endif>Открыт</option>
            </select>
          </td>
          <td class="col-sm-1">
            {{ Form::button('Ответы', ['class' => 'col-sm-12 btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modal_'.$row["id"]]) }}
          </td>
          <td class="col-sm-1 text-center">
            <input type="checkbox" name="question_{{ $row["id"] }}_for_delete" autocomplete="off">
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('user', 'Пользователь', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('section', 'Секция', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('title', 'Заголовок', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('text', 'Текст вопроса', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('moderator', 'Статус', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('is_closed', 'Закрыт', ['class' => 'col-sm-12']) }}</th>
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
            <h4 class="modal-title" id="modalLabel_{{ $row["id"] }}">{{ $row["title"] }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#question_{{ $row["id"] }}_answer_creation_modal">Добавить ответ</button>

          {{ Form::open(['action' => "AdminLTEController@updateModerateQuestions", 'method' => 'put']) }}
          {{ csrf_field() }}
          <input type="text" name="answers_question_id" value="{{ $row["id"] }}" class="hidden">
          <div class="modal-body">

            <table id="question_{{ $row["id"] }}_answers_table" class="table">
              <thead>
                <tr>
                  <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('user', 'Пользователь', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('text', 'Текст ответа', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('date', 'Дата', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('is_best', 'Лучший', ['class' => 'col-sm-12']) }}</th>
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
                    <p class="hidden">{{ $answer["text"] }}<p>
                    <textarea class="form-control" name="question_{{ $row["id"] }}_answer_{{ $answer["id"] }}_text" rows=6 style="width: 100%;" autocomplete="off">{{ $answer["text"] }}</textarea>
                  </td>
                  <td class='col-sm-1 text-center'>
                    {{ $answer["date"] }}
                  </td>
                  <td class='col-sm-1' autocomplete="off">
                    <p class="hidden">{{ $answer["is_best"] }}<p>
                    <select class="form-control" name="question_{{ $row["id"] }}_answer_{{ $answer["id"] }}_is_best" autocomplete="off">
                      <option value="1" @if($answer["is_best"] == 1) selected="selected" @endif>Да</option>
                      <option value="0" @if($answer["is_best"] == 0) selected="selected" @endif>Нет</option>
                    </select>
                  </td>
                  <td class='col-sm-1' autocomplete="off">
                    <p class="hidden">{{ $answer["moderator"] }}<p>
                    <select class="form-control" name="question_{{ $row["id"] }}_answer_{{ $answer["id"] }}_moderator" autocomplete="off">
                      <option value="accepted" @if($answer["moderator"] == "accepted") selected="selected" @endif>Принят</option>
                      <option value="new" @if($answer["moderator"] == "new") selected="selected" @endif>Новый</option>
                    </select>
                  </td>
                  <td class="col-sm-1 text-center">
                    <input type="checkbox" name="question_{{ $row["id"] }}_answer_{{ $answer["id"] }}_for_delete" autocomplete="off">
                  </td>
                </tr>
              @endforeach
              @endif
              </tbody>
              <tfoot>
                <tr>
                  <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('user', 'Пользователь', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('text', 'Текст ответа', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('date', 'Дата', ['class' => 'col-sm-12']) }}</th>
                  <th>{{ Form::label('is_best', 'Лучший', ['class' => 'col-sm-12']) }}</th>
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

    @foreach($rows as $row)
    <div class="modal fade" id="question_{{ $row["id"] }}_answer_creation_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modalLabel">Добавление нового ответа</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          {{ Form::open(['action' => "AdminLTEController@createModerateQuestions", 'method' => 'post']) }}
          {{ csrf_field() }}
          <div class="modal-body">
            <input type="text" name="answers_question_id" value="{{ $row["id"] }}" class="hidden">
            <div class="form-group">
              <label for="creation_text">Текст ответа</label>
              <textarea type="text" class="form-control" name="creation_text" placeholder="Введите ответ" style="resize: vertical;" rows=6></textarea>
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
var table = $('#modelTable').dataTable({
  initComplete: function () {
    this.api().columns([2]).every( function (i) {
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
  "columnDefs": [{ "orderable": false, "targets": [2, 4, 7] }],
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
  var table = $('#question_' + table_id + '_answers_table').dataTable({
    "bPaginate": true,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
    "bSort": true,
    "columnDefs": [{ "orderable": false, "targets": [2] }],
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

  table.api().columns.adjust();

  $('#question_' + table_id + '_answers_table').on('submit', function(e) {
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