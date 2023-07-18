<?php
class admin
{
    public static function createLawyersDirectory()
    {
        $dir =
            $GLOBALS['doc_root'] .
            $GLOBALS['project_root'] .
            $GLOBALS['lawyers_img'];
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        } else {
            // echo '"uploads/lawyers/" already exists';
        }
        /*************************************************************************************************** 
     
         *  This will Check and create this Directory: 
     linux :     /var/www/html/Project/uploads/lawyers/
     Windows :   C:/xampp/htdocs/Project/uploads/lawyers/
     
    /*************************************************************************************************** 
         * Inside the public static function, it checks if the directory specified by $dir already exists using the is_dir() public static function.
          If the directory doesn't exist, it proceeds to the next step.
    
         * The mkdir() public static function is then used to create the directory.
         * The directory path is specified by $dir, and the permissions for the directory are set to 0777.
         * The 0777 permission value allows full read, write, and execute permissions for the directory.
         * The true parameter passed as the third argument ensures that the public static function creates any necessary parent directories
          along with the specified directory.
    
         * If the directory creation is successful, the public static function completes its execution.
         * If the directory already exists, it doesn't attempt to create it again.
         * In the commented-out code line, it was meant to echo a message indicating that the directory already exists,
         * but it is currently commented out.
    
         ****************************************************************************************************/
    }

    public static function fetch_lawyers(mysqli $conn){
        echo
<<<HTML
<style>
    tr, th, td {
        border: 2px solid black;
        padding: 8px;
        text-align: center;
    }

    .btn-danger, .btn-success, .btn-primary {
        border-radius: 100px;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: middle;
    }

    .table th {
        font-weight: bold;
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody+tbody {
        border-top: 2px solid #dee2e6;
    }

    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        color: #fff;
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .btn-success {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        color: #fff;
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn {
        margin: 0.5rem;
        height:2.5rem;
        width:5rem;
        text-align: center;
    }

    .delete-form {
        display: inline-block;
        margin-top: 1rem;
    }

    .display1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }
</style>
<h1 class="text-center my-5">
    Registered Lawyers
</h1>
<div class="table-responsive">
<table class="table w-100 ">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">Full Name</th>
            <th scope="col">Status</th>
            <th scope="col">Location</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Residential Address</th>
            <th scope="col">Practice Area</th>
            <th scope="col">Education</th>
            <th scope="col">Experience</th>
            <th scope="col">Password</th>
            <th scope="col">Manage</th>
        </tr>
    </thead>
    <tbody>
HTML;


        $sql = 'SELECT * FROM lawyers';
        $result = $conn->query($sql);
        while ($rows = $result->fetch_assoc()) {
            $ID = $rows['ID'];
            $Photo = $rows['Photo'];
            $name = $rows['name'];
            $status = $rows['Status'];
            $Location = $rows['location'];
            $number = $rows['number'];
            $email = $rows['email'];
            $address = $rows['address'];
            $speciality = $rows['speciality'];
            $education = $rows['education'];
            $experience = $rows['experience'];
            $password = $rows['password'];
            echo "
            <tr>
                <td>$ID</td>
                <td><img src='$Photo' alt='$name' width='50px' height='50px'></td>
                <td>$name</td>
                <td>$status</td>
                <td>$Location</td>
                <td>$email</td>
                <td>$number</td>
                <td>$address</td>
                <td>$speciality</td>
                <td>$education</td>
                <td>$experience</td>
                <td>$password</td>
                <td style='width: 20%;'>
                    <span>
                        <form class='d-inline' method='POST' action='admin_update_lawyer'> 
                            <input value='$ID' name='id' type='hidden'>
                            <button type='submit' name='update' class='btn btn-success' value='Update'>Update</button>
                        </form>
                        <form class='d-inline delete-form' method='POST' action='admin_delete_lawyer'>
                            <input value='$ID' name='id' type='hidden'>
                            <button type='submit' name='delete' onclick='confirmDelete_a();' class='btn btn-danger' value='Delete'>Delete</button>
                        </form>
                    </span>
                </td>
            </tr>
            ";
        }
echo 
<<<HTML
        </tbody>
    </table>
    </div>
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
        function confirmDelete_a() {
            // Prompt the user to confirm the deletion
            var confirmed = confirm("Are you sure you want to delete this record?");
            
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
HTML;

}

    public static function create_options(mysqli $conn, string $options)
    {
        echo
        "
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
<script>
window.addEventListener('DOMContentLoaded', (event) => {
    // Wait for the DOM to be fully loaded
    const inputField = document.getElementById('$options');
    inputField.focus();
});
</script>
<div class='wrap'>
<a class='fas fa-window-close fa-lg float-right' style='color: #ff0000;' href='admin_view_lawyer'>
</a>
<form class='text-center py-5' method='POST'>
  <h1>Add $options</h1>
  <label for='$options'>$options</label>
  <input type='text' id='$options' name='option' required>
  <input type='submit' value='Add'>
  </form>
  </div>
  ";
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Get the location value from the form
            $choice = $_POST['option'];

            // Insert the location into the options table
            $sql = "CREATE TABLE IF NOT EXISTS `$options` (`$options` varchar(255));
        INSERT INTO `$options` (`$options`) VALUES ('$choice');";

            if ($conn->multi_query($sql) === TRUE) {
                echo "$choice added successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
    
    public static function fetch_options(mysqli $conn, string $options)
    {
        $sql = "SELECT `$options` FROM `$options`";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            echo "
            <style>
            table {
                width: 100%;
                text-align: center;
            }
            td {
                border: 2px solid gray;
                padding: 1rem 2rem;
            }
            </style>
            <table>
            ";
    
            while ($row = $result->fetch_assoc()) {
                $randomColor = self::generateRandomColor();
                $textColor = self::getContrastColor($randomColor);
                echo "<tr><td style='background-color: $randomColor; color: $textColor;'>" . $row[$options] . "</td></tr>";
            }
    
            echo "</table>";
        } else {
            echo "No $options found.";
        }
    }
    
    private static function generateRandomColor()
    {
        $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        return $color;
    }
    
    private static function getContrastColor($hexColor)
    {
        $r = hexdec(substr($hexColor, 1, 2));
        $g = hexdec(substr($hexColor, 3, 2));
        $b = hexdec(substr($hexColor, 5, 2));
    
        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
        return ($yiq >= 128) ? '#000000' : '#FFFFFF';
    }
    



    public static function deleteLawyersDirectory()
    {
        $directory = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lawyers';

        if (is_dir($directory)) {
            $success = rmdir($directory);

            if ($success) {
                echo "Directory 'uploads/lawyers' deleted successfully!";
            } else {
                echo "Failed to delete directory 'uploads/lawyers'.";
            }
        } else {
            echo "Directory 'uploads/lawyers' does not exist.";
        }
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
    public static function fetch_username_and_role(mysqli $conn,$username){
        $query = "SELECT `role`,`username` FROM `admins` WHERE `username` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        foreach ($row as $key => $value) {
            $_SESSION['admin_'.$key]=$value;
        }
        $stmt->close();
    }
    public static function check_if_exists(mysqli $conn,string $username,string $password){
        $query = "SELECT * FROM admins WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public static function login_page(){
        require_once 'app/view/templates/login_admin.inc.php';
    }

    public static function load_header()
    {
        $header = "app/view/templates/header_a.inc.php";
        require_once($header);
    }
    public static function src(){
        return 'management/';
    }
    public static function routes(){
        return             
        array(
        #Admin Pages
        'admin'                                   ,
        'admin_signin'                                   ,
        'admin_signout'                                   ,
        'admin_dashboard'                                   ,
        'admin_view_lawyer'                             ,
        'admin_view_appointments'                       ,
        'admin_update_lawyer'                           ,
        'admin_delete_lawyer'                           ,
        'admin_delete_images'                           ,
        'admin_delete_appointments'                                  ,
        'admin_add_location'                            ,
        'admin_add_practice_areas'                      ,
        'admin_add_education'                           ,
        'admin_add_experience'                          ,
        'admin_add_custom_location'                     ,
        'admin_add_lawyer'                              ,
        'admin_update_appointment'                      ,
        'admin_delete_appointment'                      ,
        );
    }

}
