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
$sql = "INSERT INTO history (temperature, humidity) VALUES ('".$_GET['temperature']."','".$_GET['humidity']."')";
if ($conn->query($sql) === TRUE) {
  //  echo "New record created successfully";
} else {
  //  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql2 = "select * from configurations where id=1";
		$result2 = $conn->query($sql);
		$row2 = $result2->fetch_assoc();
		
		$json = ["temp_max" => $row["tempMax"], 
				"temp_min" => $row["tempoMin"], 
				"hum_max" => $row["humMax"], 
				"hum_min" => $row["humMin"],
				"refresh_time" => 10];
		
		header('Content-type: application/json');
		echo json_encode($json);
		
		
$conn->close();
?>
