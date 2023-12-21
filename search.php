<?php
 
require 'function.php';

// header("Location: login_form.php");


$id_login = $_SESSION["login"];
$inputValue = $_GET["keyword"];
$users_riwayat = query("SELECT * FROM riwayat_perjalanan WHERE id_user='$id_login' AND lokasi LIKE '%$inputValue%'");

?>

<?php foreach ($users_riwayat as $key): ?>
    <li id="list-perjalanan" data-id="<?= $key["id"] ?>">
        <img src="img/map.png" alt="" srcset="">
        <p><?= substr($key["lokasi"], 0, 55) ?></p>
    </li>
<?php endforeach; ?>