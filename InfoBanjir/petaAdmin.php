<?php
session_start();
$name = $_SESSION['username'];
$id = $_SESSION['id'];
if (empty($_SESSION['username'])) {
  header("location:/WEB_BANJIR/index.php?pesan=belum_login");
}

include "koneksi.php";
?>


<?php
// Sesuaikan dengan konfigurasi koneksi Anda
// Pengambilan data dari database MySQL
$query1 = "SELECT * FROM locations where location_status = 1  ";
$query2 = "SELECT COUNT(*) as total FROM locations where location_status = 1";

$select_banyak = mysqli_query($connect, $query2) or die(mysqli_error($connect));
if (mysqli_num_rows($select_banyak) > 0) {
  while ($row = mysqli_fetch_array($select_banyak)) {
    $total = $row["total"];
  }
}

$query3 = "SELECT COUNT(*) as totalUser FROM users";
$banyak_user = mysqli_query($connect, $query3) or die(mysqli_error($connect));
if (mysqli_num_rows($banyak_user) > 0) {
  while ($row = mysqli_fetch_array($banyak_user)) {
    $totalUser = $row["totalUser"];
  }
}

// $select_laporan = mysqli_query($connect, $query1) or die(mysqli_error($connect));
// if (mysqli_num_rows($select_laporan) > 0) {
//   while ($row = mysqli_fetch_array($select_laporan)) {
//     $id = $row["id"];
//     // $userid = $row["userid"];
//     $lat  = $row["lat"];
//     $lng = $row["lng"];
//     // $description = $row["description"];
//     // $waktu = $row["waktu"];
//     // $lokasi = $row["waktu"];


?>

<?php
// // Fetch the marker info from the database
// $result = $connect->query("SELECT * FROM locations where location_status = 1");

// // Fetch the info-window data from the database
// $result2 = $connect->query("SELECT * FROM locations where location_status = 1");
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

  <title>Pelaporan</title>

  <script //src="http://maps.googleapis.com/maps/api/js"></script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoP52cgw3Kkc_Udf1dxu_Z_50-y8AeXPc&callback=initMap"></script>



  <script>
  function initialize() {
    var propertiPeta = {
      center: new google.maps.LatLng(-6.242783, 106.821243),
      zoom: 5,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

    // membuat Marker
    for (let i = 0; i <= <?php echo $total; ?>; i++) {
      <?php
        $select_laporan = mysqli_query($connect, $query1) or die(mysqli_error($connect));
        if (mysqli_num_rows($select_laporan) > 0) {
          while ($row = mysqli_fetch_array($select_laporan)) {
            $id = $row["id"];
            $lat  = $row["lat"];
            $lng = $row["lng"];
            $lokasi = $row["lokasi"];
            $waktu = $row["waktu"];
            $description = $row["description"];

        ?>
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),
        map: peta,
        title: '<?php echo $lokasi; ?>',

      });


      // mebuat konten untuk info window
      var contentString = '<h4><?php echo $lokasi; ?></h4>';

      // membuat objek info window
      var infowindow = new google.maps.InfoWindow({
        content: contentString,
        position: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),
        maxWidth: 1000,
      });


      google.maps.event.addListener(marker, 'click', (function(marker) {
        return function() {
          var content = '<h4><?php echo $lokasi; ?></h4> <br> <?php echo $waktu; ?> <br>  ';
          infowindow.setContent(content);
          infowindow.open(peta, marker);
        }
      })(marker));

      <?php
          }
        }
        ?>
    }

  }

  // event jendela di-load  
  google.maps.event.addDomListener(window, 'load', initialize);
  </script>


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
      <li class="active">
        <a href="petaAdmin.php">
          <i class='bx bxs-doughnut-chart'></i>
          <span class="text">Pelaporan</span>
        </a>
      </li>
      <li>
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
      <div class="head-title">
        <div class="left">
          <h1>Pelaporan Bencana Banjir</h1>
        </div>
      </div>

      <ul class="box-info">
        <li>
          <i class='bx bxs-calendar-check'></i>
          <span class="text">
            <h3><?php echo $total; ?></h3>
            <p>Bencana Terkonfirmasi</p>
          </span>
        </li>
        <li>
          <i class='bx bxs-group'></i>
          <span class="text">
            <h3><?php echo $totalUser; ?></h3>
            <p>Pengguna</p>
          </span>
        </li>
      </ul>

      <br><br>

      <h3>Peta Bencana Banjir</h3><br>
      <!-- tampilin maps -->
      <div id="googleMap" style="width:100%;height:380px;"></div>

      <?php
      if (isset($_SESSION['user_level'])) {
        $currentrole = $_SESSION['user_level'];
      }
      if ($currentrole == 0) {
        echo "<script>
        alert('HANYA ADMIN YANG DAPAT MENGAKSES HALAMAN PENGGUNA!');
        window.location.href = './peta.php';
      </script>";
      } else if ($currentrole == 1) {
      ?>
      <div id="wrapper">
        <div id="page-wrapper">
          <div style="height: 600px;" class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                  <br><br><h3>Data Laporan Belum Terkonfirmasi</h3><br>
                  <table class="tabel-baru">
                    <tr>
                      <th>No</th>
                      <th>userid</th>
                      <th>lat</th>
                      <th>Lng</th>
                      <th>Lokasi</th>
                      <th>Foto</th>
                      <th>Kronologi</th>
                      <th>status</th>
                      <th>Konfirmasi</th>
                    </tr>
                    <?php
                      $query = "SELECT * FROM locations WHERE location_status = 0";
                      $select_lokasi = mysqli_query($connect, $query) or die(mysqli_error($connect));
                      $i = 1;
                      if (mysqli_num_rows($select_lokasi) > 0) {
                        while ($row = mysqli_fetch_array($select_lokasi)) {
                          $id = $row['id'];
                          $userid = $row['userid'];
                          $lat = $row['lat'];
                          $lng = $row['lng'];
                          $lokasi = $row['lokasi'];
                          $foto = $row['foto'];
                          $description = $row['description'];
                          $location_status = $row['location_status'];


                          echo "<tr>";
                          echo "<td>$i</td>";
                          echo "<td>$userid</td>";
                          echo "<td>$lat</td>";
                          echo "<td>$lng</td>";
                          echo "<td>$lokasi</td>";
                      ?>
                    <td><img src="img/<?php print_r($foto); ?>" width="100px" alt=" <?= $foto ?>"></td>
                    <?php
                          echo "<td>$description</td>";
                          echo "<td>$location_status</td>";

                          echo "<td><a onClick=\"javascript: return confirm('Apakah anda yakin?')\" href='petaAdmin.php?confirm=$id'></i><button>confirm</button></a></td>";
                          echo "</tr>";
                          $i++;
                        }
                      }
                      ?>

                  </table>

                <?php

                // delete data
                if (isset($_GET['confirm'])) {
                  $the_confirm_id = $_GET['confirm'];
                  $query = "UPDATE locations SET location_status=1 WHERE id = '$the_confirm_id'";
                  $confirm_query = mysqli_query($connect, $query) or die(mysqli_error($connect));
                  if (mysqli_affected_rows($connect) > 0) {
                    echo "<script>alert('Laporan berhasil dikonfirmasi!');
                      window.location.href= 'petaAdmin.php';</script>";
                  }
                }
              }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>
  </section>
  <!-- CONTENT -->

  <script src="script.js"></script>
</body>

</html>