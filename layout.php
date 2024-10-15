<!-- Main Header -->
<div class="main-header">
	<div class="logo-header">
		<a href="admin.php" class="logo">
			Admin Dashboard
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
					<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
						<img src="assets/img/profile.jpg" alt="user-img" width="36"
							class="img-circle"><span>Admin</span>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li>
							<div class="user-box">
								<div class="u-img"><img src="assets/img/profile.jpg" alt="user"></div>
								<div class="u-text">
									<h4>Admin</h4>
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
			<?php
			// Get the current filename
			$current_page = basename($_SERVER['PHP_SELF']);
			?>
			<li class="nav-item <?php if ($current_page == 'admin.php') {
				echo 'active';
			} ?>">
				<a href="admin.php">
					<i class="la la-dashboard"></i>
					<p>Dashboard</p>
				</a>
			</li>
			<li class="nav-item <?php if ($current_page == 'user.php') {
				echo 'active';
			} ?>">
				<a href="user.php">
					<i class="la la-users"></i>
					<p>User Management</p>
				</a>
			</li>
			<li class="nav-item <?php if ($current_page == 'add_user.php') {
				echo 'active';
			} ?>">
				<a href="add_user.php">
					<i class="la la-user-plus"></i>
					<p>Add User</p>
				</a>
			</li>
			<li class="nav-item <?php if ($current_page == 'documents.php') {
				echo 'active';
			} ?>">
				<a href="documents.php">
					<i class="la la-file"></i>
					<p>Documents</p>
				</a>
			</li>
			<li class="nav-item <?php if ($current_page == 'downloads.php') {
				echo 'active';
			} ?>">
				<a href="downloads.php">
					<i class="la la-download"></i>
					<p>Downloads</p>
				</a>
			</li>
		</ul>
	</div>
</div>