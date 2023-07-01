<?php   
    $host = 'localhost';
    $username = 'root';
    $password = 'admin';
    $db_name = 'JusticiaLaw';
    $port = 3306;

    $conn = new mysqli($host, $username, $password, $db_name);
    $mysqli=$conn->real_connect($host, $username, $password, $db_name);

