@extends('layouts.common')

@section('content')
<br><br>

<div style="">
<h2 style="text-align: center;">A bar graph showing treasury registered in a by Donors</h2>
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
            title: 'A bar graph showing amount and donor name:',
          },
          bars: 'vertical'
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
</div>
@endsection
