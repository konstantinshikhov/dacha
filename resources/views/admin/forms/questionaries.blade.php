@extends('admin.main')

@section('form')
<div class="box">
  <div class="box-body">
    {{ Form::open(['action' => "AdminLTEController@updateQuestionaries", 'id' => 'modelForm', 'method' => 'put']) }}
    {{ csrf_field() }}
    <table id="modelTable" class="table display nowrap">
      <thead>
        <tr>
          <th><label class="text-center">id</label></th>
          <th><label class="text-center">Пользователь</label></th>
          <th><label class="text-center">Культура</label></th>
          <th><label class="text-center">Сорт</label></th>
          <th><label class="text-center">Поколение</label></th>
          <th><label class="text-center">Посадочная площадь</label></th>
          <th><label class="text-center">Единица измерения</label></th>
          <th><label class="text-center">Дата посадки</label></th>
          <th><label class="text-center">Место посадки</label></th>
          <th><label class="text-center">Дата пересадки</label></th>
          <th><label class="text-center">Дата проведения обрезки</label></th>
          <th><label class="text-center">Болеет ли растение</label></th>
          <th><label class="text-center">Наличие искуственного полива</label></th>
          <th><label class="text-center">Наличие капельного полива</label></th>
          <th><label class="text-center">Осадки с момента посадки</label></th>
          <th><label class="text-center">Подкормка с момента посадки</label></th>
          <th><label class="text-center">Искуственный полив с момента поcадки</label></th>
          <th><label class="text-center">Полученный сумарный урожай</label></th>
          <th><label for="downloadAll">Скачать все</label><input type="checkbox" id="downloadAll" style="position: relative; top:3px; margin-left: 9px;" autocomplete="off"></th>
          <th><label for="deleteAll">Удалить все</label><input type="checkbox" id="deleteAll" style="position: relative; top:3px; margin-left: 9px;" autocomplete="off"></th>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class="text-center">{{ $row["id"] }}</td>
          <td>
            {{ $row["user"]["first_name"] }} {{ $row["user"]["last_name"] }} ({{ $row["user"]["email"] }})
          </td>
          <td>
            {{ $row["culture"]["name"] }}
          </td>
          <td>
            {{ $row["sort"]["name"] }}
          </td>
          <td>
            <p class="hidden">{{ $row["generation"] }}</p>
            <input type="number" min=1 class="form-control" name="questionary_{{ $row["id"] }}_generation" value="{{ $row["generation"] }}" autocomplete="off">
          </td>
          <td>
            <p class="hidden">{{ $row["landing_area"] }}</p>
            <input type="number" min=0 class="form-control" name="questionary_{{ $row["id"] }}_landing_area" value="{{ $row["landing_area"] }}" autocomplete="off">
          </td>
          <td>
            <p class="hidden">{{ $row["landing_type"] }}</p>
            <input type="text" class="form-control" name="questionary_{{ $row["id"] }}_landing_type" value="{{ $row["landing_type"] }}" autocomplete="off">
          </td>
          <td>
            <p class="hidden">{{ $row["seeding_date"] }}</p>
            <input type="text" class="form-control" id="questionary_{{ $row["id"] }}_seeding_date" name="questionary_{{ $row["id"] }}_seeding_date" value="{{ $row["seeding_date"] }}" autocomplete="off">
          </td>
          <td>
            <p class="hidden">{{ $row["cultivation_type"] }}</p>
            <input type="text" class="form-control" name="questionary_{{ $row["id"] }}_cultivation_type" value="{{ $row["cultivation_type"] }}" autocomplete="off">
          </td>
          <td>
            <p class="hidden">{{ $row["ground_transplantation_date"] }}</p>
            <input type="text" class="form-control" id="questionary_{{ $row["id"] }}_ground_transplantation_date" name="questionary_{{ $row["id"] }}_ground_transplantation_date" value="{{ $row["ground_transplantation_date"] }}" autocomplete="off">
          </td>
          <td>
            <p class="hidden">{{ $row["trimming_date"] }}</p>
            <input type="text" class="form-control" id="questionary_{{ $row["id"] }}_trimming_date" name="questionary_{{ $row["id"] }}_trimming_date" value="{{ $row["trimming_date"] }}" autocomplete="off">
          </td>
          <td class="text-center">
            <p class="hidden">{{ $row["is_ill"] }}</p>
            <input type="checkbox" {{ $row["is_ill"] ? 'checked="checked"' : ''}} name="questionary_{{ $row["id"] }}_is_ill" autocomplete="off">
          </td>
          <td class="text-center">
            <p class="hidden">{{ $row["artificial_irrigation"] }}</p>
            <input type="checkbox" {{ $row["artificial_irrigation"] ? 'checked="checked"' : ''}} name="questionary_{{ $row["id"] }}_artificial_irrigation" autocomplete="off">
          </td>
          <td class="text-center">
            <p class="hidden">{{ $row["drip_irrigation"] }}</p>
            <input type="checkbox" {{ $row["drip_irrigation"] ? 'checked="checked"' : ''}} name="questionary_{{ $row["id"] }}_drip_irrigation" autocomplete="off">
          </td>
          <td>
            <p class="hidden">{{ $row["precipitation_from_planting"] }}</p>
            <input type="number" min=0 class="form-control" name="questionary_{{ $row["id"] }}_precipitation_from_planting" value="{{ $row["precipitation_from_planting"] }}" autocomplete="off">
          </td>
          <td>
            <p class="hidden">{{ $row["feeding_from_planting"] }}</p>
            <input type="number" min=0 class="form-control" name="questionary_{{ $row["id"] }}_feeding_from_planting" value="{{ $row["feeding_from_planting"] }}" autocomplete="off">
          </td>
          <td>
            <p class="hidden">{{ $row["artificial_irrigation_from_planting"] }}</p>
            <input type="number" min=0 class="form-control" name="questionary_{{ $row["id"] }}_artificial_irrigation_from_planting" value="{{ $row["artificial_irrigation_from_planting"] }}" autocomplete="off">
          </td>
          <td>
            <p class="hidden">{{ $row["harvest"] }}</p>
            <input type="number" min=0 class="form-control" name="questionary_{{ $row["id"] }}_harvest" value="{{ $row["harvest"] }}" autocomplete="off">
          </td>
          <td class="text-center">
            <a target="_blank" href="questionary?id={{ $row["id"] }}" id="link_{{ $row["id"] }}" style="margin-right: 6px;">
              анкета_{{ $row["id"] }}.txt
            </a>
            <input type="checkbox" iid="{{ $row["id"] }}" class="forDownload" autocomplete="off" style="position: relative; top: 3px;">
          </td>
          <td class="text-center">
            <input type="checkbox" class="forDelete" name="questionary_{{ $row["id"] }}_for_delete" autocomplete="off">
          </td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th><label class="text-center">id</label></th>
          <th><label class="text-center">Пользователь</label></th>
          <th><label class="text-center">Культура</label></th>
          <th><label class="text-center">Сорт</label></th>
          <th><label class="text-center">Поколение</label></th>
          <th><label class="text-center">Посадочная площадь</label></th>
          <th><label class="text-center">Единица измерения</label></th>
          <th><label class="text-center">Дата посадки</label></th>
          <th><label class="text-center">Место посадки</label></th>
          <th><label class="text-center">Дата пересадки</label></th>
          <th><label class="text-center">Дата проведения обрезки</label></th>
          <th><label class="text-center">Болеет ли растение</label></th>
          <th><label class="text-center">Наличие искуственного полива</label></th>
          <th><label class="text-center">Наличие капельного полива</label></th>
          <th><label class="text-center">Осадки с момента посадки</label></th>
          <th><label class="text-center">Подкормка с момента посадки</label></th>
          <th><label class="text-center">Искуственный полив с момента поcадки</label></th>
          <th><label class="text-center">Полученный сумарный урожай</label></th>
          <th></th>
          <th></th>
        </tr>
      </tfoot>
    </table>
    {{ Form::submit('Сохранить изменения', ['class' => 'btn btn-primary']) }}
    <input type="button" class="btn btn-primary" id="download_btn" value="Скачать выделенные анкеты">
    {{ Form::close() }}
  </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">
deleteAll.onchange = function() {
  document.querySelectorAll(".forDelete").forEach(function(checkbox) {
    if(deleteAll[0] === undefined) {
      checkbox.checked = deleteAll.checked ? true : false;
    } else {
      checkbox.checked = deleteAll[0].checked ? true : false;
    }
  });
}

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

var table = $('#modelTable').dataTable({
  initComplete: function () {
    this.api().columns([1, 2, 3]).every( function (i) {
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
  "columnDefs": [{ "orderable": false, "targets": [1, 2, 3, 18, 19] }],
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

$.fn.datepicker.dates['ru'] = {
    days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
    daysShort: ["Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Сбт"],
    daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
    months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
    monthsShort: ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
    today: "Сегодня",
    format: 'yyyy-mm-dd',
    weekStart: 1
};

@foreach($rows as $row)
['seeding_date', 'ground_transplantation_date', 'trimming_date'].forEach(function(param){
  $('#questionary_{{ $row["id"] }}_' + param).datepicker({
    language: 'ru',
    autoclose: true
  });
});
@endforeach

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