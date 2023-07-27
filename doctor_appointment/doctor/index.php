<?php

include('../class/Appointment.php');

$object = new Appointment;
include('header2.php');
if ($object->is_login()) {
  header("location:" . $object->base_url . "admin/dashboard.php");
}

?>

<div class="container-fluid text-center py-3 h-100">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col col-xl-8">
      <div class="card justify-content-center" style="border-radius: 1rem;">
        <div class="row g-0">
          <div class="col-md-6 col-lg-5 d-none d-md-block">
            <img src="../images/doc.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
          </div>
          <div class="col-md-6 col-lg-7 d-flex align-items-center">
            <div class="card-body p-4 p-lg-5 text-black">

              <form method="post" id="login_form">

                <div class="d-flex align-items-center ml-5 mb-3 pb-1">
                  <img src="../images/logo.jpg" class="logo" alt="logo">

                  <span class="h3 fw-bold mb-0">Doctor Login</span>
                </div>

                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                <!-- Email -->
                <div class="form-group mb-4">
                  <input type="text" name="admin_email_address" id="admin_email_address" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Email Address" />
                </div>

                <!-- Password -->
                <div class="form-group mb-4">
                  <div class="input-group">
                    <input type="password" name="admin_password" id="admin_password" placeholder="Password" class="form-control" required data-parsley-trigger="keyup" />
                    <div class="input-group-append">
                      <span class="input-group-text bg-white border-left-0">
                        <i class="far fa-eye toggle-password"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <!-- Login -->
                <input type="hidden" name="action" value="doctor_login" />
                <button type="submit" name="login_button" id="login_button" class="btn btn-primary btn-user px-4  btn-block">Login</button>
            </div>

            </form>

          </div>
        </div>
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
<script type="text/javascript" src="../vendor/parsley/dist/parsley.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>

<script>
  $(document).ready(function() {

    $('#login_form').parsley();

    $('#login_form').on('submit', function(event) {
      event.preventDefault();
      if ($('#login_form').parsley().isValid()) {
        $.ajax({
          url: "login_action.php",
          method: "POST",
          data: $(this).serialize(),
          dataType: 'json',
          beforeSend: function() {
            $('#login_button').attr('disabled', 'disabled');
            $('#login_button').val('wait...');
          },
          success: function(data) {
            $('#login_button').attr('disabled', false);
            if (data.error != '') {
              $('#error').html(data.error);
              $('#login_button').val('Login');
            } else {
              window.location.href = data.url;
            }
          }
        })
      }
    });

  });

  $(document).on('click', '.toggle-password', function() {
    var input = $("#admin_password");
    var icon = $(this).children();

    if (input.attr("type") === "password") {
      input.attr("type", "text");
      icon.removeClass("fas fa-eye").addClass("fa-eye fa-eye-slash");
    } else {
      input.attr("type", "password");
      icon.removeClass("fa-eye fa-eye-slash").addClass("fas fa-eye");
    }
  });
</script>