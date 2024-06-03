<?php
session_start();
if (!isset($_SESSION['products'])) {
    header('Location: logicDeleteProduct.php');
    exit();
}

$products = $_SESSION['products'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Table</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
        }
    </style>
</head>
<body>
    <h2>Product Table</h2>
    <button type="button" class="btn btn-secondary" onclick="window.location.href='homeAdmin.php';">Kembali</button>
    <form action="logicDeleteProduct.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Role</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($products as $row) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td><img src='" . htmlspecialchars($row['gambar']) . "' alt='Product Image'></td>";
                    echo "<td>" . htmlspecialchars($row['nama_produk']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
                    echo "<td>Rp." . number_format($row['harga'], 0, ',', '.') . "</td>";
                    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                    echo "<td><input type='checkbox' name='delete[]' value='" . intval($row['id_produk']) . "'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <button type="submit">Delete Selected</button>
        <form action="logicDeleteProduct.php" method="post" style="margin-top: 20px;">
        <button type="submit">Refresh</button>
    </form>
    </form>
</body>
</html>
<?php
// Clear products data from session
unset($_SESSION['products']);
?>
