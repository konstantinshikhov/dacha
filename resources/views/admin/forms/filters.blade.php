@extends('admin.main')

@section('form')
<div class="modal fade" id="creationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">Добавление нового фильтра</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(['action' => "AdminLTEController@createFilterAttributes", 'method' => 'post']) }}
      {{ csrf_field() }}

      @if($section == 'Klumba' || $section == 'Ogorod' || $section == 'Sad')

      <div class="modal-body">
        <div class="form-group">
          <label for="creationSectionId">Секция</label>
          <input type="text" class="form-control disabled" id="creationSectionName" name="creationSectionName" value="{{ $section }}" disabled="disabled">
          <input type="text" class="form-control disabled hidden" id="creationSectionId" name="creationSectionId" value="{{ $sectionId }}">
          <input type="text" class="form-control hidden" id="creationSection" name="creationSection" value="{{ $section }}">
        </div>
        <div class="form-group">
          <label for="creationName">Название</label>
          <input type="text" class="form-control" id="creationName" name="creationName" placeholder="Введите название" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="creationType">Тип</label>
          <select name="creationType" id="creationType" class="form-control">
            @if( $culture_sorts )

            <option value="sort">Сорт</option>

            @else

            @foreach($types as $type => $translatedType)
            <option value="{{ $type }}">{{ $translatedType }}</option>
            @endforeach

            @endif
          </select>
        </div>
        @if( $culture_sorts )
        <div class="form-group">
          <label for="creationCulture">Культура</label>
          <select class="form-control select2" multiple="multiple" data-placeholder="Для всех культур" style="width: 100%;" name="creationCulture[]" id="creationCulture" autocomplete="off">
            @foreach($cultures as $cultureId => $culture)
            <option value="{{ $cultureId }}">{{ $culture['name'] }}</option>
            @endforeach
          </select>
        </div>
        @endif
      </div>

      @else

      <div class="modal-body">
        @if($section == 'Pests' || $section == 'Diseases')
        <div class="form-group">
          <label for="creationSectionId">Секция</label>
          <select class="form-control" name="creationSectionId">
            <option value="4">Клумба</option>
            <option value="5">Огород</option>
            <option value="6">Сад</option>
          </select>
          <input type="text" class="hidden" name="creationSection" value="{{ $section }}">
        </div>
        @else
        <div class="form-group">
          <label for="creationSectionId">Секция</label>
          <input type="text" class="hidden" name="creationSection" value="{{ $section }}">
          <input type="text" class="form-control" value="{{ [
            'Pests' => 'Вредитель',
            'Diseases' => 'Заболевание',
            'Chemicals' => 'Химикат',
            'Sellers' => 'Продавец',
            'Decorators' => 'Декоратор',
            'Events' => 'Событие',
            'Handbooks' => 'Справочная информация'
            ][$section] }}" disabled autocomplete="off">
        </div>
        @endif
        <div class="form-group">
          <label for="creationName">Название</label>
          <input type="text" class="form-control" id="creationName" name="creationName" placeholder="Введите название">
        </div>
        <div class="form-group hidden">
          <label for="creationType">Тип</label>
          <input name="creationType" id="creationType" class="form-control" value="{{ [
            'Pests' => 'pest',
            'Diseases' => 'disease',
            'Chemicals' => 'chemical',
            'Sellers' => 'seller',
            'Decorators' => 'decorator',
            'Events' => 'event',
            'Handbooks' => 'handbook'
            ][$section] }}">
        </div>
      </div>
      @endif

      <div class="modal-footer">
        {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {{ Form::submit('Добавить фильтр', ['class' => 'btn btn-primary']) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="box">
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4">
        <div class="list-group" id="list-tab" role="tablist">
          <button class="btn btn-primary btn-block btn-flat" data-toggle="modal" data-target="#creationModal" style="border-radius: 0px;">Добавить новый тип фильтра</button>
          <hr>
          @foreach($attributes as $attrId => $attr)
          @if( ($culture_sorts && isset($attr['culture'])) || (!$culture_sorts) && !isset($attr['culture']) )
          <div style="display: flex;">

            <div class="input-group">
              <span class="btn input-group-addon" data-toggle="modal" data-target="#attr_{{ $attrId }}_modal"><i class="fa fa-pencil"></i></span>
              <a class="list-group-item list-group-item-action btn-block" id="list-{{ $attrId }}-list" data-toggle="list" href="#list-{{ $attrId }}" role="tab" style="border-radius: 0px;">
              @if( isset($attr['culture']) )
              {{ $attr['name'] }} (Для сортов культуры "{{ $attr['culture'] }}")
              @else
              {{ $attr['name'] }} ({{ $attr['section'] ?? $attr['type'] }})
              @endif
              {{-- {{ $attr['name'] }} ({{ $attr['section'] ?? $attr['type'] }}@if(isset($attr['culture'])) — {{ $attr['culture'] }}@endif) --}}
              </a>
            </div>

            <button class="btn btn-delete" data-toggle="modal" data-target="#delete_filter_{{ $attrId }}" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal fade" id="delete_filter_{{ $attrId }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">Подтверждение удаления</h4>
                  </div>
                  {{ Form::open(['action' => "AdminLTEController@deleteFilter", 'method' => 'delete']) }}
                  {{ csrf_field() }}
                  {{ Form::text('filter_id', $attrId, ['class' => 'hidden']) }}
                  {{ Form::text('section_id', $sectionId, ['class' => 'hidden']) }}
                  {{ Form::text('section', $section, ['class' => 'hidden']) }}
                  <div class="modal-footer">
                    {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
                    {{ Form::submit('Удалить фильтр', ['class' => 'btn btn-danger']) }}
                  </div>
                  {{ Form::close() }}
                </div>
              </div>
            </div>

          </div>

          <div class="modal fade" id="attr_{{ $attrId }}_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modalLabel">Изменить название фильтра</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                {{ Form::open(['action' => "AdminLTEController@updateFilters$section", 'method' => 'put']) }}
                {{ csrf_field() }}
                <div class="modal-body">
                  <input type="text" name="attr_id", value="{{ $attrId }}" class="hidden">
                  <div class="form-group">
                    <label for="attr_{{ $attrId }}_name">Название</label>
                    <input type="text" class="form-control" id="attr_{{ $attrId }}_name" name="attr_{{ $attrId }}_name" placeholder="Введите название" value="{{ $attr['name'] }}">
                  </div>
                </div>
                <div class="modal-footer">
                {{ Form::button('Отмена', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
                {{ Form::submit('Сохранить изменение', ['class' => 'btn btn-primary']) }}
                </div>
                {{ Form::close() }}
              </div>
            </div>
          </div>

          @endif
          @endforeach
        </div>
      </div>
      <div class="col-sm-8">
        <div class="tab-content" id="nav-tabContent">
          @foreach($attributes as $attrId => $attr)
          <div class="tab-pane fade" id="list-{{ $attrId }}" role="tabpanel">

            {{ Form::open(['action' => "AdminLTEController@createFilter$section", 'method' => 'post', 'style' => 'display: flex;']) }}
            {{ csrf_field() }}
            <input class="hidden" type="text" name="create_attr_id" value="{{ $attrId }}">
            <input class="col-sm-6 form-control" type="text" name="create_attr_val" placeholder="Введите новое значение фильтра">
            <input class="btn btn-primary btn-flat create_submin_btn" type="submit" value="Добавить" disabled="disabled">
            {{ Form::close() }}

            <hr>

            @if(! empty($values[$attrId]))
            {{ Form::open(['action' => "AdminLTEController@updateFilters$section", 'method' => 'put']) }}
            {{ csrf_field() }}
            @foreach($values[$attrId] as $valId => $value)
            <input class="hidden" type="text" name="attr_id" value="{{ $attrId }}">
            <div class="form-group" style="display: flex;">
              <input class="col-sm-8 form-control" type="text" name="attr_{{ $attrId }}_val_{{ $valId }}" value="{{ $value }}" style="margin-bottom: 10px;" autocomplete="off">
              <div class="btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-flat btn-secondary">
                  <input type="checkbox" name="attr_{{ $attrId }}_val_{{ $valId }}_delete" autocomplete="off"> Удалить
                </label>
              </div>
            </div>
            @endforeach
            {{ Form::submit('Сохранить изменения', ['class' => 'btn btn-primary', 'style' => 'float: right;']) }}
            {{ Form::close() }}
            @endif

          </div> 
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
  .btn-delete {
    border-radius: 0px;
    background-color: white;
  }
  .btn-delete:hover {
    background-color: #ac2925;
    border-color: 1px solid #761c19;
    color: white;
  }
</style>

@endsection

@section('script')
@parent
<script type="text/javascript">
$('.select2').select2();

@if($attr_id)$(document).ready(function(){document.getElementById("list-{{ $attr_id }}-list").click();});@endif


window.setTimeout(function() {
  $('.alert').slideUp('fast');
}, 2000);


$('#list-tab a').on('click', function (e) {
  e.preventDefault();
  $('#list-tab a').removeClass('active');
  $(this).addClass('active');
  $(this).tab('show');
})
$($('#list-tab a')[0]).addClass('active');
$($('#list-tab a')[0]).tab('show');

$.each($('.create_submin_btn'), function(i, submit_btn) {
  $(submit_btn).prev().on('input', function (e) {
    $(submit_btn).attr('disabled', $(submit_btn).prev()[0].value == '' ? true : false);
  });
});


$.each($('input[type="checkbox"'), function(i, checkbox) {
  $(checkbox).on('change', function () {
    if(checkbox.checked) {
      $(checkbox).parent().removeClass('btn-secondary');
      $(checkbox).parent().addClass('btn-danger');
    } else {
      $(checkbox).parent().addClass('btn-secondary');
      $(checkbox).parent().removeClass('btn-danger');
    }
  });
});
</script>
@endsection