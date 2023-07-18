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
        global $config;
        try {
            require_once('app/model/db.php');
        } catch (\Throwable $e)
        {
            echo "<br><h1>Either Database Doesn't Exist, or wrong/missing configuration, or wrong port</h1><br>"
            ."<h1>Line Number:</h1>"
            .$e->getLine().
            '<br>'.
            '<h1>File In which Error Occured</h1>'
            .$e->getFile();
        }
            return new mysqli
            (
                $config['db_host'],
                $config['db_username'],
                $config['db_password'],
                $config['db_name']
            );
    }
    
    
    public static function inc_favicon()
    {
        echo '<link href="app/view/assets/img/about.jpg" rel="icon">';
    }

    public static function fetch_lawyers(mysqli $conn, $practiceAreaFilter, $locationFilter): void
    {
        $sql = "SELECT * FROM lawyers WHERE speciality = ? AND location = ? and  `status` != 'Booked' and  `status` = 'active'";
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
    public static function list_lawyers(mysqli $conn){
        $sql = "SELECT * FROM lawyers";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }
    public static function open_profile(mysqli $conn,$ID){
        $sql = "SELECT * FROM lawyers where `ID` = ? and  `status` != 'Booked'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$ID);
        $stmt->execute();
        $result=$stmt->get_result();
        if($result->num_rows ==1){
            return $result->fetch_assoc();
        }
        else{
            return;
        }
    }

    
    public static function fetch_options(mysqli $conn, string $column, string $table)
    {
        try {
            $sql = "SELECT $column FROM $table";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $value = $row[$column];
                echo "<option value='$value'>$value</option>";
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
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
            try {
                require_once('app/view/templates/footer.inc.php');
            } catch (\Throwable $e) {
                $file=$e->getFile();
                $line=$e->getLine();
                $message="Unable To load Footer Error In File :$file Line Number : $line";
                echo "<script>alert('$message')</script>";
            }
        }
        
        
        public static function load_header()
        {
            try {
                $header = "app/view/templates/header.inc.php";
                require_once($header);
                
            } catch (\Throwable $e) {
                $file=$e->getFile();
                $line=$e->getLine();
                echo "<script>alert('Unable To load  HTML Header Error In File :$file Line Number : $line')</script>";
                }
        }
        
        public static function load_header_u()
        {
            try {
                $header = "app/view/templates/header_u.inc.php";
                require_once($header);
                
            } catch (\Throwable $e) {
                $file=$e->getFile();
                $line=$e->getLine();
                echo "<script>alert('Unable To load  HTML Header Error In File :$file Line Number : $line')</script>";
                }
        }
        
        
        public static function load_head()
        {
        try {
            $head = "app/view/templates/head.inc.php";
            require_once($head);
        } catch (Exception $e) {
            echo "<script>alert('Unable to Load head')</script>";
            echo $e->getMessage();
        }
    }
    
    
    public static function inc_globals($array)
    {
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
        echo 
        "
        <script type='text/javascript'>
            function goBack(){
                window.history.go(-1);
            }
        </script>
        ";
    }
    
    
    public static function search_lawyers($ID,$Pic,$lawyerName,$lawyerLocation,$lawyerPracticeArea){
        $profile="profile?lawyer=$ID";
        return 
        <<<HTML
        <div class='wrapper' style=''>
        <form action='$profile' method='post'>
        <div class='accordion' style='width:75%;margin:0px auto;'>
        <div class='card'>  
                    <div class='card-header' id='headingOne'>
                        <h2 class='mb-0'>
                            <button class='btn btn-link btn-block text-left' type='submit' data-toggle='collapse' data-target='#collapseOne' aria-expanded='true' aria-controls='collapseOne'>
                                    <input type='hidden' value='$ID'>
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
                            </button>
                        </h2>
                    </div>
                </div>
            </div>
        </form>
        </div>
        HTML;
    }
    public static function lawyers($row)
    {
        try {
            $ID = $row['ID'] ?? '';
            $Pic = $row['Photo'] ?? '';
            $lawyerName = $row['name'] ?? '';
            $lawyerLocation = $row['location'] ?? '';
            $lawyerPracticeArea = $row['speciality'] ?? '';
            
            if (empty($Pic) || empty($lawyerName) || empty($lawyerLocation) || empty($lawyerPracticeArea)) {
                return null;
            }
            $content =self::search_lawyers($ID,$Pic,$lawyerName,$lawyerLocation,$lawyerPracticeArea);            
            return $content;
        } catch (Exception $th) {
            echo "<script>alert('Unable to Fetch Available Lawyers')</script>";
            echo $th->getMessage();
        }
    }
    public static function fetch_name($conn,$lawyer_id){
        $sql="SELECT `name` FROM `lawyers` WHERE `ID` = '$lawyer_id'";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        return $row['name'];
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
    public static function ext(){
        return '.php';
    }
    public static function routes(){
        return array(
            #Public Pages
            ''                                              ,
            'home'                                          ,
            'index'                                         ,
            'default'                                       ,
            'main'                                          ,
            'about'                                         ,
            'contact'                                       ,
            'service'                                       ,
            'signup'                                        ,
            'signin'                                        ,
            'signout'                                       ,
            'user_signout'                                  ,             
        );
    }
    public static function routes_user_signed(){
        return array(
            #Public Pages
            'team'                                          ,
            'search'                                        ,
            'search_output'                                 ,
            'user_reg'                                      ,
            'profile'                                       ,
            'appointment'                                   ,             
            'appointments'                                   ,             
            'user_profile'                                  ,             
            'user_profile_d'                                  ,             
            'user_profile_update'                                  ,             
            'user_profile_delete'                                  ,             
        );
    }
    public static function routes_user_profile(){
        return array(
            'user_profile'                                  ,             
            'user_profile_d'                                  ,             
            'user_profile_update'                                  ,             
            'user_profile_delete'                                  ,             
        );
    }
    public static function br(){
        return '<br>';
    }
    public static function px($unit){
        return 
        "
        padding-left:$unit;
        padding-right:$unit;
        ";
    }
    public static function py($unit){
        return 
        "
        padding-top:$unit;
        padding-bottom:$unit;
        ";
    }
    public static function query_rm($router){
        $pattern = '/^(.*?)\?(.*)$/';
        $matches = [];
        if (preg_match($pattern, $router, $matches)) {
            $router=$matches[1];
        }
        return $router;
}
    public static function profile_nav(){
        require_once('app/view/templates/profile.inc.php');
    }
    public static function complete_uri(){
        $uri=self::get_uri($_SERVER['REQUEST_URI']);
        $uri=self::query_rm($uri);
        return $uri;
    }

}
