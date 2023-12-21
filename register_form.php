<?php

require 'function.php';

if (isset($_POST["submit"])) {
    register($_POST);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="CSS/register.css">
    <link rel="icon" href="img/logo.ico" type="image/icon type">
</head>

<body>
    <div class="container">
        <div class="title">
            <div class="brand">
                <div class="logo-2">

                </div>
                <h3>PeduliLindungi</h3>
            </div>
        </div>
        <form action="" method="POST">
            <div class="user-details">
                <div class="input-box">
                    <label class="details" for="Nama_lengkap">Nama Lengkap</label><br>
                    <input type="text" placeholder="Masukan Nama Lengkap" id="Nama_lengkap" name="nama_lengkap" required>
                </div>
                <div class="input-box">
                    <label class="details" for="TTL">Tanggal Lahir</label><br>
                    <input type="date" placeholder="Masukan Tanggal Lahir Anda" id="TTL" name="ttl" required>
                </div>
                <div class="input-box">
                    <label class="details" for="Nik">NIK</label><br>
                    <input type="text" placeholder="Masukkan NIK" id="Nik" name="nik" minlength="16" maxlength="16" required>
                </div>
                <div class="input-box">
                    <label class="details" for="Telp">Nomor Telepon</label><br>
                    <input type="text" placeholder="Masukan No Telepon" id="Telp" name="telp" minlength="15" maxlength="15">
                </div>
                <div class="input-box">
                    <label class="details" for="no_pasport">Nomor Pasport</label><br>
                    <input type="text" placeholder="Masukan No Pasport (Optional)" id="no_pasport" name="no_pasport" minlength="16" maxlength="16">
                    <p id="pesan-passport" style="color: red;">Mohon masukkan nomor passport</p>
                </div>
                <div class="input-box">
                    <label class="details" for="Kewarganegaraan">Kewarganegaraan</label><br>
                    <select name="kewarganegaraan" id="Kewarganegaraan" required>
                        <option value="indonesia">indonesia</option>
                        <option value="Warga Negara Asing">Warga Negara Asing</option>
                    </select>
                </div>
                <div class="input-box">
                    <label class="details" for="sandi">Kata Sandi</label><br>
                    <input type="password" placeholder="Masukan Kata Sandi" id="sandi" name="sandi" maxlength="50" required>
                    <p id="pesan-sandi" style="color: red;">kata sandi dengan konfirmasi tidak sesuai!</p>
                </div>
                <div class="input-box">
                    <label class="details" for="konfirmasi_sandi">Konfirmasi Kata Sandi</label><br>
                    <input type="password" placeholder="kofirmasi Kata Sandi" id="konfirmasi_sandi" name="konfirmasi_sandi" maxlength="50" required>
                </div>
                <div class="input-box">
                    <label class="details" for="status_vaksinasi" id="label-sv">Status vaksinasi</label><br>
                    <select name="status_vaksinasi" id="status_vaksinasi" required>
                        <option value="1">1X (sudah pernah melakukan vaksinasi sebanyak 1 kali)</option>
                        <option value="2">2X (sudah pernah melakukan vaksinasi sebanyak 2 kali)</option>
                        <option value="3">3X (sudah mngikuti semua vaksinasi)</option>
                    </select>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Register" name="submit" id="submit">
            </div>
        </form>
    </div>
    <script src="JS/register.js"></script>
</body>

</html>