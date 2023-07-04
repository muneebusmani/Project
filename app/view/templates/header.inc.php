<?php
$uri = get_uri();
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
                echo file_exists($logo)?'<img class="main-logo" src="'.$logo.'" alt="">':'<h1 class="m-0 display-4 text-primary">JusticiaLaw</h1>';
                ?>
            </a>
        </div>
        <div class="col-lg-9">
            <div class="row bg-white border-bottom d-none d-lg-flex">
                <div class="col-lg-7 text-left">
                    <div class="h-100 d-inline-flex align-items-center py-2 px-3">
                        <i class="fa fa-envelope text-primary mr-2"></i>
                        <a class=""  href="mailto:>muneebusmani8355@gmail.com">muneebusmani8355@gmail.com</a>
                    </div>
                    <div class="h-100 d-inline-flex align-items-center py-2 px-2">
                        <i class="fa fa-phone-alt text-primary mr-2"></i>
                        <a  class="" href="https://wa.me/+92335283545">+92 335 2835 45</a>
                    </div>
                </div>
                <div class="col-lg-5 clearfix">
                    <div class="d-inline-flex float-right p-2">
                        <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="https://facebook.com">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="https://twitter.com">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="https://linkedin.com">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="btn btn-sm btn-outline-primary btn-sm-square mr-2" href="https://instagram.com">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg bg-white navbar-light p-0">
                <a href="index.html" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 display-4 text-primary text-uppercase">Justice</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <!-- Dynamic Nav highlighting Starts-->
                        <a href="home" class="nav-item nav-link <?php if ($uri === 'home') {echo 'active';} ?>">Home</a>
                        <a href="about" class="nav-item nav-link <?php if ($uri === 'about') {echo 'active';} ?>">About</a>
                        <a href="service" class="nav-item nav-link <?php if ($uri === 'service') {echo 'active';} ?>">Practice</a>
                        <a href="team" class="nav-item nav-link <?php if ($uri === 'team') {    echo 'active';} ?>">Attorneys</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="#" class="dropdown-item">Menu Item 1</a>
                                <a href="#" class="dropdown-item">Menu Item 2</a>
                                <a href="#" class="dropdown-item">Menu Item 3</a>
                            </div>
                        </div>
                        <a href="contact" class="nav-item nav-link <?php if ($uri === 'contact') {echo 'active';} ?>">Contact</a>
                        <!-- Dynamic Nav highlighting Ends-->
                    </div>
                    <a href="admin/" class="btn btn-primary d-none d-lg-block">Get A Quote</a>
                    <label class="switch ml-5 mt-2">
                        <input id="toggleDarkMode" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </nav>
        </div>
    </div>
</div>