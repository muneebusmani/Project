<?php

class user
{
    public static function inc_css()
    {
        $cssDir = 'app/view/assets/css/';
        $css = glob($cssDir . '*.css');
        foreach ($css as $cs) {
            echo '<link rel="stylesheet" href="' . $cs . '">';
        }
    }



    public static function inc_db()
    {
        $host = 'localhost';
        $username = 'root';
        $password = 'admin';
        $db_name = 'JusticiaLaw';
        $conn = new mysqli($host, $username, $password, $db_name);
        return $conn;
    }


    public static function inc_favicon()
    {
        echo '<link href="app/view/assets/img/about.jpg" rel="icon">';
    }


    public static function fetch_lawyers($conn, $practiceAreaFilter, $locationFilter): void
    {
        $sql = "SELECT * FROM lawyers WHERE speciality = ? AND location = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $practiceAreaFilter, $locationFilter);
        $stmt->execute();
        $result = $stmt->get_result();
        $foundLawyers = false;
        while ($row = $result->fetch_assoc()) {
            $lawyers = self::lawyers($row);
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


    public static function fetch_options(mysqli $conn, string $column, string $table)
    {
        // Construct the SQL query
        $sql = "SELECT $column FROM $table";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $value = $row[$column];
            echo "<option value='$value'>$value</option>";
        }
    }


    public static function fetch_post()
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


    public static function load_footer()
    {
        $footer = "app/view/templates/footer.inc.php";
        require_once($footer);
    }


    public static function load_header()
    {
        $header = "app/view/templates/header.inc.php";
        require_once($header);
    }


    public static function load_head()
    {
        $head = "app/view/templates/head.inc.php";
        require_once($head);
    }


    public static function inc_globals($array)
    {
        /*************************************************************************************************** 
         * This public static function is created to just create and include the superglobals into index file
         ****************************************************************************************************/
        foreach ($array as $key => $value) {
            $GLOBALS[$key] = $value;

        }
}


    /*
This public static function automatically loads all of the js files present inside js folder
*/
    public static function inc_js()
    {
        $js_dir = 'app/view/assets/js/';
        $js_files = glob($js_dir . '*.js');

        foreach ($js_files as $js) {
            $js_filename = basename($js);
            echo "<script src='$js_dir$js_filename'></script>";
        }
    }


    public static function lawyers($row)
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


    public static function query_check()
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


    public static function get_uri()
    {
        $request = $_SERVER['REQUEST_URI'];
        $request = str_replace($GLOBALS['project_root'], '', $request);
        return $request;
    }
    /*
***********************************************************************************************************************************************************
 
 *  This public static function removes the project root folder /Project/ from the requested uri for easy process and returns the cleaned URI in output
 
***********************************************************************************************************************************************************
*/
public static function inc_admin(){
    require('app/controller/adminController.php');
}
public static function inc_lawyer(){
    require('app/controller/lawyerController.php');
}
}