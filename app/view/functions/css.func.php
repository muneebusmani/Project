<?php
/*
This function automatically loads all of the CSS files present inside the css folder
*/
function inc_css()
{
    $cssDir ='app/view/assets/css/';
    $css = glob($cssDir . '*.css');
    foreach ($css as $cs) {
        echo '<link rel="stylesheet" href="' . $cs . '">';
    }
}
?>
