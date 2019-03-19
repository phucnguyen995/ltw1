<?php
 class users extends db
 {
 	public function getUser($user){
		//2. viet cau truy van
		$sql="SELECT * FROM users WHERE user = '$user'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = $result->fetch_assoc();
		return $arr;
	}

	public function login($txtusername, $txtpassword, $user, $pass){
			//$hash = sha1($pass);
			//if ($txtusername == $user && hash_equals($txtpassword, $hash) == true)
			$hash = password_hash($pass,PASSWORD_DEFAULT);
			if ($txtusername == $user && password_verify($txtpassword, $hash))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

	public function comments($name, $mess, $id){
		//2. viet cau truy van
		$sql="INSERT INTO comments (id_cm, name , mess , time_cm, id) VALUES (NULL, '$name', '$mess', now(), $id);";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		return $result;
	}
	public function getComment($id){
		//2. viet cau truy van
		$sql="SELECT * FROM comments WHERE id = '$id' ORDER BY id_cm ASC";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

	public function addUser($username, $pass, $email){
		//2. viet cau truy van
		$sql="INSERT INTO users(id_user, user, pass, email, user_level) VALUES (NULL, '$username', '$pass', '$email', 'user')";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		return $result;
	}

	public function checkUser($username){
		$sql="SELECT * FROM users WHERE user = '$username'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//Tra ve so dong
		return $result->num_rows;

	}

	public function checkPass($pass){
		$sql="SELECT * FROM users WHERE pass = sha1('$pass')";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//Tra ve so dong
		return $result->num_rows;

	}

	public function checkEmail($email){
		$sql="SELECT * FROM users WHERE email = '$email'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//Tra ve so dong
		return $result->num_rows;

	}

	public function getEmail($email){
		//2. viet cau truy van
		$sql="SELECT * FROM users WHERE email = '$email'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = $result->fetch_assoc();
		return $arr;
	}

	public function changePass($user,$pass){
		//2. viet cau truy van
		$sql="UPDATE users SET pass = '$pass' WHERE users.user = '$user'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		return $result;
	}

	public function editUser($idUser,$user,$pass,$email,$user_level){
		//2. viet cau truy van
		$sql="UPDATE users SET user = '$user', pass = '$pass', email = '$email', user_level = '$user_level' WHERE users.id_user = '$idUser' ";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		return $result;
	}

	public function delUser($idUser){
		//2. viet cau truy van
		$sql="DELETE FROM users WHERE users.id_user = '$idUser'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		return $result;
	}

	public function delComment($idcm){
		//2. viet cau truy van
		$sql="DELETE FROM comments WHERE id_cm = '$idcm'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		return $result;
	}

	public function showAdmin(){
		//2. viet cau truy van
		$sql="SELECT * FROM users WHERE user_level = 'admin'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}

		public function showTabUser(){
		//2. viet cau truy van
		$sql="SELECT * FROM users WHERE user_level = 'user'";
		//3.Thuc thi cau truy van
		$result = self::$conn->query($sql);
		//4.Chuyen object thanh mang
		$arr = array();
		while($row = $result->fetch_assoc()){
			$arr[] = $row;
		}
		return $arr;
	}
 }
?>