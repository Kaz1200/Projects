<?php

//typeOfAccount.php

include('class/Appointment.php');

$object = new Appointment;
include('header3.php');
?>
<div class="container" style="margin-top: 180px">
	<div class="row mb-5">
		<div class="col-md-6 mb-3">
			<div class="card">
				<img src="assets\img\typeOfAccountImage\patient.jpg" class="card-img-top" alt="...">
				<div class="card-body d-flex justify-content-center">
					<a href="login.php" class="btn btn-sm btn-primary py-2 font-weight-bold">Patient</a>
				</div>
			</div> 
		</div>
		
		<div class="col-md-6 mb-3">
			<div class="card">
				<img src="assets\img\typeOfAccountImage\admin.jpg" class="card-img-top" alt="...">
				<div class="card-body d-flex justify-content-center">
					<a href="admin/index.php" class="btn btn-sm btn-primary py-2 font-weight-bold">Administration</a>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript" src="../vendor/parsley/dist/parsley.min.js"></script>

<script type="text/javascript" src="../vendor/bootstrap-select/bootstrap-select.min.js"></script>

<script type="text/javascript" src="../vendor/datepicker/bootstrap-datepicker.js"></script>

</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<script type="text/javascript" src="vendor/parsley/dist/parsley.min.js"></script>

<script type="text/javascript" src="vendor/datepicker/bootstrap-datepicker.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


<script>
	$(document).ready(function() {

		$('#patient_login_form').parsley();

		$('#patient_login_form').on('submit', function(event) {

			event.preventDefault();

			if ($('#patient_login_form').parsley().isValid()) {
				$.ajax({

					url: "action.php",
					method: "POST",
					data: $(this).serialize(),
					dataType: "json",
					beforeSend: function() {
						$('#patient_login_button').attr('disabled', 'disabled');
					},
					success: function(data) {
						$('#patient_login_button').attr('disabled', false);

						if (data.error != '') {
							$('#message').html(data.error);
						} else {
							window.location.href = "dashboard.php";
						}
					}
				});
			}

		});

	});
</script>