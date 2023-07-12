<?php
$lawyer_id=$_GET['lawyer'];
$result=user::open_profile($conn,$lawyer_id);
$row=$result->fetch_assoc();
foreach ($row as $key => $value) {
    $$key=$value;
}
$br=user::br();
$px_5=user::px('5rem');
$py_5=user::py('2.5rem');
$content=
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
    .body{
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
    .active{
        border-radius:25px;
        background-color: #007bff;
        color: white;
    }
</style>
<div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <button class="goBack" type="button" onclick="goBack();"><i class="fas fa-arrow-left"></i></button>
            $br
            <li class="nav-item">
              <a class="nav-link" href="profile?lawyer=$lawyer_id">
                Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="appointment?lawyer=$lawyer_id">
                Appointment
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-10 ml-sm-auto px-4">
        <!-- Main content goes here -->
        <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="rounded">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-lg-6 py-5" style="background: none;">
                        <div class="rounded p-5 my-5" style="background: rgba(55, 55, 63, .7);">
                            <h1 class="text-center text-white mb-4">Get An Appointment</h1>
                            <form method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control border-0 p-4" placeholder="Your Name" required="required" />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control border-0 p-4" placeholder="Your Email/Number" required="required" />
                                </div>
                                <div class="form-group">
                                    <select class="form-control border-0 px-3" name="location">

                                        <option disabled selected>Select Location</option>
                                        <option value="LawyerOffice">Lawyer's Office</option>
                                        <option value="customLocation" name="customLocation">Courtroom</option>
                                        <option value="customLocation" name="customLocation">Home</option>
                                        <option value="customLocation" name="customLocation">Police Station</option>
                                        <option value="customLocation" name="customLocation">Hospital or Healthcare Facility</option>
                                        <option value="customLocation" name="customLocation">Add Your Custom Location</option>
                                    </select>
HTML;
if(isset($_POST['customLocation'])){
$content.=
<<<HTML
<input type="Custom Location" class="form-control border-0 p-4" placeholder="Your Custom Location" required="required" />
HTML;
}
$content.=<<<HTML
                                </div>
                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="date" id="date" data-target-input="nearest">
                                                <input type="text" name="date" class="form-control border-0 p-4 datetimepicker-input" placeholder="Select Date" data-target="#date" data-toggle="datetimepicker" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="time" id="time" data-target-input="nearest">
                                                <input type="text" name="time" class="form-control border-0 p-4 datetimepicker-input" placeholder="Select Time" data-target="#time" data-toggle="datetimepicker" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-block border-0 py-3" name="submit" type="submit">Get An Appointment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    </div>
  </div>
  <script type="text/javascript">
    function goBack(){
        window.history.go(-1);
    }
</script>
HTML;
echo $content;
