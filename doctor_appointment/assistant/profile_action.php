<?php

include('../class/Appointment.php');

$object = new Appointment;

if($_POST["action"] == 'assistant_profile')
{
	sleep(2);

	$error = '';

	$success = '';

	$assistant_profile_image = '';

	$data = array(
		':assistant_email_address'	=>	$_POST["assistant_email_address"],
		':assistant_id'			=>	$_POST['hidden_id']
	);

	$object->query = "
	SELECT * FROM assistant_database 
	WHERE assistant_email_address = :assistant_email_address 
	AND assistant_id != :assistant_id
	";

	$object->execute($data);

	if($object->row_count() > 0)
	{
		$error = '<div class="alert alert-danger">Email Address Already Exists</div>';
	}
	else
	{
		$assistant_profile_image = $_POST["hidden_assistant_profile_image"];

		if($_FILES['assistant_profile_image']['name'] != '')
		{
			$allowed_file_format = array("jpg", "png");

	    	$file_extension = pathinfo($_FILES["assistant_profile_image"]["name"], PATHINFO_EXTENSION);

	    	if(!in_array($file_extension, $allowed_file_format))
		    {
		        $error = "<div class='alert alert-danger'>Upload valid file. jpg, png</div>";
		    }
		    else if (($_FILES["assistant_profile_image"]["size"] > 2000000))
		    {
		       $error = "<div class='alert alert-danger'>File size exceeds 2MB</div>";
		    }
		    else
		    {
		    	$new_name = rand() . '.' . $file_extension;

				$destination = '../images/' . $new_name;

				move_uploaded_file($_FILES['assistant_profile_image']['tmp_name'], $destination);

				$assistant_profile_image = $destination;
		    }
		}

		if($error == '')
		{
			$data = array(
				':assistant_email_address'			=>	$object->clean_input($_POST["assistant_email_address"]),
				':assistant_password'				=>	$_POST["assistant_password"],
				':assistant_name'					=>	$object->clean_input($_POST["assistant_name"]),
				':assistant_profile_image'			=>	$assistant_profile_image,
				':assistant_phone_no'				=>	$object->clean_input($_POST["assistant_phone_no"]),
				':assistant_address'				=>	$object->clean_input($_POST["assistant_address"]),
				':assistant_date_of_birth'			=>	$object->clean_input($_POST["assistant_date_of_birth"])
			);

			$object->query = "
			UPDATE assistant_database  
			SET assistant_email_address = :assistant_email_address, 
			assistant_password = :assistant_password, 
			assistant_name = :assistant_name, 
			assistant_profile_image = :assistant_profile_image, 
			assistant_phone_no = :assistant_phone_no, 
			assistant_address = :assistant_address, 
			assistant_date_of_birth = :assistant_date_of_birth 
			WHERE assistant_id = '".$_POST['hidden_id']."'
			";
			$object->execute($data);

			$success = '<div class="alert alert-success">Assistant Data Updated</div>';
		}			
	}

	$output = array(
		'error'					=>	$error,
		'success'				=>	$success,
		'assistant_email_address'	=>	$_POST["assistant_email_address"],
		'assistant_password'		=>	$_POST["assistant_password"],
		'assistant_name'			=>	$_POST["assistant_name"],
		'assistant_profile_image'	=>	$assistant_profile_image,
		'assistant_phone_no'		=>	$_POST["assistant_phone_no"],
		'assistant_address'			=>	$_POST["assistant_address"],
		'assistant_date_of_birth'	=>	$_POST["assistant_date_of_birth"],

	);

	echo json_encode($output);
}



?>