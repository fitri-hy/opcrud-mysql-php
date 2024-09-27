<?php
include 'config/database.php';
include 'core/opcrud.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conditions = ["id" => $id];
    
    if ($userData = readData($mysqli, 'user', $conditions)) {
        $user = $userData[0];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                "username" => $_POST['username'],
                "email" => $_POST['email']
            ];
            echo updateData($mysqli, 'user', $data, $conditions) ? 
                "Data berhasil diperbarui." : "Gagal memperbarui data.";
        }
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID tidak ditemukan di URL.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <h2>Update Data</h2>

    <?php if (isset($user)): ?>
        <form action="update.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
            <br>
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            <br>
            <button type="submit">Update Data</button>
        </form>
    <?php else: ?>
        <p>Data tidak ditemukan atau ID tidak valid.</p>
    <?php endif; ?>
</body>
</html>
