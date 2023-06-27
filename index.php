<?php
$request = $_SERVER['REQUEST_URI'];
$viewDir = 'app/view/src/';

// Check if the requested file exists
if (file_exists($viewDir . $request . '.php')) {
    require $viewDir . $request . '.php';
} else {
    // If the file doesn't exist, display the 404 error page
    require $viewDir . '404.php';
}
?>
