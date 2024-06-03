<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Produk</title>
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <!-- bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- Local css -->
    <link rel="stylesheet" href="css/tambahproduct.css"/>
    <!-- data aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>

    <section class="main" id="main">
        <main class="content" id="">
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
                    <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='homeAdmin.php';">Kembali</button>
                    <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                </div>
            </form>
        </main>
    </section>

<!-- data aos -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<!-- feather icons -->
<script>
    feather.replace();
</script>
<!-- js -->
<script src="js/index.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous">
</script>
</body>
</html>
