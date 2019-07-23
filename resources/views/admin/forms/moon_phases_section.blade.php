@extends('admin.main')

@section('form')
<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateMoonPhases$section", 'method' => 'put']) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table display nowrap">
      <thead>
        <tr>
          <th rowspan="2">Культуры по морфологическому признаку</th>
          <th colspan="4" class="text-center">Водные знаки</th>
          <th colspan="4" class="text-center">Земляные знаки</th>
          <th colspan="4" class="text-center">Огненные знаки</th>
          <th colspan="4" class="text-center">Воздушные знаки</th>
        </tr>
        <tr>
          @foreach([1, 2, 3, 4] as $i)
          @foreach(['Полнолуние', 'Растущая луна', 'Убывающая луна', 'Новолуние'] as $phase)
          <th>{{ $phase }}</th>
          @endforeach
          @endforeach
        </tr>
      </thead>
      <tbody>
      @if(isset($filtered_plants))
      @foreach($filtered_plants as $plant)
        <tr>
          <td>{{ $plant["attribute_value"] }}</td>
          @foreach(['water' => 'Вода', 'earth' => 'Земля', 'fire' => 'Огонь', 'air' => 'Воздух'] as $element => $translatedElement)
          @foreach(['full' => 'Полнолуние', 'growing' => 'Растущая луна', 'waning' => 'Убывающая луна', 'new' => 'Новолуние'] as $phase => $translatedPhase)
          <td>
            <select class="form-control select2 good-operations" multiple="multiple" data-placeholder="Благоприятно" style="width: 100%;"
                    name="plant_{{ $plant["id"] }}_{{ $element }}_{{ $phase }}_moon_good_operations[]" autocomplete="off"
                    title="Благоприятно для '{{ $plant["attribute_value"] }}' ({{ $translatedElement }}: {{ $translatedPhase }})">
              @foreach($operations as $operation)
              <option value="{{ $operation["id"] }}"
                      @if(in_array($operation["id"], $plant_operations["plant_{$plant["id"]}_{$element}_{$phase}_moon_good_operations"]??[]))
                        selected="selected" 
                      @endif
              >{{ $operation["operation_name"] }}</option>
              @endforeach
            </select>
            <br/>
            <select class="form-control select2 bad-operations" multiple="multiple" data-placeholder="Неблагоприятно" style="width: 100%;"
                    name="plant_{{ $plant["id"] }}_{{ $element }}_{{ $phase }}_moon_bad_operations[]" autocomplete="off"
                    title="Неблагоприятно для '{{ $plant["attribute_value"] }}' ({{ $translatedElement }}: {{ $translatedPhase }})">
              @foreach($operations as $operation)
              <option value="{{ $operation["id"] }}"
                      @if(in_array($operation["id"], $plant_operations["plant_{$plant["id"]}_{$element}_{$phase}_moon_bad_operations"]??[]))
                      selected="selected"
                      @endif
              >{{ $operation["operation_name"] }}</option>
              @endforeach
            </select>
          </td>
          @endforeach
          @endforeach
        </tr>
      @endforeach
      @endif
      </tbody>
    </table>
    {{ Form::submit('Сохранить изменения', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
  </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">
$('.select2').select2();

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
</script>
@endsection