<?php
        session_start();
        if(isset($_SESSION['user_id'])){
            header("Location ./");
            die();
        }
        
    include("dbconfig.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $err = false;
        if(empty(trim($_POST['email']))){
            echo "Please enter your email";
            $err = true;
        }else {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        }

        $password = $_POST['password'];

        if(!$err){
            $sql = "SELECT * FROM `users` WHERE email = ?";
            $stmt = $conn -> prepare($sql);
            $stmt -> bind_param("s", $email);
            $stmt -> execute();
            $result = $stmt -> get_result();

            if($result -> num_rows < 1){
                echo "Invalid email or password";
            }


            if($row = $result -> fetch_assoc()){
                if(password_verify($password, $row['password'])){
                    session_regenerate_id();
                    $_SESSION['user_id'] = $row['user_id'];
                    header("Location: ./");
                    exit();
                }else{
                    echo "Invalid email or password";
                }
            }
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST">
            <h1 class="title">Login to track attendance</h1>
            <input type="email" placeholder="Email" id="email" name="email"><br></br>
            <input type="password" placeholder="Password" id="password" name="password"><br></br>

            <button type="submit">Login</button>
        </form>
    </div>

    <p class="message">
        Don't have an Account? 
        <a href="register.php">Register Here</a>
    </p>
</body>
</html>