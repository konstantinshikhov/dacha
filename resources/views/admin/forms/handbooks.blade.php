@extends('admin.main')

@section('form')
<div class="box">
  <div class="box-body">
    <h4>Присланные статьи</h4>
    {{ Form::open(['action' => "AdminLTEController@updateHandbooks", 'method' => 'put']) }}
    {{ csrf_field() }}
    <input class="hidden" type="checkbox" name="handbookFilesUpdating" checked="checked">
    <table id="modelFilesTable" class="table">
      <thead>
        <tr>
          <th class="text-center">id</th>
          <th>Ссылка на файл</th>
          <th>Пользователь</th>
          <th>Статус</th>
          <th>Удалить</th>
        </tr>
      </thead>
      <tbody>
      @foreach($handbook_files as $file)
        <tr>
          <td class="col-sm-1 text-center">
            {{ $file["id"] }}
          </td>
          <td class="col-sm-6">
            <a href=@php echo($_ENV['PHOTO_FOLDER'].$file['path']);@endphp target="_blank">
              @php echo($_ENV['PHOTO_FOLDER'].$file['path']);@endphp
            </a>
          </td>
          <td class="col-sm-2">
            {{ $file["user"]["email"] ?? $file["user_id"] }}
          </td>
          <td class="col-sm-2">
            <select class="form-control" name="handbook_file_{{ $file["id"] }}_moderator" autocomplete="off">
              <option value="accepted" @if($file["moderator"] == "accepted") selected="selected" @endif>Принято</option>
              <option value="new" @if($file["moderator"] == "new") selected="selected" @endif>Новая</option>
            </select>
          </td>
          <td class="col-sm-1 text-center">
            <input type="checkbox" name="handbook_file_{{ $file["id"] }}_for_delete" autocomplete="off">
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th class="text-center">id</th>
          <th>Ссылка на файл</th>
          <th>Пользователь</th>
          <th>Статус</th>
          <th>Удалить</th>
        </tr>
      </tfoot>
    </table>
    {{ Form::submit('Сохранить изменения', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}

  </div>
</div>

<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить справку</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    {{ Form::open(['action' => "AdminLTEController@createHandbooks", 'method' => 'post', 'files' => true]) }}
    {{ csrf_field() }}
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление справочной информации</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="creationTitle">Название</label>
          <input type="text" class="form-control" id="creationTitle" name="creationTitle" placeholder="Введите название справки">
        </div>

        <div class="">
          <label class="input-group-addon" for="creationMainPhoto" style="background-color: #fff; border: none;">
            Главное фото
            <input type="file" id="creationMainPhoto" name="creationMainPhoto" placeholder="Выберете главное фото" autocomplete="off">
          </label>
          <label class="input-group-addon" for="creationCategoryId" style="background-color: #fff; border: none;">
            Категория
            <select class="form-control" id="creationCategoryId" name="creationCategoryId" autocomplete="off">
              <option></option>

              {{ $variable = 0  }}
              @foreach($categories as $category)
                @if ($variable == 6)
                  @break
                @else
                  <option value="{{ $category["id"] }}" section="{{ $category["section_id"] }}">{{ $category["attribute_value"] }}</option>
                @endif
                  {{ $variable++  }}
              @endforeach
            </select>
          </label>
          <label class="input-group-addon" for="creationSectionId" style="background-color: #fff; border: none;">
            Секция
            <select class="form-control" id="creationSectionId" name="creationSectionId" autocomplete="off">
              <option></option>
              @foreach($sections as $section)
              <option value="{{ $section["id"] }}">{{ $section["name"] }}</option>
              @endforeach
            </select>
          </label>
          <label class="input-group-addon" for="creationCultureId" style="background-color: #fff; border: none;">
            Культура
            <select class="form-control" id="creationCultureId" name="creationCultureId" autocomplete="off">
              <option></option>
              @foreach($cultures as $culture)
              <option value="{{ $culture["id"] }}" section="{{ $culture["section_id"] }}">{{ $culture["name"] }}</option>
              @endforeach
            </select>
          </label>
        </div>

        <div class="form-group">
          @foreach($attributesDictionary as $attributeId => $attributeName)
          @if(isset($attributeValuesDictionary[$attributeId]))
            <table class="table col-sm-12">
              <thead>
                <tr>
                  <th class="col-sm-4">{{ $attributeName }}</th>
                  <th class="col-sm-8"></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($attributeValuesDictionary[$attributeId] as $valueId => $value)
                <tr>
                  <td class="col-sm-4"></td>
                  <td class="col-sm-4">
                    {{ $value }}
                  </td>
                  <td class="col-sm-4">
                    <input type="checkbox" name="creation_attribute_{{$attributeId}}_value_{{$valueId}}" autocomplete="off">
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          @endif
          @endforeach
        </div>

        {{-- <div class="">
          <label class="input-group-addon" for="photosForHandbook" style="background-color: #fff; border: none;">
            Фото для справки
            <input type="file" id="photosForHandbook" name="photosForHandbook" multiple="true">
          </label>
          <label class="input-group-addon" for="photosForHandbookButton" style="background-color: #fff; border: none;">
            <input type="button" class="btn form-control" id="photosForHandbookButton" style="background-color: #e8e8e7; color: #333; border: none;" value="Загрузить">
          </label>
        </div> --}}


        <div class="form-group">
          <label for="creationDescription">Текст</label>
          <textarea class="form-control description" id="creationDescription" name="creationDescription" placeholder="Введите текст справки" autocomplete="off" rows=15></textarea>
        </div>

        <div class="form-group">
          <label for="creationFullDescription">Подробное описание</label>
          <textarea class="form-control description full_description" id="creationFullDescription" name="creationFullDescription" placeholder="Введите подробное описание" autocomplete="off" rows=15></textarea>
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить справку', ['class' => 'btn btn-primary']) }}
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
          <th>{{ Form::label('user', 'Пользователь') }}</th>
          <th>{{ Form::label('title', 'Название') }}</th>
          <th>{{ Form::label('category', 'Категория') }}</th>
          <th>{{ Form::label('section', 'Секция') }}</th>
          <th>{{ Form::label('culture', 'Культура') }}</th>
          <th class="text-center">{{ Form::label('main_photo', 'Фото') }}</th>
          <th>{{ Form::label('', '') }}</th>
          <th class="text-center">{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($rows as $row)
        <tr>
          <td class="col-sm-1 text-center">
            {{ $row["id"] }}
          </td>
          <td class="col-sm-1">
            {{ $row["user_id"] == '0' ? 'Администрация' : $row["user"]["email"] }}
          </td>
          <td class="col-sm-1">
            {{ $row["title"] }}
          </td>
          <td class="col-sm-2">
            {{ isset($categories[$row["category_id"]]) ? $categories[$row["category_id"]]["attribute_value"] : '' }}
          </td>
          <td class="col-sm-2">
            {{ isset($sections[$row["section_id"]]) ? $sections[$row["section_id"]]["name"] : '' }}
          </td>
          <td class="col-sm-2">
            {{ isset($cultures[$row["culture_id"]]) ? $cultures[$row["culture_id"]]["name"] : '' }}
          </td>
          <td class="col-sm-1">
            <img src="{{ $_ENV['PHOTO_FOLDER'].$row["main_photo"] }}" class="col-sm-12" alt="{{ $row["main_photo"] }}">
          </td>
          <td class="col-sm-1">
            {{ Form::label('', '') }}
            {{ Form::button('Редактировать', ['id' => "edit_button_".$row["id"], 'class' => 'col-sm-12 btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modal_'.$row["id"]])}}
          </td>
          <td class="col-sm-1 text-center">
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete_handbook_{{ $row["id"] }}" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal fade" id="delete_handbook_{{ $row["id"] }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">Подтверждение удаления</h4>
                  </div>
                  {{ Form::open(['action' => "AdminLTEController@deleteHandbooks", 'method' => 'delete']) }}
                  {{ csrf_field() }}
                  <input type="text" name="id" value="{{ $row["id"] }}" class="hidden">
                  <div class="modal-footer">
                    {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
                    {{ Form::submit('Удалить справку', ['class' => 'btn btn-danger']) }}
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
          <th>{{ Form::label('user', 'Пользователь') }}</th>
          <th>{{ Form::label('title', 'Название') }}</th>
          <th>{{ Form::label('category', 'Категория') }}</th>
          <th>{{ Form::label('section', 'Секция') }}</th>
          <th>{{ Form::label('culture', 'Культура') }}</th>
          <th class="text-center">{{ Form::label('main_photo', 'Фото') }}</th>
          <th>{{ Form::label('', '') }}</th>
          <th class="text-center">{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </tfoot>
    </table>

    @foreach($rows as $row)
    <div class="modal fade" id="modal_{{ $row["id"] }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel_{{ $row["id"] }}" aria-hidden="true" style="overflow-y: scroll;">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modalLabel_{{ $row["id"] }}">{{ $row["title"] }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          {{ Form::open(['action' => "AdminLTEController@updateHandbooks", 'method' => 'put', 'files' => true]) }}
          {{ csrf_field() }}
          <input type="text" name="id" value="{{ $row["id"] }}" class="hidden">
          <div class="modal-body">

            <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$row["main_photo"]);@endphp>
              <img src=@php echo($_ENV['PHOTO_FOLDER'].$row["main_photo"]);@endphp class='col-sm-12' alt='{{ $row["main_photo"] }}' style="width: 100%;">
            </a>

            @if(count($row["photos"]) != 0)
            <table class="table form-group col-sm-12">
              <thead>
                <tr>
                  <th scope="col">Фото</th>
                  <th scope="col">Ссылка</th>
                  <th scope="col">Главное</th>
                  <th scope="col">Удалить</th>
                </tr>
              </thead>
              <tbody>
              @foreach($row["photos"] as $photo)
                <tr>
                  <td class="col-sm-4">
                    <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$photo["path"]);@endphp>
                      <img src=@php echo($_ENV['PHOTO_FOLDER'].$photo["path"]);@endphp alt="{{ $photo["path"] }}" class="image col-sm-12" >
                    </a>
                  </td>
                  <td class="col-sm-4">
                    <input type="text" class="form-control" value="{{ $_ENV['PHOTO_FOLDER'].$photo["path"] }}" readonly>
                  </td>
                  <td class="col-sm-2">
                    <label for="is_main_{{ $photo["id"] }}" class="hidden"></label>
                    {{-- <input checked="{{ $photo["path"] == $row["main_photo"] ? true : false }}" name="is_main" value="{{ $photo["id"] }}" type="radio" autocomplete="off"> --}}
                    {{ Form::radio('is_main', $photo["id"], $photo["path"] == $row["main_photo"] ? true : false, ['autocomplete' => 'off']) }}
                  </td>
                  <td class="col-sm-2">
                    {{ Form::checkbox('for_delete_' . $photo["id"]) }}
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            @endif

            <div class="form-group">
              <label for="handbook_photos_{{ $row["id"] }}">Загрузить новые фото</label>
              <input type="file" name="handbook_photos_{{ $row["id"] }}[]" multiple="true">
            </div>
            <hr>

            <div class="form-group">
              @foreach($attributesDictionary as $attributeId => $attributeName)
              @if(isset($attributeValuesDictionary[$attributeId]))
                <table class="table col-sm-12">
                  <thead>
                    <tr>
                      <th class="col-sm-4">{{ $attributeName }}</th>
                      <th class="col-sm-8"></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($attributeValuesDictionary[$attributeId] as $valueId => $value)
                    <tr>
                      <td class="col-sm-4"></td>
                      <td class="col-sm-4">
                        {{ $value }}
                      </td>
                      <td class="col-sm-4">
                        <input type="checkbox" name="handbook_{{$row["id"]}}_attribute_{{$attributeId}}_value_{{$valueId}}" @if(isset($row["attributes"][$attributeId][$valueId])) checked="checked" @endif autocomplete="off">
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
              @endforeach
            </div>

            <div class="form-group">
              <label for="title_{{ $row["id"] }}">Название</label>
              <input type="text" class="form-control" id="title_{{ $row["id"] }}" name="title_{{ $row["id"] }}" value="{{ $row["title"] }}" placeholder="Введите название">
            </div>

            <div class="form-group">
              <label for="description_{{ $row["id"] }}">Текст</label>
              <textarea class="form-control description" id="description_{{ $row["id"] }}" name="description_{{ $row["id"] }}" placeholder="Введите описание" autocomplete="off" rows=15>{{ $row["description"] }}</textarea>
            </div>

            <div class="form-group">
              <label for="full_description_{{ $row["id"] }}">Подробное описание</label>
              <textarea class="form-control description full_description" id="full_description_{{ $row["id"] }}" name="full_description_{{ $row["id"] }}" placeholder="Введите подробное описание" autocomplete="off" rows=15>{{ $row["full_description"] }}</textarea>
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
var update_creation_section = function() {
  [@foreach($sections as $section){{ $section->id }},@endforeach].forEach(function(section) {
    $("option[section='" + section + "']").each(function (i, option) {
      $(option).hide();
    });
  });

  $("option[section='" + this.value + "']").each(function (i, option) {
    if(i == 0) {
      $(option).prop('selected', true);
    }
    $(option).show();
  });
};
// $('#creationSectionId').on('change', update_creation_section);
// update_creation_section();

$('.description').wysihtml5();

var table = $('#modelTable').dataTable({
  initComplete: function () {
    this.api().columns([3, 4, 5]).every( function (i) {
      var column = this;            

      if(column.header().attributes[4].name == 'style') {
        var header = column.header().attributes[3].nodeValue;
      } else {
        var header = column.header().attributes[4].nodeValue;
      }

      var select = $('<select class="form-control"><option selected="selected" value="">' + header + '</option></select>')
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
            select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
          } else {
            select.append( '<option value="'+d+'">'+d+'</option>' )
          }
        });
    });
  },
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": true,
  "columnDefs": [{ "orderable": false, "targets": [3, 4, 5, 6, 7, 8] }],
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

var filesTable = $('#modelFilesTable').dataTable({
  "bPaginate": true,
  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
  "bSort": true,
  "order": [[0, "desc"]],
  "columnDefs": [{ "orderable": false, "targets": [1, 4] }],
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

filesTable.api().columns.adjust();
</script>
@endsection