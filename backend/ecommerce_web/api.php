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
        "error" => mysqli_connect_error()
    ]);
    exit;
}

mysqli_set_charset($conn, "utf8");

if (isset($_GET['delete'])) {

    $id = intval($_GET['delete']);

    $delete = mysqli_query($conn, "DELETE FROM orders WHERE id = $id");

    if ($delete) {
        echo json_encode([
            "status" => "deleted"
        ]);
    } else {
        echo json_encode([
            "error" => mysqli_error($conn)
        ]);
    }

    exit;
}

$query = mysqli_query($conn, "
SELECT 
    o.id,
    u.nama,
    p.nama_produk,
    od.jumlah,
    od.subtotal,
    pay.status
FROM order_details od
JOIN orders o ON od.order_id = o.id
JOIN users u ON o.user_id = u.id
JOIN products p ON od.product_id = p.id
JOIN payments pay ON o.id = pay.order_id
");

if (!$query) {
    echo json_encode([
        "error" => mysqli_error($conn)
    ]);
    exit;
}

$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);