<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/index.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1 class="title">Hello, welcome to your dashboard</h1>
        <a href="logout.php">Logout</a>
        
    </div>
</body>
</html>