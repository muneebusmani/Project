<?php
// Check if the lawyer is logged in
if (!isset($_SESSION['lawyer_email'])) {
    // Redirect to the login page or display an error message
    header("Location: lawyer_login");
    exit;
}

// Get the lawyer's email from the session
$lawyerEmail = $_SESSION['lawyer_email'];

// Prepare the SQL statement to fetch the lawyer's name
$query = "SELECT name FROM lawyers WHERE email = ?";

// Prepare the statement
$stmt = $conn->prepare($query);

// Bind the parameter
$stmt->bind_param('s', $lawyerEmail);

// Execute the statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Fetch the lawyer's name
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lawyerName = $row['name'];
} else {
    // Handle the case if the lawyer's name is not found
    $lawyerName = "Unknown";
}

// Close the statement
$stmt->close();

// Prepare the SQL statement to fetch appointments for the lawyer by their name
$query = "SELECT * FROM appointments WHERE lawyer_name = ? and dismissed !=  ?";

// Prepare the statement
$stmt = $conn->prepare($query);

$dismissed=1;
// Bind the parameter
$stmt->bind_param('si', $lawyerName,$dismissed);

// Execute the statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Check if there are any appointments
if ($result->num_rows > 0) {
    echo 
    <<<HTML
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
    input[name="appointment_id"]{
        display:none;
    }
    </style>
    <table>
        <thead>
            <th>Appointment ID</th>
            <th>Client Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Manage</th>
        </thead>
    HTML;
    while ($row = $result->fetch_assoc()) {
        // Access appointment details using $row['column_name']
        $appointmentId = $row['id'];
        $clientName = $row['name'];
        $appointmentDate = $row['date'];
        $appointmentTime = $row['time'];
        
        // Display appointment details as needed, including the lawyer's name
        echo 
        <<<HTML
        <tr>
            <td>$appointmentId</td>
            <td>$clientName</td>
            <td>$appointmentDate</td>
            <td>$appointmentTime</td>
            <td>
            <form action="lawyer_dismiss_appointment" method="post">
                <input name="appointment_id"  value="$appointmentId">
                <input type="submit" class="btn btn-danger" name="dismiss"  value="Dismiss">
            </form>
            </td>
        </tr>
        HTML;
    }
} else {
    // No appointments found for the lawyer
    echo 
    "
    <script>
    alert('No appointments found');
    window.location.href = 'lawyer_dashboard';
    </script>
    ";
}

// Close the statement and database connection
$stmt->close();
?>
