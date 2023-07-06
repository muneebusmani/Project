<?php
function file_handle(){
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
        $uniqueFileName = uniqid().'.'.$fileExtension;

        // Move the uploaded file to a secure directory
        $uploadDirectory = 'uploads/lawyers/';
        
        $destination = $uploadDirectory . $uniqueFileName;
        $image = $destination;
        $move=move_uploaded_file($fileTmpPath, $destination);
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