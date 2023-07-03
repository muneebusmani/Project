<?php
function createLawyersDirectory($dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    else{
        // echo '"uploads/lawyers/" already exists';
    }
}

/*
This function takes a parameter $dir when i call it in index file,
which represents the directory path where you want to create the directory.

Inside the function, it checks if the directory specified by $dir already exists using the is_dir() function.
If the directory doesn't exist, it proceeds to the next step.

The mkdir() function is then used to create the directory.
The directory path is specified by $dir, and the permissions for the directory are set to 0777.
The 0777 permission value allows full read, write, and execute permissions for the directory.
The true parameter passed as the third argument ensures that the function creates any necessary parent directories along with the specified directory.

If the directory creation is successful, the function completes its execution. If the directory already exists, it doesn't attempt to create it again. In the commented-out code line, it was meant to echo a message indicating that the directory already exists, but it is currently commented out.
*/