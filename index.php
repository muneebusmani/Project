<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
try{
    $viewDir = 'app/view/src/';
    $request = $_SERVER['REQUEST_URI'];
    $ext     = '.php';
    $file    = $viewDir.$request.$ext;
    $err_page= $viewDir.'404'.$ext;

    if ($request = "/" || $request = "/home" || $request = "") {
        $request = "/home";
        $file    = $viewDir.$request.$ext;
        require_once($file);
    }
    elseif (file_exists($file)){
        require_once($file);
    }
    else {
        require $err_page;
        echo $request;
    }
}
catch(Exception $e){
$error=$e->getMessage();
echo $error;
}

?>
