<?php
require 'connection.php';

// Ambil data dari form
$username = $_POST["username"];
$pwd = $_POST["pwd"];

// Periksa apakah username ada di tabel customer
$query_sql_customer = "SELECT id, username, pwd FROM customer WHERE username=?";
$stmt_customer = $conn->prepare($query_sql_customer);
$stmt_customer->bind_param("s", $username);
$stmt_customer->execute();
$stmt_customer->store_result();

if ($stmt_customer->num_rows > 0) {
    $stmt_customer->bind_result($id, $username, $hashed_password);
    $stmt_customer->fetch();

    if (password_verify($pwd, $hashed_password)) {
        // Jika username dan password benar, tambahkan ke tabel admin
        $hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT); // Hash password sebelum menyimpannya di tabel admin
        $query_sql_admin = "INSERT INTO admin (username, pwd) VALUES (?, ?)";
        $stmt_admin = $conn->prepare($query_sql_admin);
        $stmt_admin->bind_param("ss", $username, $hashed_pwd);
        if ($stmt_admin->execute()) {
            echo "<script>
                alert('Admin berhasil ditambahkan.');
                window.location.href = 'formAdmin.php';
            </script>";
        } else {
            echo "<script>
                alert('Terjadi kesalahan saat menambahkan admin.');
                window.location.href = 'formAdmin.php';
            </script>";
        }
        $stmt_admin->close();
    } else {
        echo "<script>
            alert('Password salah, coba lagi.');
            window.location.href = 'formAdmin.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Username tidak ditemukan, mohon buat akun terlebih dahulu.');
        window.location.href = 'formAdmin.php';
    </script>";
}

$stmt_customer->close();
$conn->close();
?>
