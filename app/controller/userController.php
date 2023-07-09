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
        $ID = $row['ID'] ?? '';
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
                            <input type'hidden' value'$ID'>
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
        </div>"
        ;

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


    public static function get_uri($request)
    {
        $request = str_replace(user::project_root(), '', $request);
        return $request;
    }
    /*
***********************************************************************************************************************************************************
 
 *  This public static function removes the project root folder /Project/ from the requested uri for easy process and returns the cleaned URI in output
 
***********************************************************************************************************************************************************
*/
    public static function inc_admin()
    {
        require('app/controller/adminController.php');
    }
    public static function inc_lawyer()
    {
        require('app/controller/lawyerController.php');
    }
    public static function inc_libs()
    {
        echo '
        <script src="app/view/assets/lib/jquery/jquery.min.js"></script>
        <script src="app/view/assets/lib/bootstrapbundlejs/bootstrap.bundle.min.js"></script>
        <script src="app/view/assets/lib/easing/easing.min.js"></script>
        <script src="app/view/assets/lib/waypoints/waypoints.min.js"></script>
        <script src="app/view/assets/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="app/view/assets/lib/tempusdominus/js/moment.min.js"></script>
        <script src="app/view/assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="app/view/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
';
    }
    public static function inc_darkreader()
    {
        echo 
        '
        <script src="app/view/assets/lib/darkreader/darkreader.min.js"></script>
        <script src="app/view/assets/lib/darkreader/darkreader.config.js"></script>
        ';
    }
    public static function inc_mailer(){
        
        echo 
        '
        <!-- Contact Javascript File -->
        <script src="app/view/src/mail/jqBootstrapValidation.min.js"></script>
        <script src="app/view/src/mail/contact.js"></script>
            '
            ;
        }

    public static function close_body(){
        echo '</body>';
    }
    public static function close_html(){
        echo '</html>';
    }
    public static function check_mod_rewrite(){
        if (!in_array('mod_rewrite', apache_get_modules())) {
            echo "mod_rewrite is not enabled on this server";
            exit;
        };
    }
    public static function start(){
        echo
        '
        <!DOCTYPE html>
        <html lang="en">
        ';
    }
    public static function start_body(){
        echo 
        '<body>';
    }
    public static function project_root(){
        return '/Project/';
    }
    public static function lawyers_img(){
        return 'uploads/lawyers';
    }
    public static function src(){
        return 'app/view/src/';
    }
    public static function err(){
        return 'app/view/src/404.php';
    }
    public static function host_root(){
        return $_SERVER['DOCUMENT_ROOT'];
    }
    public static function routes(){
        return array(
            #Public Pages
            ''                                              ,
            'home.php?'                                     ,
            'index.php?'                                    ,
            'default.php?'                                  ,
            'main.php?'                                     ,
            'about.php?'                                    ,
            'contact.php?'                                  ,
            'service.php?'                                  ,
            'team.php?'                                     ,
            'user_reg.php?'                                 ,
            'search_output.php?'                            ,
            'search.php?'                                   ,
            'home'                                          ,
            'index'                                         ,
            'default'                                       ,
            'main'                                          ,
            'about'                                         ,
            'contact'                                       ,
            'service'                                       ,
            'team'                                          ,
            'search'                                        ,
            'search_output'                                 ,
            'user_reg'                                      ,
        );
    }

    

}
