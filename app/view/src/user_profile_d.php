<?php
user::load_header_u();
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Check if the delete form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Retrieve the username from the session
        $username = $_SESSION['username'];

        // Delete the user profile from the database
        $deleteSQL = "DELETE FROM users WHERE username = ?";
        $stmt = $conn->prepare($deleteSQL);
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            // User profile deleted successfully
            // Clear the session and redirect to the login page or any other appropriate page
            session_unset();
            session_destroy();
            header("Location: signin");
            exit;
        } else {
            // Error occurred while deleting the user profile
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
        
    }
}
?>
<style>
    .wrap{
        margin: 10rem auto;
        width: fit-content;
        border: 1px solid black;
        text-align: center;
    }
    form{
        padding: 5rem 10rem;
    }
</style>
<div class="wrap">
    <form method="post">
    <h1 class="">Delete User Profile</h1>
    <input type="submit" name="submit" class="btn btn-danger" value="Delete Profile">
    </form>
</div>