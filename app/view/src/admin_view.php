<style>
    tr,th,td{
        border: 2px solid black;
    }
    .btn-danger,.btn-success,.btn-primary{
        border-radius: 25px;
    }

</style>
<table class="table text-center">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Photo</th>
      <th scope="col">FullName</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Residential Address</th>
      <th scope="col">PracticeArea</th>
      <th scope="col">Education</th>
      <th scope="col">Experience</th>
      <th scope="col">Password</th>
      <th scope="col">Manage</th>
    </tr>
<?php
    $sql='SELECT * FROM lawyers';
    $result=$conn->query($sql);
    while ($rows=$result->fetch_assoc()) {
        $ID=$rows['ID'];
        $Photo=$rows['Photo'];
        $name=$rows['name'];
        $number=$rows['number'];
        $email=$rows['email'];
        $address=$rows['address'];
        $speciality=$rows['speciality'];
        $education=$rows['education'];
        $experience=$rows['experience'];
        $password=$rows['password'];
        echo 
        "
        <tr>
        <td scope='col'>$ID</td>
        <td scope='col'><img src='$Photo' alt='$name' width='50px' height='50px' ></td>
        <td scope='col'>$name</td>
        <td scope='col'>$email</td>
        <td scope='col'>$number</td>
        <td scope='col'>$address</td>
        <td scope='col'>$speciality</td>
        <td scope='col'>$education</td>
        <td scope='col'>$experience</td>
        <td scope='col'>$password</td>
        <td scope='col' style='width:20%;'>
        <span>
        <form class='d-inline' method='POST' action='admin_update'> 
        <input value='$ID' name='id' type='hidden'>
        <button type='submit' name='update' class='btn btn-success' value='Update'>Update</button>
        </form>
        <form class='d-inline' method='POST' action='admin_delete'>
        <input value='$ID' name='id' type='hidden'>
        <button type='submit' name='delete' onclick='confirmDelete_a();' class='btn btn-danger' value='Delete'>Delete</button>
        </form>
        </span>
        </td>
        </tr>
        </tr>
        ";
    }
    echo "</table>";
?>
<button onclick="emptyCacheAndReload()" type='button' class='btn btn-primary'>Refresh</button>
<script>
function emptyCacheAndReload() {
    if ('caches' in window) {
        caches.keys().then(function (cacheNames) {
            cacheNames.forEach(function (cacheName) {
                caches.delete(cacheName);
            });
        });
    }

    window.location.reload(true);
}
      
    </script>
</script>

<form method="post" class="text-center">
    <h1 class="display1 ">
        Delete All Images
    </h1>
    <button onclick="confirmDelete()" type='submit' name='delete_imgs' class='btn btn-danger' value='Delete'>Delete</button>
</form>
<script>
function confirmDelete() {
  // Prompt the user to confirm the deletion
  var confirmed = confirm("Are you sure you want to delete the files?");

  // If the user confirmed, submit the form
  if (confirmed) {
    document.forms[0].submit();
  }
  else{
    return false; 
  }
}
function confirmDelete_a() {
  // Prompt the user to confirm the deletion
  var confirmed = confirm("Are you sure you want to delete this record?");

  // If the user confirmed, submit the form
  if (confirmed) {
    document.forms[0].submit();
  }
  else{
    return false; 
  }
}
</script>
<?php
if (isset($_POST['delete_imgs'])) {
    
    del_img();
    echo
    "
    <script>
    alert('Images Deletion Successful');
    ";
}
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
?>