<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../html/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

    <div class="header">
        <h2><a href="../html/index.html">Home</a></h2>
        <h3><a href="../php/logout.php">Logout</a></h3>
    </div>

    <h2>Welcome to SwiftWallet</h2>

    <div class="content">
        <p>Welcome, <?= $_SESSION['first_name'] ?>!</p>
        <p>Your balance: $<?= $_SESSION['balance'] ?></p>
        <!-- Add deposit, withdraw, and transaction options here -->
    </div>


</body>

</html>