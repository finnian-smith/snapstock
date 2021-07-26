<?php

session_start();

include("conn/conn.php");

// store posted info
$userid = $_SESSION['user'];
$first = $_POST['first'];
$second = $_POST['second'];
$third = $_POST['third'];
$fourth = $_POST['fourth'];
$fifth = $_POST['fifth'];

$select = "SELECT * FROM company_preferences WHERE userid = $userid";

$check = $conn->query($select);

// error
if (!$check) {
    echo $conn->error;
} 

// get number of rows returned from SQL statement (verify & identify users)
$numberofrows = $check->num_rows;

    if ($numberofrows > 0) {
        
        $singlerow = $check->fetch_assoc(); // convert to array (no need for while loop)

        $update = "UPDATE company_preferences SET first = $first, second = $second, third = $third, fourth = $fourth, fifth = $fifth WHERE userid = $userid";
        
        $result1 = $conn->query($update);

        if (!$result1) {
            echo $conn->error;
        }

        // kick user back to preferences
        header("Location: preferences.php");
        

    } else {

        $insert = "INSERT INTO company_preferences (userid, first, second, third, fourth, fifth) VALUES ($userid, $first, $second, $third, $fourth, $fifth)";

        $result2 = $conn->query($insert);

        // error check insert
        if (!$result2) {
            echo $conn->error;
            die();
        }

        // kick user back to preferences
        header("Location: preferences.php");
        
}





?>