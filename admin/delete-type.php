<?php
	require "../app/config.php";
	//require "../app/db.php";
	spl_autoload_register(function  ($class_name) {
	  require "../app/".$class_name .'.php';
	  });
	$protype = new newsprotype();
	$idTL = $_GET['idTL'];
	$protype->delTheLoai($idTL);
	header('location:protype.php');
?>