@extends('admin.main')

@section('form')

<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить химикат</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление нового химиката</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createChemical", 'method' => 'post', 'files' => true]) }}
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
          <h4 class="col-sm-12 text-center">Настройка категорий</h4>
          <table class="table col-sm-12">
            <thead>
              <tr>
                <th class="col-sm-4"></th>
                <th class="col-sm-8"></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($categories as $categoryId => $category)
              <tr>
                <td class="col-sm-4"></td>
                <td class="col-sm-4">
                  {{ $category }}
                </td>
                <td class="col-sm-4">
                  <input type="checkbox" name="creation_category_{{ $categoryId }}" autocomplete="off">
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <hr>
        <div class="form-group">
          <label for="creationName">Название</label>
          <input type="text" class="form-control" id="creationName" name="creationName" placeholder="Введите название">
        </div>
        <div class="form-group">
          <label for="creationManufacturer">Производитель</label>
          <input type="text" class="form-control" id="creationManufacturer" name="creationManufacturer" placeholder="Введите производителя">
        </div>
        <div class="form-group">
          <label for="creationManufacturerSite">Сайт производителя</label>
          <input type="text" class="form-control" id="creationManufacturerSite" name="creationManufacturerSite" placeholder="Введите сайт производителя">
        </div>
        {{-- <div class="form-group">
          <label for="creationLogoPath">Логотип</label>
          <input type="text" class="form-control" id="creationLogoPath" name="creationLogoPath" placeholder="Введите адрес логотипа">
        </div> --}}
        {{-- <div class="form-group">
          <label for="creationVendorCode">Артикул</label>
          <input type="text" class="form-control" id="creationVendorCode" name="creationVendorCode" placeholder="Введите артикул">
        </div> --}}
        <div class="form-group">
          <label for="creationComposition">Инструкция по применению и доза</label>
           <textarea class="form-control description" id="creationComposition" name="creationComposition" autocomplete="off" rows=6></textarea>
        </div>
        <div class="form-group">
          <label for="creationDescription">Описание</label>
          <textarea class="form-control description" id="creationDescription" name="creationDescription" placeholder="Введите описание" autocomplete="off" rows=6></textarea>
        </div>
        <div class="form-group">
          <label for="creationCharacteristics">Дополнительная информация и особенности применения</label>
          <textarea class="form-control description" id="creationCharacteristics" name="creationCharacteristics" placeholder="Введите характеристики" autocomplete="off" rows=12></textarea>
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить химикат', ['class' => 'btn btn-primary']) }}
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
          <th>{{ Form::label('manufacturer', 'Производитель') }}</th>
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
          <td class="col-sm-3">
            {{ $row->name }}
          </td>
          <td class="col-sm-3">
            {{ $row->manufacturer }}
          </td>
          <td class="col-sm-2">
            <img src="{{ $_ENV['PHOTO_FOLDER'].$row->main_photo }}" class="col-sm-12" alt="{{ $row->main_photo }}">
          </td>
          <td class="col-sm-2">
            {{ Form::label('', '') }}
            {{ Form::button('Редактировать', ['id' => "edit_button_".$row->id, 'class' => 'col-sm-12 btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modal_'.$row->id])}}
          </td>
          <td class="col-sm-1 text-center">
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete_chemical_{{ $row->id }}" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal fade" id="delete_chemical_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">Подтверждение удаления</h4>
                  </div>
                  {{ Form::open(['action' => "AdminLTEController@deleteChemical", 'method' => 'delete']) }}
                  {{ csrf_field() }}
                  <input type="text" name="id" value="{{ $row->id }}" class="hidden">
                  <div class="modal-footer">
                    {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
                    {{ Form::submit('Удалить химикат', ['class' => 'btn btn-danger']) }}
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
          <th>{{ Form::label('manufacturer', 'Производитель') }}</th>
          <th class="text-center">{{ Form::label('main_photo', 'Фото') }}</th>
          <th>{{ Form::label('', '') }}</th>
          <th class="text-center">{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </tfoot>
    </table>

    @foreach($rows as $row)
    <div class="modal fade" id="modal_@php echo $row->id @endphp" tabindex="-1" role="dialog" aria-labelledby="modalLabel_{{ $row->id }}" aria-hidden="true" style="overflow-y: scroll;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modalLabel_{{ $row->id }}">{{ $row->name }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          {{ Form::open(['action' => "AdminLTEController@updateChemicals", 'method' => 'put', 'files' => true]) }}
          {{ csrf_field() }}
          <input type="text" name="id" value="{{ $row->id }}" class="hidden">
          <div class="modal-body">

            <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$row->main_photo);@endphp>
              <img src=@php echo($_ENV['PHOTO_FOLDER'].$row->main_photo);@endphp class='col-sm-12' alt='{{ $row->main_photo }}' style="width: 100%;">
            </a>

            <table class="table form-group col-sm-12" id="chemical_photos_{{ $row->id }}_table">
              <thead>
                <tr>
                  <th scope="col">Фото</th>
                  <th scope="col">Главное</th>
                  <th scope="col">Удалить</th>
                </tr>
              </thead>
              <tbody id="chemical_photos_{{ $row->id }}_table_body">
              @foreach($chemicals_photos[$row->id] as $chemical_photo)
                <tr>
                  <td class="col-sm-4">
                    <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$chemical_photo);@endphp>
                      <img src=@php echo($_ENV['PHOTO_FOLDER'].$chemical_photo);@endphp alt="{{ $chemical_photo }}" class="image col-sm-12" >
                    </a>
                  </td>
                  <td class="col-sm-4">
                    <label for="is_main_{{ $chemical_photo }}" class="hidden"></label>
                    {{ Form::radio('is_main', $chemical_photo, $chemical_photo==$row->main_photo?true:false) }}
                  </td>
                  <td class="col-sm-4">
                    {{ Form::checkbox('for_delete_'.$chemical_photo) }}
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <div class="form-group">
              <label for="chemical_photos_{{ $row->id }}">Загрузить новые фото</label>
              <input type="file" name="chemical_photos_{{ $row->id }}[]" id="chemical_photos_{{ $row->id }}" multiple="multiple">
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
                      {{ Form::checkbox('chemical_'.$row->id.'_filter_attr_value_'.$filter_attr_value->id) }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @endforeach
            </div>
            <hr>

            <div class="form-group">
              <h4 class="col-sm-12 text-center">Настройка категорий</h4>
              <table class="table col-sm-12">
                <thead>
                  <tr>
                    <th class="col-sm-4"></th>
                    <th class="col-sm-8"></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $categoryId => $category)
                  <tr>
                    <td class="col-sm-4"></td>
                    <td class="col-sm-4">
                      {{ $category }}
                    </td>
                    <td class="col-sm-4">
                      <input type="checkbox" name="chemical_{{ $row->id }}_category_{{ $categoryId }}" autocomplete="off" @if ( ! empty($categoriesRelations[$row->id][$categoryId-1]) ) checked @endif>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <hr>

            <div class="form-group">
              <label for="name_{{ $row->id }}">Название</label>
              <input type="text" class="form-control" id="name_{{ $row->id }}" name="name_{{ $row->id }}" value="{{ $row->name }}" placeholder="Введите название">
            </div>
            <div class="form-group">
              <label for="name_{{ $row->id }}">Производитель</label>
              <input type="text" class="form-control" id="manufacturer_{{ $row->id }}" name="manufacturer_{{ $row->id }}" value="{{ $row->manufacturer }}" placeholder="Введите производителя">
            </div>
            <div class="form-group">
              <a href="{{ $row->manufacturer_site }}"><i class="fa fa-link"></i> Сайт производителя</a>
              <input type="text" class="form-control" id="manufacturer_site_{{ $row->id }}" name="manufacturer_site_{{ $row->id }}" value="{{ $row->manufacturer_site }}" placeholder="Введите сайт производителя">
            </div>
            <div class="form-group">
              <label for="composition_{{ $row->id }}">Инструкция по применению и доза</label>
              <textarea class="form-control description" id="composition_{{ $row->id }}" name="composition_{{ $row->id }}" autocomplete="off" rows=6>{{ $row->composition }}</textarea>
            </div>
            <div class="form-group">
              <label for="description_{{ $row->id }}">Описание</label>
              <textarea class="form-control description" id="description_{{ $row->id }}" name="description_{{ $row->id }}" placeholder="Введите описание" autocomplete="off" rows=6>{{ $row->description }}</textarea>
            </div>
            <div class="form-group">
              <label for="characteristics_{{ $row->id }}">Дополнительная информация и особенности применения</label>
              <textarea class="form-control description" id="characteristics_{{ $row->id }}" name="characteristics_{{ $row->id }}" placeholder="Введите характеристики" autocomplete="off" rows=6>{{ $row->characteristics }}</textarea>
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
  @if(isset($chemical_id))
  var top = document.getElementById("edit_button_{{ $chemical_id }}").offsetTop;
  window.scrollTo(0, top);
  @endif
});

