<style>
    .myform{
        height:75vh;
        width: 75vw;
        padding: 5vh 7.5vw 0 7.5vw;
    }
</style>
<div class="d-flex justify-content-center">
<form class="myform" method="POST" enctype="multipart/form-data">
    <h1 class="text-center">Lawyer Registration</h1>

        <label for="">Upload Photo(Optional)</label>
        <input name="file" type="file">

    <div class="form-group">
        <label for="Fullname">Full Name(Required)</label>
        <input name="name" type="text" class="form-control" id="Fullname" aria-describedby="emailHelp">    

        <label for="phone">Phone Number(optional)</label>
        <input name="number"  type="text" class="form-control" id="phone" aria-describedby="emailHelp">

        <label for="Email">Email address(Required)</label>
        <input name="email"  type="email" class="form-control" id="Email" aria-describedby="emailHelp">


        <label for="address">Residential Address(optional)</label>
        <input name="address"  type="text" class="form-control" id="address" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="area">Practice Area(Required)</label>
        <input name="speciality"  type="text" class="form-control" id="area" aria-describedby="emailHelp">

        <label for="education">Education(Required)</label>
        <input name="education"  type="text" class="form-control" id="education" aria-describedby="emailHelp">

        <label for="exp">Experience(Required)</label>
        <input name="experience"  type="text" class="form-control" id="exp" aria-describedby="emailHelp">
    </div>
    <div class="form-group mb-4">
        <label for="InputPassword1">Password</label>
        <input name="password"  type="password" class="form-control" id="password">
    </div>

  <div class="form-group form-check">
    <input type="checkbox" onclick="toggle_password();" class="form-check-input" id="Check1">
    <label class="form-check-label" for="Check1">Show Password</label>
  </div>
  <input name="submit" type="submit" class="btn btn-primary" value="Submit">
</form>
</div>

<script>
function toggle_password(){var passToggle = document.getElementById('password');passToggle.type=passToggle.type=='password'?'text':'password';}
</script>


<?php
inc_db();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $name=$number=$email=$address=$speciality=$education=$experience=$password= '';
        $errors=[];
        if(empty($name)){
            array_push($errors,"Please Enter Your Name");
        }
        if(empty($number)){
            array_push($errors,"Please Enter Your Name");
        }
        if(empty($email)){
            array_push($errors,"Please Enter Your Name");
        }
        if(empty($address)){
            array_push($errors,"Please Enter Your Name");
        }
        if(empty($speciality)){
            array_push($errors,"Please Enter Your Name");
        }
        if(empty($education)){
            array_push($errors,"Please Enter Your Name");
        }
        if(empty($experience)){
            array_push($errors,"Please Enter Your Name");
        }
        if(empty($password)){
            array_push($errors,"Please Enter Your Name");
        }


        $name=                  $conn->real_escape_string($_POST['name']);
        $number=                $conn->real_escape_string($_POST['number']);
        $email=                 $conn->real_escape_string($_POST['email']);
        $address=               $conn->real_escape_string($_POST['address']);
        $speciality=            $conn->real_escape_string($_POST['speciality']);
        $education=             $conn->real_escape_string($_POST['education']);
        $experience=            $conn->real_escape_string($_POST['experience']);
        $password=              $conn->real_escape_string($_POST['password']);
        



        // Check if a file was uploaded successfully
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        // Maximum file size (in bytes)
        $maxFileSize = 10485760; // 10MB

        // Allowed file extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        $uploadedFile = $_FILES['file'];

        // Get the file details
        $fileName = $uploadedFile['name'];
        $fileSize = $uploadedFile['size'];
        $fileTmpPath = $uploadedFile['tmp_name'];

        // Validate file name
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Error: Invalid file extension. Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }

        // Validate file size
        if ($fileSize > $maxFileSize) {
            echo "Error: File size exceeds the allowed limit of 1MB.";
            exit;
        }

        // Generate a unique filename
        $uniqueFileName = uniqid().'.'.$fileExtension;

        // Move the uploaded file to a secure directory
        $uploadDirectory = 'uploads/lawyers/';
        
        $destination = $uploadDirectory . $uniqueFileName;
        $move=move_uploaded_file($fileTmpPath, $destination);
        if (!$move) {
            echo "Error: Failed to move uploaded file.";
            exit;
        }

        // File upload was successful
        echo "File uploaded successfully.";
    } else {
        echo "Error: File upload failed.";
    }
    }
    
}
?>
