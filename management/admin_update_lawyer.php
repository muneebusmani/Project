<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['update'])) {
            $_SESSION['ID']= $_POST['id'];
            $ID=$_SESSION['ID'];
            $conn1=user::inc_db();
            // Prepare the SQL statement for update
            $sql = "SELECT * FROM lawyers WHERE ID = ?";
            $stmt = $conn1->prepare($sql);
            
            // Bind parameters to the prepared statement
            $stmt->bind_param("i",$ID);
            $done=$stmt->execute();
            if($done){
                $row=$stmt->get_result()->fetch_assoc();
                    // Check if a row was found
                    if ($row) {
                        // Retrieve the values from the row
                       $ID=($_SESSION['ID']=$GLOBALS['ID'] = $row['ID']);
                       $Name=($_SESSION['Name']=$GLOBALS['Name'] = $row['name']);
                       $Number=($_SESSION['Number']=$GLOBALS['Number'] = $row['number']);
                       $Location=($_SESSION['Location']=$GLOBALS['location'] = $row['location']);
                       $Email=($_SESSION['Email']=$GLOBALS['Email'] = $row['email']);
                       $Address=($_SESSION['Address']=$GLOBALS['Address'] = $row['address']);
                       $Speciality=($_SESSION['Speciality']=$GLOBALS['Speciality'] = $row['speciality']);
                       $Education=($_SESSION['Education']=$GLOBALS['Education'] = $row['education']);
                       $Experience=($_SESSION['Experience']=$GLOBALS['Experience'] = $row['experience']);
                       $Password=($_SESSION['Password']=$GLOBALS['Password'] = $row['password']);
                        
                    }  else {
                        echo "No records found for the given ID.";
                    }
            }
            // Check for successful execution
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                // echo "Record updated successfully.";
                // header('location:admin_view_lawyer');
            } else {
                echo  mysqli_error($conn);
            }
        }
        if (isset($_POST['update_s'])) {
            $id=($_POST['identity']??$GLOBALS['ID']);
            $name=($_POST['name']??$GLOBALS['Name']);
            $number=($_POST['number']??$GLOBALS['Number']);
            $location=($_POST['location']??$GLOBALS['location']);
            $email=($_POST['email']??$GLOBALS['Email']);
            $address=($_POST['address']??$GLOBALS['Address']);
            $speciality=($_POST['speciality']??$GLOBALS['Speciality']);
            $education=($_POST['education']??$GLOBALS['Education']);
            $experience=($_POST['experience']??$GLOBALS['Experience']);
            $password=($_POST['password']??$GLOBALS['Password']);

            $errors=[];
            if (empty($name)) {
                array_push($errors, "name");
            }
            if (empty($number)) {
                array_push($errors, "number");
            }
            if (empty($email)) {
                array_push($errors, "email");
            }
            if (empty($address)) {
                array_push($errors, "address");
            }
            if (empty($speciality)) {
                array_push($errors, "speciality");
            }
            if (empty($location)) {
                array_push($errors, "location");
            }
            if (empty($education)) {
                array_push($errors, "education");
            }
            if (empty($experience)) {
                array_push($errors, "experience");
            }
            if (empty($password)) {
                array_push($errors, "password");
            }
            if (!empty($errors)) {
                $errorMessage = 'Please enter your ';
                $lastError = end($errors);
                foreach ($errors as $error) {
                    $errorMessage .= $error;
                    if ($error !== $lastError) {
                        $errorMessage .= ', ';
                    }
                }
                $err_msg = "<script>alert('$errorMessage');</script>";
                echo $err_msg;
            } else{
                    $conn=user::inc_db();
                    // Prepare the SQL statement
                    $sql = "UPDATE lawyers SET `location` = ?, `name` = ?, `number` = ?, `email` = ?, `address` = ?, `speciality` = ?, `education` = ?, `experience` = ?, `password` = ? WHERE `ID` = ?";
                    $stmt = $conn->prepare($sql);
            
                    // Bind parameters to the prepared statement
                    $stmt->bind_param("ssissssssi",$location , $name, $number, $email, $address, $speciality, $education, $experience, $password , $id);
                    $stmt->execute();
                    header('location:admin_view_lawyer');
                    // Check for successful execution
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                        header('location:admin_view_lawyer');
                } else {
                    echo $conn->error;
                }
        
            }
        }
    } catch (Exception $th) {
        echo $th->getMessage();
    }

}
else{
    header('location:admin_view_lawyer');
}
?>
<style>
    input[name='identity']{
        display: none;
    }
