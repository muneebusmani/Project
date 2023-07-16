<?php
$config=
[
'db_host' => 'localhost',
'db_username' => 'muneeb',
'db_password' => 'muneeb8355',
'db_name' => 'JusticiaLaw'
];
$conn=new mysqli('localhost','muneeb','muneeb8355');
$sql="CREATE DATABASE  IF NOT EXISTS `JusticiaLaw`";
$conn->query($sql);
unset($conn,$sql);

$conn=new mysqli('localhost','muneeb','muneeb8355','JusticiaLaw');
$tableExists = $conn->query("SHOW TABLES LIKE 'appointments'");

if ($tableExists->num_rows == 0) {
    // Table does not exist, create it
    $createTableQuery = "CREATE TABLE appointments (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        number VARCHAR(255) NOT NULL,
        location VARCHAR(255) NOT NULL,
        lawyer_name VARCHAR(255),
        date VARCHAR(255),
        time VARCHAR(255)
    )";

    if ($conn->query($createTableQuery) === TRUE) {
        echo "Appointment table created successfully!";
    } else {
        echo "Error creating appointment table: " . $conn->error;
    }
}