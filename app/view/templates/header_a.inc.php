<?php
$uri = user::get_uri($_SERVER['REQUEST_URI']);
?>
<!--
     This will fetch the curent request in address bar excluding hostname/websitename/localhost
     current directory:
     https://localhost:80/lawfirm
     this function will remove this whole part to process the request which is done in routing too
     so after this fetching and processing our output string will be like
     ''(empty string i.e which means home page)
     home
     index
     service
     team
     and we have done routing so our files are safe and arent accessible to anyone until we register that file in routes
 -->

<!-- Header Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 bg-secondary d-none d-lg-block">
            <a href="home" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                <?php
                $logo='app/view/assets/img/.png';
                echo file_exists($logo)?'<img class="main-logo" src="'.$logo.'" alt="">':'<h1 class="m-0 display-4 text-primary py-3">JusticiaLaw</h1>';
                ?>
            </a>
        </div>
        <div class="col-lg-9">
            <div class="row bg-white border-bottom d-none d-lg-flex">

            </div>
            <nav class="navbar navbar-expand-lg bg-white navbar-light p-0 py-3">
                <a href="index.html" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 display-4 text-primary text-uppercase">Justice</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <!-- Dynamic Nav highlighting Starts-->
                        <a href="home" class="nav-item nav-link">Home</a>
                        <a href="admin_view" class="nav-item nav-link <?php if ($uri === 'admin_view') {echo 'active';} ?>">Admin</a>
                        <a href="admin_add_location" class="nav-item nav-link <?php if ($uri === 'admin_add_location') {echo 'active';} ?>">Add location</a>
                        <a href="admin_add_education" class="nav-item nav-link <?php if ($uri === 'admin_add_education') {echo 'active';} ?>">Add education</a>
                        <a href="admin_add_experience" class="nav-item nav-link <?php if ($uri === 'admin_add_experience') {echo 'active';} ?>">Add experience</a>
                        <a href="admin_add_practice_areas" class="nav-item nav-link <?php if ($uri === 'admin_add_practice_areas') {echo 'active';} ?>">Add practice areas</a>
                        <a href="admin_add_custom_location" class="nav-item nav-link <?php if ($uri === 'admin_add_practice_areas') {echo 'active';} ?>">Add custom location</a>
                        <label class="switch ml-5 mt-2">
                        <input id="toggleDarkMode" type="checkbox">
                        <span class="slider round"></span>
                        </label>
                        <!-- Dynamic Nav highlighting Ends-->
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>