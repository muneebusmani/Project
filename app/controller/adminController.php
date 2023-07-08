<?php
class adminController
{
    private $username;
    private $password;
    private function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    private function create_options(mysqli $conn, string $options)
    {
        echo
        "<style>
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
/*************************************************************************************************** 
 
    *  This will Check and create this Directory: 
    linux :     /var/www/html/Project/uploads/lawyers/
    Windows :   C:/xampp/htdocs/Project/uploads/lawyers/

    /*************************************************************************************************** 
     * Inside the function, it checks if the directory specified by $dir already exists using the is_dir() function.
     If the directory doesn't exist, it proceeds to the next step.

    * The mkdir() function is then used to create the directory.
    * The directory path is specified by $dir, and the permissions for the directory are set to 0777.
    * The 0777 permission value allows full read, write, and execute permissions for the directory.
    * The true parameter passed as the third argument ensures that the function creates any necessary parent directories
    along with the specified directory.

    * If the directory creation is successful, the function completes its execution.
    * If the directory already exists, it doesn't attempt to create it again.
    * In the commented-out code line, it was meant to echo a message indicating that the directory already exists,
    * but it is currently commented out.

****************************************************************************************************/
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
}