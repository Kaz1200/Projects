<?php

//doctor_schedule_action.php

include('../class/Appointment.php');

$object = new Appointment;

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
		$output = array();

		if($_SESSION['type'] == 'Assistant')
		{
			$order_column = array('doctor_database.doctor_name', 'doctor_schedule_table.doctor_schedule_date', 'doctor_schedule_table.doctor_schedule_day', 'doctor_schedule_table.doctor_schedule_start_time', 'doctor_schedule_table.doctor_schedule_end_time');
			$main_query = "
			SELECT * FROM doctor_schedule_table 
			INNER JOIN doctor_database 
			ON doctor_database.doctor_id = doctor_schedule_table.doctor_id 
			";

			$search_query = '';

			if(isset($_POST["search"]["value"]))
			{
				$search_query .= 'WHERE doctor_database.doctor_name LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR doctor_schedule_table.doctor_schedule_date LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR doctor_schedule_table.doctor_schedule_day LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR doctor_schedule_table.doctor_schedule_start_time LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR doctor_schedule_table.doctor_schedule_end_time LIKE "%'.$_POST["search"]["value"].'%" ';
				
			}
		}
		else
		{
			$order_column = array('doctor_schedule_date', 'doctor_schedule_day', 'doctor_schedule_start_time', 'doctor_schedule_end_time');
			$main_query = "
			SELECT * FROM doctor_schedule_table 
			";

			$search_query = '
			WHERE doctor_id = "'.$_SESSION["assistant_id"].'" AND 
			';

			if(isset($_POST["search"]["value"]))
			{
				$search_query .= '(doctor_schedule_date LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR doctor_schedule_day LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR doctor_schedule_start_time LIKE "%'.$_POST["search"]["value"].'%" ';
				$search_query .= 'OR doctor_schedule_end_time LIKE "%'.$_POST["search"]["value"].'%" ';
				
			}
		}

		if(isset($_POST["order"]))
		{
			$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$order_query = 'ORDER BY doctor_schedule_table.doctor_schedule_id DESC ';
		}

		$limit_query = '';

		if($_POST["length"] != -1)
		{
			$limit_query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$object->query = $main_query . $search_query . $order_query;

		$object->execute();

		$filtered_rows = $object->row_count();

		$object->query .= $limit_query;

		$result = $object->get_result();

		$object->query = $main_query;

		$object->execute();

		$total_rows = $object->row_count();

		$data = array();

		foreach($result as $row)
		{
			$sub_array = array();
			if($_SESSION['type'] == 'Assistant')
			{
				$sub_array[] = html_entity_decode($row["doctor_name"]);
			}
			$sub_array[] = $row["doctor_schedule_date"];

			$sub_array[] = $row["doctor_schedule_day"];

			$sub_array[] = $row["doctor_schedule_start_time"];

			$sub_array[] = $row["doctor_schedule_end_time"];

			

			$status = '';
			if($row["doctor_schedule_status"] == 'Active')
			{
				$status = '<button type="button" name="status_button" class="btn btn-primary btn-sm status_button" data-id="'.$row["doctor_schedule_id"].'" data-status="'.$row["doctor_schedule_status"].'">Active</button>';
			}
			else
			{
				$status = '<button type="button" name="status_button" class="btn btn-danger btn-sm status_button" data-id="'.$row["doctor_schedule_id"].'" data-status="'.$row["doctor_schedule_status"].'">Inactive</button>';
			}

			$sub_array[] = $status;

			$sub_array[] = '
			<div align="center">
			<button type="button" name="edit_button" class="btn btn-warning btn-circle btn-sm edit_button" data-id="'.$row["doctor_schedule_id"].'"><i class="fas fa-edit"></i></button>
			&nbsp;
			<button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="'.$row["doctor_schedule_id"].'"><i class="fas fa-times"></i></button>
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

	if($_POST["action"] == 'Add')
	{
		$error = '';

		$success = '';

		$doctor_id = '';

		if($_SESSION['type'] == 'Assistant')
		{
			$doctor_id = $_POST["doctor_id"];
		}

		if($_SESSION['type'] == 'Doctor')
		{
			$doctor_id = $_SESSION['assistant_id'];
		}

		$data = array(
			':doctor_id'					=>	$doctor_id,
			':doctor_schedule_date'			=>	$_POST["doctor_schedule_date"],
			':doctor_schedule_day'			=>	date('l', strtotime($_POST["doctor_schedule_date"])),
			':doctor_schedule_start_time'	=>	$_POST["doctor_schedule_start_time"],
			':doctor_schedule_end_time'		=>	$_POST["doctor_schedule_end_time"]
			
		);

		$object->query = "
		INSERT INTO doctor_schedule_table (doctor_id, doctor_schedule_date, doctor_schedule_day, doctor_schedule_start_time, doctor_schedule_end_time, doctor_schedule_status) 
VALUES (:doctor_id, :doctor_schedule_date, :doctor_schedule_day, :doctor_schedule_start_time, :doctor_schedule_end_time, 'Inactive')
		";

		$object->execute($data);

		$success = '<div class="alert alert-success">Doctor Schedule Added Successfully</div>';

		$output = array(
			'error'		=>	$error,
			'success'	=>	$success
		);

		echo json_encode($output);

	}

	if($_POST["action"] == 'fetch_single')
	{
		$object->query = "
		SELECT * FROM doctor_schedule_table 
		WHERE doctor_schedule_id = '".$_POST["doctor_schedule_id"]."'
		";

		$result = $object->get_result();

		$data = array();

		foreach($result as $row)
		{
			$data['doctor_id'] = $row['doctor_id'];
			$data['doctor_schedule_date'] = $row['doctor_schedule_date'];
			$data['doctor_schedule_start_time'] = $row['doctor_schedule_start_time'];
			$data['doctor_schedule_end_time'] = $row['doctor_schedule_end_time'];
		
		}

		echo json_encode($data);
	}

	if($_POST["action"] == 'Edit')
	{
		$error = '';

		$success = '';

		$doctor_id = '';

		if($_SESSION['type'] == 'Assistant')
		{
			$doctor_id = $_POST["doctor_id"];
		}

		if($_SESSION['type'] == 'Doctor')
		{
			$doctor_id = $_SESSION['assistant_id'];
		}

		$data = array(
			':doctor_id'					=>	$doctor_id,
			':doctor_schedule_date'			=>	$_POST["doctor_schedule_date"],
			':doctor_schedule_start_time'	=>	$_POST["doctor_schedule_start_time"],
			':doctor_schedule_end_time'		=>	$_POST["doctor_schedule_end_time"]
		
		);

		$object->query = "
		UPDATE doctor_schedule_table 
		SET doctor_id = :doctor_id, 
		doctor_schedule_date = :doctor_schedule_date, 
		doctor_schedule_start_time = :doctor_schedule_start_time, 
		doctor_schedule_end_time = :doctor_schedule_end_time
		WHERE doctor_schedule_id = '".$_POST['hidden_id']."'
		";

		$object->execute($data);

		$success = '<div class="alert alert-success">Doctor Schedule Data Updated Successfully Updated</div>';

		$output = array(
			'error'		=>	$error,
			'success'	=>	$success
		);

		echo json_encode($output);

	}

	if($_POST["action"] == 'change_status')
	{
		$data = array(
			':doctor_schedule_status'		=>	$_POST['next_status']
		);

		$object->query = "
		UPDATE doctor_schedule_table 
		SET doctor_schedule_status = :doctor_schedule_status 
		WHERE doctor_schedule_id = '".$_POST["id"]."'
		";

		$object->execute($data);

		echo '<div class="alert alert-success">Doctor Schedule Status change to '.$_POST['next_status'].'</div>';
	}

	if($_POST["action"] == 'delete')
	{
		$object->query = "
		DELETE FROM doctor_schedule_table 
		WHERE doctor_schedule_id = '".$_POST["id"]."'
		";

		$object->execute();

		echo '<div class="alert alert-success">Doctor Schedule has been Deleted</div>';
	}
}

?>