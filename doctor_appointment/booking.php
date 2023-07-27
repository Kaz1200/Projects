<?php
include('class/Appointment.php');

$object = new Appointment;

include('header.php');

$host = "localhost";
$db_name = "u556402485_doctor_appoint"; 
$username = "u556402485_doctor_appoint"; 
$password = "BW76X^sB{%7TrqzG";

try {
    $db = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die("Database connection failed: " . $exception->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $doctorId = $_POST["doctor_id"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $services = $_POST["services"];
    $status = "Booked";
    $additionalServices = $_POST["additionalServices"];
    $additionalServices = str_replace(['[', ']', '"'], '', $additionalServices);

    // Generate appointment number
    $appointment_number = $object->Generate_appointment_no();
    
    // Retrieve the patient_id from the session
    $patientId = $_SESSION["patient_id"];

    // Retrieve the patient data from the patient_database table
    $query = "SELECT * FROM patient_database WHERE patient_id = :patientId";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':patientId', $patientId);
    $stmt->execute();
    $patient_data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Insert the appointment data into the appointments table
    $query = "
        INSERT INTO appointments (doctor_id, patient_id, date, time, services, additionalServices, status, appointment_number)
        VALUES (:doctorId, :patientId, :date, :time, :services, :additionalServices, :status, :appointmentNumber)
    ";


    // Proceed with appointment booking only if patient_id is valid
    if ($patient_data) {
        // check if appointment already exists for this day with any doctor
        $query = "
            SELECT * FROM appointments 
            WHERE patient_id = :patientId
            AND date = :date
            AND status IN ('Booked')
        ";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':patientId', $patientId);
        $stmt->bindParam(':date', $date);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo '<div class="text-center">
                        <div class="alert alert-danger mt-5 mb-4" role="alert">Its already booked choose another date or time.</div>
                  </div>
                  
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="custom-bg py-2">
                        <h1 class="h3 text-white text-center mt-2">Book an Appointment</h1>
                    </div>
                        <div class="card" style="background: #a8c0ff;  /* fallback for old browsers */
                            background: -webkit-linear-gradient(to right, #3f2b96, #a8c0ff);  /* Chrome 10-25, Safari 5.1-6 */
                            background: linear-gradient(to right, #3f2b96, #a8c0ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                <div class="card-body">
                <div class="row justify-content-center">
                    <!-- FLIP CARD 1 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
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
                            <p class="text-center mt-4 text-white"><b>Dr. Mikk Eusebio</b></p>
                        </div>
                    </div>
                    <!-- FLIP CARD 2 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/doc1.jpg" alt="Doctor 1">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br> Oral surgeon specialists</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2019; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center mt-4 text-white"><b>Dr. Chloe Hernando</b></p>
                        </div>
                    </div>
                    <!-- FLIP CARD 3 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/docc3.jpg" alt="Doctor 3">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br>Oral surgeon specialists</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2020; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center mt-4 text-white"><b>Dr. Alroze Regala</b></p>
                        </div>
                    </div>
    </div>
</div>
            ';
            echo "<script>setTimeout(function(){window.location.href='dashboard.php';}, 3000);</script>";
        } else {
            // check if appointment already exists for this day with the selected doctor
            $query = "
                SELECT * FROM appointments 
                WHERE doctor_id = :doctorId 
                AND date = :date
                AND time = :time
                AND status IN ('Booked')
            ";

            $stmt = $db->prepare($query);
            $stmt->bindParam(':doctorId', $doctorId);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo '<div class="text-center">
                <div class="alert alert-danger mt-5 mb-4" role="alert">This slot is already booked. Please choose another date or time.</div>
            </div>
                
                <div class="container-fluid mt-5">
                <div class="row">
                    <div class="custom-bg py-2">
                        <h1 class="h3 text-white text-center mt-2">Book an Appointment</h1>
                    </div>
                        <div class="card" style="background: #a8c0ff;  /* fallback for old browsers */
                            background: -webkit-linear-gradient(to right, #3f2b96, #a8c0ff);  /* Chrome 10-25, Safari 5.1-6 */
                            background: linear-gradient(to right, #3f2b96, #a8c0ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                <div class="card-body">
                <div class="row justify-content-center">
                    <!-- FLIP CARD 1 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
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
                            <p class="text-center mt-4 text-white"><b>Dr. Mikk Eusebio</b></p>
                        </div>
                    </div>
                    <!-- FLIP CARD 2 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/doc1.jpg" alt="Doctor 1">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br> Oral surgeon specialists</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2019; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center mt-4 text-white"><b>Dr. Chloe Hernando</b></p>
                        </div>
                    </div>
                    <!-- FLIP CARD 3 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/docc3.jpg" alt="Doctor 3">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br>Oral surgeon specialists</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2020; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center mt-4 text-white"><b>Dr. Alroze Regala</b></p>
                        </div>
                    </div>
    </div>
</div>
                ';
                echo "<script>setTimeout(function(){window.location.href='dashboard.php';}, 3000);</script>";
            } else {
                // check if appointment was previously cancelled
                $query = "
                    SELECT * FROM appointments 
                    WHERE doctor_id = :doctorId 
                    AND patient_id = :patientId
                    AND date = :date
                    AND time = :time
                    AND status = :status
                ";

                $stmt = $db->prepare($query);
                $stmt->bindParam(':doctorId', $doctorId);
                $stmt->bindParam(':patientId', $patientId);
                $stmt->bindParam(':date', $date);
                $stmt->bindParam(':time', $time);
                $stmt->bindValue(':status', 'Cancel');
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    // allow user to book the previously cancelled appointment
                    $status = 'Booked';
                } else {
                    // otherwise, set the appointment status to 'Waiting'
                    $status = 'Booked';
                }

                // check if doctor schedule is inactive for the specified date
                $query = "
                    SELECT * FROM doctor_schedule_table 
                    WHERE doctor_id = :doctorId 
                    AND doctor_schedule_date = :date
                    AND doctor_schedule_status = 'Inactive'
                ";

                $stmt = $db->prepare($query);
                $stmt->bindParam(':doctorId', $doctorId);
                $stmt->bindParam(':date', $date);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo '<div class="text-center">
                    <div class="alert alert-danger mt-5 mb-4" role="alert">This doctor is not available on the selected date.</div>
                </div>
                    
                    <div class="container-fluid mt-5">
                <div class="row">
                    <div class="custom-bg py-2">
                        <h1 class="h3 text-white text-center mt-2">Book an Appointment</h1>
                    </div>
                        <div class="card" style="background: #a8c0ff;  /* fallback for old browsers */
                            background: -webkit-linear-gradient(to right, #3f2b96, #a8c0ff);  /* Chrome 10-25, Safari 5.1-6 */
                            background: linear-gradient(to right, #3f2b96, #a8c0ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                <div class="card-body">
                <div class="row justify-content-center">
                    <!-- FLIP CARD 1 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
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
                            <p class="text-center mt-4 text-white"><b>Dr. Mikk Eusebio</b></p>
                        </div>
                    </div>
                    <!-- FLIP CARD 2 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/doc1.jpg" alt="Doctor 1">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br> Oral surgeon specialists</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2019; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center mt-4 text-white"><b>Dr. Chloe Hernando</b></p>
                        </div>
                    </div>
                    <!-- FLIP CARD 3 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/docc3.jpg" alt="Doctor 3">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br>Oral surgeon specialists</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2020; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center mt-4 text-white"><b>Dr. Alroze Regala</b></p>
                        </div>
                    </div>
    </div>
</div>
                    ';
                    echo "<script>setTimeout(function(){window.location.href='dashboard.php';}, 3000);</script>";
                } else {
                      $query = "INSERT INTO appointments (patient_id, doctor_id, date, time, services,additionalServices, status, appointment_number) VALUES (:patientId, :doctorId, :date, :time, :services,:additionalServices, :status, :appointmentNumber)";
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':patientId', $patientId);
                    $stmt->bindParam(':doctorId', $doctorId);
                    $stmt->bindParam(':date', $date);
                    $stmt->bindParam(':time', $time);
                    $stmt->bindParam(':services', $services);
                    $stmt->bindParam(':additionalServices', $additionalServices);
                    $stmt->bindParam(':status', $status);
                    $stmt->bindParam(':appointmentNumber', $appointment_number);


                    if ($stmt->execute()) {
                        echo '<div class="text-center">
                                <div class="alert alert-success mt-5 mb-4" role="alert">Appointment booked successfully.</div>
                              </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="appointment_list_table">
                                        <thead class="bg-secondary text-white">
                                            <tr>
                                                <th class="text-center">Appointment ID</th>
                                                <th class="text-center">Appointment Number</th>
                                                <th class="text-center">Doctor Name</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Time</th>
                                                <th class="text-center">Services</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="8" class="text-center">Processing Data...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                ';
                        echo "<script>setTimeout(function(){window.location.href='appointment.php';}, 2000);</script>";
                    } else {
                        echo '<div class="text-center">
                        <div class="alert alert-danger mt-5 mb-4" role="alert">Error booking appointment.<.div>
                </div>
                        <<div class="container-fluid mt-5">
                <div class="row">
                    <div class="custom-bg py-2">
                        <h1 class="h3 text-white text-center mt-2">Book an Appointment</h1>
                    </div>
                        <div class="card" style="background: #a8c0ff;  /* fallback for old browsers */
                            background: -webkit-linear-gradient(to right, #3f2b96, #a8c0ff);  /* Chrome 10-25, Safari 5.1-6 */
                            background: linear-gradient(to right, #3f2b96, #a8c0ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                <div class="card-body">
                <div class="row justify-content-center">
                    <!-- FLIP CARD 1 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
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
                            <p class="text-center mt-4 text-white"><b>Dr. Mikk Eusebio</b></p>
                        </div>
                    </div>
                    <!-- FLIP CARD 2 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/doc1.jpg" alt="Doctor 1">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br> Oral surgeon specialists</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2019; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center mt-4 text-white"><b>Dr. Chloe Hernando</b></p>
                        </div>
                    </div>
                    <!-- FLIP CARD 3 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/docc3.jpg" alt="Doctor 3">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br>Oral surgeon specialists</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2020; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center mt-4 text-white"><b>Dr. Alroze Regala</b></p>
                        </div>
                    </div>
    </div>
</div>
';
                        echo "<script>setTimeout(function(){window.location.href='dashboard.php';}, 3000);</script>";
                    }
                }
            }
        }

        // Display alert message if there is an error
        if (!empty($error)) {
            echo json_encode(['error' => $error]);
        } else {
            // echo '<div class="alert alert-success" role="alert">Appointment booked successfully.</div>';
            echo "<script>setTimeout(function(){window.location.href='appointment.php';}, 2000);</script>";
        }
    } else {

        echo '<div class="text-center">
                <div class="alert alert-danger mt-5 mb-4" role="alert">Invalid patient ID.</div>
              </div>
        <div class="container-fluid mt-5">
                <div class="row">
                    <div class="custom-bg py-2">
                        <h1 class="h3 text-white text-center mt-2">Book an Appointment</h1>
                    </div>
                        <div class="card" style="background: #a8c0ff;  /* fallback for old browsers */
                            background: -webkit-linear-gradient(to right, #3f2b96, #a8c0ff);  /* Chrome 10-25, Safari 5.1-6 */
                            background: linear-gradient(to right, #3f2b96, #a8c0ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                <div class="card-body">
                <div class="row justify-content-center">
                    <!-- FLIP CARD 1 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
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
                            <p class="text-center mt-4 text-white"><b>Dr. Mikk Eusebio</b></p>
                        </div>
                    </div>
                    <!-- FLIP CARD 2 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/doc1.jpg" alt="Doctor 1">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br> Oral surgeon specialists</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2019; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center mt-4 text-white"><b>Dr. Chloe Hernando</b></p>
                        </div>
                    </div>
                    <!-- FLIP CARD 3 -->
                    <div class="col-lg-4">
                        <div class="flip-card-container">
                            <div class="flip-card">
                                <div class="back-info">
                                    <div class="flip-image-front">
                                        <img src="doctor/assets/img/doctors/docc3.jpg" alt="Doctor 3">
                                    </div>
                                    <div class="flip-image-back">
                                        <p><strong>Expertise:</strong><br>Oral surgeon specialists</p>
                                        <p><strong>Years of experience:</strong> <br><?php echo date("Y") - 2020; ?> years</p>
                                        <p><strong>Available time:</strong> <br>Every 6:00 am - 5:00 pm</p>
                                        <p><strong>Available days:</strong><br> Every Monday to Friday</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="caption">
                            <p class="text-center mt-4 text-white"><b>Dr. Alroze Regala</b></p>
                        </div>
                    </div>
    </div>
</div>';
        echo "<script>setTimeout(function(){window.location.href='dashboard.php';}, 3000);</script>";
    }
}
