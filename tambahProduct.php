<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Produk</title>
</head>
<body>
    <h2>Form Produk</h2>
    <form action="logicTambahProduct.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" id="nama_produk" name="nama_produk" required>
        </div>
        <br>
        <div>
            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" required>
        </div>
        <br>
        <div>
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" cols="50" required></textarea>
        </div>
        <br>
        <div>
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="man">Man</option>
                <option value="woman">Woman</option>
                <option value="accessoris">Accessoris</option>
            </select>
        </div>
        <br>
        <div>
            <label for="gambar">Gambar:</label>
            <input type="file" id="gambar" name="gambar" accept="image/*" required>
        </div>
        <br>
        <div>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='homeAdmin.php';">Kembali</button>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>