var table = $('#modelTable').dataTable({
  initComplete: function () {
    this.api().columns([2]).every( function () {
      var column = this;      
      var select = $('<select class="form-control"><option selected="selected" value="">Производитель</option></select>')
        .appendTo( $(column.header()).empty() )
        .on( 'change', function () {
          var val = $.fn.dataTable.util.escapeRegex(
            $(this).val()
          );

          column
            .search( val ? '^'+val+'$' : '', true, false )
            .draw();
        });

      column.data().unique().sort().each( function ( d, j ) {
        if(column.search() === '^'+d+'$'){
          select.append( '<option value=\''+d+'\' selected="selected">'+d+'</option>' )
        } else {
          select.append( '<option value=\''+d+'\'>'+d+'</option>' )
        }
      });
    });
  },
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": true,
  "columnDefs": [{ "orderable": false, "targets": [2, 3, 4, 5] }],
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
    $('input[name="chemical_'+row_id+'_filter_attr_value_'+filter_attr_value_id+'"]')[0].checked = false;
  });
});

@foreach($filter_attr_entities as $entity_filters_key => $entity_filters_value)
  @foreach($filter_attr_entities[$entity_filters_key] as $key => $value)
    $('input[name="chemical_{{ $entity_filters_key }}_filter_attr_value_{{ $value }}"]')[0].checked = true;
  @endforeach
@endforeach

</script>
@endsection