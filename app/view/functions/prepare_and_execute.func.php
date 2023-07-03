<?php
function prepare_and_execute(){
    try{
        global $conn ,$img , $name, $number, $email, $address, $speciality, $education, $experience, $password;
    $conn=inc_db();

    // Prepare the SQL statement
    $sql = "INSERT INTO lawyers (`Photo` ,`name`, `number`, `email`, `address` , `speciality`, `education` , `experience` , `password`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssissssss",$img, $name, $number, $email, $address, $speciality, $education, $experience, $password);
    mysqli_stmt_execute($stmt);

    // Check for successful execution
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Record inserted successfully.";
        $stmt->close();
        $conn->close();
        header('location:lawyer_login');
        ob_end_flush();
    } else {
        echo "Error: " . mysqli_error($conn);
    }        
    }
    catch(Exception $e){
        echo $e->getCode();
    }
}

