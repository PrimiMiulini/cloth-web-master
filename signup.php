<?php 
require 'connection.php';

$username = $_POST["username"];
$fullname = $_POST["fullname"];
$alamat = $_POST["alamat"];
$pwd = $_POST["pwd"];

$hashed_password = password_hash($pwd, PASSWORD_DEFAULT);


$query_check_username = "SELECT id FROM customer WHERE username = ?";
$stmt = $conn->prepare($query_check_username);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>
            alert('Username already exists. Please choose another one.');
            window.location.href = 'signUp.html';
          </script>";
} else {

    $query_sql = "INSERT INTO customer(username, fullname, alamat, pwd) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query_sql);
    $stmt->bind_param("ssss", $username, $fullname, $alamat, $hashed_password);

    if ($stmt->execute()) {
        header("location:index.php");
        exit();
    } else {
        echo "Pendaftaran gagal : " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>
