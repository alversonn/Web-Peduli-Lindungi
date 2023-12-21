<?php

require 'function.php';

if (!isset($_SESSION["login"])) {
    header('Location: login_form.php');
}
$id = $_SESSION["login"];

if (isset($_POST["submit"])) {
    cekStatus($_POST, $id);
}


$query = query("SELECT * FROM users WHERE Id_user='$id'");
$checkin = query("SELECT * FROM checkin");
$checkin_encode = json_encode($checkin);

echo "
    <script>
        var checkin = $checkin_encode
    </script>
";


$tz = 'Asia/Jakarta';
$dt = new DateTime("now", new DateTimeZone($tz));
$timestamp = $dt->format('Y-m-d G:i:s');


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/biodata.css">
    <link rel="icon" href="img/logo.ico" type="image/icon type">
    <title>Checkin</title>
</head>

<body onload="ambilLokasi();">
    <div class="container">
        <?php foreach ($query as $q) : ?>
            <iframe frameborder="0" id="frame" width="100%" height="350"></iframe>
            <form action="" method="POST">
                <div class="title">
                    <h2>Check In</h2>
                    <p style="color: red;">masuk ke ruang publik</p>
                </div>
                <div class="input-group">
                    <label for="nama-lengkap">Nama Lengkap</label>
                    <input type="text" id="nama-lengkap" value="<?= $q["Nama"] ?>" name="nama_lengkap">
                </div>
                <div class="input-group">
                    <label for="thi">Tanggal&Waktu/Hari ini</label>
                    <input type="text" id="thi" value="<?= $timestamp ?>" name="thi">
                </div>
                <div class="input-group" id="spesial">
                    <label for="lokasi">Lokasi Saat ini</label>
                    <input type="text" id="lokasi" name="lokasi">
                </div>
                <div class="input-group">
                    <label for="total_keramaian">Total Keramaian</label>
                    <input type="text" id="total_keramaian" name="total_keramaian" value="0  / 1000">
                </div>
                <input type="hidden" id="Nik" value="<?= $q["Nik"] ?>" name="Nik">
                <input type="hidden" id="Nomor_paspor" value="<?= $q["Nomor_paspor"] ?>" name="Nomor_paspor">
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                <div class="input-group">
                    <button type="submit" name="submit">Check In</button>
                </div>
            </form>
        <?php endforeach; ?>
    </div>
    <script src="JS/script.js"></script>
</body>

</html>