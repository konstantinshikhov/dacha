@extends('admin.main')

@section('form')

<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить вредителя</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление нового вредителя</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createPests$section", 'method' => 'post', 'files' => true]) }}
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
          <label for="creationPhotos[]">Выбрать фото</label>
          {{ Form::file('creationPhotos[]', ['multiple' => true, 'id' => 'creationPhotos[]']) }}
        </div>
        <hr>
        <div class="form-group">
          <h4 class="col-sm-12 text-center">Настройка параметров фильтрации</h4>
          @foreach($filter_attributes as $filter_attribute)
          <table class="table col-sm-12">
            <thead>
              <tr>
                <th class="col-sm-4">{{ $filter_attribute->name }}</th>
                <th class="col-sm-8"></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($filter_attr_values[$filter_attribute->name] as $filter_attr_value)
              <tr>
                <td class="col-sm-4">
                </td>
                <td class="col-sm-4">
                  {{ $filter_attr_value->attribute_value }}
                </td>
                <td class="col-sm-4">
                  {{ Form::checkbox('filter_attr_value_'.$filter_attr_value->id) }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endforeach
        </div>
        <hr>

        <div class="form-group">
          <label for="creationName">Название</label>
          <input type="text" class="form-control" id="creationName" name="creationName" placeholder="Введите название">
        </div>

        <div class="form-group">
          <label for="creationCultures">Культуры</label>
          <select class="form-control select2" multiple="multiple" data-placeholder="Выберите культуры"
                  style="width: 100%;" name="creationCultures[]" id="creationCultures" autocomplete="off">
            @foreach($cultures as $cultureId => $cultureName)
            <option value="{{ $cultureId }}">{{ $cultureName }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="creationSorts">Сорта</label>
          <select class="form-control select2" multiple="multiple" data-placeholder="Выберите сорта"
                  style="width: 100%;" name="creationSorts[]" id="creationSorts" autocomplete="off">
            @foreach($sorts as $sort)
            <option value="{{ $sort->id }}">{{ $sort->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="creationChemicals">Препараты для борьбы c вредителем</label>
          <select class="form-control select2" multiple="multiple" data-placeholder="Выберите химикаты"
                  style="width: 100%;" name="creationChemicals[]" id="creationChemicals" autocomplete="off">
            @foreach($chemicals as $chemical)
            <option value="{{ $chemical->id }}">{{ $chemical->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="creationDescription">Описание</label>
          <textarea class="form-control description" id="creationDescription" name="creationDescription" placeholder="Введите описание" autocomplete="off" rows=12></textarea>
        </div>

        <div class="form-group">
          <label for="creationFight">Меры защиты</label>
          <textarea class="form-control description" id="creationFight" name="creationFight" placeholder="Введите меры защиты" autocomplete="off" rows=12></textarea>
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить вредителя', ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="box">
  <div class="box-body">
    <table id="modelTable" class="table">
      <thead>
        <tr>
          <th class="text-center">{{ Form::label('id', 'id') }}</th>
          <th>{{ Form::label('name', 'Название') }}</th>
          {{-- <th>{{ Form::label('culture_id', 'Культура') }}</th> --}}
          <th class="text-center">{{ Form::label('main_photo', 'Фото') }}</th>
          <th>{{ Form::label('', '') }}</th>
          <th class="text-center">{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class="col-sm-1 text-center">
            {{ $row->id }}
          </td>
          <td class="col-sm-5">
            {{ $row->name }}
          </td>
          {{-- <td class="col-sm-3">
            @if ( ! empty($cultures[$row->culture_id]) ) {{ $cultures[$row->culture_id] }} @endif
          </td> --}}
          <td class="col-sm-2">
            <img src="{{ $_ENV['PHOTO_FOLDER'].$row->main_photo }}" class="col-sm-12" alt="{{ $row->main_photo }}">
          </td>
          <td class="col-sm-3">
            {{ Form::label('', '') }}
            {{ Form::button('Редактировать', ['id' => "edit_button_".$row->id, 'class' => 'col-sm-12 btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modal_'.$row->id])}}
          </td>
          <td class="col-sm-1 text-center">
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete_pest_{{ $row->id }}" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal fade" id="delete_pest_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">Подтверждение удаления</h4>
                  </div>
                  {{ Form::open(['action' => "AdminLTEController@deletePests$section", 'method' => 'delete']) }}
                  {{ csrf_field() }}
                  <input type="text" name="id" value="{{ $row->id }}" class="hidden">
                  <div class="modal-footer">
                    {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
                    {{ Form::submit('Удалить вредителя', ['class' => 'btn btn-danger']) }}
                  </div>
                  {{ Form::close() }}
                </div>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th class="text-center">{{ Form::label('id', 'id') }}</th>
          <th>{{ Form::label('name', 'Название') }}</th>
          {{-- <th>{{ Form::label('culture_id', 'Культура') }}</th> --}}
          <th class="text-center">{{ Form::label('main_photo', 'Фото') }}</th>
          <th>{{ Form::label('', '') }}</th>
          <th class="text-center">{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </tfoot>
    </table>

    @foreach($rows as $row)
    <div class="modal fade" id="modal_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel_{{ $row->id }}" aria-hidden="true" style="overflow-y: scroll;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modalLabel_{{ $row->id }}">{{ $row->name }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          {{ Form::open(['action' => "AdminLTEController@updatePests$section", 'method' => 'put', 'files' => true]) }}
          {{ csrf_field() }}
          <input type="text" name="id" value="{{ $row->id }}" class="hidden">
          <div class="modal-body">

            <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$row->main_photo);@endphp>
              <img src=@php echo($_ENV['PHOTO_FOLDER'].$row->main_photo);@endphp class='col-sm-12' alt='{{ $row->main_photo }}' style="width: 100%;">
            </a>

            <table class="table form-group col-sm-12">
              <thead>
                <tr>
                  <th scope="col">Фото</th>
                  <th scope="col">Главное</th>
                  <th scope="col">Удалить</th>
                </tr>
              </thead>
              <tbody>
              @foreach($pests_photos[$row->id] as $pests_photo)
                <tr>
                  <td class="col-sm-4">
                    <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$pests_photo);@endphp>
                      <img src=@php echo($_ENV['PHOTO_FOLDER'].$pests_photo);@endphp alt="{{ $pests_photo }}" class="image col-sm-12" >
                    </a>
                  </td>
                  <td class="col-sm-4">
                    <label for="is_main_{{ $pests_photo }}" class="hidden"></label>
                    {{ Form::radio('is_main', $pests_photo, $pests_photo==$row->main_photo?true:false) }}
                  </td>
                  <td class="col-sm-4">
                    {{ Form::checkbox('for_delete_'.$pests_photo) }}
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <div class="form-group">
              <label for="pests_photos_{{ $row->id }}">Загрузить новые фото</label>
              {{ Form::file('pests_photos_' . $row->id . '[]', ['multiple' => 'multiple']) }}
            </div>
            <hr>

            <div class="form-group">
              <h4 class="col-sm-12 text-center">Настройка параметров фильтрации</h4>
              @foreach($filter_attributes as $filter_attribute)
              <table class="table col-sm-12">
                <thead>
                  <tr>
                    <th class="col-sm-4">{{ $filter_attribute->name }}</th>
                    <th class="col-sm-8"></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($filter_attr_values[$filter_attribute->name] as $filter_attr_value)
                  <tr>
                    <td class="col-sm-4">
                    </td>
                    <td class="col-sm-4">
                      {{ $filter_attr_value->attribute_value }}
                    </td>
                    <td class="col-sm-4">
                      {{ Form::checkbox('pest_'.$row->id.'_filter_attr_value_'.$filter_attr_value->id) }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @endforeach
            </div>
            <hr>

            <div class="form-group">
              <label for="name_{{ $row->id }}">Название</label>
              <input type="text" class="form-control" id="name_{{ $row->id }}" name="name_{{ $row->id }}" value="{{ $row->name }}" placeholder="Введите название">
            </div>

            <div class="form-group">
              <label for="pest_cultures">Культуры</label>
              <select class="form-control select2" multiple="multiple" data-placeholder="Выберите культуры"
                      style="width: 100%;" name="pest_cultures[]" id="pest_cultures" autocomplete="off">
                @foreach($cultures as $cultureId => $cultureName)
                <option value="{{ $cultureId }}" @if(isset($pest_cultures[$row->id]) && in_array($cultureId, $pest_cultures[$row->id])) selected="selected" @endif>{{ $cultureName }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="pest_sorts">Сорта</label>
              <select class="form-control select2" multiple="multiple" data-placeholder="Выберите сорта"
                      style="width: 100%;" name="pest_sorts[]" id="pest_sorts" autocomplete="off">
                @foreach($sorts as $sort)
                <option value="{{ $sort->id }}" @if(isset($pest_sorts[$row->id]) && in_array($sort->id, $pest_sorts[$row->id])) selected="selected" @endif>{{ $sort->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="pest_chemicals">Препараты для борьбы с вредителем</label>
              <select class="form-control select2" multiple="multiple" data-placeholder="Выберите химикаты"
                      style="width: 100%;" name="pest_chemicals[]" id="pest_chemicals" autocomplete="off">
                @foreach($chemicals as $chemical)
                <option value="{{ $chemical->id }}" @if(isset($pest_chemicals[$row->id]) && in_array($chemical->id, $pest_chemicals[$row->id])) selected="selected" @endif>{{ $chemical->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="description_{{ $row->id }}">Описание</label>
              <textarea class="form-control description" id="description_{{ $row->id }}" name="description_{{ $row->id }}" placeholder="Введите описание" autocomplete="off" rows=12>{{ $row->description }}</textarea>
            </div>

            <div class="form-group">
              <label for="fight_{{ $row->id }}">Меры защиты</label>
              <textarea class="form-control description" id="fight_{{ $row->id }}" name="fight_{{ $row->id }}" placeholder="Введите меры защиты" autocomplete="off" rows=12>{{ $row->fight }}</textarea>
            </div>
            
          </div>
          <div class="modal-footer">
            {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
            {{ Form::submit('Сохранить изменения', ['class' => 'btn btn-primary']) }}
          </div>
          {{ Form::close() }}

        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">

$('.description').wysihtml5();

$(window).ready(function() {
  @if(isset($pest_id))
  var top = document.getElementById("edit_button_{{ $pest_id }}").offsetTop;
  window.scrollTo(0, top);
  @endif
});

$('.select2').select2();

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



[@foreach($rows as $row) '{{ $row->id }}', @endforeach].forEach(function(row_id) {
  [@foreach($filter_attributes as $filter_attribute)
     @foreach($filter_attr_values[$filter_attribute->name] as $filter_attr_value)
       '{{ $filter_attr_value->id }}',
     @endforeach
   @endforeach].forEach(function(filter_attr_value_id) {
    $('input[name="pest_'+row_id+'_filter_attr_value_'+filter_attr_value_id+'"]')[0].checked = false;
  });
});

@foreach($filter_attr_entities as $entity_filters_key => $entity_filters_value)
  @foreach($filter_attr_entities[$entity_filters_key] as $key => $value)
    $('input[name="pest_{{ $entity_filters_key }}_filter_attr_value_{{ $value }}"]')[0].checked = true;
  @endforeach
@endforeach

</script>
@endsection