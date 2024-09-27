<?php
include 'config/database.php';
include 'core/opcrud.php';

$joinCondition = "user.id = produk.id_user";
$fields = ['user.username', 'produk.title'];
$conditions = ['produk.id_user' => 1];

$data = readDataWithJoin($mysqli, 'user', 'produk', $joinCondition, $fields, $conditions);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Join</title>
</head>
<body>
    <h2>Read Join Data</h2>

    <ul>
    <?php
    if (!empty($data)) {
        foreach ($data as $row) {
    ?>
        <li>Nama: <?php echo $row['username'] ?>, Produk: <?php echo $row['title'] ?></li>
    <?php 
        }
    } else {
        echo "<p>Tidak ada data yang ditemukan.</p>";
    }
    ?>
    </ul>
</body>
</html>
