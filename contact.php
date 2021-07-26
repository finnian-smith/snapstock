<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact</title>

    <!-- Favicon -->
    <link rel="icon" href="styles/favicon.png">

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Custom CSS Stylesheet-->
    <link rel="stylesheet" href="styles/styles.css">

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
                    query: $("#inputQuery").val(),
                    name: $("#inputName").val(),
                    email: $("#inputEmail").val(),
                    subject: $("#inputSubject").val(),
                    comments: $("#inputComments").val(),
                };

                $.ajax({
                    type: "POST",
                    url: "processcontact.php",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    console.log(data);

                    if (!data.success) {
                        if (data.errors.query) {
                            $("#query-group").addClass("has-error");
                            $("#query-group").append(
                                '<div class="help-block" style="margin-bottom: 10px">' + data.errors.query + "</div>"
                            );
                        }

                        if (data.errors.name) {
                            $("#name-group").addClass("has-error");
                            $("#name-group").append(
                                '<div class="help-block">' + data.errors.name + "</div>"
                            );
                        }

                        if (data.errors.email) {
                            $("#email-group").addClass("has-error");
                            $("#email-group").append(
                                '<div class="help-block">' + data.errors.email + "</div>"
                            );
                        }

                        if (data.errors.subject) {
                            $("#subject-group").addClass("has-error");
                            $("#subject-group").append(
                                '<div class="help-block">' + data.errors.subject + "</div>"
                            );
                        }

                        if (data.errors.comments) {
                            $("#comments-group").addClass("has-error");
                            $("#comments-group").append(
                                '<div class="help-block" style="margin-bottom: 10px">' + data.errors.comments + "</div>"
                            );
                        }

                    } else {
                        $("form").html(
                            '<div class="alert alert-success text-center">' + "Thanks for your message!" + "</div>"
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
                        <a class="nav-link" href="preferences.php">Preferences</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Title -->

    <div class="container-fluid my-title-container">

        <div class="row">

            <div class="col-lg-6 g-0">
                <h1 class="my-main-header">Contact</h1>
            </div>
            <div class="col-lg-6 g-0">
                <img class="img-fluid" src="https://tinyurl.com/2mwv4fbr" alt="contact-photo">
            </div>

        </div>
    </div>

    <!-- Contact -->

    <div class="container-fluid my-contact-container">

        <div class="row">

            <!-- Left side -->
            <div class="col-lg-6">

                <h1 class="my-contact-form">Contact Us</h1>

                <form method="POST" action="processcontact.php">

                    <div class="form-row my-contact-form">

                        <!-- Contacting about: -->
                        <div class="form-group col-md" id="query-group">
                            <label for="inputQuery">I am contacting you about:</label>
                            <select name="query" id="inputQuery" class="form-control form-select">
                                <option disabled selected value>Choose...</option>
                                <option>General Enquiries</option>
                                <option>FAANG Information</option>
                                <option>Stock Information</option>
                            </select>
                        </div>

                        <!-- Name -->
                        <div class="form-group col-md" id="name-group">
                            <label class="my-required-field">* Indicates required field.</label>
                            <input type="name" class="form-control" name="name" id="inputName" placeholder="Name*">
                        </div>

                        <!-- Email -->
                        <div class="form-group col-md" id="email-group">
                            <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email Address*">
                        </div>

                        <!-- Subject -->
                        <div class="form-group col-md" id="subject-group">
                            <input type="text" class="form-control" name="subject" id="inputSubject" placeholder="Subject*">
                        </div>

                        <!-- Comments -->
                        <div class="form-group col-md" id="comments-group">
                            <textarea type="text" class="form-control" name="comments" id="inputComments" placeholder="Comments*"></textarea>
                        </div>

                        <!-- Checkbox -->
                        <div class="form-group">
                        <hr>
                            <div class="form-check" id="checkbox-group">
                                <input class="form-check-input" name="checkbox" type="checkbox" id="gridCheck" required>
                                I accept the <a class="my-t-and-c" href="#">Terms & Conditions</a> of SnapStock.
                            </div>
                        </div>

                        <!-- Submit -->
                        <input class="btn btn-primary my-submit-button col-md" type="submit" value="Submit">

                    </div>

                </form>

            </div>

            <!-- Right side -->
            <div class="col-lg-6">

                <div class="card text-dark bg-light mb-3 my-note-card">
                    <div class="card-body">
                        <h3 class="card-title">Note</h3>
                        <p class="card-text">SnapStock was originally created for a university project. We planted the
                            seed but the idea has gone on to grow into something more. We're FAANG enthusiasts with a
                            penchant for all things financial and we're keen to show the world the wonderful work of
                            these companies over the last number of years.</p>

                        <p class="card-text">The opinions
                            expressed on this website as well as any dialogue exchanged via email are for general
                            informational purposes only and are not intended to
                            provide specific advice or recommendations for any individual or on any specific security or
                            investment product. It is only intended to provide education about the financial industry.
                        </p>

                        <p class="card-text">We look forward to hearing from you! <br><em>SnapStock Team</em></p>
                    </div>
                </div>

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