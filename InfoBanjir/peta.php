<?php
session_start();
$name = $_SESSION['username'];
$id = $_SESSION['id'];
if (empty($_SESSION['username'])) {
  header("location:/WEB_BANJIR/index.php?pesan=belum_login");
}

if ($_SESSION['user_level'] == 1) {
  header("location:petaAdmin.php");
}

include "koneksi.php";
include "inputPeta.php";

// Sesuaikan dengan konfigurasi koneksi Anda
// Pengambilan data dari database MySQL (tidak dipakai)
$query1 = "SELECT * FROM locations where location_status = 1  ";
$query2 = "SELECT COUNT(*) as total FROM locations where location_status = 1";

$select_banyak = mysqli_query($connect, $query2) or die(mysqli_error($connect));
if (mysqli_num_rows($select_banyak) > 0) {
  while ($row = mysqli_fetch_array($select_banyak)) {
    $total = $row["total"];
  }
}

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

  <script //src="http://maps.googleapis.com/maps/api/js"></script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoP52cgw3Kkc_Udf1dxu_Z_50-y8AeXPc&callback=initMap"></script>
  <script>
  // variabel global marker
  var marker;

  function taruhMarker(peta, posisiTitik) {

    if (marker) {
      // pindahkan marker
      marker.setPosition(posisiTitik);
    } else {
      // buat marker baru
      marker = new google.maps.Marker({
        position: posisiTitik,
        map: peta
      });
    }

    // isi nilai koordinat ke form
    document.getElementById("lat").value = posisiTitik.lat();
    document.getElementById("lng").value = posisiTitik.lng();

  }

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
          var content = '<h4><?php echo $lokasi; ?></h4> <br> <?php echo $waktu; ?> ';
          infowindow.setContent(content);
          infowindow.open(peta, marker);
        }
      })(marker));

      <?php
          }
        } ?>
    }

    // even listner ketika peta diklik
    google.maps.event.addListener(peta, 'click', function(event) {
      taruhMarker(this, event.latLng);
    });

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
      <a href="pengguna.php" class="profile" style="padding-left: 90%">
        <i class="fas fa-user"></i>
      </a>
    </nav>
    <!-- NAVBAR -->
    <main>
      <div class="head-title">
        <div class="left">
          <h1>Peta banjir</h1>
        </div>
      </div>

      <!-- <iframe src="../kontak/contact-form-06/index.php" frameborder="0"></iframe> -->
      <!-- peta -->
      <div id="googleMap" style="width:100%;height:380px;"></div>
      <br>

      <?php
      if (isset($_POST["submit"])) {
        if (tambah($_POST, $id) > 0) {
          echo "
        <script>
          alert('data berhasil ditambahkan!');
          document.location.href = 'peta.php';
        </script>
      ";
        } else {
          echo "
        <script>
          alert('data gagal ditambahkan!');
          document.location.href = 'peta.php';
        </script>
      ";
        }
      }
      // if (isset($_GET['pesan'])) {
      //   if ($_GET['pesan'] == "berhasilinput") {
      //     echo "<br>Anda telah berhasil melaporkan bencana banjir, silahkan tunggu verifikasi dari admin";
      //   } else if ($_GET['pesan'] == "gagalinput") {
      //     echo "Gagal menambahkan kejadian banjir";
      //   }
      // }
      ?>

      <form id="formulir" action="" method="post" enctype="multipart/form-data">
        <div>
          <label>Latitude</label>
          <input type="text" id="lat" name="lat" value="">
        </div>
        <div>
          <label>Longitude</label>
          <input type="text" id="lng" name="lng" value="">
        </div>
        <div>
          <label>Lokasi</label>
          <input type="text" id="lng" name="lokasi" value="">
        </div>
        <div class="form-group">
          <label>Kronologi</label>
          <br>
          <textarea style="height: 200px;" name="kronologi">
          </textarea>
        </div>
        <div class="form-group">
          <label>Waktu Kejadian</label>
          <input type="datetime-local" name="waktu">
        </div>
        <div class="form-group">
          <label for="foto">Foto*</label><br>
          <input type="file" name="foto" id="foto">
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Tambah">
      </form>
      <!-- end peta -->

    </main>
  </section>
  <!-- CONTENT -->

  <script src="script.js"></script>

</body>

</html>