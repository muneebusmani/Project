<?php
function query_check(){ 

    global $router ,$ext, $dir;
    // Split the request URI into path and query string
    list($path, $queryString) = explode('?', $router, 2);
    // Append the '.php' extension to the path
    $path = rtrim($path, '/') .$ext;

    $router=$path.'?';
    // Reconstruct the modified URL
    $query=$dir.$router;

    return $query;
    
}