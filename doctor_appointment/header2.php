<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta content="" name="description">
	<meta content="" name="keywords">
	<title>Smile Haven</title>

	<!-- Favicons -->
	<link href="images/smileIcon1.png" rel="icon">
	<link href="images/smileIcon1.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
	<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="assets/css/profile.css" rel="stylesheet">
	<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="assets/css/style.css" rel="stylesheet">

	<!--<script async src="https://api.countapi.xyz/hit/smilehaven.com/a17fcf0f-e527-4582-9f26-978ef71b7da4?callback=websiteVisits"></script>-->

</head>
<style>
	#hero {
		background-image: url("assets/img/testimonials/hero-bg.jpg");
		object-fit: contain;
	}

	.services .icon-box {
		max-height: 350px;
		max-width: 250px;
	}

	#navbar a {
		font-size: 15px;
		font-weight: 600;
	}

	.login-btn a {
		font-size: 18px;
		font-weight: 700;
		color: #fff;
		margin-left: 50px;
		padding-left: 50px;
		transition: color 0.3s;
	}

	.login-btn :hover {
		color: rgba(0, 118, 226, 1);
		font-weight: bold;
	}

	#Submit {
		justify-content: center;
		padding-right: 130px;
		padding-left: 130px;
	}

	@media (max-width: 991px) {
		#navbar ul {
			width: 100%;
			height: 60%;
			left: 0;
			right: 0;
			background-image: url('images/logo.jpg');
			background-repeat: no-repeat;
			background-size: contain;
			background-position: center;
			background-size: 20% 15%;
			background-position-y: 320px;
		}
	}
</style>

<body>
	<!-- ======= Top Bar ======= -->
	<div id="topbar" class="d-flex align-items-center fixed-top">
		<div class="container d-flex justify-content-between">
			<div class="contact-info d-flex align-items-center">
				<i class="bi bi-envelope"></i> <a href="mailto:contact@example.com">aplusdch@gmail.com</a>
				<i class="bi bi-phone"></i> Landline - (02) 8661 4827
			</div>
			<div class="d-none d-lg-flex social-links align-items-center">
				<a href="https://www.facebook.com/aplusDCH/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
				<a href="https://www.instagram.com/aplusdchqc/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
			</div>
		</div>
	</div>
	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top">
		<div class="container d-flex align-items-center">

			<h1 class="logo me-auto"><a class="text-decoration-none" href="index.php">SMILE HAVEN</a></h1>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

			<nav id="navbar" class="navbar order-last order-lg-0">
				<ul>
					<li class="md-3"><a class="nav-link scrollto mx-auto d-block text-center" href="#hero">Home</a></li>
					<li class="md-3"><a class="nav-link scrollto mx-auto d-block text-center" href="#about">About</a></li>
					<li class="md-3"><a class="nav-link scrollto mx-auto d-block text-center" href="#services">Services</a></li>
					<li class="md-3"><a class="nav-link scrollto mx-auto d-block text-center" href="#doctors">Doctors</a></li>
					<li class="md-3"><a class="nav-link scrollto mx-auto d-block text-center" href="#gallery">Gallery</a></li>
					<li class="md-3"><a class="nav-link scrollto mx-auto d-block text-center" href="#contact">Contact</a></li>

				</ul>

				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav> <!-- .navbar -->

			<?php
			if (!isset($_SESSION['patient_id'])) {
			?>
				<div class="login-btn">
					<div class="d-flex justify-content-end col mr-3"><a href="typeOfAccount.php" class="font-weight-bold m-3" style="text-decoration: none;">Login</a></div>
				</div>
			<?php
			}
			?>
		</div>
	</header><!-- End Header -->