<?php

include("../conn/conn.php");

// iterate through each group of data to be added
$files = array("Apple.csv", "Facebook.csv", "Amazon.csv", "Google.csv", "Netflix.csv");

// represents the key to identify which company is which
$count = 1;

for ($loop = 0; $loop < count($files); $loop++) {
    $endpoint = $files[$loop];
 
    $contents = fopen($endpoint, "r");

    while( ($row = fgetcsv($contents)) !== FALSE  ){

        // date
        if (empty($row[0])) {
            $row[0] = 2020-01-01;
        }

        // open
        if (empty($row[1])) {
            $row[1] = number_format((float)(rand(1, 3000) / 10), 2, '.', '');
        }

        // high
        if (empty($row[2])) {
            $row[2] = $row[1] + rand(1, 20);
        }

        // low
        if (empty($row[3])) {
            $row[3] = $row[1] - rand(1, 20);
        }

        // close
        if (empty($row[4])) {
            $row[4] = $row[1] + rand(1, 20);
        }

        // adjusted close
        if (empty($row[5])) {
            $row[5] = $row[4] + rand(1, 5);;
        }

        // volume
        if (empty($row[6])) {
            $row[6] = rand(5000000, 90000000);
        }

        // assigning of vars
        $date = $row[0];
        $open = round($row[1], 2);
        $high = round($row[2], 2);
        $low = round($row[3], 2);
        $close = round($row[4], 2);
        $adj = round($row[5], 2);
        $volume = $row[6];

        /*
        echo "<br>";

        echo "INSERT INTO company_stock (company, date, open, high, low, close, adj_close, volume)
        VALUES ({$count}, '{$date}', {$open}, {$high}, {$low}, {$close}, {$adj}, {$volume});";
        */

        $insert = "INSERT INTO company_stock (company, date, open, high, low, close, adj_close, volume)
                    VALUES ({$count}, '{$date}', {$open}, {$high}, {$low}, {$close}, {$adj}, {$volume});";


        $result = $conn->query($insert);

        if (!$result) {
            echo $conn->error;
            die();
        }

    }

 // moves up to next count e.g. 1 -> 2
 $count++;

}
 
?>