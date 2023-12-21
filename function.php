<?php
 
$db = mysqli_connect("localhost","root","","pedulilindungi");
session_start();

function query($query) {
    global $db;
    $result = mysqli_query($db,$query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    };
    return $rows;
};

function findRow($query,$row) {
    global $db;
    $table = mysqli_query($db,$query);
    $coloums = mysqli_fetch_assoc($table);
    if (mysqli_num_rows($table) == 1) {
        $rows = $coloums[$row];
    }else {
        $rows = false;
    }
    return $rows;
};


function login($nomor, $password) {
    global $db;
    $passport = findRow("SELECT * FROM users WHERE Nik='$nomor'",'Nomor_paspor');
    $nik = findRow("SELECT * FROM users WHERE Nik='$nomor'",'Nik');
    $pass = findRow("SELECT * FROM users WHERE Nik='$nomor'",'sandi');
    $id = findRow("SELECT * FROM users WHERE Nik='$nomor'","Id_user");
    if ($nomor === $nik || $nomor === $passport) {
        if ($password == $pass) {
            echo "
                <script>
                    alert('Berhasil Login!');
                    document.location.href = 'index.php';
                </script>
            ";
            $_SESSION["login"] = $id;
        }else {
            echo "
                <script>
                    alert('sandi yang anda masukkan salah!');
                    document.location.href = 'login_form.php';
                </script>
            ";
        }
    }else {
        echo "
            <script>
                alert('nik/passport yang anda masukkan salah!');
                document.location.href = 'login_form.php';
            </script>
        ";
    }
}

function register($post) {
    global $db;
    $namalengkap = $post["nama_lengkap"];
    $sandi = $post["sandi"];
    $kewarganegaraan = $post["kewarganegaraan"];
    $nomorTelp = $post["telp"];
    $ttl = $post["ttl"];
    $nomorPasport = $post["no_pasport"];
    $Status_kesehatan = '';
    $Status_vaksinasi = $post["status_vaksinasi"];
    $warnadefault = dechex(rand(0, 10000000));


    $check_passport = mysqli_query($db, "SELECT * FROM users WHERE Nomor_paspor='$nomorPasport'");
    if (mysqli_num_rows($check_passport) == 1) {
        echo "
                <script>
                    alert('Maaf Nomor Passport yang anda masukkan sudah terdaftar!');
                    alert('Regristrasi gagal');
                    document.location.href = 'register_form.php';
                </script>
            ";
        return false;
    }

    if ($Status_vaksinasi === '3') {
        $Status_kesehatan = 'Hijau';
    } else if($Status_vaksinasi === '2') {  
        $Status_kesehatan = 'Hijau';
    }else if($Status_kesehatan === '1'){
        $Status_kesehatan = 'Kuning';
    }else{
        $Status_kesehatan = 'Merah';
    }
    
    if (isset($post["nik"])) {
        $nik = $post["nik"];
        $negara = '-';

        $check_nik = mysqli_query($db,"SELECT * FROM users WHERE Nik='$nik'");
        if (mysqli_num_rows($check_nik) == 1) {
            echo "
                <script>
                    alert('Maaf Nik yang anda masukkan sudah terdaftar!');
                    alert('Regristrasi gagal');
                    document.location.href = 'register_form.php';
                </script>
            ";
            return false;
        }else {
            if ($nomorPasport == "") {
                $nomorPasport = '-';
            }
            mysqli_query($db,"INSERT INTO users VALUES('','$namalengkap','$sandi','$nik','$nomorTelp','$kewarganegaraan','$ttl','$nomorPasport','$negara','')");
            $id = findRow("SELECT * FROM users WHERE Nik='$nik'",'Id_user');
            mysqli_query($db,"INSERT INTO users_status VALUES('','$namalengkap','$nik','$nomorPasport','$Status_kesehatan','$Status_vaksinasi','$id')");
            if (mysqli_affected_rows($db) == 1) {
                echo "
                    <script>
                        alert('Regristrasi berhasil');
                        document.location.href = 'login_form.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Regristrasi gagal');
                        document.location.href = 'register_form.php';
                    </script>
                ";
            }
        }
    }

    if (isset($post["negara"])) {
        $nik = '-';
        $negara = $post["negara"];

        mysqli_query($db, "INSERT INTO users VALUES('','$namalengkap','$sandi','$nik','$nomorTelp','$kewarganegaraan','$ttl','$nomorPasport','$negara','')");
        $id = findRow("SELECT * FROM users WHERE Nomor_paspor='$nomorPasport'", 'Id_user');
        mysqli_query($db, "INSERT INTO users_status VALUES('','$namalengkap','$nik','$nomorPasport','$Status_kesehatan','$Status_vaksinasi','$id')");
        if (mysqli_affected_rows($db) == 1) {
            echo "
                    <script>
                        alert('Regristrasi berhasil');
                        document.location.href = 'login_form.php';
                    </script>
                ";
        } else {
            echo "
                    <script>
                        alert('Regristrasi gagal');
                        document.location.href = 'register_form.php';
                    </script>
                ";
        }
        
    }
}


