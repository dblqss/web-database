<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}
?>
header("Content-Type: application/json");

$conn = mysqli_connect(
  "sql309.infinityfree.com",
  "if0_41865158",
  "9qORFm1XqWpPx7",
  "if0_41865158_web"
);

if(!$conn){
    die(json_encode([
        "error" => mysqli_connect_error()
    ]));
}

$query = mysqli_query($conn, "SELECT * FROM products");

if(!$query){
    die(json_encode([
        "sql_error" => mysqli_error($conn)
    ]));
}

$data = [];

while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;
}

echo json_encode($data);

?>