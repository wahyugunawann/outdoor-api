<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");

include "koneksi.php";

$id_alat = $_POST['id_alat'];
$nama_alat = $_POST['nama_alat'];
$kategori = $_POST['kategori'];
$harga_sewa = $_POST['harga_sewa'];
$stok = $_POST['stok'];
$gambar = $_POST['gambar'];
$deskripsi = $_POST['deskripsi'];

$query = mysqli_query(
    $koneksi,
    "UPDATE tb_alat SET
        nama_alat='$nama_alat',
        kategori='$kategori',
        harga_sewa='$harga_sewa',
        stok='$stok',
        gambar='$gambar',
        deskripsi='$deskripsi'
     WHERE id_alat='$id_alat'"
);

if($query){

    echo json_encode([
        "success" => true,
        "message" => "Alat berhasil diupdate"
    ]);

}else{

    echo json_encode([
        "success" => false,
        "message" => mysqli_error($koneksi)
    ]);

}