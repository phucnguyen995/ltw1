<?php
	session_start();
	require "../app/config.php";
	spl_autoload_register(function  ($class_name) {
	  require "../app/".$class_name .'.php';
	  });
	$user = new users();
	if (isset($_SESSION['registerFail']))
	{
		unset($_SESSION['registerFail']);
	}
	$checkUser = $user->checkUser($_POST['username']);
	$checkEmail = $user->checkEmail($_POST['email']);

	if (isset($_POST['register']))
	{
		if ($checkUser > 0 || $checkEmail > 0)
		{
			$_SESSION['registerFail'] = "Trùng tên tài khoản hoặc email.Đăng kí thất bại!";
			header('location:thongbao.php');
		}
		else
		{
			$username = $_POST['username'];
			$pass = sha1($_POST['password']);
			$email = $_POST['email'];
			$user->addUser($username, $pass, $email);
			header('location:thongbao.php');
		}
	}
?>