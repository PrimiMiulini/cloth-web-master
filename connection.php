<?php
// Periksa apakah sesi sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$servername = "localhost";
$database = "cloth";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Koneksi gagal : " . mysqli_connect_error());
}

?>