<?php
function ribuan ($nilai){
  return number_format ($nilai, 0, ',', '.');
}
$id = $_SESSION['id'];
$DataLogin = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tb_login WHERE id='$id'"));
$username = $DataLogin['username'];
$alamat = $DataLogin['alamat'];
$telepon = $DataLogin['telepon'];
$logo = $DataLogin['logo'];
$rule = $DataLogin['role'];

$DataToko = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tb_toko"));
$nama_toko = $DataToko['nama_toko'];
$alamat_toko = $DataToko['alamat_toko'];
$telp_toko = $DataToko['telp_toko'];
$deskripsi_toko = $DataToko['deskripsi_toko'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kasir Metrix</title>
    <link rel="icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-primary border-0" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#"><i class="fas fa-shopping-cart mr-1"></i><?php echo $nama_toko ?></a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic" style="height:70px;width:70px;">
          <img class="img-responsive img-rounded" src="assets/images/<?php echo $logo ?>"
            alt="User picture">
        </div>
        <div class="user-info">
          <span class="user-name"><?php echo $username ?>
          </span>
          <span class="user-role"><?php echo $rule ?></span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
      </div>
      <!-- sidebar-header  -->

      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>
          <?php 
   if($_SESSION['role']=='admin'){
    ?>
          <li>
            <a href="produk.php">
            <i class="fas fa-archive"></i>
              <span>Produk</span>
            </a>
          </li>
          <li>
            <a href="laporan.php">
              <i class="fa fa-chart-line"></i>
              <span>Laporan</span>
            </a>
          </li>
          <li>
            <a href="user.php">
              <i class="fa fa-user"></i>
              <span>User</span>
            </a>
          </li>
          <li>
            <a href="pengaturan.php">
              <i class="fa fa-cog"></i>
              <span>Pengaturan</span>
            </a>
          </li>
     <?php 
    } else if($_SESSION['role']=='karyawan'){
      ?>
      <li>
        <a href="index.php">
          <i class="fas fa-tv"></i>
          <span>Transaksi</span>
        </a>
      </li>
      <li>
        <a href="pengaturan.php">
          <i class="fa fa-cog"></i>
          <span>Pengaturan</span>
        </a>
      </li>
      <?php 
    } else {
      echo '<script>history.go(-1);</script>';
    }
     ?>
          <li>
            <a href="#Exit" data-toggle="modal">
              <i class="fa fa-power-off"></i>
              <span>Keluar</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <div class="sidebar-footer">
    © 2022 Developed by - <a target="_blank" rel="noopener noreferrer" href="https://RMS.com">
     RMS</a>
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">

    <div class="d-block d-sm-block d-md-none d-lg-none py-2"></div>