<?php
/*
This is the main route file in which i defined the routes for the website

*/

$autoloader='app/view/src/autoload_func.php';
require($autoloader);
autoloadFunctions();

$router = get_uri();
    switch ($router) {
        
        case '':
        case 'home':
        case 'index':
            require('app/view/src/home.php');
            break;

        case 'about':
            require('app/view/src/about.php');
            break;

        case 'service':
            require('app/view/src/service.php');
            break;

        case 'team':
            require('app/view/src/team.php');
            break;

        case 'contact':
            require('app/view/src/contact.php');
            break;
        
        default:
            require('app/view/src/404.php');
            break;
    }