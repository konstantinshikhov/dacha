@extends('admin.main')

@section('form')
<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить категорию</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление новой категории</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createCategories", 'method' => 'post']) }}
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
          <label for="creationType">Тип</label>
          <select class="form-control" name="creationType">
            @foreach($types as $type => $translatedType)
            <option value="{{ $type }}">{{ $translatedType }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="creationCategory">Название</label>
          <input type="text" class="form-control" id="creationCategory" name="creationCategory" placeholder="Введите название">
        </div>
        <div class="form-group">
          <label for="creationCategory">Xарактеристика</label>
          <input type="text" class="form-control" id="creationCategoryFeature" name="creationCategoryFeature" placeholder="Введите характеристику">
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить категорию', ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateCategories",
                   'method' => 'put',
                   'id' => 'modelForm',
                   'class' => 'form-horizontal']) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table">
      <thead>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('type', 'Тип', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('category', 'Название', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('feature', 'Xарактеристика', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class="col-sm-1 text-center">
            {{ $row["id"] }}
          </td>
          <td class='col-sm-3' autocomplete="off">
            <p class="hidden">{{ $row["type"] }}<p>
            <select class="form-control" name="category_{{ $row["id"] }}_type" autocomplete="off">
              @foreach($types as $type => $translatedType)
              <option value="{{ $type }}" @if($row["type"] == $type) selected="selected" @endif>{{ $translatedType }}</option>
              @endforeach
            </select>
          </td>
          <td class="col-sm-3 text-center">
            <p class="hidden">{{ $row["category"] }}</p>
            <input class="col-sm-6 form-control" type="text" name="category_{{ $row["id"] }}_category" value="{{ $row["category"] }}" autocomplete="off">
          </td>
          <td class="col-sm-3 text-center">
            <p class="hidden">{{ $row["feature"] }}</p>
            <input class="col-sm-6 form-control" type="text" name="feature_{{ $row["id"] }}_category" value="{{ $row["feature"] }}" autocomplete="off">
          </td>
          <td class="col-sm-1 text-center">
            <input type="checkbox" name="category_{{ $row["id"] }}_for_delete" autocomplete="off">
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('type', 'Тип', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('category', 'Название', ['class' => 'col-sm-12']) }}</th>
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
  "columnDefs": [{ "orderable": false, "targets": [1, 3] }],
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