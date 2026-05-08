<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = mysqli_connect("https://myshop42.infinityfreeapp.com", "root", "", "ecommerce");

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Koneksi gagal"]);
    exit;
}

// ambil id dari POST
$id = $_POST['id'] ?? null;

if (!$id) {
    echo json_encode(["status" => "error", "message" => "ID tidak ditemukan"]);
    exit;
}

// query delete
$query = mysqli_query($conn, "DELETE FROM products WHERE id = '$id'");

if ($query) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}