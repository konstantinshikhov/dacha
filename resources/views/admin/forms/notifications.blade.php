@extends('admin.main')

@section('form')
<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal" id="openCreationModal">Рассылка уведомлений</button>
<div class="modal" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Рассылка уведомлений</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createNotifications", 'method' => 'post']) }}
      {{ csrf_field() }}
      <div class="modal-body">

        <div class="form-group">
          <table id="all_users_table" class="table">
            <thead>
              <tr>
                <th><label>Почта</label></th>
                <th><label>Пользователь</label></th>
                <th><label for="all_users">Выбрать всех</label><input type="checkbox" id="all_users" style="position: relative; top:3px; margin-left: 9px;" autocomplete="off"></th>
              </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr>
                <td class='col-sm-6'>
                  {{ $user["email"] }}
                </td>
                <td class='col-sm-3'>
                  {{ $user["first_name"] }} {{ $user["last_name"] }}
                </td>
                <td class='col-sm-3 text-center'>
                  <input class="notification_for_user" type="checkbox" name="notification_for_user_{{ $user["id"] }}" autocomplete="off">
                </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th><label>Почта</label></th>
                <th><label>Пользователь</label></th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>

        <div class="form-group">
          <div class="input-group">
            <label class="btn input-group-addon" for="createNotificationForEmail">
              Отправить на почту
              <input type="checkbox" class="hidden" id="createNotificationForEmail" name="createNotificationForEmail" autocomplete="off">
            </label>
            <label class="btn input-group-addon" for="createNotificationForSite">
              Отправить на сайт
              <input type="checkbox" class="hidden" id="createNotificationForSite" name="createNotificationForSite" autocomplete="off">
            </label>
          </div>
        </div>

        <div class="form-group">
          <label for="creationTopic">Тема</label>
          <input type="text" class="form-control" id="creationTopic" name="creationTopic">
        </div>

        <div class="form-group">
          <label for="creationText">Текст</label>
          <textarea class="form-control description" id="creationText" name="creationText" autocomplete="off" rows=6></textarea>
        </div>

      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Отправить уведомление', ['class' => 'btn btn-primary']) }}
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
          <th>{{ Form::label('from', 'Отправитель', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('to', 'Получатель', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('type', 'Тип уведомления', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('text', 'Содержание', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('topic', 'Тема', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('item_id', 'Сорт/Химикат', ['class' => 'col-sm-12']) }}</th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class='col-sm-1 text-center'>
            {{ $row["id"] }}
          </td>
          <td class='col-sm-1'>
            {{ isset($row["from"]["email"]) ? $row["from"]["email"] : 'Администратор' }}
          </td>
          <td class='col-sm-1'>
            {{ isset($row["to"]["email"]) ? $row["to"]["email"] : 'Отсутствует' }}
          </td>
          <td class='col-sm-2'>
            {{ $notification_type_dictionary[$row["type"]] }}
          </td>
          <td class='col-sm-4'>
            {{ $row["text"] }}
          </td>
          <td class='col-sm-2'>
            {{ $row["topic"] }}
          </td>
          <td class='col-sm-1'>
            {{ $row["item_id"] ? $row["item_id"]["name"] ." (".$row["item_type"].")" : '' }}
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('from', 'Отправитель', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('to', 'Получатель', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('type', 'Тип уведомления', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('text', 'Содержание', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('topic', 'Тема', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('item_id', 'Сорт/Химикат', ['class' => 'col-sm-12']) }}</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">

$('.description').wysihtml5();

['createNotificationForEmail', 'createNotificationForSite'].forEach(function(option) {
  $('#' + option).on('change', function() {
    if(this.checked) {
      $('label[for="' + option + '"]').css({'background-color': '#3c8dbc', 'color': '#fff'});
    } else {
      $('label[for="' + option + '"]').css({'background-color': '#fff', 'color': '#555'});
    }
  });
});

all_users.onchange = function() {
  document.querySelectorAll(".notification_for_user").forEach(function(checkbox) {
    if(all_users[0] === undefined) {
      checkbox.checked = all_users.checked ? true : false;
    } else {
      checkbox.checked = all_users[0].checked ? true : false;
    }
  });
}

var all_users_table_var = $('#all_users_table').dataTable({
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": true,
  "columnDefs": [{ "orderable": false, "targets": [2] }],
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

$("#creationModal").on('shown.bs.modal', function() {
  all_users_table_var.api().columns.adjust();
});



$('.select2').select2();

var table = $('#modelTable').dataTable({
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": true,
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

  // Encode a set of form elements from all pages as an array of names and values
  var params = all_users_table_var.$('input,select,textarea').serializeArray();

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