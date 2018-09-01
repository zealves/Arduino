<?php	
	session_start();
	if(isset($_SESSION['id'])){
		session_write_close();
		header('Location: home_page.php');
	}
	
	$mensagem = "";
	if(isset($_POST['user']) && isset($_POST['pass'])){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
	
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
		
		$query = "SELECT id, nome, user, pass, isAdmin FROM USERS WHERE USER = '".$user."' AND PASS = '".$pass."'";
		mysqli_query($conn, $query);
			
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		if($row != null){
			session_start();
			$_SESSION['id'] = $row['id'];
			$_SESSION['admin'] = $row['isAdmin'];
			session_write_close();
			header('Location: home_page.php');
			//return TRUE;		
		} else {
			$mensagem = "Dados invalidos ".$user;
		}
	}
	session_write_close();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Index</title>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900|Quicksand:400,700|Questrial" rel="stylesheet" />
		<link href="style_teste.css" rel="stylesheet" type="text/css" media="all" />
		<link href="font.css" rel="stylesheet" type="text/css" media="all" />
		<body style="background-color: white">
			<h1 style="color:green; margin-top: 45px"; align="center">Smart Green House</h1>
			<center>
			<div id="login-form" style="margin-top: 40px">
			<form method="post" action="index.php">
			<table align="center" width="30%" border="0">
			<tr>
			<td><input type="text" name="user" placeholder="Your username" required /></td>
			</tr>
			<tr>
			<td><input type="password" name="pass" placeholder="Your Password" required /></td>
			</tr>
			<tr>
			<td><input type="submit" value="Log In"></td>
			</tr>
			</table>
			</form>
			<p style="color: red; font-size: 25px"><?php if(strlen($mensagem) > 0) echo $mensagem; ?></p>
			</div>
		</center>
		</body>
	</head>
</html>
