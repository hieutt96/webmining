<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
</head>
<style type="text/css">
	.highcharts-tooltip h3 {
	    margin: 0.3em 0;
	}
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<body>
	<div id="container" style="height: 400px; min-width: 310px; max-width: 600px; margin: 0 auto">
		
	</div>
	<script type="text/javascript">
		Highcharts.chart('container', {

		  chart: {
		    type: 'bubble',
		    plotBorderWidth: 1,
		    zoomType: 'xy'
		  },

		  legend: {
		    enabled: false
		  },

		  title: {
		    text: 'Chart'
		  },

		  tooltip: {
		    useHTML: true,
		    headerFormat: '<table>',
		    pointFormat: '<tr><th colspan="2"><h3>{point.country}</h3></th></tr>' +
		      '<tr><th>Fat intake:</th><td>{point.x}g</td></tr>' +
		      '<tr><th>Sugar intake:</th><td>{point.y}g</td></tr>' +
		      '<tr><th>Obesity (adults):</th><td>{point.z}%</td></tr>',
		    footerFormat: '</table>',
		    followPointer: true
		  },

		  plotOptions: {
		    series: {
		      dataLabels: {
		        enabled: true,
		        format: '{point.name}'
		      }
		    }
		  },

		  series: [{
		    data: <?php echo $data; ?>
		  }]

		});
		function random() {
			return Math.floor(Math.random() * 100);
		}
	</script>
</body>
</html>