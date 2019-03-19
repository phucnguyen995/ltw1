<?php
	require "../app/config.php";
  spl_autoload_register(function  ($class_name) {
  require "../app/".$class_name .'.php';
  });
  $user = new users();
	$id_user = $_GET['id_user'];
	$user->delUser($id_user);
	header('location:users-tab.php');
?>