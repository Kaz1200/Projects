<?php
// billing-history.php

include('class/Appointment.php');
$object = new Appointment;
include('header.php');
?>

<br>
<br>
<br>
<div class="card">
    <div class="custom-bg py-2">
        <h1 class="h3 mb-2 text-white text-center mt-2">Billing Statement</h1>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <form method="GET" action="">
            <div class="form-group row justify-content-center">
                <label for="start_date" class="col-sm-2 col-form-label text-right">Search by Date Range:</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>" placeholder="Start Date">
                </div>
                <div class="col-sm-3 mt-2 mt-sm-0">
                    <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>" placeholder="End Date">
                </div>
                <div class="col-sm-1 mt-2 mt-sm-0 text-center">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
                <div class="col-sm-1 mt-2 mb-3 mt-sm-0 text-center">
                    <a href="billing-history.php" class="btn btn-secondary">Clear</a>
                </div>
            </div>
        </form>
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

   
// If the user submitted the form
// Pagination configuration
$results_per_page = 5;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $results_per_page;

// Retrieve the billing data for the current patient from the database
$patient_id = $_SESSION['patient_id']; // Assuming you have stored the patient ID in a session variable
$search_query = " WHERE patient_id='$patient_id'";

// Apply date range filter if provided
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $search_query .= " AND billing_date BETWEEN '$start_date' AND '$end_date'";
}

// Retrieve the billing data from the database
$sql = "SELECT * FROM billing_database" . $search_query;
$count_result = $conn->query($sql);
$total_results = $count_result->num_rows;

$total_pages = ceil($total_results / $results_per_page);

$sql .= " LIMIT $results_per_page OFFSET $offset";
$result = $conn->query($sql);

// Display the billing data in a table
if ($result->num_rows > 0) {
    echo '<div class="card-body">';
    echo '<div class="table-responsive">';
    echo '<table class="table table-hover table-bordered">';
    echo '<thead class="bg-secondary text-white"><tr><th class="text-center align-top">Billing Date</th><th class="text-center align-top">Doctor Name</th><th class="text-center align-top">Service</th><th class="text-center align-top">T.Amount</th><th class="text-center align-top">T.Paid</th><th class="text-center align-top">Status</th></tr></thead><tbody>';

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td class='text-center'>" . $row['billing_date'] . "</td><td class='text-center'>" . $row['doctor_name'] . "</td><td class='text-center'>" . $row['service'] . "</td><td class='text-center'>" . $row['amount'] . "</td><td class='text-center'>" . $row['paid'] . "</td><td class='text-center'>" . $row['status'] . "</td></tr>";
    }
    echo '</tbody></table>';
    echo '</div>';
    echo '</div>';

    // Display pagination if there are more than 5 pages
    if ($total_pages > 1) {
        echo '<div class="pagination">';
        echo '<ul class="pagination justify-content-center">';
        
        // Previous page link
        if ($current_page > 1) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
        }
        
        // Page links
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
                echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            }
        }
        
        // Next page link
        if ($current_page < $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
        }
        
        echo '</ul>';
        echo '</div>';
        
    }
} else {
    echo '<table class="table table-hover table-bordered mt-4">';
    echo '<thead class="bg-secondary text-white"><tr><th class="text-center align-top">Billing Date</th><th class="text-center align-top">Doctor Name</th><th class="text-center align-top">Service</th><th class="text-center align-top">T.Amount</th><th class="text-center align-top">T.Paid</th><th class="text-center align-top">Status</th></tr></thead><tbody>';
    echo '</tbody></table>';

    echo "<p class='text-center'>No data available in the table</p>";
    echo '</div>';
    echo '</div>';
}

// Close the connection
$conn->close();
?>
</div>

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

<?php
include('footer2.php');
?>