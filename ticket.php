<?php

require 'function.php';
global $db;

if (isset($_SESSION["login"])) {
    $id = $_SESSION["login"];
    $status = $_GET["status"];
} else {
    $status = '';
    header("Location: index.php");
}

$check_kewarganegaraan = findRow("SELECT * FROM users WHERE Id_user='$id'", 'Kewarganegaraan');
$data = query("SELECT * FROM checkin WHERE id_user='$id'")

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkin</title>
    <link rel="stylesheet" href="CSS/ticket.css">
</head>

<body>
    <div class="ticket">
        <?php if ($status === 'diizinkan') : ?>
            <div class="title">
                <h2>Checkin Berhasil!</h2>
                <img src="img/check.png" alt="" srcset="">
            </div>
        <?php else : ?>
            <div class="title">
                <h2 style="color: #F44336;">Checkin Gagal!</h2>
                <img src="img/remove.png" alt="" srcset="">
            </div>
        <?php endif; ?>
        <!-- <div class="holes-top"></div> -->
        <div class="holes-lower"></div>
        <div class="ticket2">
            <?php foreach ($data as $key) : ?>
                <div class="data-ticket">
                    <h4>Nama</h4>
                    <p style="font-size: 15px;"><?= $key["Nama"] ?></p>
                </div>
                <?php if ($check_kewarganegaraan === 'indonesia') : ?>
                    <div class=" data-ticket">
                        <h4>Nik</h4>
                        <p style="font-size: 15px;"><?= $key["Nik"] ?></p>
                    </div>
                <?php else : ?>
                    <div class=" data-ticket">
                        <h4>Nomor_paspor</h4>
                        <p style="font-size: 15px;"><?= $key["Nomor_paspor"] ?></p>
                    </div>
                <?php endif; ?>
                <div class=" data-ticket">
                    <h4>Lokasi</h4>
                    <p style="font-size: 15px;"><?= $key["lokasi"] ?></p>
                </div>
                <div class="data-ticket">
                    <h4>tanggal & waktu/Hari ini</h4>
                    <p style="font-size: 15px;"><?= $key["tanggal"] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class=" holes-lower">
        </div>
        <p id="pesan">
            Selalu terapkan 3M <br>
            1. Mencuci tangan <br>
            2. Menjaga jarak <br>
            3. Memakai masker
        </p>
        <?php if ($status === 'diizinkan') : ?>
            <div class="btn" style="background-color: #0ED678;">
                <a href="index.php">SELESAI</a>
            </div>
        <?php else : ?>
            <div class="btn" style="background-color: #F44336;">
                <a href="index.php?status=gagal">SELESAI</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>