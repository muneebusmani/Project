<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    // Perform form validation
    $errors = [];

    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate phone number
    if (empty($phone)) {
        $errors[] = "Phone number is required";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // Validate confirm password
    if (empty($confirmPassword)) {
        $errors[] = "Confirm password is required";
    } elseif ($password !== $confirmPassword) {
        $errors[] = "Password and confirm password do not match";
    }

    // If there are no errors, save the data to the database or perform any other necessary actions
    if (empty($errors)) {
        // TODO: Save the data to the database or perform other actions



        // Create the users table if it doesn't exist
        $createTableSQL = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            phone VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        )";
        $conn->query($createTableSQL);

        // Prepare the insert statement
        $insertSQL = "INSERT INTO users (username, email, phone, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertSQL);
        $stmt->bind_param("ssss", $username, $email, $phone, $password);

        // Execute the insert statement
        if ($stmt->execute()) {
            // Data inserted successfully
            header ('location:signin');
        } else {
            // Error occurred while inserting data
            echo "Error: " . $stmt->error;
        }

        // Close the statement and database connection
        $stmt->close();

    }
}
?>

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
        input[type="email"],
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

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
    <h2 class="text-center my-5">Sign Up</h2>
    <div class="wrap">
        <form method="POST">
            <?php if (!empty($errors)) : ?>
                <div class="error">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="submit" value="Sign Up">
            <a href="signin" class="float-right">already an existing user?</a>
        </form>
    </div>
