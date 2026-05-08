<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$conn = mysqli_connect(
  "sql309.infinityfree.com",
  "if0_41865158",
  "9qORFm1XqWpPx7",
  "if0_41865158_web"
);

if (!$conn) {
    echo json_encode(["error" => "Koneksi gagal"]);
    exit;
}

// =====================
// DELETE
// =====================
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    mysqli_query($conn, "DELETE FROM orders WHERE id = $id");

    echo json_encode(["status" => "deleted"]);
    exit;
}

// =====================
// READ (JOIN)
// =====================
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

$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);