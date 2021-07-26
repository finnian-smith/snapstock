<?php

$apikey = "demokey1";

if (isset($_POST['company'])) {

    $sentcompany = $_POST['company'];
    $sentyear = $_POST['year'];
    $sentmonth = $_POST['month'];
    $sentday = $_POST['day'];

    $fulldate = $sentyear.'-'.$sentmonth.'-'.$sentday;

    $displaydate = $sentyear.'/'.$sentmonth.'/'.$sentday;

    // querying API using date & company
    $endpoint = "http://fsmith14.lampt.eeecs.qub.ac.uk/mainapi/api.php?key=$apikey&bydate=$fulldate&bycompany=$sentcompany";

    $response = file_get_contents($endpoint);

    $details = json_decode($response, true);

    foreach ($details as $row) {

        $company = $row['company'];
        $open = $row['open'];
        $high = $row['high'];
        $low = $row['low'];
        $close = $row['close'];
        $adjusted = $row['adjusted'];
        $volume = $row['volume'];

    }

} else if (isset($_POST['company1']) && isset($_POST['company2'])) {

    $sentcompany1 = $_POST['company1'];
    $sentcompany2 = $_POST['company2'];

    $sentyear = $_POST['year'];
    $sentmonth = $_POST['month'];
    $sentday = $_POST['day'];

    $fulldate = $sentyear.'-'.$sentmonth.'-'.$sentday;

    $displaydate = $sentyear.'/'.$sentmonth.'/'.$sentday;

    $endpoint = "http://fsmith14.lampt.eeecs.qub.ac.uk/mainapi/api.php?key=$apikey&bydate=$fulldate";

    $response = file_get_contents($endpoint);
    
    $details = json_decode($response, true);

    foreach ($details as $row) {
        if ($row['company'] == $sentcompany1) {
        $company1 = $row['company'];
        $open1 = $row['open'];
        $high1 = $row['high'];
        $low1 = $row['low'];
        $close1 = $row['close'];
        $adjusted1 = $row['adjusted'];
        $volume1 = $row['volume'];
        
        }
        
        if ($row['company'] == $sentcompany2) {
        $company2 = $row['company'];
        $open2 = $row['open'];
        $high2 = $row['high'];
        $low2 = $row['low'];
        $close2 = $row['close'];
        $adjusted2 = $row['adjusted'];
        $volume2 = $row['volume'];
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Prices</title>

    <!-- Favicon -->
    <link rel="icon" href="styles/favicon.png">

    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Custom CSS Stylesheet-->
    <link rel="stylesheet" href="styles/styles.css">

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>

    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script>
        $(function() {

            // standard page load
            // make this into it's own function???
            $(".my-stock-info").show();
            $(".my-date-comp").hide();
            $("#my-stock-price-data-2").hide();
            $("#my-stock-table").hide();
            $(".my-lookup-button-1").show();

            // page load if comparing
            if ($(".form-check-input").is(":checked")) {
                $(".my-stock-info").hide();
                $(".my-date-comp").show();
                $("#my-stock-price-data-2").show();
                $("#my-stock-table").show();
                $(".my-lookup-button-1").hide();
                $(".my-search").addClass("col-md-4");
                $(".my-company-search").hide();
            }

            // click on compare switch
            $('.form-check-input').click(function() {

                if ($('input[type=checkbox]').prop('checked')) {

                    $(".my-stock-info").hide();
                    $(".my-date-comp").show();
                    $("#my-stock-price-data-2").show();
                    $("#my-stock-table").show();
                    $(".my-lookup-button-1").hide();
                    $(".my-search").addClass("col-md-4");
                    $(".my-company-search").hide();
                    $(".no-data").hide();

                } else {
                    $(".my-stock-info").show();
                    $(".my-date-comp").hide();
                    $("#my-stock-price-data-2").hide();
                    $("#my-stock-table").hide();
                    $(".my-lookup-button-1").show();
                    $(".my-search").removeClass("col-md-4");
                    $(".my-company-search").show();
                    $(".no-data").hide();
                }

            })
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
                        <a class="nav-link active" aria-current="page" href="prices.php">Prices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="preferences.php">Preferences</a>
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
                <h1 class="my-main-header">Prices</h1>
            </div>
            <div class="col-lg-6 g-0">
                <img class="img-fluid" src="https://tinyurl.com/55kub337" alt="stock-price-photo">
            </div>

        </div>
    </div>

    <!-- Price Lookup -->

    <div class="container-fluid my-about-container">

        <div class="row">
            <div class="col">
                <h1 class="my-about-header">Historical Stock Price Lookup</h1>
                <div class="form-check form-switch">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <?php
                        // alters button but not webpage
                        if (!isset($_POST['compare'])) {
                            echo "<input class='form-check-input' name='compare' type='checkbox' id='flexSwitchCheckDefault'>
                        <label class='form-check-label' for='flexSwitchCheckDefault'>Compare</label>";
                        } else {
                            echo "<input class='form-check-input' name='compare' type='checkbox' id='flexSwitchCheckChecked' checked>
                        <label class='form-check-label' for='flexSwitchCheckChecked'>Compare</label>";
                        }
                    ?>
                </div>
            </div>
        </div>


        <!-- 1st Lookup Form -->

        <div class="row">
            <div class="col">
                <h5 class="my-date-comp">Date</h5>
                 <div class="row gy-2 gx-3 align-items-center my-price-form" id="my-stock-price-data-1">
                    <div class="my-search my-company-search col-md col-sm-12">
                        <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                        <select name="company" class="form-select" id="autoSizingSelect">
                            <option disabled selected value>Company</option>
                            <option value="1">Apple</option>
                            <option value="3">Amazon</option>
                            <option value="4">Google</option>
                            <option value="5">Netflix</option>
                            <option value="2">Facebook</option>
                        </select>
                    </div>
                    <div class="my-search col-md col-sm-12">
                        <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                        <select name="year" class="form-select" id="autoSizingSelect">
                            <option disabled selected value>Year</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                        </select>
                    </div>
                    <div class="my-search col-md col-sm-12">
                        <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                        <select name="month" class="form-select" id="autoSizingSelect">
                            <option disabled selected value>Month</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="my-search col-md col-sm-12">
                        <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                        <select name="day" class="form-select" id="autoSizingSelect">
                            <option disabled selected value>Day</option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                    </div>
                    <div class="my-search col-md col-sm-12">
                        <input class="btn btn-primary my-lookup-button-1" type="submit" value="Look Up">
                    </div>


                <h5 class="my-date-comp">Companies</h5>
                <div class="row gy-2 gx-3 align-items-center my-price-form" id="my-stock-price-data-2">
                    <div class="col-md-4 col-sm-12">
                        <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                        <select name="company1" class="form-select" id="autoSizingSelect">
                            <option disabled selected value>Company</option>
                            <option value="Apple">Apple</option>
                            <option value="Amazon">Amazon</option>
                            <option value="Google">Google</option>
                            <option value="Netflix">Netflix</option>
                            <option value="Facebook">Facebook</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                        <select name="company2" class="form-select" id="autoSizingSelect">
                            <option disabled selected value>Company</option>
                            <option value="Apple">Apple</option>
                            <option value="Amazon">Amazon</option>
                            <option value="Google">Google</option>
                            <option value="Netflix">Netflix</option>
                            <option value="Facebook">Facebook</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <input class="btn btn-primary my-lookup-button-2" type="submit" value="Look Up">
                    </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Stock Info -->

    <?php // start echo on P1

    if (isset($_POST['company'])) {

        if (isset($open)) {

        echo "

        <div class='container-fluid my-stock-info'>

        <div class='row'>
            <div class='col my-stock-info'>
                <div class='card text-dark bg-light mb-3 my-note-card'>
                    <div class='card-body'>
                        <h3 class='card-title'>$company - $displaydate</h3>
                    </div>
                </div>
            </div>
        </div>
            
            <div class='row row-cols-2'>

                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <p class='my-stock-var'>Opening Price</p>
                    <h1 class='my-stock-result'>$$open</h1>
                </div>

                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <p class='my-stock-var'>Closing Price</p>
                    <h1 class='my-stock-result'>$$close</h1>
                </div>

                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <p class='my-stock-var'>Adjusted Close</p>
                    <h1 class='my-stock-result'>$$adjusted</h1>
                </div>

                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <p class='my-stock-var'>Intraday High</p>
                    <h1 class='my-stock-result'>$$high</h1>
                </div>

                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <p class='my-stock-var'>Intraday Low</p>
                    <h1 class='my-stock-result'>$$low</h1>
                </div>

                <div class='col-xs-6 col-sm-6 col-md-4'>
                    <p class='my-stock-var'>Volume</p>
                    <h1 class='my-stock-result'>$volume</h1>
                </div>

            </div>


        </div>";
        } else {
            echo "<div class='container-fluid my-about-container no-data'>
            <h3 class=>No data on this date</h3>
                </div>";
        }

    } else if (isset($_POST['company1']) && isset($_POST['company2'])) {

        if (isset($open1) && isset($open2)) {

            $diffopen = number_format($open1 - $open2, 2, '.', '');
            $diffclose = number_format($close1 - $close2, 2, '.', '');
            $diffadjusted = number_format($adjusted1 - $adjusted2, 2, '.', '');
            $diffhigh = number_format($high1 - $high2, 2, '.', '');
            $difflow = number_format($low1 - $low2, 2, '.', '');
            $diffvolume = $volume1 - $volume2;

        echo "

        <div class='container-fluid my-stock-info' id='my-stock-table'>

            <div class='row'>
                <div class='col'>

                <div class='col container-fluid my-graph'>
                <canvas id='myChart'></canvas>
            </div>
    
            <script>
                var myChart = document.getElementById('myChart').getContext('2d');
        
                var stockChart = new Chart(myChart, {
                    type: 'bar',
                    data: {
                        labels:['Open', 'High', 'Low', 'Close', 'Adjusted'],
                        datasets:[{
                            label: '$company1',
                            data:[
                                $open1,
                                $high1,
                                $low1,
                                $close1,
                                $adjusted1
                            ], backgroundColor: '#ffb1c2'
                        },
                        {
                            label: '$company2',
                            data:[
                                $open2,
                                $high2,
                                $low2,
                                $close2,
                                $adjusted2
                            ], backgroundColor: '#9cd0f6'
                        }]
                    },
                    options: {
                        plugins: {
                          title: {
                            display: true,
                            text: '$displaydate',
                          }
                        }
                      }
                });
            </script>


        </div>
    </div>


            <div class='row'>

                <div class=col'>

                    <div id='table-scroll' class='table-scroll'>
                        <table id='main-table' class='main-table'>
                            <thead>
                                <tr>
                                    <th scope='col'>Company</th>
                                    <th scope='col'>Opening Price</th>
                                    <th scope='col'>Closing Price</th>
                                    <th scope='col'>Adjusted Close</th>
                                    <th scope='col'>Intraday High</th>
                                    <th scope='col'>Intraday Low</th>
                                    <th scope='col'>Volume</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>$company1</th>
                                    <td class='my-open-1'>$$open1</td>
                                    <td class='my-close-1'>$$close1</td>
                                    <td class='my-adjusted-1'>$$adjusted1</td>
                                    <td class='my-high-1'>$$high1</td>
                                    <td class='my-low-1'>$$low1</td>
                                    <td class='my-vol-1'>$volume1</td>
                                </tr>
                                <tr>
                                    <th>$company2</th>
                                    <td class='my-open-2'>$$open2</td>
                                    <td class='my-close-2'>$$close2</td>
                                    <td class='my-adjusted-2'>$$adjusted2</td>
                                    <td class='my-high-2'>$$high2</td>
                                    <td class='my-low-2'>$$low2</td>
                                    <td class='my-vol-2'>$volume2</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Difference</th>
                                    <td class='my-open-diff'>$$diffopen</td>
                                    <td class='my-close-diff'>$$diffclose</td>
                                    <td class='my-adjusted-diff'>$$diffadjusted</td>
                                    <td class='my-high-diff'>$$diffhigh</td>
                                    <td class='my-low-diff'>$$difflow</td>
                                    <td class='my-vol-diff'>$diffvolume</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>


        </div>";

        } else {
            echo "<div class='container-fluid my-about-container no-data'>
            <h3 class=>No data on this date</h3>
            </div>";
        }
        }

    // end of php ?>

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