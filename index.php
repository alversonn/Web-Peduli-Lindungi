<?php

require 'function.php';
global $db;

if (isset($_COOKIE["checkin"])) {
    if ($_COOKIE["checkin"] === 'true') {
        $_SESSION["login"] = $_COOKIE["id"];
    }
}

if (isset($_SESSION["login"])) {

    $id_login = $_SESSION["login"];
    $users = query("SELECT * FROM users WHERE Id_user='$id_login'");
    $Photo_profile = findRow("SELECT Photo_profile FROM users WHERE Id_user='$id_login'", "Photo_profile");
    $data = query("SELECT * FROM checkin WHERE id_user='$id_login'");

    $tz = 'Asia/Jakarta';
    $dt = new DateTime("now", new DateTimeZone($tz));
    $waktuSaatini = $dt->format('Y-m-d H:i:s');
    $waktuAwal = findRow("SELECT * FROM checkin WHERE id_user='$id_login'",'tanggal');
    echo "
        <script>
            let waktuAwal = '$waktuAwal';
            let waktuSaatini = '$waktuSaatini';
        </script>
    ";

    if (isset($_GET["status"])) {
        mysqli_query($db, "DELETE FROM checkin WHERE id_user='$id_login'");
    }
} else {
    $Photo_profile = '';
}

