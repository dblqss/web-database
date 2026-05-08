<?php
include 'koneksi.php';

$query = mysqli_query($conn, "
SELECT 
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi E-Commerce</title>
</head>
<body>

<h2>Data Transaksi</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Nama User</th>
    <th>Produk</th>
    <th>Jumlah</th>
    <th>Subtotal</th>
    <th>Status</th>
</tr>

<?php while($row = mysqli_fetch_assoc($query)) { ?>
<tr>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['nama_produk'] ?></td>
    <td><?= $row['jumlah'] ?></td>
    <td><?= $row['subtotal'] ?></td>
    <td><?= $row['status'] ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>