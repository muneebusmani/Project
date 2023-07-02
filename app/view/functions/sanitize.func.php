<?php
function sanitize($data) {
    global $conn;
    
    // Sanitize for HTML output
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // Sanitize for general output
    $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);

    // Strip HTML tags
    $data = strip_tags($data);

    // Addslashes (use appropriate escaping mechanism for database queries)
    $data = addslashes($data);
    
    
    $data = $conn->real_escape_string($data);

    return $data;
}
