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
				url: 'http://localhost/~alejandrogomezrivera/attine/dashboard/rPi_liveD1.php',
				dataType: "json",
				success: function(data1) {
					chart.series[0].setData(data1),
					$.ajax({
						url: 'http://localhost/~alejandrogomezrivera/attine/dashboard/rPi_liveD2.php',
						dataType: "json",
						success: function(data2) {
							chart.series[1].setData(data2)}});
					
					//$.ajax({
						//url: 'http://localhost/attine/face1D.php',
						//dataType: "json",
						//success: function(data3) {
							//chart.series[2].setData(data3)}});

					//$.ajax({
						//url: 'http://localhost/attine/face4D.php',
						//dataType: "json",
						//success: function(data4) {
							//chart.series[3].setData(data4)}});

					
					//To add more series insert additional ajax functions here....
					setTimeout(requestData, 5000); //refresh graph every n milli-seconds, used when graphing live data 
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
                type: 'datetime',
                dateTimeLabelFormats: {
				minute: '%Y-%m-%d<br/>%H:%M:%S',
				hour: '%Y-%m-%d<br/>%H:%M',
				day: '%Y<br/> %m-%d',
				week: '%Y<br/> %m-%d'
					},
		labels: {}
		
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
            	name: 'Temperature 1',
                 data: [],}, 
		{
            	name: 'Temperature 2',
                 data: [] }  //, }, 
		//{
          //  	name: 'Top Sensor',
            //     data: [], },
		//{
          //  	name: 'Ambient Sensor',
            //     data: [] }
            ]
        
        
        });
    });
    
 
</script>

</head>
<body>

<div id="container" style="width: 100%; height: 100%; position:absolute; margin: 0 auto"></div>
					
</body>
</html>