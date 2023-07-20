<?php
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or display an error message
    header("Location: login");
    exit;
}

// Get the username from the session
$username = $_SESSION['username'];


// Prepare the SQL statement
$query = "SELECT * FROM `users` WHERE `username` = ?";

// Prepare the statement
$stmt = $conn->prepare($query);

// Bind Parameters
$stmt->bind_param('s',$username);

// Execute the statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Fetch the results into an associative array
$row = $result->fetch_assoc();

// Update the session variables with the retrieved values
foreach ($row as $key => $value) {
    $_SESSION[$key] = $value;
}

//Making normal Variables out of Session
foreach ($_SESSION as $key => $value) {
  $$key=$value;
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
    width: fit-content;
    margin: 0 auto;
    padding: 2.5rem;
  }
</style>
<div class="wrap">
  <h1>User Profile</h1>
  <div class="profile">
    <span class="h3 mr-3">Name:</span><span class="text-primary"> <?php echo $username; ?></span><br>
    <span class="h3 mr-3">Email: </span><span class="text-primary"> <?php echo $email; ?></span><br>
    <span class="h3 mr-3">Phone:</span><span class="text-primary"> <?php echo $phone; ?></span><br>
    <form method="post" action="user_profile_update" class="text-center">
      <input type="submit" class="btn btn-primary my-3" value="Update Profile">
    </form>
  </div>
</div>

<!-- Add your additional HTML, CSS, or JavaScript code here if needed -->
