<?php
// Fetch the appointments from the database
$query = "SELECT * FROM appointments";
$result = $conn->query($query);

// Check if there are any appointments
if ($result->num_rows > 0) {
    echo "<h1 class='text-center py-5'>Appointments</h1>
    <div class='table-responsive'>
        <table class='table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Location</th>
                    <th>Lawyer Name</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
        <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo 
        "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['number']}</td>
        <td>{$row['location']}</td>
        <td>{$row['lawyer_name']}</td>
        <td>{$row['date']}</td>
        <td>{$row['time']}</td>
        </tr>
        "
        ;
    }
    echo 
    "</tbody>
     </table>
     </div>
     ";
} else {
    header('location:admin_view?appointments=none');
}
?>
