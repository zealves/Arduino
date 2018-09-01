<?php
	session_start();
	if(!isset($_SESSION['id'])){
		session_write_close();
		header('Location: index.php');
	}
	
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
	
	$query = "SELECT * FROM USERS WHERE id = '".$_SESSION['id']."'";		
		
	$result = $conn->query($query);
	$user = $result->fetch_object();	
	
?>
