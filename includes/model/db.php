<?php   
$host = 'localhost';
$username = 'root';
$password = 'admin';
$db_name = 'JusticiaLaw';
$port = 3306;

try {
    $conn = new mysqli($host, $username, $password, $db_name, $port);

    if ($conn->connect_error) {
        throw new Exception('Connection failed: ' . $conn->connect_error);
    }
    else{
        // echo 'Connected to the database!';
    }
} catch (Exception $err) {
    echo 'Error: ' . $err->getMessage();
}
?>