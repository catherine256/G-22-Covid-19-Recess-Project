@extends('layouts.app')

@section('content')
<br><br>

<div style="margin-left:10%">
<div class="pull-right">
  <a href="home" title="Go Back TO Home"><button class="btn btn-success">Go Back</button> </a>
</div>

<h2 style="text-align: center;">A bar graph showing treasury registered in a given month</h2>
    <div class="container-fluid p-5">
    <div id="barchart_material" style="width: 100%; height: 500px;"></div>
    </div>
 
    <script type="text/javascript">
 
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
 
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['donor', 'amount'],
 
            @php
              foreach($treasury as $treasurys) {
                  echo "['".$treasurys->donor."', ".$treasurys->amount.",],";
              }
            @endphp
        ]);
 
        var options = {
          chart: {
            title: 'Bar Graph | amount',
            subtitle: 'A graph showing amount, and donor:',
          },
          bars: 'vertical'
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    
    <div class="pull-right">
  <a href="hospital_graph" title="check hospital graph"><button class="btn btn-success">Hospital Graph</button> </a>
</div>
</div>

@endsection
