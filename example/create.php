<?php
include 'config/database.php';
include 'core/opcrud.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        "username" => $_POST['username'],
        "email" => $_POST['email']
    ];

    echo createData($mysqli, 'user', $data) ? 
        "Data berhasil ditambahkan." : "Gagal menambahkan data.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menambahkan Data</title>
</head>
<body>
    <h2>Menambahkan Data</h2>
    <form action="create.php" method="POST">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <button type="submit">Tambah Data</button>
    </form>
</body>
</html>
