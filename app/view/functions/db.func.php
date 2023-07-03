<?php
function inc_db()
{
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'justicialaw';
$conn = new mysqli($host, $username, $password, $db_name);
return $conn;
}

