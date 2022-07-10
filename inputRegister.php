<?php
include "koneksi.php";
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$alamat = $_POST['alamat'];
$query = mysqli_query($connect, "INSERT INTO users VALUES ('','$nama','$nik','$username','$email','$password','$alamat','')")
    or die(mysqli_error($connect));
if ($query) {
    header("location: index.php?pesan=berhasildaftar");
} else {
    echo "Input Gagal!";
}
?>