<?php
session_start();
require "../app/config.php";
spl_autoload_register(function  ($class_name) {
  require "../app/".$class_name .'.php';
  });
$user = new users();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Change Password</title>
	<link rel="stylesheet" href="public/css/bootstrap.min.css">

	<script type="text/javascript" src="public/js/jquery.min.js"></script>
	<script type="text/javascript">
		function validateForm() {
			if (validateFullname() & validatePass() & validateRePassword()) {
				return true;
			}
			else {
				return false;
			}
		}

		function validatePass() {
			var field = $('#password').val();
			var filter = /^.{6,}$/;

			if (!filter.test(field)) {
				$('#password').parent().parent().addClass('has-error');
				$('#password').parent().parent().removeClass('has-success');
				$('#password').next().html('Pass có ít nhất 6 kí tự!');
				return false;
			}
			else {
				$('#password').parent().parent().removeClass('has-error');
				$('#password').parent().parent().addClass('has-success');
				$('#password').next().html('');
				return true;
			}
		}


		function validateEmail() {
			var field = $('#email').val();
			var filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[a-z]{2,4})+$/;

			if (!filter.test(field)) {
				$('#email').parent().parent().addClass('has-error');
				$('#email').parent().parent().removeClass('has-success');
				$('#email').next().html('Email không đúng định dạng');
				return false;
			}
			else {
				$('#email').parent().parent().removeClass('has-error');
				$('#email').parent().parent().addClass('has-success');
				$('#email').next().html('');
				return true;
			}
		}

		function validateRePassword() {
			var psw = $('#password').val();
			var repsw = $('#repassword').val();

			if (repsw != psw) {
				$('#repassword').parent().parent().addClass('has-error');
				$('#repassword').parent().parent().removeClass('has-success');
				$('#repassword').next().html('Password không trùng nhau');
				return false;
			}
			else {
				$('#repassword').parent().parent().removeClass('has-error');
				$('#repassword').parent().parent().addClass('has-success');
				$('#repassword').next().html('');
				return true;
			}
		}
	</script>
</head>
<body>
	<div class="container">
		<a href="../index.php"><img src="../public/images/logo.png" alt=""></a>
		<form action="" method="POST" class="form-horizontal" role="form" onsubmit="return validateForm();">
				<div class="form-group">
					<legend>Forgot Password</legend>
				</div>
				
				<div class="form-group">
					<label for="email" class="control-label col-sm-2">Email</label>
					<div class="col-sm-10">
						<input type="text" name="email" id="email" class="form-control" aria-required="true" required="required" placeholder="Your email" onkeyup="validateEmail()">
						<span style="color: red;" ></span>
					</div>
				</div>

				<div class="form-group">
					<label for="password" class="control-label col-sm-2">Password</label>
					<div class="col-sm-10">
						<input type="password" name="password" id="password" aria-required="true" required="required" placeholder="Password" class="form-control" onkeyup="validatePass()">
						<span style="color: red;" ></span>
					</div>
				</div>

				<div class="form-group">
					<label for="repassword" class="control-label col-sm-2">Retype Password</label>
					<div class="col-sm-10">
						<input type="password" name="repassword" id="repassword" placeholder="Retype Password" aria-required="true" required="required" class="form-control">
						<span style="color: red;" ></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button name="submit" type="submit" class="btn btn-primary">Set pass</button>
					</div>
				</div>
		</form>
		<?php
			
			if (isset($_POST['submit']))
			{
				$email = $_POST['email'];
				$em = $user->getEmail($email);
				$check = $user->checkEmail($email);
				if ($check == 0)
				{
					echo "Email hiện tại không chính xác!!!";
				}
				else if ($check > 0)
				{
					$pass = sha1($_POST['password']);
					$change = $user->changePass($em['user'], $pass);
					if (isset($change))
					{
						echo "Lấy lại mật khẩu thành công. ";
						echo "Bạn có muốn đăng nhập <a href='../login/index.php'> >Đăng nhập< </a>";
					}
				}
				else
				{
					echo "Lấy lại mật khẩu thất bại vui lòng thử lại!!!<br>";
				}

			}
		 ?>
</div>
<br><br><br><br>
<footer>
	<div style="text-align: center; padding: 10px; "> 2018 &copy; FIT TDC - Lập trình web 1</div>
</footer>
		
</body>
</html>