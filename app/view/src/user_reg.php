    <!-- Appointment Start -->
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
                                    <input type="email" class="form-control border-0 p-4" placeholder="Your Email" required="required" />
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
    <!-- Appointment End -->