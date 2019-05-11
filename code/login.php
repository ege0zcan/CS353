<?php
    include('config.php');
    $error = "";
    session_start();
    if (session_id())
    {
        session_destroy();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM general_user WHERE email = '$email' and password = '$password'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_num_rows($result);
        if($row == 1) {
            session_start();
            $user = mysqli_fetch_object($result);
            $userID = $user->user_ID;
            $_SESSION['userID'] = $userID;
            $compsql = "SELECT *FROM comp_user WHERE user_ID = '$userID'";
            $result2 = mysqli_query($db,$compsql);
            $userType = mysqli_num_rows($result2);
            $_SESSION['userType'] = $userType;
            if($userType == 1){
                header("location: myprofilecompany.php");
            }else{
                header("location: myprofilework.php");
            }
        }
        else {
                $error = "Your Login Name or Password is invalid";
        }
    }
    ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body style="background-color:#FF6F61;">
    <br>
    <h1 style="text-align:center;" >Glass Ceiling</h1>
    <br><br><br>
    <form action="" method="post">
        <br>
        <input type="email" class="input" id="email" placeholder="E-mail" name="email">
        <br>
        <input type="password" class="input" id="password" placeholder="Password" name="password">
        <br>
        <button type="submit" name="input" class="button">Login</button>
    </form>
</body>
</html>
