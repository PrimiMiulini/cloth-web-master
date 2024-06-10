<?php
require 'connection.php';

// Tentukan jumlah masukan yang ingin ditampilkan per halaman
$per_page = 1;

// Hitung halaman saat ini
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Hitung offset untuk query database
$offset = ($current_page - 1) * $per_page;

// Query untuk mendapatkan jumlah total masukan
$total_stmt = $conn->prepare("SELECT COUNT(*) FROM complaints");
$total_stmt->execute();
$total_stmt->bind_result($total_complaints);
$total_stmt->fetch();
$total_stmt->close();

// Hitung jumlah halaman
$total_pages = ceil($total_complaints / $per_page);

// Query untuk mendapatkan masukan untuk halaman saat ini
$stmt = $conn->prepare("SELECT * FROM complaints ORDER BY timestamp_column DESC LIMIT ?, ?");
$stmt->bind_param("ii", $offset, $per_page);
$stmt->execute();
$result = $stmt->get_result();
?>

<html>
<head>
    <title>Complaints</title>
    <!-- Tambahkan link ke file CSS Anda di sini -->
</head>
<body>

<?php while ($row = $result->fetch_assoc()) : ?>
    <?php
    // Ambil username dan pesan dari setiap baris masukan
    $username = $row['username'];
    $message = $row['message'];
    ?>

    <!-- Tampilkan kotak dengan username dan pesan -->
    <div class="complaint-box">
        <p>Username: <?= $username ?></p>
        <p>Message: <?= $message ?></p>
    </div>

<?php endwhile; ?>

<!-- Tampilkan navigasi halaman -->
<div class="pagination">
    <?php if ($current_page > 1) : ?>
        <a href="?page=<?= $current_page - 1 ?>" class="page-link">&laquo;</a>
    <?php endif; ?>
    <?php if ($current_page < $total_pages) : ?>
        <a href="?page=<?= $current_page + 1 ?>" class="page-link"> &raquo;</a>
    <?php endif; ?>
</div>

</body>
</html>
