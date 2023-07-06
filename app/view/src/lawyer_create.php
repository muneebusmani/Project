<?php
$name = $number = $email = $address = $speciality = $education = $experience = $password = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $name=$_POST['name'];
        $location=$_POST['location'];
        $number=$_POST['number'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $speciality=$_POST['speciality'];
        $education=$_POST['education'];
        $experience=$_POST['experience'];
        $password=$_POST['password'];
        $errors = [];
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
        } else {
            bulk_sanitize();
            $img = file_handle();
            if (empty($img)) {
                echo
                "<script>
                alert('Please upload an image');
                </script>";
            } else {
                prepare_and_execute();
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
<div class="d-flex justify-content-center">
    <form class="myform" method="POST" enctype="multipart/form-data">
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
                <?php fetch_options($conn, 'location', 'location'); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="location">Practice Area</label>
            <select id="location" name="speciality" class="form-control w-40 text-center">
                <option disabled selected></option>
                <?php fetch_options($conn, 'practice_area', 'practice_area') ?>
            </select>
        </div>
        <div class="form-group">
            <label for="location">Education</label>
            <select id="location" name="education" class="form-control w-40 text-center">
                <option disabled selected></option>
                <?php fetch_options($conn, 'education', 'education'); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="location">Experience</label>
            <select id="location" name="experience" class="form-control w-40 text-center">
                <option disabled selected></option>
                <?php fetch_options($conn, 'experience', 'experience'); ?>
            </select>
        </div>
        <div class="form-group mb-4">
            <div class="form-group"><label for="InputPassword1">Password</label>
            <input value="<?php echo $password; ?>" name="password" type="password" class="form-control" id="password">
        </div>

        <div class="form-group form-check">
            <input type="checkbox" onclick="toggle_password();" class="" id="Check1">
            <label class="form-check-label" for="Check1">Show Password</label>
        </div>
            <input name="submit" type="submit" class="btn btn-primary" value="Submit">
    </form>
</div>
<script>
    function toggle_password() {
        var passToggle = document.getElementById('password');
        passToggle.type = passToggle.type == 'password' ? 'text' : 'password';
    }
</script>