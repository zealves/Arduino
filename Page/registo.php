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
		
		$nome=trim($_POST['nome']);
		$username=trim($_POST['username']);
		$password=trim($_POST['password']);
		$isadmin=trim($_POST['isadmin']);

			
		$query = "INSERT INTO users (nome, user, pass, isadmin) VALUES ('$nome', '$username', '$password', '$isadmin')";
		mysqli_query($conn, $query);
		
?>

<html>
	<h1 style="color: black; font-size: 30px; float: center">Successfully Registered</h1>
	<body>
		<a href="home_page.php" style="color: blue"> Go to HomePage </a>
	</body>
</html>