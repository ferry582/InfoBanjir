<?php

include "koneksi.php";

function upload()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // cek jika tidak ada gambar yang tidak di upload
    if ($error === 4) {
        echo "<script>
						alert('pilih foto terlebih dahulu!');
					</script>";
        return false;
    }

    // cek apakah file yang di apload adalah gambar 
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    // expload memecah string menjadi array
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
						alert('ekstensi tidak didukung!');
					</script>";
        return false;
    }

    // cek jika ukuranya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
						alert('ukuran gambar terlalu besar!');
					</script>";
        return false;
    }

    // generate nama gambar baru 
    // $namaFileBaru = uniqid();
    // $namaFileBaru .= '.';
    // $namaFileBaru .= $ekstensiGambar;

    // lolos pengecekan, maka file siap di upload 
    move_uploaded_file($tmpName, 'img/' . $namaFile);
    return $namaFile;
}

// tambah data
function tambah($data, $id)
{
    global $connect;
    $userid = $id;
    $lat = htmlspecialchars($data["lat"]);
    $lng = htmlspecialchars($data["lng"]);
    $kronologi = htmlspecialchars($data["kronologi"]);
    $waktu = htmlspecialchars($data["waktu"]);
    $lokasi = htmlspecialchars($data["lokasi"]);
    // $gambar = htmlspecialchars($data["gambar"]);

    //cek apakah form kosong
    if($lat == null || $lng == null || $kronologi == null || $waktu == null || $lokasi == null) {
        return false;
    }

    // upload gambar 
    $foto = upload();
    if (!$foto) {
        return false;
    }
    
    // query insert data 
    $query = "INSERT INTO locations VALUES 
  ('','$userid','$lat','$lng','$kronologi','','$waktu','$lokasi','$foto')
  ";
    // untuk query nya tidak perlu titik koma seperti di cmd
    mysqli_query($connect, $query);
    return mysqli_affected_rows($connect);
}




// $query = mysqli_query($connect, "INSERT INTO locations VALUES ('','$id','$lat','$lng','$kronologi','','$waktu','$lokasi')")
//     or die(mysqli_error($connect));
// if ($query) {
//     header("location: peta.php?pesan=berhasilinput");
// } else {
//     header("location: peta.php?pesan=gagalinput");
// }