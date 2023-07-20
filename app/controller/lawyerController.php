<?php

class lawyer
{
    public static function bulk_sanitize()
    {
        foreach($_POST as $value){
            if ($value = 'Photo') {
                continue;
            }
            (!empty($value)) ? self::sanitize($value) : 'Empty';
        }
    }


    public static function file_handle()
    {
        if (isset($_FILES['Photo']) && $_FILES['Photo']['error'] === 0) {
            // Maximum file size (in bytes)
            $maxFileSize = 10485760; // 10MB

            // Allowed file extensions
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $uploadedFile = $_FILES['Photo'];

            // Get the file details
            $fileName = $uploadedFile['name'];
            $fileSize = $uploadedFile['size'];
            $fileTmpPath = $uploadedFile['tmp_name'];

            // Validate file name
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                echo "Error: Invalid file extension. Only JPG, JPEG, and PNG files are allowed.";
                exit;
            }

            // Validate file size
            if ($fileSize > $maxFileSize) {
                echo "Error: File size exceeds the allowed limit of 1MB.";
                exit;
            }

            // Generate a unique filename
            $uniqueFileName = uniqid() . '.' . $fileExtension;

            // Move the uploaded file to a secure directory
            $uploadDirectory = 'uploads/lawyers/';

            $destination = $uploadDirectory . $uniqueFileName;
            $image = $destination;
            $move = move_uploaded_file($fileTmpPath, $destination);
            if (!$move) {
                echo "Error: Failed to move uploaded file.";
                exit;
            }

            // File upload was successful
            // echo "File uploaded successfully.";
            return $image;
        } else {

            // echo "File upload failed.";
        }
    }



    public static function handle_err(array $values)
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
            return 0;
        }
    }


    public static function prepare_and_execute($conn,$img,$name,$location,$number,$email,$address,$speciality,$education,$experience,$password)
    {
        // Prepare the SQL statement
        $sql = "INSERT INTO lawyers (`Photo` ,`name`, `location`, `number`, `email`, `address` , `speciality`, `education` , `experience` , `password`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters to the prepared statement
        $stmt->bind_param("sssissssss", $img, $name,  $location, $number, $email, $address, $speciality, $education, $experience, $password);
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


    public static function sanitize($data)
    {
        global $conn;
        
        // Sanitize for HTML output
        $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Sanitize for general output
        $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
        
        // Strip HTML tags
        $data = strip_tags($data);
        
        // Addslashes (use appropriate escaping mechanism for database queries)
        $data = addslashes($data);
        
        
        $data = $conn->real_escape_string($data);
        
        return $data;
    }
    public static function routes(){
        return 
        array
        (
            #Lawyers Pages
            'lawyer_signup'                                 ,
            'lawyer_signin'                                 ,
            'lawyer_options'                                 ,
            'lawyer_dashboard'                                 ,
            'lawyer_appointments'                                 ,
            'lawyer_update'                                 ,
            'lawyer_signout'                                 ,
            'lawyer_dismiss_appointment'                                 ,
        );
    }
    public static function err_handle($errors){
        foreach ($_POST as $key => $value) {
            if ($key = 'Photo') {
                continue;
            }
            if (empty($value)) {
                array_push($errors, $key);
            }
        }

        $status = ((!empty($errors))? $errors:0);
        return $status;

    }
    public static function src(){
        $lawyer='lawyer/';
        return $lawyer;
    }


    
    public static function fetch_options_adv(mysqli $conn, string $column, string $table, string $selectedValue)
    {

        // Construct the SQL query with a WHERE clause to exclude the selected value
        $sql = "SELECT $column FROM $table WHERE $column <> ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $selectedValue);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $value = $row[$column];
            if ($value === $selectedValue) {
                continue;
            }
            echo "<option value='$value'>$value</option>";
        }
    }
    public static function load_header()
    {
        $header = "app/view/templates/header_l.inc.php";
        require_once($header);
    }
}
