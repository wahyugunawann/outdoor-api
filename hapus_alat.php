<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");

include "koneksi.php";

$id_alat = $_POST['id_alat'];

$query = mysqli_query(
    $koneksi,
    "DELETE FROM tb_alat
     WHERE id_alat='$id_alat'"
);

if($query){

    echo json_encode([
        "success" => true,
        "message" => "Alat berhasil dihapus"
    ]);

}else{

    echo json_encode([
        "success" => false,
        "message" => mysqli_error($koneksi)
    ]);

}