<?php
		
	include 'configurations.php';
	if($user->isAdmin == 0){
		header('Location: home_page.php');
	}
	
	//Configurações para mudar os valores na base de dados
	if(isset($_POST['tempMax'])){

		$query = "UPDATE `configurations` SET `tempMax`=".$_POST['tempMax'].",`tempoMin`=".$_POST['tempoMin'].",`humMax`=".$_POST['humMax'].",`humMin`=".$_POST['humMin']." WHERE id=1";
		$result = $conn->query($query);	
	
	}
	//Query à BD para alterar os valores
	$query = "SELECT * FROM configurations where id = 1";		
		
	$result = $conn->query($query);
	$conf = $result->fetch_assoc();	

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<title>Admin Area</title>
		<script src="jquery-2.1.4.js"></script>
		<script src="canvas/jquery.canvasjs.min.js"></script>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
		<link href="style_teste.css" rel="stylesheet" type="text/css" media="all" />
		<link href="font.css" rel="stylesheet" type="text/css" media="all" />
		<script>
			$(document).ready(function(){
				$("#btnConfigurar").click(function(){
					$("#configurations").toggle();
				});
				$("#btnRegistar").click(function(){
					$("#register").toggle();
				});
			});
		</script>	
	</head>			
		
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
				<li><a href="gallery.php" accesskey="5" title="">Gallery</a></li>
				<li><a href="about.php" accesskey="6" title="">About</a></li>
			</ul>
			<a href="logout.php" style="color: white; float: right; margin-top: 21px; margin-right: 50px">Logout</a>
		</div>
			
		<div>
			<button id="btnRegistar" class="btnRegistar" style="margin-left: 30px; margin-top: 50px; background: green">Register new user</button>
			<div id="register" style="display: none">	
			<form method="post" action="registo.php">
			<table align="center" width="30%" border="0">
			<caption style="font-size: 20px; color: green"><em><b>Register new user</b></em></caption>
			<tr>
			<td><input type="text" name="nome" placeholder="Your name" required /></td>
			</tr>
			<tr>
			<td><input type="text" name="username" placeholder="Your username" required /></td>
			</tr>
			<tr>
			<td><input type="password" name="password" placeholder="Your Password" required /></td>
			</tr>
			<tr>
			<td><input type="radio" name="isadmin" value="1"/><b>Admin</b></td>
			</tr>
			<tr>
			<td><input type="radio" name="isadmin" value="0"/><b>Visitor</b></td>
			</tr>
			<tr>
			<td><input type="submit" value="Register"></td>
			</tr>
			</table>
			</form>
			</div>
		</div>

			<button id="btnConfigurar" class="btnConfigurar" style="margin-left: 30px; margin-top: 30px; background: green">Configurations</button>
			<div id="configurations" style="display: none">
				<form action="admin_area.php" method="post">
					<table align="center" width="30%" border="0">
					<caption style="font-size: 20px; color: green"><em><b>Configurations</b></em></caption>
					<tr>
					<td><label><b>Temperature Max</b></label><input type="number" name="tempMax" value="<?php echo $conf['tempMax'] ?>"/></td>
					</tr>
					<tr>
					<td><label><b>Temperature Min</b></label><input type="number" name="tempoMin" value="<?php echo $conf['tempoMin'] ?>"/></td>
					</tr>
					<tr>
					<td><label><b>Humidity Max</b></label><input type="number" name="humMax" value="<?php echo $conf['humMax'] ?>"/></td>
					</tr>
					<tr>
					<td><label><b>Humidity Min</b></label><input type="number" name="humMin" value="<?php echo $conf['humMin'] ?>"/></td>
					</tr>
					<tr>
					<td><input type="submit" value="Save"/></td>
					</tr>
				</form>
			</div>
	</body>
</html>