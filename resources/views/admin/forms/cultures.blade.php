@extends('admin.main')

@section('form')
<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить культуру</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление новой культуры</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createCulture$section", 'method' => 'post', 'files' => true]) }}
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="form-group">
          <label for="creationPhoto">Выбрать фото</label>
          {{ Form::file('creationPhoto') }}
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
          <label for="creationSectionName">Секция</label>
          <input type="text" class="form-control" value="{{ $modelName }}" disabled>
          <input type="text" class="hidden" id="creationSection" name="creationSection" value="{{ $section }}">
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить культуру', ['class' => 'btn btn-primary']) }}
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
            <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
            <th>{{ Form::label('name', 'Название', ['class' => 'col-sm-12']) }}</th>
            <th>{{ Form::label('photo', 'Фото', ['class' => 'col-sm-12']) }}</th>
            {{-- <th>{{ Form::label('', 'Загрузить новое фото', ['class' => 'col-sm-12']) }}</th>
            <th>{{ Form::label('', 'Удалить') }}</th> --}}
            <th>{{ Form::label('', '') }}</th>
            <th>{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class='col-sm-1 text-center'>
            {{ $row->id }}
            {{ Form::text('id_'.$row->id, $row->id, ['class' => 'hidden']) }}
            {{ Form::text('section_id_'.$row->id, $row->section_id, ['class' => 'hidden']) }}
            {{ Form::text('photo_'.$row->id, $row->photo, ['class' => 'hidden']) }}
          </td>
          <td class='col-sm-5'>
            {{ $row->name }}
            {{-- {{ Form::label('name', $row->name, ['class' => 'hidden']) }}
            {{ Form::text('name_'.$row->id, $row->name, ['class' => 'col-sm-12 form-control']) }} --}}
          </td>
          <td class='col-sm-2'>
            <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$row->photo);@endphp>
              <img src=@php echo($_ENV['PHOTO_FOLDER'].$row->photo);@endphp class='col-sm-12' alt='{{ $row->photo }}'>
            </a>
          </td>
          {{-- <td class="col-sm-4">
            {{ Form::label('', '') }}
            {{ Form::file('photo_' . $row->id, ['class' => 'col-sm-12 btn']) }}
          </td>
          <td class="col-sm-1 text-center">
            <input type="checkbox" name="culture_{{ $row->id }}_category_{{ $row->section_id }}_delete" autocomplete="off">
          </td> --}}
          <td class="col-sm-4">
            {{ Form::label('', '') }}
            {{ Form::button('Редактировать', ['id' => "edit_button_".$row->id, 'class' => 'col-sm-12 btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modal_'.$row->id])}}
          </td>
          <td class="col-sm-1 text-center">
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete_culture_{{ $row->id }}" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal fade" id="delete_culture_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">Подтверждение удаления</h4>
                  </div>
                  {{ Form::open(['action' => "AdminLTEController@deleteCulture$section", 'method' => 'delete']) }}
                  {{ csrf_field() }}
                  <input type="text" name="id" value="{{ $row->id }}" class="hidden">
                  <div class="modal-footer">
                    {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
                    {{ Form::submit('Удалить культуру', ['class' => 'btn btn-danger']) }}
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
            <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
            <th>{{ Form::label('name', 'Название', ['class' => 'col-sm-12']) }}</th>
            <th>{{ Form::label('photo', 'Фото', ['class' => 'col-sm-12']) }}</th>
            {{-- <th>{{ Form::label('', 'Загрузить новое фото', ['class' => 'col-sm-12']) }}</th>
            <th>{{ Form::label('', 'Удалить') }}</th> --}}
            <th>{{ Form::label('', '') }}</th>
            <th>{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </tfoot>
    </table>
    {{-- {{ Form::submit('Сохранить изменения', ['class' => 'btn btn-primary', (!count($rows)?'disabled':'')]) }}
    {{ Form::close() }} --}}

    @foreach($rows as $row)
    <div class="modal fade" id="modal_@php echo $row->id @endphp" tabindex="-1" role="dialog" aria-labelledby="modalLabel_{{ $row->id }}" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modalLabel_{{ $row->id }}">{{ $row->name }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          {{ Form::open(['action' => "AdminLTEController@updateCultures$section", 'method' => 'put', 'files' => true]) }}
          {{ csrf_field() }}
          <input type="text" name="id" value="{{ $row->id }}" class="hidden">
          <div class="modal-body">

            <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$row->photo);@endphp>
              <img src=@php echo($_ENV['PHOTO_FOLDER'].$row->photo);@endphp class='col-sm-12' alt='{{ $row->photo }}' style="width: 100%;">
            </a>
            <div class="form-group">
              <label for="culture_photo_{{ $row->id }}">Загрузить новое фото</label>
              {{ Form::file('culture_photo_' . $row->id) }}
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
                    <td class="col-sm-4"></td>
                    <td class="col-sm-4">
                      {{ $filter_attr_value->attribute_value }}
                    </td>
                    <td class="col-sm-4">
                      {{ Form::checkbox('culture_'.$row->id.'_filter_attr_value_'.$filter_attr_value->id) }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @endforeach

              {{-- @if(isset($unique_filter_attributes[$row->id]))
              <h4 class="col-sm-12 text-center">Настройка уникальных параметров фильтрации</h4>
              @foreach($unique_filter_attributes[$row->id] as $name => $unique_filter_attribute)
              <table class="table col-sm-12">
                <thead>
                  <tr>
                    <th class="col-sm-4">{{ $name }}</th>
                    <th class="col-sm-8"></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($unique_filter_attribute as $unique_filter_attr_value)
                  <tr>
                    <td class="col-sm-4"></td>
                    <td class="col-sm-4">
                      {{ $unique_filter_attr_value->attribute_value }}
                    </td>
                    <td class="col-sm-4">
                      {{ Form::checkbox('culture_'.$row->id.'_filter_attr_value_'.$unique_filter_attr_value->id) }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @endforeach
              @endif --}}

            </div>
            <hr>

            <div class="form-group">
              <label for="name_{{ $row->id }}">Название</label>
              <input type="text" class="form-control" id="name_{{ $row->id }}" name="name_{{ $row->id }}" value="{{ $row->name }}" placeholder="Введите название">
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
$(window).ready(function() {
  @if(isset($culture_id))
  var top = document.getElementById("edit_button_{{ $culture_id }}").offsetTop;
  window.scrollTo(0, top);
  @endif
});

var table = $('#modelTable').dataTable({
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": true,
  "columnDefs": [{ "orderable": false, "targets": [2, 3] }],
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


[@foreach($rows as $row) '{{ $row->id }}', @endforeach].forEach(function(row_id) {
  [@foreach($filter_attributes as $filter_attribute)
     @foreach($filter_attr_values[$filter_attribute->name] as $filter_attr_value)
       '{{ $filter_attr_value->id }}',
     @endforeach
   @endforeach].forEach(function(filter_attr_value_id) {
    if($('input[name="culture_'+row_id+'_filter_attr_value_'+filter_attr_value_id+'"]')[0]) {
      $('input[name="culture_'+row_id+'_filter_attr_value_'+filter_attr_value_id+'"]')[0].checked = false;
    }
  });
});

@foreach($filter_attr_entities as $entity_filters_key => $entity_filters_value)
  @foreach($filter_attr_entities[$entity_filters_key] as $key => $value)
    if($('input[name="culture_{{ $entity_filters_key }}_filter_attr_value_{{ $value }}"]')[0]) {
      $('input[name="culture_{{ $entity_filters_key }}_filter_attr_value_{{ $value }}"]')[0].checked = true;
    }
  @endforeach
@endforeach

</script>
@endsection