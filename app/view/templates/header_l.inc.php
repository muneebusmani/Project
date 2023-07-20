<?php
$uri = user::complete_uri();
?>
<style>
    .ff-poppins{
        font-family: 'Poppins', sans-serif;
    }
    .ff-viceroy{
        font-family: 'viceroy';
    }
    nav.sidebar{
        height:100vh;
        padding: 0;
    }
    .goBack{
        width: 2.5rem;
        border-radius:25px;
        border:1px solid;
    }
    .current{
        border-radius:25px;
        background-color: #007bff;
        color: white;
    }
</style>
<div class="wrapper">
<div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky py-3 px-3">
          <ul class="nav flex-column">
            <button class="goBack mb-4" type="button" onclick="goBack();"><i class="fas fa-arrow-left"></i></button>
            <li class="nav-item"><a class="nav-link  <?php echo ($uri === 'lawyer_dashboard' ) ? 'current':''?>" href="lawyer_dashboard">Profile</a></li>
            <li class="nav-item"><a class="nav-link  <?php echo ($uri === 'lawyer_appointments' ) ? 'current':''?>" href="lawyer_appointments">Appointments</a></li>
          </ul>
          <form style="padding:0px;" action="lawyer_signout" class="nav-item"  method="post"><input  type="submit" class="btn nav-link text-left text-primary" style="padding:.5rem 1rem; font-weight:normal;" value="Sign Out"></form>
          <label class="switch ml-5 mt-2">
            <input id="toggleDarkMode" type="checkbox">
            <span class="slider round"></span>
          </label>
        </div>
      </nav>

<main role="main" class="col-md-10 ml-sm-auto px-4 justify-content-center">