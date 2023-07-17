<?php
user::load_header_u();
// Check if the form is submitted
foreach($_SESSION as $key => $value){
    $$key = $value;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $P_username = $_POST["username"];
        $P_email = $_POST["email"];
        $P_phone = $_POST["phone"];
        $P_password = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];

        // Perform form validation
        $errors = [];

        // Validate email
        if (empty($P_email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($P_email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }

        // Validate phone number
        if (empty($P_phone)) {
            $errors[] = "Phone number is required";
        }

        // Validate password
        if (empty($P_password)) {
            $errors[] = "Password is required";
        }

        // Validate confirm password
        if (empty($confirmPassword)) {
            $errors[] = "Confirm password is required";
        } elseif ($P_password !== $confirmPassword) {
            $errors[] = "Password and confirm password do not match";
        }

        // If there are no errors, update the session variables and save the data to the database or perform any other necessary actions
        if (empty($errors)) {
            $updateSQL = "UPDATE users SET `username` = ?, email  = ?, phone  = ?, password  = ? WHERE `id` = ? ";
            $stmt = $conn->prepare($updateSQL);
            $stmt->bind_param("ssssi",$P_username,$P_email, $P_phone, $P_password,$id);
            // Execute the update statement
            if ($stmt->execute()) {
                foreach ($_POST as $key => $value ) {
                    $_SESSION[$key]=$value;
                    if ($key == 'confirm_password') {
                        continue;
                    }
                }
                header ('location:user_profile');
            } else {
                // Error occurred while updating data
                echo "Error: " . $stmt->error;
            }
            // Close the statement and database connection
            $stmt->close();
        }
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
    #id , label[for="id"]{
        display: none;
    }
</style>
<h2 class="text-center my-5">Update User Credentials</h2>
<div class="wrap">
    <form method="POST">
        <?php if (!empty($errors)) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <label for="username">username:</label>
        <input value="<?php echo $username ?? 'variable_empty';?>" type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input value="<?php echo $email ?? 'variable_empty';?>" type="email" id="email" name="email" required>

        <label for="phone">Phone Number:</label>
        <input value="<?php echo $phone ?? 'variable_empty';?>" type="text" id="phone" name="phone" required>

        <label for="password">Password:</label>
        <input value="<?php echo $password ?? 'variable_empty';?>" type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input value="<?php echo $password ?? 'variable_empty';?>" type="password" id="confirm_password" name="confirm_password" required>

        <input type="submit" name="submit" value="Update">
    </form>
</div>
