<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

  	<title>Distribuciones Y Servicios Generales LAL</title>
	<link rel="shortcut icon" href="<?php echo constant("URL")?>public/img/logo.png"> 
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="<?php echo constant("URL")?>public/css/sb-admin-2.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo constant("URL")?>public/css/dataTables.bootstrap4.min.css">
	<link href="<?php echo constant("URL")?>public/css/dataTables.select.min.css" rel="stylesheet">


	
	<!-- Bootstrap core JavaScript-->
	<script src="<?php echo constant("URL")?>public/js/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo constant("URL")?>public/js/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Table -->
	
	<script src="<?php echo constant("URL")?>public/js/sb-admin-2.min.js"></script>
	<script src="<?php echo constant("URL")?>public/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo constant("URL")?>public/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo constant("URL")?>public/js/sweetalert2@10.js"></script>
	<script src="<?php echo constant("URL")?>public/js/dataTables.select.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
	
	<!-- Core plugin JavaScript-->
	<script src="<?php echo constant("URL")?>public/js/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="<?php echo constant("URL")?>public/js/all.min.js"></script>

	<script src="<?php echo constant("URL")?>public/js/jquery_validate.js"></script>
  	<script src="<?php echo constant("URL")?>public/js/jquery_validate1.js"></script>

	  <script src="<?php echo constant("URL")?>public/js/md5.min.js"></script>

	  <script src="<?php echo constant("URL")?>public/js/main.js"></script>
	  <style>
		*{
			font-family: 'Roboto', sans-serif;
		}
	  </style>
</head>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">

		<?php require "views/menu.php"; ?>
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">
				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-gray-900 text-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>
					<div class="input-group">
						<h6>Sistema de Control</h6>
					</div>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline small text-white"><?php echo $_SESSION['rol_name']; ?></span>
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									<?php echo $_SESSION['nombre']; ?>
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo constant("URL")?>usuario/logout">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Salir
								</a>
							</div>
						</li>

					</ul>

				</nav>
