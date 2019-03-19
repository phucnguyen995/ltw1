<?php
	require "../app/config.php";
  spl_autoload_register(function  ($class_name) {
  require "../app/".$class_name .'.php';
  });
  $user = new users();
	$idcm = $_GET['id_cm'];
    $delcm = $user->delComment($idcm);

	header('location:comments-tab.php');
?>