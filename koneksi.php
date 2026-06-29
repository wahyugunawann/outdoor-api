<?php

$host = "sql207.infinityfree.com";
$user = "if0_41645613";
$pass = "PTFHFeCAE8lurG"; // Ganti dengan password MySQL Anda
$db   = "if0_41645613_outdoor";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>