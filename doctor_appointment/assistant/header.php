<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Assistant Appointment Management System in PHP</title>
    
    <!-- Favicons -->
	<link href="assets/img/smileIcon1.png" rel="icon">
	<link href="assets/img/smileIcon1.png" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../vendor/parsley/parsley.css" />

    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap-select/bootstrap-select.min.css" />

    <link rel="stylesheet" type="text/css" href="../vendor/datepicker/bootstrap-datepicker.css" />
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/432d2f3f7b.js" crossorigin="anonymous"></script>

     <style>
        #tooltipText {
            position: absolute;
            font-size: 12px;
            right: 228px;
            bottom: 10px;
            transform: translateX(-50%);
            background-color: #00B2FF;
            color: white;
            white-space: nowrap;
            padding: 3px 8px;
            border-radius: 4px;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        #tooltipText::before {
            content: "";
            position: absolute;
            left: 10%;
            bottom: 100%;
            border-color: #B1B1B1;
        }

        #tooltip:hover #tooltipText {
            bottom: -100%;
            visibility: visible;
            opacity: 1;
        }

        #tooltipText1 {
            position: absolute;
            font-size: 12px;
            right: 178px;
            bottom: 10px;
            transform: translateX(-50%);
            background-color: #00B2FF;
            color: white;
            white-space: nowrap;
            padding: 3px 8px;
            border-radius: 4px;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        #tooltipText1::before {
            content: "";
            position: absolute;
            left: 35%;
            bottom: 100%;
            border-color: #B1B1B1;
        }

        #tooltip:hover #tooltipText1 {
            bottom: -100%;
            visibility: visible;
            opacity: 1;
        }
        .fa-file-invoice:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            color: #fff;
        }
    </style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: rgba(223, 94, 0, 1);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">

                </div>
                <i class="fas fa-laugh-wink"></i>
                <div class="sidebar-brand-text mx-3">Assistant</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->



            <li class="nav-item">
                <a class="nav-link" href="doctor_schedule.php">
                    <i class="fas fa-user-clock"></i>
                    <span class="text-white" style="font-size: 14px;">Schedule Management</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="appointment.php">
                    <i class="fas fa-notes-medical"></i>
                    <span class="text-white" style="font-size: 14px;">Appointment</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="billing.php">
                    <i class="fas fa-wallet"></i>
                    <span class="text-white" style="font-size: 14px;">Billing Statement</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="sms.php">
                    <i class="fas fa-phone"></i>
                    <span class="text-white" style="font-size: 14px;">SMS Notification</span></a>
            </li>
            <?php
            ?>

            <?php



            ?>
            <!-- <li class="nav-item">
                <a class="nav-link" href="assistant_profile.php">
                    <i class="far fa-id-card"></i>
                    <span>Profile</span></a>
            </li> -->
            <?php

            ?>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <?php
                        $user_name = '';
                        $user_profile_image = '';

                       if ($_SESSION['type'] == 'Assistant') {
                            $object->query = "
                            SELECT * FROM assistant_database 
                            WHERE assistant_id = '" . $_SESSION['admin_id'] . "'
                            ";

                            $user_result = $object->get_result();

                            foreach ($user_result as $row) {
                                $user_name = $row['assistant_name'];
                                $user_profile_image = $row['assistant_profile_image'];
                            }
                        } 

                        if ($_SESSION['type'] == 'Doctor') {
                            $object->query = "
                            SELECT * FROM doctor_database 
                            WHERE doctor_id = '" . $_SESSION['admin_id'] . "'
                            ";

                            $user_result = $object->get_result();

                            foreach ($user_result as $row) {
                                $user_name = $row['doctor_name'];
                                $user_profile_image = $row['doctor_profile_image'];
                            }
                        }


                        ?>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="user_profile_name"><?php echo $user_name; ?></span>
                                <img class="img-profile rounded-circle" src="<?php echo $user_profile_image; ?>" id="user_profile_image">
                            </a>
                            <!-- Dropdown - User Information -->
                            <?php
                            if ($_SESSION['type'] == 'Assistant') {
                            ?>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="assistant_profile.php">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            <?php
                            }
                            if ($_SESSION['type'] == 'Doctor') {
                            ?>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="assistant_profile.php">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">