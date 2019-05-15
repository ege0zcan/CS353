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

/////////////////////////////////////////
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>My Jobs</title>
</head>

<body style="background-color:#dddfd4;">
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
    <div class="column4">
        <form action="" method="GET">
        <?php
        $sql = "SELECT * FROM job_offering NATURAL JOIN posts WHERE user_id = '$userID'";
        $result = mysqli_query($db,$sql);
        while($job = mysqli_fetch_object($result)){
            $jobID = $job->offering_id;
            $jobTitle = $job->job_title;

            echo(" <li><button name=\"submit\" type=\"submit\" value=$jobID> $jobTitle </button></li>");
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
        <h1 class="create" style="display: inline-block; margin-left: 20px">Applications</h1>
        <button class="button" style="display: inline-block; height: 50px;margin-left: 475px; font-size: 16px">Delete Offering</button>
        <div class="row">
            <div class="column4" style="background-color: transparent;">
                <?php
                if(isset($_GET['submit'])) {
                    $currentID = mysqli_real_escape_string($db, $_GET['submit']);
                    $sql2 = "SELECT * FROM work_user NATURAL JOIN applies WHERE offering_id ='". $_GET['submit'] ."'";
                    if($result2 = mysqli_query($db, $sql2)) {
                        while ($worker = mysqli_fetch_object($result2)) {
                            $workID = $worker->user_ID;
                            $workName = $worker->name;
                            echo("<h1>$workName</h1>");
                        }
                    }else{
                        echo("NO ONE");
                    }
                }else{
                    echo("here");
                }
                ?>
            </div>
            <div class="column" style="height: 300px;">
                <p>Test Answers</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>