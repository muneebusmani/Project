<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        $_SESSION['ID']= $_POST['id'];
        $ID=$_SESSION['ID'];
        $conn1=inc_db();
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
                    $Name = $row['name'];
                    $Number = $row['number'];
                    $Email = $row['email'];
                    $Address = $row['address'];
                    $Speciality = $row['speciality'];
                    $Education = $row['education'];
                    $Experience = $row['experience'];
                    $Password = $row['password'];
                    
                }  else {
                    echo "No records found for the given ID.";
                }
        }
        // Check for successful execution
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // echo "Record updated successfully.";
            // header('location:admin_view');
        } else {
            echo  mysqli_error($conn);
        }
    
    }
    if (isset($_POST['update_s'])) {
        $id=$_SESSION['ID'];
        fetch_post();
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
            try {
                $conn=inc_db();
                // Prepare the SQL statement
                $sql = "UPDATE lawyers SET `name` = ?, `number` = ?, `email` = ?, `address` = ?, `speciality` = ?, `education` = ?, `experience` = ?, `password` = ? WHERE `ID` = ?";
                $stmt = $conn->prepare($sql);
        
                // Bind parameters to the prepared statement
                $stmt->bind_param("sissssssi" , $name, $number, $email, $address, $speciality, $education, $experience, $password , $id);
                $stmt->execute();
            } catch (Exception $e) {
                echo $e->getLine();
            }
    
            // Check for successful execution
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Record updated successfully.";
                header('location:admin_view');
            } else {
                echo $conn->error;
            }
    
        }
    }
}
?>



<form method="post">
    <h1 class="text-center">Lawyer Registration</h1>
    <div class="form-group">
        <input value='<?php echo (isset($_POST['update']))?$ID:($id??'');?>' name='identity' type='text'>
        <label for="Fullname">Full Name</label>
        <input value="<?php echo (isset($_POST['update']))?$Name:($name??'');?>" name="name" type="text" class="form-control" id="Fullname" aria-describedby="emailHelp">    
        <label for="phone">Phone Number</label>
        <input value="<?php echo (isset($_POST['update']))?$Number:($number??'');?>" name="number"  type="text" class="form-control" id="phone" aria-describedby="emailHelp">
        <label for="Email">Email address</label>
        <input value="<?php echo (isset($_POST['update']))?$Email:($email??'');?>" name="email"  type="email" class="form-control" id="Email" aria-describedby="emailHelp">
        <label for="address">Residential Address</label>
        <input value="<?php echo (isset($_POST['update']))?$Address:($address??'');?>" name="address"  type="text" class="form-control" id="address" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="area">Practice Area</label>
        <input value="<?php echo (isset($_POST['update']))?$Speciality:($speciality??'');?>" name="speciality"  type="text" class="form-control" id="area" aria-describedby="emailHelp">
        <label for="education">Education</label>
        <input value="<?php echo (isset($_POST['update']))?$Education:($education??'');?>" name="education"  type="text" class="form-control" id="education" aria-describedby="emailHelp">
        <label for="exp">Experience</label>
        <input value="<?php echo (isset($_POST['update']))?$Experience:($experience??'');?>" name="experience"  type="text" class="form-control" id="exp" aria-describedby="emailHelp">
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
<?php

