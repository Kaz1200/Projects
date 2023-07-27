<?php
// get_inactive_dates.php

if (isset($_POST['doctor_id'])) {
    $doctor_id = $_POST['doctor_id'];

    // Connect to database
$host = "localhost";
$db_name = "u556402485_doctor_appoint"; 
$username = "u556402485_doctor_appoint"; 
$password = "BW76X^sB{%7TrqzG";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query for inactive dates based on doctor_id
    $query = "SELECT doctor_schedule_date FROM doctor_schedule_table WHERE doctor_schedule_status = 'Inactive' AND doctor_id = $doctor_id";
    $result = mysqli_query($conn, $query);

    // Create array of inactive dates
    $inactive_dates = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $inactive_dates[] = $row['doctor_schedule_date'];
    }

    mysqli_close($conn);

    // Return the inactive dates as JSON
    echo json_encode($inactive_dates);
}
?>
