@extends('admin.main')

@section('form')
<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить фото</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление нового фото</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createModeratePhotos", 'method' => 'post', 'files' => true]) }}
      {{ csrf_field() }}
      <div class="modal-body">

        <div class="form-group">
          <label>Выбрать фото</label>
          {{ Form::file('creation_photo') }}
        </div>

        <div class="form-group">
          <label for="creation_type">Тип</label>
          <select class="form-control" id="creation_type" name="creation_type" autocomplete="off">
            @foreach($types_objects as $type => $type_object)
            <option value="{{ $type }}">{{ $type_object["translated"] }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="creation_item_id">Обьект</label>
          <select class="form-control" id="creation_item_id" name="creation_item_id" autocomplete="off">
            @foreach($types_objects as $type => $type_object)
              @foreach($type_object["objects"] as $object)
              <option value="{{ $object["id"] }}" type="{{ $type }}">
                @if(isset($object["name"])){{ $object["name"] }}@endif
                @if(isset($object["email"])){{ $object["email"] }}@endif
              </option>
              @endforeach
            @endforeach
          </select>
        </div>

      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить фото', ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateModeratePhotos",
                   'method' => 'put',
                   'id' => 'modelForm',
                   'class' => 'form-horizontal',
                   'files' => true]) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table">
      <thead>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('path', 'Фото', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('is_main', 'Главное', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('type', 'Тип', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('item', 'Обьект', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('moderator', 'Статус', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('user', 'Пользователь', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', 'Удалить') }}</th>
          <th><label for="downloadAll">Скачать все</label><input type="checkbox" id="downloadAll" style="position: relative; top:3px; margin-left: 9px;"></th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class='col-sm-1 text-center'>
            {{ $row["id"] }}
            {{ Form::text('id_'.$row["id"], $row["id"], ['class' => 'hidden']) }}
          </td>
          <td class='col-sm-2'>
            <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$row["path"]);@endphp id="link_{{ $row["id"] }}" download>
              <img src=@php echo($_ENV['PHOTO_FOLDER'].$row["path"]);@endphp class='col-sm-12' alt='{{ $row["path"] }}'>
            </a>
          </td>
          <td class='col-sm-1 text-center'>
            <p class="hidden">{{ $row["is_main"] }}</p>
            <input type="checkbox" name="is_main_{{ $row["id"] }}" autocomplete="off" @if($row["is_main"]) checked="checkbox" @endif>
          </td>
          <td class='col-sm-1'>
          @if($row['type'] == 'sort')Сорт@endif
          @if($row['type'] == 'culture')Культура@endif
          @if($row['type'] == 'chemical')Химикат@endif
          @if($row['type'] == 'pest')Вредитель@endif
          @if($row['type'] == 'disease')Заболевание@endif
          @if($row['type'] == 'handbook')Справка@endif
          </td>
          <td class='col-sm-2'>
            {{ $row["item"]["name"] }}
          </td>
          <td class='col-sm-2' autocomplete="off">
            <p class="hidden">{{ $row["moderator"] }}<p>
            <select class="form-control" id="moderator_{{ $row["id"] }}" name="moderator_{{ $row["id"] }}" autocomplete="off">
              <option value="accepted" @if($row["moderator"] == "accepted") selected="selected" @endif>Принято</option>
              <option value="new" @if($row["moderator"] == "new") selected="selected" @endif>Новое</option>
            </select>
          </td>
          <td class='col-sm-1'>
            {{ $row["user"]["email"] }}
            {{ Form::text('user_'.$row["user"]["email"], $row["user"]["email"], ['class' => 'hidden']) }}
          </td>
          <td class="col-sm-1 text-center">
            <input type="checkbox" name="photo_{{ $row["id"] }}_for_delete" autocomplete="off">
          </td>
          <td class="col-sm-1 text-center">
            <input type="checkbox" iid="{{ $row["id"] }}" class="forDownload" autocomplete="off">
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>{{ Form::label('id', 'id', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('path', 'Фото', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('is_main', 'Главное', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('type', 'Тип', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('item', 'Обьект', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('moderator', 'Статус', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('user', 'Пользователь', ['class' => 'col-sm-12']) }}</th>
          <th>{{ Form::label('', '') }}</th>
          <th>{{ Form::label('', '') }}</th>
        </tr>
      </tfoot>
    </table>
    {{ Form::submit('Сохранить изменения', ['class' => 'btn btn-primary', (!count($rows)?'disabled':'')]) }}
    <input type="button" class="btn btn-primary" id="download_btn" value="Скачать выделенные фото">
    {{ Form::close() }}
  </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">

downloadAll.onchange = function() {
  document.querySelectorAll(".forDownload").forEach(function(checkbox) {
    if(downloadAll[0] === undefined) {
      checkbox.checked = downloadAll.checked ? true : false;
    } else {
      checkbox.checked = downloadAll[0].checked ? true : false;
    }
  });
}

download_btn.onclick = function() {
  document.querySelectorAll(".forDownload").forEach(function(checkbox) {
    if(checkbox.checked) {
      document.getElementById('link_'+ checkbox.attributes.iid.value).click();
    }
  });
};

var update_creation_type = function() {
  ['pest', 'disease', 'culture', 'sort', 'chemical'].forEach(function(type) {
    $("option[type='" + type + "']").each(function (i, option) {
      $(option).hide();
    });
  });

  $("option[type='" + this.value + "']").each(function (i, option) {
    if(i == 0) {
      $(option).prop('selected', true);
    }
    $(option).show();
  });
};
$('#creation_type').on('change', update_creation_type);
update_creation_type();

var table = $('#modelTable').dataTable({
  initComplete: function () {
    this.api().columns([3]).every( function (i) {
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
  "columnDefs": [{ "orderable": false, "targets": [1, 3, 7, 8] }],
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