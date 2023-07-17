<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform form validation
    $errors = [];

    // Validate email
    if (empty($email)) {
        $errors[] = "email is required";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // If there are no errors, proceed with login authentication
    if (empty($errors)) {

        $stmt = $conn->prepare("SELECT * FROM lawyers WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if login is successful
        if ($result->num_rows == 1) {
            // Start the session and set the logged-in user
            session_start();
            $_SESSION["lawyer_email"] = $email;

            // Redirect to the lawyer dashboard or any other page
            header("Location: lawyer_dashboard");
            exit;
        } else {
            $errors[] = "Invalid email or password";
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
}
?>
    <style>
        .container {
            max-width: 400px;
            margin: 10rem auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid black;
            border-radius: 4px;
        }
        .form-group .error {
            color: red;
            margin-top: 5px;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
<div  class="body">
    <div class="container">
        <h2>Lawyer Login</h2>
        <form method="POST">
            <?php if (!empty($errors)) : ?>
                <div class="error">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Login">
            </div>
        </form>
    </div>
</div>
