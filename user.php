<?php
include "config.php";
session_start();
  if($_SESSION['role']==""){
		header("location:login.php");
	} else if($_SESSION['role']!="admin"){
    echo '<script>history.go(-1);</script>';
  }
?>
<?php include 'sidebar.php'; ?>
<!-- isinya -->
    <h1 class="h3 mb-0">
        Data User
        <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#TambahUser">Tambah User</button>
    </h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
<thead>
  <tr>
    <th>No</th>
    <th>Profile</th>
    <th>Nama</th>
    <th>Telepon</th>
    <th>Alamat</th>
    <th>Status</th>
    <th>Opsi</th>
  </tr>
</thead>
<tbody>
<?php 
    $no = 1;
    $data_user = mysqli_query($conn,"SELECT * FROM tb_login ORDER BY id ASC");
    while($d = mysqli_fetch_array($data_user)){
        ?>
  <tr>
    <td><?php echo $no++; ?></td>
    <td class="text-center"><img src="assets/images/<?php echo $d['logo']; ?>" class="coverku" alt="logo"></td>
    <td><?php echo $d['username']; ?></td>
    <td><?php echo $d['telepon']; ?></td>
    <td><?php echo $d['alamat']; ?></td>
    <td><?php echo $d['role']; ?></td>
    <td>
        <button type="button" class="btn btn-primary btn-xs mr-1" data-toggle="modal" data-target="#EditUser<?php echo $d['id']; ?>">
        <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
        </button>
        <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $d['id']; ?>">
        <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
    </td>
  </tr>
  <!-- Modal Tambah Produk -->
<div class="modal fade" id="EditUser<?php echo $d['id']; ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <div class="modal-header bg-purple">
        <h5 class="modal-title text-white">Edit User</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pb-1">
      <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#PageProfile<?php echo $d['id']; ?>" style="letter-spacing: 1px;">
                <i class="fa fa-image mr-1"></i> Profile</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#PageAkun<?php echo $d['id']; ?>" style="letter-spacing: 1px;">
                <i class="fa fa-user mr-1"></i> Account</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#PagePassword<?php echo $d['id']; ?>" style="letter-spacing: 1px;">
            <i class="fa fa-lock mr-1"></i> Password</a>
            </li>
        </ul>
        <div class="tab-content pt-3">
            <div id="PageProfile<?php echo $d['id']; ?>" class="tab-pane active">
            <form method="post" action="proses-logo1.php" enctype="multipart/form-data">
                <div class="text-center">
                <input type="hidden" name="id2" value="<?php echo $d['id']; ?>">
                <label for="logoku<?php echo $d['id']; ?>"><img src="assets/images/<?php echo $d['logo']; ?>" alt="logo" style="width: 200px;height: 200px;object-fit: cover;" class="rounded img-thumbnail"></label>
                <input type="file" class="d-none" id="logoku<?php echo $d['id']; ?>" onchange="form.submit()" name="file" />
                </div>
            </form>
            </div>
            <div id="PageAkun<?php echo $d['id']; ?>" class="tab-pane">
            <form method="post">
            <div class="form-group row">
            <input type="hidden" name="id3" value="<?php echo $d['id']; ?>">
            <label class="col-4 col-sm-3 col-form-label mb-2">Username</label>
            <div class="col-8 col-sm-9 mb-2 pl-0">
            <input type="text" name="username2" value="<?php echo $d['username']; ?>" class="form-control" required>
            </div>
            <label class="col-4 col-sm-3 col-form-label mb-2">Telepon</label>
            <div class="col-8 col-sm-9 mb-2 pl-0">
            <input type="number" name="telepon2" value="<?php echo $d['telepon']; ?>" class="form-control" required>
            </div>
            <label class="col-4 col-sm-3 col-form-label mb-2">Alamat</label>
            <div class="col-8 col-sm-9 mb-2 pl-0">
            <input type="text" name="alamat2" value="<?php echo $d['alamat']; ?>" class="form-control" required>
            </div>
            <label class="col-4 col-sm-3 col-form-label mb-2">Status</label>
            <div class="col-8 col-sm-9 mb-2 pl-0">
                <select name="role2" class="form-control" required>
                <?php if($d['role']=='admin'){
                      echo '<option value="admin">Admin</option>
                      <option value="karyawan">Karyawan</option>';
                      } else {
                        echo '
                        <option value="karyawan">Karyawan</option>
                        <option value="admin">Admin</option>';
                  } ?>
                </select>
            </div>
            <div class="col-12 text-right">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" name="SimpanAkun">Simpan</button>
            </div>
        </div>
            </form>
            </div>
            <div id="PagePassword<?php echo $d['id']; ?>" class="tab-pane">
            <form method="post">
            <div class="form-group row">
            <input type="hidden" name="id4" value="<?php echo $d['id']; ?>">
            <label class="col-4 col-sm-3 col-form-label mb-2">Password</label>
            <div class="col-8 col-sm-9 pl-0 mb-2">
            <input type="password" name="password2" class="form-control" required>
            </div>
            <label class="col-4 col-sm-3 col-form-label mb-2">Konfirmasi</label>
            <div class="col-8 col-sm-9 pl-0 mb-2">
            <input type="password" name="password3" class="form-control" required>
            </div>
            <div class="col-12 text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="SimpanPass">Simpan</button>
            </div>
        </div>
            </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end Modal Produk -->
  <?php } ?>
