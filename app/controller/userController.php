<?php

class user
{
    public function inc_css()
    {
        $cssDir = 'app/view/assets/css/';
        $css = glob($cssDir . '*.css');
        foreach ($css as $cs) {
            echo '<link rel="stylesheet" href="' . $cs . '">';
        }
    }



    public function inc_db()
    {
        $host = 'localhost';
        $username = 'root';
        $password = 'admin';
        $db_name = 'JusticiaLaw';
        $conn = new mysqli($host, $username, $password, $db_name);
        return $conn;
    }


    public function inc_favicon()
    {
        echo '<link href="app/view/assets/img/about.jpg" rel="icon">';
    }


    public function fetch_lawyers($conn, $practiceAreaFilter, $locationFilter): void
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


    public function fetch_options(mysqli $conn, string $column, string $table)
    {
        // Construct the SQL query
        $sql = "SELECT $column FROM $table";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $value = $row[$column];
            echo "<option value='$value'>$value</option>";
        }
    }


    public function fetch_post()
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


    public function load_footer()
    {
        $footer = "app/view/templates/footer.inc.php";
        require_once($footer);
    }


    public function load_header()
    {
        $header = "app/view/templates/header.inc.php";
        require_once($header);
    }


    public function load_head()
    {
        $head = "app/view/templates/head.inc.php";
        require_once($head);
    }


    public function inc_globals()
    {
        /*************************************************************************************************** 
         * This public function is created to just create and include the superglobals into index file
         ****************************************************************************************************/

        //Document root from which is renamed to localhost
        $GLOBALS['doc_root'] = $_SERVER['DOCUMENT_ROOT'];

        //Project root aka Parent folder in which this file is place
        $GLOBALS['project_root'] = '/Project/';


        //Lawyers image registration folder
        $GLOBALS['lawyers_img'] = 'uploads/lawyers';


        //This connects to the database
        $GLOBALS['conn'] = inc_db();

        //This public function will fetch, sanitize, and then output the URI
        $GLOBALS['router'] = get_uri();

        //This is the directory which contains all pages
        $GLOBALS['dir'] = 'app/view/src/';

        //This is the file which gets loaded if the requested file doesn't exist
        $GLOBALS['err_dir'] = 'app/view/src/404.php';
    }


    /*
This public function automatically loads all of the js files present inside js folder
*/
    public function inc_js()
    {
        $js_dir = 'app/view/assets/js/';
        $js_files = glob($js_dir . '*.js');

        foreach ($js_files as $js) {
            $js_filename = basename($js);
            echo "<script src='$js_dir$js_filename'></script>";
        }
    }


    public function lawyers($row)
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


    public function query_check()
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


    public function get_uri()
    {
        $request = $_SERVER['REQUEST_URI'];
        $request = str_replace($GLOBALS['project_root'], '', $request);
        return $request;
    }
    /*
***********************************************************************************************************************************************************
 
 *  This public function removes the project root folder /Project/ from the requested uri for easy process and returns the cleaned URI in output
 
***********************************************************************************************************************************************************
*/
}
