<?php

$db = mysqli_connect('localhost:3306','root','root','cs353');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
echo "Connected successfully";
?>
