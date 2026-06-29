<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET");

include "koneksi.php";

$nama     = $_POST['nama'] ?? '';
$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if(
    empty($nama) ||
    empty($email) ||
    empty($password)
){
    echo json_encode([
        "success" => false,
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

$cek = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_user WHERE email='$email'"
);

if(mysqli_num_rows($cek) > 0){

    echo json_encode([
        "success" => false,
        "message" => "Email sudah digunakan"
    ]);

}else{

    $query = mysqli_query(
        $koneksi,
        "INSERT INTO tb_user
        (nama,email,password,role)
        VALUES
        ('$nama','$email','$password','pelanggan')"
    );

    if($query){

        echo json_encode([
            "success" => true,
            "message" => "Registrasi berhasil"
        ]);

    }else{

        echo json_encode([
            "success" => false,
            "message" => "Registrasi gagal"
        ]);

    }
}
?>