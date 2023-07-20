<?php
//Load The Admin Page  Frontend
admin::login_page();

//Handle The form request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //This makes variables out of  keys of $_POST and assign values of Corresponding keys 
    foreach ($_POST as $key => $value) {
        $$key=$value;
    }

    //This Function  Checks if username and password from the  login form exists
    $result=admin::check_if_exists($conn,$username,$password);

    if ($result->num_rows == 1) {
        //This Fetches Username and role i.e(admin or moderator) from the database
        admin::fetch_username_and_role($conn,$username);
        header("Location: admin_dashboard");
        exit;
    } else {
        echo "Invalid username or password.";
    }
}
?>
