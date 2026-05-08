<?php
header("Access-Control-Allow-Origin: *");

$conn = mysqli_connect(
    "sql309.infinityfree.com",
    "if0_41865158",
    "9qORFm1XqWpPx7",
    "if0_41865158_web"
);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>