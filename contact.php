<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Contact Us</h2>
    <form action="contact.php" method="post">
        <!-- Hidden field to store the username -->
        <input type="hidden" name="username" value="<?= htmlspecialchars($_SESSION['username']) ?>">

        <!-- Textarea for message -->
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br><br>
        
        <!-- Submit button -->
        <button type="submit" name="submit">Submit</button>

        <!-- Back to Home button -->
        <button type="button" onclick="window.location.href='home.php'">Back to Home</button>
    </form>
</body>
</html>


<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $username = $_SESSION['username'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("SELECT * FROM customer WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM complaints WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($num_complaints);
        $stmt->fetch();
        $stmt->close();

        $max_complaints = 3;

        if ($num_complaints >= $max_complaints) {
            $stmt = $conn->prepare("SELECT id FROM complaints WHERE username = ? ORDER BY timestamp_column ASC LIMIT 1");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($oldest_id);
            $stmt->fetch();
            $stmt->close();

            if ($oldest_id) {
                $stmt = $conn->prepare("DELETE FROM complaints WHERE id = ?");
                $stmt->bind_param("i", $oldest_id);
                $stmt->execute();
                $stmt->close();
            }
        }

        $stmt = $conn->prepare("INSERT INTO complaints (username, message) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $message);
        $stmt->execute();
        $stmt->close();

        echo "<script>
                alert('Masukkan/Saran berhasil ditambahkan ^-^');
                window.location.href = 'contact.php';
              </script>";
        exit();
    } else {
        echo '<script>alert("Akun tidak ada");</script>';
    }
}
?>
