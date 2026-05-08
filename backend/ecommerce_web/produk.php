<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = mysqli_connect(
  "sql309.infinityfree.com",
  "if0_41865158",
  "9qORFm1XqWpPx7",
  "if0_41865158_web"
);

if (!$conn) {
    echo json_encode(["error" => "Koneksi database gagal"]);
    exit;
}

// 🔧 set charset biar aman encoding
mysqli_set_charset($conn, "utf8");

// 🔧 query
$query = mysqli_query($conn, "SELECT id, nama_produk, harga, stok, gambar, deskripsi FROM products");

// 🔧 cek error query (tanpa ubah struktur output sukses)
if (!$query) {
    echo json_encode(["error" => mysqli_error($conn)]);
    exit;
}

$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

// 🔧 tetap output array (TIDAK DIUBAH)
echo json_encode($data);