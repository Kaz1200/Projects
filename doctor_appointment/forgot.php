<?php
include('class/Appointment.php');

$object = new Appointment;
include('header3.php');

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if (isset($_SESSION['patient_email_address'])) {
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


if (isset($_POST['submit'])) {
    $patient_email_address = mysqli_real_escape_string($conx, $_POST['patient_email_address']);
    $CodeReset = mysqli_real_escape_string($conx, md5(rand()));

    $query = "SELECT * FROM patient_database WHERE patient_email_address = '$patient_email_address'";
    $result = $conx->query($query);

    if ($result->num_rows > 0) {
        $query = "UPDATE patient_database SET patient_verification_code = '$CodeReset' WHERE patient_email_address = '$patient_email_address'";
        require 'class/class.phpmailer.php';
        require 'class/class.smtp.php';
        require 'class/Exception.php';
        require 'vendor/autoload.php';
        if ($conx->query($query)) {
            $mail = new PHPMailer(true);

            try {
                
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = 'smilecarehaven@gmail.com';
                $mail->Password = 'uuakvsuwhqntfggq';
                $mail->SMTPSecure = 'tls';
                $mail->CharSet = 'UTF-8';

                $mail->setFrom('smilecarehaven@gmail.com', 'Smile Haven');
                $mail->addAddress($patient_email_address);
                $mail->isHTML(true);
                $mail->Subject = 'Reset your password';

                $message_body = '<p> Click the link to change your password.k<b><a href="http://smilehavens.online/change-Password.php?Reset=' . $CodeReset . '">"http://smilehavens.online/change-Password.php?Reset=' . $CodeReset . '"</a></b></p>';

                $mail->Body = $message_body;

                if ($mail->send()) {
                    $msg = '<div class="alert alert-success">Please review your email. I emailed you a link to update your password.</div>';
                } else {
                    $msg = '<div class="alert alert-danger">' . $mail->ErrorInfo . '</div>';
                }
            } catch (Exception $e) {
                $msg = '<div class="alert alert-danger">Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</div>';
            }
        } else {
            $msg = '<div class="alert alert-danger">Failed to update verification code</div>';
        }
    } else {
        $msg = '<div class="alert alert-danger">This email "' . $patient_email_address . '" was not found</div>';
    }
    require 'vendor/autoload.php';
}
?>

<!--<!DOCTYPE html>-->
<!--<html lang="en">-->

<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <link rel="stylesheet" href="style.css">-->
<!--    <title>Sign in & Sign up Form</title>-->
<!--    <style>-->
<!--        body {-->
<!--            margin: 0;-->
<!--            padding: 0;-->
<!--            display: flex;-->
<!--            justify-content: center;-->
<!--            align-items: center;-->
<!--            min-height: 100vh;-->
<!--            background-image: url("images/loginbg.jpg");-->
<!--            background-size: cover;-->
<!--          }-->
<!--          .title {-->
<!--            text-align: center;-->
<!--          }-->
<!--        .alert {-->
<!--            display: flex;-->
<!--            justify-content: center;-->
<!--            align-items: center;-->
<!--            padding: 1rem;-->
<!--            border-radius: 5px;-->
<!--            color: white;-->
<!--            margin: 1rem 0;-->
<!--            font-weight: 500;-->
<!--            width: 100%;-->
<!--        }-->
<!--        .alert-container {-->
<!--            display: flex;-->
<!--            justify-content: center;-->
<!--        }-->

<!--        .container {-->
<!--            display: flex;-->
<!--            justify-content: center;-->
<!--            align-items: center;-->
<!--            min-height: 100vh;-->
<!--          }-->
      
<!--          .forms-container {-->
<!--            position: relative;-->
<!--            width: 100%;-->
<!--            max-width: 500px;-->
<!--            background-color: #fff;-->
<!--            border-radius: 10px;-->
<!--            padding: 40px;-->
<!--            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);-->
<!--          }-->
<!--          .input-field {-->
<!--            display: flex;-->
<!--            justify-content: center;-->
<!--            align-items: center;-->
<!--            padding: 20px;-->
<!--            position: relative;-->
<!--            margin-bottom: 20px;-->
<!--          }-->
<!--          .input-field input::placeholder {-->
<!--            text-align: center;-->
<!--        }-->
      
<!--          .input-field input {-->
<!--            width: 100%;-->
<!--            justify-content: center;-->
<!--            align-items: center;-->
<!--            border: none;-->
<!--            border-bottom: 1px solid #ccc;-->
<!--            outline: none;-->
<!--            transition: border-color 0.3s;-->
<!--          }-->
      
<!--          .input-field input:focus {-->
<!--            border-color: #6c63ff;-->
<!--          }-->
      
<!--          .input-field i {-->
<!--            position: absolute;-->
<!--            top: 80%;-->
<!--            left: 10px;-->
<!--            transform: translateY(-50%);-->
<!--            color: #888;-->
<!--          }-->
<!--          .btn {-->
<!--            display: inline-block;-->
<!--            padding: 10px 20px;-->
<!--            font-size: 16px;-->
<!--            font-weight: bold;-->
<!--            text-align: center;-->
<!--            text-decoration: none;-->
<!--            background-color: #1977cc;-->
<!--            color: #fff;-->
<!--            border: none;-->
<!--            border-radius: 5px;-->
<!--            cursor: pointer;-->
<!--            transition: background-color 0.3s;-->
<!--          }-->
      
<!--          .btn:hover {-->
<!--            background-color: #166ab5;-->
<!--          }-->
<!--          .social-text {-->
<!--            text-align: center;-->
<!--          }-->
      

<!--        .alert-success {-->
<!--            background-color: #42ba96;-->
<!--        }-->

<!--        .alert-danger {-->
<!--            background-color: #fc5555;-->
<!--        }-->

<!--        .alert-info {-->
<!--            background-color: #2E9AFE;-->
<!--        }-->

<!--        .alert-warning {-->
<!--            background-color: #ff9966;-->
<!--        }-->
<!--    </style>-->
<!--</head>-->

<!--<body>-->
<br>
<br>
<br>
<br>
<br>
<br>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-primary">
                        <h4 class="text-white">Forgot Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" class="sign-in-form">
                            <?php echo $msg ?>
                            <div class="form-group mt-3">
                                <input type="text" name="patient_email_address" class="form-control" placeholder="Input your email address" required>
                            </div>
                            <div class="text-center">
                                <input type="submit" name="submit" class="btn btn-primary mt-2" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="app.js"></script>
</body>

</html>