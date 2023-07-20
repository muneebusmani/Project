<?php
// Check if the user is logged in as a lawyer
if (!isset($_SESSION['lawyer_email'])) {
    // Redirect to the login page or display an error message
    header("Location: lawyer_login");
    exit;
}

// Get the lawyer's email from the session
$lawyerEmail = $_SESSION['lawyer_email'];

// Assuming you have established a database connection using MySQLi object-oriented syntax

// Retrieve the lawyer's current information from the database based on the email
$query = "SELECT * FROM lawyers WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $lawyerEmail);
$stmt->execute();
$result = $stmt->get_result();

// Check if the lawyer exists in the database
if ($result->num_rows === 1) {
    // Fetch the lawyer's current information
    $row = $result->fetch_assoc();
    $ID = $row['ID'];
    $name = $row['name'];
    $number = $row['number'];
    $email = $row['email'];
    $address = $row['address'];
    $speciality = $row['speciality'];
    $location = $row['location'];
    $education = $row['education'];
    $experience = $row['experience'];
    $password = $row['password'];

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['submit'])) {
        // Retrieve the updated information from the form
        $updatedName = $_POST['name'];
        $updatedNumber = $_POST['number'];
        $updatedEmail = $_POST['email'];
        $updatedAddress = $_POST['address'];
        $updatedSpeciality = $_POST['speciality'];
        $updatedLocation = $_POST['location'];
        $updatedEducation = $_POST['education'];
        $updatedExperience = $_POST['experience'];
        $updatedPassword = $_POST['password'];

        // Prepare the update statement
        $updateQuery = "UPDATE lawyers SET name = ?, number = ?, email = ?, address = ?, speciality = ?, location = ?, education = ?, experience = ?, password = ? WHERE ID = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('sssssssssi', $updatedName, $updatedNumber, $updatedEmail, $updatedAddress, $updatedSpeciality, $updatedLocation, $updatedEducation, $updatedExperience, $updatedPassword, $ID);
        $_SESSION['lawyer_email']=$updatedEmail;
        // Execute the update statement
        if ($stmt->execute()) {
            // Redirect to the profile page or display a success message
            header("Location: lawyer_dashboard");
            exit;
        } else {
            // Update failed
            // Display an error message or handle the error accordingly
            echo "Error updating information: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
} else {
    // Lawyer not found in the database
    // Redirect to the login page or display an error message
    header("Location: lawyer_signin");
    exit;
}

?>
<body>
    <form method="POST" class="w-50 m-auto">
    <h2 class="text-center">Update Lawyer Information</h2>
    <div class="form-group">
    <label for="Fullname">Full Name</label>
    <input value="<?php echo ($Name ?? $name) ?? ''; ?>" name="name" type="text" class="form-control" id="Fullname" aria-describedby="emailHelp">    
    <label for="phone">Phone Number</label>
    <input value="<?php echo ($Number ?? $number) ?? ''; ?>" name="number" type="text" class="form-control" id="phone" aria-describedby="emailHelp">
    <label for="Email">Email address</label>
    <input value="<?php echo ($Email ?? $email) ?? ''; ?>" name="email" type="email" class="form-control" id="Email" aria-describedby="emailHelp">
    <label for="address">Residential Address</label>
    <input value="<?php echo ($Address ?? $address) ?? ''; ?>" name="address" type="text" class="form-control" id="address" aria-describedby="emailHelp">
    <div class="form-group">
        <label for="location">Location:</label>
        <select id="location" name="location" class="form-control w-40 text-center">
            <?php 
            $selectedLocation = ($row['location'] ?? ""); // Assign the selected value to a variable
            echo "<option value=\"$selectedLocation\" selected>$selectedLocation</option>";
            admin::fetch_options_adv($conn, 'location', 'location', $selectedLocation);
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="practice_area">Practice Area</label>
        <select id="practice_area" name="speciality" class="form-control w-40 text-center">
            <?php 
            $selectedSpeciality = ($row['speciality'] ?? ""); // Assign the selected value to a variable
            echo "<option value=\"$selectedSpeciality\" selected>$selectedSpeciality</option>";
            admin::fetch_options_adv($conn, 'practice_area', 'practice_area', $selectedSpeciality);
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="education">Education</label>
        <select id="education" name="education" class="form-control w-40 text-center">
            <?php 
            $selectedEducation = ($row['education'] ?? ""); // Assign the selected value to a variable
            echo "<option value=\"$selectedEducation\" selected>$selectedEducation</option>";
            admin::fetch_options_adv($conn, 'education', 'education', $selectedEducation);
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="experience">Experience</label>
        <select id="experience" name="experience" class="form-control w-40 text-center">
            <?php 
            $selectedExperience = ($row['experience'] ?? ""); // Assign the selected value to a variable
            echo "<option value=\"$selectedExperience\" selected>$selectedExperience</option>";
            admin::fetch_options_adv($conn, 'experience', 'experience', $selectedExperience);
            ?>
        </select>
    </div>
</div>
<div class="form-group mb-4">
    <label for="InputPassword1">Password</label>
    <input value="<?php echo (isset($_POST['update'])) ? $Password : ($password ?? ''); ?>" name="password" type="password" class="form-control" id="password">
</div>
  
        <!-- Submit button -->
        <input class="form-control btn-primary mt-5" type="submit" name="submit" value="Update">
    </form>
</body>
</html>
