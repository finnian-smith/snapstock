<?php

include("../conn/conn.php");

$errors = [];
$data = [];

// if empty -> add to errors array
if (empty($_POST['user'])) {
    $errors['user'] = 'User is required';
}

// checks
if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {

    // setting up
    $user = $_POST['user'];
   
    // security v xss
    $user = htmlentities($user);

      //declare and set variables
      $output = null;
    
      function findRandom() {
          $mRandom = rand(48, 122);
          return $mRandom;
      }
      
      function isRandomInRange($mRandom) {
          if(($mRandom >=58 && $mRandom <= 64) ||
                  (($mRandom >=91 && $mRandom <= 96))) {
              return 0;
          } else {
              return $mRandom;
          }
      }   
      
      for($loop = 0; $loop <= 31; $loop++) {
          for($isRandomInRange = 0; $isRandomInRange === 0;){
              $isRandomInRange = isRandomInRange(findRandom());
          }
          $output .= html_entity_decode('&#' . $isRandomInRange . ';');
      }

    // store info
    $data['success'] = $user;
    $data['message'] = $output;


// insert new info in db
$insert = "INSERT INTO company_api (user, api) VALUES ('{$user}', '{$output}');";


$result = $conn->query($insert);

// error check insert
if (!$result) {
    echo $conn->error;
    die();
}

}

echo json_encode($data);
