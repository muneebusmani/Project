<?php
if ($_GET['lawyer'] == null) {
    header('location:search');
}
$lawyer_id = $_GET['lawyer'];
$result = user::open_profile($conn, $lawyer_id);
$row = $result->fetch_assoc();
foreach ($row as $key => $value) {
    $$key = $value;
}
$br = user::br();
$py_5 = user::py('2.5rem');





// Check if the appointment table exists
$tableExists = $conn->query("SHOW TABLES LIKE 'appointments'");

if ($tableExists->num_rows == 0) {
    // Table does not exist, create it
    $createTableQuery = "CREATE TABLE appointments (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        number VARCHAR(255) NOT NULL,
        location VARCHAR(255) NOT NULL,
        lawyer_name VARCHAR(255),
        date VARCHAR(255),
        time VARCHAR(255)
    )";

    if ($conn->query($createTableQuery) === TRUE) {
        echo "Appointment table created successfully!";
    } else {
        echo "Error creating appointment table: " . $conn->error;
    }
}

// Fetch the lawyer's name based on the lawyer_id
$lawyerName = "";
if (isset($_GET['lawyer'])) {
    $lawyer_id = $_GET['lawyer'];
    $result = user::open_profile($conn, $lawyer_id);
    $row = $result->fetch_assoc();
    $lawyerName = $row['name'];
}

// Insert the appointment into the table
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $location = $_POST['location'];

    // Adjust the SQL query based on the location selected
    if ($location === 'customLocation' && isset($_POST['customLocation'])) {
        $customLocation = $_POST['customLocation'];

        $stmt = $conn->prepare("INSERT INTO appointments (name, email, number, location, lawyer_name, date, time) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $number, $customLocation, $lawyerName, $_POST['date'], $_POST['time']);
    } else {
        $stmt = $conn->prepare("INSERT INTO appointments (name, email, number, location, lawyer_name, date, time) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $number, $location, $lawyerName, $_POST['date'], $_POST['time']);
    }

    $stmt->execute();
    $stmt->close();

    // Redirect or display success message
    // ...
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
                            <input type='text' name='name' class='form-control border-0 p-4' placeholder='Your Name' required='required' />
                        </div>
                        <div class='form-group'>
                            <input type='email' name='email' class='form-control border-0 p-4' placeholder='Your Email' required='required' />
                        </div>
                        <div class='form-group'>
                            <input type='number' name='number' class='form-control border-0 p-4' placeholder='Your Number' required='required' />
                        </div>
                        <div class='form-group'>
                            <select class='form-control border-0 px-3' name='location' id='locationSelect'>
                                <option disabled selected>Select Location</option>
                                <option value='LawyerOffice'>Lawyer's Office</option>
                                <option value='customLocation'>Courtroom</option>
                                <option value='customLocation'>Home</option>
                                <option value='customLocation'>Police Station</option>
                                <option value='customLocation'>Hospital or Healthcare Facility</option>
                                <option value='customLocation'>Add Your Custom Location</option>
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
        if (selectElement.value === 'customLocation') {
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
