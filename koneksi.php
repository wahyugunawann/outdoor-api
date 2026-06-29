<?php

$host = "mysql.railway.internal";
$user = "root";
$pass = "kgKcAeXENDeEkPcjmcYWAkaeuWGhACPj"; // Ganti dengan password MySQL Anda
$db   = "railway";
$port = 3306;

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>