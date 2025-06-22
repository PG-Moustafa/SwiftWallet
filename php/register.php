<?php

session_start();
require 'db.php';

$email = $_POST['email'];
$first_name = $_POST['fname'];
$last_name = $_POST['lname'];
$address = $_POST['address'];
$phone_number = $_POST['phone-nb'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$register_std = $conn->prepare(
    "INSERT INTO 
    users (email, password, first_name, last_name, address, phone_number) 
    VALUES (?, ?, ?, ?, ?, ?)"
);
$register_std->bind_param(
    "ssssss",
    $email,
    $password,
    $first_name,
    $last_name,
    $address,
    $phone_number
);

if ($register_std->execute()) {
    header("Location: ../html/index.html");
    exit();
} else {
    echo "Error: " . $register_std->error;
}

?>