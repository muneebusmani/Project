<?php
function bulk_sanitize(){
    global $name,$number,$email,$address,$speciality,$education,$experience,$password;
    $name       = sanitize($name);
    $number     = sanitize($number);
    $email      = sanitize($email);
    $address    = sanitize($address);
    $speciality = sanitize($speciality);
    $education  = sanitize($education);
    $experience = sanitize($experience);
    $password   = sanitize($password);
}