<?php
/*
This function Scans the directory of:(app/view/functions) 
and then it includes every file which contains ".func.php" at the end of it 
*/

function autoloadFunctions() {
    $directory = 'app/view/functions';
    $functions = glob($directory . '/*.func.php');

    if ($functions !== false) {
        foreach ($functions as $function) {
            if (is_file($function)) {
                include $function;
            }
        }
    }
}