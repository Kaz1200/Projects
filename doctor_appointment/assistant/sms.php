<?php
//appointment.php
include('../class/Appointment.php');

$object = new Appointment;

if (!isset($_SESSION['admin_id'])) {
    header('location:' . $object->base_url . '');
}

include('header.php');
require '../vendor/autoload.php'; // Include the Twilio PHP library

use Twilio\Rest\Client;
// Your Twilio account SID and auth token
$accountSid = 'AC794d5b33e9034abb15503c46a948b4e1';
$authToken = '4c296f43b9dd0454dc2e83afcf830d01';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form input values
    $toNumber = $_POST['phone'];
    $message = 'Hello ' . $_POST['name'] . ', Appointment Reminder: Your appointment at Dental Care Haven is tomorrow at ' . $_POST['time'] . ' and service ' . $_POST['services'] . '. Please arrive a few minutes early, and if you have any questions or need to reschedule, please call (02) 8661 4827.';;

    // Create a new Twilio client
    $client = new Client($accountSid, $authToken);

    try {
        // Send the SMS message
        $client->messages->create(
            $toNumber,
            [
                'from' => '+12542764075',
                'body' => $message
            ]
        );

        echo 'Message sent successfully!';
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

<div class="container mb-5">
    <h2>Send SMS</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="+639XXXXXXXXX" required data-parsley-trigger="keyup" maxlength="14" pattern="+639[0-9]{9}" title="Please enter a valid phone number starting with +639 and containing 13 digits dont forget the +." required>
        </div>
        <div class="form-group">
            <label for="time">Time:</label>
            <input type="text" class="form-control" name="time" id="time" required>
        </div>
        <div class="form-group">
            <label for="services">Services:</label>
            <select name="services" id="services" class="form-control" required style="overflow-y: scroll;">
                <option value="">Select Service...</option>
                <option value="Metal and Ceramic Braces">Metal and Ceramic Braces</option>
                <option value="Self-ligating braces">Self-ligating braces</option>
                <option value="Invisible Aligners/ Braces">Invisible Aligners/Braces</option>
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
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Send SMS</button>
        </div>
    </form>
</div>
<hr>

<div class="card-header py-3 bg-primary mb-3 rounded-top p-3">
    <h1 class="h3 mb-2 text-white text-center mt-2">Appointment Data</h1>
</div>


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

// Retrieve the appointment data with doctor name from the database
$sql = "SELECT appointments.patient_id, appointments.date, appointments.time, appointments.services, patient_database.patient_first_name, patient_database.patient_last_name, patient_database.patient_suffix, patient_database.patient_phone_no, doctor_database.doctor_name
        FROM appointments
        INNER JOIN patient_database ON appointments.patient_id = patient_database.patient_id
        INNER JOIN doctor_database ON appointments.doctor_id = doctor_database.doctor_id
        WHERE appointments.status = 'Booked'
        ORDER BY appointments.date ASC, appointments.time ASC";
$result = $conn->query($sql);

// Pagination configuration
$results_per_page = 10;
$total_results = $result->num_rows;
$total_pages = ceil($total_results / $results_per_page);
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $results_per_page;

// Retrieve the appointment data with pagination
$sql .= " LIMIT $offset, $results_per_page";
$result = $conn->query($sql);

// Display the appointment data in a table
echo '<div class="table-responsive">';

if ($result->num_rows > 0) {
    echo '<table class="table">';
    echo '<thead class="thead-light"><tr><th class="text-center align-top">Date</th><th class="text-center align-top">Patient Name</th><th class="text-center align-top">Phone Number</th><th class="text-center align-top">Time</th><th class="text-center align-top">Services</th><th class="text-center align-top">Doctor Name</th></tr></thead><tbody>';

while ($row = $result->fetch_assoc()) {
    $patientName = $row['patient_first_name'] . ' ' . $row['patient_last_name'] . ' ' . $row['patient_suffix'];
    echo "<tr><td class='text-center'>" . $row['date'] . "</td><td class='text-center'>" . $patientName . "</td><td class='text-center'>" . $row['patient_phone_no'] . "</td><td class='text-center'>" . $row['time'] . "</td><td class='text-center'>" . $row['services'] . "</td><td class='text-center'>" . $row['doctor_name'] . "</td></tr>";
}


    echo '</tbody></table>';

    // Display pagination links if there are more than 10 pages
    if ($total_pages > 1) {
        echo '<nav aria-label="Page navigation"><ul class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $class = ($i == $current_page) ? "active" : "";
            echo '<li class="page-item ' . $class . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }
        echo '</ul></nav>';
    }
} else {
    echo '<table class="table">';
    echo '<thead class="thead-light"><tr><th class="text-center align-top">Patient ID</th><th class="text-center align-top">Date</th><th class="text-center align-top">Time</th><th class="text-center align-top">Services</th><th class="text-center align-top">Patient Name</th><th class="text-center align-top">Phone Number</th><th class="text-center align-top">Doctor Name</th></tr></thead><tbody>';
    echo '</tbody></table>';
    echo '<p class="text-center">No data available in the table</p>';
}

echo '</div>';

$conn->close();
?>

<?php
include('footer.php');
?>

