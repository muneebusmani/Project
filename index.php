<?php
declare(strict_types=1);
//This checks if mod_rewrite is enabled
if (!in_array('mod_rewrite', apache_get_modules())) {
    echo "mod_rewrite is not enabled on this server";
};
//This will load all functions to all pages 
//because we are including pages based on request so every page can access the functions because of this file
$autoloader = 'app/view/src/autoload_func.php';
require($autoloader);
autoloadFunctions();

//Path which needs to be created if doesnt exist
$directory = $_SERVER['DOCUMENT_ROOT'].'/Project/' . '/uploads/lawyers';

//This creates uploads/lawyers if it doesnt exist, this is done because git doesnt push empty folders
createLawyersDirectory($directory);

//This connects to the database
$conn = inc_db();

//This function will fetch, sanitize, and then output the URI
$router = get_uri();

//This is the directory which contains all pages
$dir = 'app/view/src/';

//This is the file which gets loaded if the requested file doesn't exist
$err_dir = 'app/view/src/404.php';

//Here are some concatenations
$ext = '.php';
$home = $dir . 'home' . $ext;
$normalUri = $dir . $router . $ext;

$normal = (strpos($router, '?')) ? query_check() : $normalUri;
global $GET;
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
$route=
[
//These routes for uri with 
'home.php?'             ,
'index.php?'            ,
'default.php?'          ,
'main.php?'             ,
'about.php?'            ,
'contact.php?'          ,
'service.php?'          ,
'team.php?'             ,

'home'              ,
'index'             ,
'default'           ,
'main'              ,
'about'             ,
'contact'           ,
'service'           ,
'team'              
];
$routes=array_fill_keys($route,'1');
// This will check if the file processed in $file variable exists, if it exists it will include that file, if not then it will include the error 404 page
if (file_exists($file) && isset($routes[$router])) {
//checking if query string is sent
// print_r($_GET);
    if (preg_match('/(admin\w*|lawyer\w*)/', $file)) {
        /*
        This will check if the URI request contains the keyword 'admin' or 'lawyer', then it won't render header and footer.
        Otherwise, it will render the full header, footer, etc.
        */
        load_head();
        if (preg_match('/admin\w*/', $file)) {
            echo '
                <!DOCTYPE html>
                <html lang="en">
                ' . load_head() . '
                <body>
                ';
            load_header_a();
            require $file;
            echo "
                </body>
                </html>
                ";
        } elseif (preg_match('/lawyer\w*/', $file)) {
            echo '
            <!DOCTYPE html>
            <html lang="en">
            ' . load_head() . '
            <body>
            ';
            load_header_a();
            require $file;
            echo "
            </body>
            </html>
            ";
        }
    } else {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        ' . load_head() . '
        <body>
        ';
        load_header();
        require $file;
        load_footer();
        echo "
        </body>
        </html>
        ";
    }
} else {
    require $err_dir;
}
?>
