<?php
// Check if the user is logged in
if (!isset($_SESSION['lawyer_email'])) {
    // Redirect to the login page or display an error message
    header("Location: lawyer_signin");
    exit;
}

// Get the lawyer_email from the session
$lawyer_email = $_SESSION['lawyer_email'];


// Prepare the SQL statement
$query = "SELECT * FROM `lawyers` WHERE `email` = ?";

// Prepare the statement
$stmt = $conn->prepare($query);

// Bind Parameters
$stmt->bind_param('s',$lawyer_email);

// Execute the statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Fetch the results into an associative array
$row = $result->fetch_assoc();

// Update the session variables with the retrieved values
foreach ($row as $key => $value) {
    $$key = $value;
}
?>
<style>
  .wrap h1{
    text-align: center;
    margin-top:10rem;
    margin-bottom:1rem;
  }
  .profile{
    border: 2px solid black;
    max-width: 512px;
    margin: 0 auto;
    padding: 2.5rem;
  }
</style>
<div class="wrap">
  <h1>Lawyer Credentials</h1>
  <div class="profile" >
    <span class="h6 mr-3">Name:</span>
    <span class="text-primary"> <?php echo $name; ?></span><br>
    <span class="h6 mr-3">Practice Area:</span><span class="text-primary"> <?php echo $speciality; ?></span><br>
    <span class="h6 mr-3">Phone:</span><span class="text-primary"> <?php echo $number; ?></span><br>
    <form method="post" action="lawyer_update" class="text-center">
      <input type="submit" class="btn btn-primary my-3" value="Update Profile">
    </form>
  </div>
</div>