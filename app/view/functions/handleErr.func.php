<?php
   
function handle_err(){    
    global $number,$email,$address,$speciality,$education,$experience,$password,$errors;
    
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
        return $err_msg;
    }
    
    
}