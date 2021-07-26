<?php

session_start();

include("conn/conn.php");


if (isset($_SESSION['user'])) {

    $userid = $_SESSION['user'];
} else {
    $userid = 0;
}



// reads
$read1 = "SELECT company_key.company
        FROM company_key
        INNER JOIN company_preferences
        ON company_key.id = company_preferences.first
        INNER JOIN company_user
        ON company_preferences.userid = company_user.id
        WHERE company_user.id = $userid";

$read2 = "SELECT company_key.company
        FROM company_key
        INNER JOIN company_preferences
        ON company_key.id = company_preferences.second
        INNER JOIN company_user
        ON company_preferences.userid = company_user.id
        WHERE company_user.id = $userid";

$read3 = "SELECT company_key.company
        FROM company_key
        INNER JOIN company_preferences
        ON company_key.id = company_preferences.third
        INNER JOIN company_user
        ON company_preferences.userid = company_user.id
        WHERE company_user.id = $userid";

$read4 = "SELECT company_key.company
        FROM company_key
        INNER JOIN company_preferences
        ON company_key.id = company_preferences.fourth
        INNER JOIN company_user
        ON company_preferences.userid = company_user.id
        WHERE company_user.id = $userid";

$read5 = "SELECT company_key.company
        FROM company_key
        INNER JOIN company_preferences
        ON company_key.id = company_preferences.fifth
        INNER JOIN company_user
        ON company_preferences.userid = company_user.id
        WHERE company_user.id = $userid";


// first
$result1 = $conn->query($read1);

// convert row to associative array (one row so no need for loop)
$row1 = $result1->fetch_assoc();

$first = $row1['company'];

// second
$result2 = $conn->query($read2);

$row2 = $result2->fetch_assoc();

$second = $row2['company'];

// third
$result3 = $conn->query($read3);

$row3 = $result3->fetch_assoc();

$third = $row3['company'];

// fourth
$result4 = $conn->query($read4);

$row4 = $result4->fetch_assoc();

$fourth = $row4['company'];

// fifth
$result5 = $conn->query($read5);

$row5 = $result5->fetch_assoc();

$fifth = $row5['company'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Preferences</title>

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
            if (isset($_POST['username']) && isset($_POST['password'])) {
            }
            ?>

            <?php

            if (!isset($_SESSION['user'])) {

                // not logged in -> prompt to log in
                echo "
            <div class='col-lg'>

                <h1 class='my-login-form'>Log In</h1>
                <form method='POST' action='processlogin.php'>
                    <div class='form-row my-login-form'>

                        <label for='inputQuery'>Login to rank/view your preferences:</label>

                        <div class='form-group col-md'>
                            <input type='username' class='form-control' id='inputUsername' name ='username' placeholder='Username*' required>
                        </div>

                        <!-- Password -->
                        <div class='form-group col-md'>
                            <input type='password' class='form-control' id='inputPassword' name='password' placeholder='Password*' required>
                        </div>

                        <!-- Submit -->
                        <button type='submit' class='btn btn-primary my-submit-button col-md'>Login</button>

                        <p>Not yet registered? Click <a href='register.php'>here</a>.</p>

                    </div>
                </form>
            </div>";
            } else {

                // echo all users preferences here
                // if user hasn't already ranked their preferences
                if (!$result1 && !$result2 && !$result3 && !$result4 && !$result5) {

                    echo $conn->error;
                }

                echo "<div class='row'>
                <div class='col'>
                    <h1 class='my-about-header'>Your Preferences</h1>
                </div>
            </div>";

                // echo all users preferences here
                echo "
        <div class='container-fluid my-stock-info' id='my-stock-table'>

        <form method='POST' action='processranking.php'>
                <table class='table'>
                        <thead>
                            <tr>
                                <th scope='col'>Ranking</th>
                                <th scope='col'>Company</th>
                                <th scope='col'>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1st</td>
                                <td>{$first}</td>
                                <td>
                                    <select name='first' class='form-select' id='autoSizingSelect'>
                                        <option disabled selected value>First</option>
                                        <option value='1'>Apple</option>
                                        <option value='3'>Amazon</option>
                                        <option value='4'>Google</option>
                                        <option value='5'>Netflix</option>
                                        <option value='2'>Facebook</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>2nd</td>
                                <td>{$second}</td>
                                <td>
                                    <select name='second' class='form-select' id='autoSizingSelect'>
                                        <option disabled selected value>Second</option>
                                        <option value='1'>Apple</option>
                                        <option value='3'>Amazon</option>
                                        <option value='4'>Google</option>
                                        <option value='5'>Netflix</option>
                                        <option value='2'>Facebook</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>3rd</td>
                                <td>{$third}</td>
                                <td>
                                    <select name='third' class='form-select' id='autoSizingSelect'>
                                        <option disabled selected value>Third</option>
                                        <option value='1'>Apple</option>
                                        <option value='3'>Amazon</option>
                                        <option value='4'>Google</option>
                                        <option value='5'>Netflix</option>
                                        <option value='2'>Facebook</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>4th</td>
                                <td>{$fourth}</td>
                                <td>
                                    <select name='fourth' class='form-select' id='autoSizingSelect'>
                                        <option disabled selected value>Fourth</option>
                                        <option value='1'>Apple</option>
                                        <option value='3'>Amazon</option>
                                        <option value='4'>Google</option>
                                        <option value='5'>Netflix</option>
                                        <option value='2'>Facebook</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>5th</td>
                                <td>{$fifth}</td>
                                <td>
                                    <select name='fifth' class='form-select' id='autoSizingSelect'>
                                        <option disabled selected value>Fifth</option>
                                        <option value='1'>Apple</option>
                                        <option value='3'>Amazon</option>
                                        <option value='4'>Google</option>
                                        <option value='5'>Netflix</option>
                                        <option value='2'>Facebook</option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        
        </div>

            <div class='d-grid gap-2 col-6 mx-auto'>
                <input class='btn btn-primary' type='submit' value='Submit Edit'>
                <a href='logout.php' class='btn btn-danger' style='margin: 20px 0'>Log Out</a>
            </div>
            
            </form>";
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