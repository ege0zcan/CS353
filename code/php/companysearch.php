<?php
include("config.php");
session_start();
$date = date("Y-m-d");
if (!empty($_SESSION))
{
    $userID = $_SESSION["userID"];
}
else
{
    header("location: home.php");
}

if( isset($_SESSION["disable"]) && $_SESSION["disable"] == "" ){
    $disable = "";

    $companyName = $_SESSION["companyName"];
    $disable = $_SESSION["disable"];
    $compID = $_SESSION["compID"];
}
else{
    $companyName = "PLEASE SELECT A COMPANY..";
    $disable = "disabled=disabled";
}

if($_SERVER["REQUEST_METHOD"] == "POST" )
{
//date check
    $fetchDate = "SELECT MAX(date) as asd, user_id FROM review WHERE user_id = '$userID' and comp_id ='$compID' GROUP BY user_id";
    $query = mysqli_query($db,$fetchDate);
    $workUser = mysqli_fetch_object($query);
    $last = $workUser->asd;
    $checktime = abs(strtotime($date) - strtotime($last));
    $years = floor($checktime / (365*60*60*24));
    $months = floor(($checktime - $years * 365*60*60*24) / (30*60*60*24));

    if ( $years < 1 && $months < 6){
        echo "<script>alert(\"YOU'VE SUBMITTED A COMMENT FOR THIS COMPANY IN 6 MONTHS\")</script>";
    }else{
        $compR = $_POST["rate"];
        $ceoR = $_POST["rate2"];
        $reviewT = $_POST["rtype"];
        if(isset($_POST['checkbox'])){
            $anon = $_POST["checkbox"];
            $anon = 0;
        }
        else {
            $anon = 1;
        }
        $interview = $_POST["interview"];
        $salary = $_POST["salary"];
        $review = $_POST["review"];

        $sql = "INSERT INTO review (anonymity, type, review_text, comp_rating, ceo_rating, interview_info, salary_info, office_location, user_id, comp_id, date) VALUES ('$anon', '$reviewT', '$review', '$compR', '$ceoR','$interview', '$salary', '$compID','$userID', '$compID', 'DEFAULT')";
        $result = mysqli_query($db,$sql);

    }
}
?>


<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">


    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="typeahead.js"></script>
    <script>
        $(document).ready(function () {
            $('#companyName').typeahead({
                source: function (query, result) {
                    $.ajax({
                        url: "bar_compSearch.php",
                        data: 'query=' + query,
                        dataType: "json",
                        type: "POST",
                        success: function (data) {
                            result($.map(data, function (item) {
                                console.log(item);
                                return item;
                            }));
                        }
                    });
                }
            });
        });
    </script>



    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Company Search</title>
</head>

<body style="background-color:#dddfd4;">
<header class="main-header">
    <div class="nav">
        <ul>
            <li><a href="searchjob.php">Job Search</a></li>
            <li><a class="active" href="#">Company Search</a></li>
            <li><a href="myapplications.php">My Applications</a></li>
            <li><a href="myprofilework.php">My Profile</a></li>
        </ul>
    </div>
</header>
<br><br><br>


<form style="text-align: center" action="" method="GET">
    <input class="input" style="display: inline-block;width: 15%;margin-left: 3%;" type="text" placeholder="Company Name" name="companyName" id="companyName" >
    <button type="submit" class="button" style="display: inline-block; height: 50px; margin-left: 0px; ; background-color: transparent; box-shadow:none; color: #173e43; ">Search</button>
    <?php
    if(isset($_GET['companyName'])) {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $companyName = $_GET["companyName"];
            $sql = "SELECT * FROM comp_user NATURAL JOIN general_user WHERE company_name = \"$companyName\" ";
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result)==0) {
                $_SESSION["disable"] = "disabled=disabled";
                $disable = "disabled=disabled";
            }else {
                if ($curComp = mysqli_fetch_object($result)) {
                    $compID = $curComp->user_ID;
                    $compDesc = $curComp->description;
                    $_SESSION["disable"] = "";
                    $_SESSION["companyName"] = $companyName;
                    $_SESSION["compID"] = $compID;
                }
            }
        }
    }
    ?>
</form>

