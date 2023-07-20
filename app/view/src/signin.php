<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginUsername = $_POST['username'];
    $loginPassword = $_POST['password'];
    
    // Prepare and execute a select statement to validate the user's credentials
    $selectSQL = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($selectSQL);
    $stmt->bind_param("ss", $loginUsername, $loginPassword);
    $stmt->execute();
    $result = $stmt->get_result();
    // Check if the login was successful
    if ($result->num_rows == 1) {
            $loginUsername = $_POST['username'];
            $result=$conn->query("SELECT * FROM users WHERE `username` = '$loginUsername';");
            while($row = $result->fetch_assoc())
            {
                foreach ($row as $key => $value) {
                    $_SESSION[$key] = $value;
                }
            }
        $_SESSION['loggedin'] = true;
        header('location:home');
    } else {
        $error = "Invalid username or password.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<h1 class="text-center m-5">
    Sign in to get full access <br>
</h1>
<style>
        .wrap {
            width: fit-content;
            margin: auto;
            font-family: Arial, sans-serif;
            border: 1px solid #ccc;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 400px;
            padding: 20px;
            border-radius: 5px;
            background-color: #f5f5f5;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
        }
        a[href="signup"]{
            font-size: 14px;
        }
    </style>
    <div class="wrap">
        <form  method="POST" class="clearfix">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <a href="signup" class="float-right">new user?</a>
            <input type="submit" value="Sign In">
            <div class="error-message"><?php echo isset($error) ? $error : ''; ?></div>
        </form>
    </div>