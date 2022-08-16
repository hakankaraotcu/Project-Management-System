<?php
include("connection.php");
include("functions.php");

if(isset($_POST['submit'])){
    $id = random_num(20);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $select = " SELECT * FROM [Users] WHERE email = '$email' AND password = '$password' ";

    $result = $conn->query($select);

    if($result->rowCount() == -1){
        $error[] = 'user already exist';
    }
    else{
        if($password != $confirm_password){
            $error[] = 'password not matched';
        }
        else{
            $insert = "INSERT INTO [Users] (first_name, last_name, role, password, email) VALUES('$firstName','$lastName','Project Manager','$password','$email')";
            $conn->query($insert);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <link rel="stylesheet" href="register.css">
</head>
<body>

    <div class="form-container">
        <form action="" method="post">
            <h3>register now</h3>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    }
                }
            ?>
            <input type="text" name="firstName" required placeholder="enter your first name">
            <input type="text" name="lastName" required placeholder="enter your last name">
            <input type="email" name="email" required placeholder="enter your email">
            <input type="password" name="password" required placeholder="enter your password">
            <input type="password" name="confirm_password" required placeholder="confirm your password">
            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>already have an account? <a href="index.php">login now</a></p>
        </form>
    </div>
</body>
</html>