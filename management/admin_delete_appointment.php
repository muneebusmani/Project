<?php
// Assuming you have a database connection established
// ...

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission to delete all appointments

    // Perform the deletion query
    $query = "DELETE FROM `appointments` WHERE `id` = {$_GET['id']}";
    $result = mysqli_query($conn, $query);

    ($result) ? header('location:admin_view_appointments?delete=yes'):header('location:admin_view_appointments?delete=no');
}

?>
<style>
      .wrap{
    margin: 0px auto;
    width: 30rem;
    height: 15rem;
    --margin:10%;
    margin: var(--margin) auto;
    border: 2px solid black;
    text-align: center;
  } 
</style>
<div class="wrap">
<a class='fas fa-window-close fa-lg float-right' style='color: #ff0000;' href='admin_view_lawyer'>
</a>
    <form method="post">
        <h1 class="my-3">Confirm Delete ?</h1>
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
</div>
