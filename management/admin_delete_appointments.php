<?php
// Assuming you have a database connection established
// ...

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission to delete all appointments

    // Perform the deletion query
    $query = "DELETE FROM appointments";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Deletion successful
        echo "All appointments have been deleted.";
    } else {
        // Deletion failed
        echo "Error deleting appointments.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete All Appointments</title>
</head>
<body>
    <h1>Delete All Appointments</h1>
    <p>Click the button below to delete all appointments.</p>

    <form method="post">
        <button type="submit">Delete All Appointments</button>
    </form>
</body>
</html>
