<?php

//login.php

include('class/Appointment.php');

$object = new Appointment;

include('header3.php');

?>
<div class="container" style="margin-top: 180px;">
    <div class="row justify-content-md-center">
        <div class="col col-md-4">
            <?php
            if (isset($_SESSION["success_message"])) {
                echo $_SESSION["success_message"];
                unset($_SESSION["success_message"]);
            }
            ?>
            <span id="message"></span>
            <div class="card mt-5">
                <h4>
                    <div class="card-header p-3 mb-2 text-center" style="font-size: 32px;
						font-weight: 700;
						text-align: center;
						padding-bottom: 6px;
						color: black;
						background-color: white;
						border-bottom: solid 1px gray;">
                        Login
                    </div>
                </h4>
                <div class="card-body">
                    <form method="post" id="patient_login_form">

                        <div class="user-input-box">
                            <label for="emailAddress" class="text-dark">Email Address<span class="text-danger">*</span></label>

                            <input type="text" id="patient_email_address" name="patient_email_address" placeholder="juansantos@gmail.com" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" />
                        </div>

                        <div class="user-input-box mt-3">
                            <label for="patientPassword" class="text-dark">Password<span class="text-danger">*</span></label>

                            <input type="password" name="patient_password" id="patient_password" placeholder="********" class="form-control form-control-sm" required autofocus data-parsley-trigger="keyup" />

                        </div>

                        <div class=" text-center mt-4 ">
                            <input type="hidden" name="action" value="patient_login" />
                            <button type="submit" class="btn btn-primary btn-block"><b>Sign In </b></button>
                            <div class="signup mt-3 text-dark">Don't have an account? <a href="register.php">Create an Account</a></div>
                            <div class="forgot-password mt-3 text-dark"><a href="forgot.php">Forgot Password?</a></div>
                        </div>
                    </form>
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
    $(window).on("load", function() {
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


        $(document).on('click', '.toggle-password', function() {
            $(this).toggleClass('fa-eye fa-eye-slash');
            var input = $($(this).parent().prev('input'));
            if (input.attr('type') == 'password') {
                input.attr('type', 'text');
            } else {
                input.attr('type', 'password');
            }
        });
    });
</script>


