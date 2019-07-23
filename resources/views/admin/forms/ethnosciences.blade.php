@extends('admin.main')

@section('form')
<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить примету</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление новой приметы</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createEthnosciences", 'method' => 'post']) }}
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
          <label for="creationTitle">Название</label>
          <input type="text" class="form-control" id="creationTitle" name="creationTitle" placeholder="Введите название">
        </div>
        <div class="form-group">
          <label for="creationDescription">Описание</label>
          <textarea class="form-control" id="creationDescription" name="creationDescription" placeholder="Введите описание" rows=6 style="resize: vertical;"></textarea>
        </div>
        <div class="form-group">
          <label for="creationStartDay">День начала</label>
          <input type="number" min=1 max=31 value=1 class="form-control" id="creationStartDay" name="creationStartDay">
        </div>
        <div class="form-group">
          <label for="creationStartMonth">Месяц начала</label>
          <input type="number" min=1 max=12 value=1 class="form-control" id="creationStartMonth" name="creationStartMonth">
        </div>
        <div class="form-group">
          <label for="creationEndDay">День окончания</label>
          <input type="number" min=1 max=31 value=1 class="form-control" id="creationEndDay" name="creationEndDay">
        </div>
        <div class="form-group">
          <label for="creationEndMonth">Месяц окончания</label>
          <input type="number" min=1 max=12 value=1 class="form-control" id="creationEndMonth" name="creationEndMonth">
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить примету', ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateEthnosciences", 'method' => 'put', 'id' => 'modelForm', 'class' => 'form-horizontal']) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table">
      <thead>
        <th class="text-center"><label>id</label></th>
        <th><label>Название</label></th>
        <th><label>Описание</label></th>
        <th><label>День начала</label></th>
        <th><label>Месяц начала</label></th>
        <th><label>День окончания</label></th>
        <th><label>Месяц окончания</label></th>
        <th><label>Удалить</label></th>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class="col-sm-1 text-center">
            {{ $row["id"] }}
          </td>
          <td class="col-sm-3">
            <label class="hidden">{{ $row["title"] }}</label>
            <input type="text" class="form-control" name="ethnoscience_{{ $row["id"] }}_title" value="{{ $row["title"] }}" autocomplete="off">
          </td>
          <td class="col-sm-3">
            <textarea class="form-control" name="ethnoscience_{{ $row["id"] }}_description" autocomplete="off" style="resize: vertical;" rows=6>{{ $row["description"] }}</textarea>
          </td>
          <td class="col-sm-1">
            <label class="hidden">{{ $row["start_day"] }}</label>
            <input type="number" class="form-control" min=1 max=31 name="ethnoscience_{{ $row["id"] }}_start_day" value="{{ $row["start_day"] }}" autocomplete="off">
          </td>
          <td class="col-sm-1">
            <label class="hidden">{{ $row["start_month"] }}</label>
            <input type="number" class="form-control" min=1 max=12 name="ethnoscience_{{ $row["id"] }}_start_month" value="{{ $row["start_month"] }}" autocomplete="off">
          </td>
          <td class="col-sm-1">
            <label class="hidden">{{ $row["end_day"] }}</label>
            <input type="number" class="form-control" min=1 max=31 name="ethnoscience_{{ $row["id"] }}_end_day" value="{{ $row["end_day"] }}" autocomplete="off">
          </td>
          <td class="col-sm-1">
            <label class="hidden">{{ $row["end_month"] }}</label>
            <input type="number" class="form-control" min=1 max=12 name="ethnoscience_{{ $row["id"] }}_end_month" value="{{ $row["end_month"] }}" autocomplete="off">
          </td>
          <td class="col-sm-1 text-center">
            <input type="checkbox" name="ethnoscience_{{ $row["id"] }}_for_delete" autocomplete="off">
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <th class="text-center"><label>id</label></th>
        <th><label>Название</label></th>
        <th><label>Описание</label></th>
        <th><label>День начала</label></th>
        <th><label>Месяц начала</label></th>
        <th><label>День окончания</label></th>
        <th><label>Месяц окончания</label></th>
        <th><label>Удалить</label></th>
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
  
$('.description').wysihtml5();

var table = $('#modelTable').dataTable({
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": true,
  "columnDefs": [{ "orderable": false, "targets": [7] }],
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
</script>
@endsection