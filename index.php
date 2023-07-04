<?php
declare(strict_types=1);
ob_start();
//This checks if mod_rewrite is enabled
if (!in_array('mod_rewrite', apache_get_modules())) {
    echo "mod_rewrite is not enabled on this server";
};

//This will load all functions to all pages 
//because we are including pages based on request so every page can access the functions because of this file
$autoloader = 'app/view/src/autoload_func.php';
require($autoloader);
autoloadFunctions();
?>
<!DOCTYPE html>
<html lang="en">
<?php

//Document root from which is renamed to localhost
$GLOBALS['doc_root'] = $_SERVER['DOCUMENT_ROOT'];

//Project root aka Parent folder in which this file is place
$GLOBALS['project_root'] = '/Project/';


//Lawyers image registration folder
$GLOBALS['lawyers_img']='uploads/lawyers';


//This connects to the database
$GLOBALS['conn']=inc_db();

//This function will fetch, sanitize, and then output the URI
$GLOBALS['router'] = get_uri();

//This is the directory which contains all pages
$GLOBALS['dir'] = 'app/view/src/';

//This is the file which gets loaded if the requested file doesn't exist
$GLOBALS['err_dir'] = 'app/view/src/404.php';

($router === 'admin') ? header('location:app/view/src/admin/'):null;
load_head();?>
<style>

</style>

<body>
<?php




// Code For Path which needs to be created if doesnt exist
createLawyersDirectory();

//Here are some concatenations
$ext = '.php';
$home = $dir . 'home' . $ext;
$normalUri = $dir . $router . $ext;


$normal = (strpos($router, '?')) ? query_check() : $normalUri;


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



//These are routes defined, for preventing unauthorized access  
$route=
[
''                      ,
'home.php?'             ,
'index.php?'            ,
'default.php?'          ,
'main.php?'             ,
'about.php?'            ,
'contact.php?'          ,
'service.php?'          ,
'team.php?'             ,

'admin_view.php?'       ,
'admin_update.php?'     ,
'admin_delete.php?'     ,
'lawyer_create.php?'    ,

'admin_view'            ,
'admin_update'          ,
'admin_delete'          ,
'lawyer_create'         ,

'home'                  ,
'index'                 ,
'default'               ,
'main'                  ,
'about'                 ,
'contact'               ,
'service'               ,
'team'                  ,
'admin'                 
];

$routes=array_fill_keys($route,'1');
// This will check if the file processed in $file variable exists, if it exists it will include that file, if not then it will include the error 404 page
if (file_exists($file) && isset($routes[$router])) {
    if (preg_match('/(admin\w*|lawyer\w*)/', $file)) {
        /*
        This will check if the URI request contains the keyword 'admin' or 'lawyer', then it won't render header and footer.
        Otherwise, it will render the full header, footer, etc.
        */
        if (preg_match('/admin\w*/', $file)) {
            load_header_a();
            require $file;
        } elseif (preg_match('/lawyer\w*/', $file)) {
            load_header_a();
            require $file;
        }
    } else {
        load_header();
        require $file;
        load_footer();
    }
} else {
    require $err_dir;
}
?>


<!-- Frontend JavaScript Libraries For Carousel and other minor UI components -->
<script src="app/view/assets/lib/jquery/jquery.min.js"></script>
<script src="app/view/assets/lib/bootstrapbundlejs/bootstrap.bundle.min.js"></script>
<script src="app/view/assets/lib/easing/easing.min.js"></script>
<script src="app/view/assets/lib/waypoints/waypoints.min.js"></script>
<script src="app/view/assets/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="app/view/assets/lib/tempusdominus/js/moment.min.js"></script>
<script src="app/view/assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="app/view/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Dark mode Api -->
<script src="app/view/assets/lib/darkreader/darkreader.min.js"></script>
<script src="app/view/assets/lib/darkreader/darkreader.config.js"></script>

<!-- Custom JS-->
<?php
inc_js();
if($router = 'contact'){
    echo 
    '
    <!-- Contact Javascript File -->
    <script src="app/view/src/mail/jqBootstrapValidation.min.js"></script>
    <script src="app/view/src/mail/contact.js"></script>
    '
    ;
}
?>
</body>
</html>
<?php
ob_end_flush();
?>