<?php 
include 'connection.php';
?>

<html>
<!-- Navbar start -->
    <!-- statement to style nav -->
    <?php if( basename($_SERVER['PHP_SELF']) == 'evrything.php' ) : ?>
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top mb-5" id="mainNavbar">
    <?php elseif( basename($_SERVER['PHP_SELF']) == 'women.php' ) : ?>
      <nav class="navbar navbar-expand-lg fixed-top mb-5" id="mainNavbar">
    <?php elseif( basename($_SERVER['PHP_SELF']) == 'men.php' ) : ?>
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top mb-5" id="mainNavbar">
    <?php elseif( basename($_SERVER['PHP_SELF']) == 'accessories.php' ) : ?>
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top mb-5" id="mainNavbar">
    <?php elseif( basename($_SERVER['PHP_SELF']) == 'detail.php' ) : ?>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-5" id="mainNavbar">
    <?php endif; ?>
      <div class="container">
        <a class="navbar-brand" href="home.php">SHOP<span class="text-primary">A</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'evrything.php' ? 'active' : '' ?>" aria-current="page" href="evrything.php">EVERYTHING</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'women.php' ? 'active' : '' ?>" href="women.php">WOMEN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'men.php' ? 'active' : '' ?>" href="men.php">MEN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'accessories.php' ? 'active' : '' ?>" href="accessories.php
              ">ACCESSORIES</a>
            </li>
          </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>" aria-current="page" href="#">ABOUT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>" aria-current="page" href="#">CONTACTUS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#" id="chart">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket3" viewBox="0 0 16 16">
                  <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6z"/>
                  </svg>
              </a>
            </li>
            <li class="nav-item">
            <form id="logoutForm" method="post" action="logout.php" style="display: none;">
              <button type="submit" name="logout" style="border: none; background: none;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
              </svg>
              </button>
            </form>
              <a class="nav-link active" aria-current="page" href="#" onclick="document.getElementById('logoutForm').submit(); return false;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                      <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                  </svg>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</html>