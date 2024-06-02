<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product = [
        'id' => $_POST['product_id'],
        'name' => $_POST['product_name'],
        'price' => $_POST['product_price'],
        'image' => $_POST['product_image'],
        'quantity' => $_POST['quantity']
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Cek apakah produk sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product['id']) {
            $item['quantity'] += $product['quantity'];
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $product;
    }

    header('Location: detail.php?gambar=' . $product['image']);
    exit();
};

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel'])) {
  $productId = $_POST['cancel'];
  foreach ($_SESSION['cart'] as $key => $item) {
      if ($item['id'] == $productId) {
          unset($_SESSION['cart'][$key]);
          break;
      }
  }
  $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
  header('Location: ' . $_SERVER['PHP_SELF']); // Reload halaman yang sama
  exit();
}
?>


<html>
    <!-- List Chart -->
    <section id="chart-list" class="chart-list">
    <div class="container border">
        <div class="row">
            <div class="col">
                <h6 class="">Chart</h6>
            </div>
            <div class="col text-end">
                <button type="button" class="btn-close" id="close-chart" aria-label="close"></button>
            </div>
        </div>
        <form action="" method="post">
            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="row chart-items">
                        <div class="col">
                            <img src="product/<?= htmlspecialchars($item['image']) ?>" alt="" width="50" height="50">
                        </div>
                        <div class="col-6">
                            <h6><?= htmlspecialchars($item['name']) ?></h6>
                            <p><?= htmlspecialchars($item['quantity']) ?> x Rp.<?= number_format($item['price'], 0, ',', '.') ?></p>
                        </div>
                        <div class="col text-end">
                            <button type="submit" class="btn-close" name="cancel" value="<?= $item['id'] ?>"></button>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="row border mb-2">
                    <button type="button" class="btn btn-outline-success" name="chart" onclick="window.location.href='chartdetail.php'">View Chart</button>
                </div>
                <div class="row border">
                    <button type="button" class="btn btn-outline-success" name="Checkout">Checkout</button>
                </div>
            <?php else: ?>
                <div class="row">
                    <p>No items in the cart.</p>
                </div>
            <?php endif; ?>
        </form>
    </div>
</section>

      <!-- List Chart End -->

</html>