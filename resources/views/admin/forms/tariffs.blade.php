@extends('admin.main')

@section('form')
<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateTariffs",
                   'method' => 'put',
                   'id' => 'modelForm',
                   'class' => 'form-horizontal']) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table">
      <thead>
        <tr>
            <th class="text-center">{{ Form::label('id', 'id') }}</th>
            <th>{{ Form::label('tariff_name', 'Название тарифа') }}</th>
            <th>{{ Form::label('max_sorts', 'Макс. кол-во сортов') }}</th>
            <th>{{ Form::label('max_chemicals', 'Макс. кол-во химикатов') }}</th>
            <th>{{ Form::label('price', 'Цена') }}</th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class='col-sm-1 text-center'>
            {{ $row->id }}
            {{ Form::text('id_'.$row->id, $row->id, ['class' => 'hidden col-sm-12']) }}
          </td>
          <td class='col-sm-3'>
            {{ Form::label('tariff_name', $row->tariff_name, ['class' => 'hidden']) }}
            {{ Form::text('tariff_name_'.$row->id, $row->tariff_name, ['class' => 'col-sm-12 form-control']) }}
          </td>
          <td class='col-sm-3'>
            {{ Form::label('max_sorts', $row->max_sorts, ['class' => 'hidden']) }}
            <input type="number" min=0 class="form-control" name="max_sorts_{{ $row->id }}" value="{{ $row->max_sorts }}">
          </td>
          <td class='col-sm-3'>
            {{ Form::label('max_chemicals', $row->max_chemicals, ['class' => 'hidden']) }}
            <input type="number" min=0 class="form-control" name="max_chemicals_{{ $row->id }}" value="{{ $row->max_chemicals }}">
          </td>
          <td class='col-sm-2'>
            {{ Form::label('price', $row->price, ['class' => 'hidden']) }}
            <input type="number" step="0.01" min=0 class="form-control" name="price_{{ $row->id }}" value="{{ $row->price }}">
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th class="text-center">{{ Form::label('id', 'id') }}</th>
          <th>{{ Form::label('tariff_name', 'Название тарифа')}}</th>
          <th>{{ Form::label('max_sorts', 'Макс. кол-во сортов') }}</th>
          <th>{{ Form::label('max_chemicals', 'Макс. кол-во химикатов') }}</th>
            <th>{{ Form::label('price', 'Цена') }}</th>
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

$('#modelForm').on('submit', function(e){
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