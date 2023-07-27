<?php

//verify.php

include('header.php');

include('class/Appointment.php');

$object = new Appointment;

if(isset($_GET["code"]))
{
	$object->query = "
	UPDATE patient_database 
	SET email_verify = 'Yes' 
	WHERE patient_verification_code = '".$_GET["code"]."'
	";

	$object->execute();

	$_SESSION['success_message'] = '<div class="alert alert-success">You Email has been verify, now you can login into system</div>';
	echo"Congratulations, you have successfully verified your email address. You can now login your account.";
	echo "<script>setTimeout(function(){window.location.href='login.php';}, 2500);</script>";
}

include('footer.php');

?>