<?php
if ($_GET['lawyer']==null) {
  header('location:search');
}
$lawyer_id=$_GET['lawyer'];
if(!($row = user::open_profile($conn, $lawyer_id)))
{
    echo 
    "
    <script>
      alert('Lawyer not Available');
      window.location.href = 'search';
    </script>
    ";
}
else {
  foreach ($row as $key => $value)
  {
    $$key=$value;
  }
}
  $br=user::br();
$py_5=user::py('2.5rem');
echo
<<<HTML
<style>
    .lawyer_img{
        width: 10rem;
        height: 10rem;
    }
    .lawyer_name{
        display:inline;
        text-align:center;
        margin-left:1rem;
    }
    .lawyer_dets{
        margin-top: 5rem;
    }
    .wrapper{
        margin-right: 5rem;
    }
    .ff-poppins{
        font-family: 'Poppins', sans-serif;
    }
    .ff-viceroy{
        font-family: 'viceroy';
    }
    nav.sidebar{
        $py_5;
        height:100vh;
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
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <button class="goBack" type="button" onclick="goBack();"><i class="fas fa-arrow-left"></i></button>
            $br
            <li class="nav-item">
              <a class="nav-link current" href="profile?lawyer=$lawyer_id">
                Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="appointment?lawyer=$lawyer_id">Appointment</a></li>
          </ul>
          <label class="switch ml-5 mt-2">
                        <input id="toggleDarkMode" type="checkbox">
                        <span class="slider round"></span>
          </label>
        </div>
      </nav>

      <main role="main" class="col-md-10 ml-sm-auto px-4">
        <!-- Main content goes here -->
        <div class="lawyer_dets">
        <img class="lawyer_img" src="$Photo">
        <h1 class='lawyer_name'>{$name}</h1>
    </div>
    $br
    <h3 class=''>Practice Area : {$speciality}</h3>
    <h3 class=''>Experience : {$experience} years</h3>
    <h3 class=''> Location : {$location}</h3>
    $br
    <p class="text-primary h5 ff-poppins">Introducing $name: Your Trusted Legal Advocate</p>
    <p class="text-primary h6 ff-poppins">
    With a passion for justice and a wealth of legal expertise, $name is a dedicated professional committed to providing exceptional legal services.
    $br
    With years of experience in $speciality, $name has successfully represented numerous clients, delivering favorable outcomes and protecting their rights.
    $br
    Known for their meticulous attention to detail and strong advocacy skills, $name takes a client-centered approach, ensuring personalized representation tailored to each individual case. They believe in open communication, actively listening to clients' concerns and working closely with them throughout the legal process.
    $br
    $name understands that legal matters can be overwhelming, and they strive to provide clarity and guidance to their clients. With a deep understanding of the law, they are able to navigate complex legal issues effectively, offering strategic advice and tailored solutions.
    $br
    Beyond their legal expertise, $name is recognized for their professionalism, integrity, and compassionate approach. They genuinely care about their clients' well-being and are dedicated to achieving the best possible outcomes.
    $br
    If you are seeking a reliable, experienced, and compassionate lawyer, look no further than $name. Contact them today to discuss your legal needs and benefit from their exceptional legal services.
</p>
</div>
      </main>
    </div>
  </div>

HTML;