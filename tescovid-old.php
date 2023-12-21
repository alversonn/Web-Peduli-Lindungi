<?php

require "function.php";

if (!isset($_SESSION["login"])) {
    header("Location: login_form.php");
}
$id_user = $_SESSION["login"];
$user_status = query("SELECT * FROM users_status WHERE id_user='$id_user'");
$Status_kesehatan = findRow("SELECT * FROM users_status WHERE id_user='$id_user'", 'Status_kesehatan');
$Status_vaksinasi = findRow("SELECT * FROM users_status WHERE id_user='$id_user'", 'Status_vaksinasi');
$Photo_profile = findRow("SELECT Photo_profile FROM users WHERE Id_user='$id_user'", "Photo_profile");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/tescovid-old.css">
    <title>Hasil Test Covid</title>
</head>

<body>
    <a href="index.php" class="btn-close">

    </a>
    <?php foreach ($user_status as $s) : ?>
        <div class="container">
            <div class="title">
                <h1>Status vaksinasi & tes COVID-19</h1>
            </div>
            <div class="biodata">
                <div class="bione">
                    <?php if (strlen($Photo_profile) > 1) : ?>
                        <div class="photo-profile" style="background-image: url(img/user-pic/<?= $Photo_profile ?>); display:inline-block;">

                        </div>
                    <?php else : ?>
                        <div class="photo-profile" style="background-color: #F4BF00; display:flex; justify-content:center; align-items:center;">
                            <h3><?= substr($s["Nama"], 0, 1) ?></h3>
                        </div>
                    <?php endif; ?>
                    <h4 style="font-weight: 500;"><?= $s["Nama"] ?></h4>
                </div>
                <div class="biotwo">
                    <img src="img/security-payment.png" alt="" srcset="">
                    <h4 style="font-weight: 500;"><?= $s["Nik"] ?></h4>
                </div>
            </div>
            <?php if ($Status_kesehatan === "Hijau") : ?>
                <div class="status">
                    <p><?= $s["Status_kesehatan"] ?></p>
                </div>
            <?php elseif ($Status_kesehatan === "Kuning") : ?>
                <div class="status" style="background-color: orange;">
                    <p><?= $s["Status_kesehatan"] ?></p>
                </div>
            <?php else : ?>
                <div class="status" style="background-color: red;">
                    <p><?= $s["Status_kesehatan"] ?></p>
                </div>
            <?php endif; ?>
            <div class="tentang">
                <h4>Status Kesehatan : </h4>
                <div class="hijau">
                    <div class="simbol-hijau">

                    </div>
                    <p>Kamu bisa pergi ke tempat umum dengan bebas,
                        dikarenakan sudah aman dan sudah melakukan
                        vaksin dosis lengkap.</p>
                </div>
                <div class="kuning">
                    <div class="simbol-kuning">

                    </div>
                    <p>Kamu bisa pergi ke tempat umum dengan bebas
                        (Dalam pengawasan), dikarenakan baru melakukan
                        vaksin dosis pertama.</p>
                </div>
                <div class="merah">
                    <div class="simbol-merah">

                    </div>
                    <p>Kamu tidak bisa pergi ketempat umum dikarenakan
                        dalam kondisi terpapar virus covid-19 dan
                        belum melakukan vaksinasi.</p>
                </div>
            </div>
            <div class="vaksin-group">
                <?php if ($Status_vaksinasi === '3') : ?>
                    <div class="vaksin-1">
                        <h3 style="font-weight: 100;">Vaksinasi Dosis 1 (Sudah Divaksinasi)</h3>
                        <img src="img/check.png" alt="" srcset="">
                    </div>
                    <div class="vaksin-2">
                        <h3 style="font-weight: 100;">Vaksinasi Dosis 2 (Sudah Divaksinasi)</h3>
                        <img src="img/check.png" alt="" srcset="">
                    </div>
                    <div class="vaksin-3">
                        <h3 style="font-weight: 100;">Vaksinasi Dosis 3 (Sudah Divaksinasi)</h3>
                        <img src="img/check.png" alt="" srcset="">
                    </div>
                <?php elseif ($Status_vaksinasi === '2') : ?>
                    <div class="vaksin-1">
                        <h3 style="font-weight: 100;">Vaksinasi Dosis 1 (Sudah Divaksinasi)</h3>
                        <img src="img/check.png" alt="" srcset="">
                    </div>
                    <div class="vaksin-2">
                        <h3 style="font-weight: 100;">Vaksinasi Dosis 2 (Sudah Divaksinasi)</h3>
                        <img src="img/check.png" alt="" srcset="">
                    </div>
                    <div class="vaksin-3">
                        <h3 style="font-weight: 100;">Vaksinasi Dosis 3 (Belum Divaksinasi)</h3>
                        <img src="img/remove.png" alt="" srcset="">
                    </div>
                <?php else : ?>
                    <div class="vaksin-1">
                        <h3 style="font-weight: 100;">Vaksinasi Dosis 1 (Sudah Divaksinasi)</h3>
                        <img src="img/check.png" alt="" srcset="">
                    </div>
                    <div class="vaksin-2">
                        <h3 style="font-weight: 100;">Vaksinasi Dosis 2 (Belum Divaksinasi)</h3>
                        <img src="img/remove.png" alt="" srcset="">
                    </div>
                    <div class="vaksin-3">
                        <h3 style="font-weight: 100;">Vaksinasi Dosis 3 (Belum Divaksinasi)</h3>
                        <img src="img/remove.png" alt="" srcset="">
                    </div>
                <?php endif; ?>
            </div>
            <div class="about">
                <a href="">Update Status Kesehatan Kamu!</a>
            </div>
        </div>
    <?php endforeach; ?>

</body>

</html>