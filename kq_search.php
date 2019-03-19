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

		<title>Magnews Detail</title>

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
								<li><a href="customer-info/customer.php"><i class="fa fa-cog"></i> My Profile</a></li>
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
							<a href="#" class="logo"><img src="public/images/logo-alt.png" alt=""></a>
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

		<!-- SECTION -->
		<div class="section">
			<!-- CONTAINER -->
			<div class="container">
				<!-- ROW -->
				<div class="row">
					<div class="col-md-8">
						<!-- section title -->
						<div class="section-title">
							<h2 class="title">Search Result</h2>
						</div>
						<!-- /section title -->
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
						<!-- ARTICLE -->
						<article class="article row-article">
							<div class="article-img">
								<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
									<img src="public/images/<?php echo $row['hinhAnh'] ?>" alt="">
								</a>
							</div>
							<div class="article-body">
								<h3 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></a></h3>
								<ul class="article-meta">
									<li><i class="fa fa-clock-o"></i><?php echo $row['time'] ?></li>
									<li><i class="fa fa-user"></i><?php echo $row['author'] ?></li>
								</ul>
								<p><?php echo substr($row['noiDung'], 0,100)."..." ?></p>
							</div>
						</article>
						<!-- /ARTICLE -->
						
						<?php }
							if ($total_rows == 0)
							{
								echo "<h1>Không tìm thấy kết quả nào với : ".$key . "!</h1>";
							}
						 ?>
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
					
					<!-- Aside Column -->
					<div class="col-md-4">
						
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
								<!-- ARTICLE -->
								<?php
									$hinhNN = $db->hinhNgauNhien();
									foreach ($hinhNN as $row) {
								?>	
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
								<?php } ?>
							</div>
							<!-- /owl carousel 3 -->
							
							<!-- ARTICLE -->
							<?php
									$tinMN = $db->tinMoiNhat(6);
									foreach ($tinMN as $row) {
								?>	
							<article class="article widget-article">
								<div class="article-img">
									<a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>">
										<img src="public/images/<?php echo $row['hinhAnh']?>" alt="">
									</a>
								</div>
								<div class="article-body">
									<h4 class="article-title"><a href="post.php?idTL=<?php echo $row['idTL'] ?>&id=<?php echo $row['id'] ?>"><?php echo substr($row['tieuDe'], 0,50)."..." ?></h4>
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
									<a href="#" class="logo"><img src="public/images/logo-alt.png" alt=""></a>
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
