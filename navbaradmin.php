<?php 
include 'connection.php';
?>

<html>
<!-- Navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top mb-5" id="mainNavbar">
      <div class="container">
        <a class="navbar-brand" href="homeadmin.php">SHOP<span class="text-primary">A</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav align-items-center ms-auto">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="addAdmin.php" id="plus">
                <i data-feather="plus"></i>
              </a>
            </li>
            <li class="nav-item">
              <form id="logoutForm" method="post" action="logout.php" style="display: none;">
                <input type="hidden" name="logout" value="1">
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