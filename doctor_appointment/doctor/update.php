<?php

include('../class/Appointment.php');

$object = new Appointment;

if (!$object->is_login()) {
    header("location:" . $object->base_url . "admin");
}

include('header.php');

// Database credentials
$servername = "localhost";
$username = "u556402485_doctor_appoint";
$password = "BW76X^sB{%7TrqzG";
$dbname = "u556402485_doctor_appoint";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the user submitted the form
if (isset($_POST['submit'])) {
    // Get the input data
    $billing_id = $_POST['billing_id'];
    $patient_id = $_POST['patient_id'];
    $doctor_name = $_POST['doctor_name'];
    $service = $_POST['service'];
    $billing_date = $_POST['billing_date'];
    $amount = $_POST['amount'];
    $paid = $_POST['paid'];
    $status = $_POST['status'];

    // Check if the patient ID exists in the database
    $query = "SELECT * FROM billing_database WHERE billing_id='$billing_id'";
    $result = $conn->query($query);

    if ($result->num_rows == 0) {
        // Insert the new billing record
        $query = "INSERT INTO billing_database (billing_id, patient_id, doctor_name, service, billing_date, amount, paid, status) VALUES ('$billing_id''$patient_id', '$doctor_name', '$service', '$billing_date', '$amount', '$paid', '$status')";
        $conn->query($query);

        echo "<div class='alert alert-success'>Billing record added successfully!</div>";
    } else {
        // Update the existing billing record
        $query = "UPDATE billing_database SET doctor_name='$doctor_name', service='$service', billing_date='$billing_date', amount='$amount', paid='$paid', status='$status' WHERE billing_id='$billing_id'";
        $conn->query($query);

        echo "<div class='alert alert-success'>Billing record updated successfully!</div>";
        echo "<script>window.location.href='billing.php'</script>";
    }
}

// If the user submitted the search form
if (isset($_GET['billing_id'])) {
    $patient_id = $_GET['billing_id'];

    // Retrieve the billing records for the given patient ID
    $query = "SELECT * FROM billing_database WHERE billing_id='$billing_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Display the billing records in a table
        echo "<table class='table'>
              <thead>
                <tr>
                  <th>Billing ID</th>
                  <th>Patient ID</th>
                  <th>Doctor Name</th>
                  <th>Service</th>
                  <th>Billing Date</th>
                  <th>Amount</th>
                  <th>Paid</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                  <td>" . $row['billing_id'] . "</td>
                  <td>" . $row['patient_id'] . "</td>
                  <td>" . $row['doctor_name'] . "</td>
                  <td>" . $row['service'] . "</td>
                  <td>" . $row['billing_date'] . "</td>
                  <td>" . $row['amount'] . "</td>
                  <td>" . $row['paid'] . "</td>
                  <td>" . $row['status'] . "</td>
                </tr>";
        }

        echo "</tbody></table>";
    } else {
        // No billing records found for the given patient ID
        echo "<div class='alert alert-danger'>No billing records found for patient ID: $patient_id</div>";
    }
}
?>

<!-- Billing form -->
<div class="card-header py-3 bg-primary">
    <h1 class="h3 mb-2 text-white text-center mt-2">Edit Billing</h1>
</div>
<form method="post" action="">
    <div class="row  d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <div class="form-group mt-3">
                <label for="billing_id">Billing ID:</label>
                <select name="billing_id" class="form-control" id="billing_id" onchange="updateBillingId(this.value)">
                    <option value="">Select Billing ID...</option>
                    <?php
                    $query = "SELECT DISTINCT billing_id FROM billing_database ORDER BY billing_id DESC";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['billing_id'] . "\">" . $row['billing_id'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="patient_id">Patient ID:</label>
                <select name="patient_id" class="form-control" id="patient_id" onchange="updatePatientId(this.value)">
                    <option value="">Select Patient ID...</option>
                    <?php
                    $query = "SELECT DISTINCT patient_id FROM billing_database ORDER BY patient_id DESC";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['patient_id'] . "\">" . $row['patient_id'] . "</option>";
                    }
                    ?>
                </select>
            </div>

           <div class="form-group">
                <label for="doctor_id">Doctor Name:</label>
                <select name="doctor_name" class="form-control" required>
                    <option value="">Select Doctor...</option>
                    <option value="Dr. Mikk Hernalyn Eusebi">Dr. Mikk Hernalyn Eusebio</option>
                    <option value="Dr. Chloe Marianelle Hernand">Dr. Chloe Marianelle Hernando</option>
                    <option value="Dr. Alroze Regala">Dr. Alroze Regala</option>
                </select>
            </div>
            <div class="form-group">
                <label for="service">Services:</label>
                <select name="service" class="form-control" required style="overflow-y: scroll;">
                    <option value="">Select Service...</option>
                    <option value="Metal and Ceramic Braces">Metal and Ceramic Braces</option>
                    <option value="Self-ligating braces">Self-ligating braces</option>
                    <option value="Invisible Aligners/ Braces">Invisible Aligners/ Braces</option>
                    <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                    <option value="Tooth Restoration">Tooth Restoration</option>
                    <option value="Root Canal Treatment">Root Canal Treatment</option>
                    <option value="Tooth Extraction">Tooth Extraction</option>
                    <option value="Wisdom Tooth Removal">Wisdom Tooth Removal</option>
                    <option value="Teeth Whitening">Teeth Whitening</option>
                    <option value="Crowns and Bridges">Crowns and Bridges</option>
                    <option value="Veneers">Veneers</option>
                    <option value="Complete Dentures">Complete Dentures</option>
                    <option value="Removable Dentures (Ordinary & Flexite)">Removable Dentures (Ordinary & Flexite)</option>
                    <option value="Pediatric Dentistry">Pediatric Dentistry</option>
                    <option value="Digital Panoramic X-Ray">Digital Panoramic X-Ray</option>
                    <option value="Periapical X-Ray<">Periapical X-Ray</option>
                    <option value="Implant">Implant</option>
                </select>
            </div>
            <form>
          
        </div>

        <div class="col-md-6">
        <div class="form-group mt-3">
                <label for="billing_date">Billing Date:</label>
                <input type="date" class="form-control" id="billing_date" name="billing_date" required>
            </div>
            <div class="form-group">
                <label for="amount">Total Amount:</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>
            <div class="form-group">
                <label for="paid">Total Paid:</label>
                <input type="number" class="form-control" id="paid" name="paid" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                </select>
            </div>
        </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
        <button onclick="window.history.back();" class="btn btn-primary float-right"><i class="fas fa-arrow-left"></i> Back</button>
</form>



<?php include('footer.php'); ?>