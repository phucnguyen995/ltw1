<?php
session_start();
//require "../app/db.php";
require "../app/config.php";
spl_autoload_register(function  ($class_name) {
  require "../app/".$class_name .'.php';
  });
$db = new db();
	if (!isset($_SESSION['admin']))
	{
		header('location:../index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Search Result</title>
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
	<style type="text/css">
		ul.pagination{
			list-style: none;
			float: right;
		}
		ul.pagination li.active{
			font-weight: bold
		}
		ul.pagination li{
		  float: left;
		  display: inline-block;
		  padding: 10px
		}
	</style>
</head>
<body>

<!--Header-part-->
<div id="header">
	<h1><a href="index.php">Dashboard</a></h1>
</div>
<!--close-Header-part-->

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
	<ul class="nav">
		<li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome Super Admin</span><b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a href="#"><i class="icon-user"></i> My Profile</a></li>
				<li class="divider"></li>
				<li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
				<li class="divider"></li>
				<li><a href="../login/delete.php"><i class="icon-key"></i> Log Out</a></li>
			</ul>
		</li>
		<li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a class="sAdd" title="" href="#"><i class="icon-plus"></i> new message</a></li>
				<li class="divider"></li>
				<li><a class="sInbox" title="" href="#"><i class="icon-envelope"></i> inbox</a></li>
				<li class="divider"></li>
				<li><a class="sOutbox" title="" href="#"><i class="icon-arrow-up"></i> outbox</a></li>
				<li class="divider"></li>
				<li><a class="sTrash" title="" href="#"><i class="icon-trash"></i> trash</a></li>
			</ul>
		</li>
		<li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
		<li class=""><a title="" href="../login/delete.php"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
	</ul>
</div>

<!--start-top-serch-->
<div id="search">
	<form action="result.php" method="get">
	<input type="text" placeholder="Search here..." name="key"/>
	<button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</form>
</div>
<!--close-top-serch-->

<!--sidebar-menu-->

<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-th"></i>Tables</a>
	<ul>
		<li><a href="index.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>

		<li> <a href="protype.php"><i class="icon icon-th-list"></i> <span>News Type Table</span></a></li>

		<li> <a href="comments-tab.php"><i class="icon icon-th-list"></i> <span>Comments Table</span></a></li>

		<li> <a href="users-tab.php"><i class="icon icon-th-list"></i> <span>Users Table</span></a></li>
	</ul>
</div>
<!-- BEGIN CONTENT -->
<div id="content">
	<div id="content-header">
		<div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
		<h1>Search Result</h1>
	</div>
	<div class="container-fluid">
		<hr>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title"> <span class="icon"><a href="form-add.php"> <i class="icon-plus"></i> </a></span>
						<h5>Products</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>IMG</th>
								<th>TieuDe</th>
								<th>Time</th>
								<th>TacGia</th>
								<th>NoiDung</th>
								<th>idTL</th>
								<th>TinNoiBat</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
								<?php
									$key = $_GET['key'];
									$total_rows = $db->countSearch($key);
									$per_page = 5;
									if (isset($_GET['page']))
									{
										$page = $_GET['page'];
									}
									else
									{
										$page = 1;
									}
									
									$search = $db->search($key, $page, $per_page);
									foreach ($search as $row) {	
								?>	
							<tr class="">
								<td><img src="../public/images/<?php echo $row['hinhAnh'] ?>" style="width: 400px;height: 120px;"/></td>
								<td> <?php echo $row['tieuDe']?></td>
								<td><?php echo $row['time'] ?></td>
								<td><?php echo $row['author'] ?></td>
								<td> <?php echo substr($row['noiDung'], 0,100)."..." ?></td>
								<td><?php echo $row['idTL'] ?></td>
								<td><?php echo $row['tinnoibat'] ?></td>
								<td>
									<a href="form.html" class="btn btn-success btn-mini">Edit</a>
									<a href="#" class="btn btn-danger btn-mini">Delete</a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
						</table>
						<ul class="pagination">
							<?php
							$base_url = $_SERVER['PHP_SELF']."?key=$key&";
							echo $db->create_links($base_url, $total_rows, $page, $per_page);
							?>
						</ul>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END CONTENT -->
<!--Footer-part-->
<div class="row-fluid">
	<div id="footer" class="span12"> 2018 &copy; TDC - Lập trình web 1</div>
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

