<?php
//require "config.php";
	class db{
	//tao bien ket noi
	public static $conn;
	//1.Ket noi trong ham construct
	public function __construct(){
		//self::$conn = new mysqli("localhost","root","","magnews");
		self::$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		//hien thi tieng viet
		self::$conn->set_charset('utf8');
	}

	public function tenTheLoai(){
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

	public function tinNoiBat($count){
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc WHERE tinnoibat = 1 ORDER BY id DESC LIMIT 0,$count";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function tinNgauNhien($TL,$count){
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc WHERE idTL = $TL ORDER BY RAND() LIMIT $count";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function tinNoiBatNgauNhien($count){
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc WHERE tinNoiBat = 1 ORDER BY RAND() LIMIT $count";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function tinNgauNhienAll($page, $per_page){
		$first_link = ($page - 1) * $per_page;
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc,theloai WHERE tintuc.idTL = theloai.idTL ORDER BY RAND() LIMIT $first_link,$per_page";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function countTinNgauNhienAll(){
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc ORDER BY RAND()";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		return $result->num_rows;
	}

	public function hinhNgauNhien(){
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc WHERE hinhAnh ORDER BY RAND()";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function tinMoiNhat($count){
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc, theloai WHERE tintuc.idTL = theloai.idTL ORDER BY id DESC LIMIT $count";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function tinTheoLoai($idTL){
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc WHERE idTL = $idTL";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function chiTiet($id){
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc,theloai WHERE tintuc.idTL = theloai.idTL AND tintuc.id = $id ";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}
	
	public function tinMoiNhatTL($count, $idTL){
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc,theloai WHERE tintuc.idTL = theloai.idTL AND theloai.idTL = $idTL LIMIT 0,$count";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function tinMoiNhatTL1($idTL, $count){
		$sql="SELECT * FROM tintuc WHERE idTL = $idTL ORDER BY id DESC LIMIT 0,$count";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function displayAll($page, $per_page){
		//Tinh so thu tutrang bat dau
		$first_link = ($page - 1) * $per_page;
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc ORDER BY `tintuc`.`id` DESC LIMIT $first_link,$per_page";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

		public function displayAllTab($tab, $id ,$page, $per_page){
		//Tinh so thu tutrang bat dau
		$first_link = ($page - 1) * $per_page;
		//2. viet cau truy van
		$sql="SELECT * FROM $tab ORDER BY $id DESC LIMIT $first_link,$per_page";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}
	
	public function search($key, $page, $per_page){
		$first_link = ($page - 1) * $per_page;
		//2. viet cau truy van
		$sql="SELECT * FROM tintuc WHERE tieuDe LIKE '%".$key."%' LIMIT $first_link,$per_page";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function searchTB($key, $tab, $where ,$page, $per_page){
		$first_link = ($page - 1) * $per_page;
		//2. viet cau truy van
		$sql="SELECT * FROM $tab WHERE $where LIKE '%".$key."%' LIMIT $first_link,$per_page";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function countSearchTB($key, $tab, $where){
		$sql="SELECT * FROM $tab WHERE $where LIKE '%".$key."%'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//Tra ve so dong
		return $result->num_rows;
	}

	public function countSearch($key){
		$sql="SELECT * FROM tintuc WHERE tieuDe LIKE '%".$key."%'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//Tra ve so dong
		return $result->num_rows;
	}

	public function getData($obj){
				$arr = array();
		while($row = $obj->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function count($tab){
		$sql="SELECT * FROM $tab";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//Tra ve so dong
		return $result->num_rows;
	}

	public function create_links ($base_url, $total_rows, $page, $per_page){
		$total_links = ceil($total_rows/$per_page);
		$link ="";
		for($j=1; $j <= $total_links ; $j++)
		{
			if ($j == $page)
			{
				$link = $link."<li class='active'><a href='".$base_url."page=$j'> $j </a></li>";
			}
			else
			{
				$link = $link."<li><a href='".$base_url."page=$j'> $j </a></li>";
			}
		}
		return $link;
	}

	//5.Dong ket noi
	public function __destruct(){
		//self::$conn->close();
	}
}