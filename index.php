<?php

session_start();
include("connection.php");

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $select = " SELECT * FROM [Users] WHERE email = '$email' AND password = '$password' ";
    $result = $conn->query($select);

    if($result->rowCount() == -1){
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user'] = array('userFirstName' => $row['first_name'], 'userLastName' => $row['last_name'], 'role' => $row['role'], 'password' => $row['password'], 'userEmail' => $row['email'],  'userId' => $row['user_id']);
        
        header('location:dashboard.php');
    }
    else{
        $error[] = 'incorrect email or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <link rel="stylesheet" href="login.css">
</head>
<body>
    
    <div class="form-container">
        <form action="" method="post">
            <h3>login now</h3>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    }
                }
            ?>
            <input type="email" name="email" required placeholder="enter your email">
            <input type="password" name="password" required placeholder="enter your password">
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>don't have an account? <a href="register.php">register now</a></p>
        </form>
    </div>
</body>
</html>