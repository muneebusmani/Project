<?php
/*
This function automatically loads all of the js files present inside js folder
*/
function inc_js()
{
    $js_dir = 'includes/view/assets/js/';
    $js_files = glob($js_dir . '*.js');

    foreach ($js_files as $js) {
        $js_filename = basename($js);
        echo "<script src='$js_dir$js_filename'></script>";
    }
}
