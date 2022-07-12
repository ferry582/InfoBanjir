<?php
session_start();
$name = $_SESSION['username'];
$id = $_SESSION['id'];
if (empty($_SESSION['username'])) {
  header("location:/WEB_BANJIR/index.php?pesan=belum_login");
}

include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Boxicons -->
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <!-- My CSS -->
  <link rel="stylesheet" href="style.css">


  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <title>Data Banjir</title>
</head>

<body>
  <!-- SIDEBAR -->
  <section id="sidebar">
    <a href="#" class="brand">
      <img width="130px" src="img/logo-01.png" alt="" style="vertical-align:middle;margin:20px 60px">
    </a>
    <ul class="side-menu top">
      <li>
        <a href="home.php">
          <i class='bx bxs-dashboard'></i>
          <span class="text">Beranda</span>
        </a>
      </li>
      <li>
        <a href="peta.php">
          <i class='bx bxs-doughnut-chart'></i>
          <span class="text">Pelaporan</span>
        </a>
      </li>
      <li class="active">
        <a href="grafik.php">
          <i class='bx bxs-message-dots'></i>
          <span class="text">Data Banjir</span>
        </a>
      </li>
      <li>
        <a href="pengguna.php">
          <i class='bx bxs-group'></i>
          <span class="text">Pengguna</span>
        </a>
      </li>
    </ul>
    <ul class="side-menu">
      <li>
        <a href="/WEB_BANJIR/logout.php" class="logout">
          <i class='bx bxs-log-out-circle'></i>
          <span class="text">Keluar</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- SIDEBAR -->

  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class='bx bx-menu'></i>
      <a href="pengguna.php" class="profile" style="padding-left: 92%">
        <i class="fas fa-user"></i>
      </a>
    </nav>
    <!-- NAVBAR -->
    <main>
      <!-- grafik -->
      <h2 style="text-align: center; margin-top: 50px; margin-bottom: 30px">Grafik Intensitas Banjir Indonesia 2019-2021
      </h2>
      <iframe style="height:550px; width:100%; border: none;" src="grafik/index.html" frameborder="0"></iframe>
      <h2 style="text-align: center; margin-top: 50px; margin-bottom: 30px">Grafik Intensitas banjir Indonesia 2011-2020
      </h2>
      <iframe style="height:550px; width:100%; border: none;" src="https://databoks.katadata.co.id/datapublishembed/116995/intensitas-bencana-banjir-di-indonesia-selama-10-tahun-terakhir"></iframe>

      <!-- peta -->
      <h2 style="text-align: center; margin-top: 50px; margin-bottom: 30px">Peta Daerah Berpotensi Banjir</h2>
      <iframe src="map/map_potensi_banjir.html" frameborder="0"></iframe>
      <br>
  </section>
  <!-- CONTENT -->

  <script src="script.js"></script>
</body>

</html>