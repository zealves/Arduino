<?php
		
	include 'configurations.php'
	
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<title>Gallery</title>
		<script src="jquery-2.1.4.js"></script>
		<script src="canvas/jquery.canvasjs.min.js"></script>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
		<link href="style_teste.css" rel="stylesheet" type="text/css" media="all" />
		<link href="font.css" rel="stylesheet" type="text/css" media="all" />	
		
	<body style="background-color: white">
		
		<div id="menu" style="background-color: green" align="center">
				<ul>
					<li><a href="home_page.php" accesskey="1" title="">Homepage</a></li>
					<li><a href="graphics.php" accesskey="2" title="">Graphics Temperature</a></li>
					<li><a href="graphics_humidity.php" accesskey="3" title="">Graphics Humidity</a></li>
<?php
if ($user->isAdmin == 1){ ?>
					<li><a href="admin_area.php" accesskey="4" title="">Admin Area</a></li>
<?php } ?>
					<li  class="active"><a href="gallery.php" accesskey="5" title="">Gallery</a></li>
					<li><a href="about.php" accesskey="6" title="">About</a></li>
				</ul>
				<a href="logout.php" style="color: white; float: right; margin-top: 21px; margin-right: 50px">Logout</a>
			</div>
	</body>
</html>