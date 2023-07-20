<style>
  .wrap{
    margin: 0px auto;
    width: 30rem;
    height: 15rem;
    --margin:10%;
    margin: var(--margin) auto;
    border: 2px solid black;
  }
</style>
<div class="wrap">
<a class='fas fa-window-close fa-lg float-right' style='color: #ff0000;' href='admin_view_lawyer'></a>
    <form method="post" class="text-center py-5">
        <h1 class="display1">
            Delete All Images
        </h1>
        <button onclick="confirmDelete()" type='submit' name='delete_imgs' class='btn btn-danger' value='Delete'>Delete</button>
    </form>
</div>
<script>
function confirmDelete() {
            // Prompt the user to confirm the deletion
            var confirmed = confirm("Are you sure you want to delete the files?");

            // If the user confirmed, submit the form
            if (confirmed) {
                document.forms[0].submit();
            }
            else {
                event.preventDefault(); // Prevent form submission
                return false;
            }
        }
</script>
<?php
if (isset($_POST['delete_imgs'])) {
    del_img();
    echo "<script>alert('Images Deletion Successful');</script>";
}

function del_img()
{
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
?>
