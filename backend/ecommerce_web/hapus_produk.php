<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$conn = mysqli_connect(
    "sql309.infinityfree.com",
    "if0_41865158",
    "9qORFm1XqWpPx7",
    "if0_41865158_web"
);

if (!$conn) {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_connect_error()
    ]);
    exit;
}

$id = $_POST['id'] ?? '';

if (!$id) {
    echo json_encode([
        "status" => "error",
        "message" => "ID tidak ditemukan"
    ]);
    exit;
}

$query = mysqli_query($conn,
    "DELETE FROM products WHERE id = '$id'"
);

if ($query) {
    echo json_encode([
        "status" => "success"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}