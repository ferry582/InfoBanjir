<?php
session_start();

require 'koneksi.php';
$id = $_GET["id"];

function hapus($id)
{
  global $connect;
  mysqli_query($connect, "DELETE FROM users WHERE userid=$id");
  return mysqli_affected_rows($connect);
}
if (hapus($id) > 0) {
  echo "
      <script>
				alert('Data berhasil dihapus!');
				document.location.href = 'penggunaAdmin.php';
			</script>
  ";
} else {
  echo " 
      <script>
				alert('Data gagal dihapus!');
				document.location.href = 'penggunaAdmin.php';
			</script>
  ";
}