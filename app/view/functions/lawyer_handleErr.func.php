<?php

function handle_err(array $values)
{
    $errors = [];
    foreach ($values as $key => $value) {
        if (empty($value)) {
            array_push($errors, $key);
        }
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
    } else {
        return null;
    }
}
