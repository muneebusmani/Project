<?php
function deleteLawyersDirectory() {
    $directory = $_SERVER['DOCUMENT_ROOT'] . '/uploads/lawyers';

    if (is_dir($directory)) {
        $success = rmdir($directory);

        if ($success) {
            echo "Directory 'uploads/lawyers' deleted successfully!";
        } else {
            echo "Failed to delete directory 'uploads/lawyers'.";
        }
    } else {
        echo "Directory 'uploads/lawyers' does not exist.";
    }
}