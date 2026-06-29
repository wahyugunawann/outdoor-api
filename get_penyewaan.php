<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include "koneksi.php";

$id_user = $_GET['id_user'];

$query = mysqli_query(
    $koneksi,
    "SELECT
        p.id_sewa,
        p.tanggal_sewa,
        p.durasi,
        p.status,
        a.nama_alat
     FROM tb_penyewaan p
     JOIN tb_alat a
     ON p.id_alat = a.id_alat
     WHERE p.id_user = '$id_user'
     ORDER BY p.id_sewa DESC"
);

$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $data
]);

?>