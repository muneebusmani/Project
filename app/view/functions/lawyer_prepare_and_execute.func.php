<?php
function prepare_and_execute($conn ,$img , $name, $location, $number, $email, $address, $speciality, $education, $experience, $password){
        // Prepare the SQL statement
        $sql = "INSERT INTO lawyers (`Photo` ,`name`, `location`, `number`, `email`, `address` , `speciality`, `education` , `experience` , `password`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
    
        // Bind parameters to the prepared statement
        $stmt->bind_param("sssissssss",$img, $name,  $location, $number, $email, $address, $speciality, $education, $experience, $password);
        mysqli_stmt_execute($stmt);
    
        // Check for successful execution
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Record inserted successfully.";
            $stmt->close();
            $conn->close();
            header('location:lawyer_login');
        } else {
            echo "Error: " . mysqli_error($conn);
        }        
}


