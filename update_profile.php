<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");

include "koneksi.php";

$idUser = $_POST['id_user'] ?? '';
$nama   = $_POST['nama'] ?? '';
$email  = $_POST['email'] ?? '';

if (
    empty($idUser) ||
    empty($nama) ||
    empty($email)
) {

    echo json_encode([
        "success" => false,
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

// Cek email sudah dipakai user lain atau belum
$cek = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_user
     WHERE email='$email'
     AND id_user != '$idUser'"
);

if (mysqli_num_rows($cek) > 0) {

    echo json_encode([
        "success" => false,
        "message" => "Email sudah digunakan"
    ]);

    exit;
}

// Update Profile
$query = mysqli_query(
    $koneksi,
    "UPDATE tb_user
     SET
     nama='$nama',
     email='$email'
     WHERE id_user='$idUser'"
);

if ($query) {

    echo json_encode([
        "success" => true,
        "message" => "Profil berhasil diperbarui"
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Gagal memperbarui profil"
    ]);

}
?>