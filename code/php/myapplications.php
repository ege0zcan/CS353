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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>My Applications</title>
</head>

<body style="background-color:#dddfd4;">
<header class="main-header">
    <div class="nav">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="searchjob.php">Job Search</a></li>
            <li><a href="companysearch2.php">Company Search</a></li>
            <li><a class="active" href="#">My Applications</a></li>
            <li><a href="myprofilework.php">My Profile</a></li>
        </ul>
    </div>
</header>
<br><br><br>

<div class="row">
    <div class="column4">

        <form action="" method="GET">
            <?php
            $sql = "SELECT * FROM job_offering NATURAL JOIN applies WHERE user_id = '$userID'";
            $result = mysqli_query($db,$sql);
            while($job = mysqli_fetch_object($result)){
                $jobID = $job->offering_id;
                $jobTitle = $job->job_title;

                echo(" <p><button name=\"submit\" type=\"submit\" value=$jobID> $jobTitle </button></p>");
            }

            ?>
        </form>

        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#">1</a>
            <a href="#" class="active">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">&raquo;</a>
        </div>

    </div>

    <div class="column">

        <div class="row">
            <div class="column1">
                <form action="" method="POST">
                <?php
                if(isset($_GET['submit'])) {
                    $_SESSION['idForSolve'] = $_GET['submit'];
                    echo("<div><h1 class=\"create\" style=\"display: inline-block; margin-left: 20px\">Job Details");
                    $currentID = mysqli_real_escape_string($db, $_GET['submit']);
                    $testSql = "SELECT * FROM application_test WHERE offering_id ='". $_GET['submit'] ."'";
                    if($resultTest = mysqli_query($db,$testSql)){
                        $rowcount = mysqli_num_rows($resultTest);
                        if($rowcount > 0) {
                            echo("<button name=\"test\" type=\"submit\" class=\"button\" style=\"display: inline-block; height: 50px;margin-left: 200px; font-size: 16px\">Solve Test</button>");
                        }
                    }
                    echo("</h1> <br /></div>");
                    $sql2 = "SELECT * FROM job_offering NATURAL JOIN applies WHERE offering_id ='". $_GET['submit'] ."'";
                    if($result2 = mysqli_query($db, $sql2)){
                        $selectedJob = mysqli_fetch_object($result2);
                        $jobID = $selectedJob->user_id;
                        $jobTitle = $selectedJob->job_title;
                        $jobDesc = $selectedJob->details;
                        $jobStatus = $selectedJob->status;
                        echo("<h2 style=\"display: inline-block; margin-left: 20px\" >$jobTitle</h2>");
                        echo("<p style=\"display: inline-block; margin-left: 20px\" >$jobDesc</p>");
                        echo("<p style=\"display: inline-block; margin-left: 20px\" >$jobStatus</p>");
                        echo("<a style=\"margin-left: 30px;\" href=\"home.html\"> Go to Company Profile</a>");

                    }else{
                        echo("NO ONE");
                    }
                }else{
                    echo("<h2 >Please Choose a Job</h2>");
                }
                ?>
                </form>
                <?php
                    if(isset($_POST['test'])){
                        header("location: solveTest.php");
                    }
                ?>

            </div>
        </div>
    </div>
</div>

</body>
</html>
