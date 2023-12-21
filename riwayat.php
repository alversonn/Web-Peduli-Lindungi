<?php

require 'function.php';

if (!isset($_SESSION["login"])) {
    header("Location: login_form.php");
}


$id_login = $_SESSION["login"];
$users = query("SELECT * FROM users WHERE Id_user='$id_login'");
$users_riwayat = query("SELECT * FROM riwayat_perjalanan WHERE id_user='$id_login' AND NOT checkout='-'");
$Photo_profile = findRow("SELECT Photo_profile FROM users WHERE Id_user='$id_login'", "Photo_profile");
$data = query("SELECT * FROM checkin WHERE id_user='$id_login'");


$json = json_encode($users_riwayat);
echo "
        <script>
            var text = $json 
        </script>
    ";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Perjalanan</title>
    <!-- <link rel="stylesheet" href="CSS/riwayat.css"> -->
    <link rel="icon" href="img/logo.ico" type="image/icon type">
    <link rel="stylesheet" href="CSS/riwayat.css">
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
        </div>
        <div class="wrapper">
            <div class="nav">
                <div class="group-input">
                    <form action="" method="post">
                        <img src="img/search.webp" alt="" srcset="">
                        <input type="text" name="cari" id="filter-lokasi" placeholder="filter lokasi">
                    </form>
                </div>
                <h4>Riwayat Perjalanan</h4>
                <select name="option" id="option">
                    <option value="hari ini">Hari ini</option>
                    <option value="kemarin">kemarin</option>
                    <option value="1 mgg lalu">1 mgg lalu</option>
                </select>
            </div>
            <div class="menubar">
                <div class="group-menubar">
                    <div class="list-perjalanan">
                        <p>List perjalanan</p>
                        <ul>
                            <?php foreach ($users_riwayat as $key) : ?>
                                <li id="list-perjalanan" data-id="<?= $key["id"] ?>">
                                    <img src="img/map.png" alt="" srcset="">
                                    <p><?= substr($key["lokasi"], 0, 55) ?></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="details">
                        <div class="header-details">
                            <img src="img/left.png" alt="" srcset="" id="back">
                            <p>Details perjalanan</p>
                        </div>
                        <ul>
                            <li id="nama-jalan">Nama jalan : <br>
                                <p id="namaJalan">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, quidem?</p>
                            </li>
                            <li id="checkin">Checkin : <br>
                                <p id="waktuCheckin">10:10:10</p>
                            </li>
                            <li id="checkout">Checkout :<br>
                                <p id="waktuCheckout">10:10:10</p>
                            </li>
                            <li id="lama_perjalanan">lama Perjalanan :<br>
                                <p id="lamaPerjalanan">10:10:10</p>
                            </li>
                        </ul>
                    </div>
                </div>

                </div>
            <div class="sidebar">
                <iframe frameborder="0" id="map">

                </iframe>
            </div>
        </div>
        <div class="footer">

        </div>
    </div>
    <script src="JS/jquery-3.6.1.min.js"></script>
    <script src="JS/riwayat.js"></script>
</body>

</html>