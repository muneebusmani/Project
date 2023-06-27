<?php

// Define routes and their corresponding handlers
$routes = [
    '/' => 'home',
    '/about' => 'about',
    '/contact' => 'contact',
];

// Get the current URL path
$path = $_SERVER['REQUEST_URI'];

// Remove query string from the URL if present
if (($pos = strpos($path, '?')) !== false) {
    $path = substr($path, 0, $pos);
}

// Remove leading and trailing slashes from the URL
$path = trim($path, '/');

// Find the appropriate handler based on the requested route
if (isset($routes[$path])) {
    $handler = $routes[$path];
    // Call the corresponding handler function or include the file
    if (is_callable($handler)) {
        call_user_func($handler);
    } else {
        include($handler . '.php');
    }
} else {
    // Handle 404 - Page not found
    echo '404 - Page not found';
}

// Handler functions for each route
function home()
{
    echo 'This is the home page.';
}

function about()
{
    echo 'This is the about page.';
}

function contact()
{
    echo 'This is the contact page.';
}
