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
