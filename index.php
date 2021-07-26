<?php

$apikey = "demokey1";

$endpoint = "http://fsmith14.lampt.eeecs.qub.ac.uk/mainapi/api.php?key=$apikey&all";

$response = file_get_contents($endpoint);

$details = json_decode($response, true);

// random - by id = 1-6290 for display info
$randomid = rand(1, count($details));

foreach ($details as $row) {
  if ($row['id'] == $randomid) {
    $randomdate = $row['date'];
    $randomcompany = $row['company'];
    $randomopen = $row['open'];
    $randomhigh = $row['high'];
    $randomlow = $row['low'];
    $randomclose = $row['close'];
    $randomadjusted = $row['adjusted'];
  }
}

// get ticker symbol

switch ($randomcompany) {
  case 'Apple':
    $ticker = 'AAPL';
    break;
  case 'Facebook':
    $ticker = 'FB';
    break;
  case 'Amazon':
    $ticker = 'AMZN';
    break;
  case 'Google':
    $ticker = 'GOOG';
    break;
  case 'Netflix':
    $ticker = 'NFLX';
    break;
  default:
    $ticker = '';
    break;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>SnapStock</title>

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
    function dateTime() {

      var m_names = new Array("January", "February", "March",
        "April", "May", "June", "July", "August", "September",
        "October", "November", "December");

      var d = new Date();

      var date = d.getDate();
      var month = d.getMonth();
      var year = d.getFullYear();
      var hours = d.getHours();
      var minutes = d.getMinutes();
      var ampm = hours >= 12 ? 'p.m.' : 'a.m.';
      hours = hours % 12;
      hours = hours ? hours : 12;
      minutes = minutes < 10 ? '0' + minutes : minutes;
      var strTime = hours + ':' + minutes + ' ' + ampm;

      $(".my-stock-time").html(m_names[month] + " " + date + ", " + year + " " + strTime);

    }
  </script>

</head>

<body onload="dateTime()">

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
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
        <h1 class="my-main-header">Stock</h1>
      </div>
      <div class="col-lg-6 g-0">
        <img class="img-fluid" src="https://tinyurl.com/h482uvjw" alt="macbook-background">
      </div>

    </div>
  </div>

  <!-- Current Stock Price -->

  <div class="container-fluid my-stock-container">

    <div class="row">

      <!-- Left Side -->
      <div class="col-lg-6">

        <div class="row">
          <div class="col">
            <h4 class="my-stock-time"></h4>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <h1 class="my-stock-header">Random Stock</h1>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <p class="my-stock-disclaimer">The stock information provided is for informational purposes only and is not
              intended for trading purposes. The stock information and charts are provided by Kaggle, a third party
              service, and Facebook, Amazon, Apple, Netflix and Google do not provide information to this service.</p>

            <p class="my-stock-disclaimer">Hint - refresh the page for new stock information.</p>
          </div>
        </div>

      </div>

      <!-- Right Side -->
      <div class="col-lg-6 my-text-right-align">

        <div class="row">
          <div class="col">
            <h4 class="my-pricing-delay">Company</h4>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <h1 class="my-current-price"><?php echo "{$randomcompany}"; ?></h1>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <p class="my-change">Date</p>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <p class="my-price-change"><?php echo "{$randomdate}"; ?></p>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <p class="my-volume">Price</p>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <p class="my-volume-number">$<?php echo "{$randomclose}"; ?></p>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Graph -->
  <div class="container my-graph-container">

    <div class="row">

      <!-- Row with graph header -->
      <div class="col">
        <h2 class="my-graph-header"><?php echo "NASDAQ: {$ticker}"; ?></h2>
      </div>

      <!-- Row with graph -->
      <div class="row">

        <div class="col container-fluid my-graph">
            <canvas id="myChart"></canvas>
        </div>

    <script>
        var myChart = document.getElementById('myChart').getContext('2d');

        var stockChart = new Chart(myChart, {
            type: 'bar',
            data: {
                labels:['Open', 'High', 'Low', 'Close', 'Adjusted'],
                datasets:[{
                    label: 'Price',
                    data:[
                        <?php echo $randomopen; ?>,
                        <?php echo $randomhigh; ?>,
                        <?php echo $randomlow; ?>,
                        <?php echo $randomclose; ?>,
                        <?php echo $randomadjusted; ?>
                    ], backgroundColor: ['#61bb46', '#fdb827', '#f5821f', '#e03a3e', '#963d97']
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>

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