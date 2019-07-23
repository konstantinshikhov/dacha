@extends('admin.main')

@section('form')
<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateFeedback",
                   'method' => 'put',
                   'id' => 'modelForm',
                   'class' => 'form-horizontal']) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table">
      <thead>
        <tr>
            <th class="text-center">{{ Form::label('id', 'id') }}</th>
            <th>{{ Form::label('email', 'Адрес электронной почты') }}</th>
            <th>{{ Form::label('text', 'Сообщение') }}</th>
            <th>{{ Form::label('type', 'Тип') }}</th>
            <th>{{ Form::label('created_at', 'Дата отправки') }}</th>
            <th>{{ Form::label('is_read', 'Прочитано') }}</th>
            <th><label for="deleteAll">Удалить все</label><input type="checkbox" id="deleteAll" style="position: relative; top:3px; margin-left: 9px;"></th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class='col-sm-1 text-center'>
            {{ $row->id }}
          </td>
          <td class='col-sm-2'>
            {{ $row->email }}
          </td>
          <td class='col-sm-3'>
            {{ $row->text }}
          </td>
          <td class='col-sm-2'>
            {{ $typesDictionary[$row->type] }}
          </td>
          <td class='col-sm-2'>
            {{ $row->created_at }}
          </td>
          <td class='col-sm-1'>
            <label class="hidden">{{ $row["is_read"] }}</label>
            <select class="form-control" name="feedback_{{ $row["id"] }}_is_read" autocomplete="off">
              <option @if($row["is_read"] == 0) selected="selected" @endif value="0">Нет</option>
              <option @if($row["is_read"] == 1) selected="selected" @endif value="1">Да</option>
            </select>
          </td>
          <td class='col-sm-1'>
            <input class="forDelete" type="checkbox" name="feedback_{{ $row["id"] }}_for_delete" autocomplete="off">
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th class="text-center">{{ Form::label('id', 'id') }}</th>
          <th>{{ Form::label('email', 'Адрес электронной почты') }}</th>
          <th>{{ Form::label('text', 'Сообщение') }}</th>
          <th>{{ Form::label('type', 'Тип') }}</th>
          <th>{{ Form::label('created_at', 'Дата отправки') }}</th>
          <th>{{ Form::label('is_read', 'Прочитано') }}</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
    {{ Form::submit('Сохранить изменения', ['class' => 'btn btn-primary', (!count($rows)?'disabled':'')]) }}
    {{ Form::close() }}
  </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">
deleteAll.onchange = function() {
  document.querySelectorAll(".forDelete").forEach(function(checkbox) {
    if(deleteAll[0] === undefined) {
      checkbox.checked = deleteAll.checked ? true : false;
    } else {
      checkbox.checked = deleteAll[0].checked ? true : false;
    }
  });
}

var table = $('#modelTable').dataTable({
  initComplete: function () {
    this.api().columns([3]).every( function (i) {
      var column = this;
      var select = $('<select class="form-control"><option selected="selected" value="">Тип</option></select>')
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
  "order": [[4, "desc"], [5, "asc"]],
  "columnDefs": [{ "orderable": false, "targets": [3, 6] }],
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