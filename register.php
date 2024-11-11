<?php
    session_start();
    include("dbconfig.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $err = false;
        
        if(empty(trim($_POST['firstname']))){
            echo "Please enter your first name <br>";
        }else {
            $firstname = htmlspecialchars($_POST['firstname']);
        }

        if(empty(trim($_POST['lastname']))){
            echo "Please enter your last name";
            $err = true;
        }else {
            $lastname = htmlspecialchars($_POST['lastname']);
        }

        if(empty(trim($_POST['email']))){
            echo "Please enter your email";
            $err = true;
        }else {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        }

        if(empty(trim($_POST['password']))){
            echo "Please enter a password";
            $err = true;
        }else {
            if($_POST['password'] != $_POST['confirm-password']){
                echo "Passwords do not match";
                $err = true;
            }else {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
        }

        if(!$err){
            do{
                $user_id = rand(99999, 10000);
                $sql = "SELECT * FROM `users` WHERE user_id = ?";
                $stmt = $conn -> prepare($sql);
                $stmt -> bind_param("s", $user_id);
                $stmt -> execute();
                $result = $stmt -> get_result();
            }while($result -> num_rows > 0);


            $insert_user = "INSERT INTO `users`(`user_id`, `firstname`, `lastname`, `email`, password)
                            VALUES (?,?,?,?,?)";
            $stmt2 = $conn -> prepare($insert_user);
            $stmt2 -> bind_param("sssss",$user_id, $firstname, $lastname, $email, $password);

            if($stmt2 -> execute()){
                session_regenerate_id();
                $_SESSION['user_id'] = $user_id;
                header("Location:./");
                die();   
            }else {
                echo "Registration was not successful";
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
    <title></title>
</head>
<body>
    <div class="container">
        <form action="register.php" method="post">
            <h1 class="title">Register to track attendance</h1>
            <input type="text" name="firstname" id="firstname" placeholder="First Name"><br></br>
            <input type="text" name="lastname" id="lastname" placeholder="Last Name"><br></br>
            <input type="email" id="email" name="email" placeholder="Email"><br><br>
            <input type="text" name="password" id="password" placeholder="Password"><br><br>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password"><br></br>

            <button type="submit">Register</button>
        </form>
    </div>
    <p class="notice"></p>
    <p class="message">
        Already have an account? 
        <a href="login.php">Login Here</a>
    </p>

    <script src="assets/index.js"></script>
</body>
</html>