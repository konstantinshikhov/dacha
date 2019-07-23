@extends('admin.main')

@section('form')
<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить новый метод доставки</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление нового метода доставки</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createDeliveryMethods", 'method' => 'post']) }}
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
          <label for="creationName">Название</label>
          <input type="text" class="form-control" id="creationName" name="creationName" placeholder="Введите название">
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить метод доставки', ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateDeliveryMethods",
                   'method' => 'put',
                   'id' => 'modelForm',
                   'class' => 'form-horizontal']) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table">
      <thead>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('name', 'Название', ['class' => 'col-sm-12']) }}</th>
          <th class="text-center">{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class='col-sm-1 text-center'>
            {{ $row->id }}
          </td>
          <td class='col-sm-9 text-center'>
            <p class="hidden">{{ $row["name"] }}</p>
            <input type="text" class="form-control" name="delivery_method_{{ $row["id"] }}_name" value="{{ $row["name"] }}" autocomplete="off">
          </td>
          <td class="col-sm-2 text-center">
            <input type="checkbox" name="delivery_method_{{ $row["id"] }}_for_delete" autocomplete="off">
          </td>
        </tr>
      @endforeach
      </tbody>
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
  "columnDefs": [{ "orderable": false, "targets": [2] }],
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