</tbody>
</table>
<?php 
if(isset($_POST['TambahUser']))
{
    $username1 = htmlspecialchars($_POST['username1']);
    $telepon1 = htmlspecialchars($_POST['telepon1']);
    $alamat1 = htmlspecialchars($_POST['alamat1']);
    $role1 = htmlspecialchars($_POST['role1']);
    $password1 = htmlspecialchars($_POST['password1']);

    $cekkode = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tb_login WHERE username='$username1'"));
    if($cekkode > 0) {
        echo '<script>alert("Maaf! username sudah ada");history.go(-1);</script>';
    } else {
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
            $nama = $_FILES['file']['name'];
            $x = explode('.', $nama);
            $ekstensi = strtolower(end($x));
            $ukuran	= $_FILES['file']['size'];
            $file_tmp = $_FILES['file']['tmp_name'];	

            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                if($ukuran < 100440700){			
                    move_uploaded_file($file_tmp, 'assets/images/'.$nama);
                    $queryAdd =  mysqli_query($conn,"INSERT INTO tb_login (username,telepon,alamat,role,logo,password)
                    values ('$username1','$telepon1','$alamat1','$role1','$nama','$password1')") or die(mysqli_connect_error());
                    if($queryAdd){
                        echo '<script>window.location="user.php"</script>';
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
        };
if(isset($_POST['SimpanAkun'])){
    $id3 = htmlspecialchars($_POST['id3']);
    $username2 = htmlspecialchars($_POST['username2']);
    $telepon2 = htmlspecialchars($_POST['telepon2']);
    $alamat2 = htmlspecialchars($_POST['alamat2']);
    $role2 = htmlspecialchars($_POST['role2']);

    $CariProduk = mysqli_query($conn,"SELECT * FROM tb_login WHERE username='$username2' and id!='$id3'");
    $HasilData = mysqli_num_rows($CariProduk);

    if($HasilData > 0){
        echo '<script>alert("Maaf! username sudah ada");history.go(-1);</script>';
    } else{
        $cekDataUpdate =  mysqli_query($conn, "UPDATE tb_login SET username='$username2',
        telepon='$telepon2',alamat='$alamat2',role='$role2'
         WHERE id='$id3'") or die(mysqli_connect_error());
        if($cekDataUpdate){
          echo '<script>window.location="user.php"</script>';
        } else {
            echo '<script>alert("Gagal Edit Data");history.go(-1);</script>';
        }
    }
};

if(isset($_POST['SimpanPass'])){
  $id4 = htmlspecialchars($_POST['id4']);
  $password2 = $_POST['password2'];
  $password3 = htmlspecialchars($_POST['password3']);
  if ($password2==$password3){
    $cekPass =  mysqli_query($conn, "UPDATE tb_login SET password='$password3'
        WHERE id='$id4'") or die(mysqli_connect_error());
        if($cekPass){
            echo '<script>alert("Password Berhasil di update");window.location="user.php"</script>';
        } else {
            echo '<script>alert("Gagal update password");history.go(-1);</script>';
        } 
    }else {
    echo "<script>alert('Password yang Anda Masukan Tidak Sama');history.go(-1)</script>";
     }
}; 

	if(!empty($_GET['hapus'])){
		$iduserku = $_GET['hapus'];
		$hapus_data = mysqli_query($conn, "DELETE FROM tb_login WHERE id='$iduserku'");
        if($hapus_data){
          echo '<script>window.location="user.php"</script>';
        } else {
            echo '<script>alert("Gagal Hapus Data");history.go(-1);</script>';
        }
	};
    ?>
<!-- Modal Tambah Produk -->
<div class="modal fade" id="TambahUser" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
        <form method="post" enctype="multipart/form-data">
      <div class="modal-header bg-purple">
        <h5 class="modal-title text-white">Tambah User</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
            <label class="col-4 col-sm-3 col-form-label mb-2">Username</label>
            <div class="col-8 col-sm-9 mb-2 pl-0">
            <input type="text" name="username1" class="form-control" required>
            </div>
            <label class="col-4 col-sm-3 col-form-label mb-2">Telepon</label>
            <div class="col-8 col-sm-9 mb-2 pl-0">
            <input type="number" name="telepon1" class="form-control" required>
            </div>
            <label class="col-4 col-sm-3 col-form-label mb-2">Alamat</label>
            <div class="col-8 col-sm-9 mb-2 pl-0">
            <input type="text" name="alamat1" class="form-control" required>
            </div>
            <label class="col-4 col-sm-3 col-form-label mb-2">Status</label>
            <div class="col-8 col-sm-9 mb-2 pl-0">
                <select name="role1" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="karyawan">Karyawan</option>
                </select>
            </div>
            <label class="col-4 col-sm-3 col-form-label mb-2">Profile</label>
            <div class="col-8 col-sm-9 mb-2 pl-0">
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="customFile" required>
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            </div>
            <label class="col-4 col-sm-3 col-form-label">Password</label>
            <div class="col-8 col-sm-9 pl-0">
            <input type="password" name="password1" class="form-control" required>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" name="TambahUser" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal Produk -->

<!-- end isinya -->
<?php include 'footer.php'; ?>