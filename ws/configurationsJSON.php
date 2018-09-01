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
	
	
	//Configurações para mudar os valores na base de dados
	$sql = "select * from configurations where id=1";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		$json = ["temp_max" => $row["tempMax"], 
				"temp_min" => $row["tempoMin"], 
				"hum_max" => $row["humMax"], 
				"hum_min" => $row["humMin"],
				"refresh_time" => 10];
		
		header('Content-type: application/json');
		echo json_encode($json);
	$conn->close();
	

?>