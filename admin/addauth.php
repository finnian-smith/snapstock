<?php

include("../conn/conn.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin</title>

    <!-- Favicon -->
    <link rel="icon" href="../styles/favicon.png">

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Custom CSS Stylesheet-->
    <link rel="stylesheet" href="../styles/styles.css">

    <!-- jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {
            $("form").submit(function(event) {

                $(".form-group").removeClass("has-error");
                $(".help-block").remove();

                var formData = {
                    user: $("#inputUser").val(),
                };

                $.ajax({
                    type: "POST",
                    url: "processadmin.php",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    console.log(data);

                    if (!data.success) {

                        if (data.errors.user) {
                            $("#user-group").addClass("has-error");
                            $("#user-group").append(
                                '<div class="help-block">' + data.errors.user + "</div>"
                            );
                        }

                    } else {
                        $("form").html(
                            '<div class="d-grid gap-2 col-10 mx-auto alert alert-success text-center" style="margin: 10px 0">User - ' + data.success + '<br>Key - ' + data.message + '</div>'
                        );

                        $(".insertbutton").html(
                            '<div class="d-grid gap-2 col-6 mx-auto" style="margin: 10px 0"><a href="adddata.php" class="btn btn-primary">Insert Data</a></div>'
                        );
                    }
                });

                event.preventDefault();
            });
        });
    </script>
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
                        <a class="nav-link active" aria-current="page" href="addauth.php">Admin</a>
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

    <!-- Add Admin -->

    <div class="container-fluid my-contact-container">

        <div class="row">

            <h1 class='my-login-form'>Add Admin</h1>
            <form method='POST' action='registering.php'>
                <div class='form-row my-login-form'>

                    <div class='form-group col-md' id='user-group'>
                        <input type='user' class='form-control' id='inputUser' name='user' placeholder='User*'>
                    </div>

                    <!-- Submit -->
                    <button type='submit' class='btn btn-primary my-submit-button col-md'>Generate Key</button>

                </div>
            </form>

            <div class="insertbutton">
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