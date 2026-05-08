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

$id = $_POST['id'] ?? null;
$nama = $_POST['nama_produk'] ?? '';
$harga = $_POST['harga'] ?? '';
$stok = $_POST['stok'] ?? '';
$gambar = $_POST['gambar'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? ''; // ✅ TAMBAHAN

if (!$id) {
    echo json_encode(["status" => "error", "message" => "ID tidak ditemukan"]);
    exit;
}

$query = mysqli_query($conn, "
  UPDATE products 
  SET nama_produk='$nama', 
      harga='$harga', 
      stok='$stok', 
      gambar='$gambar',
      deskripsi='$deskripsi' -- ✅ TAMBAHAN
  WHERE id='$id'
");

if ($query) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}