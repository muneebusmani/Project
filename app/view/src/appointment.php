<?php
if ($_GET['lawyer'] == null) {
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
  foreach ($row as $key => $value){
    $$key=$value;
}
}
$br = user::br();
$py_5 = user::py('2.5rem');





// Insert the appointment into the table
if (isset($_POST['submit'])) {
    $name = $_SESSION['username'];
    $email = $_SESSION['email'];
    $number = $_SESSION['phone'];
    $location = $_POST['location'];
    $Clocation = $_POST['location'];
    $date=$_POST['date'];
    $time=$_POST['time'];
    $Booked='Booked';
    
    // Adjust the SQL query based on the location selected
    if (isset($_POST['location']) && ($location !== 'lawyers_office')) {
        $location = $location.' , '. $_POST['customLocation'];
    } 
    // Fetch the lawyer's name based on the lawyer_id
    $lawyerName=user::fetch_name($conn,$lawyer_id);

    //Do the usual query to insert the data into table
    $stmt = $conn->prepare("INSERT INTO appointments (name, email, number, location, lawyer_name, date, time) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $number, $location, $lawyerName, $date, $time);
    $stmt->execute();
    $stmt->close();
    

    $conn=user::inc_db();
    $lawyer_status_change_query="UPDATE `lawyers` SET `Status` = ? where `ID` = ?";
    $stmt=$conn->prepare($lawyer_status_change_query);
    $stmt->bind_param("si",$Booked,$_GET['lawyer']);
    $stmt->execute();
    $stmt->close();
    header('location:appointments');
}

?>
<style>
    .lawyer_img {
        width: 10rem;
        height: 10rem;
    }

    .lawyer_name {
        display: inline;
        text-align: center;
        margin-left: 1rem;
    }

    .lawyer_dets {
        margin-top: 5rem;
    }

    .wrapper {
        margin-right: 5rem;
    }

    .ff-poppins {
        font-family: 'Poppins', sans-serif;
    }

    .ff-viceroy {
        font-family: 'viceroy';
    }

    nav.sidebar {
        <?php echo $py_5; ?>
        height: 100vh;
    }

    .goBack {
        width: 2.5rem;
        border-radius: 25px;
        border: 1px solid;
    }

    .current {
        border-radius: 25px;
        background-color: #007bff;
        color: white;
    }

    input[type='number']::-webkit-inner-spin-button,
    input[type='number']::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type='number'] {
        -moz-appearance: textfield;
        /* Firefox */
    }
</style>
<div class='container-fluid'>
    <div class='row'>
        <nav class='col-md-2 d-none d-md-block bg-light sidebar'>
            <div class='sidebar-sticky'>
                <ul class='nav flex-column'>
                    <button class='goBack' type='button' onclick='goBack();'><i class='fas fa-arrow-left'></i></button>
                    <?php echo $br ?>
                    <li class='nav-item'>
                        <a class='nav-link' href='profile?lawyer=<?php echo $lawyer_id ?>'>
                            Profile
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link current' href='appointment?lawyer=<?php echo $lawyer_id ?>'>
                            Appointment
                        </a>
                    </li>
                </ul>
                <label class="switch ml-5 mt-2">
                    <input id="toggleDarkMode" type="checkbox">
                    <span class="slider round"></span>
                </label>
            </div>
        </nav>

        <main role='main' class='col-md-10 ml-sm-auto px-4'>
            <div class='col-lg-6 py-5' style='background: none;'>
                <div class='rounded p-5 my-5' style='background: rgba(55, 55, 63, .7);'>
                    <h1 class='text-center text-white mb-4'>Get An Appointment</h1>
                    <form method='post'>
                        <div class='form-group'>
                            <select class='form-control border-0 px-3' name='location' id='locationSelect'>
                                <option value='lawyers_office' selected>Lawyer's Office</option>
                                <option value='courtroom'>Courtroom</option>
                                <option value='home'>Home</option>
                                <option value='police_Station'>Police Station</option>
                                <option value='hospital_or_healthcare_facility'>Hospital or Healthcare Facility</option>
                                <option value='custom_location'>Add Your Custom Location</option>
                            </select>
                        </div>
                        <div class='form-group'>
                            <div id='customLocationContainer' style='display: none;'>
                                <input type='text' name='customLocation' id='customLocationInput' class='form-control border-0 p-4' placeholder='Enter Location'>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='col-6'>
                                <div class='form-group'>
                                    <div class='date' id='date' data-target-input='nearest'>
                                        <input type='text' name='date' class='form-control border-0 p-4 datetimepicker-input' placeholder='Select Date' data-target='#date' data-toggle='datetimepicker' />
                                    </div>
                                </div>
                            </div>
                            <div class='col-6'>
                                <div class='form-group'>
                                    <div class='time' id='time' data-target-input='nearest'>
                                        <input type='text' name='time' class='form-control border-0 p-4 datetimepicker-input' placeholder='Select Time' data-target='#time' data-toggle='datetimepicker' />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class='btn btn-primary btn-block border-0 py-3' name='submit' type='submit'>Get An Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
<script type='text/javascript'>
    function goBack() {
        window.history.go(-1);
    }
    // Function to handle the AJAX request and update the form
    function updateForm() {
        var selectElement = document.getElementById('locationSelect');
        var customLocationContainer = document.getElementById('customLocationContainer');

        // Check if the selected option is 'Add Your Custom Location'
        if (selectElement.value !== 'lawyers_office') {
            customLocationContainer.style.display = 'block';
        } else {
            customLocationContainer.style.display = 'none';
        }
    }

    // Attach event listener to the select element
    var locationSelect = document.getElementById('locationSelect');
    locationSelect.addEventListener('change', updateForm);

    // Initial form update
    updateForm();
</script>
