<?php
function get_uri(){
    $request = $_SERVER['REQUEST_URI'];
    $request=str_replace('/Project/','',$request);
    return $request;
}