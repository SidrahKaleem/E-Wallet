<?php   
class db_connection
{
	// to create connection with databases
	public function create_connection()
		{
		$servername = "localhost";
		$user = "root";
		$pass = "";
		$dbname = "e-wallet";
		$conn = new mysqli($servername, $user, $pass, $dbname); 	// creates connection with databases provided above
		// Check connection
		if(mysqli_connect_errno())
			{
			die("databases connection failed: ".
			mysqli_connect_error().
			" (".mysqli_connect_errno(). " )"
				);
			}
		
		return $conn;
		
		}
		
}		
?>