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
				url: 'http://localhost/~alejandrogomezrivera/attine/dashboard/CHrevD.php',
				dataType: "json",
				success: function(data1) {
					chart.series[0].setData(data1),
					$.ajax({
						url: 'http://localhost/~alejandrogomezrivera/attine/dashboard/CHrevcumD.php',
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
					//setTimeout(requestData, 5000); //refresh graph every n milli-seconds, used when graphing live data 
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

            title: {text: 'Cutterhead Revolutions'},

            subtitle: {text: 'ART - NANNIE'},
            
	    xAxis: {
                title: {text: 'Ring Number'},
                min: 0,
                max: 2045,
                //tickInterval: 100,
		
            	   },

            yAxis: [{
                title: {text: 'Revolutions (EA)'},
            	    }, 
            	    //set secondary axis
            	    {
                title: {text: 'Cumulative Revolutions (EA)'},
                opposite: true,
            	    }],

            
            plotOptions: {
            	series: {  lineWidth: 1,
            				marker: {enabled: false}
            		}
			 },
            		
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
            	name: 'Revolutions',
                 data: [],}, 
		{
            	name: 'Cumulative Revolutions',
            	yAxis: 1, //secondary axis
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