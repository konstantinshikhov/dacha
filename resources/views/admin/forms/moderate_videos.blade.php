@extends('admin.main')

@section('form')
<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateModerateVideos",
                   'method' => 'put',
                   'id' => 'modelForm',
                   'class' => 'form-horizontal']) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table">
      <thead>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('handbook', 'Название справки', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('title', 'Название видео', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('link', 'Ссылка', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('user', 'Пользователь', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('moderator', 'Статус', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($rows as $row)
        <tr>
          <td class='col-sm-1 text-center'>
            {{ $row["id"] }}
          </td>
          <td class='col-sm-2 text-center'>
            {{ $row["handbook"]["title"] }}
          </td>
          <td class='col-sm-2 text-center'>
            <p class="hidden">{{ $row["title"] }}</p>
            <input type="text" class="form-control" name="title_{{ $row["id"] }}" value="{{ $row["title"] }}" autocomplete="off">
          </td>
          <td class='col-sm-3 text-center'>
            <a target="_blank" href="{{ $row["link"] }}">{{ $row["title"] }}</a>
          </td>
          <td class='col-sm-1 text-center'>
            {{ $row["user"]["email"] }}
          </td>
          <td class='col-sm-2' autocomplete="off">
            <p class="hidden">{{ $row["moderator"] }}<p>
            <select class="form-control" id="moderator_{{ $row["id"] }}" name="moderator_{{ $row["id"] }}" autocomplete="off">
              <option value="accepted" @if($row["moderator"] == "accepted") selected="selected" @endif>Принято</option>
              <option value="new" @if($row["moderator"] == "new") selected="selected" @endif>Новое</option>
            </select>
          </td>
          <td class="col-sm-1 text-center">
            <input type="checkbox" name="video_{{ $row["id"] }}_for_delete" autocomplete="off">
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('handbook', 'Название справки', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('title', 'Название видео', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('link', 'Ссылка', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('user', 'Пользователь', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('moderator', 'Статус', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', 'Удалить') }}</th>
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

var table = $('#modelTable').dataTable({
  // initComplete: function () {
  //   this.api().columns([3]).every( function (i) {
  //     var column = this;

  //     if(column.header().attributes[4].name == 'style') {
  //       var header = column.header().attributes[3].nodeValue;
  //     } else {
  //       var header = column.header().attributes[4].nodeValue;
  //     }

  //     var select = $('<select class="form-control"><option selected="selected" value="">' + header + '</option></select>')
  //       .appendTo( $(column.header()).empty() )
  //       .on( 'change', function () {
  //         var val = $.fn.dataTable.util.escapeRegex(
  //           $(this).val()
  //         );

  //         column
  //           .search( val ? '^'+val+'$' : '', true, false )
  //           .draw();
  //       });

  //       column.data().unique().sort().each( function ( d, j ) {
  //         if(column.search() === '^'+d+'$'){
  //           select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
  //         } else {
  //           select.append( '<option value="'+d+'">'+d+'</option>' )
  //         }
  //       });
  //   });
  // },
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