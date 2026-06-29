<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include "koneksi.php";

$id_sewa = $_POST['id_sewa'];
$status  = $_POST['status'];

// Ambil id_alat dari penyewaan ini
// supaya kita tahu stok alat mana yang perlu diubah
$getSewa = mysqli_query(
    $koneksi,
    "SELECT id_alat FROM tb_penyewaan
     WHERE id_sewa='$id_sewa'"
);

$dataSewa = mysqli_fetch_assoc($getSewa);
$id_alat  = $dataSewa['id_alat'];

// Update status penyewaan
$queryStatus = mysqli_query(
    $koneksi,
    "UPDATE tb_penyewaan
     SET status='$status'
     WHERE id_sewa='$id_sewa'"
);

if ($queryStatus) {

    // Jika status Disetujui → stok berkurang 1
    if ($status == "Disetujui") {
        mysqli_query(
            $koneksi,
            "UPDATE tb_alat
             SET stok = stok - 1
             WHERE id_alat='$id_alat'
             AND stok > 0"
        );
    }

    // Jika status Selesai → stok bertambah 1 (barang kembali)
    if ($status == "Selesai") {
        mysqli_query(
            $koneksi,
            "UPDATE tb_alat
             SET stok = stok + 1
             WHERE id_alat='$id_alat'"
        );
    }

    echo json_encode([
        "success" => true,
        "message" => "Status berhasil diupdate"
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Gagal update status"
    ]);

}
?>