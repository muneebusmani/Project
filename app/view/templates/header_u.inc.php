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
        <h1 class="bg-secondary py-3 text-center"><?php echo strtolower($_SESSION['username']) ?></h1>
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <button class="goBack" type="button" onclick="goBack();"><i class="fas fa-arrow-left"></i></button>
            <li class="nav-item">
              <a class="nav-link current" href="user_profile">
                Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="user_appointments">
                Appointment
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="user_profile_d">
                Delete Account
              </a>
            </li>
          </ul>
          <label class="switch ml-5 mt-2">
                        <input id="toggleDarkMode" type="checkbox">
                        <span class="slider round"></span>
          </label>
        </div>
      </nav>

<main role="main" class="col-md-10 ml-sm-auto px-4 justify-content-center">