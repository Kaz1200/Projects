<?php

include('class/Appointment.php');

$object = new Appointment;
include('header3.php');

if (isset($_SESSION['Email_Session'])) {
    header("Location: welcome.php");
    exit();
}

$servername = "localhost";
$username = "u556402485_doctor_appoint";
$password = "BW76X^sB{%7TrqzG";
$dbname = "u556402485_doctor_appoint";
$conx = new mysqli($servername, $username, $password, $dbname);

if ($conx->connect_error) {
    die("Connection failed: " . $conx->connect_error);
}

$msg = "";
$error = "";

if (isset($_GET['Reset'])) {
    $resetVerificationCode = $_GET['Reset'];
    $resetVerificationCode = $conx->real_escape_string($resetVerificationCode);

    $resetQuery = "SELECT * FROM patient_database WHERE patient_verification_code = '$resetVerificationCode'";
    $resetResult = $conx->query($resetQuery);

    if ($resetResult && $resetResult->num_rows > 0) {
        if (isset($_POST['submit'])) {
            $pass = $_POST['patient_password'];
            $confirmPass = $_POST['Conf-Password'];

            if ($pass === $confirmPass) {
                $updateQuery = "UPDATE patient_database SET patient_password = '$pass' WHERE patient_verification_code = '$resetVerificationCode'";
                $updateResult = $conx->query($updateQuery);

                if ($updateResult) {
                    echo "<div class='text-center'>
                    <div class='alert alert-danger mt-5'>Successfully updated your password.</div>
                    </div>";
                    echo "<script>setTimeout(function(){window.location.href='login.php';}, 3000);</script>";
                    exit();
                } else {
                    $msg = "<div class='alert alert-danger'>Failed to update password. Please try again.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
                $error = 'style="border: 1px solid red; box-shadow: 0px 1px 11px 0px red;"';
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Invalid verification code.</div>";
    }
} else {
    header("Location: Forget.php");
    exit();
}
?>

  <div class="card" style="margin-top: 200px;">
   
  
    <div class="container">
      <div class="card-header p-3 mb-2 text-center" style="font-size: 32px;
      font-weight: 700;
      text-align: center;
      padding-top: 1px;
      padding-bottom: 25px;
      color: black;
      background-color: white;
      border-bottom: solid 1px gray;">
        Reset Password
      </div>
      <?php echo $msg ?>
      
        <div class="card-body">
          <form method="POST" >
            <div class="form-group">
              <input type="password" class="form-control" name="patient_password" placeholder="New Password" required />
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="Conf-Password" placeholder="Confirm Password" required />
            </div>
            <div class="text-center">
              <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
            </div>
          </form>
        </div>
      
    </div>
  

  </div>
  
