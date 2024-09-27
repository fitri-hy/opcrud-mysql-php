<?php
include 'config/database.php';
include 'core/opcrud.php';

if (isset($_GET['id'])) {

    $conditions = ["id" => $_GET['id']];

    echo deleteData($mysqli, 'user', $conditions) ? 
        "Data berhasil dihapus." : "Gagal menghapus data.";
} else {
    echo "ID tidak ditemukan di URL.";
}
?>
