<?php
$uri = user::complete_uri();
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

<style>
    .ff-poppins {
        font-family: 'Poppins', sans-serif;
    }

    .ff-viceroy {
        font-family: 'viceroy';
    }

    .goBack {
        width: 2.5rem;
        border-radius: 25px;
        border: 1px solid;
    }

    nav.sidebar {
        position: fixed;
        height: 100%;
        overflow-y: auto;
        padding-bottom: 1rem;
    }

    .current {
        border-radius: 25px;
        background-color: #007bff;
        color: white;
    }

    .nav-link {
        padding: 10px 0;

    }

    .nav {
        --padding-x: 2vw;
        padding-left: var(--padding-x);
        padding-right: var(--padding-x);
    }

    .special {
        --size: 2rem;
        width: var(--size);
        height: var(--size);
    }

    li {
        list-style: none;
    }
    ul{
        padding-left: 1rem;
    }
    @media screen and (min-width:1400px) {
        :root{
            --height:calc(135 -(70*135)/100);
        }
    }
    @media screen and (max-width:1400px) {
        :root{
            --height:calc(135 -(50*135)/100);
        }
    }
    img[src="app/view/assets/img/logo.png"]{
        height:  var(--height) !important;
        background-color: var(--secondary);
        padding: 1rem 2rem;
    }
</style>
<script type="text/javascript">
    function goBack() {
        window.history.go(-1);
    }
</script>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar bg-light p-0">
        <div class="sidebar-sticky h-100">
        <a href="home" class="w-100">
        <img style="height: 135px;width:100%" src="app/view/assets/img/logo.png" alt="">
        </a>
        <ul class="nav flex-column">
            <button class="goBack mt-3" type="button" onclick="goBack();"><i class="fas fa-arrow-left"></i></button>
            <br>
            <li class="nav-item">
                <a class="nav-link" href="admin_dashboard">
                    <i class="fas special fa-user"></i>
                    <span class="main-link">Admin</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo in_array($uri, admin::routes()) ? 'collapsed' : ''; ?>" href="#optionsSubMenu" data-toggle="collapse" aria-expanded="false">
                    <i class="fas special fa-cog"></i>
                    <span class="main-link">Options</span>
                </a>
                <ul class="collapse <?php echo in_array($uri, admin::routes()) ? 'show' : ''; ?>" id="optionsSubMenu">
                    <li>
                        <a class="nav-link <?php echo in_array($uri, ['admin_add_location', 'admin_edit_location']) ? 'active' : ''; ?>" href="#locationSubMenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fas special fa-map-marker-alt"></i>
                            <span class="main-link">Locations</span>
                        </a>
                        <ul class="collapse <?php echo in_array($uri, ['admin_add_location', 'admin_edit_location']) ? 'show' : ''; ?>" id="locationSubMenu">
                            <li><a class="nav-link" href="admin_add_location"><i class="fas fa-plus"></i> Add Location</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link <?php echo in_array($uri, ['admin_add_education', 'admin_edit_education']) ? 'active' : ''; ?>" href="#educationSubMenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fas special fa-graduation-cap"></i>
                            <span class="main-link">Education</span>
                        </a>
                        <ul class="collapse <?php echo in_array($uri, ['admin_add_education', 'admin_edit_education']) ? 'show' : ''; ?>" id="educationSubMenu">
                            <li><a class="nav-link" href="admin_add_education"><i class="fas fa-plus"></i> Add Education</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link <?php echo in_array($uri, ['admin_add_experience', 'admin_edit_experience']) ? 'active' : ''; ?>" href="#experienceSubMenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fas special fa-briefcase"></i>
                            <span class="main-link">Experience</span>
                        </a>
                        <ul class="collapse <?php echo in_array($uri, ['admin_add_experience', 'admin_edit_experience']) ? 'show' : ''; ?>" id="experienceSubMenu">
                            <li><a class="nav-link" href="admin_add_experience"><i class="fas fa-plus"></i> Add Experience</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link <?php echo in_array($uri, ['admin_add_practice_areas', 'admin_edit_practice_areas']) ? 'active' : ''; ?>" href="#practiceAreasSubMenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fas special fa-balance-scale"></i>
                            <span class="main-link">Practice Areas</span>
                        </a>
                        <ul class="collapse <?php echo in_array($uri, ['admin_add_practice_areas', 'admin_edit_practice_areas']) ? 'show' : ''; ?>" id="practiceAreasSubMenu">
                            <li><a class="nav-link" href="admin_add_practice_areas"><i class="fas fa-plus"></i> Add Practice Area</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link <?php echo in_array($uri, ['admin_add_custom_location', 'admin_edit_custom_location']) ? 'active' : ''; ?>" href="#customLocationSubMenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fas special fa-map-pin"></i>
                            <span class="main-link">Custom Locations</span>
                        </a>
                        <ul class="collapse <?php echo in_array($uri, ['admin_add_custom_location', 'admin_edit_custom_location']) ? 'show' : ''; ?>" id="customLocationSubMenu">
                            <li><a class="nav-link" href="admin_add_custom_location"><i class="fas fa-plus"></i> Add Custom Location</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link <?php echo in_array($uri, ['admin_add_lawyer', 'admin_edit_lawyer', 'admin_view_lawyer']) ? 'active' : ''; ?>" href="#lawyersSubMenu" data-toggle="collapse" aria-expanded="false">
                            <i class="fas special fa-users"></i>
                            <span class="main-link">Lawyers</span>
                        </a>
                        <ul class="collapse <?php echo in_array($uri, ['admin_add_lawyer', 'admin_edit_lawyer', 'admin_view_lawyer']) ? 'show' : ''; ?>" id="lawyersSubMenu">
                            <li><a class="nav-link" href="admin_add_lawyer"><i class="fas fa-plus"></i> Add Lawyer</a></li>
                            <li><a class="nav-link" href="admin_view_lawyer"><i class="fas fa-eye"></i> View Lawyers</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-link <?php echo ($uri === 'admin_delete_images') ? 'active' : ''; ?>" href="admin_delete_images">
                            <i class="fas special fa-trash"></i>
                            <span class="main-link">Delete Images</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link <?php echo ($uri === 'admin_delete_appointments') ? 'active' : ''; ?>" href="admin_delete_appointments">
                            <i class="fas special fa-trash"></i>
                            <span class="main-link">Delete Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link <?php echo ($uri === 'admin_view_appointments') ? 'active' : ''; ?>" href="admin_view_appointments">
                            <i class="fas special fa-calendar"></i>
                            <span class="main-link">Appointments</span>
                        </a>
                    </li>
                </ul>
                <li>
                    <form style="padding:0px;" action="admin_signout" class="nav-link"  method="post"><button  type="submit"  class="btn text-left text-primary d-inline" style="padding:0 0 1rem 0; font-weight:normal;"><i class="fas special fa-sign-out-alt text-primary"></i>Sign Out</button></form>
                </li>
            </li>
            <label class="switch">
                <input id="toggleDarkMode" type="checkbox">
                <span class="slider round"></span>
            </label>
        </ul>
    </div>
</nav>



            <main role="main" class="col-md-10 ml-sm-auto px-4">



            