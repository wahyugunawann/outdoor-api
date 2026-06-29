<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include "koneksi.php";

$query = mysqli_query(
    $koneksi,
    "SELECT
        p.id_sewa,
        u.nama,
        a.nama_alat,
        p.tanggal_sewa,
        p.durasi,
        p.status
     FROM tb_penyewaan p
     JOIN tb_alat a
     ON p.id_alat = a.id_alat
     JOIN tb_user u
     ON p.id_user = u.id_user
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