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
<body>

<div class="row">
    <div class="column4" style="background-color:#aba;">
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
            <div class="column">
                <h2>Test Answers</h2>
            </div>
        </div>
    </div>
</div>

</body>
</html>
