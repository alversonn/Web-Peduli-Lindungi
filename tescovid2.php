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
                <h3>PeduliLindungi</h3>
            </div>
            <div class="atasan">
                <a class="active" href="index.php">Beranda</a>
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
            <div class="col1">
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
            </div>
            <div class="col2">
                <div class="header-col2">
                    <h2>Status vaksinasi & tes COVID-19</h2>
                </div>
                <div class="main">
                    <div class="group-col2">
                        <p id="head-namatanggal">Nama & tangal-lahir</p>
                        <div class="nama-col2">
                            <p><pre>Nama Lengkap :   Alief Panca Rachman</pre></p>
                        </div>
                        <div class="ttl-col2">
                            <p><pre>Tanggal Lahir    :   2022-19-07</pre></p>
                        </div>
                    </div>
                    <p id="head-status">Status kesehatan kamu </p>
                    <div class="status-kesehatan">
                        <div class="simbol">
                            <!-- <p>H</p> -->
                        </div>
                        <p id="detail-status">Kamu bisa pergi ke tempat umum dengan bebas</p>
                    </div>
                </div>
                <div class="status-vaksinasi">
                    <img src="img/vaccination.png" alt="" id="vaksin">
                    <p>vaksinasi dosis ke 2</p>
                    <img src="img/check.png" alt="" srcset="" id="check">
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