@extends('admin.main')

@section('form')
<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить лунную фазу</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление новой лунной фазы</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createMoonPhases", 'method' => 'post', 'files' => true]) }}
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
          <label for="creationIcon">Выбрать изображение</label>
          {{ Form::file('creationIcon') }}
        </div>
        <hr>
        <div class="form-group">
          <label for="creationTitle">Название фазы</label>
          <input type="text" class="form-control" id="creationTitle" name="creationTitle" placeholder="Введите название">
        </div>
        <div class="form-group">
          <label for="creationPhaseType">Тип фазы</label>
          <select class="form-control" id="creationPhaseType" name="creationPhaseType">
            <option value="полнолуние">полнолуние</option>
            <option value="новолуние">новолуние</option>
            <option value="растущая">растущая</option>
            <option value="убывающая">убывающая</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить фазу', ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="box">
  <div class="box-body">

    {{ Form::open(['id' => 'modelForm', 'action' => "AdminLTEController@updateMoonPhases", 'method' => 'put', 'files' => true]) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table">
      <thead>
        <tr>
          <th></th>
          <th>Загрузить новое изображение</th>
          <th>Фаза</th>
          <th>Тип</th>
          <th>Удалить</th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class="col-sm-1" style="background-color: #222;">
            <a target="_blank" href="@php echo($_ENV['PHOTO_FOLDER'].$row['icon']);@endphp">
              <img src=@php echo($_ENV['PHOTO_FOLDER'].$row['icon']);@endphp alt="{{ $row["icon"] }}" class="image col-sm-12">
            </a>
          </td>
          <td class="col-sm-4">
            <input type="file" name="moon_phase_{{ $row["id"] }}_new_icon">
          </td>
          <td class="col-sm-2">
            <input type="text" class="form-control" name="moon_phase_{{ $row["id"] }}_title" value="{{ $row["title"] }}" autocomplete="off">
          </td>
          <td class="col-sm-5">
            <select class="form-control" name="moon_phase_{{ $row["id"] }}_phase_type" style="width: 100%;" autocomplete="off">
              <option value="полнолуние" @if($row["phase_type"] == 'полнолуние') selected="selected" @endif>полнолуние</option>
              <option value="новолуние" @if($row["phase_type"] == 'новолуние') selected="selected" @endif>новолуние</option>
              <option value="растущая" @if($row["phase_type"] == 'растущая') selected="selected" @endif>растущая</option>
              <option value="убывающая" @if($row["phase_type"] == 'убывающая') selected="selected" @endif>убывающая</option>
            </select>
          </td>
          <td class="col-sm-2 text-center">
            <input type="checkbox" name="moon_phase_{{ $row["id"] }}_for_delete" autocomplete="off">
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th></th>
          <th>Загрузить новое изображение</th>
          <th>Фаза</th>
          <th>Тип</th>
          <th></th>
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
var table = $('#modelTable').dataTable({
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": false,
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