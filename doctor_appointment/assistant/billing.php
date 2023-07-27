<?php

//assistant.php 

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

// Retrieve the doctor names
$doctor_query = "SELECT doctor_id, doctor_name FROM doctor_database";
$doctor_result = $conn->query($doctor_query);

?>

<form method="post" class="form">
	<div class="card-header py-3 bg-primary mb-3">
		<div class="d-flex justify-content-between align-items-center">
			<h1 class="h3 mb-2 text-white text-center mt-2 mx-auto">Billing Statement</h1>
			<a href="billingHistory.php" class="ml-3px" data-toggle="tooltip" data-placement="bottom" title="Billing History">
				<i class="fas fa-file-invoice fa-2x text-white mr-3 shadow-sm"></i>
			</a>
		</div>
	</div>
	<div class="row  d-flex justify-content-center align-items-center">

		<div class="col-md-6">
			<div class="form-group">
				<label for="patient_id">Patient ID:</label>
				<input type="text" name="patient_id" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="doctor_id">Doctor Name:</label>
				<select name="doctor_id" class="form-control" required>
					<option value="">Select Doctor...</option>
					<?php
					// Display the doctor names as options
					while ($doctor_row = $doctor_result->fetch_assoc()) {
						echo '<option value="' . $doctor_row['doctor_id'] . '">' . $doctor_row['doctor_name'] . '</option>';
					}
					?>
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
					<option value="Periapical X-Ray">Periapical X-Ray</option>
					<option value="Implant">Implant</option>
				</select>
			</div>
			<div class="form-group">
				<label for="billing_date">Billing Date:</label>
				<input type="date" name="billing_date" class="form-control" required onchange="disableWeekends(this)">
				<span id="weekend-error" style="display:none; color:red;">Weekends are not allowed</span>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="amount">Total amount:</label>
				<input type="text" name="amount" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="amount">Total amount paid:</label>
				<input type="text" name="paid" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="status">Status:</label>
				<select name="status" class="form-control" required>
					<option value="">Select status...</option>
					<option value="Paid">Paid</option>
					<option value="Unpaid">Unpaid</option>
				</select>
			</div>
		</div>
		<input type="submit" name="submit" value="Submit" class="btn btn-primary mt-3 mb-2">
	</div>
	<hr>
</form>

<?php
// If the user submitted the form
if (isset($_POST['submit'])) {
	// Get the input data
	$patient_id = $_POST['patient_id'];
	$doctor_id = $_POST['doctor_id'];
	$service = $_POST['service'];
	$amount = $_POST['amount'];
	$paid = $_POST['paid'];
	$status = $_POST['status'];
	$billing_date = $_POST['billing_date'];

	// Retrieve the doctor name from the doctor_database table
	$doctor_query = "SELECT doctor_name FROM doctor_database WHERE doctor_id='$doctor_id'";
	$doctor_result = $conn->query($doctor_query);

	if ($doctor_result->num_rows > 0) {
		$doctor_row = $doctor_result->fetch_assoc();
		$doctor_name = $doctor_row['doctor_name'];

		// Check if the patient id already exists in the database
		$check_query = "SELECT * FROM patient_database WHERE patient_id='$patient_id'";
		$check_result = $conn->query($check_query);

		if ($check_result->num_rows > 0) {
			// Patient id already exists, show an error message
			$sql = "INSERT INTO billing_database (patient_id, doctor_id, doctor_name, service, amount, paid, status, billing_date) VALUES ('$patient_id', '$doctor_id', '$doctor_name', '$service', '$amount', '$paid', '$status', '$billing_date')";
			if ($conn->query($sql) === TRUE) {
				echo '<p class="text-success">New record created successfully</p>';
			} else {
				echo '<p class="text-danger">Error: ' . $sql . '<br>' . $conn->error . '</p>';
			}
		} else {
			// Insert the data into the database
			echo '<p class="text-danger">Error: Patient ID does not exist</p>';
		}
	} else {
		// No doctor found with the specified doctor_id
		echo '<p class="text-danger">Error: Invalid doctor selected</p>';
	}
}


// Pagination configuration
$results_per_page = 10;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $results_per_page;

// Retrieve the billing data from the database
$search_query = isset($_GET['patient_id']) ? " WHERE patient_id='" . $_GET['patient_id'] . "'" : "";
$sql = "SELECT * FROM billing_database" . $search_query . " LIMIT $results_per_page OFFSET $offset";
$result = $conn->query($sql);

echo '</tbody></table>';

// Display pagination links
$sql = "SELECT COUNT(*) as total FROM billing_database";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row['total'] / $results_per_page);

// Close the connection
$conn->close();
?>

<?php
include('footer.php');
?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />