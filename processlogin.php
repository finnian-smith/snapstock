<?php

session_start();

include('conn/conn.php');

// get posted data
$sentusername = $_POST['username'];
$sentpassword = $_POST['password'];

// security v xss
$sentusername = htmlentities($sentusername);
$sentpassword = htmlentities($sentpassword);

$signin = "SELECT * FROM company_user WHERE username = '$sentusername' AND password = '$sentpassword'";

// will always be true as long as any SQL statement runs (even if false)
$result = $conn->query($signin);

// error
if (!$result) {
    echo $conn->error;
}

// get number of rows returned from SQL statement (verify & identify users)
$numberofrows = $result->num_rows;

if ($numberofrows > 0) {
    
    $singlerow = $result->fetch_assoc(); // convert to array (no need for while loop)

    // print_r($singlerow); // just to check
    // echo "true user"; // checking
    $_SESSION['user'] = $singlerow['id'];

    // echo $_SESSION['user']; // just for checking

    // kick user back to preferences (logged in)
    header("Location: preferences.php");

} else {

    // kick user back to register (register page)
    header("Location: register.php");
}

// echo $signin;