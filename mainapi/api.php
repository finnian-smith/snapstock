<?php

include('conn.php');

header('Content-Type: application/json');

// key verification
if (isset($_GET['key'])) {

    $apikey = $_GET['key'];

    $query = "SELECT * FROM company_api WHERE api = '$apikey'";

    $result = $conn->query($query);

    // error checking
    if (!$result) {
        echo $conn->error;
    }

    // get number of rows returned from SQL statement (verify key)
    $numberofrows = $result->num_rows;

    if ($numberofrows > 0) {

        // GET
        // all
        if (isset($_GET['all'])) {

            $query = "SELECT company_stock.id, company_key.company, company_stock.date, company_stock.open, company_stock.high, company_stock.low, company_stock.close, company_stock.adj_close, company_stock.volume FROM company_key INNER JOIN company_stock ON company_key.id = company_stock.company";

            $result = $conn->query($query);

            // error checking
            if (!$result) {
                echo $conn->error;
            }

            $dataset = array();

            // associative array
            while ($row = $result->fetch_assoc()) {

                $id = $row['id'];
                $company = $row['company'];
                $date = $row['date'];
                $open = $row['open'];
                $high = $row['high'];
                $low = $row['low'];
                $close = $row['close'];
                $adjusted = $row['adj_close'];
                $volume = $row['volume'];

                $line = array('id' => $id, 'company' => $company, 'date' => $date, 'open' => $open, 'high' => $high, 'low' => $low, 'close' => $close, 'adjusted' => $adjusted, 'volume' => $volume);
                array_push($dataset, $line);
            }
            // JSON
            echo json_encode($dataset);
        }

        // date & company
        if (isset($_GET['bydate']) && isset($_GET['bycompany'])) {

            $bydate = $_GET['bydate'];
            $bycompany = $_GET['bycompany'];

            $query = "SELECT company_stock.id, company_key.company, company_stock.date, company_stock.open, company_stock.high, company_stock.low, company_stock.close, company_stock.adj_close, company_stock.volume FROM company_key INNER JOIN company_stock ON company_key.id = company_stock.company WHERE company_stock.date = '$bydate' AND company_key.id = $bycompany";

            $result = $conn->query($query);

            // error checking
            if (!$result) {
                echo $conn->error;
            }

            $dataset = array();

            // associative array
            while ($row = $result->fetch_assoc()) {

                $id = $row['id'];
                $company = $row['company'];
                $date = $row['date'];
                $open = $row['open'];
                $high = $row['high'];
                $low = $row['low'];
                $close = $row['close'];
                $adjusted = $row['adj_close'];
                $volume = $row['volume'];

                $line = array('id' => $id, 'company' => $company, 'date' => $date, 'open' => $open, 'high' => $high, 'low' => $low, 'close' => $close, 'adjusted' => $adjusted, 'volume' => $volume);
                array_push($dataset, $line);
            }

            // JSON
            echo json_encode($dataset);
        }


        // id
        else if (isset($_GET['byid'])) {

            $byid = $_GET['byid'];

            $query = "SELECT company_stock.id, company_key.company, company_stock.date, company_stock.open, company_stock.high, company_stock.low, company_stock.close, company_stock.adj_close, company_stock.volume FROM company_key INNER JOIN company_stock ON company_key.id = company_stock.company WHERE company_stock.id = $byid";

            $result = $conn->query($query);

            // error checking
            if (!$result) {
                echo $conn->error;
            }

            $dataset = array();

            // associative array
            while ($row = $result->fetch_assoc()) {

                $id = $row['id'];
                $company = $row['company'];
                $date = $row['date'];
                $open = $row['open'];
                $high = $row['high'];
                $low = $row['low'];
                $close = $row['close'];
                $adjusted = $row['adj_close'];
                $volume = $row['volume'];

                $line = array('id' => $id, 'company' => $company, 'date' => $date, 'open' => $open, 'high' => $high, 'low' => $low, 'close' => $close, 'adjusted' => $adjusted, 'volume' => $volume);
                array_push($dataset, $line);
            }
            // JSON
            echo json_encode($dataset);
        }


        // company
        else if (isset($_GET['bycompany'])) {

            $bycompany = $_GET['bycompany'];

            $query = "SELECT company_stock.id, company_key.company, company_stock.date, company_stock.open, company_stock.high, company_stock.low, company_stock.close, company_stock.adj_close, company_stock.volume FROM company_key INNER JOIN company_stock ON company_key.id = company_stock.company WHERE company_key.id = $bycompany";

            $result = $conn->query($query);

            // error checking
            if (!$result) {
                echo $conn->error;
            }

            $dataset = array();

            // associative array
            while ($row = $result->fetch_assoc()) {

                $id = $row['id'];
                $company = $row['company'];
                $date = $row['date'];
                $open = $row['open'];
                $high = $row['high'];
                $low = $row['low'];
                $close = $row['close'];
                $adjusted = $row['adj_close'];
                $volume = $row['volume'];

                $line = array('id' => $id, 'company' => $company, 'date' => $date, 'open' => $open, 'high' => $high, 'low' => $low, 'close' => $close, 'adjusted' => $adjusted, 'volume' => $volume);
                array_push($dataset, $line);
            }
            // JSON
            echo json_encode($dataset);
        }


        // date
        else if (isset($_GET['bydate'])) {

            $bydate = $_GET['bydate'];

            $query = "SELECT company_stock.id, company_key.company, company_stock.date, company_stock.open, company_stock.high, company_stock.low, company_stock.close, company_stock.adj_close, company_stock.volume FROM company_key INNER JOIN company_stock ON company_key.id = company_stock.company WHERE company_stock.date = '$bydate'";

            $result = $conn->query($query);

            // error checking
            if (!$result) {
                echo $conn->error;
            }

            $dataset = array();

            // associative array
            while ($row = $result->fetch_assoc()) {

                $id = $row['id'];
                $company = $row['company'];
                $date = $row['date'];
                $open = $row['open'];
                $high = $row['high'];
                $low = $row['low'];
                $close = $row['close'];
                $adjusted = $row['adj_close'];
                $volume = $row['volume'];

                $line = array('id' => $id, 'company' => $company, 'date' => $date, 'open' => $open, 'high' => $high, 'low' => $low, 'close' => $close, 'adjusted' => $adjusted, 'volume' => $volume);
                array_push($dataset, $line);
            }
            // JSON
            echo json_encode($dataset);
        }



        // POST - insert data in company_stock table
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $company = $_POST['company'];
            $date = $_POST['date'];
            $open = $_POST['open'];
            $high = $_POST['high'];
            $low = $_POST['low'];
            $close = $_POST['close'];
            $adjusted = $_POST['adjusted'];
            $volume = $_POST['volume'];

            echo "INSERT INTO company_stock (company, date, open, high, low, close, adj_close, volume) VALUES ($company, '$date', $open, $high, $low, $close, $adjusted, $volume)";

            $insert = "INSERT INTO company_stock (company, date, open, high, low, close, adj_close, volume) VALUES ($company, '$date', $open, $high, $low, $close, $adjusted, $volume)";

            $result = $conn->query($insert);

            // error check insert
            if (!$result) {
                echo $conn->error;
                die();
            }
        }

    // invalid key provided
    } else {

        echo "invalid key";
    }

// no key provided
} else {

    echo "no key";
}
