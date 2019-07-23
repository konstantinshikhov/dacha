@extends('admin.main')

@section('form')

<div class="row">
  <div class="col-md-3 col-sm-3 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-ios-help-outline"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Количество</span>
        <span class="info-box-number">{{ $questions_count }}</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="ion ion-ios-close-outline"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Открытых</span>
        <span class="info-box-number">{{ $questions_count_open }}</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="ion ion-ios-checkmark-outline"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Закрытых</span>
        <span class="info-box-number">{{ $questions_count_closed }}</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-3 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="ion ion-ios-circle-outline"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Без ответов</span>
        <span class="info-box-number">{{ $questions_count_without_comments }}</span>
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
          <canvas id="questions_chart_doughnut_moderator" width="300" height="150"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение по секциям</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="questions_chart_bar_type" width="300" height="150"></canvas>
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
var questions_chart_doughnut_moderator_ctx = document.getElementById("questions_chart_doughnut_moderator");
var questions_chart_bar_type_ctx = document.getElementById("questions_chart_bar_type");
var questions_chart_doughnut_moderator_chart;
var questions_chart_bar_type_chart;

$(document).ready(function() {
  questions_chart_doughnut_moderator_chart = new Chart(questions_chart_doughnut_moderator_ctx, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [{{ $questions_count_accepted }}, {{ $questions_count_new }}],
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
  questions_chart_bar_type_chart = new Chart(questions_chart_bar_type_ctx, {
    type: 'bar',
    data: {
      datasets: [{
        data: [{{ $klumba_questions_count }}, {{ $ogorod_questions_count }}, {{ $sad_questions_count }}],
        backgroundColor: ['#a95f8a', '#f39a24', '#179e36']
      }],
      labels: ['Клумба', 'Огород', 'Сад']
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