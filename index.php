<?php
//This will load All functions to all pages because we are including pages based on request so every page can access the functions because of this file
$autoloader='app/view/src/autoload_func.php';
require($autoloader);
autoloadFunctions();


//This is the main route file in which i defined the routes for the website


//This checks if mod_rewrite is enabled
if(!in_array('mod_rewrite', apache_get_modules())){
    echo "mod_rewrite is not enabled on this server";
};

//This function will Fetch, sanitize and then output the uri
$router = get_uri();

//This is the Directory which contains all Pages
$dir='app/view/src/';

//This is the File which gets loaded if the requested file doesnt exist
$err_dir='app/view/src/404.php';

//Here are some concatinations
$ext='.php';
$home=$dir.'home'.$ext;
$normal=$dir.$router.$ext;

//This ternary if lese determines if it is a home page or other page then it processes the request according to it
$file = ($router===''||$router==='home'||$router==='index')?$home:$normal;

//This will check if the file processed in $file variable exists , if it exists it will include that file , if not then it will include error 404 page
if(file_exists($file)){
    echo
    '
    <!DOCTYPE html>
    <html lang="en">
    '.load_head().'
    <body>
    ';load_header();
    require $file;
    load_footer();
echo
"
    </body>
    </html>
";
}
else{
    require $err_dir;
}
?>    
