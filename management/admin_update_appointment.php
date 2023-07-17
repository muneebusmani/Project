<div class='container-fluid'>
    <div class='row'>
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