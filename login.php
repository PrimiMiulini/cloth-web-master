<?php
require 'connection.php';

$username = $_POST["username"];
$pwd = $_POST["pwd"];

// Check if the user is an admin
$query_sql_admin = "SELECT id, username, pwd FROM admin WHERE username=?";
$stmt_admin = $conn->prepare($query_sql_admin);
$stmt_admin->bind_param("s", $username);
$stmt_admin->execute();
$stmt_admin->store_result();

if ($stmt_admin->num_rows > 0) {
    $stmt_admin->bind_result($id, $username, $hashed_password);
    $stmt_admin->fetch();

    if (password_verify($pwd, $hashed_password)) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        header("Location: homeadmin.php");
        exit();
    } else {
        echo "<script>
            alert('Password Salah, Silahkan coba lagi.');
            window.location.href = 'index.html';
          </script>";
    }
} else {
    // Check if the user is a customer
    $query_sql_customer = "SELECT id, username, pwd FROM customer WHERE username=?";
    $stmt_customer = $conn->prepare($query_sql_customer);
    $stmt_customer->bind_param("s", $username);
    $stmt_customer->execute();
    $stmt_customer->store_result();

    if ($stmt_customer->num_rows > 0) {
        $stmt_customer->bind_result($id, $username, $hashed_password);
        $stmt_customer->fetch();

        if (password_verify($pwd, $hashed_password)) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
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

    $stmt_customer->close();
}

$stmt_admin->close();
$conn->close();
?>
