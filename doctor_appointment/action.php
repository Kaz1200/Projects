<?php

//action.php

include('class/Appointment.php');

$object = new Appointment;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST["action"])) {
	if ($_POST["action"] == 'check_login') {
		if (isset($_SESSION['patient_id'])) {
			echo 'index.php';
		} else {
			echo 'login.php';
		}
	}

	if($_POST['action'] == 'patient_register')
	{
		$error = '';

		$success = '';

		$data = array(
			':patient_email_address'	=>	$_POST["patient_email_address"]
		);

		$object->query = "
		SELECT * FROM patient_database 
		WHERE patient_email_address = :patient_email_address
		";

		$object->execute($data);

		if($object->row_count() > 0)
		{
			$error = '<div class="alert alert-danger">Email Address Already Exists</div>';
		}
		else
		{
			$patient_verification_code = md5(uniqid());
			$data = array(
				':patient_email_address'		=>	$object->clean_input($_POST["patient_email_address"]),
				':patient_password'				=>	$_POST["patient_password"],
				':patient_first_name'			=>	$object->clean_input($_POST["patient_first_name"]),
				':patient_last_name'			=>	$object->clean_input($_POST["patient_last_name"]),
				':patient_suffix'				=>	$object->clean_input($_POST["patient_suffix"]),
				':patient_date_of_birth'		=>	$object->clean_input($_POST["patient_date_of_birth"]),
				':patient_gender'				=>	$object->clean_input($_POST["patient_gender"]),
				':patient_address'				=>	$object->clean_input($_POST["patient_address"]),
				':patient_phone_no'				=>	$object->clean_input($_POST["patient_phone_no"]),
				':patient_maritial_status'		=>	$object->clean_input($_POST["patient_maritial_status"]),
				':patient_added_on'				=>	$object->now,
				':patient_verification_code'	=>	$patient_verification_code,
				':email_verify'					=>	'No'
			);

			$object->query = "
			INSERT INTO patient_database 
			(patient_email_address, patient_password, patient_first_name, patient_last_name,patient_suffix, patient_date_of_birth, patient_gender, patient_address, patient_phone_no, patient_maritial_status, patient_added_on, patient_verification_code, email_verify) 
			VALUES (:patient_email_address, :patient_password, :patient_first_name, :patient_last_name,:patient_suffix, :patient_date_of_birth, :patient_gender, :patient_address, :patient_phone_no, :patient_maritial_status, :patient_added_on, :patient_verification_code, :email_verify)
			";

			$object->execute($data);
			require 'class/class.smtp.php';
			require 'class/class.phpmailer.php';
			$mail = new PHPMailer;
			$mail->IsSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = '587';
			$mail->SMTPAuth = true;
			$mail->Username = 'smilecarehaven@gmail.com';
			$mail->Password = 'uuakvsuwhqntfggq';
			$mail->SMTPSecure = 'tls';
			$mail->From = 'smilecarehaven@gmail.com';
			$mail->FromName = 'Smile Haven';
			$mail->AddAddress($_POST["patient_email_address"]);
			$mail->WordWrap = 50;
			$mail->IsHTML(true);
			$mail->Subject = 'Verification code to Verify Your Email Address';

			$message_body = '
			<p>For verify your email address, Please click on this <a href="'.$object->base_url.'verify.php?code='.$patient_verification_code.'"><b>link</b></a>.</p>
			<p>Sincerely,</p>
			<p>Smile Haven</p>
			';
			$mail->Body = $message_body;

			if($mail->Send())
			{
				$success = '<div class="alert alert-success">Please check your email inbox for the email verification or your spam mail folder.</div>';
			}
			else
			{
				$error = '<div class="alert alert-danger">' . $mail->ErrorInfo . '</div>';
			}
		}

		$output = array(
			'error'		=>	$error,
			'success'	=>	$success
		);
		echo json_encode($output);
	}

if ($_POST['action'] == 'patient_login') {
		$error = '';
	
		$data = array(
			':patient_email_address' => $_POST["patient_email_address"]
		);
	
		$object->query = "
		SELECT * FROM patient_database 
		WHERE patient_email_address = :patient_email_address
		";
	
		$object->execute($data);
	
		if ($object->row_count() > 0) {
			$result = $object->statement_result();
	
			foreach ($result as $row) {
				if ($row["email_verify"] == "Yes") { // Check if email_verify is "Yes"
					if ($row["patient_password"] == $_POST["patient_password"]) {
						$_SESSION['patient_id'] = $row['patient_id'];
						$_SESSION['patient_name'] = $row['patient_first_name'] . ' ' . $row['patient_last_name'];
					} else {
						$error = '<div class="alert alert-danger">Wrong Password</div>';
					}
				} else {
					$error = '<div class="alert alert-danger">Email is not verified check your email and click the link to verify your email.</div>';
				}
			}
		} else {
			$error = '<div class="alert alert-danger">Wrong Email Address</div>';
		}
	
		$output = array(
			'error' => $error
		);
	
		echo json_encode($output);
	}


	if ($_POST['action'] == 'fetch_schedule') {
		$output = array();

		$order_column = array('doctor_database.doctor_name', 'doctor_database.doctor_degree', 'doctor_database.doctor_expert_in', 'doctor_schedule_table.doctor_schedule_date', 'doctor_schedule_table.doctor_schedule_day', 'doctor_schedule_table.doctor_schedule_start_time');

		$main_query = "
		SELECT * FROM doctor_schedule_table 
		INNER JOIN doctor_database 
		ON doctor_database.doctor_id = doctor_schedule_table.doctor_id 
		";

		$search_query = '
		WHERE doctor_schedule_table.doctor_schedule_date >= "' . date('Y-m-d') . '" 
		AND doctor_schedule_table.doctor_schedule_status = "Active" 
		AND doctor_database.doctor_status = "Inactive" 
		';

		// Combine all queries
		$search_query .= ' ORDER BY ' . $order_column[$_POST['order'][0]['column']] . ' ' . $_POST['order'][0]['dir'] . ' ';
		if ($_POST['length'] != -1) {
			$search_query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$query = $main_query . $search_query;

		// Fetch data from the database
		$result = mysqli_query($con, $query);
		$data = array();

		while ($row = mysqli_fetch_array($result)) {
			$sub_array = array();
			$sub_array[] = $row['doctor_name'];
			$sub_array[] = $row['doctor_degree'];
			$sub_array[] = $row['doctor_expert_in'];
			$sub_array[] = $row['doctor_schedule_date'];
			$sub_array[] = $row['doctor_schedule_day'];
			$sub_array[] = $row['doctor_schedule_start_time'];
			$data[] = $sub_array;
		}

		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"		=> 	$totalData,
			"recordsFiltered"	=>	$totalFiltered,
			"data"				=>	$data
		);

		echo json_encode($output);
	}






	if ($_POST['action'] == 'edit_profile') {
		$data = array(
			':patient_password'			=>	$_POST["patient_password"],
			':patient_first_name'		=>	$_POST["patient_first_name"],
			':patient_last_name'		=>	$_POST["patient_last_name"],
			':patient_suffix'		=>	$_POST["patient_suffix"],
			':patient_date_of_birth'	=>	$_POST["patient_date_of_birth"],
			':patient_gender'			=>	$_POST["patient_gender"],
			':patient_address'			=>	$_POST["patient_address"],
			':patient_phone_no'			=>	$_POST["patient_phone_no"],
			':patient_maritial_status'	=>	$_POST["patient_maritial_status"]
		);

		$object->query = "
		UPDATE patient_database  
		SET patient_password = :patient_password, 
		patient_first_name = :patient_first_name, 
		patient_last_name = :patient_last_name,
		patient_suffix = :patient_suffix,
		patient_date_of_birth = :patient_date_of_birth, 
		patient_gender = :patient_gender, 
		patient_address = :patient_address, 
		patient_phone_no = :patient_phone_no, 
		patient_maritial_status = :patient_maritial_status 
		WHERE patient_id = '" . $_SESSION['patient_id'] . "'
		";

		$object->execute($data);

		$_SESSION['success_message'] = '<div class="alert alert-success">Profile Data Updated</div>';

		echo 'done';
	}

	if ($_POST['action'] == 'make_appointment') {
		$object->query = "
		SELECT * FROM patient_database 
		WHERE patient_id = '" . $_SESSION["patient_id"] . "'
		";

		$patient_data = $object->get_result();

		$object->query = "
		SELECT * FROM appointments
		INNER JOIN doctor_database 
		ON doctor_database.doctor_id = appointments.doctor_id 
		";

		$doctor_schedule_data = $object->get_result();

		$html = '
		<h4 class="text-center">Appointment Details</h4>
		<hr />
		<table class="table">
		';

		$html .= '
		</table>';
		echo $html;
	}

	if ($_POST['action'] == 'book_appointment') {
		$error = '';
		$data = array(
			':patient_id'           =>  $_SESSION['patient_id'],
			':date'                 =>  $_POST['date'],
			':time'                 =>  $_POST['time'],
			':services'             =>  $_POST['services']
		);

		// check if appointment already exists for this day with any doctor
		$object->query = "
		SELECT * FROM appointment_database 
		WHERE patient_id = :patient_id
		AND date = :date
		AND status IN ('Booked')
		";
		$object->execute(array(':patient_id' => $_SESSION['patient_id'], ':date' => $_POST['date'],));

		if ($object->row_count() > 0) {
			$error = '<div class="alert alert-danger">You have already booked an appointment for this day.</div>';
		} else {
			// check if appointment already exists for this day with the selected doctor
			$object->query = "
				SELECT * FROM appointment_database 
				WHERE doctor_id = :doctor_id 
				AND date = :date
				AND time = :time
				AND status IN ('Booked')
			";
			$object->execute(array(':doctor_id'   =>  $_POST['hidden_doctor_id'], ':date' => $_POST['date'], ':time' => $_POST['time']));

			if ($object->row_count() > 0) {
				$error = '<div class="alert alert-danger">This is already booked. Book another date or time.</div>';
			} else {
				// check if appointment was previously cancelled
				$object->query = "
					SELECT * FROM appointment_database 
					WHERE doctor_id = :doctor_id 
					AND patient_id = :patient_id
					AND date = :date
					AND time = :time
					AND status = :status
				";
				$object->execute(array(':doctor_id'   =>  $_POST['hidden_doctor_id'], ':patient_id' => $_SESSION['patient_id'], ':date' => $_POST['date'], ':time' =>  $_POST['time'], ':status' => 'Cancel'));

				if ($object->row_count() > 0) {
					// allow user to book the previously cancelled appointment
					$status = 'Booked';
				} else {
					// otherwise, set the appointment status to 'Waiting'
					$status = 'Booked';
				}

				$appointment_number = $object->Generate_appointment_no();

				$data = array(
					':doctor_id'                =>  $_POST['hidden_doctor_id'],
					':patient_id'               =>  $_SESSION['patient_id'],

					':appointment_number'       =>  $appointment_number,
					':date'                     =>  $_POST['date'],
					':time'                     =>  $_POST['time'],
					':services'                 =>  $_POST['services'],
					':status'                   =>  $status
				);

				$object->query = "
				INSERT INTO appointment_database 
				(doctor_id, patient_id, appointment_number, date, services, time, status) 
				VALUES (:doctor_id, :patient_id,  :appointment_number, :date, :services,  :time, :status)
				";

				$object->execute($data);
				$_SESSION['appointment_message'] = '<div class="alert alert-success">Your Appointment has been <b' . $status . '</b> with Appointment No. <b>' . $appointment_number . '</b></div>';
			}
		}

		// Display alert message if there is an error
		if (!empty($error)) {
			echo json_encode(['error' => $error]);
		} else {
			echo json_encode(['success' => 'Appointment booked successfully.']);
		}
	}
}





