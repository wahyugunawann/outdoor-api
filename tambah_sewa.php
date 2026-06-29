<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

include "koneksi.php";

header("Content-Type: application/json");

include "koneksi.php";

$id_user = $_POST['id_user'];
$id_alat = $_POST['id_alat'];
$tanggal_sewa = $_POST['tanggal_sewa'];
$durasi = $_POST['durasi'];

if(
    empty($id_user) ||
    empty($id_alat) ||
    empty($tanggal_sewa) ||
    empty($durasi)
){
    echo json_encode([
        "success" => false,
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

$query = mysqli_query(
    $koneksi,
    "INSERT INTO tb_penyewaan
    (
        id_user,
        id_alat,
        tanggal_sewa,
        durasi
    )
    VALUES
    (
        '$id_user',
        '$id_alat',
        '$tanggal_sewa',
        '$durasi'
    )"
);

if($query){

    echo json_encode([
        "success" => true,
        "message" => "Penyewaan berhasil dikirim"
    ]);

}else{

    echo json_encode([
        "success" => false,
        "message" => mysqli_error($koneksi)
    ]);

}
