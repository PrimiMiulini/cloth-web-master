<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $deleteIds = $_POST['delete'];

    foreach ($deleteIds as $id) {
        $id = intval($id); // Ensure the ID is an integer
        $queryImage = mysqli_query($conn, "SELECT gambar FROM detail_product WHERE id_produk=$id");
        $imageRow = mysqli_fetch_assoc($queryImage);
        $imagePath = $imageRow['gambar'];

        $queryDelete = mysqli_query($conn, "DELETE FROM detail_product WHERE id_produk=$id");

        if ($queryDelete) {
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }
}

$query = mysqli_query($conn, "SELECT * FROM detail_product");
$products = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['products'] = $products;

header('Location: deleteProduct.php');
exit();
?>
