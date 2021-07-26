<?php

session_start();

include("conn/conn.php");

// store posted info
$addusername = $_POST['username'];
$addpassword = $_POST['password'];
$addemail = $_POST['email'];

// security v sql injection
$addusername = $conn->real_escape_string(trim($addusername));
$addpassword = $conn->real_escape_string(trim($addpassword));
$addemail = $conn->real_escape_string(trim($addemail));

// echo "{$addusername} + {$addpassword} + {$addemail}";

$insert = "INSERT INTO company_user (username, password, email) VALUES ('{$addusername}', '{$addpassword}', '{$addemail}');";

$result = $conn->query($insert);

// error check insert
if (!$result) {
    echo $conn->error;
    die();
}

// kick user back to preferences
header("Location: preferences.php");

?>