@extends('admin.main')

@section('form')
<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateMoonActions",
                   'method' => 'put',
                   'id' => 'modelForm',
                   'class' => 'form-horizontal',
                   'files' => true]) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table">
      <thead>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('name', 'Название', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('icon_path', 'Изображение', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', 'Загрузить новое изображение', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class='col-sm-1 text-center'>
            {{ $row["id"] }}
          </td>
          <td class='col-sm-5 text-center'>
            <p class="hidden">{{ $row["operation_name"] }}</p>
            <input type="text" class="form-control" name="action_{{ $row["id"] }}_operation_name" value="{{ $row["operation_name"] }}" autocomplete="off">
          </td>
          <td class='col-sm-1' @if($row["icon_path"])style="background-color: #222;"@endif>
            <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$row["icon_path"]);@endphp>
              <img src=@php echo($_ENV['PHOTO_FOLDER'].$row["icon_path"]);@endphp class='col-sm-12' alt='{{ $row["icon_path"] }}'>
            </a>
          </td>
          <td class="col-sm-4">
            <input type="file" name="action_{{ $row["id"] }}_icon_path">
            {{-- {{ Form::file('icon_path_' . $row["id"], ['class' => 'col-sm-12 btn']) }} --}}
          </td>
          <td class="col-sm-1 text-center">
            <input type="checkbox" name="action_{{ $row["id"] }}_for_delete" autocomplete="off">
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('name', 'Название', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('icon_path', 'Изображение', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', 'Загрузить новое изображение', ['class' => 'col-sm-12']) }}</th>
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
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": true,
  "columnDefs": [{ "orderable": false, "targets": [2, 3, 4] }],
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