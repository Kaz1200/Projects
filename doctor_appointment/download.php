<?php

//download.php

include('class/Appointment.php');

$object = new Appointment;

require_once('class/pdf.php');

if (isset($_GET["id"])) {
	$html = '<table border="0" cellpadding="5" cellspacing="5" width="100%">';

	$object->query = "
	SELECT hospital_name, hospital_address, hospital_contact_no, hospital_logo 
	FROM admin_database
	";

	$hospital_data = $object->get_result();

	foreach ($hospital_data as $hospital_row) {
		$html .= '<tr><td align="center" style="border: 1px solid #ccc; padding: 10px; border-bottom: 0px; background-color: #E9E9E9">';
		if ($hospital_row['hospital_logo'] != '') {
			$html .= '<img src="' . substr($hospital_row['hospital_logo'], 3) . '" /><br />';
		}
		$html .= '<h2 align="center" style="font-size: 62px; color: #004CA5">' . $hospital_row['hospital_name'] . '</h2>
		<p align="center">' . $hospital_row['hospital_address'] . '</p>
		<p align="center" style="font-size: 24px"><b style="color: #004CA5">Contact No.: </b>' . $hospital_row['hospital_contact_no'] . '</p></td></tr>
		';
	}

	$html .= '
	<tr><td style="border: 1px solid #ccc; padding: 10px; border-bottom: 0px; background-color: #E9E9E9">
	';

	$object->query = "
	SELECT * FROM appointment_database 
	WHERE appointment_id = '" . $_GET["id"] . "'
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

		$html .= '
		<h4 align="center" style="font-size: 42px; color: #004CA5">Patient Details</h4>
		<table border="0" cellpadding="5" cellspacing="5" width="100%" >';

		foreach ($patient_data as $patient_row) {
			$html .= '<tr><th width="50%" align="right" style="font-size: 24px; color: #004CA5">Patient Name: </th><td style="font-size: 24px;">' . $patient_row["patient_first_name"] . ' ' . $patient_row["patient_last_name"] . '</td></tr>
			<tr><th width="50%" align="right" style="font-size: 24px; color: #004CA5">Contact No.: </th><td style="font-size: 24px;">' . $patient_row["patient_phone_no"] . '</td></tr>
			<tr><th width="50%" align="right" style="font-size: 24px; color: #004CA5">Address: </th><td style="font-size: 24px;">' . $patient_row["patient_address"] . '</td></tr>';
		}

		$html .= '</table><br /><hr />
		<h4 align="center" style="font-size: 42px; color: #004CA5">Appointment Details</h4>
		<table border="0" cellpadding="5" cellspacing="5" width="100%" style="margin-bottom: 200px">
			<tr>
				<th width="50%" align="right" style="font-size: 24px; color: #004CA5">Appointment No.: </th>
				<td style="font-size: 24px;">' . $appointment_row["appointment_number"] . '</td>
			</tr>
		';
		foreach ($doctor_schedule_data as $doctor_schedule_row) {
			$html .= '
			<tr>
				<th width="50%" align="right" style="font-size: 24px; color: #004CA5">Doctor Name: </th>
				<td style="font-size: 24px;">' . $doctor_schedule_row["doctor_name"] . '</td>
			</tr>
			<tr>
				<th width="50%" align="right" style="font-size: 24px; color: #004CA5">Appointment Date: </th>
				<td style="font-size: 24px;">' . $doctor_schedule_row["doctor_schedule_date"] . '</td>
			</tr>
			<tr>
				<th width="50%" align="right" style="font-size: 24px; color: #004CA5">Appointment Day: </th>
				<td style="font-size: 24px;">' . $doctor_schedule_row["doctor_schedule_day"] . '</td>
			</tr>
				
			';
		}

		$html .= '
			<tr>
				<th width="50%" align="right" style="font-size: 24px; color: #004CA5">Appointment Time: </th>
				<td style="font-size: 24px;">' . $appointment_row["appointment_time"] . '</td>
			</tr>
			<tr>
				<th width="50%" align="right" style="font-size: 24px; color: #004CA5">Service: </th>
				<td style="font-size: 24px;">' . $appointment_row["services"] . '</td>
			</tr>
			<tr>
				<th width="50%" align="right" style="font-size: 24px; color: #004CA5">Patient come into Hostpital: </th>
				<td style="font-size: 24px;">' . $appointment_row["patient_come_into_hospital"] . '</td>
			</tr>
			<tr>
				<th width="50%" align="right" style="font-size: 24px; color: #004CA5">Doctor Comment: </th>
				<td style="font-size: 24px;">' . $appointment_row["doctor_comment"] . '</td>
			</tr>
		</table>
			';
	}

	$html .= '
			</td>
		</tr>
	</table>';

	echo $html;

	$pdf = new Pdf();

	$pdf->loadHtml($html, 'UTF-8');
	$pdf->render();
	ob_end_clean();
	//$pdf->stream($_GET["id"] . '.pdf', array( 'Attachment'=>1 ));
	$pdf->stream($_GET["id"] . '.pdf', array('Attachment' => false));
	exit(0);
}
