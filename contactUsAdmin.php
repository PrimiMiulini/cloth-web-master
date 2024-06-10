<?php
require 'connection.php';

$per_page = 1;

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $per_page;

$total_stmt = $conn->prepare("SELECT COUNT(*) FROM complaints");
$total_stmt->execute();
$total_stmt->bind_result($total_complaints);
$total_stmt->fetch();
$total_stmt->close();

$total_pages = ceil($total_complaints / $per_page);

$stmt = $conn->prepare("SELECT * FROM complaints ORDER BY timestamp_column DESC LIMIT ?, ?");
$stmt->bind_param("ii", $offset, $per_page);
$stmt->execute();
$result = $stmt->get_result();
?>

<html>
<head>
    <title>Complaints</title>
</head>
<body>

<?php while ($row = $result->fetch_assoc()) : ?>
    <?php
    $username = $row['username'];
    $message = $row['message'];
    ?>

    <div class="complaint-box">
        <p>Username: <?= $username ?></p>
        <p>Message: <?= $message ?></p>
    </div>

<?php endwhile; ?>

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
