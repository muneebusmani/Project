<?php
//This will load functions

function autoloadFunctions() {
    $directory = 'includes/view/functions';
    $files = glob($directory . '/*.func.php');

    if ($files !== false) {
        foreach ($files as $file) {
            if (is_file($file)) {
                include_once $file;
            }
        }
    }
}