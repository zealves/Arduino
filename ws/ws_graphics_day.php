<?php
$servername = "localhost";
$username = "admin";
$password = "123";
$dbname = "projecto";
header('Content-Type: application/json');

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
}else
{
    $data_points = array();
    $result = mysqli_query($con, "SELECT date(time) as temp,  temperature FROM `history` WHERE date(time) = date(now())");
	//Para o dia atual(SELECT * FROM `sensor` WHERE date(time) = date(now()))
    
    while($row = mysqli_fetch_array($result))
    {        
        $point = array("label" => $row['temp'] , "y" => floatval ($row['temperature']));
        array_push($data_points, $point); 
		
    }
    
    echo json_encode($data_points);

}
mysqli_close($con);

?>