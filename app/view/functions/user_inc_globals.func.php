<?php
function inc_globals()
{
/*************************************************************************************************** 
 * This Function is created to just create and include the superglobals into index file
****************************************************************************************************/

//Document root from which is renamed to localhost
$GLOBALS['doc_root'] = $_SERVER['DOCUMENT_ROOT'];

//Project root aka Parent folder in which this file is place
$GLOBALS['project_root'] = '/Project/';


//Lawyers image registration folder
$GLOBALS['lawyers_img']='uploads/lawyers';


//This connects to the database
$GLOBALS['conn']=inc_db();

//This function will fetch, sanitize, and then output the URI
$GLOBALS['router'] = get_uri();

//This is the directory which contains all pages
$GLOBALS['dir'] = 'app/view/src/';

//This is the file which gets loaded if the requested file doesn't exist
$GLOBALS['err_dir'] = 'app/view/src/404.php';

}