if (isset($_POST["btn-checkout"])) {
    checkout($_POST,$id_login);
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeduliLindungi</title>
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="icon" href="img/logo.ico" type="image/icon type">
</head>

<body>
    <div class="container">
        <nav>

            <div class="navbar">
                <div class="logo">
                    <div class="icon">

                    </div>
                    <h3>PeduliLindungi</h3>
                </div>
                <div class="atasan">
                    <a id="beranda" href="#beranda">Beranda</a>
                    <a id="tentang" href="#tentang">Tentang</a>
                    <a id="statistik" href="#statistik">Statistik</a>
                    <a href="#Bahasa">Bahasa</a>
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
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="not_login">
                            <a href="login_form.php">Login</a>/
                            <a href="register_form.php">Register</a>
                        </div>
                    <?php endif; ?>
                        </div>
        </nav>
        <main>

            <div class="background-main">
                <div class="caption-main">
                    <?php if (isset($_COOKIE["checkin"])) : ?>
                        <?php if ($_COOKIE["checkin"] == 'true') : ?>
                            <div class="kotak-checkin">
                                <div class="title-checkin">
                                    <h2>Posisi Check-in anda </h2>
                                </div>
                                <?php foreach ($data as $key) : ?>
                                    <div class="lokasi-checkin">
                                        <img src="img/location (1).png" alt="" srcset="">
                                        <p style="font-size:15px;"><?= $key["lokasi"] ?></p>
                                    </div>
                                    <div class="check">
                                        <div class="checkin">
                                            <img src="img/pedestrian-man (1).png" alt="" srcset="">
                                            <p style="font-size:15px;"><?= $key["tanggal"] ?></p>
                                        </div>
                                        <div class="timer">
                                            <img src="img/stopwatch.png" alt="" srcset="">
                                            <p style="font-size:15px;" id="display">00:00:00</p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <form action="" method="post">
                                <input type="hidden" name="lama_perjalanan" id="lama_perjalanan">
                                <button type="submit" id="btn-cek" name="btn-checkout">CHECK OUT SEKARANG</button>
                            </form>
                        <?php endif; ?>
                    <?php else : ?>
                        <h3>Lindungi diri dan sekitar dengan <br>berpartipasi dalam <br>Vaksinasi COVID 19</h3>
                        <a id="btn-cek" href="biodata.php">CHECK IN SEKARANG</a>
                    <?php endif; ?>
                </div>
                <div class="icon-main">

                </div>
            </div>
        </main>
        <menu>
            <div class="menu">
                <a href="lokasi.php" class="vaksinasi">
                    <div class="icon-vaksinasi">
                        <img src="img/icon-vaksinasi.png" alt="" srcset="">
                    </div>
                    <h4>Vaksinasi & <br> Imunisasi</h4>
                </a>
                <a href="tescovid.php" class="hasil-test">
                    <div class="icon-hasiltest">
                        <img src="img/icon-hasiltest.png" alt="" srcset="">
                    </div>
                    <h4>Hasil test <br> COVID-19</h4>
                </a>
                <a href="riwayat.php" class="riwayat">
                    <div class="icon-statistik">
                        <img src="img/World Map _Outline.png" alt="" srcset="">
                    </div>
                    <h4>Riwayat <br> Perjalanan</h4>
                </a>
            </div>
        </menu>
        <div class="tentang">
            <div class="tentang1">
                <div class="title-about1">
                    <h3 style="color: #0C25A9;">Tentang</h3>
                    <br>
                    <h2 style="color: #229BD8;">Apa itu</h2>
                    <h2 style="color: #229BD8;">PeduliLindungi?</h2>
                </div>
                <p>
                    PeduliLindungi adalah aplikasi yang dikembangkan untuk membantu instansi pemerintah terkait dalam melakukan pelacakan untuk menghentikan penyebaran Coronavirus Disease (COVID-19).
                    <br>
                    <br>
                    Aplikasi ini mengandalkan partisipasi masyarakat untuk saling membagikan data lokasinya saat bepergian agar penelusuran riwayat kontak dengan penderita COVID-19 dapat dilakukan.
                    <br>
                    <br>
                    Pengguna aplikasi ini juga akan mendapatkan notifikasi jika berada di keramaian atau berada di zona merah, yaitu area atau kelurahan yang sudah terdata bahwa ada orang yang terinfeksi COVID-19 positif atau ada Pasien Dalam Pengawasan.
                </p>
            </div>
            <div class="tentang2">
                <div class="title-about2">
                    <h3 style="color: #0C25A9;">Tentang</h3>
                    <br>
                    <h2 style=" color: #229BD8;">VAKSINASI</h2>
                    <h2 style="color: #229BD8;">COVID-19</h2>
                </div>
                <p>
                    Pada tahap awal, vaksinasi Covid-19 sudah berhasil diberikan kepada seluruh tenaga kesahatan, asisten tenaga kesehatan, dan mahasiswa yang menjalankan pendidikan profesi kedokteran yang bekerja pada fasilitas pelayanan kesehatan.
                    <br>
                    <br>
                    Vaksin tahap kedua juga sudah diberikan kepada lansia, pekerja sektor esensial, dan guru.
                    <br>
                    <br>
                    Pemerataan vaksinasi hingga saat ini dilanjutkan untuk masyarakat umum dan terus berjalan hingga berhasil menjangkau seluruh warga negara Indonesia dan warga negara asing yang bertempat tinggal di Indonesia.
                    <br>
                    <br>
                    Harapannya dengan upaya pemerataan vaksinasi ini, Indonesia dapat segera bangkit dan terbebas dari penyebaran virus Covid-19.
                </p>
            </div>

        </div>
        <div class="statistik">
            <h3>Statistik Covid-19</h3>
            <div id="chartContainer"></div>
        </div>
        <footer>
            <div class="footer1">
                <div class="kiri">
                    <div class="kiri-logo">
                        <img src="img/logo.png" alt="" srcset="">
                        <h3>PeduliLindungi</h3>
                    </div>
                    <p>
                        PeduliLindungi merupakan aplikasi web yang
                        bertjuan untuk mengecek kesehatan masyarakat
                        dan menjauhkan rakyat indonesia dari covid-19
                        dan virus berbahaya lainnya.
                    </p>
                    <div class="sosmed">
                        <div class="facebook">

                        </div>
                        <a href="">@PeduliLindungi.id</a>
                        <div class="instagram">

                        </div>
                        <a href="">@PeduliLindungi</a>
                        <div class="twitter">

                        </div>
                        <a href="">@PLindungi</a>
                    </div>
                </div>
                <div class="tengah">
                    <img src="img/logo_kpcpen.png" alt="">
                    <img src="img/logo_kemenkes.png" alt="">
                    <img src="img/logo_bumn.png" alt="" srcset="">
                </div>
            </div>
        </footer>
    </div>
    <script src="JS/index.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="JS/jquery-3.6.1.min.js"></script>
</body>

</html>