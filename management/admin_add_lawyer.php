<?php
$name = $number = $email = $address = $speciality = $education = $experience = $password = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $name       =&$_POST['name'];
        $location   =&$_POST['location'];
        $number     =&$_POST['number'];
        $email      =&$_POST['email'];
        $address    =&$_POST['address'];
        $speciality =&$_POST['speciality'];
        $education  =&$_POST['education'];
        $experience =&$_POST['experience'];
        $password   =&$_POST['password'];

        $errors= [];
        $status=lawyer::err_handle($errors);
        
        if ($status !== 0) {
            $errorMessage = 'Please enter your ';
            $lastError = end($status);
            foreach ($status as $error) {
                $errorMessage .= $error;
                if ($error !== $lastError) {
                    $errorMessage .= ', ';
                }
            }
            $err_msg = "<script>alert('$errorMessage');</script>";
            echo $err_msg;
        } 
        else 
        {
            lawyer::bulk_sanitize();
            $img=lawyer::file_handle();
            if (!empty($img)) {
                lawyer::prepare_and_execute($conn ,$img , $name, $location, $number, $email, $address, $speciality, $education, $experience, $password);
            } else {
                echo
                "<script>
                alert('Please upload an image');
                </script>";
            }
        }
    }
}
?>
<style>
    .myform {
        height: 75vh;
        width: 75vw;
        padding: 5vh 7.5vw 0 7.5vw;
    }
</style>
    <form class="myform" method="post" enctype="multipart/form-data">
        <h1 class="text-center">Lawyer Registration</h1>

        <label for="">Upload Photo(optional)</label>
        <input name="Photo" type="file">

        <div class="form-group">
            <label for="Fullname">Full Name</label>
            <input value="<?php echo $name; ?>" name="name" type="text" class="form-control" id="Fullname" aria-describedby="emailHelp">
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input value="<?php echo $number; ?>" name="number" type="text" class="form-control" id="phone" aria-describedby="emailHelp">
        </div>
        
        <div class="form-group">
            <label for="Email">Email address</label>
            <input value="<?php echo $email; ?>" name="email" type="email" class="form-control" id="Email" aria-describedby="emailHelp">
        </div>
        
        
        <div class="form-group">
            <label for="address">Residential Address</label>
            <input value="<?php echo $address; ?>" name="address" type="text" class="form-control" id="address" aria-describedby="emailHelp">
        </div>
        
        <div class="form-group">
            <label for="location">location:</label>
            <select id="location" name="location" class="form-control w-40 text-center">
                <option disabled selected></option>
                <?php user::fetch_options($conn, 'location', 'location'); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="location">Practice Area</label>
            <select id="location" name="speciality" class="form-control w-40 text-center">
                <option disabled selected></option>
                <?php user::fetch_options($conn, 'practice_area', 'practice_area') ?>
            </select>
        </div>
        <div class="form-group">
            <label for="location">Education</label>
            <select id="location" name="education" class="form-control w-40 text-center">
                <option disabled selected></option>
                <?php user::fetch_options($conn, 'education', 'education'); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="location">Experience</label>
            <select id="location" name="experience" class="form-control w-40 text-center">
                <option disabled selected></option>
                <?php user::fetch_options($conn, 'experience', 'experience'); ?>
            </select>
        </div>
        <div class="form-group mb-4">
            <div class="form-group"><label for="InputPassword1">Password</label>
            <input value="<?php echo $password; ?>" name="password" type="password" class="form-control" id="password">
        </div>

        <div class="form-group form-check">
            <input type="checkbox" onclick="toggle_passwd();" class="" id="Check1">
            <label class="form-check-label" for="Check1">Show Password</label>
        </div>
            <input name="submit" type="submit" class="btn btn-primary" value="Submit">
    </form>
<script>
    function toggle_passwd() {
        var passToggle = document.getElementById('password');
        passToggle.type = passToggle.type == 'password' ? 'text' : 'password';
    }
</script>