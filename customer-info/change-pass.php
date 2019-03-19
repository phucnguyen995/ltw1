<?php
session_start();
require "../app/config.php";
spl_autoload_register(function  ($class_name) {
  require "../app/".$class_name .'.php';
  });
$db = new db();
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
			if (validatePass() & validateRePassword()) {
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
		<br>
		<a style="text-decoration: none; font-size: 1.5em; color: blue;"  href="customer.php?"> >Go to Account< </a>
		<form action="" method="POST" class="form-horizontal" role="form" onsubmit="return validateForm();">
				<div class="form-group">
					<legend>Change pass</legend>
				</div>
				
				<div class="form-group">
					<label for="passhientai" class="control-label col-sm-2"> Pass hiện tại </label>
					<div class="col-sm-10">
						<input type="password" name="passhientai" id="passhientai" class="form-control" placeholder="Your pass" aria-required="true" required="required">
						<span style="color: red;"></span>
					</div>
				</div>

				<div class="form-group">
					<label for="password" class="control-label col-sm-2"> Pass mới </label>
					<div class="col-sm-10 ">
						<input type="password" name="passwordnew" id="password" aria-required="true" required="required" placeholder="Password" class="form-control" onkeyup="validatePass()">
						<span style="color: red;"></span>
					</div>
				</div>

				<div class="form-group">
					<label for="repasswordnew" class="control-label col-sm-2">Retype Password</label>
					<div class="col-sm-10">
						<input type="password" name="repasswordnew" id="repassword" placeholder="Retype Password" aria-required="true" required="required" class="form-control">
						<span style="color: red;"></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button name="change" type="submit" class="btn btn-primary">Change</button>
					</div>
				</div>
		</form>
		<?php
			$username = $_SESSION['user'];
			$us = $user->getUser($username);
			$passhientai = $us['pass'];
			if (isset($_POST['change']))
			{
				$inputpass = $_POST['passhientai'];
				$check = $user->checkPass($inputpass);
				if ($check == 0)
				{
					echo "Pass hiện tại không chính xác!!!";
				}
				else if ($check > 0)
				{
					
					$pass = sha1($_POST['passwordnew']);
					if ($pass == $passhientai)
					{
						echo "Password mới không thể trùng với password cũ. Vui lòng nhập lại!!";
					}
					else 
					{
						$change = $user->changePass($username, $pass);
						echo "Thay đổi mật khẩu thành công";
					}
				}
				else
				{
					echo "Thay đổi mật khẩu thất bại vui lòng thử lại!!!";
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