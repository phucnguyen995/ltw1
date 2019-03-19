<?php
	require "../app/config.php";
	spl_autoload_register(function  ($class_name) {
	require "../app/".$class_name .'.php';
	});

	$id = $_GET['id'];
	$protype = new newsprotype();
	$protype->deleteNews($id);
	if (!isset($_SESSION['admin']))
	{
		header('location:index.php');
	}
?>