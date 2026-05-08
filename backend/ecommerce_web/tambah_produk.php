<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

header("Content-Type: application/json");
$conn = mysqli_connect("https://myshop42.infinityfreeapp.com", "root", "", "ecommerce");

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Koneksi gagal"]);
    exit;
}

// ambil data dari request
$nama = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];
$gambar = $_POST['gambar']; // sementara text dulu (nama file)
$deskripsi = $_POST['deskripsi'] ?? ''; // ✅ TAMBAHAN

// query insert
$query = mysqli_query($conn, 
  "INSERT INTO products (nama_produk, harga, stok, gambar, deskripsi)
   VALUES ('$nama', '$harga', '$stok', '$gambar', '$deskripsi')"
);

if ($query) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}