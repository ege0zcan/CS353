<?php
include("config.php");
session_start();
if (!empty($_SESSION))
{
    $userID = $_SESSION["userID"];
    $date = date("Y-m-d");

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
    <title>Company Search</title>
</head>

<body style="background-color:#dddfd4;">
<header class="main-header">
    <div class="nav">
        <ul>
            <li><a class="active" href="#">My Reviews</a></li>
            <li><a  href="createjob.php">Create Job</a></li>
            <li><a href="myjobscompany.php">My Jobs</a></li>
            <li><a  href="myprofilecompany.php">My Profile</a></li>
        </ul>
    </div>
</header>
<br><br><br>



<div class="row">
    <div class="column" style="margin-left:15%">
        <form style="text-align: center " action="" method="GET">
            <h2 style="display: inline-block; height: 50px; font-size: 30px; margin-left: 30px;"> My Reviews</h2> <br><br>
            <p  style="display: inline-block; height: 50px; font-size: 20px; margin-left: 30px;">   Post After: <input type="date" name="day" placeholder="Post Date"></p>
            <button type="submit" class="button" >Search</button>
        </form>

        <?php

        $overallsql= "SELECT AVG(comp_rating) as compAVG, AVG(ceo_rating) as ceoAVG, comp_id FROM review WHERE comp_id = '$userID' GROUP BY comp_id";
        $ovresult = mysqli_query($db, $overallsql);
        if($overall = mysqli_fetch_object($ovresult)){
            $CompRating =  $overall->compAVG;
            $CeoRating = $overall->ceoAVG;
        }



        echo(" <div><h3>My Company Rating :</h3> ");
        echo(round($CompRating, 1));
        echo("</p></div><div><h3>My CEO Rating : </h3> ");
        echo(round($CeoRating, 1));
        echo("</p></div>");
        ?>
        <form action="" method="post" >
            <?php
            $totalCEORATE = 0;
            $totalCOMPRATE = 0;
            $rewNumber = 0;
            $CeoRating = "";
            $CompRating ="";
            if(isset($_GET['day'])) {
                $rewsql = "SELECT * FROM review WHERE comp_id = \"$userID\" AND date > '" . $_GET['day'] . "'";
            }else{
                $rewsql = "SELECT * FROM review WHERE comp_id = \"$userID\" ";
            }
            $rewresult = mysqli_query($db, $rewsql);
            while ($rew = mysqli_fetch_object($rewresult)) {
                $rewID =$rew->review_id;
                $rewNumber = $rewNumber + 1;
                $rewText = $rew->review_text;
                $rewAnon = $rew->anonymity;
                $rewCompRating = $rew->comp_rating;
                $rewCeoRating = $rew->ceo_rating;
                $totalCEORATE = $totalCEORATE + $rewCeoRating;
                $totalCOMPRATE = $totalCOMPRATE + $rewCompRating;
                $rewInterInfo = $rew->interview_info;
                $rewSalary = $rew->salary_info;
                $rewLocation = $rew->office_location;
                $rewuserID = $rew->user_id;
                $rewDate = $rew->date;
                $rewType = $rew->type;
                if ($rewAnon == 0) {
                    $rewsql2 = "SELECT name, pp_link FROM work_user NATURAL JOIN general_user WHERE user_ID = \"$rewuserID\" ";
                    $rewresult2 = mysqli_query($db, $rewsql2);
                    if ($rewN = mysqli_fetch_object($rewresult2)) {
                        $rewname = $rewN->name;
                        $pplink = $rewN->pp_link;
                    }
                    echo "  <div class=\"row\">
                                <div class=\"\">
                                    <div class=\"card\">
                                        <div class=\"image\">
                                            <img class=\"profile_pic\" src=$pplink>
                                        </div>
                                        <div class=\"text\">
                                            <h3>$rewType </h3>
                                            <p>posted by:$rewname</p>
                                            <p>$rewText</p> <br/>
                                            <p>Company Rating : $rewCompRating</p>
                                            <p>CEO Rating : $rewCeoRating</p>
                                            <input class=\"big_input\" type=\"text\" name= \"$rewID\" placeholder=\"Enter Report Reason\" id=\"reason\">
                                            <button class=\"button\" style = \"height: 5%;\" name=\"report\" type=\"submit\" value=$rewID> Report </button>
                        
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>";
                } else {
                    $rewname = "anon";
                    echo "  <div class=\"row\">
                                <div class=\"\">
                                    <div class=\"card\">                                       
                                        <div class=\"text\">
                                            <h3>$rewType </h3>
                                            <p>$rewText</p> <br/>
                                            <p>Company Rating : $rewCompRating</p>
                                            <p>CEO Rating : $rewCeoRating</p>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                }

            }

            if(isset($_POST['report'])){
                $value= $_POST['report'];
                $reportSql ="INSERT INTO `report`(`user_id`,`description`, `date`) VALUES ('$userID','".$_POST[$value]."','$date')";
                $reportSql2 = "INSERT INTO `has`(`report_id`,`review_id`) VALUES (LAST_INSERT_ID(),'$rewID')";
                $reportresult = mysqli_query($db, $reportSql);
                $reportresult2 =mysqli_query($db, $reportSql2);
                echo("Successfully Sent");
            }
            ?>
        </form>


    </div>


</div>
</div>
</body>
</html>
