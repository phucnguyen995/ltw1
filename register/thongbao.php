<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Thông báo tạo tài khoản</title>
</head>
<body>
	<div class="container">
			<br>
			<h2><a href="../index.php"><img src="../public/images/logo.png" alt=""></a></h2>
			<h3><a href="../index.php"> Về Trang chủ </a></h3>
			<h3><a href="../login/index.php">Đăng nhập</a></h3>
			<br>
			<?php
				if (isset($_SESSION['registerFail']))
				{
					?>
					<h3 style="color: red;"><?php echo $_SESSION['registerFail']?></h3>
					<h3>Bạn có muốn đăng kí lại</h3>
					<h3><a href='register.html'>Đăng ký</a></h3>
				<?php
				}
				else
				{
				 ?>
				<h3>Bạn đã đăng ký thành công có muốn đăng nhập để bình luận bài viết</h3>
				<h3><a href="../login/index.php">Đăng nhập</a></h3>
			<?php } ?>
	</div>
</body>
</html>