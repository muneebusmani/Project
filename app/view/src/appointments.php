<?php
user::load_header_u();
echo '
<style>
    .wrap{
        margin-top:10rem;
    }
    table{
        text-align: center;
        width: 100%;
    }
    td,th{
        border: 2px  solid black;
        padding: 1rem;
    }
</style>
<div class="wrap">
<h1 class="text-center my-5">Upcoming Appointments</h1>';
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or display an error message
    header("Location: signin");
    exit;
}

// Get the username from the session
$username = $_SESSION['username'];

// Assuming you have established a database connection using MySQLi object-oriented syntax

// Prepare the SQL statement
$query = "SELECT * FROM appointments WHERE `name` = ?";

// Prepare the statement
$stmt = $conn->prepare($query);

// Bind the parameter
$stmt->bind_param('s', $username);

// Execute the statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Check if there are any appointments
if ($result->num_rows > 0) {
    echo "<table>
          <tr>
            <th>Appointment ID</th>
            <th>Lawyer</th>
            <th>Date</th>
            <th>Time</th>
          </tr>";

    // Fetch appointments and display them
    while ($row = $result->fetch_assoc()) {
        // Access appointment details using $row['column_name']
        $appointmentId   = $row['id'];
        $lawyer          = $row['lawyer_name'];
        $appointmentDate = $row['date'];
        $appointmentTime = $row['time'];

        // Display appointment details in the table
         echo 
         "
         <tr>
         <td>$appointmentId</td>
         <td>$lawyer</td>
         <td>$appointmentDate</td>
         <td>$appointmentTime</td>
         </tr>
         ";
    }

    echo '</table>';
} else {
    // No appointments found for the user
    echo 
    "<script>
    alert('no appointments going on!');
    window.location.href = 'user_profile';
    </script>";
}

// Close the statement and database connection
$stmt->close();
?>
</div>