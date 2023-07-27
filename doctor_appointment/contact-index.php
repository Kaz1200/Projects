<?php
// database connection code
if(isset($_POST['txtName']))
{
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
$con = mysqli_connect("localhost", "u556402485_doctor_appoint", "BW76X^sB{%7TrqzG", "u556402485_doctor_appoint");

// get the post records

$txtName = $_POST['txtName'];
$txtEmail = $_POST['txtEmail'];
$txtPhone = $_POST['txtSubject'];
$txtMessage = $_POST['txtMessage'];

// database insert SQL code
$sql = "INSERT INTO `contact` (`User_id`, `Name`, `Email`, `Subject`, `Message`) VALUES ('0', '$txtName', '$txtEmail', '$txtPhone', '$txtMessage')";

// insert in database 
$rs = mysqli_query($con, $sql);
if($rs)
{
	echo "Contact Records Inserted";
	header('Location: index.php');
}
}
else
{
	echo "Are you a genuine visitor?";
	
}
?>