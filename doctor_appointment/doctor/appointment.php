<?php

//appointment.php

include('../class/Appointment.php');

$object = new Appointment;

if (!isset($_SESSION['admin_id'])) {
    header('location:' . $object->base_url . '');
}

include('header.php');

?>
<!-- DataTales Example -->
<span id="message"></span>
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-primary">
        <h1 class="h3 mb-2 text-white text-center mt-2">Appointment Management</h1>
    </div>
    <div class="card-header py-3">
        <div class="row">
            <h4 class="mx-auto d-block text-center font-weight-bold">Choose a date</h4>
            <div class="col-sm-12" align="right">
                <div class="row d-flex justify-content-center">
                    <div class="">
                        <div class="row input-daterange">
                            <label><b>
                                    <h6 class="font-weight-bold"> From </h6>
                                </b></label>
                            <div class="col-md-5">
                                <input type="text" name="start_date" id="start_date" class="form-control form-control-sm" readonly />
                            </div>
                            <h6 class="font-weight-bold"> To </h6>
                            <div class="col-md-5">
                                <input type="text" name="end_date" id="end_date" class="form-control form-control-sm" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">

                            <!-- ITO NA GINAWA KO -->
                            <div id="tooltip">
                                <span id="tooltipText"><b>Search</b></span>
                                <span><button type="button" name="search" id="search" value="Search" class="btn btn-primary btn-sm">
                                        <i class="fas fa-search"></i>
                                    </button></span>
                            </div>

                            &nbsp;

                            <div id="tooltip">
                                <span id="tooltipText1"><b>Refresh</b></span>
                                <span><button type="button" name="refresh" id="refresh" class="btn btn-info btn-sm">
                                        <i class="fas fa-sync-alt"></i>
                                    </button></span>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="appointment_database">
                <thead>
                    <tr>
                        <th class="text-center">Appointment No.</th>
                        <th class="text-center">Patient Name</th>
                        <?php
                        if ($_SESSION['type'] == 'Admin') {
                        ?>
                            <th class="text-center">Doctor Name</th>
                        <?php
                        }
                        ?>
                        <th class="text-center">Appointment Date</th>
                        <th class="text-center">Appointment Time</th>
                        <th class="text-center">Service</th>
                        <th class="text-center">Appointment Status</th>
                        <th class="text-center">View</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>

<div id="viewModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="edit_appointment_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">View Appointment Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="appointment_details"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_appointment_id" id="hidden_appointment_id" />
                    <input type="hidden" name="action" value="change_appointment_status" />
                    <!-- <input type="submit" name="save_appointment" id="save_appointment" class="btn btn-primary" value="Save" /> -->
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        fetch_data('no');

        function fetch_data(is_date_search, start_date = '', end_date = '') {
            var dataTable = $('#appointment_database').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "appointment_action.php",
                    type: "POST",
                    data: {
                        is_date_search: is_date_search,
                        start_date: start_date,
                        end_date: end_date,
                        action: 'fetch'
                    }
                },
                "columnDefs": [{
                    <?php
                    if ($_SESSION['type'] == 'Admin') {
                    ?> "targets": [7],
                    <?php
                    } else {
                    ?> "targets": [6],
                    <?php
                    }
                    ?> "orderable": false,
                }, ],
            });
        }

        $(document).on('click', '.view_button', function() {

            var appointment_id = $(this).data('id');

            $.ajax({

                url: "appointment_action.php",

                method: "POST",

                data: {
                    appointment_id: appointment_id,
                    action: 'fetch_single'
                },

                success: function(data) {
                    $('#viewModal').modal('show');

                    $('#appointment_details').html(data);

                    $('#hidden_appointment_id').val(appointment_id);

                }

            })
        });

        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: "yyyy-mm-dd",
            autoclose: true
        });

        $('#search').click(function() {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            if (start_date != '' && end_date != '') {
                $('#appointment_database').DataTable().destroy();
                fetch_data('yes', start_date, end_date);
            } else {
                alert("Both Date is Required");
            }
        });

        $('#refresh').click(function() {
            $('#appointment_database').DataTable().destroy();
            fetch_data('no');
        });

        $('#edit_appointment_form').parsley();

        $('#edit_appointment_form').on('submit', function(event) {
            event.preventDefault();
            if ($('#edit_appointment_form').parsley().isValid()) {
                $.ajax({
                    url: "appointment_action.php",
                    method: "POST",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#save_appointment').attr('disabled', 'disabled');
                        $('#save_appointment').val('wait...');
                    },
                    success: function(data) {
                        $('#save_appointment').attr('disabled', false);
                        $('#save_appointment').val('Save');
                        $('#viewModal').modal('hide');
                        $('#message').html(data);
                        $('#appointment_database').DataTable().destroy();
                        fetch_data('no');
                        setTimeout(function() {
                            $('#message').html('');
                        }, 5000);
                    }
                })
            }
        });

    });
</script>