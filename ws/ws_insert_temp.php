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
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>