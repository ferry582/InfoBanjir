<?php
session_start();
$name = $_SESSION['username'];
$id = $_SESSION['id'];
if (empty($_SESSION['username'])) {
  header("location:/WEB_BANJIR/index.php?pesan=belum_login");
}

include "koneksi.php";

if ($_SESSION['user_level'] == 1) {
  header("location:penggunaAdmin.php");
}


$pengguna = mysqli_query($connect, "SELECT * FROM users WHERE userid = $id");

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

  <title>AdminHub</title>
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
      <li>
        <a href="grafik.php">
          <i class='bx bxs-message-dots'></i>
          <span class="text">Grafik</span>
        </a>
      </li>
      <li class="active">
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
      <a href="#" class="profile" style="padding-left: 90%">
        <i class="fas fa-user"></i>
      </a>
    </nav>
    <!-- NAVBAR -->
    <main>
      <div class="head-title">
        <div class="left">
          <h1>Pengguna</h1>
        </div>
      </div>

      <!-- Tabel -->

      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3>Profil Pengguna</h3>
          </div>
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Pengguna</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>NIK</th>
              </tr>
            </thead>

            <tbody>
              <?php $i = 1 ?>
              <?php foreach ($pengguna as $user) : ?>
              <tr>
                <td> <?php echo ($i); ?> </td>
                <td>
                  <p> <?= $user["nama"] ?> </p>
                </td>
                <td><?= $user["email"] ?></td>
                <td><?= $user["alamat"] ?></td>
                <td><?= $user["nik"] ?></td>
              </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </section>
  <!-- CONTENT -->

  <script src="script.js"></script>
</body>

</html>