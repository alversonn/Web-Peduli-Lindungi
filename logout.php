<?php
 
if (isset($_COOKIE["checkin"])) {
    echo "
            <script>
                alert('Anda masih dalam Checkin, Checkout terlebih dahulu!');
                document.location.href='index.php';
            </script>
        ";
    return false;
}

session_start();
session_unset();
session_destroy();

header("Location: index.php")
 
?>