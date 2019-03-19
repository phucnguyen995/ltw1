<?php
 class newsprotype extends db
 {
 	public function addTheLoai($tenTL){
		//2. viet cau truy van
		$sql="INSERT INTO theloai(idTL, tenTL) VALUES (NULL, '$tenTL')";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
	}

	public function delTheLoai($idTL){
		//2. viet cau truy van
		$sql="DELETE FROM theloai WHERE idTL = '$idTL'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
	}

	public function editTheLoai($tenTL,$idTL){
		//2. viet cau truy van
		$sql="UPDATE theloai SET tenTL = '$tenTL' WHERE theloai.idTL = '$idTL'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		return $result;
	}

	public function infor_editTheLoai($idTL){
		//2. viet cau truy van
		$sql="SELECT * FROM `theloai` WHERE idTL = '$idTL'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		$arr = $result->fetch_assoc();
		return $arr;
	}

 	public function getNewsType(){
		//2. viet cau truy van
		$sql="SELECT * FROM theloai";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function addNews($tieude,$hinhanh,$noidung,$time,$author,$idTL,$tinnoibat){
		$sql = "INSERT INTO tintuc (id, tieuDe, hinhAnh, noiDung, `time`, author, idTL, tinnoibat) VALUES (NULL,'$tieude', '$hinhanh', '$noidung', '$time', '$author', '$idTL', '$tinnoibat')";
 		$result = self::$conn->query($sql);
 		return $result;
	}

	public function deleteNews($id){
		$sql = "DELETE FROM `tintuc` WHERE `tintuc`.`id` = '$id'";
 		$result = self::$conn->query($sql);
 		return $result;
	}

	public function editNews($id,$tieude,$hinhanh,$noidung,$time,$author,$idTL,$tinnoibat){
		if ($hinhanh == "")
		{
			$sql = "UPDATE tintuc SET tieuDe = '$tieude', noiDung = '$noidung', `time` = '$time', author = '$author', idTL = '$idTL', tinnoibat = '$tinnoibat' WHERE tintuc.id = '$id'";
		}
		else {
		$sql = "UPDATE tintuc SET tieuDe = '$tieude', hinhAnh = '$hinhanh', noiDung = '$noidung', `time` = '$time', author = '$author', idTL = '$idTL', tinnoibat = '$tinnoibat' WHERE tintuc.id = '$id'";
		}
 		$result = self::$conn->query($sql);
 		return $result;
	}

	public function infor_edit($id){
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc,theloai WHERE tintuc.id = '$id'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = $result->fetch_assoc();
		return $arr;
	}
 }
?>