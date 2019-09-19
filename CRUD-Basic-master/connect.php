<?php
    $host = 'localhost';
    $namaDB = 'belajarDb';
    $usernameDB = 'root';
    $passwordDB = '';

    $koneksi = mysqli_connect($host, $usernameDB, $passwordDB, $namaDB);
    if(mysqli_connect_error()){
        echo "Gagal menghubungkan ke database";
    }else{
        //echo "Terhubung!";
    }
?>