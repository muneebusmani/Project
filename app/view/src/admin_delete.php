<?php
session_start();
if (isset($_POST['delete'])) {
$ID=$_SESSION['ID']= $_POST['id'];

// Create a connection to the database
$conn = inc_db();

// Prepare the SQL statement for deletion
$sql = "DELETE FROM lawyers WHERE ID = ?";
$stmt = $conn->prepare($sql);

// Bind the ID parameter to the prepared statement
$stmt->bind_param("i", $ID);

// Execute the prepared statement
$stmt->execute();

// Check if the deletion was successful
if ($stmt->affected_rows > 0) {
    header('location:admin_view');
} else {
    echo "Failed to delete entry.";
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
}