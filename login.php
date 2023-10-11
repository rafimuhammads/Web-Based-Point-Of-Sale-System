<?php
	@ob_start();
	session_start();
  include 'config.php';
	if($_SESSION['role']!=""){
		echo '<script>history.go(-1);</script>';
	}
    if(isset($_POST['login'])){
      $user = $_POST['username'];
      $pass = $_POST['password'];
      $login = mysqli_query($conn,"SELECT* FROM tb_login WHERE username='$user' and password='$pass'");
      $cek = mysqli_num_rows($login);
      if($cek > 0){
        $data = mysqli_fetch_assoc($login);
        if($data['role']=="admin"){
       
          $_SESSION['username'] = $user;
          $_SESSION['id'] = $data['id'];
          $_SESSION['role'] = "admin";
          header("location:laporan.php");
       
        }else if($data['role']=="karyawan"){
          $_SESSION['username'] = $user;
          $_SESSION['id'] = $data['id'];
          $_SESSION['role'] = "karyawan";
          header("location:index.php");
        }else{
          echo '<script>alert("Data yang anda masukan salah");history.go(-1);</script>';
        }	
      }else{
        echo '<script>alert("Username atau password salah");history.go(-1);</script>';
      }
      };
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="assets/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <style>
        html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background: #4c6ef8;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
    </style>
</head>
<body class="text-center">

    <form class="form-signin" method="POST">
      <h1 class="h2 mb-4 text-white">
        <?php $DataToko = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tb_toko"));
        echo ''.$DataToko['nama_toko'].''; ?>
      </h1>
      <div class="form-group mb-2">
        <label for="inputuser" class="sr-only">Username</label>
        <input type="text" id="inputuser" name="username" class="form-control" placeholder="Username" required autofocus>
      </div>
      <div class="form-group mb-2">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      </div>
      <button class="btn btn-warning btn-block" name="login" style="font-weight:700;" type="submit">Masuk</button>
      <p class="mt-3 mb-3 text-white">&copy; 2022 Developed by - <a target="_blank" rel="noopener noreferrer" href="https://RMS.com" class="text-white">
     RMS</a></p>
    </form>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>