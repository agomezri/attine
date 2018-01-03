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

    var chart;
       function requestData() {
			$.ajax({
				url: 'http://localhost/~alejandrogomezrivera/attine/dashboard/torqueD.php',
				dataType: "json",
				success: function(data) {
					chart.series[0].setData(data);
					//setTimeout(requestData, 60000); //refresh graph every 60 seconds, used when graphing live data 
				},
			   });
			 }

			 
      $(document).ready(function() {
        chart = new Highcharts.Chart({
            
            chart: {
                renderTo: 'container',
                type: 'spline',
                zoomType: 'x',
                events: {load: requestData}
            },
            
            title: {
                text: 'Average Cutterhead Torque'
            },
            
            subtitle: {
                text: 'ART - NANNIE'
            },
            
            xAxis: {
                title: {text: 'Ring Number'},
                min: 0,
                max: 2045,
                //tickInterval: 100,
                    
            },
            
            yAxis: {
                title: {text: 'Torque (MNm)'},
                //min: 00,
                //max: 10,
                //tickInterval: 2,
            },
            
            plotOptions: {
            	series: {  lineWidth: .5,
            				marker: {enabled: false}
            				}},
            		
            scrollbar: {
			barBackgroundColor: 'gray',
			barBorderRadius: 7,
			barBorderWidth: 0,
			buttonBackgroundColor: 'gray',
			buttonBorderWidth: 0,
			buttonArrowColor: 'yellow',
			buttonBorderRadius: 7,
			rifleColor: 'yellow',
			trackBackgroundColor: 'white',
			trackBorderWidth: 1,
			trackBorderColor: 'silver',
			trackBorderRadius: 7
	    },
	    
	    	rangeSelector: {selected: 1},
	    
            series: [{
            	name: 'Torque (MNm)',
                 data: [],
            }]
        });
    });
    
 
</script>

</head>
<body>

<div id="container" style="width: 100%; height: 100%; position:absolute; margin: 0 auto"></div>
					
</body>
</html>