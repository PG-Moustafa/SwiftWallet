<?php

session_start();
require 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, password FROM users where email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];

        $stmt2 = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt2->bind_param("i", $user['id']);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $userData = $result2->fetch_assoc();

        $_SESSION['first_name'] = $userData['first_name'];
        $_SESSION['last_name'] = $userData['last_name'];
        $_SESSION['email'] = $userData['email'];
        $_SESSION['address'] = $userData['address'];
        $_SESSION['phone_number'] = $userData['phone_number'];
        if ($userData['balance'] === NULL) {
            $_SESSION['balance'] = 0;
        } else {
            $_SESSION['balance'] = $userData['balance'];
        }


        header("Location: dashboard.php");
        exit();

    } else {
        echo "Wrong password";
    }

} else {
    echo "No user found with this email.";
}

?>