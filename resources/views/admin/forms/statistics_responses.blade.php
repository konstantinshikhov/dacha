@extends('admin.main')

@section('form')

<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-ios-chatboxes"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Количество</span>
        <span class="info-box-number">{{ $responses_count }}</span>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-ios-star-half"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Средняя оценка</span>
        <span class="info-box-number">{{ $rating_avg }}</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение по статусу модерации</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="responses_chart_doughnut_moderator" width="300" height="150"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение по типу</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="responses_chart_bar_type" width="300" height="150"></canvas>
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
var responses_chart_doughnut_moderator_ctx = document.getElementById("responses_chart_doughnut_moderator");
var responses_chart_bar_type_ctx = document.getElementById("responses_chart_bar_type");
var responses_chart_doughnut_moderator_chart;
var responses_chart_bar_type_chart;

$(document).ready(function() {
  responses_chart_doughnut_moderator_chart = new Chart(responses_chart_doughnut_moderator_ctx, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [{{ $responses_count_accepted }}, {{ $responses_count_new }}],
        backgroundColor: ['#00a65a', '#dd4b39']
      }],
      labels: ['Принято', 'Новые']
    },
    options: {
      legend: {
        display: true
      }
    }
  });
  responses_chart_bar_type_chart = new Chart(responses_chart_bar_type_ctx, {
    type: 'bar',
    data: {
      datasets: [{
        data: [@foreach($responses_count_types as $count){{ $count }},@endforeach],
        backgroundColor: '#f39c12'
      }],
      labels: [@foreach($responses_count_types as $type => $count)'{{ $type }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        yAxes: [{ticks: {beginAtZero:true}}]
      }
    }
  });
});
</script>
@endsection