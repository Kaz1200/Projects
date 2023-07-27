<?php
// dashboard.php
include('class/Appointment.php');
$object = new Appointment;
include('header.php');

// Pagination settings
$results_per_page = 5;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_index = ($current_page - 1) * $results_per_page;

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

// Check if the cancel button is clicked
if (isset($_GET['cancel'])) {
    $appointmentId = $_GET['cancel'];

    // Update the status of the appointment to "Cancelled"
    $query = "UPDATE appointments SET status = 'Cancelled' WHERE appointment_id = :appointmentId";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':appointmentId', $appointmentId);
    $stmt->execute();
}

// Retrieve the patient_id from the session
$patientId = $_SESSION["patient_id"];

// Retrieve appointments for the specific patient with pagination and date range filter
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

// Modify the query to include the date range filter
$query = "SELECT a.appointment_id, a.appointment_number, d.doctor_name, a.date, a.time, a.services, a.additionalServices, a.status 
          FROM appointments AS a
          INNER JOIN doctor_database AS d ON a.doctor_id = d.doctor_id
          WHERE a.patient_id = :patientId";

// Add the date range filter if the start and end dates are set
if ($start_date && $end_date) {
    $query .= " AND a.date BETWEEN :start_date AND :end_date";
}

$query .= " ORDER BY a.appointment_number DESC";

// Prepare the query and bind the parameters
$stmt = $db->prepare($query);
$stmt->bindParam(':patientId', $patientId);

// Bind the date range filter parameters if they are set
if ($start_date && $end_date) {
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
}

$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate the total number of pages
$total_pages = ceil(count($appointments) / $results_per_page);

// Check if pagination should be displayed
$show_pagination = ($total_pages > 1 && count($appointments) > $results_per_page);

// Get the appointments for the current page with doctor name
$query = "SELECT a.appointment_id, a.appointment_number, d.doctor_name, a.date, a.time, a.services, a.additionalServices, a.status 
          FROM appointments AS a
          INNER JOIN doctor_database AS d ON a.doctor_id = d.doctor_id
          WHERE a.patient_id = :patientId";

// Add the date range filter if the start and end dates are set
if ($start_date && $end_date) {
    $query .= " AND a.date BETWEEN :start_date AND :end_date";
}

$query .= " ORDER BY a.appointment_number DESC LIMIT :start, :limit";

// Prepare the query and bind the parameters
$stmt = $db->prepare($query);
$stmt->bindParam(':patientId', $patientId);
$stmt->bindParam(':start', $start_index, PDO::PARAM_INT);
$stmt->bindParam(':limit', $results_per_page, PDO::PARAM_INT);

// Bind the date range filter parameters if they are set
if ($start_date && $end_date) {
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
}

$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid mt-5">
	<br />
	<div class="card">
		<div class="custom-bg py-2">
			<h1 class="h3 mb-2 text-white text-center mt-2">Appointment Data</h1>
		</div>
		<div class="card-body">
			<div class="card">
				<div class="card-body">
					<form method="GET" class="mt-3 mb-4">
						<div class="form-group row justify-content-center">
							<label for="start_date" class="col-sm-2 col-form-label text-right">Search by Date Range:</label>
							<div class="col-sm-3">
								<input type="date" name="start_date" class="form-control mr-2" value="<?php echo $start_date; ?>">
							</div>
							<div class="col-sm-3 mt-2 mt-sm-0">
								<input type="date" name="end_date" class="form-control mr-2" value="<?php echo $end_date; ?>">
							</div>
							<div class="col-sm-1 mt-2 mt-sm-0 text-center">
								<button type="submit" class="btn btn-primary">Search</button>
							</div>
							<div class="col-sm-1 mt-2 mt-sm-0 text-center">
								<a href="appointment.php" class="btn btn-secondary">Clear</a>
							</div>
						</div>
				</div>
				</form>
			</div>
			<!-- <div class="row mb-3">
				<div class="col-md-6">
					<form class="form-inline" method="GET">
						<label class="mr-2">Start Date:</label>
						<input type="date" name="start_date" class="form-control mr-2" value="<?php echo $start_date; ?>">
						<label class="mr-2">End Date:</label>
						<input type="date" name="end_date" class="form-control mr-2" value="<?php echo $end_date; ?>">
						<button type="submit" class="btn btn-primary">Filter</button>
					</form>
				</div>
			</div> -->
			<?php if (empty($appointments)) { ?>
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
								<td colspan="8" class="text-center">No data available in the table.</td>
							</tr>
						</tbody>
					</table>
				</div>
			<?php } else { ?>
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
							<?php foreach ($appointments as $appointment) { ?>
								<tr>
									<td>
										<div class="text-center"><?php echo $appointment['appointment_id']; ?></div>
									</td>
									<td>
										<div class="text-center"><?php echo $appointment['appointment_number']; ?></div>
									</td>
									<td>
										<div class="text-center"><?php echo $appointment['doctor_name']; ?></div>
									</td>
									<td>
										<div class="text-center"><?php echo $appointment['date']; ?></div>
									</td>
									<td>
										<div class="text-center"><?php echo $appointment['time']; ?></div>
									</td>
									<td>
										<div class="text-center">
                                            <?php echo $appointment['services']; ?>
                                            <?php if (!empty($appointment['additionalServices'])) {
                                                echo ' and ' . $appointment['additionalServices'];
                                            } ?>
                                        </div>
									</td>
									<td>
										<div class="text-center"><?php echo $appointment['status']; ?></div>
									</td>
									<td>
										<div class="text-center">
											<?php if ($appointment['status'] === 'Booked') { ?>
												<?php
												// Get the appointment date and time
												$appointmentDateTime = $appointment['date'] . ' ' . $appointment['time'];

												// Get the current date and time
												$currentDateTime = date('Y-m-d H:i:s');

												// Compare appointment date and time with the current date and time
												if ($appointmentDateTime > $currentDateTime) {
													// Enable cancel button
												?>
													<a href="?cancel=<?php echo $appointment['appointment_id']; ?>" class="btn btn-danger">Cancel</a>
												<?php } else {
													// Disable cancel button
												?>
													<span class="btn btn-danger disabled">Cancel</span>
												<?php } ?>
											<?php } else { ?>
												<span class="badge bg-primary">N/A</span>
											<?php } ?>
										</div>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<?php if ($show_pagination) { ?>
					<div class="text-center mt-3">
						<?php
						for ($i = 1; $i <= $total_pages; $i++) {
							if ($i == $current_page) {
								echo '<a class="btn btn-primary btn-sm mx-1" href="appointment.php?page=' . $i . '">' . $i . '</a>';
							} else {
								echo '<a class="btn btn-light btn-sm mx-1" href="appointment.php?page=' . $i . '">' . $i . '</a>';
							}
						}
						?>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>

				<?php include('footer.php'); ?>

				<script src="assets/js/main.js"></script>
				<script>
    var BotStar = {
        appId: "s55176d70-f32d-11ed-bd07-6d62b0f47674",
        mode: "livechat"
    };
    !function(t,a){
        var e=function(){(e.q=e.q||[]).push(arguments)};
        e.q=e.q||[],t.BotStarApi=e;
        var s=a.createElement("script");
        s.type="text/javascript",s.async=1,s.src="https://widget.botstar.com/static/js/widget.js";
        var n=a.getElementsByTagName("script")[0];
        n.parentNode.insertBefore(s,n)
    }(window,document);
</script>