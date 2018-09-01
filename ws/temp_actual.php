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
	//query - selecionar temperatura actual
	$sql = "select temperature from history order by id desc limit 1";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	header('Content-type: application/json');
	$json = ["Temperature" => $row["temperature"]];//'{"Date":"'.$row["time"].'","TempMax":"'.$row['MAX(value)'].'"}';
	//echo "Data: " .$row["time"]."<br /> Value: ".$row["MAX(value)"];
		echo json_encode($json);
	$conn->close();
?>