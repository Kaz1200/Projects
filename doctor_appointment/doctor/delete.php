// <?php
// $servername = "localhost";
// $username = "u556402485_doctor_appoint";
// $password = "BW76X^sB{%7TrqzG";
// $dbname = "u556402485_doctor_appoint";
// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Check if the billing_id was passed in the URL
// if (isset($_GET['id'])) {
//     $billing_id = $_GET['id'];

//     // Delete the billing record from the database
//     $sql = "DELETE FROM billing_database WHERE billing_id='$billing_id'";
//     if ($conn->query($sql) === TRUE) {
//          echo '<p class="text-success">Record deleted successfully</p>';
//          header("Location: billing.php");
//         exit();
//     } else {
//         echo '<p class="text-danger">Error deleting record: ' . $conn->error . '</p>';
//     }
// }

// // Close the connection
// $conn->close();
