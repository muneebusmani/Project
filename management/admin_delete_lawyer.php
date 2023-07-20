<?php
session_start();
if (isset($_POST['delete'])) {
$ID=$_SESSION['ID']= $_POST['id'];

// Create a connection to the database
$conn = user::inc_db();

//Image deletion
$sql = "SELECT Photo FROM lawyers WHERE ID = ?";
$stmt= $conn->prepare($sql);

// Bind the ID parameter to the prepared statement
$stmt->bind_param("i", $ID);

// Execute the prepared statement
$stmt->execute();
$result=$stmt->get_result();
$row=$result->fetch_assoc();
$photo=$row['Photo'];

if (file_exists($photo)) {
    echo "Delete ".(unlink($photo) ? "Yes" : "No");
}
$stmt->close();
$sql=$stmt='';


// Prepare the SQL statement for deletion
$sql = "DELETE FROM lawyers WHERE ID = ?";
$stmt = $conn->prepare($sql);

// Bind the ID parameter to the prepared statement
$stmt->bind_param("i", $ID);

// Execute the prepared statement
$stmt->execute();


// Check if the deletion was successful
if ($stmt->affected_rows > 0) {
    header('location:admin_view_lawyer');
} else {
    echo "Failed to delete entry.";
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
}