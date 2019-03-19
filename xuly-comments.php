<?php 
	require "app/config.php";
	spl_autoload_register(function  ($class_name) {
	  require "app/".$class_name .'.php';
	  });
	$user = new users();
	$id = $_GET['id'];
	session_start();
	if (isset($_POST['send']))
	{
		$name = $_SESSION['user'];
		$mess = $_POST['mess'];
		$cm = $user->comments($name, $mess, $id);
		header('location:'.$_SERVER['HTTP_REFERER']);
	}							
		
?>

