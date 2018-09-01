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
//query - selecionar a data e o valor mais alto da temperatura
$sql = "SELECT round(MAX(temperature), 2) as vv from history where DATE(time) = DATE(NOW())";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
header('Content-type: application/json');
$json = ["TemperatureMax" => $row["vv"]];//'{"Date":"'.$row["time"].'","TempMax":"'.$row['MAX(value)'].'"}';
//echo "Data: " .$row["time"]."<br /> Value: ".$row["MAX(value)"];
	echo json_encode($json);
$conn->close();
?>