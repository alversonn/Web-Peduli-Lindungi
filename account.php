<?php

require 'function.php';

if (isset($_SESSION["login"])) {
    $id_login = $_SESSION["login"];
    $users = query("SELECT * FROM users WHERE Id_user='$id_login'");
    $Photo_profile = findRow("SELECT Photo_profile FROM users WHERE Id_user='$id_login'", "Photo_profile");
    if (isset($_POST["submit"])) {
        update($_POST, $id_login);
    }
} else {
    $users = '';
    $Photo_profile = '';
}


$check_kewarganegaraan = findRow("SELECT * FROM users WHERE Id_user='$id_login'", 'Kewarganegaraan');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="icon" href="img/logo.ico" type="image/icon type">
    <link rel="stylesheet" href="CSS/account.css">
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
                                <div class="default-nav-account">
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
        <?php foreach ($users as $user) : ?>
            <div class="menu-group">
                <div class="menu">
                    <div class="account-name">
                        <div class="photo-profile">
                        </div>
                        <h3 style="font-weight: 100;"><?= $user["Nama"] ?></h3>
                    </div>
                    <div class="biodata">
                        <div class="profile-box">
                            <img src="img/user (2).png" alt="" id="img-profile">
                            <a href="#" id="btn-profile">Akun Saya</a>
                        </div>
                        <div class="sertifikat-box">
                            <img src="img/certificate (2).png" alt="" srcset="" id="img-sertifikat">
                            <a href="#" id="btn-sertifikat">Sertifikat Vaksin</a>
                        </div>
                    </div>
                    <a href="logout.php" class="logout-box">
                        <img src="img/power.png" alt="" srcset="">
                        <p>Keluar dari Akun</p>
                    </a>
                </div>
                <div class="wrapper">
                    <p id="profile-header">Profil</p>
                    <form method="POST" action="" class="profile" id="profile" enctype="multipart/form-data">
                        <div class="btn-wrapper">
                            <?php if (strlen($Photo_profile) > 1) : ?>
                                <div class="bungkus">
                                    <div class="photo-profile2" style="background-image: url(img/user-pic/<?= $user["Photo_profile"] ?>);">
        
                                    </div>
                                    <img src="img/write.png" alt="" srcset="" width="30" id="edit-2">
                                    <input type="file" name="gambar" id="gambar">
                                    <input type="hidden" name="gambar_lama" value="<?= $user["Photo_profile"] ?>">
                                </div>
                            <?php else : ?>
                                <div class="default">
                                    <h1 id="nama"><?= substr($user["Nama"], 0, 1) ?></h1>
                                    <img src="img/write.png" alt="" srcset="" width="30" id="edit">
                                    <input type="file" name="gambar" id="gambar">
                                    <input type="hidden" name="gambar_lama" value="<?= $user["Photo_profile"] ?>">
                                </div>
                            <?php endif; ?>
                            <button type="submit" name="submit">Perbarui</button>
                        </div>
                        <div class="input-area">
                            <div class="input-box">
                                <label class="details" for="Kewarganegaraan">Kewarganegaraan</label>
                                <select name="kewarganegaraan" id="Kewarganegaraan" required>
                                    <option value="indonesia">indonesia</option>
                                    <option value="Warga Negara Asing">Warga Negara Asing</option>
                                </select>
                            </div>
                            <br>
                            <?php if ($check_kewarganegaraan === 'indonesia') : ?>
                                <div class="input-box">
                                    <label for="Nik">NIK</label>
                                    <input type="text" name="Nik" id="Nik" value="<?= $user["Nik"] ?>" minlength="16" maxlength="16">
                                </div>
                            <?php else : ?>
                                <div class="input-box">
                                    <label for="Nik">Negara</label>
                                    <input type="text" name="Nik" id="Nik" value="<?= $user["Negara"] ?>">
                                </div>
                            <?php endif; ?>
                            <br>
                            <div class="input-box">
                                <label for="ussername">Nama Lengkap</label>
                                <input type="text" name="ussername" id="ussername" value="<?= $user["Nama"] ?>">
                            </div>
                            <br>
                            <div class="input-box">
                                <label for="ttl">Tempat, Tanggal Lahir</label>
                                <input type="date" name="ttl" id="ttl" value="<?= $user["Tanggal_lahir"] ?>">
                            </div>
                            <br>
                            <div class="input-box">
                                <label for="nomor_pasport">Nomor Paspor</label>
                                <input type="text" name="nomor_pasport" id="nomor_pasport" value="<?= $user["Nomor_paspor"] ?>" minlength="16" maxlength="16">
                            </div>
                            <br>
                            <div class="input-box">
                                <label for="nomor_ponsel">Nomor Ponsel</label>
                                <input type="text" name="nomor_ponsel" id="nomor_ponsel" value="<?= $user["No_hp"] ?>" minlength="15" maxlength="15">
                            </div>
                            <br>
                        </div>
                    </form>
                    <div class="sertifikat" id="sertifikat">
                        <h1>Sertifikat Vaksin</h1>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="JS/account.js"></script>
</body>

</html>