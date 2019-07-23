@extends('admin.main')

@section('form')

<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon" style="background-color: #dd4b39;"><i class="ion ion-bug"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Количество вредителей</span>
        <span class="info-box-number">{{ $klumba_pest_count + $ogorod_pest_count + $sad_pest_count }}</span>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon" style="background-color: #dd4b39;"><i class="ion ion-leaf"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Количество заболеваний</span>
        <span class="info-box-number">{{ $klumba_disease_count + $ogorod_disease_count + $sad_disease_count }}</span>
      </div>
    </div>
  </div>
</div>

<!-- Culture statistics -->
<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение вредителей по культурам секции "Клумба"</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="klumba_pests_chart_bar" width="300" height="125"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение заболеваний по культурам секции "Клумба"</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="klumba_diseases_chart_bar" width="300" height="125"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End culture statistics -->
<hr>
<!-- Ogorod statistics -->
<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение вредителей по культурам секции "Огород"</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="ogorod_pests_chart_bar" width="300" height="125"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение заболеваний по культурам секции "Огород"</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="ogorod_diseases_chart_bar" width="300" height="125"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Ogorod statistics -->
<hr>
<!-- Sad statistics -->
<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение вредителей по культурам секции "Сад"</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="sad_pests_chart_bar" width="300" height="125"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box">
      <div class="box-header with-border text-center">
        <h3 class="box-title">Соотношение заболеваний по культурам секции "Сад"</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="sad_diseases_chart_bar" width="300" height="125"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End sad statistics -->

@endsection

@section('script')
@parent
<script src="{{ asset('adminlte/asset/Chart.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  /* Klumba statistics */
  var klumba_pests_chart_bar_ctx = document.getElementById("klumba_pests_chart_bar");
  var klumba_diseases_chart_bar_ctx = document.getElementById("klumba_diseases_chart_bar");
  var klumba_pests_chart_bar_chart;
  var klumba_diseases_chart_bar_chart;

  klumba_pests_chart_bar_chart = new Chart(klumba_pests_chart_bar_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($klumba_pest_count_cultures as $count){{ $count }},@endforeach],
        backgroundColor: '#a95f8a'
      }],
      labels: [@foreach($klumba_pest_count_cultures as $culture => $count)'{{ $culture }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  klumba_diseases_chart_bar_chart = new Chart(klumba_diseases_chart_bar_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($klumba_disease_count_cultures as $count){{ $count }},@endforeach],
        backgroundColor: '#a95f8a'
      }],
      labels: [@foreach($klumba_disease_count_cultures as $culture => $count)'{{ $culture }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  /* End klumba statistics */

  /* Ogorod statistics */
  var ogorod_pests_chart_bar_ctx = document.getElementById("ogorod_pests_chart_bar");
  var ogorod_diseases_chart_bar_ctx = document.getElementById("ogorod_diseases_chart_bar");
  var ogorod_pests_chart_bar_chart;
  var ogorod_diseases_chart_bar_chart;

  ogorod_pests_chart_bar_chart = new Chart(ogorod_pests_chart_bar_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($ogorod_pest_count_cultures as $count){{ $count }},@endforeach],
        backgroundColor: '#f39a24'
      }],
      labels: [@foreach($ogorod_pest_count_cultures as $culture => $count)'{{ $culture }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  ogorod_diseases_chart_bar_chart = new Chart(ogorod_diseases_chart_bar_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($ogorod_disease_count_cultures as $count){{ $count }},@endforeach],
        backgroundColor: '#f39a24'
      }],
      labels: [@foreach($ogorod_disease_count_cultures as $culture => $count)'{{ $culture }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  /* End ogorod statistics */

  /* Sad statistics */
  var sad_pests_chart_bar_ctx = document.getElementById("sad_pests_chart_bar");
  var sad_diseases_chart_bar_ctx = document.getElementById("sad_diseases_chart_bar");
  var sad_pests_chart_bar_chart;
  var sad_diseases_chart_bar_chart;

  sad_pests_chart_bar_chart = new Chart(sad_pests_chart_bar_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($sad_pest_count_cultures as $count){{ $count }},@endforeach],
        backgroundColor: '#179e36'
      }],
      labels: [@foreach($sad_pest_count_cultures as $culture => $count)'{{ $culture }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  sad_diseases_chart_bar_chart = new Chart(sad_diseases_chart_bar_ctx, {
    type: 'horizontalBar',
    data: {
      datasets: [{
        data: [@foreach($sad_disease_count_cultures as $count){{ $count }},@endforeach],
        backgroundColor: '#179e36'
      }],
      labels: [@foreach($sad_disease_count_cultures as $culture => $count)'{{ $culture }}',@endforeach]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{ticks: {beginAtZero:true}}]
      }
    },
  });
  /* End sad statistics */

});
</script>
@endsection