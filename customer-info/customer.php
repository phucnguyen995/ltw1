<?php
session_start();
require "../app/config.php";
//require "../app/db.php";
spl_autoload_register(function  ($class_name) {
  require "../app/".$class_name .'.php';
  });
$db = new db();
$user = new users();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Manage Account</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="public/css/bootstrap.min.css" />
	<link rel="stylesheet" href="public/css/bootstrap-responsive.min.css" />
	<link rel="stylesheet" href="public/css/uniform.css" />
	<link rel="stylesheet" href="public/css/select2.css" />
	<link rel="stylesheet" href="public/css/matrix-style.css" />
	<link rel="stylesheet" href="public/css/matrix-media.css" />
	<link href="public/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
	
</head>
<body>

<!--Header-part-->
<div id="header">
	<h1><a href="dashboard.html">Dashboard</a></h1>
</div>
<!--close-Header-part-->

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
	<ul class="nav">
		<li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome <?php echo $_SESSION['user']; ?></span><b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a href="customer.php"><i class="icon-user"></i> My Profile</a></li>
				<li class="divider"></li>
				<li><a href="../index.php"><i class="icon-key"></i> Home news</a></li>
			</ul>
		</li>
		<li class=""><a title="" href="../index.php"><i class="icon icon-share-alt"></i> <span class="text">Home news</span></a></li>
	</ul>
</div>


<!--sidebar-menu-->

<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-th"></i>Tables</a>
	<ul>

		<li><a href="customer.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>

		<li> <a href="change-pass.php"><i class="icon icon-th-list"></i> <span>Change password</span></a></li>


		
	</ul>
</div>
<!-- BEGIN CONTENT -->
<div id="content">
	<div id="content-header">
		
		<h1>Account Manage</h1>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>User name</th>
								<th>Email</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$username = $_SESSION['user'];
							$show = $user->getUser($username);
								?>	
							<tr class="">
								<td><?php echo $show['user'] ?></td>
								
								<td><?php echo $show['email'] ?></td>
							</tr>
						</tbody>
						</table>
					</div>
				</div>
			</div>
			<b><a style="padding: 5px;" href="change-pass.php" class="btn btn-success btn-mini">Change password</a></b>
		</div>
	</div>
</div>
<!-- END CONTENT -->
<!--Footer-part-->
<div class="row-fluid">
	<div id="footer" class="span12"> 2017 &copy; TDC - Lập trình web 1</div>
</div>
<!--end-Footer-part-->
<script src="public/js/jquery.min.js"></script>
<script src="public/js/jquery.ui.custom.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/jquery.uniform.js"></script>
<script src="public/js/select2.min.js"></script>
<script src="public/js/jquery.dataTables.min.js"></script>
<script src="public/js/matrix.js"></script>
<script src="public/js/matrix.tables.js"></script>
</body>
</html>