if ($_POST['action'] == 'fetch_appointment') {
	$output = array();

	$order_column = array('appointment_database.appointment_number', 'doctor_database.doctor_name', 'appointment_database.date', 'appointment_database.time',  'appointment_database.services', 'appointment_database.status');

	$main_query = "
		SELECT * FROM appointment_database  
		INNER JOIN doctor_database 
		ON doctor_database.doctor_id = appointment_database.doctor_id 
	
		";

	$search_query = '
		WHERE appointment_database.patient_id = "' . $_SESSION["patient_id"] . '" 
		';

	if (isset($_POST["search"]["value"])) {
		$search_query .= 'AND ( appointment_database.appointment_number LIKE "%' . $_POST["search"]["value"] . '%" ';
		$search_query .= 'OR doctor_database.doctor_name LIKE "%' . $_POST["search"]["value"] . '%" ';
		$search_query .= 'OR appointment_database.date LIKE "%' . $_POST["search"]["value"] . '%" ';
		$search_query .= 'OR appointment_database.time LIKE "%' . $_POST["search"]["value"] . '%" ';
		// $search_query .= 'OR doctor_schedule_table.doctor_schedule_day LIKE "%' . $_POST["search"]["value"] . '%" ';
		$search_query .= 'OR appointment_database.services LIKE "%' . $_POST["search"]["value"] . '%" ';
		$search_query .= 'OR appointment_database.status LIKE "%' . $_POST["search"]["value"] . '%") ';
	}

	if (isset($_POST["order"])) {
		$order_query = 'ORDER BY ' . $order_column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
	} else {
		$order_query = 'ORDER BY appointment_database.appointment_id ASC ';
	}

	$limit_query = '';

	if ($_POST["length"] != -1) {
		$limit_query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}

	$object->query = $main_query . $search_query . $order_query;

	$object->execute();

	$filtered_rows = $object->row_count();

	$object->query .= $limit_query;

	$result = $object->get_result();

	$object->query = $main_query . $search_query;

	$object->execute();

	$total_rows = $object->row_count();

	$data = array();

	foreach ($result as $row) {
		$sub_array = array();

		$sub_array[] = '<td class="bg-light">' . $row["appointment_number"] . '</td>';

		$sub_array[] = '<td class="bg-light">' . $row["doctor_name"] . '</td>';

		$sub_array[] = '<td class="bg-light">' . $row["date"] . '</td>';

		$sub_array[] = '<td class="bg-light">' . $row["time"] . '</td>';

		// $sub_array[] = $row["doctor_schedule_day"];

		$sub_array[] = '<td class="bg-light">' . $row["services"] . '</td>';

		$status = '';

		if ($row["status"] == 'Booked') {
			$status = '<span class="badge bg-info">' . $row["status"] . '</span>';
		}

		if ($row["status"] == 'In Process') {
			$status = '<span class="badge bg-primary">' . $row["status"] . '</span>';
		}

		if ($row["status"] == 'Completed') {
			$status = '<span class="badge bg-success">' . $row["status"] . '</span>';
		}

		if ($row["status"] == 'Cancel') {
			$status = '<span class="badge bg-danger">' . $row["status"] . '</span>';
		}

		$sub_array[] = $status;

		$sub_array[] = '
			<div class="text-center">
				<button type="button" name="view_button" class="btn btn-info btn-circle btn-sm view_button" data-id="' . $row["appointment_id"] . '"><i class="fas fa-eye"></i></button>
			</div>
			';
		$sub_array[] = '<button type="button" name="cancel_appointment" class="btn btn-danger btn-sm cancel_appointment" data-id="' . $row["appointment_id"] . '"><i class="fas fa-times"></i></button>';

		$data[] = $sub_array;
	}

	$output = array(
		"draw"    			=> 	intval($_POST["draw"]),
		"recordsTotal"  	=>  $total_rows,
		"recordsFiltered" 	=> 	$filtered_rows,
		"data"    			=> 	$data
	);

	echo json_encode($output);
}


