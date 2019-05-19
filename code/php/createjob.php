<?php
include('config.php');
session_start();
$userID = $_SESSION["userID"];
$date = date("Y-m-d");
echo $date;
if(isset($_REQUEST["post"]))
{

$jobtitle = $_REQUEST["title"];
$jobdesc = $_REQUEST["description"];
$jobtype = $_REQUEST["type"];
$jobloc = $_REQUEST["location"];
$jobdept = $_REQUEST["department"];
$sql = "INSERT INTO job_offering (date, job_title, job_dept, job_type, office_location,details) VALUES ('$date', '$jobtitle', '$jobdept', '$jobtype', '$jobloc', '$jobdesc')";
$result = mysqli_query($db,$sql);

$getOFid = "SELECT offering_id FROM job_offering WHERE job_title = '$jobtitle' and job_dept = '$jobdept' and job_type = '$jobtype' and office_location = '$jobloc'";
$result2 = mysqli_query($db,$getOFid);
$ofID = mysqli_fetch_object($result2);
$ofIdFetch = $ofID->offering_id;
$sql2 ="INSERT INTO posts (offering_id, user_id) VALUES ('$ofIdFetch', '$userID')";
$result3 = mysqli_query($db,$sql2);
if($result == 1){
header("location: home.php");
}
}
else {
$error = "Your Login Name or Password is invalid";
}


?>


<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Create Job</title>
</head>

<body style="background-color:#dddfd4;">
<header class="main-header">
    <div class="nav">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a class="active" href="#">Create Job</a></li>
            <li><a href="myjobscompany.php">My Jobs</a></li>
            <li><a href="myprofilecompany.php">My Profile</a></li>
        </ul>
    </div>
</header>

<br>
<h1 class="create" style="text-align: center">CREATE JOB</h1>
<form action="" method="post" style="text-align:center;">
    <br>
    <input class="input" type="text" placeholder="Enter Job Title" id="title" required>
    <br>
    <input class="big_input" type="text" placeholder="Enter Job Description" id="description" required>
    <br>
    <input class="input" type="text" placeholder="Enter Job Type" id="type" name ="type" required>
    <br>
    <input class="input" type="text" placeholder="Enter Job Location" id="location" required>
    <br>
    <input class="input" type="text" placeholder="Enter Job Department" id="department" required>
    <br>
    <button type="submit" name="post" class="button">Publish</button>
</form>

</body>
</html>
