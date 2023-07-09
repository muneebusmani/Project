<?php
declare(strict_types=1);
ob_start();

#This Loads Controllers
require('app/controller/userController.php');
user::inc_admin();
user::inc_lawyer();


#This checks if mod_rewrite is enabled
user::check_mod_rewrite();


user::start();

$GLOBALS['doc_root']     = user::host_root();
$GLOBALS['conn']         = user::inc_db();
$GLOBALS['router']       = user::get_uri($_SERVER['REQUEST_URI']);
$GLOBALS['project_root'] = user::project_root();
$GLOBALS['lawyers_img']  = user::lawyers_img();
$GLOBALS['dir']          = user::src();
$GLOBALS['err_dir']      = user::err();

if($router === 'admin') { 
    header('location:app/view/src/admin/index.php');
}

#These are routes defined, for preventing unauthorized access
$route=
array_merge(
    user::routes(),
    admin::routes(),
    lawyer::routes()
);

user::start_body();
user::load_head();
admin::createLawyersDirectory();

//Here are some concatenations
$ext = '.php';
$home = $dir . 'home' . $ext;
$normalUri = $dir . $router . $ext;

$normal = (strpos($router, '?')) ? user::query_check() : $normalUri;


// Extract and remove the query string from the current URI
$pattern = '/^(.*?)\?(.*)$/';
$matches = [];


if (preg_match($pattern, $normal, $matches)) {
    $normal = $matches[1];
    $queryString = $matches[2];
    
    // Parse the query string parameters into an associative array
} else {
    $queryString = '';
}

// This ternary if-else determines if it is a home page or other page, then it processes the request accordingly
$file = ($router === '' || $router === 'home' || $router === 'index') ? $home : $normal;

//Testing all variables
// echo 'home:',$home, '<br>normal:', $normal,'<br>router:', $router ,'<br>file:', $file;




$routes=array_fill_keys($route,'1');
// This will check if the file processed in $file variable exists, if it exists it will include that file, if not then it will include the error 404 page
if (isset($routes[$router])) {
    
        /*
        This will check if the URI request contains the keyword 'admin' or 'lawyer', then it won't render header and footer.
        Otherwise, it will render the full header, footer, etc.
        */
        if (preg_match('/admin\w*/', $file)) {
            admin::load_header();
            require $file;
        } elseif (preg_match('/lawyer\w*/', $file)) {
            admin::load_header();
            require $file;
        }
        else {
            user::load_header();
            require $file;
            user::load_footer();
        }
} else {
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