<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- My Css -->
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <!-- Navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-5">
        <div class="container">
          <a class="navbar-brand" href="index.php">SHOP<span class="text-primary">A</span></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="about.html">ABOUT</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">CONTACTUS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="signUp.html" onclick=" return confirm('SignUp?'); ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- Navbar End -->

    <!-- Hero -->
    <section class="hero">
        <main class="content">
          <form action="login.php" method="post">
            <h1 class="text-center"><span class="">Login</span></h1>
            <p style="font-style: italic; color: red;">please valid input</p>
            <div class="row ms-auto justify-content-center align-items-end mb-4">
                <div class="col-md-5">
                    <label for="Username">Username :</label>
                    <input class="form form-control-sm" type="text" name="username" id="Username" placeholder="username" required autofocus autocomplete="off">
                </div>
            </div>
            <div class="row ms-auto justify-content-center align-items-end mb-2">
                <div class="col-md-5">
                    <label for="pwd">Password :</label>
                    <input class="form form-control-sm" type="password" name="pwd" id="pwd" placeholder="password" required autocomplete="off">
                </div>
            </div>
            <div class="row ms-auto justify-content-center align-items-end mb-2">
                <div class="col-md-5">
                    <a href="signUp.html" class="text-white mb-2" style="text-decoration: none;" onclick=" return confirm('SignUp?'); ">Dont have an account?</a>
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                </div>
            </div>
          </form>
        </main>
    </section>
    <!-- End Hero -->

<!-- js -->
<script src="js/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
</body>
</html>