<div class="row">
    <div class="column" style="margin-left: 3%">

        <h2 style="display: inline-block; height: 50px; font-size: 24px; margin-left: 30px;"><?php if(isset($_SESSION["disable"]) && $_SESSION["disable"] == ""){echo $companyName;}else{echo ("PLEASE SELECT A COMPANY..");} ?></></h2> <br>
        <?php
        if(isset($_SESSION["disable"]) && $_SESSION["disable"] == "") {
            $overallsql= "SELECT AVG(comp_rating) as compAVG, AVG(ceo_rating) as ceoAVG, comp_id FROM review WHERE comp_id = '$compID' GROUP BY comp_id";
            $ovresult = mysqli_query($db, $overallsql);
            if($overall = mysqli_fetch_object($ovresult)){
                $CompRating =  $overall->compAVG;
                $CeoRating = $overall->ceoAVG;
            }


            echo(" <div><h3>Company Rating :</h3> ");
            echo(round($CompRating, 1));
            echo("</p></div><div><h3>CEO Rating : </h3> ");
            echo(round($CeoRating, 1));
            echo("</p></div>");
        }
        ?>
        <?php
        $totalCEORATE = 0;
        $totalCOMPRATE = 0;
        $rewNumber = 0;
        $CeoRating = "";
        $CompRating ="";
        if (isset($_SESSION["disable"]) && $_SESSION["disable"] == "") {
            $disable = $_SESSION["disable"];
            echo("<h3>Reviews</h3> <br />");
            $rewsql = "SELECT * FROM review WHERE comp_id = \"$compID\" ";
            $rewresult = mysqli_query($db, $rewsql);
            while ($rew = mysqli_fetch_object($rewresult)) {

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
            if ($rewNumber != 0) {
                $CeoRating = $totalCEORATE / $rewNumber;
                $CompRating = $totalCOMPRATE / $rewNumber;
            } else {
                $CeoRating = "";
                $CompRating = "";
            }

        }

        ?>






        <div class="pagination" style="margin-left: 15px;">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#" >2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">&raquo;</a>
        </div>

    </div>

    <div class="column4" style="background-color: #b3c2bf; height: 500px; width: 20%; margin-left: 20px; padding: 10px;">
        <h2>Leave Review</h2>
        <form style="text-align: center" action="" method="post">

            <select class="select" id="type" name="rtype" style="width: 100%;float: left; height:5%" required>
                <option disabled value="">Choose Type for Review</option>
                <option value="Internship">Internship</option>
                <option value="Full Time">Full Time</option>
                <option value="Part Time">Part Time</option>
            </select>
            <br><br>
            <label class="switch">
                <input type="checkbox" name="checkbox" id="togBtn"/>
                <div class="slider round" n>
                    <span class="on" value= "public">Public</span>
                    <span class="off" value= "anon">Anon</span>
                </div>
            </label>

            <label for="comprate" style="display: block;visibility: hidden">Company Rating</label>
            <div class="rate " id="comprate" >
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="text">1 star</label>
            </div>

            <label for="ceorate" style="display: block; font-size: 12px;">Company Rating</label>

            <div class="rate" id="ceorate" value="2">
                <input type="radio" id="star55" name="rate2" value="5" />
                <label for="star55" title="text">5 stars</label>
                <input type="radio" id="star44" name="rate2" value="4" />
                <label for="star44" title="text">4 stars</label>
                <input type="radio" id="star33" name="rate2" value="3" />
                <label for="star33" title="text">3 stars</label>
                <input type="radio" id="star22" name="rate2" value="2" />
                <label for="star22" title="text">2 stars</label>
                <input type="radio" id="star11" name="rate2" value="1" />
                <label for="star11" title="text">1 star</label>
            </div>

            <label for="ceorate" style="display: block; font-size: 12px; line-height: 72px; text-align: left;">CEO Rating</label>


            <input class="input" style="height: 6%;width: 100%" type="text" placeholder="Enter Interview Info" id="interview" name ="interview" required>
            <br>

            <input class="input" style="height: 6%;width: 100%" type="text" placeholder="Enter Salary Info" id="salary" name ="salary" required>
            <br>

            <input class="input" style="height: 6%;width: 100%" type="text" placeholder="Enter Review" id="review" name ="review" required>
            <br>
            <button type="submit" class="button" style="height: 40px; width: 50%; font-size: 16px;" type="submit" <?php echo $disable;?> >Publish</button>
        </form>

    </div>
</div>
</body>
</html>
