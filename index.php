<?php
declare(strict_types=1);
ob_start();
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);


#This Loads Controllers
require('app/controller/userController.php');
user::inc_admin();
user::inc_lawyer();


#This checks if mod_rewrite is enabled
user::check_mod_rewrite();

$GLOBALS['doc_root']     = user::host_root();
$GLOBALS['conn']         = user::inc_db();
$GLOBALS['router']       = user::get_uri($_SERVER['REQUEST_URI']);
$GLOBALS['project_root'] = user::project_root();
$GLOBALS['lawyers_img']  = user::lawyers_img();
$GLOBALS['dir']          = user::src();
$GLOBALS['admin_dir']    = admin::src();
$GLOBALS['lawyer_dir']   = lawyer::src();
$GLOBALS['err_dir']      = user::err();
$GLOBALS['ext']          = user::ext();


admin::createLawyersDirectory();
#These are routes defined, for preventing unauthorized access
// $route=array_merge(user::routes(),admin::routes(),lawyer::routes());
// $route=array_merge(user::routes(),user::routes_user_signed());
// $route=user::routes();
$route=array_merge(user::routes(),admin::routes(),lawyer::routes());
// $route=lawyer::routes();

// echo $_SESSION['username'];
if (isset($_SESSION['username']) && $_SESSION['loggedin'] == true ) {
    $route=array_merge($route,user::routes_user_signed());
}
if ((!isset($_SESSION['username']) )  && in_array(user::complete_uri(),user::routes_user_signed())) {
    echo 
    "<script>
    alert('You Need to Login To Use That Feature!');
    window.location.href = 'home';
    </script>
";
}


user::start();//HTML start
user::load_head();//HTML Head start
user::start_body();//HTML Body start


// Extract and remove the query string from the current URI
$router=user::complete_uri();

// This ternary if-else determines if it is a home page or other page, then it processes the request accordingly
$file = ($router === '' || $router === 'home' || $router === 'index') ? 'home' : $router;
//Testing all variables
// echo 'home:',$home, '<br>router:', $router,'<br>router:', $router ,'<br>file:', $file;


$routes=array_fill_keys($route,'1');
// This will check if the file processed in $file variable exists, if it exists it will include that file, if not then it will include the error 404 page

if(       isset($routes[$file]))
{
    if (user::complete_uri() == 'admin') {header('location:admin_dashboard');}
        /*
        This will check if the URI request contains the keyword 'admin' or 'lawyer', then it won't render header and footer.
        Otherwise, it will render the full header, footer, etc.
        */

        $admin_pages='/admin\w*/';
        // $lawyer_pages='/lawyer\w*/';
        $lawyer_pages = '/lawyer(?!_signin|_signup|_signout)\w*/';
        $lawyer_auth = '/^lawyer_(signin|signup|signout)$/';
        $lawyer_profile='/(appointment|profile)(\*w)?/';
        // $lawyer_profile=array('appointment','profile');  
        $user_sign='/(signin|signup)(\*w)?/';
        $user_pages='/^user.+/';
        
        if (preg_match($user_pages, $file)):
            user::load_header_u();
        endif;

        if (preg_match($admin_pages, $file)) {
            $file=$admin_dir.$file.$ext;
            if(file_exists($file)){
                if
                (
                !(isset($_SESSION['admin_username']))
                &&  
                user::complete_uri()!= 'admin_signin'
                )
                {
                    header('location:admin_signin');}
                admin::load_header();
                require $file;
                echo 
                "
                </main>
                </div>
                </div>
                ";
            }
            else{
                require $err_dir;
            }
        }
        
        elseif(preg_match($lawyer_pages,$file)) {
            $file=$lawyer_dir.$file.$ext;
            lawyer::load_header();
            require $file;
        }
        elseif(preg_match($lawyer_auth,$file)) {
            $file=$lawyer_dir.$file.$ext;
            require $file;
        }
        elseif(preg_match($lawyer_profile,$file)) {
            // elseif(in_array($file,$lawyer_profile)){
                $file=$dir.$file.$ext;
                if(file_exists($file)){
                    require $file;
                }
                else{
                require $err_dir;
            }
        }
        elseif(preg_match($user_sign, $file)){
            $file=$dir.$file.$ext;
            if(file_exists($file)){
                require $file;
            }
            else{
                require $err_dir;
            }
        }
        else{
            $file=$dir.$file.$ext;
            if(file_exists($file)){
                user::load_header();
                require $file;
                user::load_footer();
            }
            else{
                require $err_dir;
            }
        }
    }
    else {
        require $err_dir;
    }

#Frontend JavaScript Libraries For Carousel and other minor UI components
user::inc_libs();

#This Loads Dark mode api
user::inc_darkreader();

#This Method Loads js which is responsible for responsiveness of this web app
user::inc_js();

#This Loads Mailer
if ($router === 'contact') {
user::inc_mailer();
}
user::close_body();
user::close_html();



ob_end_flush();