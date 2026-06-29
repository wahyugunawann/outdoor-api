<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET");

include "koneksi.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {

    echo json_encode([
        "success" => false,
        "message" => "Email dan password wajib diisi"
    ]);

    exit;
}

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_user
    WHERE email='$email'
    AND password='$password'"
);

if (mysqli_num_rows($query) > 0) {

    $data = mysqli_fetch_assoc($query);

    echo json_encode([
        "success" => true,
        "id_user" => $data["id_user"],
        "nama" => $data["nama"],
        "email" => $data["email"],
        "role" => $data["role"]
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Email atau Password salah"
    ]);
}