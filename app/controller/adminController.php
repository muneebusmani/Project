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



    public static function create_options(mysqli $conn, string $options)
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


    public static function load_header()
    {
        $header = "app/view/templates/header_a.inc.php";
        require_once($header);
    }
    public static function src(){
        return 'admin/';
    }
    public static function routes(){
        return             
        array(
        #Admin Pages
        'admin_index'                                    ,
        'admin_view'                                    ,
        'admin_update'                                  ,
        'admin_delete'                                  ,
        'admin_add_location'                            ,
        'admin_add_practice_areas'                      ,
        'admin_add_education'                           ,
        'admin_add_experience'                          ,
        'admin_add_custom_location'                          ,
        );
    }

}
