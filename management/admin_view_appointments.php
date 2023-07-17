<style>
        .btn {
        width: 5rem;
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>
<?php
if(isset($_GET['delete'])   &&  $_GET['delete']=='yes' ){
    echo 
    "
    <script>
        alert('Appointment Deleted');
        window.location.href = 'admin_view_appointments';
    </script>
    ";
}
elseif(isset($_GET['delete'])   &&  $_GET['delete']=='no'){
    echo 
    "
    <script>
        alert('Deletion unsuccessful');
        window.location.href = 'admin_view_appointments';
    </script>
    ";
}
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
                    <th class='text-center'>Date</th>
                    <th class='text-center'>Time</th>
                    <th class='text-center'>Manage</th>
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
        <td class='text-center'>{$row['date']}</td>
        <td class='text-center'>{$row['time']}</td>
        <td class='text-center'>
        <a class='btn btn-success' href='admin_update_appointment?id={$row['id']}'>Update</a>
        <a class='btn btn-danger'  href='admin_delete_appointment?id={$row['id']}'>Delete</a>
        </td>
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
    header('location:admin_view_lawyer?appointments=none');
}
?>
