<?php
require 'connection.php';

// Debugging: Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    
    // Debugging: Display input data
    echo "Received Username: " . $username . "<br>";
    echo "Received Password: " . $pwd . "<br>";

    if (!empty($username) && !empty($pwd)) {
        // Debugging: Confirm connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            echo "Database connected successfully.<br>";
        }

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
                session_start();
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                header("Location: homeadmin.php");
                exit();
            } else {
                echo "<script>
                    alert('Password Salah, Silahkan coba lagi.');
                    window.location.href = 'index.html';
                </script>";
                exit(); // Ensure script stops executing
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
                    exit(); // Ensure script stops executing
                }
            } else {
                echo "<script>
                        alert('Username Tidak ditemukan, Silahkan coba lagi.');
                        window.location.href = 'index.html';
                    </script>";
                exit(); // Ensure script stops executing
            }

            $stmt_customer->close();
        }

        $stmt_admin->close();
        $conn->close();
    } else {
        echo "<script>
                alert('Username atau Password tidak boleh kosong.');
                window.location.href = 'index.html';
              </script>";
        exit(); // Ensure script stops executing
    }
} else {
    echo "<script>
            alert('Invalid request method.');
            window.location.href = 'index.html';
          </script>";
    exit(); // Ensure script stops executing
}
?>
