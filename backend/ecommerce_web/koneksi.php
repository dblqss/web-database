<?php
$conn = mysqli_connect("https://myshop42.infinityfreeapp.com", "root", "", "ecommerce");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>