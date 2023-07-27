<?php

//profile.php



include('class/Appointment.php');


$object = new Appointment;

$object->query = "
SELECT * FROM patient_database 
WHERE patient_id = '" . $_SESSION["patient_id"] . "'
";

$result = $object->get_result();

include('header.php');

?>

<div class="container-fluid mt-5">

	<div class="row justify-content-md-center">
		<div class="col col-md-6">
			<br />
			<?php
			if (isset($_GET['action']) && $_GET['action'] == 'edit') {
			?>
				<div class="card bg-light border-0">
					<!-- <div class="card-header py-3 bg-primary text-white">
						<div class="row">
							<h2 class="col md-6">Profile Details</h2>
							<div class="col-md-6 text-right">
								<a href="profile.php" class="btn btn-secondary btn-sm">View</a>
							</div>
						</div>
					</div> -->


					<div class="d-flex justify-content-between align-items-center custom-bg py-2 px-4">
						<h1 class="h3 mb-2 text-white text-center mt-2">Edit Profile</h1>
						<button onclick="window.location.href = 'profile.php';" class="btn btn-info"><i class="fas fa-arrow-left"></i> Back</button>
					</div>


					<div class="card-body">
						<form method="post" id="edit_profile_form">
							<div class="form-group">
								<label>Email Address<span class="text-danger">*</span></label>
								<input type="text" name="patient_email_address" id="patient_email_address" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" readonly />
							</div>


							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Password<span class="text-danger">*</span></label>
										<input type="password" name="patient_password" id="patient_password" class="form-control" required data-parsley-trigger="keyup" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="patientConPassword">Confirm Password<span class="text-danger">*</span></label>
										<input type="password" name="patient_Conpassword" id="patient_Conpassword" placeholder="********" class="form-control" required data-parsley-trigger="keyup" data-parsley-equalto="#patient_password" data-parsley-equalto-message="Passwords do not match." />
									</div>
								</div>
							</div>





							<div class="row">
				<div class="col-md-5">
    <div class="user-input-box mt-2">
        <label for="patientFN">First Name<span class="text-danger">*</span></label>
        <input type="text" name="patient_first_name" id="patient_first_name" placeholder="Juan" class="form-control" required data-parsley-trigger="keyup" pattern="[A-Za-z]+" />
    </div>
</div>
<div class="col-md-5">
    <div class="user-input-box mt-2">
        <label for="patientLN">Last Name<span class="text-danger">*</span></label>
        <input type="text" name="patient_last_name" id="patient_last_name" placeholder="Santos" class="form-control" required data-parsley-trigger="keyup" pattern="[A-Za-z]+" />
    </div>
</div>
									<div class="col-md-2">
									<div class="form-group">
										<label>Suffix<span class="text-danger">*</span></label>
										<input type="text" name="patient_suffix" id="patient_suffix" class="form-control" data-parsley-trigger="keyup" />
									</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Date of Birth<span class="text-danger">*</span></label>
										<input type="text" name="patient_date_of_birth" id="patient_date_of_birth" class="form-control" required data-parsley-trigger="keyup" readonly />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Gender<span class="text-danger">*</span></label>
										<select name="patient_gender" id="patient_gender" class="form-control">
											<option value="Male">Male</option>
											<option value="Female">Female</option>
											<option value="Other">Other</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Contact No.<span class="text-danger">*</span></label>
										<input type="text" name="patient_phone_no" id="patient_phone_no" class="form-control" required data-parsley-trigger="keyup" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Maritial Status<span class="text-danger">*</span></label>
										<select name="patient_maritial_status" id="patient_maritial_status" class="form-control">
											<option value="Single">Single</option>
											<option value="Married">Married</option>
											<option value="Seperated">Seperated</option>
											<option value="Divorced">Divorced</option>
											<option value="Widowed">Widowed</option>
										</select>
									</div>
								</div>
							</div>
				<div class="user-input-box mt-2">
	<label>Complete Address<span class="text-danger">*</span></label>
	<p style="font-size: 10px">Example: Unit 123, 123 Main Street, Barangay Santa Clara, Quezon City, Metro Manila, 1234, Philippines</p>
	<textarea name="patient_address" id="patient_address" class="form-control" required data-parsley-trigger="keyup" pattern="^Unit \d+, [A-Za-z\s]+, [A-Za-z\s]+, [A-Za-z\s]+, [A-Za-z\s]+, \d{4}, [A-Za-z\s]+$" title="Please enter a valid address in the format: Unit/Building Number, Street Name, Barangay, City/Municipality, Province, Postal Code, Country" placeholder="Unit/Building Number, Street Name, Barangay, City/Municipality, Province, Postal Code, Country"></textarea>
</div>
							<div class="form-group text-center">
								<input type="hidden" name="action" value="edit_profile" />
								<input type="submit" name="edit_profile_button" id="edit_profile_button" class="btn btn-primary mt-3" value="Update" />
							</div>
						</form>
					</div>
				</div>

				<br />
				<br />


			<?php
			} else {

				if (isset($_SESSION['success_message'])) {
					echo $_SESSION['success_message'];
					unset($_SESSION['success_message']);
				}
			?>

				<div class="card bg-light">
					<div class="d-flex justify-content-between align-items-center custom-bg py-2 px-4">
						<h1 class="h3 mb-2 text-white text-center mt-2">Profile</h1>
						<a href="profile.php?action=edit" class="btn btn-light">Edit</a>
					</div>

					<div class="card-body" style="overflow: hidden;">
						<table class="table table-borderless">
							<?php foreach ($result as $row) : ?>
								<tr>
									<th scope="row" class="text-end fw-bold" style="width: 40%;">Patient Name</th>
									<td class="fs-5"><?= $row["patient_first_name"] . ' ' . $row["patient_last_name"].' ' . $row["patient_suffix"] ?? 'N/A'; ?></td>
								</tr>
								<tr>
									<th scope="row" class="text-end fw-bold" style="width: 40%;">Email Address</th>
									<td class="fs-5 pr-3"><?= $row["patient_email_address"] ?? 'N/A'; ?></td>
								</tr>

								<tr>
									<th scope="row" class="text-end fw-bold" style="width: 40%;">Address</th>
									<td class="fs-5"><?= $row["patient_address"] ?? 'N/A'; ?></td>
								</tr>
								<tr>
									<th scope="row" class="text-end fw-bold" style="width: 40%;">Contact No.</th>
									<td class="fs-5"><?= $row["patient_phone_no"] ?? 'N/A'; ?></td>
								</tr>
								<tr>
									<th scope="row" class="text-end fw-bold" style="width: 40%;">Date of Birth</th>
									<td class="fs-5"><?= $row["patient_date_of_birth"] ?? 'N/A'; ?></td>
								</tr>
								<tr>
									<th scope="row" class="text-end fw-bold" style="width: 40%;">Gender</th>
									<td class="fs-5"><?= $row["patient_gender"] ?? 'N/A'; ?></td>
								</tr>
								<tr>
									<th scope="row" class="text-end fw-bold" style="width: 40%;">Marital Status</th>
									<td class="fs-5"><?= $row["patient_maritial_status"] ?? 'N/A'; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
				<br />
				<br />
			<?php
			}
			?>
		</div>
	</div>
