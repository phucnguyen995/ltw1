<?php
	require "../app/config.php";
  spl_autoload_register(function  ($class_name) {
  require "../app/".$class_name .'.php';
  });
  $user = new users();
	$id_user = $_GET['id_user'];
		if (isset($_POST['submit']))
	{
		$username = $_POST['username'];
		$pass = sha1($_POST['pass']);
		$email = $_POST['email'];
		$level = $_POST['user_level'];
		$edit = $user->editUser($id_user, $username, $pass, $email, $level);
		var_dump($edit);
		if (isset($edit))
		{
			echo "Edit thành công.";
		}
		else
		{
			echo "Edit thất bại.";
		}
		header('location:users-tab.php');
	}							
?>