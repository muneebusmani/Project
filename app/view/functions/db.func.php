<?php
function inc_db()
{
$host = 'localhost';
$username = 'root';
$password = 'admin';
$db_name = 'JusticiaLaw';
$conn = new mysqli($host, $username, $password, $db_name);
return $conn;
}

