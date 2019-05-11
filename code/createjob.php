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
    <link rel="stylesheet" href="style.css">
    <title>Create Job</title>
</head>

<body style="background-color:#FF6F61;">
    <header class="main-header">
        <div class="nav">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a class="active" href="#">Create Job</a></li>
                <li><a href="#">My Jobs</a></li>
                <li><a href="#">My Profile</a></li>
            </ul>
        </div>
    </header>

    <br>
    <h1 style="text-align: center">Create Job</h1>

    <form style="text-align:center;">

        <br>
    <form action="" method="post">
        <label for="title">Job Title</label>
        <input class="input" type="text" placeholder="Enter Job Title" id="title" name ="title" required>
        <br>
        <label class="label" for="title">Job Description</label>
        <input class="big_input" type="text" placeholder="Enter Job Description" id="description" name = "description" required>
        <br>
        <label for="title">Job Type</label>
        <input class="input" type="text" placeholder="Enter Job Type" id="type" name ="type" required>
        <br>
        <label class="label" for="title">Job Location</label>
        <input class="input" type="text" placeholder="Enter Job Location" id="location" name= "location"required>
        <br>

        <label class="label" for="title">Job Department</label>
        <input class="input" type="text" placeholder="Enter Job Department" id="department"  name= "department" required>
        <br>
        <button type="submit" name= "post" class="button">Publish</button>
    </form>

</body>
</html>

