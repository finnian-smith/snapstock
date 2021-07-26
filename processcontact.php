<?php

$errors = [];
$data = [];

// if empty -> add to errors array
if (empty($_POST['query'])) {
    $errors['query'] = 'Query is required';
}

if (empty($_POST['name'])) {
    $errors['name'] = 'Name is required';
}

if (empty($_POST['email'])) {
    $errors['email'] = 'Email is required';
}

if (empty($_POST['subject'])) {
  $errors['subject'] = 'Subject is required';
}

if (empty($_POST['comments'])) {
  $errors['comments'] = 'Comments are required';
}

// checks
if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Success!';

    // composing
    $query = $_POST['query'];
    $name = $_POST['name'];
    $visitoremail = $_POST['email'];
    $subject = $_POST['subject'];
    $comments = $_POST['comments'];

    // security v xss
    $query = htmlentities($query);
    $name = htmlentities($name);
    $visitoremail = htmlentities($visitoremail);
    $subject = htmlentities($subject);
    $comments = htmlentities($comments);

    $emailfrom = "fsmith14@qub.ac.uk";
    $emailbody = "You have received a new message from $name:\nQuery Type: $query\nSubject: $subject\n\n'$comments'\n";

    // sending
    $to = "fsmith14@qub.ac.uk";
    $headers = "From: $emailfrom \r\n";
    $headers .= "Reply-To: $visitoremail \r\n";

    mail($to, $query, $emailbody, $headers);
 
}

echo json_encode($data);

?>