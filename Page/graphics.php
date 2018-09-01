<?php
		
	include 'configurations.php'
	
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<title>Graphics</title>
		<script src="jquery-2.1.4.js"></script>
		<script src="canvas/jquery.canvasjs.min.js"></script>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
		<link href="style_teste.css" rel="stylesheet" type="text/css" media="all" />
		<link href="font.css" rel="stylesheet" type="text/css" media="all" />	
		<script type="text/javascript">
			$(document).ready(function () {
				mostraGrafico();
				mostraGrafico1();
				setInterval(function () {
				mostraGrafico();
				mostraGrafico1();
				}, 10000);
	
				});

			function mostraGrafico(){
				$.ajax("http://localhost/WS_ARDUINO/ws_graphics.php",{
				dataType : "json",
				success: function(data){
					var chart = new CanvasJS.Chart("chartContainer",
						{
						title:{
						text: "Graphics All Data"
						},
						data: [//array of dataSeries
						{ //dataSeries object
			
						/*** Change type "column" to "bar", "area", "line" or "pie"***/
						type: "line",
						dataPoints: data
						}
						]
						});
			
						chart.render();
						}
						});
					}


			function mostraGrafico1(){
				$.ajax("http://localhost/WS_ARDUINO/ws_graphics_day.php",{
				dataType : "json",
				success: function(data){
					var chart = new CanvasJS.Chart("chartContainer1",
						{
			
						title:{
						text: "Graphics Day"
						},
						data: [//array of dataSeries
						{ //dataSeries object
			
						/*** Change type "column" to "bar", "area", "line" or "pie"***/
						type: "line",
						dataPoints: data
						}
						]
						});
			
						chart.render();
						}
						});
					}	 
		</script>
	
	</head>
	
	<body style="background-color: white">
		
		<div id="menu" style="background-color: green" align="center">
				<ul>
					<li><a href="home_page.php" accesskey="1" title="">Homepage</a></li>
					<li class="active"><a href="graphics.php" accesskey="2" title="">Graphics Temperature</a></li>
					<li><a href="graphics_humidity.php" accesskey="3" title="">Graphics Humidity</a></li>
<?php
if ($user->isAdmin == 1){ ?>
					<li><a href="admin_area.php" accesskey="4" title="">Admin Area</a></li>
<?php } ?>
					<li><a href="gallery.php" accesskey="5" title="">Gallery</a></li>
					<li><a href="about.php" accesskey="6" title="">About</a></li>
				</ul>
				<a href="logout.php" style="color: white; float: right; margin-top: 21px; margin-right: 50px">Logout</a>
			</div>
		<br>
		<div id="chartContainer" style="width: 60%; height: 380px; margin: auto"> </div>
		<br>
		<div id="chartContainer1" style="width: 60%; height: 380px; margin: auto"> </div>
	</body>
</html>