if ($_POST['action'] == 'cancel_appointment') {
	$data = array(
		':status'			=>	'Cancel',
		':appointment_id'	=>	$_POST['appointment_id']
	);
	$object->query = "
		UPDATE appointment_database 
		SET status = :status 
		WHERE appointment_id = :appointment_id
		";
	$object->execute($data);
	echo '<div class="alert alert-success">Your Appointment has been Cancel</div>';
}


if ($_POST["action"] == 'fetch_single') {
	$object->query = "
	SELECT * FROM appointment_database 
	WHERE appointment_id = '" . $_POST["appointment_id"] . "'
	";

	$appointment_data = $object->get_result();

	foreach ($appointment_data as $appointment_row) {

		$object->query = "
		SELECT * FROM patient_database 
		WHERE patient_id = '" . $appointment_row["patient_id"] . "'
		";

		$patient_data = $object->get_result();

		$object->query = "
		SELECT * FROM doctor_schedule_table 
		INNER JOIN doctor_database 
		ON doctor_database.doctor_id = doctor_schedule_table.doctor_id 
		WHERE doctor_schedule_table.doctor_schedule_id = '" . $appointment_row["doctor_schedule_id"] . "'
		";

		$doctor_schedule_data = $object->get_result();

		$html = '
		<h4 class="text-center">Patient Details</h4>
		<table class="table">
		';

		foreach ($patient_data as $patient_row) {
			$html .= '
			<tr>
				<th width="40%" class="text-right">Patient Name</th>
				<td>' . $patient_row["patient_first_name"] . ' ' . $patient_row["patient_last_name"] . '</td>
			</tr>
			<tr>
				<th width="40%" class="text-right">Contact No.</th>
				<td>' . $patient_row["patient_phone_no"] . '</td>
			</tr>
			<tr>
				<th width="40%" class="text-right">Address</th>
				<td>' . $patient_row["patient_address"] . '</td>
			</tr>
			';
		}

		$html .= '
		</table>
		<hr />
		<h4 class="text-center">Appointment Details</h4>
		<table class="table">
			<tr>
				<th width="40%" class="text-right">Appointment No.</th>
				<td>' . $appointment_row["appointment_number"] . '</td>
			</tr>
		';
		foreach ($doctor_schedule_data as $doctor_schedule_row) {
			$html .= '
			<tr>
				<th width="40%" class="text-right">Doctor Name</th>
				<td>' . $doctor_schedule_row["doctor_name"] . '</td>
			</tr>
			
			';
		}

		$html .= '
			<tr>
				<th width="40%" class="text-right">Appointment Date</th>
				<td>' . $appointment_row["date"] . '</td>
			</tr>
			<tr>
				<th width="40%" class="text-right">Appointment Time</th>
				<td>' . $appointment_row["time"] . '</td>
			</tr>
			<tr>
				<th width="40%" class="text-right">Appointment Service</th>
				<td>' . $appointment_row["services"] . '</td>
			</tr>
			
		';

		$html .= '
		</table>
		';
	}

	echo $html;
}
