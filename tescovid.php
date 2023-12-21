<?php
 
require 'function.php';

if (!isset($_SESSION["login"])) {
    header("Location: login_form.php");
}
$id_user = $_SESSION["login"];

$users = query("SELECT * FROM users WHERE Id_user='$id_user'");
$Photo_profile = findRow("SELECT Photo_profile FROM users WHERE Id_user='$id_user'", "Photo_profile");

$result = query("SELECT * FROM users_status WHERE id_user='$id_user'");
$status_kesehatan = findRow("SELECT * FROM users_status WHERE id_user='$id_user'",'Status_kesehatan');
$status_vaksinasi = findRow("SELECT * FROM users_status WHERE id_user='$id_user'",'Status_vaksinasi');
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Test Covid</title>
    <link rel="icon" href="img/logo.ico" type="image/icon type">
    <link rel="stylesheet" href="CSS/tescovid.css">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <div class="icon">

                </div>
                <a href="index.php" style="text-decoration : none; color : #269AD7" ><h3>PeduliLindungi</h3></a>
            </div>
            <div class="atasan">
                <a href="index.php#beranda">Beranda</a>
                <a href="index.php#tentang">Tentang</a>
                <a href="index.php#statistik">Statistik</a>
                <a href="index.php#Bahasa">Bahasa</a>
            </div>
            <?php if (isset($_SESSION["login"])) : ?>
                <?php foreach ($users as $user) : ?>
                    <div class="account">
                        <div class="photo-profil">
                            <?php if (strlen($Photo_profile) > 1) : ?>
                                <div class="custom" style="background-image: url(img/user-pic/<?= $user["Photo_profile"] ?>);">

                                </div>
                            <?php else : ?>
                                <div class="default">
                                    <h4><?= substr($user["Nama"], 0, 1) ?></h4>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (strlen($user["Nama"]) >= 11) : ?>
                            <h3><?= substr($user["Nama"], 0, 11) ?>..</h3>
                            <img src="img/sort-down.png" class="dropdown" alt="" srcset="">
                        <?php else : ?>
                            <h3><?= $user["Nama"] ?></h3>
                            <img src="img/sort-down.png" class="dropdown" alt="" srcset="">
                        <?php endif; ?>
                        <div class="dropbtn">
                            <div class="dropdown-content">
                                <a href="account.php">
                                    <img src="img/login.png" alt="">
                                    Profil
                                </a>
                                <a href="logout.php">
                                    <img src="img/exit.png" alt="">
                                    Keluar
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="not_login">
                        <a href="login_form.php">Login</a>/
                        <a href="register_form.php">Register</a>
                    </div>
                <?php endif; ?>
        </div>
        <!-- <div class="bg-container">
            <img src="img/background-home.svg" alt="" srcset="">
        </div> -->
        <div class="group-col">
        <!-- <div class="col1">
                <div class="foto-profile">

                </div>
                <div class="nama">
                    <img src="img/pengguna.png" alt="" srcset="">
                    <h3>Ariel Anaskar</h3>
                </div>
                <div class="nik">
                    <img src="img/credit-card.png" alt="" srcset="">
                    <p>3123462156252353</p>
                </div>
                <p id="caption-col1">Hasil tes COVID-19? Hasil tes ini adalah untuk mengecek kesehatan dari pengguna PeduliLindungi.</p>
            </div> -->
            <div class="col2">
                <div class="header-col2">
                    <h2>Status vaksinasi & tes COVID-19</h2>
                </div>
                <div class="main">
                    <div class="group-col2">
                        <div class="group-tex">
                            <p id="head-namatanggal">Nama NIK & Tanggal Lahir</p>
                            <?php foreach ($users as $key): ?>
                                <div class="nama-col2">
                                    <p><pre>Nama Lengkap    :  <?= $key["Nama"] ?></pre></p>
                                </div>
                                <div class="nik-col2">
                                    <p><pre>NIK                           :  <?= $key["Nik"] ?></pre></p>
                                </div>
                                <div class="ttl-col2">
                                    <p><pre>Tanggal Lahir       :  <?= $key["Tanggal_lahir"] ?></pre></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php foreach ($users as $key): ?>
                            <?php if (strlen($Photo_profile) > 1): ?>
                                <div class="foto-profile" style="background-image: url(img/user-pic/<?= $key["Photo_profile"] ?>);">
                                    
                                </div>
                            <?php else: ?>
                                <div class="foto-profile" style="background-color: #F4BF00;">
                                    <h1><?= substr($key["Nama"],0,1) ?></h1>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <p id="head-status">Status kesehatan kamu </p>
                    <div class="status-kesehatan">
                        <?php if ($status_kesehatan == "Merah"): ?>
                            <div class="simbol" style="background-color: red;">
                            
                            </div>
                            <p id="detail-status">Kamu tidak di izinkan pergi ke tempat umum</p>
                        <?php elseif($status_kesehatan == "Kuning"): ?>
                            <div class="simbol" style="background-color: orange;">
                            
                            </div>
                            <p id="detail-status">Kamu bisa pergi ke tempat umum dengan bebas (dalam pengawasan)</p>
                        <?php else: ?>
                            <div class="simbol">
                                
                            </div>
                            <p id="detail-status">Kamu bisa pergi ke tempat umum dengan bebas</p>
                        <?php endif ?>
                    </div>
                </div>
                <div class="status-vaksinasi">
                    <img src="img/vaccination.png" alt="" id="vaksin">
                    <?php if ($status_vaksinasi == "1"): ?>
                        <p id="vaksin-none">belum melakukan vaksinasi</p>
                        <img src="img/remove.png" alt="" srcset="" id="remove">
                    <?php elseif($status_vaksinasi == "2"): ?>
                        <p>vaksinasi dosis ke 2</p>
                        <img src="img/check.png" alt="" srcset="" id="check">
                    <?php else: ?>
                        <p>vaksinasi dosis ke 3</p>
                        <img src="img/check.png" alt="" srcset="" id="check">
                    <?php endif; ?>
                </div>
                <div class="hasil-test">
                    <h4>Hasil test COVID-19</h4>
                    <div class="swab">
                        <img src="img/lab-microscope.png" alt="" srcset="" id="swab">
                        <div class="caption-swab">
                            <p>Swab PCR</p>
                            <p style="font-size: 13px; color: gray;">Tidak ada</p>
                        </div>
                    </div>
                    <div class="anti-gen">
                        <img src="img/experiment.png" alt="" srcset="" id="antigen">
                        <div class="caption-antigen">
                            <p>Antigen</p>
                            <p style="font-size: 13px; color: gray;">Tidak ada</p>
                        </div>
                    </div>
                    <div class="update-status">
                        <a href="">update status kesehatan kamu disini!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>