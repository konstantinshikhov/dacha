@extends('admin.main')

@section('form')

<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-calendar"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Количество</span>
        <span class="info-box-number">{{ $events_count }}</span>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Среднее количество участников</span>
        <span class="info-box-number">{{ $participants_avg }}</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение событий по типу</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="events_chart_bar_type" width="300" height="75"></canvas>
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
var events_chart_bar_type_ctx = document.getElementById("events_chart_bar_type");
var events_chart_bar_type_chart;

$(document).ready(function() {
  events_chart_bar_type_chart = new Chart(events_chart_bar_type_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($events_count_filters['type'] as $count){{ $count }},@endforeach],
        backgroundColor: '#00a65a'
      }],
      labels: [@foreach($events_count_filters['type'] as $name => $count)'{{ $name }}',@endforeach]
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