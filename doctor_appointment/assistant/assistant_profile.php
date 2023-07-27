<?php

include('../class/Appointment.php');

$object = new Appointment;

if (!$object->is_login()) {
    header("location:" . $object->base_url . "");
}

if ($_SESSION['type'] != 'Assistant') {
    header("location:" . $object->base_url . "");
}

$object->query = "
    SELECT * FROM assistant_database
    WHERE assistant_id = '" . $_SESSION["admin_id"] . "'
    ";

$result = $object->get_result();

include('header.php');

?>
<!-- DataTales Example -->

<form method="post" id="profile_form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-10"><span id="message"></span>
            <div class="card shadow mb-4">
            <div class="card-header d-flex py-3 bg-primary justify-content-between">
                    <h1 class="h3 mb-2 text-white text-center mt-2">Profile</h1>
                    <div class="col " align="right">
                        <input type="hidden" name="action" value="assistant_profile" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button type="submit" name="edit_button" id="edit_button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Update</button>
                        &nbsp;&nbsp;
                    </div>
                </div>
                <div class="card-body">
                    <!--<div class="row">
                                    <div class="col-md-6">!-->
                    <span id="form_message"></span>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email Address <span class="text-danger">*</span></label>
                                <input type="text" name="assistant_email_address" id="assistant_email_address" class="form-control" required data-parsley-type="email" data-parsley-trigger="keyup" />
                            </div>
                            <div class="col-md-6">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="assistant_password" id="assistant_password" class="form-control" required data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="assistant_name" id="assistant_name" class="form-control" required data-parsley-trigger="keyup" />
                            </div>
                            <div class="col-md-6">
                                <label>Phone No. <span class="text-danger">*</span></label>
                                <input type="text" name="assistant_phone_no" id="assistant_phone_no" class="form-control" required data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Address </label>
                                <input type="text" name="assistant_address" id="assistant_address" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                <label>Date of Birth </label>
                                <input type="text" name="assistant_date_of_birth" id="assistant_date_of_birth" readonly class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Image <span class="text-danger">*</span></label>
                        <br />
                        <input type="file" name="assistant_profile_image" id="assistant_profile_image" />
                        <div id="uploaded_image"></div>
                        <input type="hidden" name="hidden_assistant_profile_image" id="hidden_assistant_profile_image" />
                    </div>
                    <!--</div>
                                </div>!-->
                </div>
            </div>
        </div>
    </div>
</form>
<?php
include('footer.php');
?>

<script>
    $(document).ready(function() {

        $('#doctor_date_of_birth').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });

        <?php
        foreach ($result as $row) {
        ?>
            $('#hidden_id').val("<?php echo $row['assistant_id']; ?>");
            $('#assistant_email_address').val("<?php echo $row['assistant_email_address']; ?>");
            $('#assistant_password').val("<?php echo $row['assistant_password']; ?>");
            $('#assistant_name').val("<?php echo $row['assistant_name']; ?>");
            $('#assistant_phone_no').val("<?php echo $row['assistant_phone_no']; ?>");
            $('#assistant_address').val("<?php echo $row['assistant_address']; ?>");
            $('#assistant_date_of_birth').val("<?php echo $row['assistant_date_of_birth']; ?>");

            $('#uploaded_image').html('<img src="<?php echo $row["assistant_profile_image"]; ?>" class="img-thumbnail" width="100" /><input type="hidden" name="hidden_assistant_profile_image" value="<?php echo $row["assistant_profile_image"]; ?>" />');

            $('#hidden_assistant_profile_image').val("<?php echo $row['assistant_profile_image']; ?>");
        <?php
        }
        ?>

        $('#assistant_profile_image').change(function() {
            var extension = $('#assistant_profile_image').val().split('.').pop().toLowerCase();
            if (extension != '') {
                if (jQuery.inArray(extension, ['png', 'jpg']) == -1) {
                    alert("Invalid Image File");
                    $('#assistant_profile_image').val('');
                    return false;
                }
            }
        });

        $('#profile_form').parsley();

        $('#profile_form').on('submit', function(event) {
            event.preventDefault();
            if ($('#profile_form').parsley().isValid()) {
                $.ajax({
                    url: "profile_action.php",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#edit_button').attr('disabled', 'disabled');
                        $('#edit_button').html('wait...');
                    },
                    success: function(data) {
                        $('#edit_button').attr('disabled', false);
                        $('#edit_button').html('<i class="fas fa-edit"></i> Edit');

                        $('#assistant_email_address').val(data.assistant_email_address);
                        $('#assistant_password').val(data.assistant_password);
                        $('#assistant_name').val(data.assistant_name);
                        $('#assistant_phone_no').val(data.assistant_phone_no);
                        $('#assistant_address').text(data.assistant_address);
                        $('#assistant_date_of_birth').text(data.assistant_date_of_birth);
                        if (data.assistant_profile_image != '') {
                            $('#uploaded_image').html('<img src="' + data.assistant_profile_image + '" class="img-thumbnail" width="100" />');

                            $('#assistant_profile_image').attr('src', data.assistant_profile_image);
                        }

                        $('#hidden_assistant_profile_image').val(data.assistant_profile_image);

                        $('#message').html(data.success);

                        setTimeout(function() {

                            $('#message').html('');

                        }, 5000);
                    }
                })
            }
        });

    });
</script>