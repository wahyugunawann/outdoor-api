<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");

include "koneksi.php";

$nama_alat = $_POST['nama_alat'];
$kategori = $_POST['kategori'];
$harga_sewa = $_POST['harga_sewa'];
$stok = $_POST['stok'];
$gambar = $_POST['gambar'];
$deskripsi = $_POST['deskripsi'];

$query = mysqli_query(
    $koneksi,
    "INSERT INTO tb_alat
    (
        nama_alat,
        kategori,
        harga_sewa,
        stok,
        gambar,
        deskripsi
    )
    VALUES
    (
        '$nama_alat',
        '$kategori',
        '$harga_sewa',
        '$stok',
        '$gambar',
        '$deskripsi'
    )"
);

if($query){

    echo json_encode([
        "success" => true,
        "message" => "Alat berhasil ditambahkan"
    ]);

}else{

    echo json_encode([
        "success" => false,
        "message" => mysqli_error($koneksi)
    ]);

}