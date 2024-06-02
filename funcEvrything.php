<?php
include 'connection.php';

function query($query, $params = []) {
    global $conn;
    $stmt = mysqli_prepare($conn, $query);
    if ($params) {
        $types = str_repeat('s', count($params));
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_stmt_close($stmt);
    return $rows;
}

function cari($keyword, $category = '', $limit, $offset) {
    global $conn;
    $query = "SELECT * FROM detail_product WHERE nama_produk LIKE ?";
    $params = ["%$keyword%"];

    if (!empty($category)) {
        $query .= " AND role = ?";
        $params[] = $category;
    }

    $query .= " LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;

    return query($query, $params);
}

function getProductCount($keyword = '', $category = '') {
    global $conn;
    $query = "SELECT COUNT(*) as total FROM detail_product WHERE nama_produk LIKE ?";
    $params = ["%$keyword%"];

    if (!empty($category)) {
        $query .= " AND role = ?";
        $params[] = $category;
    }

    $stmt = mysqli_prepare($conn, $query);
    $types = str_repeat('s', count($params));
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $row['total'];
}


?>
