<?php
declare(strict_types=1);
ob_start();

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
$route=array_merge(user::routes(),admin::routes(),lawyer::routes());

user::start();//HTML start
user::load_head();//HTML Head start
user::start_body();//HTML Body start


// Extract and remove the query string from the current URI
$router=user::query_rm($router);


// This ternary if-else determines if it is a home page or other page, then it processes the request accordingly
$file = ($router === '' || $router === 'home' || $router === 'index') ? 'home' : $router;
//Testing all variables
// echo 'home:',$home, '<br>router:', $router,'<br>router:', $router ,'<br>file:', $file;


$routes=array_fill_keys($route,'1');
// This will check if the file processed in $file variable exists, if it exists it will include that file, if not then it will include the error 404 page
if(       isset($routes[$file]))
{
        /*
        This will check if the URI request contains the keyword 'admin' or 'lawyer', then it won't render header and footer.
        Otherwise, it will render the full header, footer, etc.
        */
        $admin_pages='/admin\w*/';
        $lawyer_pages='/lawyer\w*/';
        $lawyer_profile='/(profile|appointment)(\*w)?/';

        if (preg_match($admin_pages, $file)) {
            $file=$admin_dir.$file.$ext;
            if(file_exists($file)){
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
        
        elseif (preg_match($lawyer_pages, $file)) {
            $file='index';
            $file=$lawyer_dir.$file.$ext;
            if(file_exists($file)){
                admin::load_header();
                require $file;
            }
            else{
                require $err_dir;
            }
        }
        elseif(preg_match($lawyer_profile, $file)){
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