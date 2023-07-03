<?php
function bulk_sanitize(){
    
    global $name,$number,$email,$address,$speciality,$education,$experience,$password;

    $name       =(!empty($name))? sanitize($name) : 'Empty';
    $number     =(!empty($number))? sanitize($number) : 'Empty';
    $email      =(!empty($email))? sanitize($email) : 'Empty';
    $address    =(!empty($address))? sanitize($address) : 'Empty';
    $speciality =(!empty($speciality))? sanitize($speciality) : 'Empty';
    $education  =(!empty($education))? sanitize($education) : 'Empty';
    $experience =(!empty($experience))? sanitize($experience) : 'Empty';
    $password   =(!empty($password))? sanitize($password) : 'Empty';
}