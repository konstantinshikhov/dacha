@extends('admin.main')

@section('form')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-erlenmeyer-flask"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Количество</span>
        <span class="info-box-number">{{ $chemicals_count }}</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение химикатов по типу</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="chemicals_chart_bar_type" width="300" height="75"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение химикатов по производителям</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="chemicals_chart_bar_manufacturer" width="300" height="75"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
@parent
<script src="{{ asset('adminlte/asset/Chart.min.js') }}"></script>
<script type="text/javascript">
var chemicals_chart_bar_manufacturer_ctx = document.getElementById("chemicals_chart_bar_manufacturer");
var chemicals_chart_bar_type_ctx = document.getElementById("chemicals_chart_bar_type");
var chemicals_chart_bar_manufacturer_chart;
var chemicals_chart_bar_type_chart;

$(document).ready(function() {
  chemicals_chart_bar_type_chart = new Chart(chemicals_chart_bar_type_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($chemicals_count_filters['type'] as $count){{ $count }},@endforeach],
        backgroundColor: '#00a65a'
      }],
      labels: [@foreach($chemicals_count_filters['type'] as $name => $count)'{{ $name }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    }
  });
  chemicals_chart_bar_manufacturer_chart = new Chart(chemicals_chart_bar_manufacturer_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($chemicals_count_filters['manufacturer'] as $count){{ $count }},@endforeach],
        backgroundColor: '#dd4b39'
      }],
      labels: [@foreach($chemicals_count_filters['manufacturer'] as $name => $count)'{{ $name }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    }
  });
});
</script>
@endsection