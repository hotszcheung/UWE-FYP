<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

/*try {
    $conn = new PDO("mysql:host=$servername;dbname=test1", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
	echo "<br>";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
*/
function ConnectDB(){
	$mysqli = new mysqli("localhost", "root", "287730849", "test1") or die("Cannot connect to database server! Please check the connection.");
return $mysqli;
}



?>