</style>


<form method="post">
    <h1 class="text-center">Lawyer Registration</h1>
    <div class="form-group">
        <input value='<?php echo ($ID??$id)??''?>' name='identity' type='text'>
        <label for="Fullname">Full Name</label>
        <input value="<?php echo ($Name??$name)??''?>" name="name" type="text" class="form-control" id="Fullname" aria-describedby="emailHelp">    
        <label for="phone">Phone Number</label>
        <input value="<?php echo ($Number??$number)??''?>" name="number"  type="text" class="form-control" id="phone" aria-describedby="emailHelp">
        <label for="Email">Email address</label>
        <input value="<?php echo ($Email??$email)??''?>" name="email"  type="email" class="form-control" id="Email" aria-describedby="emailHelp">
        <label for="address">Residential Address</label>
        <input value="<?php echo ($Address??$address)??''?>" name="address"  type="text" class="form-control" id="address" aria-describedby="emailHelp">
        <div class="form-group">
    <label for="location">location:</label>
    <select id="location" name="location" class="form-control w-40 text-center">
        <?php 
        $selectedLocation = ($location ?? $Location) ?? ""; // Assign the selected value to a variable
        echo "<option value=\"$selectedLocation\" selected>$selectedLocation</option>";
        admin::fetch_options_adv($conn, 'location', 'location',$selectedLocation);
        ?>
    </select>
</div>
<div class="form-group">
    <label for="practice_area">Practice Area</label>
    <select id="practice_area" name="speciality" class="form-control w-40 text-center">
        <?php 
        $selectedSpeciality = ($row['speciality'] ?? ""); // Assign the selected value to a variable
        echo "<option value=\"$selectedSpeciality\" selected>$selectedSpeciality</option>";
        admin::fetch_options_adv($conn, 'practice_area', 'practice_area',$selectedSpeciality);
        ?>
    </select>
</div>
<div class="form-group">
    <label for="education">Education</label>
    <select id="education" name="education" class="form-control w-40 text-center">
        <?php 
        $selectedEducation = ($row['education'] ?? ""); // Assign the selected value to a variable
        echo "<option value=\"$selectedEducation\" selected>$selectedEducation</option>";
        admin::fetch_options_adv($conn, 'education', 'education',$selectedEducation);
        ?>
    </select>
</div>
<div class="form-group">
    <label for="experience">Experience</label>
    <select id="experience" name="experience" class="form-control w-40 text-center">
        <?php 
        $selectedExperience = ($row['experience'] ?? ""); // Assign the selected value to a variable
        echo "<option value=\"$selectedExperience\" selected>$selectedExperience</option>";
        admin::fetch_options_adv($conn, 'experience', 'experience',$selectedExperience);
        ?>
    </select>
</div>
    </div>
    <div class="form-group mb-4">
        <label for="InputPassword1">Password</label>
        <input value="<?php echo (isset($_POST['update']))?$Password:($password??'');?>" name="password"  type="password" class="form-control" id="password">
    </div>
    <input name="update_s" type="submit" class="btn btn-primary" value="update">
</form>

</form>
<script>
function toggle_password() {
    var passToggle = document.getElementById('password');
    passToggle.type = (passToggle.type === 'password') ? 'text' : 'password';
}
</script>

