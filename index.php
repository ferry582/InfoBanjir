<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Info Banjir Website</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="form">

    <ul class="tab-group">
      <li class="tab "><a href="#signup">Daftar</a></li>
      <li class="tab active"><a href="#login">Masuk</a></li>
    </ul>

    <div class="tab-content">

    <div id="login">
        <h1>Selamat Datang Kembali</h1>

        <form action="cekLogin.php" method="post">

          <div class="field-wrap">
            <label>
              Username<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name="username"/>
          </div>

          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>

          <p class="forgot" style="color: #f8c000;">
          <?php
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan'] == "berhasildaftar") {
              echo "<br>Anda telah berhasil mendaftar, silahkan Log In";
            } else if ($_GET['pesan'] == "logout") {
              echo "Anda telah berhasil Log out";
            } else if ($_GET['pesan'] == "belum_login") {
              echo "Anda harus Login terlebih dahulu!";
            } else if ($_GET['pesan'] == "gagal") {
              echo "Login gagal! username atau password salah!";
            }
          }
          ?></p>
          <br><br>
          <button class="button button-block" />Masuk</button>

        </form>

      </div>

      <div id="signup">
        <h1>Silahkan Mendaftar</h1>

        <form method="post" action="inputRegister.php">

          <div class="field-wrap">
            <label>
              Nama Lengkap<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name="nama"/>
          </div>

          <div class="field-wrap">
            <label>
              Username<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name="username" />
          </div>

          <div class="field-wrap">
            <label>
              NIK<span class="req">*</span>
            </label>
            <input type="nik" required autocomplete="off" name="nik" />
          </div>

          <div class="field-wrap">
            <label>
              Alamat<span class="req">*</span>
            </label>
            <input type="text" required autocomplete="off" name="alamat"/>
          </div>

          <div class="field-wrap">
            <label>
              Alamat Email<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name="email"/>
          </div>

          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>

          <button type="submit" class="button button-block" />DAFTAR!</button>

        </form>

      </div>

    </div><!-- tab-content -->

  </div> <!-- /form -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="script.js"></script>
</body>

</html>