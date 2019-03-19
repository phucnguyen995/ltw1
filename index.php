<?php
session_start();
require "app/config.php";
spl_autoload_register(function  ($class_name) {
  require "app/".$class_name .'.php';
  });
	$db = new db();
	$user = new users();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Magnews</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CLato:300,400" rel="stylesheet"> 
		
		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="public/css/bootstrap.min.css"/>

		<!-- Owl Carousel -->
		<link type="text/css" rel="stylesheet" href="public/css/owl.carousel.css" />
		<link type="text/css" rel="stylesheet" href="public/css/owl.theme.default.css" />
		
		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="public/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="public/css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    </head>
	<body>
	
		<!-- Header -->
		<header id="header">
			<!-- Top Header -->
			<div id="top-header">
				<div class="container">
					<div class="header-links">
						<ul>
							<li><a href="#">About us</a></li>
							<li><a href="#">Contact</a></li>
							<li><a href="#">Advertisement</a></li>
							<li><a href="#">Privacy</a></li>
							<?php if (isset($_SESSION['user']))
							{ 
								$name = $_SESSION['user'];
								$infoUser = $user->getUser($name);
								?>
								
								<li><a>Hello : <i class="fa fa-user"></i> <?php echo $_SESSION['user'] ?></a></li>
								<li><a href="customer-info/customer.php"><i class="fa fa-cog"></i> My Profile </a></li>
								<li><a href="login/delete.php"><i class="fa fa-sign-out"></i> Logout</a></li>

							<?php }
							else { ?>
								<li><a href="login/index.php"><i class="fa fa-sign-in"></i> Login</a></li>
								<li><a href="register/register.html"><i class="fa fa-user-plus"></i> Register</a></li>
							<?php } ?>
						</ul>
					</div>
					<div class="header-social">
						<ul>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#"><i class="fa fa-youtube"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /Top Header -->
			
			<!-- Center Header -->
			<div id="center-header">
				<div class="container">
					<div class="header-logo">
						<a href="index.php" class="logo"><img src="public/images/logo.png" alt=""></a>
					</div>
					<div class="header-ads">
						<img class="center-block" src="public/images/ad-2.jpg" alt=""> 
					</div>
				</div>
			</div>
			<!-- /Center Header -->
			
			<!-- Nav Header -->
			<div id="nav-header">
				<div class="container">
					<nav id="main-nav">
						<div class="nav-logo">
							<a href="index.php" class="logo"><img src="public/images/logo-alt.png" alt=""></a>
						</div>
						<ul class="main-nav nav navbar-nav">
							<li class="active"><a href="index.php">Home</a></li>
						<?php
							$tenTheLoai = $db->tenTheLoai();
							foreach ($tenTheLoai as $row) {
						?>

						 <li><a href="theloai.php?idTL=<?php echo $row['idTL'] ?>"><?php echo $row['tenTL'] ?></a></li>
						<?php
						}
						?>
							
						</ul>
					</nav>
					<div class="button-nav">
						<button class="search-collapse-btn"><i class="fa fa-search"></i></button>
						<button class="nav-collapse-btn"><i class="fa fa-bars"></i></button>
						<div class="search-form">
							<form action="kq_search.php" method="get">
								<input class="input" type="text" name="key" placeholder="Search">
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Nav Header -->
		</header>
		<!-- /Header -->
		<!-- Owl Carousel 1 -->
		<div id="owl-carousel-1" class="owl-carousel owl-theme center-owl-nav">
			<!-- ARTICLE -->
			<?php
				$tinmoinhat = $db->tinMoiNhat(10);
				foreach ($tinmoinhat as $row) {
			?>	
			<article class="article thumb-article">
				<div class="article-img">
					<img src="public/images/<?php echo $row['hinhAnh'] ?>" class="img-responsive" alt="" style="width: 100%; height: 450px;">
				</div>
				<div class="article-body">
					<ul class="article-info">
						<li class="article-category"><a href="theloai.php?idTL=<?php echo $row['idTL'] ?>"><?php echo $row['tenTL'] ?></a></li>
						<li class="article-type"><i class="fa fa-camera"></i></li>
					</ul>
					<h2 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,80)."..." ?></a></h2>
					<ul class="article-meta">
						<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
					</ul>
				</div>
			</article>
			<?php
					}
				?>
			<!-- /ARTICLE -->
		</div>
		<!-- /Owl Carousel 1 -->
		<!-- SECTION -->
		<div class="section">
			<!-- CONTAINER -->
			<div class="container">
				<!-- ROW -->
				<div class="row">
					<!-- Main Column -->
					<div class="col-md-12">
						<!-- section title -->
						<div class="section-title">

							<h2 class="title">Trending Posts</h2>
							<!-- tab nav -->
							<ul class="tab-nav pull-right">
								<li class="active"><a data-toggle="tab" href="#home">All</a></li>
								<li><a data-toggle="tab" href="#tab1">News</a></li>
								<li><a data-toggle="tab" href="#tab2">Sport</a></li>
								<li><a data-toggle="tab" href="#tab3">Lifestyle</a></li>
								<li><a data-toggle="tab" href="#tab4">FASHION</a></li>
								<li><a data-toggle="tab" href="#tab5">Music</a></li>
							</ul>
							<!-- /tab nav -->
						</div>
						<!-- /section title -->
						
						<!-- Tab content -->
						<div class="tab-content">
							<!-- Home -->
							<div id="home" class="tab-pane fade in active">
								<!-- row -->
								<div class="row">
									<!-- Column 1 -->
									<?php
										$tinnoiBat = $db->tinNoiBat(4);
										foreach ($tinnoiBat as $row) {	
									?>	
									<div class="col-md-3 col-sm-6">
										<!-- ARTICLE -->
										<article class="article">
											<div class="article-img">
												<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
													<img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="" style="width: 100%; height: 180px;">
												</a>
												<ul class="article-info">
													<li class="article-type"><i class="fa fa-camera"></i></li>
												</ul>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"> <?php echo substr($row['tieuDe'], 0,50)."..." ?> </a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
												</ul>
											</div>
										</article>
										
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
									<?php
											}
										?>
									
								</div>
								<!-- /row -->
								
								<!-- row -->
								<div class="row">
								<?php
								$tinmoinhat = $db->tinMoiNhat(6);
								foreach ($tinmoinhat as $row) {
								?>		
									<!-- Column 1 -->
									<div class="col-md-4 col-sm-6">
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
													<img src="public/images/<?php echo $row['hinhAnh'] ?>"  alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
								<?php
									}
								?>
								</div>
								<!-- /row -->
							</div>
							<!-- /home -->

							<!-- tab1 -->
							<div id="tab1" class="tab-pane fade">
								<!-- row -->
								<div class="row">
									<!-- Column 1 -->
									<?php
										$tinnoiBat1 = $db->tinMoiNhatTL1(1,4);
										foreach ($tinnoiBat1 as $row) {	
									?>	
									<div class="col-md-3 col-sm-6">
										<!-- ARTICLE -->
										<article class="article">
											<div class="article-img">
												<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
													<img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="" style="width: 100%; height: 180px;">
												</a>
												<ul class="article-info">
													<li class="article-type"><i class="fa fa-camera"></i></li>
												</ul>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"> <?php echo substr($row['tieuDe'], 0,50)."..." ?> </a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
												</ul>
											</div>
										</article>
										
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
									<?php
											}
										?>
									
								</div>
								<!-- /row -->
								
								<!-- row -->
								<div class="row">
								<?php
								$tinmoinhat = $db->tinMoiNhat(6);
								foreach ($tinmoinhat as $row) {
								?>		
									<!-- Column 1 -->
									<div class="col-md-4 col-sm-6">
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
													<img src="public/images/<?php echo $row['hinhAnh'] ?>"  alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
								<?php
									}
								?>
								</div>
								<!-- /row -->
							</div>
							<!-- /tab1 -->

							<!-- tab2 -->
							<div id="tab2" class="tab-pane fade">
								<!-- row -->
								<div class="row">
									<!-- Column 1 -->
									<?php
										$tinnoiBat2 = $db->tinMoiNhatTL1(2,4);
										foreach ($tinnoiBat2 as $row) {	
									?>	
									<div class="col-md-3 col-sm-6">
										<!-- ARTICLE -->
										<article class="article">
											<div class="article-img">
												<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
													<img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="" style="width: 100%; height: 180px;">
												</a>
												<ul class="article-info">
													<li class="article-type"><i class="fa fa-camera"></i></li>
												</ul>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"> <?php echo substr($row['tieuDe'], 0,50)."..." ?> </a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
												</ul>
											</div>
										</article>
										
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
									<?php
											}
										?>
									
								</div>
								<!-- /row -->
								
								<!-- row -->
								<div class="row">
								<?php
								$tinmoinhat = $db->tinMoiNhat(6);
								foreach ($tinmoinhat as $row) {
								?>		
									<!-- Column 1 -->
									<div class="col-md-4 col-sm-6">
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
													<img src="public/images/<?php echo $row['hinhAnh'] ?>"  alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
								<?php
									}
								?>
								</div>
								<!-- /row -->
							</div>
							<!-- /tab2 -->

							<!-- tab3 -->
							<div id="tab3" class="tab-pane fade">
								<!-- row -->
								<div class="row">
									<!-- Column 1 -->
									<?php
										$tinnoiBat3 = $db->tinMoiNhatTL1(3,4);
										foreach ($tinnoiBat3 as $row) {	
									?>	
									<div class="col-md-3 col-sm-6">
										<!-- ARTICLE -->
										<article class="article">
											<div class="article-img">
												<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
													<img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="" style="width: 100%; height: 180px;">
												</a>
												<ul class="article-info">
													<li class="article-type"><i class="fa fa-camera"></i></li>
												</ul>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"> <?php echo substr($row['tieuDe'], 0,50)."..." ?> </a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
												</ul>
											</div>
										</article>
										
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
									<?php
											}
										?>
									
								</div>
								<!-- /row -->
								
								<!-- row -->
								<div class="row">
								<?php
								$tinmoinhat = $db->tinMoiNhat(6);
								foreach ($tinmoinhat as $row) {
								?>		
									<!-- Column 1 -->
									<div class="col-md-4 col-sm-6">
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
													<img src="public/images/<?php echo $row['hinhAnh'] ?>"  alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
								<?php
									}
								?>
								</div>
								<!-- /row -->
							</div>
							<!-- /tab3 -->

							<!-- tab4 -->
							<div id="tab4" class="tab-pane fade">
								<!-- row -->
								<div class="row">
									<!-- Column 1 -->
									<?php
										$tinnoiBat4 = $db->tinMoiNhatTL1(4,4);
										foreach ($tinnoiBat4 as $row) {	
									?>	
									<div class="col-md-3 col-sm-6">
										<!-- ARTICLE -->
										<article class="article">
											<div class="article-img">
												<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
													<img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="" style="width: 100%; height: 180px;">
												</a>
												<ul class="article-info">
													<li class="article-type"><i class="fa fa-camera"></i></li>
												</ul>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"> <?php echo substr($row['tieuDe'], 0,50)."..." ?> </a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
												</ul>
											</div>
										</article>
										
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
									<?php
											}
										?>
									
								</div>
								<!-- /row -->
								
								<!-- row -->
								<div class="row">
								<?php
								$tinmoinhat = $db->tinMoiNhat(6);
								foreach ($tinmoinhat as $row) {
								?>		
									<!-- Column 1 -->
									<div class="col-md-4 col-sm-6">
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
													<img src="public/images/<?php echo $row['hinhAnh'] ?>"  alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
								<?php
									}
								?>
								</div>
								<!-- /row -->
							</div>
							<!-- /tab4 -->

							<!-- tab5 -->
							<div id="tab5" class="tab-pane fade">
								<!-- row -->
								<div class="row">
									<!-- Column 1 -->
									<?php
										$tinnoiBat5 = $db->tinMoiNhatTL1(5,4);
										foreach ($tinnoiBat5 as $row) {	
									?>	
									<div class="col-md-3 col-sm-6">
										<!-- ARTICLE -->
										<article class="article">
											<div class="article-img">
												<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
													<img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="" style="width: 100%; height: 180px;">
												</a>
												<ul class="article-info">
													<li class="article-type"><i class="fa fa-camera"></i></li>
												</ul>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"> <?php echo substr($row['tieuDe'], 0,50)."..." ?> </a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
												</ul>
											</div>
										</article>
										
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
									<?php
											}
										?>
									
								</div>
								<!-- /row -->
								
								<!-- row -->
								<div class="row">
								<?php
								$tinmoinhat = $db->tinMoiNhat(6);
								foreach ($tinmoinhat as $row) {
								?>		
									<!-- Column 1 -->
									<div class="col-md-4 col-sm-6">
										<!-- ARTICLE -->
										<article class="article widget-article">
											<div class="article-img">
												<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
													<img src="public/images/<?php echo $row['hinhAnh'] ?>"  alt="">
												</a>
											</div>
											<div class="article-body">
												<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h4>
												<ul class="article-meta">
													<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
												</ul>
											</div>
										</article>
										<!-- /ARTICLE -->
									</div>
									<!-- /Column 1 -->
								<?php
									}
								?>
								</div>
								<!-- /row -->
							</div>
							<!-- /tab5 -->
						</div>
						<!-- /tab content -->
					</div>
					<!-- /Main Column -->
				</div>
				<!-- /ROW -->
			</div>
			<!-- /CONTAINER -->
		</div>
		<!-- /SECTION -->
		
		<!-- SECTION -->
		<div class="section">
			<!-- CONTAINER -->
			<div class="container">
				<!-- ROW -->
				<div class="row">
					<!-- Main Column -->
					<div class="col-md-8">
						<!-- row -->
						<div class="row">
							<!-- Column 1 -->
							<div class="col-md-6 col-sm-6">
								<!-- section title -->
								<div class="section-title">
									<h2 class="title">News</h2>
								</div>
								<!-- /section title -->
								
								<!-- ARTICLE -->
								<?php
								$tinmoiTL = $db->tinMoiNhatTL1(1,1);
								foreach ($tinmoiTL as $row) {
								?>	
								<article class="article">
									<div class="article-img">
										<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
											<img src="public/images/<?php echo $row['hinhAnh'] ?>" style="width: 100%;height: 230px;" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-camera"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h3 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,80)."..." ?></a></h3>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
											<li><i class="fa fa-user"></i> <?php echo $row['author'] ?></li>
										</ul>
										<p style="font-family: Roboto;"><?php echo substr($row['noiDung'], 0,100) ?></p>
									</div>
								</article>
								<!-- /ARTICLE -->
								<?php
								}
								?>
								
								<?php
								$tinmoiTL = $db->tinMoiNhatTL1(1,3);
								foreach ($tinmoiTL as $row) {
								?>	
								<!-- ARTICLE -->
								<article class="article widget-article">
									<div class="article-img">
										<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
											<img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="">
										</a>
									</div>
									<div class="article-body">
										<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,80)."..." ?></a></h4>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
											<li><i class="fa fa-user"></i> <?php echo $row['author'] ?></li>
										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
								<?php
								}
								?>
								
							</div>
							<!-- /Column 1 -->
							
							<!-- Column 2 -->
							<div class="col-md-6 col-sm-6">
								<!-- section title -->
								<div class="section-title">
									<h2 class="title">SPORT</h2>
								</div>
								<!-- /section title -->
								
								<!-- ARTICLE -->
								<?php
								$tinmoiTL = $db->tinMoiNhatTL1(2,1);
								foreach ($tinmoiTL as $row) {
								?>	
								<article class="article">
									<div class="article-img">
										<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
											<img src="public/images/<?php echo $row['hinhAnh'] ?>" style="width: 100%;height: 230px;" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-camera"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h3 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,80)."..." ?></a></h3>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
											<li><i class="fa fa-user"></i> <?php echo $row['author'] ?></li>
										</ul>
										<p style="font-family: Roboto;"><?php echo substr($row['noiDung'], 0,100) ?></p>
									</div>
								</article>
								<!-- /ARTICLE -->
								<?php
								}
								$tinmoiTL = $db->tinMoiNhatTL1(2,3);
								foreach ($tinmoiTL as $row) {
								?>	
								<!-- ARTICLE -->
								<article class="article widget-article">
									<div class="article-img">
										<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
											<img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="">
										</a>
									</div>
									<div class="article-body">
										<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,80)."..." ?></a></h4>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
											<li><i class="fa fa-user"></i> <?php echo $row['author'] ?></li>
										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
								<?php
								}
								?>
							</div>
							<!-- /Column 2 -->
						</div>
						<!-- /row -->
						
						<!-- row -->
						<div class="row">
							<!-- section title -->
							<div class="col-md-12">
								<div class="section-title">
									<h2 class="title">FASHION</h2>
								</div>
							</div>
							<!-- /section title -->
							
							<?php
								$tinmoiTL = $db->tinMoiNhatTL1(4,2);
								foreach ($tinmoiTL as $row) {
							?>	
							<!-- Column 1 -->
							<div class="col-md-6 col-sm-6">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
											<img src="public/images/<?php echo $row['hinhAnh'] ?>" style="width: 100%; height: 280px;" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-camera"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h3 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h3>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
											<li><i class="fa fa-user"></i> by <?php echo $row['author'] ?></li>
										</ul>
										<p style="font-family: Roboto;"><?php echo substr($row['noiDung'], 0,100)."..." ?></p>
									</div>
								</article>
								<!-- /ARTICLE -->
							</div>
							<!-- /Column 1 -->
							<?php
							}
							?>	
						</div>
						<!-- /row -->
						
						<!-- row -->
						<div class="row">
							<?php
								$tinNN = $db->tinNgauNhien(4,3);
								foreach ($tinNN as $row) {
							?>	
							<!-- Column 1 -->
							<div class="col-md-4 col-sm-4">
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
											<img src="public/images/<?php echo $row['hinhAnh']?>" style="width: 100%; height: 180px;" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-file-text"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h4>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> <?php echo $row['time']?></li>
											<li><i class="fa fa-user"></i> <?php echo $row['author']?></li>
										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
							</div>
							<!-- /Column 1 -->
							<?php
							}
							?>
							
						</div>
						<!-- /row -->
					</div>
					<!-- /Main Column -->
					
					<!-- Aside Column -->
					<div class="col-md-4">
						<!-- Ad widget -->
						<div class="widget center-block hidden-xs">
							<img class="center-block" src="public/images/ad-1.jpg" alt=""> 
						</div>
						<!-- /Ad widget -->
						
						<!-- social widget -->
						<div class="widget social-widget">
							<div class="widget-title">
								<h2 class="title">Stay Connected</h2>
							</div>
							<ul>
								<li><a href="#" class="facebook"><i class="fa fa-facebook"></i><br><span>Facebook</span></a></li>
								<li><a href="#" class="twitter"><i class="fa fa-twitter"></i><br><span>Twitter</span></a></li>
								<li><a href="#" class="google"><i class="fa fa-google"></i><br><span>Google+</span></a></li>
								<li><a href="#" class="instagram"><i class="fa fa-instagram"></i><br><span>Instagram</span></a></li>
								<li><a href="#" class="youtube"><i class="fa fa-youtube"></i><br><span>Youtube</span></a></li>
								<li><a href="#" class="rss"><i class="fa fa-rss"></i><br><span>RSS</span></a></li>
							</ul>
						</div>
						<!-- /social widget -->
						
						<!-- subscribe widget -->
						<div class="widget subscribe-widget">
							<div class="widget-title">
								<h2 class="title">Subscribe to Newslatter</h2>
							</div>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="input-btn">Subscribe</button>
							</form>
						</div>
						<!-- /subscribe widget -->
						
						<!-- article widget -->
						<div class="widget">
							<div class="widget-title">
								<h2 class="title">FEATURED</h2>
							</div>
							
							<!-- owl carousel 3 -->
							<div id="owl-carousel-3" class="owl-carousel owl-theme center-owl-nav">
								<?php
									$hinhNN = $db->hinhNgauNhien();
									foreach ($hinhNN as $row) {
								?>	
								<!-- ARTICLE -->
								<article class="article">
									<div class="article-img">
										<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
											<img src="public/images/<?php echo $row['hinhAnh']?>" style="width: 100%;height: 250px;" alt="">
										</a>
										<ul class="article-info">
											<li class="article-type"><i class="fa fa-file-text"></i></li>
										</ul>
									</div>
									<div class="article-body">
										<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h4>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> <?php echo $row['time']?></li>
											<li><i class="fa fa-user"></i> <?php echo $row['author']?></li>
										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
								<?php
								}
								?>
							</div>
							<!-- /owl carousel 3 -->
							<?php
									$tinMN = $db->tinMoiNhat(6);
									foreach ($tinMN as $row) {
								?>	
							<!-- ARTICLE -->
							<article class="article widget-article">
								<div class="article-img">
									<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
										<img src="public/images/<?php echo $row['hinhAnh']?>" alt="">
									</a>
								</div>
								<div class="article-body">
									<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h4>
									<ul class="article-meta">
										<li><i class="fa fa-clock-o"></i> <?php echo $row['time']?></li>
										<li><i class="fa fa-user"></i> <?php echo $row['author']?></li>
									</ul>
								</div>
							</article>
							<!-- /ARTICLE -->
							<?php } ?>
						</div>
						<!-- /article widget -->
					</div>
					<!-- /Aside Column -->
				</div>
				<!-- /ROW -->
			</div>
			<!-- /CONTAINER -->
		</div>
		<!-- /SECTION -->
		
		<!-- AD SECTION -->
		<div class="visible-lg visible-md">
			<img class="center-block" src="public/images/ad-3.jpg" alt="">
		</div>
		<!-- /AD SECTION -->
		
		
		
		<!-- SECTION -->
		<div class="section">
			<!-- CONTAINER -->
			<div class="container">
				<!-- ROW -->
				<div class="row">
					<!-- Main Column -->
					<div class="col-md-8">
						<!-- section title -->
						<div class="section-title">
							<h2 class="title">Popular Posts</h2>
						</div>
						<!-- /section title -->
						<?php
							$total_rows = $db->countTinNgauNhienAll();
							$per_page = 4;
							if (isset($_GET['page']))
								{
									$page = $_GET['page'];
								}
							else
								{
									$page = 1;
								}
							$tinNNAll = $db->tinNgauNhienAll($page, $per_page);
							foreach ($tinNNAll as $row) {
						?>	
						<!-- ARTICLE -->
						<article class="article row-article">
							<div class="article-img">
								<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
									<img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="">
								</a>
							</div>
							<div class="article-body">
								<ul class="article-info">
									<li class="article-category"><a href="theloai.php?idTL=<?php echo $row['idTL'] ?>"><?php echo $row['tenTL'] ?></a></li>
									<li class="article-type"><i class="fa fa-file-text"></i></li>
								</ul>
								<h3 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h3>
								<ul class="article-meta">
									<li><i class="fa fa-clock-o"></i><?php echo $row['time'] ?></li>
									<li><i class="fa fa-user"></i><?php echo $row['author'] ?></li>
								</ul>
								<p style="font-family: Roboto;"><?php echo substr($row['noiDung'], 0,100)."..." ?></p>
							</div>
						</article>
						<!-- /ARTICLE -->
						
						<?php } ?>
						<!-- pagination -->
						<div class="article-pagination">
							<ul> 
							<?php
								$base_url = $_SERVER['PHP_SELF']."?";
								echo $db->create_links($base_url, $total_rows, $page, $per_page);
							?>
							</ul>
						</div>
						<!-- /pagination -->
					</div>
					<!-- /Main Column -->
					
					<!-- Aside Column -->
					<div class="col-md-4">
						<!-- article widget -->
						<div class="widget">
							<div class="widget-title">
								<h2 class="title">Featured Posts</h2>
							</div>
							
							<!-- owl carousel 4 -->
							<div id="owl-carousel-4" class="owl-carousel owl-theme">
								<?php
									$tinNoiBatNN = $db->tinNoiBatNgauNhien(2);
									foreach ($tinNoiBatNN as $row) {
								?>	
								<!-- ARTICLE -->
								<article class="article thumb-article">
									<div class="article-img">

										<img src="/public/images/<?php echo $row['hinhAnh'] ?>" alt="">
									</div>
									<div class="article-body">
										<h3 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h3>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
											<li><i class="fa fa-user"></i> <?php echo $row['author'] ?></li>
										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
								<?php } ?>
							</div>
							<!-- /owl carousel 4 -->
						</div>
						<!-- /article widget -->
						
						<!-- galery widget -->
						<div class="widget galery-widget">
							<div class="widget-title">
								<h2 class="title">Flickr Photos</h2>
							</div>
							<ul>
							<?php
								$tinNoiBatNN = $db->tinNoiBatNgauNhien(8);
								foreach ($tinNoiBatNN as $row) {
								?>	
								<li><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="" style="width: 100%;height: 60px;"></a></li>
								<?php } ?>
							</ul>
						</div>
						<!-- /galery widget -->
						
						<!-- tweets widget -->
						<div class="widget tweets-widget">
							<div class="widget-title">
								<h2 class="title">Recent Tweets</h2>
							</div>
							<ul>
								<li class="tweet">
									<i class="fa fa-twitter"></i>
									<div class="tweet-body">
										<p><a href="#">@magnews</a> Populo tritani laboramus ex mei, no eum iuvaret ceteros euripidis <a href="#">https://t.co/DwsTbsmxTP</a></p>
									</div>
								</li>
								<li class="tweet">
									<i class="fa fa-twitter"></i>
									<div class="tweet-body">
										<p><a href="#">@magnews</a> Populo tritani laboramus ex mei, no eum iuvaret ceteros euripidis <a href="#">https://t.co/DwsTbsmxTP</a></p>
									</div>
								</li>
								<li class="tweet">
									<i class="fa fa-twitter"></i>
									<div class="tweet-body">
										<p><a href="#">@magnews</a> Populo tritani laboramus ex mei, no eum iuvaret ceteros euripidis <a href="#">https://t.co/DwsTbsmxTP</a></p>
									</div>
								</li>
							</ul>
						</div>
						<!-- /tweets widget -->
					</div>
					<!-- /Aside Column -->
				</div>
				<!-- /ROW -->
			</div>
			<!-- /CONTAINER -->
		</div>
		<!-- /SECTION -->
		
		<!-- FOOTER -->
		<footer id="footer">
			<!-- Top Footer -->
			<div id="top-footer" class="section">
				<!-- CONTAINER -->
				<div class="container">
					<!-- ROW -->
					<div class="row">
						<!-- Column 1 -->
						<div class="col-md-4">
							<!-- footer about -->
							<div class="footer-widget about-widget">
								<div class="footer-logo">
									<a href="#" class="logo"><img src="./img/logo-alt.png" alt=""></a>
									<p>Populo tritani laboramus ex mei, no eum iuvaret ceteros euripidis, ne alia sadipscing mei. Te inciderint cotidieque pro, ei iisque docendi qui.</p>
								</div>
							</div>
							<!-- /footer about -->
							
							<!-- footer social -->
							<div class="footer-widget social-widget">
								<div class="widget-title">
									<h3 class="title">Follow Us</h3>
								</div>
								<ul>
									<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#" class="google"><i class="fa fa-google"></i></a></li>
									<li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
									<li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li>
									<li><a href="#" class="rss"><i class="fa fa-rss"></i></a></li>
								</ul>
							</div>
							<!-- /footer social -->
							
							<!-- footer subscribe -->
							<div class="footer-widget subscribe-widget">
								<div class="widget-title">
									<h2 class="title">Subscribe to Newslatter</h2>
								</div>
								<form>
									<input class="input" type="email" placeholder="Enter Your Email">
									<button class="input-btn">Subscribe</button>
								</form>
							</div>
							<!-- /footer subscribe -->
						</div>
						<!-- /Column 1 -->
						
						<!-- Column 2 -->
						<div class="col-md-4">
							<!-- footer article -->
							<div class="footer-widget">
								<div class="widget-title">
									<h2 class="title">Featured Posts</h2>
								</div>
								<?php
								$tinNoiBatNN = $db->tinNoiBatNgauNhien(3);
								foreach ($tinNoiBatNN as $row) {
								?>	
								<!-- ARTICLE -->
								<article class="article widget-article">
									<div class="article-img">
										<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
											<img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="">
										</a>
									</div>
									<div class="article-body">
										<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe']."...", 0,50) ?></a></h4>
										<ul class="article-meta">
											<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?></li>
											<li><i class="fa fa-user"></i> <?php echo $row['author'] ?></li>
										</ul>
									</div>
								</article>
								<!-- /ARTICLE -->
								<?php } ?>
							
							</div>
							<!-- /footer article -->
						</div>
						<!-- /Column 2 -->
						
						<!-- Column 3 -->
						<div class="col-md-4">
							<!-- footer galery -->
							<div class="footer-widget galery-widget">
								<div class="widget-title">
									<h2 class="title">Flickr Photos</h2>
								</div>
								<ul>
									<?php
								$tinNoiBatNN = $db->tinNoiBatNgauNhien(8);
								foreach ($tinNoiBatNN as $row) {
								?>	
								<li><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="" style="width: 100%;height: 60px;"></a></li>
								<?php } ?>
									
								</ul>
							</div>
							<!-- /footer galery -->
							
							<!-- footer tweets -->
							<div class="footer-widget tweets-widget">
								<div class="widget-title">
									<h2 class="title">Recent Tweets</h2>
								</div>
								<ul>
									<li class="tweet">
										<i class="fa fa-twitter"></i>
										<div class="tweet-body">
											<p><a href="#">@magnews</a> Populo tritani laboramus ex mei, no eum iuvaret ceteros euripidis <a href="#">https://t.co/DwsTbsmxTP</a></p>
										</div>
									</li>
								</ul>
							</div>
							<!-- /footer tweets -->
						</div>
						<!-- /Column 3 -->
					</div>
					<!-- /ROW -->
				</div>
				<!-- /CONTAINER -->
			</div>
			<!-- /Top Footer -->
			
			<!-- Bottom Footer -->
			<div id="bottom-footer" class="section">
				<!-- CONTAINER -->
				<div class="container">
					<!-- ROW -->
					<div class="row">
						<!-- footer links -->
						<div class="col-md-6 col-md-push-6">
							<ul class="footer-links">
								<li><a href="#">About us</a></li>
								<li><a href="#">Contact</a></li>
								<li><a href="#">Advertisement</a></li>
								<li><a href="#">Privacy</a></li>
							</ul>
						</div>
						<!-- /footer links -->
						
						<!-- footer copyright -->
						<div class="col-md-6 col-md-pull-6">
							<div class="footer-copyright">
								<span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
							</div>
						</div>
						<!-- /footer copyright -->
					</div>
					<!-- /ROW -->
				</div>
				<!-- /CONTAINER -->
			</div>
			<!-- /Bottom Footer -->
		</footer>
		<!-- /FOOTER -->
		
		<!-- Back to top -->
		<div id="back-to-top"></div>
		<!-- Back to top -->
		
		<!-- jQuery Plugins -->
		<script src="public/js/jquery.min.js"></script>
		<script src="public/js/bootstrap.min.js"></script>
		<script src="public/js/owl.carousel.min.js"></script>
		<script src="public/js/main.js"></script>

	</body>
</html>
