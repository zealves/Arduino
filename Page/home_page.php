<?php
		
	include 'configurations.php'
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Home Page</title>
	<script src="jquery-2.1.4.js"></script>	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

	
	<script>
			// jQuery
			$(document).ready(function () {
				setInterval(function () {
				getTempActual();
				getTempMax();
					}, 10000);
				$("#tools").hide();
				$("#b_configuracoes").click(function () {
					$("#tools").show();			
				});
			});
			
		</script>
		<script>
			function getTempActual(){
				$.ajax({
				    url: "http://localhost/WS_ARDUINO/temp_actual.php",
				    dataType:'json',
				    success:function(response)
				    {
				        $('#tempAtual').html("<b>Current Temperature: </b>"+ response.Temperature +" ºC");
				    }
				    });
			}
			
			function getTempMax(){
					$.ajax({
					url: "http://localhost/WS_ARDUINO/temp_max.php",
					dataType:'json',
					success:function(response)
					{
						$('#tempMax').html("<b>Maximum Temperature: </b>"+ response.TemperatureMax +" ºC");
					}
					});
			}
		</script>	
	
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
	<link href="style_teste.css" rel="stylesheet" type="text/css" media="all" />
	<link href="font.css" rel="stylesheet" type="text/css" media="all" />
	
	</head>
	<body>
	<div id='cssmenu'>
		<div id="header" class="container">
			<div id="logo" style="margin: -100px">
				<a href="logout.php" style="color: white; float: right; margin-right: 50px">Logout</a>
				<p style="float: left; margin-left: 50px; color: white">Bem Vindo: <?php echo $user->Nome ?></p>
	        	<img src="logo.jpg">
				<h1><a href="#">SmartGreenHouse</a></h1>
				<br>
				<br>
			</div>
			</div>
			<div id="cssmenu" style="width: 64.8%; height: 50px; margin: 0 auto;">
				<ul>
					<li class="active"><a href="home_page.php" accesskey="1" title="">Homepage</a></li>
					<li><a href="graphics.php" accesskey="2" title="">Graphics Temperature</a></li>
					<li><a href="graphics_humidity.php" accesskey="3" title="">Graphics Humidity</a></li>
<?php
if ($user->isAdmin == 1){ ?>
					<li><a href="admin_area.php" accesskey="4" title="">Admin Area</a>
					<ul>
         <li class='has-sub'><a href='#'><span>Register New User</span></a>
		  <li class='has-sub'><a href='#'><span>Configurations</span></a>
        
      </ul>
	  </li>
	  </li>
	  </li>
<?php } ?>
					<li><a href="gallery.php" accesskey="5" title="">Gallery</a></li>
					<li><a href="about.php" accesskey="6" title="">About</a></li>
				</ul>
			</div>
		
	</div>
	
	
	<div class="wrapper">
		<div id="infos" class="container"> </div>
		<div id="welcome" class="container">
	   
	<div id="infos">
		<h2>Results of the day:</h2><br />
		<br>
		<div id="dados" style="color:black; font-size: 20px"> 
			<p id="tempAtual"><?php 
			$sql = "select temperature from history order by id desc limit 1";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();			
			echo "<b>Current Temperature: </b>" .$row["temperature"]. " ºC";
			?></p>
			
			<p id="tempMax"><?php 
			$sql = "SELECT round(MAX(temperature), 2) as vv from history where DATE(time) = DATE(NOW())";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();		
			echo "<b>Maximum Temperature: </b>"   .$row["vv"]. " ºC";
			?></p>
			
			<p id="tempHumidty"><?php
			$sql = "select humidity from history order by id desc limit 1";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();		
			echo "<b>Current Humidity: </b>" .$row["humidity"]. " %";
			?></p>	
		</div>
	</div>
	<br>
	<hr/>
	<div class="title">
		<br>
		  <h2>Welcome to our website</h2>
			</div>
			<p>Welcome to the website of <b>Smart GreenHouse!</b> Here you can view all the kind of information<br> 
				in respect of a greenhouse as well as change the basic settings (temperature, humidity, etc ...).<br>
				If you have a greenhouse and want to make it intelligent contact us. Have fun :) </p>
		</div>
				</div>

				<div id="footer">
					<div class="container">
						<div class="fbox1">
						<img src="estg.png" style="width: 100px; height: 100px"></img>
						<br>
							<span>Escola Superior de Tecnologia e Gestão
							<br />Viana do Castelo</span>
						</div>
						<div class="fbox1">
							<img src="telefone.png" style="width: 100px; height: 100px"></img>
							<br>
							<span>
								Phone: 917464516
							</span>
						</div>
						<div class="fbox1">
							<img src="email.png" style="width: 100px; height: 100px"></img>
							<br>
							<span>angelorocha@ipvc.pt<br>jose.alves@ipvc.pt</span>
						</div>
					</div>
				</div>
				<div id="copyright">
					<p style="color: white">&copy; SmartGreenHouse. All rights reserved.</p>
				</div>
	</body>
</html>