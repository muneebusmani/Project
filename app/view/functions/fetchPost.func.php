<?php
function fetch_post(){
        global $name,$number,$email,$address,$speciality,$education,$experience,$password;
        $name=$_POST['name'];
        $number=$_POST['number'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $speciality=$_POST['speciality'];
        $education=$_POST['education'];
        $experience=$_POST['experience'];
        $password=$_POST['password'];
}
