<?php

session_start();

include("../conn/conn.php");

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header("WWW-Authenticate: Basic realm=\"Private Area\"");
    header("HTTP/1.0 401 Unauthorized");
    print "Sorry - you need valid credentials to be granted access!\n";
    exit;
} else {
    $user = mysqli_real_escape_string($conn, $_SERVER['PHP_AUTH_USER']);
    $api = mysqli_real_escape_string($conn, $_SERVER['PHP_AUTH_PW']);
    $result = mysqli_query($conn, "SELECT * FROM company_api WHERE user = '$user' AND api = '$api';");

    if (mysqli_num_rows($result)) {
    
        $singlerow = $result->fetch_assoc();
        
        $_SESSION['api'] = $singlerow['api'];

    } else {
        header("WWW-Authenticate: Basic realm=\"Private Area\"");
        header("HTTP/1.0 401 Unauthorized");
        print "Sorry - you need valid credentials to be granted access!\n";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add</title>

    <!-- Favicon -->
    <link rel="icon" href="../styles/favicon.png">

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Custom CSS Stylesheet-->
    <link rel="stylesheet" href="../styles/styles.css">

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>

</head>

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark my-navbar-custom">

        <div class="container-fluid">

            <a class="navbar-brand" href="../index.php">SnapStock <i class="fas fa-cubes"></i></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="adddata.php">Admin</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Title -->

    <div class="container-fluid my-title-container">

        <div class="row">

            <div class="col-lg-6 g-0">
                <h1 class="my-main-header">Admin</h1>
            </div>
            <div class="col-lg-6 g-0">
                <img class="img-fluid" src="https://tinyurl.com/6k3ru3hf" alt="admin-photo">
            </div>

        </div>
    </div>

    <!-- Add Container -->

    <div class="container-fluid my-contact-container">

        <div class="row">

            <!-- Add Data -->
            <div class="col-lg">

                <h1 class="my-login-form" style="margin-bottom: 15px">Add Data</h1>

                <form method="POST" action="addprocess.php">

                    <div class="form-row my-login-form">

                        <!-- Company -->
                        <div class="form-group col-md">
                            <select name="company" class="form-select" id="autoSizingSelect" required>
                                <option disabled selected value>Company</option>
                                <option value="1">Apple</option>
                                <option value="3">Amazon</option>
                                <option value="4">Google</option>
                                <option value="5">Netflix</option>
                                <option value="2">Facebook</option>
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="form-group col-md">
                            <label class="my-required-field" style="margin-top: 15px">* Indicates required field.</label>
                            <input type="text" class="form-control" name="date" placeholder="YYYY-MM-DD*" required>
                        </div>

                        <!-- Open -->
                        <div class="form-group col-md">
                            <input type="number" class="form-control" step="0.01" min="0.00" name="open" placeholder="Open*" required>
                        </div>

                        <!-- High -->
                        <div class="form-group col-md">
                            <input type="number" class="form-control" step="0.01" min="0.00" name="high" placeholder="High*" required>
                        </div>

                        <!-- Low -->
                        <div class="form-group col-md">
                            <input type="number" class="form-control" step="0.01" min="0.00" name="low" placeholder="Low*" required>
                        </div>

                        <!-- Close -->
                        <div class="form-group col-md">
                            <input type="number" class="form-control" step="0.01" min="0.00" name="close" placeholder="Close*" required>
                        </div>

                        <!-- Adjusted -->
                        <div class="form-group col-md">
                            <input type="number" class="form-control" step="0.01" min="0.00" name="adjusted" placeholder="Adjusted*" required>
                        </div>

                        <!-- Volume -->
                        <div class="form-group col-md">
                            <input type="number" class="form-control" min="0.00" name="volume" placeholder="Volume*" required>
                        </div>

                        <!-- Submit -->
                        <input class="btn btn-primary my-submit-button col-md" type="submit" value="Submit">

                    </div>

                </form>

            </div>

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