<?php

//appointment_action.php

include('../class/Appointment.php');

$object = new Appointment;

if (isset($_POST["action"])) {
	if ($_POST["action"] == 'fetch') {
		$output = array();

		if ($_SESSION['type'] == 'Admin') {
			$order_column = array('appointments.appointment_number', 'patient_database.patient_first_name', 'doctor_database.doctor_name', 'appointments.date', 'appointments.time', 'appointments.services', 'appointments.status');
			$main_query = "
			SELECT * FROM appointments  
			INNER JOIN doctor_database 
			ON doctor_database.doctor_id = appointments.doctor_id 
			INNER JOIN patient_database 
			ON patient_database.patient_id = appointments.patient_id 
			";

			$search_query = '';

			if ($_POST["is_date_search"] == "yes") {
				$search_query .= 'WHERE appointments.date BETWEEN "' . $_POST["start_date"] . '" AND "' . $_POST["end_date"] . '" AND (';
			} else {
				$search_query .= 'WHERE ';
			}

			if (isset($_POST["search"]["value"])) {
				$search_query .= 'appointments.appointment_number LIKE "%' . $_POST["search"]["value"] . '%" ';
				$search_query .= 'OR patient_database.patient_first_name LIKE "%' . $_POST["search"]["value"] . '%" ';
				$search_query .= 'OR patient_database.patient_last_name LIKE "%' . $_POST["search"]["value"] . '%" ';
				$search_query .= 'OR doctor_database.doctor_name LIKE "%' . $_POST["search"]["value"] . '%" ';
				$search_query .= 'OR appointments.date LIKE "%' . $_POST["search"]["value"] . '%" ';
				$search_query .= 'OR appointments.time LIKE "%' . $_POST["search"]["value"] . '%" ';
				$search_query .= 'OR appointments.services LIKE "%' . $_POST["search"]["value"] . '%" ';

				$search_query .= 'OR appointments.status LIKE "%' . $_POST["search"]["value"] . '%" ';
			}
			if ($_POST["is_date_search"] == "yes") {
				$search_query .= ') ';
			} else {
				$search_query .= '';
			}
		} else {
			$order_column = array('appointments.appointment_number', 'patient_database.patient_first_name', 'appointments.date', 'appointments.time', 'appointments.services', 'appointments.status');

			$main_query = "
			SELECT * FROM appointments 
			INNER JOIN doctor_database 
			ON doctor_database.doctor_id = appointments.doctor_id 
			INNER JOIN patient_database 
			ON patient_database.patient_id = appointments.patient_id 
			";

			$search_query = '
			WHERE appointments.doctor_id = "' . $_SESSION["admin_id"] . '" 
			';

			if ($_POST["is_date_search"] == "yes") {
				$search_query .= 'AND appointments.date BETWEEN "' . $_POST["start_date"] . '" AND "' . $_POST["end_date"] . '" ';
			} else {
				$search_query .= '';
			}

			if (isset($_POST["search"]["value"])) {
				$search_query .= 'AND (appointments.appointment_number LIKE "%' . $_POST["search"]["value"] . '%" ';
				$search_query .= 'OR patient_database.patient_first_name LIKE "%' . $_POST["search"]["value"] . '%" ';
				$search_query .= 'OR patient_database.patient_last_name LIKE "%' . $_POST["search"]["value"] . '%" ';
				$search_query .= 'OR appointments.date LIKE "%' . $_POST["search"]["value"] . '%" ';
				$search_query .= 'OR appointments.time LIKE "%' . $_POST["search"]["value"] . '%" ';
				$search_query .= 'OR appointments.services LIKE "%' . $_POST["search"]["value"] . '%" ';

				$search_query .= 'OR appointments.status LIKE "%' . $_POST["search"]["value"] . '%") ';
			}
		}

		if (isset($_POST["order"])) {
			$order_query = 'ORDER BY ' . $order_column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
		} else {
			$order_query = 'ORDER BY appointments.appointment_id DESC ';
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

			$sub_array[] = $row["appointment_number"];

            $sub_array[] = $row["patient_first_name"] . ' ' . $row["patient_last_name"].' ' . $row["patient_suffix"];

			if ($_SESSION['type'] == 'Admin') {
				$sub_array[] = $row["doctor_name"];
			}
			$sub_array[] = $row["date"];

			$sub_array[] = $row["time"];

			$services = $row["services"];
    if (!empty($row["additionalServices"])) {
        $services .= ' and ' . $row["additionalServices"];
    }
    $sub_array[] = $services;

			$status = '';

			if ($row["status"] == 'Booked') {
				$status = '<span class="badge badge-warning">' . $row["status"] . '</span>';
			}

			if ($row["status"] == 'In Process') {
				$status = '<span class="badge badge-primary">' . $row["status"] . '</span>';
			}

			if ($row["status"] == 'Completed') {
				$status = '<span class="badge badge-success">' . $row["status"] . '</span>';
			}

			if ($row["status"] == 'Cancelled') {
				$status = '<span class="badge badge-danger">' . $row["status"] . '</span>';
			}

			$sub_array[] = $status;

			$sub_array[] = '
			<div align="center">
			<button type="button" name="view_button" class="btn btn-info btn-circle btn-sm view_button" data-id="' . $row["appointment_id"] . '"><i class="fas fa-eye"></i></button>
			</div>
			';
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

	if ($_POST["action"] == 'fetch_single') {
		$object->query = "
		SELECT * FROM appointments 
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
					<td>' . $patient_row["patient_first_name"] . ' ' . $patient_row["patient_last_name"] . ' ' . $patient_row["patient_suffix"] .  '</td>
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
				<tr>
					<th width="40%" class="text-right">Appointment Date</th>
					<td>' . $doctor_schedule_row["doctor_schedule_date"] . '</td>
				</tr>
				<tr>
					<th width="40%" class="text-right">Appointment Day</th>
					<td>' . $doctor_schedule_row["doctor_schedule_day"] . '</td>
				</tr>
				
				';
			}

			$html .= '
				<tr>
					<th width="40%" class="text-right">Appointment Time</th>
					<td>' . $appointment_row["time"] . '</td>
				</tr>
				
			';

			if ($appointment_row["status"] != 'Cancel') {
				if ($_SESSION['type'] == 'Admin') {
					if ($appointment_row['patient_come_into_hospital'] == 'Yes') {
						if ($appointment_row["status"] == 'Completed') {
							$html .= '
								<tr>
									<th width="40%" class="text-right">Patient come into Hostpital</th>
									<td>Yes</td>
								</tr>
								<tr>
									<th width="40%" class="text-right">Doctor Comment</th>
									<td>' . $appointment_row["doctor_comment"] . '</td>
								</tr>
							';
						} else {
							$html .= '
								<tr>
									<th width="40%" class="text-right">Patient come into Hostpital</th>
									<td>
										<select name="patient_come_into_hospital" id="patient_come_into_hospital" class="form-control" required>
											<option value="">Select</option>
											<option value="Yes" selected>Yes</option>
										</select>
									</td>
								</tr
							';
						}
					} else {
						$html .= '
							<tr>
								<th width="40%" class="text-right">Patient come into Hostpital</th>
								<td>
									<select name="patient_come_into_hospital" id="patient_come_into_hospital" class="form-control" required>
										<option value="">Select</option>
										<option value="Yes">Yes</option>
									</select>
								</td>
							</tr
						';
					}
				}

				if ($_SESSION['type'] == 'Doctor') {
					if ($appointment_row["patient_come_into_hospital"] == 'Yes') {
						if ($appointment_row["status"] == 'Completed') {
							$html .= '
								<tr>
									<th width="40%" class="text-right">Doctor Comment</th>
									<td>
										<textarea name="doctor_comment" id="doctor_comment" class="form-control" rows="8" required>' . $appointment_row["doctor_comment"] . '</textarea>
									</td>
								</tr
							';
						} else {
							$html .= '
								<tr>
									<th width="40%" class="text-right">Doctor Comment</th>
									<td>
										<textarea name="doctor_comment" id="doctor_comment" class="form-control" rows="8" required></textarea>
									</td>
								</tr
							';
						}
					}
				}
			}

			$html .= '
			</table>
			';
		}

		echo $html;
	}

	if ($_POST['action'] == 'change_appointment_status') {
		if ($_SESSION['type'] == 'Admin') {
			$data = array(
				':status'							=>	'In Process',
				':patient_come_into_hospital'		=>	'Yes',
				':appointment_id'					=>	$_POST['hidden_appointment_id']
			);

			$object->query = "
			UPDATE appointments 
			SET status = :status, 
			patient_come_into_hospital = :patient_come_into_hospital 
			WHERE appointment_id = :appointment_id
			";

			$object->execute($data);

			echo '<div class="alert alert-success">Appointment Status change to In Process</div>';
		}

		if ($_SESSION['type'] == 'Doctor') {
			if (isset($_POST['doctor_comment'])) {
				$data = array(
					':status'							=>	'Completed',
					':doctor_comment'					=>	$_POST['doctor_comment'],
					':appointment_id'					=>	$_POST['hidden_appointment_id']
				);

				$object->query = "
				UPDATE appointments 
				SET status = :status, 
				doctor_comment = :doctor_comment 
				WHERE appointment_id = :appointment_id
				";

				$object->execute($data);

				echo '<div class="alert alert-success">Appointment Completed</div>';
			}
		}
	}


	if ($_POST["action"] == 'delete') {
		$object->query = "
		DELETE FROM doctor_schedule_table 
		WHERE doctor_schedule_id = '" . $_POST["id"] . "'
		";

		$object->execute();

		echo '<div class="alert alert-success">Doctor Schedule has been Deleted</div>';
	}
}
