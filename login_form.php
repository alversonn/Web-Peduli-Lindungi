<?php

require 'function.php';

if (isset($_POST["submit"])) {
    $nomor = $_POST["nomor"];
    $password = $_POST["password"];
    login($nomor, $password);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="icon" href="img/logo.ico" type="image/icon type">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="logo">

            </div>
            <a href="index.php" style="text-decoration : none"><h3>PeduliLindungi</h3></a>
        </div>
        <div class="form">
            <div class="brand">
                <div class="logo-2">

                </div>
                <h3>PeduliLindungi</h3>
            </div>
            <form action="" method="post">
                <label for="nik">Nik / Passport</label>
                <br>
                <input type="text" id="nik" placeholder="Masukan Nik / Passport" name="nomor" minlength="15" maxlength="16" required><br>
                <label for="password">Kata Sandi</label>
                <br>
                <input type="password" id="password" placeholder="Masukan Kata Sandi" name="password" required><br>
                <button id="submit" type="submit" name="submit">MASUK</button>
            </form>
       </div>
    </div>
</div>

    
</body>
</html>