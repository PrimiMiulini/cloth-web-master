<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
    <link rel="stylesheet" href="css/deleteproduct.css"/>
    <!-- data aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>

    <!-- Navbar start -->
    <?php require 'navbar.php'; ?>
    <?php require 'templateChart.php'; ?>
    <!-- Navbar End -->

    <section class="main" id="main">
        <main class="content">
            <h2 class="text-center">Product Table</h2>
            <div class="row justify-content-arround">
                <div class="col-md">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="window.location.href='homeAdmin.php';">Kembali</button>
                </div>
                <div class="col-md">
                    <label for="number">Show previous product</label>
                    <input type="number" id="number" value="1" class="text-center border custom-input">
                </div>
                <div class="col-md text-center">
                    <i data-feather="arrow-down-circle"></i>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <form action="logicDeleteProduct.php" method="post">
                        <table class="table">
                            <thead class="table-info">
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
                            <tbody class="">
                                <?php $no = 1; ?>
                                <?php foreach ($products as $row) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><img src='product/<?=  htmlspecialchars($row['gambar'])  ?>' alt='Product Image' width="50"></td>
                                        <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                                        <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                                        <td>Rp.<?= number_format($row['harga'], 0, ',', '.');  ?></td>
                                        <td><?= htmlspecialchars($row['role']) ?></td>
                                        <td><input type='checkbox' name='delete[]' value='" . intval($row['id_produk']) . "'></td>
                                    </tr>
                                <?php $no++;  ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-outline-success btn-sm">Delete Selected</button>
                        <form action="logicDeleteProduct.php" method="post" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-outline-success btn-sm">Refresh</button>
                        </form>
                    </form>
                </div>
            </div>
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
    crossorigin="anonymous"
></script>
</body>
</html>
<?php
// Clear products data from session
unset($_SESSION['products']);
?>
