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


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About</title>
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Google fonts-->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,700"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700"
      rel="stylesheet"
      type="text/css"
    />
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <!-- My Css -->
    <link rel="stylesheet" href="css/about.css" />
  </head>
  <body>
    <!-- Navbar start -->
    <?php require 'navbar.php'; ?>
    <!-- Navbar End -->

    <!-- hero start -->
    <section id="hero" class="hero">
      <div class="container">
        <div class="row">
        </div>
      </div>
    </section>
    <!-- hero end -->

    <!-- About Start -->
    <section id="about" class="about m-4 p-4">
      <div class="container p-4">
        <h2
          class="text-center mb-4"
          data-aos="fade-down"
          data-aos-offset="250"
          data-aos-duration="1500"
        >
          ABOUT OUR PRODUCT
        </h2>
        <div class="row">
          <div class="col-xl-5">
            <h5>SHOP<span>A</span></h5>
            <h6>We Are Cloth Company </h6>
            <p>Our product base on australia melbourne, we put quality in every shape for customer. Here's a well-crafted "About Us" section in English for a fashion e-commerce website:
            Welcome to SHOPA, where style meets passion. Born from a love for fashion and a desire to make high-quality, trendsetting pieces accessible to all, our journey began in 2024 with a simple idea: to empower individuals through clothing that reflects their unique personalities.
            At SHOPA, we believe that fashion is more than just fabric—it's a form of self-expression. Our team of dedicated designers scours the globe for the latest trends, curating a collection that spans from timeless classics to avant-garde statements. Whether you're dressing for the boardroom, a night out, or a casual weekend, we have something to suit every occasion and style.</p>
          </div>
          <div class="col-xl-7">
            <div class="row align-items-center">
              <div class="col-md text-center">
                <h5>Our Partner</h5>
              <div class="col-md text-center">
                <img src="img/content/master-c.png" width="100">
              </div>
              <div class="col-md text-center">
                <img src="img/content/pp.png" width="100">
              </div>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-md text-center">
                <ul>
                  <li>
                    <P class="mt-4 mb-4">WE SAVE YOUR DATA!</P>
                    <i data-feather="lock" width="50" class="mb-4 "></i>
                  </li>
                  <li>
                    <P class="mb-4">WE PUT STABILIZE NETWORK!</P>
                    <i data-feather="activity" width="50"></i>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row align-items-center">
          <div class="col-md">
            <img
              data-aos="flip-right"
              data-aos-offset="400"
              data-aos-delay="150"
              data-aos-duration="1500"
              src="img/hero/hero4.jpg"
              class="float-md-start me-4"
              alt=""
              width="350"
            />
          </div>
          <div class="col-md">
            <h4 class="">SHOP<span class="text-primary">A</span> Company</h4>
            <h5>
              We are a company where give a your daily wear, as a company we
              fully supervise our product and service to customer.
            </h5>
            <p><i data-feather="award" class="me-2"></i>We put quality first</p>
            <p>
              <i data-feather="check" class="me-2"></i>We detailing evry shape
            </p>
            <p>
              <i data-feather="cloud-lightning" class="me-2"></i>We test a
              material evrywhere
            </p>
            <h6>We are based on melbourne australia.</h6>
            <p>
              <i data-feather="map-pin" width="15" class="me-2"></i>Burnswick
              Town City.
            </p>
          </div>
        </div>
      </div>
      </div>
    </section>
    <!-- About End -->

    <!-- ContactUs Start -->
    <section class="contact" id="contact">
      <h2 class="text-center">Contact Us</h2>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md">
            <form action="" method="post">

              <!-- Hidden field to store the username -->
              <input type="hidden" name="username" value="<?= htmlspecialchars($_SESSION['username']) ?>">

              <div class="row">
                <!-- Textarea for message -->
                <label for="message" class="text-success">Message:</label><br>
                <textarea id="message" name="message" rows="4" required autocomplete="off"></textarea><br><br>
              </div>
              <div class="row">
                <div class="col-md-1">
                  <!-- Submit button -->
                  <button type="submit" class="btn btn-outline-success name="submit">Submit</button>
                </div>
                <div class="col-md-2">
                  <!-- Back to Home button -->
                  <button type="button" class="btn btn-warning" onclick="window.location.href='home.php'">Back to Home</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- ContactUs End -->
    

    <!-- Content Start -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path
        fill="#191d6f"
        fill-opacity="1"
        d="M0,96L48,106.7C96,117,192,139,288,165.3C384,192,480,224,576,213.3C672,203,768,149,864,154.7C960,160,1056,224,1152,261.3C1248,299,1344,309,1392,314.7L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
      ></path>
    </svg>
    <section id="content" class="content">
      <div class="container">
        <h1>SALE UP 70% OFF FOR ALL CLOTHES</h1>
        <div class="row">
          <div class="col-main">
            <h3>SHOPA</h3>
            <p>The best look anytime, anywhere.</p>
          </div>
          <div class="col">
            <h3>For Her</h3>
            <ul>
              <li><a href="">Women Bottom</a></li>
              <li><a href="">Women Top</a></li>
              <li><a href="">Women Accessories</a></li>
            </ul>
          </div>
          <div class="col">
            <h3>For Him</h3>
            <ul>
              <li><a href="">Men Bottom</a></li>
              <li><a href="">Men Top</a></li>
              <li><a href="">Men Accessories</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- Content End -->

    <!-- Footer Start -->
    <footer class="footer">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col">
            <p class="text-center">
              All right reserved
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="10"
                height="16"
                fill="currentColor"
                class="bi bi-c-circle"
                viewBox="0 0 16 16"
              >
                <path
                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.146 4.992c-1.212 0-1.927.92-1.927 2.502v1.06c0 1.571.703 2.462 1.927 2.462.979 0 1.641-.586 1.729-1.418h1.295v.093c-.1 1.448-1.354 2.467-3.03 2.467-2.091 0-3.269-1.336-3.269-3.603V7.482c0-2.261 1.201-3.638 3.27-3.638 1.681 0 2.935 1.054 3.029 2.572v.088H9.875c-.088-.879-.768-1.512-1.729-1.512"
                />
              </svg>
              <span class="text-warning"> 2024 </span>
            </p>
            <ul class="social-icons">
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="currentColor"
                  class="bi bi-instagram"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="currentColor"
                  class="bi bi-facebook"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="currentColor"
                  class="bi bi-twitter-x"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"
                  />
                </svg>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer End -->

    <!-- data aos -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <!-- feather icons -->
    <script>
      feather.replace();
    </script>
    <!-- js -->
    <script src="js/index.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
