<?php
include("config.php");
session_start();
if (!empty($_SESSION))
{
    $userID = $_SESSION["userID"];
    $id = $_SESSION["idForSolve"];

}
else
{
    header("location: home.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">


    <title>Create Application Test</title>

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
        <br><br>
    </header>

</head>

<body style="background-color:#dddfd4;">

<div class="row">
    <div class="column"  style="margin-left:15%">
        <form  action="" method="POST">

        <ol id="questionList">
            <?php
            $count = 0;
            $sql = "SELECT * FROM application_test  WHERE offering_id ='". $_SESSION['idForSolve'] ."'";
            $result = mysqli_query($db, $sql);
            while($question = mysqli_fetch_object($result)){
                $q = $question->question;
                $qIDs[$count] =  $question->question_id;
                echo( "            <li id=\"question\">");
                echo( "<p>Question:</p>");
                echo( "<p>$q</p>");
                echo( "<input type=\"text\" name=\"$count\" size=\"128\"><br/><br/>");
                echo("</li>");
                $count = $count + 1;
            }
            ?>

                <button class="button" type = "submit" id="addButton" name="add" id="add" >Send Answers</button> <br/>
            </form>
        </ol>

        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" ) {

            if (isset($_POST['add'])) {
                $count = $count - 1;
                while($count >= 0) {

                    $sql2 = "INSERT INTO does  VALUES('" . $_SESSION['idForSolve'] . "', $userID, $qIDs[$count] ,'". $_POST[$count]."' )";
                    $result = mysqli_query($db, $sql2);
                    $count = $count - 1;
                }
                header("location: myapplications.php");
            }
        }

        ?>
        <button type="submit" class="button" style="display: inline-block; height: 50px; margin-left: 25px; background-color: transparent; box-shadow:none; color: #173e43; "><a href="myapplications.php">BACK</a></button>
    </div>

</div>

<script type="text/javascript" src="../js/materialize.min.js"></script>

</body>

</html>
