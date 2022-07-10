<?php
session_start();
include "koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];
$query = mysqli_query($connect, "SELECT userid, user_level FROM users WHERE username = '$username'
    && password = '$password'") or die(mysqli_error($connect));
$cek = mysqli_num_rows($query);
$Array = mysqli_fetch_array($query);
$userid = $Array[0];
$user_level = $Array[1];

if ($cek > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['id'] = $userid;
    $_SESSION['user_level'] = $user_level;
    header("location:/WEB_BANJIR/infoBanjir/home.php");
} else {
    header("location:index.php?pesan=gagal");
}