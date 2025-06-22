<?php

session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../html/login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$amount = $_POST['amount'];

if (!is_numeric($amount) || $amount <= 0) {
    echo 'Invalid deposit amount.';
    exit();
}

$stmt = $conn->prepare("SELECT balance FROM users where id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$current_balance = $user['balance'] ?? 0;
$new_balance = $current_balance + $amount;

$update = $conn->prepare("UPDATE users SET balance = ? 
where id = ?");
$update->bind_param("di", $new_balance, $user_id);
$update->execute();

$_SESSION['balance'] = $new_balance;

header("Location: dashboard.php ? success = deposit");
exit();

?>