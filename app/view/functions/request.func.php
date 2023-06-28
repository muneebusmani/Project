<?php
function get_uri(){
    $request = $_SERVER['REQUEST_URI'];
    $request=str_replace('/lawfirm/','',$request);
    return $request;
}