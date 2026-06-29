<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include "koneksi.php";

$data = [];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_alat"
);

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $data
]);

?>