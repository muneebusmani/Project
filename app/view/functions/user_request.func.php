<?php
function get_uri(){
    $request = $_SERVER['REQUEST_URI'];
    $request=str_replace($GLOBALS['project_root'],'',$request);
    return $request;
}
/*
***********************************************************************************************************************************************************
 
 *  This Function removes the project root folder /Project/ from the requested uri for easy process and returns the cleaned URI in output
 
***********************************************************************************************************************************************************
*/ 