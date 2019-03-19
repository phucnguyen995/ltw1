<?php 
  session_start();
  require "../app/config.php";
  spl_autoload_register(function  ($class_name) {
  require "../app/".$class_name .'.php';
  });
  $users = new users();
  if (isset($_SESSION['admin']))
  {
    header('location:../admin/index.php');
  }

?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title> Login</title>
      <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <div class="panda">
  <div class="ear"></div>
  <div class="face">
    <div class="eye-shade"></div>
    <div class="eye-white">
      <div class="eye-ball"></div>
    </div>
    <div class="eye-shade rgt"></div>
    <div class="eye-white rgt">
      <div class="eye-ball"></div>
    </div>
    <div class="nose"></div>
    <div class="mouth"></div>
  </div>
  <div class="body"> </div>
  <div class="foot">
    <div class="finger"></div>
  </div>
  <div class="foot rgt">
    <div class="finger"></div>
  </div>
</div>
<form action="" method="post">
  <div class="hand"></div>
  <div class="hand rgt"></div>
  <b><a style="text-decoration: none; font-size: 1.5em;" href="../index.php">Home News</a></b>
  <h1>Magnews Login</h1>
  <div class="form-group">
    <input name="txtusername" required="required" class="form-control"/>
    <label class="form-label">Username    </label>
  </div>
  <div class="form-group">
    <input id="password" type="password" name="txtpassword" required="required" class="form-control"/>
    <label class="form-label">Password</label>
    <p class="alert">Please wait...!!</p>
    <button class="btn" name="login" type="submit">Login </button>
  </div>
  <h3><a style="color: blue;" href="../customer-info/forgot-pass.php">Bạn quên mật khẩu?</a></h3>
  <h3 style="border: 1px solid #578EFF;background: #578EFF; display: inline-block; padding: 5px 10px 5px 10px;"><a style="text-decoration: none;color: #fff;" href="../register/register.html">Đăng ký</a></h3>
</form>
<?php
  if (isset($_POST['login']))
      {
        if (isset($_POST['txtusername'])){
            $txtusername = $_POST['txtusername'];
            $txtpassword = sha1($_POST['txtpassword']);

              $user = $users->getUser($txtusername);
              if ($users->login($txtusername, $txtpassword, $user['user'], $user['pass']) && $user['user_level'] == "admin"){
                $_SESSION['admin'] = $txtusername;
                header('location:../admin/index.php');
              }
              else if ($users->login($txtusername, $txtpassword, $user['user'], $user['pass']) && $user['user_level'] == "user")
              {
                if(isset($_GET['idTL']))
                {
                  $idTL = $_GET['idTL'];
                  $id = $_GET['id'];
                  $_SESSION['user'] = $txtusername;
                   header("Location:../post.php?idTL=".$idTL."&id=".$id);
                }
                else
                {
                  $_SESSION['user'] = $txtusername;
                   header("Location:../index.php");
                } 
              }
              else
              {
                 echo "<h2>Login fail!</h2>";
              }
          }
      }
 
?>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="js/index.js"></script>
</body>

</html>
