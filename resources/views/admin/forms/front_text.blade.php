@extends('admin.main')

@section('form')
{{ Form::open(['action' => "AdminLTEController@updateFrontText",
               'method' => 'put',
               'id' => 'modelForm',
               'class' => 'form-horizontal']) }}
{{ csrf_field() }}
<h3>Редактирование текста разделов "О НАС" и "ОБУЧЕНИЕ"</h3>
<div class="box">
  <div class="box-body">
    <table class="table">
      <thead>
        <tr>
          <th class="text-center"><label for="title">Заголовок</label></th>
          <th class="text-center"><label for="text">Текст</label></th>
        </tr>
      </thead>
      <tbody>
      @foreach($main_page_infos as $main_page_info)
      <tr>
        <td class='col-sm-5 text-center'>
          <textarea class="form-control description" id="main_page_info_{{ $main_page_info->id }}_title" name="main_page_info_{{ $main_page_info->id }}_title" placeholder="Введите текст справки" autocomplete="off" rows=10>{{ $main_page_info->title }}</textarea>
        </td>
        <td class='col-sm-6 text-center'>
          <textarea class="form-control description" id="main_page_info_{{ $main_page_info->id }}_text" name="main_page_info_{{ $main_page_info->id }}_text" placeholder="Введите текст справки" autocomplete="off" rows=10>{{ $main_page_info->text }}</textarea>
        </td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

<h3>Редактирование текста секций на главной странице</h3>
<div class="box">
  <div class="box-body">
    <table class="table">
      <thead>
        <tr>
          <th class="text-center"><label for="name">Секция</label></th>
          <th class="text-center"><label for="title">Заголовок</label></th>
          <th class="text-center"><label for="text">Текст</label></th>
        </tr>
      </thead>
      <tbody>
      @foreach($sections as $section)
      <tr>
        <td class='col-sm-1 text-center'>
          {{ $section->name }}
        </td>
        <td class='col-sm-5 text-center'>
          <textarea class="form-control description" id="section_{{ $section->id }}_title" name="section_{{ $section->id }}_title" placeholder="Введите текст справки" autocomplete="off" rows=10>{{ $section->title }}</textarea>
        </td>
        <td class='col-sm-6 text-center'>
          <textarea class="form-control description" id="section_{{ $section->id }}_text" name="section_{{ $section->id }}_text" placeholder="Введите текст справки" autocomplete="off" rows=10>{{ $section->text }}</textarea>
        </td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

<h3>Редактирование текста футера на главной странице</h3>
<div class="box">
  <div class="box-body">
    <table class="table">
      <thead>
        <tr>
          <th class="text-center"><label for="order">Порядок отображения</label></th>
          <th class="text-center"><label for="text">Текст</label></th>
        </tr>
      </thead>
      <tbody>
      @foreach($footers as $footer)
      <tr>
        <td class='col-sm-1 text-center' style="vertical-align: middle;">
          <input type="number" class="form-control" name="footer_{{ $footer->id }}_order" autocomplete="off" value="{{ $footer->order }}" min="1">
        </td>
        <td class='col-sm-11 text-center'>
          <textarea class="form-control description" id="footer_{{ $footer->id }}_text" name="footer_{{ $footer->id }}_text" placeholder="Введите текст справки" autocomplete="off" rows=3>{{ $footer->text }}</textarea>
        </td>
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
{{ Form::submit('Сохранить изменения', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}
@endsection

@section('script')
@parent
<script type="text/javascript">

$('.description').wysihtml5();

// var tableSections = $('#modelTableSections').dataTable({
//   "bPaginate": true,
//   "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
//   "bSort": true,
//   "stateSave": true,
//   "scrollX": true,
//   "autoWidth": false,
//   "language": {
//     "lengthMenu": "Показать _MENU_ записей на странице",
//     "search": "Поиск:",
//     "emptyTable": "Записи отсутствуют",
//     "info": "Страница _PAGE_ из _PAGES_",
//     "paginate": {
//         "first": "Первая",
//         "last": "Последняя",
//         "next": "Следующая",
//         "previous": "Предыдущая"
//     }
//   }
// });

// var tableFooters = $('#modelTableFooters').dataTable({
//   "bPaginate": true,
//   "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Все"]],
//   "bSort": true,
//   "stateSave": true,
//   "scrollX": true,
//   "autoWidth": false,
//   "language": {
//     "lengthMenu": "Показать _MENU_ записей на странице",
//     "search": "Поиск:",
//     "emptyTable": "Записи отсутствуют",
//     "info": "Страница _PAGE_ из _PAGES_",
//     "paginate": {
//         "first": "Первая",
//         "last": "Последняя",
//         "next": "Следующая",
//         "previous": "Предыдущая"
//     }
//   }
// });

// $('#modelForm').on('submit', function(e){
//   var form = this;

//   // Encode a set of form elements from all pages as an array of names and values
//   var params = tableSections.$('input,select,textarea').serializeArray();

//   // Iterate over all form elements
//   $.each(params, function() {
//     // If element doesn't exist in DOM
//     if(!$.contains(document, form[this.name])) {
//       // Create a hidden element
//       $(form).append(
//         $('<input>')
//           .attr('type', 'hidden')
//           .attr('name', this.name)
//           .val(this.value)
//       );
//     }
//   });

//   // Encode a set of form elements from all pages as an array of names and values
//   var params = tableFooters.$('input,select,textarea').serializeArray();

//   // Iterate over all form elements
//   $.each(params, function() {
//     // If element doesn't exist in DOM
//     if(!$.contains(document, form[this.name])) {
//       // Create a hidden element
//       $(form).append(
//         $('<input>')
//           .attr('type', 'hidden')
//           .attr('name', this.name)
//           .val(this.value)
//       );
//     }
//   });
  
// });
</script>
@endsection