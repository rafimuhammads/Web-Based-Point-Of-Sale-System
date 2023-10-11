<?php
include "config.php";
session_start();
	if($_SESSION['role']==""){
		header("location:login.php");
	} else {
    $uid = $_POST['id2'];
    $ekstensi_diperbolehkan	= array('png','jpg');
    $nama = $_FILES['file']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];	

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 100440700){			
            move_uploaded_file($file_tmp, 'assets/images/'.$nama);
            $query =  mysqli_query($conn, "UPDATE tb_login SET logo='$nama' WHERE id='$id'") or die(mysqli_connect_error());
            if($query){
                echo '<script>history.go(-1);</script>';
            }else{
                echo '<script>alert("GAGAL MENGUPLOAD GAMBAR");history.go(-1);</script>';
            }
        }else{
            echo '<script>alert("UKURAN FILE TERLALU BESAR");history.go(-1);</script>';
        }
    }else{
        echo '<script>alert("EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN");history.go(-1);</script>';
    }
}
?>