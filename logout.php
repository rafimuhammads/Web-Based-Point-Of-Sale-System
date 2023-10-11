<?php
session_start();
session_destroy();
echo '<script>alert("Anda Berhasil Keluar");window.location="login.php"</script>';
?>