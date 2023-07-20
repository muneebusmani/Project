<?php
// Check if the lawyer is logged in
if (!isset($_SESSION['lawyer_email'])) {
    // Redirect to the login page or display an error message
    header("Location: lawyer_login");
    exit;
}

// Assuming you have established a database connection using MySQLi object-oriented syntax

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the appointment dismissal form is submitted
    if (isset($_POST['dismiss'])) {
        // Get the appointment ID from the form
        $appointmentId = $_POST['appointment_id'];

        // Prepare the SQL statement to dismiss the appointment
        $query = "UPDATE appointments SET dismissed = 1 WHERE id = ?";

        // Prepare the statement
        $stmt = $conn->prepare($query);

        // Bind the parameter
        $stmt->bind_param('i', $appointmentId);

        // Execute the statement
        if ($stmt->execute()) {
            // Dismissal successful
            echo "<script>alert('Appointment dismissed successfully')</script>";
        } else {
            // Error occurred while dismissing the appointment
            echo "<script>alert('Failed to dismiss appointment')</script>";
        }

        // Close the statement
        $stmt->close();
    }
}

// Redirect to the appointment page
header("Location: lawyer_appointments");
exit;
?>
