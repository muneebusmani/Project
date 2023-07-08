<?php

class user
{


    private function createLawyersDirectory()
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
    }

    /*************************************************************************************************** 
 
     *  This will Check and create this Directory: 
 linux :     /var/www/html/Project/uploads/lawyers/
 Windows :   C:/xampp/htdocs/Project/uploads/lawyers/
 
/*************************************************************************************************** 
     * Inside the private function, it checks if the directory specified by $dir already exists using the is_dir() private function.
      If the directory doesn't exist, it proceeds to the next step.

     * The mkdir() private function is then used to create the directory.
     * The directory path is specified by $dir, and the permissions for the directory are set to 0777.
     * The 0777 permission value allows full read, write, and execute permissions for the directory.
     * The true parameter passed as the third argument ensures that the private function creates any necessary parent directories
      along with the specified directory.

     * If the directory creation is successful, the private function completes its execution.
     * If the directory already exists, it doesn't attempt to create it again.
     * In the commented-out code line, it was meant to echo a message indicating that the directory already exists,
     * but it is currently commented out.

     ****************************************************************************************************/


    private function create_options(mysqli $conn, string $options)
    {
        echo
        "
<style>
  .wrapper{
    margin: 0px auto;
    width: 30rem;
    height: 15rem;
    --margin:10%;
    margin: var(--margin) auto;
    border: 2px solid black;
  }
</style>
<div class='wrapper'>
<a class='fas fa-window-close fa-lg float-right' style='color: #ff0000;' href='admin_view'>
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


    private function deleteLawyersDirectory()
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


    private function fetch_options_adv(mysqli $conn, string $column, string $table, string $selectedValue)
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


    private function load_header_a()
    {
        $header = "app/view/templates/header_a.inc.php";
        require_once($header);
    }


    private function bulk_sanitize($name, $number, $email, $address, $speciality, $education, $experience, $password)
    {
        $name       = (!empty($name)) ? sanitize($name) : 'Empty';
        $number     = (!empty($number)) ? sanitize($number) : 'Empty';
        $email      = (!empty($email)) ? sanitize($email) : 'Empty';
        $address    = (!empty($address)) ? sanitize($address) : 'Empty';
        $speciality = (!empty($speciality)) ? sanitize($speciality) : 'Empty';
        $education  = (!empty($education)) ? sanitize($education) : 'Empty';
        $experience = (!empty($experience)) ? sanitize($experience) : 'Empty';
        $password   = (!empty($password)) ? sanitize($password) : 'Empty';
    }


    private function file_handle()
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



    private function handle_err(array $values)
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
            return null;
        }
    }


    private function prepare_and_execute($conn, $img, $name, $location, $number, $email, $address, $speciality, $education, $experience, $password)
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


    private function sanitize($data)
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


    /*
This private function automatically loads all of the CSS files present inside the css folder
*/
    private function inc_css()
    {
        $cssDir = 'app/view/assets/css/';
        $css = glob($cssDir . '*.css');
        foreach ($css as $cs) {
            echo '<link rel="stylesheet" href="' . $cs . '">';
        }
    }



    private function inc_db()
    {
        $host = 'localhost';
        $username = 'root';
        $password = 'admin';
        $db_name = 'JusticiaLaw';
        $conn = new mysqli($host, $username, $password, $db_name);
        return $conn;
    }


    private function inc_favicon()
    {
        echo '<link href="app/view/assets/img/about.jpg" rel="icon">';
    }


    private function fetch_lawyers($conn, $practiceAreaFilter, $locationFilter): void
    {
        $sql = "SELECT * FROM lawyers WHERE speciality = ? AND location = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $practiceAreaFilter, $locationFilter);
        $stmt->execute();
        $result = $stmt->get_result();
        $foundLawyers = false;
        while ($row = $result->fetch_assoc()) {
            $lawyers = lawyers($row);
            if ($lawyers === null) {
                header('location:search?lawyers=null');
            } else {
                $foundLawyers = true;
                echo $lawyers;
            }
        }

        if (!$foundLawyers) {
            header('location:search?lawyers=null');
        }
        $stmt->close();
    }


    private function fetch_options(mysqli $conn, string $column, string $table)
    {
        // Construct the SQL query
        $sql = "SELECT $column FROM $table";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $value = $row[$column];
            echo "<option value='$value'>$value</option>";
        }
    }


    private function fetch_post()
    {
        global $name, $number, $email, $address, $speciality, $education, $experience, $password;
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $speciality = $_POST['speciality'];
        $education = $_POST['education'];
        $experience = $_POST['experience'];
        $password = $_POST['password'];
    }


    private function load_footer()
    {
        $footer = "app/view/templates/footer.inc.php";
        require_once($footer);
    }


    private function load_header()
    {
        $header = "app/view/templates/header.inc.php";
        require_once($header);
    }


    private function load_head()
    {
        $head = "app/view/templates/head.inc.php";
        require_once($head);
    }


    private function inc_globals()
    {
        /*************************************************************************************************** 
         * This private function is created to just create and include the superglobals into index file
         ****************************************************************************************************/

        //Document root from which is renamed to localhost
        $GLOBALS['doc_root'] = $_SERVER['DOCUMENT_ROOT'];

        //Project root aka Parent folder in which this file is place
        $GLOBALS['project_root'] = '/Project/';


        //Lawyers image registration folder
        $GLOBALS['lawyers_img'] = 'uploads/lawyers';


        //This connects to the database
        $GLOBALS['conn'] = inc_db();

        //This private function will fetch, sanitize, and then output the URI
        $GLOBALS['router'] = get_uri();

        //This is the directory which contains all pages
        $GLOBALS['dir'] = 'app/view/src/';

        //This is the file which gets loaded if the requested file doesn't exist
        $GLOBALS['err_dir'] = 'app/view/src/404.php';
    }


    /*
This private function automatically loads all of the js files present inside js folder
*/
    private function inc_js()
    {
        $js_dir = 'app/view/assets/js/';
        $js_files = glob($js_dir . '*.js');

        foreach ($js_files as $js) {
            $js_filename = basename($js);
            echo "<script src='$js_dir$js_filename'></script>";
        }
    }


    private function lawyers($row)
    {
        $Pic = $row['Photo'] ?? '';
        $lawyerName = $row['name'] ?? '';
        $lawyerLocation = $row['location'] ?? '';
        $lawyerPracticeArea = $row['speciality'] ?? '';

        if (empty($Pic) || empty($lawyerName) || empty($lawyerLocation) || empty($lawyerPracticeArea)) {
            return null;
        }

        $content = "
        <div class='wrapper' style=''>
        <form action='profile' method='post'>
            <div class='accordion' style='width:75%;margin:0px auto;'>
                <div class='card'>
                    <div class='card-header' id='headingOne'>
                        <h2 class='mb-0'>
                            <button class='btn btn-link btn-block text-left' type='button' data-toggle='collapse' data-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>
                                <a href='lawyer_create'>
                                    <span class='d-flex justify-content-center'>
                                        <p class='lawyer-photo' style='
                                            width:2.5rem;
                                            height:2.5rem;
                                            background-size: cover;
                                            background-image: url($Pic);'
                                        ></p>
                                        <p class='w-33 align-middle'>$lawyerName</p>
                                        <p class='w-33 align-middle'>$lawyerLocation</p>
                                        <p class='w-33 align-middle'>$lawyerPracticeArea</p>
                                    </span>
                                </a>
                            </button>
                        </h2>
                    </div>
                </div>
            </div>
        </form>
        </div>";

        return $content;
    }


    private function query_check()
    {

        global $router, $ext, $dir;
        // Split the request URI into path and query string
        list($path, $queryString) = explode('?', $router, 2);
        // Append the '.php' extension to the path
        $path = rtrim($path, '/') . $ext;

        $router = $path . '?';
        // Reconstruct the modified URL
        $query = $dir . $router;

        return $query;
    }


    private function get_uri()
    {
        $request = $_SERVER['REQUEST_URI'];
        $request = str_replace($GLOBALS['project_root'], '', $request);
        return $request;
    }
    /*
***********************************************************************************************************************************************************
 
 *  This private function removes the project root folder /Project/ from the requested uri for easy process and returns the cleaned URI in output
 
***********************************************************************************************************************************************************
*/
}