function update($post,$id) {
    global $db;

    $kewarganegaraan = $post["kewarganegaraan"];
    $Nik = $post["Nik"];
    $Username = $post["ussername"];
    $ttl = $post["ttl"];
    $nomor_pasport = $post["nomor_pasport"];
    $nomor_ponsel = $post["nomor_ponsel"];
    $gambar_lama = $post["gambar_lama"];

    
    $gambar = upload($gambar_lama);
    if (!$gambar) {
        return false;
    }

    mysqli_query($db,"UPDATE users SET Nama='$Username', Nik='$Nik', No_hp='$nomor_ponsel', Tanggal_lahir='$ttl', Nomor_paspor='$nomor_pasport', Kewarganegaraan='$kewarganegaraan', Photo_profile='$gambar' WHERE Id_user='$id'");

    if (mysqli_affected_rows($db) == 1) {
        echo "
                <script>
                    alert('Data berhasil diubah!');
                    document.location.href = 'account.php';
                </script>
            ";
    }else {
        echo "
                <script>
                    alert('Data gagal diubah!');
                    document.location.href = 'account.php';
                </script>
            ";
    }
}


function upload($gambar_lama) {
    $namaFile = $_FILES["gambar"]['name'];
    $ukuranFile = $_FILES["gambar"]['size'];
    $tmpName = $_FILES["gambar"]['tmp_name'];
    $error = $_FILES["gambar"]['error'];

    if ($error === 4) {
        return $gambar_lama;
    }

    $ekstensigambarValid = ['jpg','jpeg','png'];
    $ekstensigambar = explode('.',$namaFile);
    $ekstensigambar = strtolower(end($ekstensigambar));

    if (!in_array($ekstensigambar,$ekstensigambarValid)) {
        echo "
                <script>
                    alert('yang anda upload bukan gambar!');
                </script>
            ";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "
                <script>
                    alert('ukuran gambar terlalu besar!');
                </script>
            ";
        return false;
    }

    move_uploaded_file($tmpName,'img/user-pic/'. $namaFile);

    return $namaFile;
}


function cekStatus($post,$id) 
{
    global $db;

    $latitude = $post["latitude"];
    $longitude = $post["longitude"];
    $namalengkap = $post["nama_lengkap"];
    $thi = $post["thi"];
    $lokasi = $post["lokasi"];
    $Nik = $post["Nik"];
    $Nomor_paspor = $post["Nomor_paspor"];
    $total_keramaian = (int)explode("/",$post["total_keramaian"])[0];

    if ($total_keramaian === 1000) {
        echo "
            <script>
                alert('maaf anda tidak di perbolehkan masuk karena kapasitas telah mencapai 1000 orang');
            </script>
        ";
        return false;
        die;
    }

    $Status_kesehatan = findRow("SELECT * FROM users_status WHERE id_user='$id'","Status_kesehatan");
    $Status_vaksinasi = findRow("SELECT * FROM users_status WHERE id_user='$id'","Status_vaksinasi");

    $StatusKesehatan_valid = ["Hijau","Kuning"];
    $StatusVaksinasi_valid = ["2","3"];


    if (in_array($Status_kesehatan, $StatusKesehatan_valid) && in_array($Status_vaksinasi, $StatusVaksinasi_valid)) {
        mysqli_query($db,"INSERT INTO checkin VALUES('','$id','$namalengkap','$Nik','$Nomor_paspor','$thi','$lokasi',1)");
        mysqli_query($db,"INSERT INTO riwayat_perjalanan VALUES('','$id','$namalengkap','$Nik','$Nomor_paspor','$thi','$lokasi','-','-','$latitude','$longitude')");
        setcookie('checkin','true',time()+43200);
        setcookie('id',$id, time()+43200);
        header("Location: ticket.php?status=diizinkan");
    } else {
        mysqli_query($db, "INSERT INTO checkin VALUES('','$id','$namalengkap','$Nik','$Nomor_paspor','$thi','$lokasi',1)");
        header("Location: ticket.php?status=tidakdizinkan");
    }
}

function checkout($post, $id) 
{
    global $db;
    
    $lama_perjalanan = $post["lama_perjalanan"];
    $query_checkin = mysqli_query($db,"SELECT * FROM riwayat_perjalanan WHERE id_user='$id' ORDER BY id DESC");
    $coba = mysqli_fetch_assoc($query_checkin);
    $id_checkin = $coba['id'];
    $tz = 'Asia/Jakarta';
    $dt = new DateTime("now", new DateTimeZone($tz));
    $timestamp = $dt->format('Y-m-d G:i:s');
    mysqli_query($db, "UPDATE riwayat_perjalanan SET checkout='$timestamp', lama_perjalanan='$lama_perjalanan' WHERE id='$id_checkin'");
    mysqli_query($db, "DELETE FROM checkin WHERE id_user='$id'");
    setcookie('checkin', '', time() - 86400);
    setcookie('id', '', time() - 86400);
    header("Location: index.php");
}

