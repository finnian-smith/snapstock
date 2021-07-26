<?php

session_start();

include("../conn/conn.php");

if (isset($_SESSION['api'])) {

    $apikey = $_SESSION['api'];

}

$company = $_POST['company'];
$date = $_POST['date'];
$open = $_POST['open'];
$high = $_POST['high'];
$low = $_POST['low'];
$close = $_POST['close'];
$adjusted = $_POST['adjusted'];
$volume = $_POST['volume'];

// security
$company = mysqli_real_escape_string($conn, $company);
$date = mysqli_real_escape_string($conn, $date);
$open = mysqli_real_escape_string($conn, $open);
$high = mysqli_real_escape_string($conn, $high);
$low = mysqli_real_escape_string($conn, $low);
$close = mysqli_real_escape_string($conn, $close);
$adjusted = mysqli_real_escape_string($conn, $adjusted);
$volume = mysqli_real_escape_string($conn, $volume);


$endpoint = "http://fsmith14.lampt.eeecs.qub.ac.uk/mainapi/api.php?key=$apikey";

$posteddata = http_build_query(
    array('company' => $company, 'date' => $date, 'open' => $open, 'high' => $high, 'low' => $low, 'close' => $close, 'adjusted' => $adjusted, 'volume' => $volume)
);

$opts = array(
    'http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => $posteddata
    )

);

$context = stream_context_create($opts);

$result = file_get_contents($endpoint, false, $context);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Added</title>

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

    <!-- Added Data -->

    <div class="container-fluid my-contact-container">

        <div class="row">

            <div class='row'>
                <div class='col'>
                    <h1 class='my-about-header'>Inserted Data</h1>
                </div>
            </div>

            <div class='container-fluid my-stock-info' id='my-stock-table'>

                <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col' class="col-md-6">Data</th>
                            <th scope='col' class="col-md-6">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Company</td>
                            <td><?php echo $company; ?></td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td><?php echo $date; ?></td>
                        </tr>
                        <tr>
                            <td>Open</td>
                            <td><?php echo $open; ?></td>
                        </tr>
                        <tr>
                            <td>High</td>
                            <td><?php echo $high; ?></td>
                        </tr>
                        <tr>
                            <td>Low</td>
                            <td><?php echo $low; ?></td>
                        </tr>
                        <tr>
                            <td>Close</td>
                            <td><?php echo $close; ?></td>
                        </tr>
                        <tr>
                            <td>Adjusted Close</td>
                            <td><?php echo $adjusted; ?></td>
                        </tr>
                        <tr>
                            <td>Volume</td>
                            <td><?php echo $volume; ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class='d-grid gap-2 col-6 mx-auto'>
                <a href='adddata.php' class='btn btn-primary'>Insert More Data</a>
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