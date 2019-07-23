@extends('admin.main')

@section('form')
<button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal">Добавить сорт</button>
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление нового сорта</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createSort$section", 'method' => 'post', 'files' => true]) }}
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
          <h4 class="col-sm-12 text-center">Настройка характеристик</h4>
          <table class="table col-sm-12">
            <thead>
              <tr>
                <th class="col-sm-5"></th>
                <th class="col-sm-1"></th>
                <th class="col-sm-3"></th>
                <th class="col-sm-3"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($characteristicsPrototype as $charactId => $charact)
              <tr>
                <td class="col-sm-5"></td>
                <td class="col-sm-1">
                  <img src=@php echo($_ENV['PHOTO_FOLDER'].$charact['icon_path']);@endphp class='col-sm-12' alt='{{ $charact['icon_path'] }}' style="width: 100%;">
                </td>
                <td class="col-sm-3">
                  {{ $charact['name'] }}
                </td>
                <td class="col-sm-3">
                  <input type="text" name="creation_charact_{{ $charactId }}">
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <hr>

        <div class="form-group">
          <h4 class="col-sm-12 text-center">Настройка календаря</h4>
          <table class="table col-sm-12">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">1 год</th>
                <th class="text-center">2 год</th>
                <th class="text-center">3 год</th>
                <th class="text-center">4 год</th>
              </tr>
            </thead>
            <tbody>
            @foreach(range(1, 12) as $monthNum)
              <tr>
                <td class="col-sm-1 text-center">{{ Form::label("$monthNum месяц") }}</td>
                @foreach(range(1, 4) as $yearNum)
                <td class="col-sm-2">
                  <select name="creation_calendar_year_{{ $yearNum }}_month_{{ $monthNum }}" class="form-control" autocomplete="off">
                    <option value=""></option>
                    @foreach($operations as $key => $operation)
                    <option value="{{ $key }}">{{ $operation }}</option>
                    @endforeach
                  </select>
                </td>
                @endforeach
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
          <label for="creationCulture">Культура</label>
          <select name="creationCulture" id="creationCulture" class="form-control">
            @foreach($cultures as $culture)
            <option value="{{ $culture }}">{{ $culture }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="creationContent">Описание</label>
          <textarea class="form-control description" id="creationContent" name="creationContent" placeholder="Введите описание" autocomplete="off" rows=12></textarea>
        </div>

      </div>
      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить сорт', ['class' => 'btn btn-primary']) }}
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
            <th class="text-center">{{ Form::label('id', 'Артикул') }}</th>
            <th>{{ Form::label('name', 'Название') }}</th>
            {{-- <th>{{ Form::label('vendor_code', 'Артикул') }}</th> --}}
            <th>{{ Form::label('culture_id', 'Культура') }}</th>
            <th>{{ Form::label('photo', 'Фото') }}</th>
            <th>{{ Form::label('', '') }}</th>
            <th>{{ Form::label('', 'Удалить') }}</th>
        </tr>
        </tr>
      </thead>
      <tbody>
      @foreach($rows as $row)
        <tr>
          <td class='col-sm-1 text-center'>{{ $row->id }}</td>
          <td class='col-sm-4'>{{ $row->name }}</td>
          {{-- <td class='col-sm-2'>{{ $row->vendor_code }}</td> --}}
          <td class='col-sm-3'>
            @if ( ! empty($cultures[$row->culture_id]) ) {{ $cultures[$row->culture_id] }} @endif
          </td>
          <td class="col-sm-1">
            <img src="{{ $_ENV['PHOTO_FOLDER'].$row->main_photo }}" class="col-sm-12" alt="{{ $row->main_photo }}">
          </td>
          <td class="col-sm-2">
            {{ Form::label('', '') }}
            {{ Form::button('Редактировать', ['id' => "edit_button_".$row->id, 'class' => 'col-sm-12 btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modal_'.$row->id])}}
          </td>
          <td class="col-sm-1 text-center">
            <button class="btn btn-danger" data-toggle="modal" data-target="#delete_sort_{{ $row->id }}" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal fade" id="delete_sort_{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">Подтверждение удаления</h4>
                  </div>
                  {{ Form::open(['action' => "AdminLTEController@deleteSort$section", 'method' => 'delete']) }}
                  {{ csrf_field() }}
                  <input type="text" name="id" value="{{ $row->id }}" class="hidden">
                  <div class="modal-footer">
                    {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
                    {{ Form::submit('Удалить сорт', ['class' => 'btn btn-danger']) }}
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
            <th class="text-center">{{ Form::label('id', 'Артикул') }}</th>
            <th>{{ Form::label('name', 'Название') }}</th>
            {{-- <th>{{ Form::label('vendor_code', 'Артикул') }}</th> --}}
            <th>{{ Form::label('culture_id', 'Культура') }}</th>
            <th>{{ Form::label('photo', 'Фото') }}</th>
            <th>{{ Form::label('', '') }}</th>
            <th>{{ Form::label('', 'Удалить') }}</th>
        </tr>
      </tfoot>
    </table>

    @foreach($rows as $row)
    <div class="modal fade" id="modal_@php echo $row->id @endphp" tabindex="-1" role="dialog" aria-labelledby="modalLabel_{{ $row->id }}" aria-hidden="true" style="overflow-y: scroll;">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modalLabel_{{ $row->id }}">{{ $row->name }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          {{ Form::open(['action' => "AdminLTEController@updateSorts$section", 'method' => 'put', 'files' => true]) }}
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
              @foreach($sort_photos[$row->id] as $sort_photo)
                <tr>
                  <td class="col-sm-4">
                    <a target="_blank" rel="noopener noreferrer" href=@php echo($_ENV['PHOTO_FOLDER'].$sort_photo);@endphp>
                      <img src=@php echo($_ENV['PHOTO_FOLDER'].$sort_photo);@endphp alt="{{ $sort_photo }}" class="image col-sm-12" >
                    </a>
                  </td>
                  <td class="col-sm-4">
                    <label for="is_main_{{ $sort_photo }}" class="hidden"></label>
                    {{ Form::radio('is_main', $sort_photo, $sort_photo==$row->main_photo?true:false) }}
                  </td>
                  <td class="col-sm-4">
                    {{ Form::checkbox('for_delete_'.$sort_photo) }}
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <div class="form-group">
              <label for="sort_photos_{{ $row->id }}">Загрузить новые фото</label>
              {{ Form::file('sort_photos_' . $row->id . '[]', ['multiple' => 'multiple']) }}
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
                      {{ Form::checkbox('sort_'.$row->id.'_filter_attr_value_'.$filter_attr_value->id) }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @endforeach
            </div>
            <hr>

            @if(isset($unique_filter_attributes[$row->culture_id]))
            {{-- <h4 class="col-sm-12 text-center">Настройка уникальных параметров фильтрации</h4> --}}
            @foreach($unique_filter_attributes as $culture_id => $unique_filter_attribute)
              @if($row->culture_id == $culture_id)
              @foreach($unique_filter_attributes[$culture_id] as $name => $unique_filter_attribute)
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
                      {{ Form::checkbox('sort_'.$row->id.'_filter_attr_value_'.$unique_filter_attr_value->id) }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @endforeach
              @endif
            @endforeach
            @endif

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
                      <input type="checkbox" name="sort_{{ $row->id }}_category_{{ $categoryId }}" autocomplete="off" @if ( ! empty($categoriesRelations[$row->id][$categoryId-1]) ) checked @endif>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <hr>

            <div class="form-group">
              <h4 class="col-sm-12 text-center">Настройка характеристик</h4>
              <table class="table col-sm-12">
                <thead>
                  <tr>
                    <th class="col-sm-5"></th>
                    <th class="col-sm-1"></th>
                    <th class="col-sm-3"></th>
                    <th class="col-sm-3"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($characteristics[$row->id] as $charactId => $charact)
                  <tr>
                    <td class="col-sm-5"></td>
                    <td class="col-sm-1">
                      <img src=@php echo($_ENV['PHOTO_FOLDER'].$charact['icon_path']);@endphp class='col-sm-12' alt='{{ $charact['icon_path'] }}' style="width: 100%;">
                    </td>
                    <td class="col-sm-3">
                      {{ $charact['name'] }}
                    </td>
                    <td class="col-sm-3">
                      <input type="text" name="sort_{{ $row['id'] }}_charact_{{ $charactId }}" value="{{ $charact['value'] }}">
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <hr>

            <div class="form-group">
              <h4 class="col-sm-12 text-center">Настройка календаря</h4>
              <table class="table col-sm-12">
                <thead>
                  <tr>
                    <th></th>
                    <th class="text-center">1 год</th>
                    <th class="text-center">2 год</th>
                    <th class="text-center">3 год</th>
                    <th class="text-center">4 год</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($calendars[$row->id] as $monthNum => $month)
                  <tr>
                    <td class="col-sm-1">{{ Form::label("$monthDict[$monthNum]") }}</td>
                    @foreach($month as $yearNum => $year)
                    <td class="col-sm-2">
                      <select name="calendar_{{ $row->id }}_year_{{ $yearNum }}_month_{{ $monthNum }}" class="form-control" autocomplete="off">
                        <option value=""></option>
                        {{-- <option value="">Посадка в грунт</option>
                        <option value="">Посадка на рассаду</option>
                        <option value="">Посадка рассады</option>
                        <option value="">Цветение</option>
                        <option value="">Сбор урожая</option>
                        <option value="">Обрезка/уход</option>
                        <option value="">Подкормка/обработка от вредителей</option>
                        <option value="">Посадка в грунт, Посадка на рассаду</option> --}}
                        {{-- <option value="">Посадка в грунт, Пересадка на рассаду, Пересадка рассады, Цветение, Сбор урожая</option>
                        <option value="">Цветение, Сбор урожая</option> --}}
                        @foreach($operations as $key => $operation)
                        @if($year !== "" && $year !== 0 && $operations[$year] == $operation)
                        <option selected value="{{ $key }}">{{ $operation }}</option>
                        @else
                        <option value="{{ $key }}">{{ $operation }}</option>
                        @endif
                        @endforeach
                      </select>
                    </td>
                    @endforeach
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <hr>

            <div id="sunburst_chart_{{ $row->id }}" class="sunburst_chart"></div>

            <div class="form-group">
              <label for="name_{{ $row->id }}">Название</label>
              <input type="text" class="form-control" id="name_{{ $row->id }}" name="name_{{ $row->id }}" value="{{ $row->name }}" placeholder="Введите название">
            </div>
            <div class="form-group">
              <label for="name_{{ $row->id }}">Культура</label>
              <select name="culture_id_{{ $row->id }}" class="form-control" autocomplete="off">
                @foreach($cultures as $id => $culture)
                <option value="{{ $id }}" @if($row->culture_id == $id) selected @endif>{{ $culture }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="content_{{ $row->id }}">Описание</label>
              <textarea class="form-control description" id="content_{{ $row->id }}" name="content_{{ $row->id }}" placeholder="Введите описание" autocomplete="off" rows=12>{{ $row->content }}</textarea>
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

<style type="text/css">
@media only screen and (max-width: 768px) {
  .sunburst_chart {
    display: flex;
  }
}
</style>

@endsection

@section('script')
@parent
<script src="{{ asset('adminlte/asset/d3.min.js') }}"></script>
<script>
  
$('.description').wysihtml5();

$(window).ready(function() {
  @if(isset($sort_id))
  var top = document.getElementById("edit_button_{{ $sort_id }}").offsetTop;
  window.scrollTo(0, top);
  @endif
});

function drawChart(nodeId, json) {
  var data = json;

  var width = 640,
      height = 500,
      maxRadius = Math.min(width, height) / 2;

  var svg = d3.select(nodeId).append("svg")
      .attr("width", width)
      .attr("height", height)
      .attr("viewBox", "0 0 " + width + " " + height)
      .attr("perserveAspectRatio", "xMinYMin meet")
      .append("g")
      .attr("transform", "translate(" + ((width / 2) + 100) + "," + height / 2 + ")");

  var multiLevelData = [];
  var setMultiLevelData = function(data) {
      if (data == null)
          return;
      var level = data.length,
          counter = 0,
          index = 0,
          currentLevelData = [],
          queue = [];
      for (var i = 0; i < data.length; i++) {
          queue.push(data[i]);
      };

      while (!queue.length == 0) {
          var node = queue.shift();
          currentLevelData.push(node);
          level--;

          if (node.subData) {
              for (var i = 0; i < node.subData.length; i++) {
                  queue.push(node.subData[i]);
                  counter++;
              };
          }
          if (level == 0) {
              level = counter;
              counter = 0;            multiLevelData.push(currentLevelData);
              currentLevelData = [];
          }
      }
  }

  var drawPieChart = function(_data, index) {
    var pie = d3.layout.pie()
      .sort(null)
      .value(function(d) {
          return d.nodeData.angle;
      });
    var arc = d3.svg.arc()
      .outerRadius((index + 1) * pieWidth - 1)
      .innerRadius(index * pieWidth);

    var fake_arc = d3.svg.arc()
      .outerRadius((index + 1) * pieWidth + 20)
      .innerRadius(index * pieWidth);

    var g = svg.selectAll(".arc" + index).data(pie(_data)).enter().append("g")
      .attr("class", "arc" + index)
      .attr("transform", "rotate(-13)");

    g.append("path").attr("d", arc)
      .style("fill", function(d) {
          return d.data.nodeData.color;
      })
      .append("svg:title")
        .text(function(d) {
            return d.data.nodeData.text;
        });

    g.append("text").attr("transform", function(d) {
          return "translate(" + fake_arc.centroid(d) + ") rotate(13)";
      })
      .attr("dy", ".65em")
      .style("text-anchor", "middle")
      .style("font-family", "sans-serif")
      .style("font-size", "12px")
      .style("fill", function(d) {
        return (d.data.nodeData.age == "1" ||
                d.data.nodeData.age == "2" ||
                d.data.nodeData.age == "3" ||
                d.data.nodeData.age == "4" ) ? "blue" : "black";
      })
      .text(function(d) {
          return d.data.nodeData.age;
      });

    // Black arc
    g.append("path").attr("d", arc)
      .attr("fill", "black")
      .attr("d", d3.svg.arc()
                  .innerRadius((index + 0.5) * pieWidth - 19)
                  .outerRadius(index * pieWidth-1)
      );

    // Legend
    var legendG = svg.selectAll(".legend")
      .data([{'x': `<tspan x="14" y="10">Посадка в грунт</tspan>`, 'c': '#286928', 'y': '0'},
             {'x': `<tspan x="14" y="10">Посадка на рассаду</tspan>`, 'c': '#7c956c', 'y': '0'},
             {'x': `<tspan x="14" y="10">Посадка рассады</tspan>`, 'c': '#b4b52a', 'y': '0'},
             {'x': `<tspan x="14" y="10">Цветение</tspan>`, 'c': '#e17a0b', 'y': '0'},
             {'x': `<tspan x="14" y="10">Сбор урожа</tspan>я`, 'c': '#ab2b23', 'y': '0'},
             {'x': `<tspan x="14" y="10">Обрезка/уход</tspan>`, 'c': '#1f5d9d', 'y': '0'},
             {'x': `<tspan x="14" y="10">Подкормка/обработка</tspan>
                    <tspan x="14" y="24">от вредителей</tspan>`, 'c': '#7b1b61', 'y': '0'},
             {'x': `<tspan x="14" y="20">Посадка в грунт</tspan>
                    <tspan x="14" y="34">Посадка на рассаду</tspan>`, 'c': '#2c3d22', 'y': '10'}])
      .enter().append("g")
      .attr("transform", function(d,i){
          return "translate(" + (-400) + "," + (i * 20 - 125) + ")";
      })
      .attr("class", "legend");

    legendG.append("rect")
      .attr("width", 12)
      .attr("height", 12)
      .attr("y", function(d) {
        return d.y;
      })
      .attr("fill", function(d, i) {
          return d.c;
      });

    legendG.append("text")
      .html(function(d){
          return d.x;
      })
      .style("font-family", "sans-serif")
      .style("font-size", "12px")
      .attr("y", function(d) {
        return d.y;
      })
      .attr("x", 14);
  }

  setMultiLevelData(data);

  var pieWidth = parseInt(maxRadius / multiLevelData.length) - multiLevelData.length;

  for (var i = 0; i < multiLevelData.length; i++) {
      var _cData = multiLevelData[i];
      drawPieChart(_cData, i);
  }
}

[@foreach($rows as $row){{ $row['id'] }},@endforeach].forEach(function(sort_id) {
  $.ajax({
    method: 'post',
    url: "/public/api/sort/getCalendarChartData/" + sort_id,
  }).done(function(response) {
    drawChart("#sunburst_chart_" + sort_id, response.data);
  });
});

</script>

<script type="text/javascript">
var table = $('#modelTable').dataTable({
  initComplete: function () {
    this.api().columns([2]).every( function () {
      var column = this;
      var select = $('<select class="form-control"><option selected="selected" value="">Культура</option></select>')
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
    if($('input[name="sort_{{ $entity_filters_key }}_filter_attr_value_{{ $value }}"]')[0]) {
      $('input[name="sort_{{ $entity_filters_key }}_filter_attr_value_{{ $value }}"]')[0].checked = true;
    }
  @endforeach
@endforeach

</script>
@endsection