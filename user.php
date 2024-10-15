<?php
session_start();

// Check if the user is logged in and is not an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == '1') {
	header("Location: login.html"); // Redirect to login if not a valid user
	exit();
}
?>

<?php

if (isset($_SESSION['name'])) {
    echo "Welcome, " . $_SESSION['name'] . "!";
} else {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>User Dashboard</title>
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
</head>

<body>
	<div class="wrapper">
		<!-- Main Header -->
		<div class="main-header">
			<div class="logo-header">
				<a href="user.php" class="logo">
					User Dashboard
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
					data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<!-- Search Bar -->
					<form class="navbar-left navbar-form nav-search mr-md-3" action="">
						<div class="input-group">
							<input type="text" placeholder="Search ..." class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">
									<i class="la la-search search-icon"></i>
								</span>
							</div>
						</div>
					</form>

					<!-- User Profile -->
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
								aria-expanded="false">
								<img src="assets/img/profile.jpg" alt="user-img" width="36" class="img-circle">
								<span><?php echo  $_SESSION['name'];?></span>
							</a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="assets/img/profile.jpg" alt="user"></div>
										<div class="u-text">
											<h4><?php echo  $_SESSION['name'];?></h4>
										</div>
									</div>
								</li>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</div>

		<!-- Sidebar -->
		<div class="sidebar">
			<div class="scrollbar-inner sidebar-wrapper">
				<ul class="nav">
					<li class="nav-item active">
						<a href="user.php">
							<i class="la la-dashboard"></i>
							<p>Dashboard</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="user_documents.php">
							<i class="la la-file"></i>
							<p>View Documents</p>
						</a>
					</li>
					<!-- Removed admin-specific sections like 'Admin Dashboard' -->
				</ul>
			</div>
		</div>

		<!-- Main Panel -->
		<div class="main-panel">
			<div class="content">
				<h1>Welcome to the User Dashboard</h1>
				<!-- Add user-specific dashboard sections here (e.g., recent activity, account details) -->
			</div>
				<!-- Footer -->
				<?php
			include "footer.php";
			?>
		</div>
	</div>

	<!-- JS Files -->
	<script src="assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="assets/js/core/popper.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<script src="assets/js/plugin/chartist/chartist.min.js"></script>
	<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
	<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
	<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
	<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
	<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
	<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<script src="assets/js/ready.min.js"></script>
	<script src="assets/js/demo.js"></script>
</body>

</html>