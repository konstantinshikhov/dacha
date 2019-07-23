@extends('admin.main')

@section('form')

<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Количество</span>
        <span class="info-box-number">{{ $users_count }}</span>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="ion ion-ios-briefcase-outline"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Продавцов</span>
        <span class="info-box-number">{{ $sellers_count }}</span>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="ion ion-ios-rose-outline"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Декораторов</span>
        <span class="info-box-number">{{ $decorators_count }}</span>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="ion ion-mic-b"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Организаторов</span>
        <span class="info-box-number">{{ $partymakers_count }}</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение тарифов</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="tariff_chart_doughnut" width="300" height="150"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение тарифов</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="tariff_chart_bar" width="300" height="150"></canvas>
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
var tariff_chart_doughnut_ctx = document.getElementById("tariff_chart_doughnut");
var tariff_chart_bar_ctx = document.getElementById("tariff_chart_bar");
var tariff_chart_doughnut_chart;
var tariff_chart_bar_chart;

$(document).ready(function() {
  tariff_chart_doughnut_chart = new Chart(tariff_chart_doughnut_ctx, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [@foreach($tariffs_count as $count){{ $count }},@endforeach],
        backgroundColor: ['#00a65a', '#dd4b39', '#00c0ef', '#a2a']
      }],
      labels: [@foreach($tariffs_count as $name => $count)'{{ $name }}',@endforeach]
    },
    options: {
      legend: {
        display: true
      }
      }
  });
  tariff_chart_bar_chart = new Chart(tariff_chart_bar_ctx, {
    type: 'bar',
    data: {
      datasets: [{
        data: [@foreach($tariffs_count as $count){{ $count }},@endforeach],
        backgroundColor: ['#00a65a', '#dd4b39', '#00c0ef', '#a2a']
      }],
      labels: [@foreach($tariffs_count as $name => $count)'{{ $name }}',@endforeach]
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