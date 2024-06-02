<?php
require 'connection.php';

$username = $_POST["username"];
$pwd = $_POST["pwd"];


$query_sql = "SELECT id, username, pwd FROM customer WHERE username=?";
$stmt = $conn->prepare($query_sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $username, $hashed_password);
    $stmt->fetch();

    if (password_verify($pwd, $hashed_password)) {
        session_start();
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
    } else {
        echo "<script>
            alert('Password Salah, Silahkan coba lagi.');
            window.location.href = 'index.html';
          </script>";
    }
} else {
    echo "<script>
            alert('Username Tidak ditemukan, Silahkan coba lagi.');
            window.location.href = 'index.html';
          </script>";
}

$stmt->close();
$conn->close();
?>