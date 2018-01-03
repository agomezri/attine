<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
 

<title>Attine - ART Example</title>

<!-- needed for requestData() function -->
<script type="text/javascript" src="highcharts/jquery-3.2.1.min.js" ></script>

<!-- Highcharts library -->
<script src="highcharts/highcharts.js"></script>
<script src="highcharts/modules/exporting.js"></script>  <!-- allows exporting chart to other formats (e.g. image or pdf) -->
<script src="highcharts/themes/dark-blue.js"></script>

<script type="text/javascript">


$(document).ready(function() {

    var options = {
        chart: {
            renderTo: 'container',
            type: 'spline'
        },
        xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: {
				minute: '%Y-%m-%d<br/>%H:%M:%S',
				hour: '%Y-%m-%d<br/>%H:%M',
				day: '%Y<br/> %m-%d',
				week: '%Y<br/> %m-%d'
					},
		labels: {}
            	   },
            	   
        series: [{}]
    };
	
	
// https://stackoverflow.com/questions/26833393/highcharts-spline-with-multiple-series-update-every-few-seconds
    var chart = null;
  	function callAjax(){
    $.getJSON('http://localhost/~alejandrogomezrivera/attine/dashboard/liveD1.php', function(data) {
	 	
	 	if (chart === null){
        options.series = data;
        chart = new Highcharts.Chart(options);
		}else {
        var seriesOneNewPoint = data[0].data[0];
        var seriesTwoNewPoint = data[1].data[0];
        chart.series[0].addPoint(seriesOneNewPoint, false, false);
        chart.series[1].addPoint(seriesTwoNewPoint, true, false);
      }
      setTimeout(callAjax, 5000);
    });
  }
  callAjax();

});


</script>

</head>
<body>

<div id="container" style="width: 100%; height: auto; position:absolute; margin: 0 auto"></div>
					
</body>
</html>