<?php 

//login.php

include('header3.php');

?>

<div class="container" style="margin-top: 180px;">
	<div class="row justify-content-md-center">
		<div class="col col-md-6 mb-1">
			<span id="message"></span>
			<div class="card">
				<h4>
					<div class="card-header p-3 mb-1  text-center" style="
						font-size: 32px;
						font-weight: 700;
						text-align: center;
						padding-bottom: 6px;
						color: black;
						background-color: white;
						border-bottom: solid 2px gray;">
						Registration
					</div>
				</h4>
				<div class="card-body">

					<form method="post" id="patient_register_form" class="form">

						<div class="main-user-info">

							<div class="user-input-box ">
								<label for="emailAddress" class="text-dark">Email Address<span class="text-danger">*</span></label>
								<input type="text" id="patient_email_address" name="patient_email_address" placeholder="juansantos@gmail.com" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" />

								<script>
									$('#message_body').html(message_body);
								</script>
							</div>

							<div class="row d-flex justify-content-center align-items-center">
								<div class="col-md-6">
									<div class="user-input-box mt-2">
										<label for="patientPassword">Password<span class="text-danger">*</span></label>
										<input type="password" name="patient_password" id="patient_password" placeholder="********" class="form-control" required data-parsley-trigger="keyup" data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" data-parsley-pattern-message="Password must contain: at least one lowercase letter, one uppercase letter, one number, and one special character and be at least 8 characters long." />
										<div class="invalid-feedback">Password must contain: at least one lowercase letter <br> one uppercase letter <br> one number <br> one special character <br> be at least 8 characters long.</div>
									</div>
								</div>


								<div class="col-md-6">
									<div class="user-input-box mt-2">
										<label for="patientConPassword">Confirm Password<span class="text-danger">*</span></label>
										<input type="password" name="patient_Conpassword" id="patient_Conpassword" placeholder="********" class="form-control" required data-parsley-trigger="keyup" data-parsley-equalto="#patient_password" data-parsley-equalto-message="Passwords do not match." />
									</div>
								</div>

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
    <div class="user-input-box mt-2">
        <label for="patientSuffix">Suffix</label>
        <input type="text" name="patient_suffix" id="patient_suffix" placeholder="Jr." class="form-control" data-parsley-trigger="keyup" />
    </div>
</div>
</div>
							<div class="row d-flex justify-content-center align-items-center">
								<div class="col-md-6">
									<div class="user-input-box mt-2">
										<label for="birthDate">Date of Birth<span class="text-danger">*</span></label>
										<input type="text" name="patient_date_of_birth" id="patient_date_of_birth" placeholder="Birthdate" class="form-control" required data-parsley-trigger="keyup" style="cursor: pointer;" />


									</div>
								</div>

								<div class="col-md-6">
									<div class="user-input-box mt-2">
										<label for="Gender">Gender <span class="text-danger">*</span></label>
										<select name="patient_gender" id="patient_gender" class="form-control" required style="overflow-y: scroll; font-size: 18px; cursor: pointer;">
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="user-input-box mt-2">
										<label for="Contact">Contact No.<span class="text-danger">*</span></label>
										<input type="text" name="patient_phone_no" id="patient_phone_no" placeholder="09XXXXXXXXX" class="form-control" required data-parsley-trigger="keyup" maxlength="11" pattern="09[0-9]{9}" title="Phone number should start with 09 and have 11 digits" />
									</div>
								</div>


								<div class="col-md-6">
									<div class="user-input-box mt-2">
										<label for="Status">Maritial Status<span class="text-danger">*</span></label> <br>
										<select name="patient_maritial_status" id="patient_maritial_status" class="form-control" required style="overflow-y: scroll; font-size: 18px; cursor: pointer;">
											<option value="Single">Single</option>
											<option value="Married">Married</option>
											<option value="Seperated">Seperated</option>
											<option value="Divorced">Divorced</option>
											<option value="Widowed">Widowed</option>
										</select>
									</div>
								</div>

	<div class="user-input-box mt-2">
	<label>Complete Address<span class="text-danger">*</span></label>
	<p style="font-size: 10px">Example: Unit 123, 123 Main Street, Barangay Santa Clara, Quezon City, Metro Manila, 1234, Philippines</p>
	<textarea name="patient_address" id="patient_address" class="form-control" required data-parsley-trigger="keyup" pattern="^Unit \d+, [A-Za-z\s]+, [A-Za-z\s]+, [A-Za-z\s]+, [A-Za-z\s]+, \d{4}, [A-Za-z\s]+$" title="Please enter a valid address in the format: Unit/Building Number, Street Name, Barangay, City/Municipality, Province, Postal Code, Country" placeholder="Unit/Building Number, Street Name, Barangay, City/Municipality, Province, Postal Code, Country"></textarea>
</div>

								<div class=" text-center mt-4 ">
									<input type="hidden" name="action" value="patient_register" />
									<button type="submit" class="btn btn-primary btn-block mt-5" name="patient_register_button" id="patient_register_button" value=""><b> Register</b></button>

									<div class="signup mt-3">Already have an Account? <a href="login.php">Login Here</a>
										<div>
										</div>
					</form>
				</div>
			</div>
			<br />
			<br />

		</div>
	</div>
</div>
</div>
</div>

<?php
include('footer2.php');
?>

<script>
	$(document).ready(function() {

		$('#patient_date_of_birth').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true
		});

		$('#patient_register_form').parsley();

		$('#patient_register_form').on('submit', function(event) {

			event.preventDefault();

			if ($('#patient_register_form').parsley().isValid()) {
				$.ajax({
					url: "action.php",
					method: "POST",
					data: $(this).serialize(),
					dataType: 'json',
					beforeSend: function() {
						$('#patient_register_button').attr('disabled', 'disabled');
					},
					success: function(data) {
						$('#patient_register_button').attr('disabled', false);
						$('#patient_register_form')[0].reset();
						if (data.error !== '') {
							$('#message').html(data.error);
						}
						if (data.success !== '') {
							$('#message').html(data.success);
							$('#patient_register_form')[0].reset();
							setTimeout(function(){location.href="login.php"}, 3000);
						}
					}
				});
			}

		});

	});
</script>