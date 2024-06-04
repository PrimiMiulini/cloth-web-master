<?php
// Database configuration
include 'connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $role = $_POST['role'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "product/";
    $target_file = $target_dir . basename($gambar);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES['gambar']['tmp_name']);

    if ($check !== false) {
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($imageFileType, $allowedTypes)) {
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                // Prepare an insert statement
                $sql = "INSERT INTO detail_product (nama_produk, harga, deskripsi, role, gambar) VALUES (?, ?, ?, ?, ?)";
                if ($stmt = $conn->prepare($sql)) {
                    // Bind variables to the prepared statement as parameters
                    $stmt->bind_param("sisss", $nama_produk, $harga, $deskripsi, $role, $target_file);
                    
                    // Attempt to execute the prepared statement
                    if ($stmt->execute()) {
                        echo "<script>
                            alert('Produk berhasil ditambahkan');
                            window.location.href = 'tambahproduct.php';
                          </script>";
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    // Close statement
                    $stmt->close();
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "<script>
                    alert('Error uploading file.');
                    window.location.href = 'tambahproduct.html';
                  </script>";
            }
        } else {
            echo "<script>
                alert('Only JPG, JPEG, PNG & WEBP files are allowed.');
                window.location.href = 'tambahproduct.html';
              </script>";
        }
    } else {
        echo "<script>
            alert('File bukan gambar, silahkan coba lagi.');
            window.location.href = 'tambahproduct.html';
          </script>";
    }
}

// Close connection
$conn->close();
?>
