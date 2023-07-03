<?php
if (isset($_POST['delete'])) {
    del_img();
}
?>
<form method="post">
    <button type='submit' name='delete' class='btn btn-danger' value='Delete'>Delete</button>
</form>
<?php
function del_img(){
$folderPath = 'uploads/lawyers/';

// Get the list of files in the folder
$fileList = scandir($folderPath);

// Loop through each file and delete it
foreach ($fileList as $file) {
    // Skip "." and ".." entries
    if ($file === '.' || $file === '..') {
        continue;
    }

    // Build the full path to the file
    $filePath = $folderPath . $file;

    // Check if the file is writable
    if (is_writable($filePath)) {
        // Delete the file
        unlink($filePath);
        echo "Deleted file: $file <br>";
    } else {
        echo "Unable to delete file: $file <br>";
    }
}
}