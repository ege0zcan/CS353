<?php
    session_start();
    include('config.php');
?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Glass Ceiling</title>
</head>

<body style="background-color:#FF6F61;">
    <br>
    <h1 style="text-align:center;" onclick="location.href='http://google.com';" >Glass Ceiling</h1>
    <br><br><br>
    <button class="button" onclick="location = 'login.php'";>Login</button>
    <br><br>
    <br>
    <br>
    <button class="button" onclick="location = 'createaccount.php';" >Create Account</button>
</body>
</html>
