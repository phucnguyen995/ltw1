<?php
	require "../app/config.php";
  	spl_autoload_register(function  ($class_name) {
  require "../app/".$class_name .'.php';
  });

  $protype = new newsprotype();

	$id = $_GET['id'];
	if (isset($_POST['submit']))
	{
		if(isset($_FILES['hinhAnh'])){
		$errors= array();
	    $file_name = $_FILES['hinhAnh']['name'];
	    $file_tmp = $_FILES['hinhAnh']['tmp_name'];
								       
	   	$hinhanh = $_FILES['hinhAnh']['name'];
							      	
		}
		else{
				$hinhanh = "";
		}
		$tieude = $_POST['tieuDe'];
		$noidung = $_POST['noiDung'];
		$time = $_POST['time'];
		$author = $_POST['author'];
		$idTL = $_POST['idTL'];
		$tinnoibat = $_POST['tinnoibat'];
		$edit = $protype->editNews($id,$tieude,$hinhanh,$noidung,$time,$author,$idTL,$tinnoibat);

		if (isset($edit))
		{
	        move_uploaded_file($file_tmp,"../public/images/".$file_name);
		}
		header('location:index.php');
	}
?>