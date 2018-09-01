<?php 
class User {
	public $id; 
    public $nome;
	public $user; 
    public $pass;
	public $isAdmin;
  
 
    public function __construct(){
        	
    }
    
	public function autentica(){
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
		$query = "SELECT id, nome, user, pass, isadmin FROM USERS WHERE USER = '$user' AND PASS = '$pass'";
		mysqli_query($conn, $query);
		
		
		
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		if($row != null){
			$this->id = $row["id"];		
			$this->nome = $row["nome"];		
			$this->user = $row["user"];		
			$this->pass = $row["pass"];		
			$this->isAdmin = $row["isAdmin"];
			
			return TRUE;		
		}
		else {
			return FALSE;
		}
	}
	
}

?> 