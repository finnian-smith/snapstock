<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <!-- Favicon -->
    <link rel="icon" href="styles/favicon.png">

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Custom CSS Stylesheet-->
    <link rel="stylesheet" href="styles/styles.css">

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>

</head>

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark my-navbar-custom">

        <div class="container-fluid">

            <a class="navbar-brand" href="index.php">SnapStock <i class="fas fa-cubes"></i></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="prices.php">Prices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="preferences.php">Preferences</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Title -->

    <div class="container-fluid my-title-container">

        <div class="row">

            <div class="col-lg-6 g-0">
                <h1 class="my-main-header">Preferences</h1>
            </div>
            <div class="col-lg-6 g-0">
                <img class="img-fluid" src="https://tinyurl.com/cs29j2tr" alt="contact-photo">
            </div>

        </div>
    </div>

    <!-- Contact -->

    <div class="container-fluid my-contact-container">

        <div class="row">

        <?php

            if (!isset($_SESSION['user'])) {

                // not logged in -> prompt to log in
                echo "
            <div class='col-lg'>

                <h1 class='my-login-form'>Register</h1>
                <form method='POST' action='registering.php'>
                    <div class='form-row my-login-form'>

                        <label for='inputQuery'>Register to rank your preferences:</label>

                        <div class='form-group col-md'>
                            <input type='username' class='form-control' id='inputUsername' name='username' placeholder='Username*' required>
                        </div>

                        <div class='form-group col-md'>
                            <input type='text' class='form-control' id='inputPassword' name='password' placeholder='Password*' required>
                        </div>

                        <div class='form-group col-md'>
                            <input type='text' class='form-control' id='inputEmail' name='email' placeholder='Email Address*' required>
                        </div>

                        <!-- Submit -->
                        <button type='submit' class='btn btn-primary my-submit-button col-md'>Register</button>

                        <p>Already registered? Click <a href='preferences.php'>here</a> to log in.</p>

                    </div>
                </form>
            </div>";
            } else {

                // logged in? -> preferences
                header("Location: preferences.php");
            }

        ?>

        </div>

    </div>

    <!-- Footer -->

    <footer class="my-grey-section" id="footer">

        <div class="container-fluid">

            <a href="#"><i class="my-social-icon fab fa-facebook-f"></i></a>
            <a href="#"><i class="my-social-icon fab fa-twitter"></i></a>
            <a href="#"><i class="my-social-icon fab fa-instagram"></i></a>

            <p class="my-copyright">© Copyright 2021 SnapStock</p>

        </div>

    </footer>



</body>

</html>