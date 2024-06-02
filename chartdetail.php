<?php
require 'connection.php';

// Mendapatkan data keranjang dari sesi
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart Detail</title>
    <!-- Feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Local css -->
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>

    <!-- Navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-5">
        <div class="container">
          <a class="navbar-brand" href="index.html">SHOP<span class="text-primary">A</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#product">EVERYTHING</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="women.php">WOMEN</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="men.php">MEN</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="accessories.php">ACCESSORIES</a>
              </li>
            </ul>
          </div>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">ABOUT</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">CONTACTUS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- Navbar End -->

    <!-- Main Start -->
    <main id="main" class="main">
        <div class="container">
            <h1>Cart</h1>   
            <p>Your cart</p> 
        </div>
    </main>
    <!-- Main End -->

    <!-- cart table -->
    <form action="" method="post">
        <div class="container mb-5">
            <div class="table-responsive">
                <table class="table table-bordered table-dark table-hover">
                    <thead class="bg-primary">
                      <tr class="table-primary text-center">
                        <th scope="col">No</th>
                        <th scope="col">Product</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="align-middle">
                      <?php if (!empty($cartItems)): ?>
                          <?php foreach ($cartItems as $index => $item): ?>
                          <tr>
                              <td class="text-center"><?= $index + 1 ?></td>
                              <td class="text-center"><img src="product/<?= htmlspecialchars($item['image']) ?>" alt="" title="" width="80"></td>
                              <td><?= htmlspecialchars($item['name']) ?></td>
                              <td><input value="<?= htmlspecialchars($item['quantity']) ?>" id="quantity" name="quantity[<?= $index ?>]" class="border" size="20"></td>
                              <td><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                              <td class="text-center">
                                  <input class="form-check-input" type="checkbox" name="remove[]" value="<?= $item['id'] ?>" id="flexCheckDefault">
                                  <label class="form-check-label" for="flexCheckDefault"></label>
                              </td>
                          </tr>
                          <?php endforeach; ?>
                          <tr>
                              <td colspan="6">
                                  <h6 class="float-start me-5">Total :</h6>
                                  <p>
                                  <?= number_format(array_sum(array_map(function($item) {
                                      return $item['price'] * $item['quantity'];
                                  }, $cartItems)), 0, ',', '.') ?>
                                  </p>
                              </td>
                          </tr>
                      <?php else: ?>
                          <tr>
                              <td colspan="6" class="text-center">No items in the cart.</td>
                          </tr>
                      <?php endif; ?>
                </table>
                <div class="row text-end">
                    <div class="col-10 text-start">
                        <input class="w-60 mb-3 border" type="search" placeholder="Coupon" aria-label="Search" name="cupon">
                        <button class="btn btn-outline-success btn-sm" type="submit" name="submit">Apply</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-outline-success btn-sm" name="update">UPDATE</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-outline-success btn-sm" name="delete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- cart table end -->

    <!-- Cart total -->
    <section id="ct" class="ct">
        <div class="container w-25 p-3">
            <h4>CART TOTAL</h4>
            <form action="" method="post">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td>Total</td>
                            <td>
                            <?= number_format(array_sum(array_map(function($item) {
                                return $item['price'] * $item['quantity'];
                            }, $cartItems)), 0, ',', '.') ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-outline-success">CHECKOUT</button>
            </form>
        </div>
    </section>
    <!-- Cart total End -->

    <!-- Content Start -->
    <section id="content" class="content">
      <div class="container">
        <h1>SALE UP 70% OFF FOR ALL CLOTHES</h1>
</html>