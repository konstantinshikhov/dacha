@extends('admin.main')

@section('form')
<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить характеристику</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление новой характеристики</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createCharacteristics", 'method' => 'post', 'files' => true]) }}
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
          <label for="creationIconPath">Выбрать изображение характеристики</label>
          {{ Form::file('creationIconPath') }}
        </div>
        <hr>
        <div class="form-group">
          <label for="creationName">Название</label>
          <input type="text" class="form-control" id="creationName" name="creationName" placeholder="Введите название">
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить характеристику', ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateCharacteristics",
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
            {{ $row->id }}
            {{ Form::text('id_'.$row->id, $row->id, ['class' => 'hidden']) }}
            {{ Form::text('icon_path_'.$row->id, $row->icon_path, ['class' => 'hidden']) }}
          </td>
          <td class='col-sm-5 text-center'>
            {{ Form::label('name', $row->name, ['class' => 'hidden']) }}
            {{ Form::text('name_'.$row->id, $row->name, ['class' => 'col-sm-12 form-control']) }}
          </td>
{{--          <td class='col-sm-1'>--}}
{{--            <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$row->icon_path);@endphp>--}}
{{--              <img src=@php echo($_ENV['PHOTO_FOLDER'].$row->icon_path);@endphp class='col-sm-12' alt='{{ $row->icon_path }}'>--}}
{{--            </a>--}}
{{--          </td>--}}
          <td class="col-sm-4">
            {{ Form::label('', '') }}
            {{ Form::file('icon_path_' . $row->id, ['class' => 'col-sm-12 btn']) }}
          </td>
          <td class="col-sm-1 text-center">
            <input type="checkbox" name="characteristic_{{ $row->id }}_delete" autocomplete="off">
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