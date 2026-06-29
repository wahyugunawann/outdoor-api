<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");

include "koneksi.php";

$idUser         = $_POST['id_user'] ?? '';
$passwordLama   = $_POST['password_lama'] ?? '';
$passwordBaru   = $_POST['password_baru'] ?? '';

if (
    empty($idUser) ||
    empty($passwordLama) ||
    empty($passwordBaru)
) {

    echo json_encode([
        "success" => false,
        "message" => "Data tidak lengkap"
    ]);

    exit;
}

// Ambil password lama dari database
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_user
     WHERE id_user='$idUser'"
);

if (mysqli_num_rows($query) == 0) {

    echo json_encode([
        "success" => false,
        "message" => "User tidak ditemukan"
    ]);

    exit;
}

$data = mysqli_fetch_assoc($query);

// Cek password lama
if ($data["password"] != $passwordLama) {

    echo json_encode([
        "success" => false,
        "message" => "Password lama salah"
    ]);

    exit;
}

// Update password
$update = mysqli_query(
    $koneksi,
    "UPDATE tb_user
     SET password='$passwordBaru'
     WHERE id_user='$idUser'"
);

if ($update) {

    echo json_encode([
        "success" => true,
        "message" => "Password berhasil diperbarui"
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Gagal memperbarui password"
    ]);

}
?>