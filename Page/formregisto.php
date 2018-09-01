<?php
	
	$servername = "localhost";
	$username = "admin";
	$password = "123";
	$dbname = "projecto";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	if(isset($_POST['isadmin']))
	{
		echo "Checkbox marcado! <br/>";
		echo "valor: " . $_POST['isadmin'];
	}
	else
	{
		
	}
		
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>Register</title>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
		<link href="style_teste.css" rel="stylesheet" type="text/css" media="all" />
		<link href="font.css" rel="stylesheet" type="text/css" media="all" />	
		<script>
		</script>
		<body style="background: white">
			<center>
			<div id="login-form">
			<form method="post" action="registo.php">
			<table align="center" width="30%" border="0">
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
			<td><input type="radio" name="isadmin" value="1"/>Admin</td>
			</tr>
			<tr>
			<td><input type="radio" name="isadmin" value="0"/>Visitor</td>
			</tr>
			<tr>
			<td><input type="submit" value="Register"></td>
			</tr>
			</table>
			</form>
			</div>
		</center>
		</body>
	</head>
</html>
