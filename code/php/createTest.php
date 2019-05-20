<?php
include("config.php");
session_start();
if (!empty($_SESSION))
{
    $userID = $_SESSION["userID"];
    $id = $_SESSION["idForTest"];

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
                <li><a href="myreviews.php">My Reviews</a></li>
                <li><a  href="createjob.php">Create Job</a></li>
                <li><a class="active" href="#">My Jobs</a></li>
                <li><a  href="myprofilecompany.php">My Profile</a></li>
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
                $sql = "SELECT * FROM application_test  WHERE offering_id ='". $_SESSION['idForTest'] ."'";
                $result = mysqli_query($db, $sql);
                while($question = mysqli_fetch_object($result)){
                    $count = $count + 1;
                    $q = $question->question;
                    $qid = $question->question_id;
                    echo( "            <li id=\"question\">");
                    echo( "<p>Question:</p>");
                    echo( "<p>$q</p>");
                    echo("</li>");
                    echo("<button class=\"button\" type = \"submit\" id=\"addButton\" name=\"delete\" value=\"$qid\" >Delete Question</button> <br/>");
                }
            ?>

            <li id="question">
                <p>Question:</p>
                <input type="text" name="newQ" size="128"><br/><br/>
            </li>

            <button class="button" type = "submit" id="addButton" name="add" id="add" >Add Question</button> <br/>
            </form>
        </ol>

        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" ) {
                if (isset($_POST['add'])) {
                    $sql2 = "INSERT INTO application_test  VALUES(DEFAULT,'" . $_SESSION['idForTest'] . "','" . $_POST['newQ'] . "' )";
                    $result = mysqli_query($db, $sql2);
                    header("location: createTest.php");
                }
                if(isset($_POST['delete'])){
                    $delete = "DELETE FROM application_test WHERE question_id = '". $_POST['delete']."' ";
                    $result2 =mysqli_query($db, $delete);
                    header("location: createTest.php");

                }
            }

        ?>
        <button type="submit" class="button" style="display: inline-block; height: 50px; margin-left: 25px; background-color: transparent; box-shadow:none; color: #173e43; "><a href="myjobscompany.php">BACK</a></button>
    </div>

</div>

<script type="text/javascript" src="../js/materialize.min.js"></script>

</body>

</html>
