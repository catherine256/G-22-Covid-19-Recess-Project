@extends('layouts.common')

@section('content')
<br><br>

<div style="">
<h2 style="text-align: center;">A bar graph showing the distribution of covid-19 health officers in given hospitals</h2>
    <div class="container-fluid p-5">
    <div id="barchart_material" style="width: 100%; height: 500px;"></div>
    </div>
 
    <script type="text/javascript">
 
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
 
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Hospital Name', 'Number of health officers'],
 
            @php
              foreach($hospitals as $hospital) {
                  echo "['".$hospital->name."', ".$hospital->number_of_health_officers.",],";
              }
            @endphp
        ]);
 
        var options = {
          chart: {
            title: 'A graph showing the distribution of covid-19 health officers in a given hospital: ',
          },
          bars: 'vertical'
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

</div>
@endsection