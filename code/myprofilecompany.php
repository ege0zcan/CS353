<?php
include("config.php");
session_start();
if (!empty($_SESSION))
{
    $userID = $_SESSION["userID"];
}
else
{
    header("location: home.php");
}

?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>My Jobs</title>
</head>

<body style="background-color:#FF6F61;">
<header class="main-header">
    <div class="nav">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="createjob.php">Create Job</a></li>
            <li><a class="active" href="#">My Jobs</a></li>
            <li><a href="myprofilecompany.php">My Profile</a></li>
        </ul>
    </div>
</header>
<br><br><br>

<div class="row">
    <div class="column4" style="background-color:#aba;">
        <?php
            $sql = "SELECT * FROM job_offering NATURAL JOIN posts WHERE user_id = '$userID'";
            $result = mysqli_query($db,$sql);
            while($job = mysqli_fetch_object($result)){
                $jobID = $job->offering_id;
                $jobTitle = $job->job_title;
                echo("<form>");
                echo("<button type=\"submit\" name= \"post\" class=\"button\" value=$jobID>$jobTitle</button></form>");


            }
        if(isset($_REQUEST["post"]))
        {
            $_SESSION[jobID] =$jobID;
        }

        ?>


        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#" >2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">&raquo;</a>
        </div>

    </div>

    <div class="column" style="background-color:#bbb;">
        <h1>Applications</h1>
        <button>Delete Offering</button>
        <div class="row">
            <div class="column4">

                <?php

                    if( !isset($_SESSION['jobID']) ) {
                        $sql2 = "SELECT * FROM work_user NATURAL JOIN applies WHERE offering_id = $jobID ";
                        $result2 = mysqli_query($db, $sql2);
                        while ($worker = mysqli_fetch_object($result2)) {
                            $workID = $worker->user_ID;
                            $workName = $worker->name;
                            echo("$workName");
                        }
                    }

                ?>

            </div>
            <div class="column">
                <h2>Test Answers</h2>
            </div>
        </div>
    </div>
</div>

</body>
</html>
