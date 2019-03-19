<?php
session_start();
	require "../app/config.php";
  	spl_autoload_register(function  ($class_name) {
  require "../app/".$class_name .'.php';
  });

  $protype = new newsprotype();
  if (isset($_POST['submit']))
	{
		$tieuDe = $_POST['tieuDe'];
		if(isset($_FILES['hinhAnh'])){

			$file_name = $_FILES['hinhAnh']['name'];
			$file_tmp = $_FILES['hinhAnh']['tmp_name'];

								       
			$hinhAnh = $_FILES['hinhAnh']['name'];
		}
		$noiDung = $_POST['noiDung'];
		$time = $_POST['time'];
		$author = $_POST['author'];
		$idTL = $_POST['idTL'];
		$tinnoibat = $_POST['tinnoibat'];

		$add = $protype->addNews($tieuDe,$hinhAnh,$noiDung,$time,$author,$idTL,$tinnoibat);
		if (isset($add))
		{
			var_dump($add);
			move_uploaded_file($file_tmp,"../public/images/".$file_name);
			header('location:index.php');
		}
	}
?>