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
	// Insere
	$message = "";
		if(isset($_GET['temperature'])){
			$sql = "INSERT INTO history (temperature, humidity) VALUES ('".$_GET['temperature']."',50)";
			if ($conn->query($sql) === TRUE) {
		    $message = "New record created successfully";
			} else {
			    $message =  "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	
	// Lista configurações 
	$sql = "select * from configurations where id=1";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if(strlen($message) == 0)
			$message = "OK";
		$json = ["temp_max" => $row["tempMax"], 
				"temp_min" => $row["tempoMin"], 
				"hum_max" => $row["humMax"], 
				"hum_min" => $row["humMin"],
				"refresh_time" => 10,
				"message" => $message];
		
		header('Content-type: application/json');
		echo json_encode($json);
	$conn->close();
?>