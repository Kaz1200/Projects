<?php
//dashboard.php
include('class/Appointment.php');
$object = new Appointment;
include('header.php');
?>

<div class="container-fluid mt-5">
    <br />
    <div class="row">
        <div class="custom-bg py-2">
            <h1 class="h3 mb-2 text-white text-center  py-2 mt-3">Book an Appointment</h1>
        </div>
        <div class="card pt-5" style="background: #a8c0ff;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #3f2b96, #a8c0ff);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #3f2b96, #a8c0ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

">
            <div class="card-body">

                <div class="row justify-content-center">

                    <!-- FLIP CARD 1 -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="flip-card-container  mt-4">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/doc2.jpg" alt="Doctor 1">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br>Aesthetic Dentistry</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2021; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center text-white mt-4"><b>Dr. Mikk Eusebio</b> <br>
                                <button type="button" id="getAppointmentDrMikk" name="get_appointment" class="btn btn-primary btn-sm mt-3 py-2 get_appointment" data-doctor_id="1">Get Appointment</button>
                            </p>
                        </div>
                    </div>
                    <!-- FLIP CARD 2 -->
                    <div class="col-lg-3">
                        <div class="flip-card-container  mt-4">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/doc1.jpg" alt="Doctor 1">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br> Oral surgeon specialists</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2021; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center text-white mt-4"><b>Dr. Chloe Hernando</b> <br>
                                <button type="button" id="getAppointmentDrChloe" name="get_appointment" class="btn btn-primary btn-sm mt-3 py-2 get_appointment" data-doctor_id="2">Get Appointment</button>
                            </p>
                        </div>
                    </div>
                    <!-- FLIP CARD 3 -->
                    <div class="col-lg-3">
                        <div class="flip-card-container  mt-4">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/docc3.jpg" alt="Doctor 3">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br>Oral surgeon specialists</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2019; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center text-white mt-4"><b>Dr. Alroze Regala</b> <br>
                                <button type="button" id="getAppointmentDrRegala" name="get_appointment" class="btn btn-primary btn-sm mt-3 py-2 get_appointment" data-doctor_id="3">Get Appointment</button>

                            </p>
                        </div>
                    </div>
                </div>

                <!-- The Modal GET APPOINTMENT BUTTON -->

                <div id="appointmentModal" class="modal fade">
                    <div class="modal-dialog">


                        <form method="POST" action="booking.php">
                            <div class="modal-content">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modal_title">Make Appointment</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                    <span id="form_message"></span>
                                    <div id="appointment_detail"></div>
                                    <div class="alert alert-info" role="alert">
                                        <strong>Please note:</strong> Due to high demand and current circumstances, there might be a significant waiting time for appointments.
                                    </div>
                                    
                                    <div class="alert alert-warning" role="alert">
                                        <strong>Attention:</strong> We apologize for any inconvenience caused and appreciate your patience. The estimated waiting time can be approximately 30 minutes or more.Thank you for your understanding.
                                    </div>
                                    <div id="promptMessage" class="mb-3"></div>
                                        
                                        <div id="totalTimeLabel"></div>
                                    <input type="hidden" name="patient_id" value="<?php echo $_SESSION['patient_id']; ?>">
                                    <div class="card-body">
                                        <input type="hidden" name="doctor_id" value="">
                                        <!-- <div class="form-group">


                                            <p><b><label for="time">Select a Doctor:</label></b></p>
                                            <select class="form-control" name="doctor" id="doctor">
                                                <option value="1">Dr. Mikk Eusebio</option>
                                                <option value="2">Dr. Chloe Hernando</option>
                                                <option value="3">Dr. Alroze Regala</option>
                                                
                                            </select>
                                        </div> -->
                                        <?php
                                        // Connect to database
                                        $servername = "localhost";
                                        $username = "u556402485_doctor_appoint";
                                        $password = "BW76X^sB{%7TrqzG";
                                        $dbname = "u556402485_doctor_appoint";

                                        $conn = mysqli_connect($servername, $username, $password, $dbname);

                                        // Check connection
                                        if (!$conn) {
                                            die("Connection failed: " . mysqli_connect_error());
                                        }

                                        // Query for inactive dates
                                        $query = "SELECT doctor_schedule_date FROM doctor_schedule_table WHERE doctor_schedule_status = 'Inactive'";
                                        $result = mysqli_query($conn, $query);

                                        // Create array of inactive dates
                                        $inactive_dates = array();
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $inactive_dates[] = $row['doctor_schedule_date'];
                                        }
                                        mysqli_close($conn);
                                        ?>
                                        <?php
                                        if (isset($_POST['date'])) {
                                            $selected_date = $_POST['date'];
                                            $patient_id = $_POST["patient_id"];
                                            $query = "SELECT date FROM appointments WHERE date = '$selected_date' AND patient_id = '$patient_id' ";
                                            $result = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                echo "This date is already booked. Please select a different date.";
                                                exit();
                                            }
                                        }
                                        ?>
                                        <p>
                                        <div class="form-group">
                                            <p><b><label for="date">Select a date:</label></b></p>
                                            <input type="date" class="form-control" name="date" id="date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+1 year')); ?>" required>
                                        </div>
                                        </p>
                                        <p>
                                        <div class="form-group">
                                            <p><b><label for="time">Appointment Time:</label></b></p>
                                            <select name="time" class="form-control" required style="overflow-y: scroll;">
                                                <!-- <option value="">Select Time...</option> -->
                                                <option value="8:00 AM">8:00 AM</option>
                                                <option value="8:40 AM">8:40 AM</option>
                                                <option value="9:20 AM">9:20 AM</option>
                                                <option value="10:00 AM">10:00 AM</option>
                                                <option value="10:40 AM">10:40 AM</option>
                                                <option value="11:20 AM">11:20 AM</option>
                                                <option value="12:00 PM">12:00 PM</option>
                                                <option value="12:40 PM">12:40 PM</option>
                                                <option value="1:20 PM">1:20 PM</option>
                                                <option value="2:00 PM">2:00 PM</option>
                                                <option value="2:40 PM">2:40 PM</option>
                                                <option value="3:20 PM">3:20 PM</option>
                                                <option value="4:00 PM">4:00 PM</option>
                                            </select>
                                        </div>
                                        </p>
                                        <p>
                            
                                        <div class="form-group">
                                          <p><b><label for="services">Services:</label></b></p>
                                          <select id="services" name="services" class="form-control" required style="overflow-y: scroll;">
                                            <option value="">Select Service...</option>
                                            <option value="Metal Braces" data-minutes="This service might take 30mins-1hour">Metal Braces</option>
                                            <option value="Ceramic Braces" data-minutes="This service might take 1hour and 30 mins">Ceramic Braces</option>
                                            <option value="Self-ligating braces" data-minutes="TThis service might take 1hour and 30 mins">Self-ligating braces</option>
                                            <option value="Invisible Aligners/ Braces" data-minutes="This service might take 1hour and 30 mins">Invisible Aligners/Braces</option>
                                            <option value="Oral Prophylaxis" data-minutes="This service might take 30mins-1hour">Oral Prophylaxis</option>
                                            <option value="Tooth Restoration" data-minutes="This service might take 30mins-1hour">Tooth Restoration</option>
                                            <option value="Root Canal Treatment" data-minutes="This service might take 1hour and 30 mins">Root Canal Treatment</option>
                                            <option value="Tooth Extraction" data-minutes="This service might take 30mins-1hour">Tooth Extraction</option>
                                            <option value="Wisdom Tooth Removal" data-minutes="This service might take 1hour and 30 mins to 2 hours">Wisdom Tooth Removal</option>
                                            <option value="Teeth Whitening" data-minutes="This service might take 1hour">Teeth Whitening</option>
                                            <option value="Crowns and Bridges" data-minutes="This service might take 1hour and 30 mins to 2 hours">Crowns and Bridges</option>
                                            <option value="Veneers" data-minutes="This service might take 1hour to 3 hours">Veneers</option>
                                            <option value="Complete Dentures" data-minutes="This service might take 1hour and 30 mins">Complete Dentures</option>
                                            <option value="Removable Dentures (Ordinary & Flexite)" data-minutes="This service might take 1hour to 2 hours">Removable Dentures (Ordinary & Flexite)</option>
                                            <option value="Pediatric Dentistry" data-minutes="No range timer">Pediatric Dentistry</option>
                                            <option value="Digital Panoramic X-Ray" data-minutes="This service might take 10 minutes">Digital Panoramic X-Ray</option>
                                            <option value="Periapical X-Ray" data-minutes="This service might take 10 minutes">Periapical X-Ray</option>
                                            <option value="Implant" data-minutes="This service might take 1hour to 3 hours">Implant</option>
                                          </select>
                                        </div>

                                    <div class="mt-3" id="additionalServicesContainer"></div>
                                        <p id="addServiceBtn" style="display: none; text-align: center; margin-top: 10px;">
                                            <button type="button" class="btn btn-primary rounded-pill" onclick="addService()"><i class="fas fa-plus"></i> </button>
                                        </p>
                                        
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary text-center text-white mt-4 mb-2">Book Appointment</button>
                                        </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            include('footer2.php');
            ?>

            <script>
                $(document).ready(function() {
                    // Disable weekends
                    $('input[type="date"]').on('change', function() {
                        var selected_date = new Date($(this).val());
                        var day_of_week = selected_date.getDay();
                        if (day_of_week == 0 || day_of_week == 6) {
                            alert('Weekends are not available. Please select a weekday.');
                            $(this).val('');
                            $(this).prop('disabled', true);
                        } else {
                            $(this).prop('disabled', false);
                        }
                    });

                    // Disable inactive dates
                    var inactive_dates = <?php echo json_encode($inactive_dates); ?>;
                    $('input[type="date"]').on('change', function() {
                        var selected_date = $(this).val();
                        if ($.inArray(selected_date, inactive_dates) !== -1) {
                            alert('This date is inactive. Please select a different date.');
                            $(this).val('');
                            $(this).prop('disabled', false);
                            $(this).attr('data-inactive', '1');
                        } else {
                            $(this).prop('disabled', false);
                            $(this).removeAttr('data-inactive');
                        }
                    });
                });
                
                 $('#getAppointmentDrMikk').click(function() {
                    // Retrieve the doctor_id from the button's data attribute
                    var doctorId = $(this).data('doctor_id');

                    // Set the doctor_id value in the hidden input field
                    $('input[name="doctor_id"]').val(doctorId);

                    // Perform any other desired operations with the doctor_id
                    console.log('Doctor ID:', doctorId);
                    // You can send an AJAX request or perform other actions with the doctor_id here

                    // Example: Sending an AJAX request to action.php
                    $.ajax({
                        url: "action.php",
                        method: "POST",
                        data: {
                            action: 'make_appointment',
                            doctor_id: doctorId
                        },
                        success: function(data) {
                            $('#appointmentModal').modal('show');
                            $('#appointment_detail').html(data);
                        }
                    });
                });

                $('#getAppointmentDrChloe').click(function() {
                    // Retrieve the doctor_id from the button's data attribute
                    var doctorId = $(this).data('doctor_id');

                    // Set the doctor_id value in the hidden input field
                    $('input[name="doctor_id"]').val(doctorId);

                    // Perform any other desired operations with the doctor_id
                    console.log('Doctor ID:', doctorId);
                    // You can send an AJAX request or perform other actions with the doctor_id here

                    // Example: Sending an AJAX request to action.php
                    $.ajax({
                        url: "action.php",
                        method: "POST",
                        data: {
                            action: 'make_appointment',
                            doctor_id: doctorId
                        },
                        success: function(data) {
                            $('#appointmentModal').modal('show');
                            $('#appointment_detail').html(data);
                        }
                    });
                });

                $('#getAppointmentDrRegala').click(function() {
                    // Retrieve the doctor_id from the button's data attribute
                    var doctorId = $(this).data('doctor_id');

                    // Set the doctor_id value in the hidden input field
                    $('input[name="doctor_id"]').val(doctorId);

                    // Perform any other desired operations with the doctor_id
                    console.log('Doctor ID:', doctorId);
                    // You can send an AJAX request or perform other actions with the doctor_id here

                    // Example: Sending an AJAX request to action.php
                    $.ajax({
                        url: "action.php",
                        method: "POST",
                        data: {
                            action: 'make_appointment',
                            doctor_id: doctorId
                        },
                        success: function(data) {
                            $('#appointmentModal').modal('show');
                            $('#appointment_detail').html(data);
                        }
                    });
                });
                
     var maxAdditionalServices = 1;
    var additionalServiceCount = 0;
    var additionalServices = [];

    function addService() {
        if (additionalServiceCount < maxAdditionalServices) {
            var additionalServicesContainer = document.getElementById('additionalServicesContainer');
            var newServiceInput = document.createElement('div');
            newServiceInput.innerHTML = `
                <div class="form-group mt-3">
                    <label for="additionalService">Additional Service:</label>
                    <div class="input-group">
                        <select name="additionalService${additionalServiceCount + 1}" class="form-control">
                            ${getAdditionalServicesOptions()}
                        </select>
                        <div class="input-group-append ml-2">
                            <button class="btn btn-danger" type="button" onclick="removeService(this)"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                </div>
            `;
            additionalServicesContainer.appendChild(newServiceInput);
            additionalServiceCount++;

            if (additionalServiceCount === maxAdditionalServices || isOnlyOneAdditionalServiceOption()) {
                var addServiceBtn = document.getElementById('addServiceBtn');
                addServiceBtn.style.display = 'none';
            }
        }
    }

    function removeService(button) {
        var serviceInput = button.closest('.form-group');
        serviceInput.remove();
        additionalServiceCount--;

        var addServiceBtn = document.getElementById('addServiceBtn');
        if (additionalServiceCount < maxAdditionalServices && !isOnlyOneAdditionalServiceOption()) {
            addServiceBtn.style.display = 'block';
        }
    }

    function isOnlyOneAdditionalServiceOption() {
        var additionalServicesSelect = document.querySelector('select[name="additionalService"]');
        return additionalServicesSelect && additionalServicesSelect.options.length === 1;
    }

    function getAdditionalServicesOptions() {
        var servicesSelect = document.querySelector('select[name="services"]');
        var selectedService = servicesSelect.value;
    
            switch (selectedService) {
                case "Tooth Extraction":
                    return `
                        <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                        <option value="Periapical X-Ray">Periapical X-Ray</option>
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                    `;
                case "Veneers":
                    return `
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                    `;
                case "Teeth Whitening":
                    return `
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                    `;
                case "Complete Dentures":
                    return `
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                    `;
                case "Tooth Restoration":
                    return `
                        <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                        <option value="Periapical X-Ray">Periapical X-Ray</option>
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                    `;
                case "Wisdom Tooth Removal":
                    return `
                        <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                        <option value="Periapical X-Ray">Periapical X-Ray</option>
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                    `;
                case "Implant":
                    return `
                        <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                        <option value="Periapical X-Ray">Periapical X-Ray</option>
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                    `;
                case "Removable Dentures (Ordinary & Flexite)":
                    return `
                        <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                        <option value="Periapical X-Ray">Periapical X-Ray</option>
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                    `;
                case "Digital Panoramic X-Ray":
                    return `
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                        <option value="Tooth Extraction">Tooth Extraction</option>
                        <option value="Wisdom Tooth Removal">Wisdom Tooth Removal</option>
                        <option value="Metal Braces">Metal and Ceramic Braces</option>
                        <option value="Ceramic Braces">Ceramic Braces</option>
                        <option value="Invisible Aligners/ Braces">Invisible Aligners/Braces</option>
                    `;
                case "Periapical X-Ray":
                    return `
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                        <option value="Tooth Extraction">Tooth Extraction</option>
                        <option value="Wisdom Tooth Removal">Wisdom Tooth Removal</option>
                        <option value="Metal Braces">Metal and Ceramic Braces</option>
                        <option value="Ceramic Braces">Ceramic Braces</option>
                        <option value="Invisible Aligners/ Braces">Invisible Aligners/Braces</option>
                    `;
                case "Crowns and Bridges":
                    return `
                        <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                        <option value="Periapical X-Ray">Periapical X-Ray</option>
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                        <option value="Tooth Extraction">Tooth Extraction</option>
                    `;
                case "Oral Prophylaxis":
                    return `
                        <option value="Periapical X-Ray">Periapical X-Ray</option>
                        <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                        <option value="Tooth Extraction">Tooth Extraction</option>
                        <option value="Crowns and Bridges">Crowns and Bridges</option>
                        <option value="Veneers">Veneers</option>
                        <option value="Teeth Whitening">Teeth Whitening</option>
                        <option value="Complete Dentures">Complete Dentures</option>
                        <option value="Tooth Restoration">Tooth Restoration</option>
                        <option value="Root Canal Treatment">Root Canal Treatment</option>
                        <option value="Invisible Aligners/ Braces">Invisible Aligners/Braces</option>
                        <option value="Self-ligating braces">Self-ligating braces</option>
                        <option value="Metal Braces">Metal Braces</option>
                        <option value="Ceramic Braces">Ceramic Braces</option>
                        <option value="Wisdom Tooth Removal">Wisdom Tooth Removal</option>
                        <option value="Removable Dentures (Ordinary & Flexite)">Removable Dentures (Ordinary & Flexite)</option>
                    `;
                case "Root Canal Treatment":
                    return `
                        <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                        <option value="Periapical X-Ray">Periapical X-Ray</option>
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                        <option value="Tooth Extraction">Tooth Extraction</option>
                    `;
                case "Invisible Aligners/ Braces":
                    return `
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                        <option value="Tooth Extraction">Tooth Extraction</option>
                        <option value="Wisdom Tooth Removal">Wisdom Tooth Removal</option>
                        <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                        <option value="Periapical X-Ray">Periapical X-Ray</option>
                    `;
                case "Metal Braces":
                    return `
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                        <option value="Tooth Extraction">Tooth Extraction</option>
                        <option value="Wisdom Tooth Removal">Wisdom Tooth Removal</option>
                        <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                        <option value="Periapical X-Ray">Periapical X-Ray</option>
                    `;
                case "Ceramic Braces":
                    return `
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                        <option value="Tooth Extraction">Tooth Extraction</option>
                        <option value="Wisdom Tooth Removal">Wisdom Tooth Removal</option>
                        <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                        <option value="Periapical X-Ray">Periapical X-Ray</option>
                    `;
                case "Self-ligating braces":
                    return `
                        <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                        <option value="Tooth Extraction">Tooth Extraction</option>
                        <option value="Wisdom Tooth Removal">Wisdom Tooth Removal</option>
                        <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                        <option value="Periapical X-Ray">Periapical X-Ray</option>
                    `;
                // Add more cases for other services as needed
                default:
                    return "No additional services available";
            }
        }
    
        document.querySelector('select[name="services"]').addEventListener('change', function () {
        var addServiceBtn = document.getElementById('addServiceBtn');
        var additionalServicesContainer = document.getElementById('additionalServicesContainer');

        // Remove existing additional services
        additionalServicesContainer.innerHTML = "";
        additionalServiceCount = 0;
        additionalServices = [];

        if (this.value === 'Oral Prophylaxis' || this.value === 'Root Canal Treatment' || this.value === 'Invisible Aligners/ Braces' || this.value === 'Tooth Extraction' || this.value === 'Veneers' || this.value === 'Teeth Whitening' || this.value === 'Complete Dentures' || this.value === 'Tooth Restoration' || this.value === 'Wisdom Tooth Removal' || this.value === 'Implant' || this.value === 'Removable Dentures (Ordinary & Flexite)' || this.value === 'Digital Panoramic X-Ray' || this.value === 'Periapical X-Ray' || this.value === 'Crowns and Bridges' || this.value === 'Invisible Aligners/ Braces' || this.value === 'Metal Braces' || this.value === 'Ceramic Braces') {
            addServiceBtn.style.display = 'block';
        } else {
            addServiceBtn.style.display = 'none';
        }

        if (isOnlyOneAdditionalServiceOption()) {
            addServiceBtn.style.display = 'none';
        }
    });

    document.querySelector('form').addEventListener('submit', function (event) {
        var additionalServices = [];
        for (var i = 1; i <= additionalServiceCount; i++) {
            var additionalServiceSelect = document.querySelector(`select[name="additionalService${i}"]`);
            var additionalServiceValue = additionalServiceSelect.value;
            if (additionalServiceValue) {
                additionalServices.push(additionalServiceValue);
            }
        }
        var additionalServicesInput = document.createElement('input');
        additionalServicesInput.type = 'hidden';
        additionalServicesInput.name = 'additionalServices';
        additionalServicesInput.value = JSON.stringify(additionalServices);
        this.appendChild(additionalServicesInput);
    });

    </script>
<script>
 // Retrieve the select element
  const selectElement = document.getElementById('services');

  // Add an event listener to handle option selection
  selectElement.addEventListener('change', function() {
    // Retrieve the selected option
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    
    // Retrieve the minute range from the data attribute
    const minuteRange = selectedOption.getAttribute('data-minutes');

    // Display the minute range in an alert dialog
    alert(`Selected Service: ${selectedOption.value}\n${minuteRange}`);
  });
</script>

            <script src="assets/js/main.js"></script>

            <script>
                var BotStar = {
                    appId: "s55176d70-f32d-11ed-bd07-6d62b0f47674",
                    mode: "livechat"
                };
                ! function(t, a) {
                    var e = function() {
                        (e.q = e.q || []).push(arguments)
                    };
                    e.q = e.q || [], t.BotStarApi = e;
                    var s = a.createElement("script");
                    s.type = "text/javascript", s.async = 1, s.src = "https://widget.botstar.com/static/js/widget.js";
                    var n = a.getElementsByTagName("script")[0];
                    n.parentNode.insertBefore(s, n)
                }(window, document);

            </script>