</div>

<?php

include('footer.php');


?>

<script src="assets/js/main.js"></script>

<script>
	$(document).ready(function() {

		$('#patient_date_of_birth').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true
		});

		<?php
		foreach ($result as $row) {

		?>
			$('#patient_email_address').val("<?php echo $row['patient_email_address']; ?>");
			$('#patient_password').val("<?php echo $row['patient_password']; ?>");
			$('#patient_first_name').val("<?php echo $row['patient_first_name']; ?>");
			$('#patient_last_name').val("<?php echo $row['patient_last_name']; ?>");
			$('#patient_suffix').val("<?php echo $row['patient_suffix']; ?>");
			$('#patient_date_of_birth').val("<?php echo $row['patient_date_of_birth']; ?>");
			$('#patient_gender').val("<?php echo $row['patient_gender']; ?>");
			$('#patient_phone_no').val("<?php echo $row['patient_phone_no']; ?>");
			$('#patient_maritial_status').val("<?php echo $row['patient_maritial_status']; ?>");
			$('#patient_address').val("<?php echo $row['patient_address']; ?>");

		<?php

		}

		?>

		$('#edit_profile_form').parsley();

		$('#edit_profile_form').on('submit', function(event) {

			event.preventDefault();

			if ($('#edit_profile_form').parsley().isValid()) {
				$.ajax({
					url: "action.php",
					method: "POST",
					data: $(this).serialize(),
					beforeSend: function() {
						$('#edit_profile_button').attr('disabled', 'disabled');
						$('#edit_profile_button').val('wait...');
					},
					success: function(data) {
						window.location.href = "profile.php";
					}
				})
			}

		});

	});
</script>
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