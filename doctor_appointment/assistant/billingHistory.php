<?php

//assistant.php 

include('../class/Appointment.php');

$object = new Appointment;

if (!$object->is_login()) {
	header("location:" . $object->base_url . "admin");
}

include('header.php');

?>


<div class="card-header py-3 bg-primary mb-3 rounded-top p-3">
	<h1 class="h3 mb-2 text-white text-center mt-2">Billing Statement</h1>
</div>

<form method="GET" action="">
	<div class="form-group d-flex justify-content-center align-items-center">
		<label for="patient_id"></label>
		<button type="submit" class="btn btn-primary"><i class="fa-sharp fa-solid fa-magnifying-glass" style="z-index: 100;"></i></button>
		<input type="text" name="patient_id" class="form-control pl-3 mr-2" id="patient_id" placeholder="Search By Patient ID...." style="margin-left: -8px; z-index: 99;">
		<button type="button" class="btn btn-primary d-flex justify-content-center align-items-center py-2" onclick="location.href='billingHistory.php'" style="font-size: 15px;"><i class="fas fa-sync-alt mr-2"></i> Refresh</button>
	</div>
</form>

<?php
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
if (isset($_GET['patient_id']) && !empty($_GET['patient_id'])) {
	// Retrieve the billing data based on the search query
	$search_query = " WHERE patient_id='" . $_GET['patient_id'] . "'";
} else {
	$search_query = ""; // Empty search query to retrieve all data
}

// Pagination configuration
$results_per_page = 10;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $results_per_page;

// Retrieve the billing data from the database
$sql = "SELECT * FROM billing_database" . $search_query . " ORDER BY billing_id DESC LIMIT $results_per_page OFFSET $offset";
$result = $conn->query($sql);

// Display the billing data in a table
echo '<div class="table-responsive">';

if ($result->num_rows > 0) {
	echo '<table class="table">';
	echo '<thead class="thead-light"><tr><th class="text-center align-top">Billing ID</th><th class="text-center align-top">Billing Date</th><th class="text-center align-top">Patient ID</th><th class="text-center align-top">Doctor Name</th><th class="text-center align-top">Service</th><th class="text-center align-top">T.Amount</th><th class="text-center align-top">T.Paid</th><th class="text-center align-top">Status</th></tr></thead><tbody>';

	while ($row = $result->fetch_assoc()) {
		echo "<tr><td class='text-center'>" . $row['billing_id'] . "</td><td class='text-center'>" . $row['billing_date'] . "</td><td class='text-center'>" . $row['patient_id'] . "</td><td class='text-center'>" . $row['doctor_name'] . "</td><td class='text-center'>" . $row['service'] . "</td><td class='text-center'>" . $row['amount'] . "</td><td class='text-center'>" . $row['paid'] . "</td><td class='text-center'>" . $row['status'] . "</td></tr>";
	}

	echo '</tbody></table>';

	echo '<button onclick="window.location.href=\'billing.php\';" class="btn btn-primary float-right mb-0">
	    <i class="fas fa-arrow-left"></i> Back
	</button>';
} else {
	echo '<table class="table">';
	echo '<thead class="thead-light"><tr><th class="text-center align-top">Billing ID</th><th class="text-center align-top">Billing Date</th><th class="text-center align-top">Patient ID</th><th class="text-center align-top">Doctor Name</th><th class="text-center align-top">Service</th><th class="text-center align-top">T.Amount</th><th class="text-center align-top">T.Paid</th><th class="text-center align-top">Status</th></tr></thead><tbody>';
	echo '</tbody></table>';
	echo '<p class="text-center">No data available in the table</p>';

	echo '<button onclick="window.location.href=\'billing.php\';" class="btn btn-primary float-right mb-0">
	    <i class="fas fa-arrow-left"></i> Back
	</button>';
}

echo '</div>';

// Display pagination links if there are more than 10 pages
$sql = "SELECT COUNT(*) as total FROM billing_database" . $search_query;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row['total'] / $results_per_page);

if ($total_pages > 1) {
	echo '<nav aria-label="Page navigation"><ul class="pagination">';
	for ($i = 1; $i <= $total_pages; $i++) {
		$class = ($i == $current_page) ? "active" : "";
		echo '<li class="page-item ' . $class . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
	}
	echo '</ul></nav>';
}

// Close the connection
$conn->close();
?>

<?php
include('footer.php');
?>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />