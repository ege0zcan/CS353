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
    <link rel="stylesheet" href="../style.css">
    <title>Search Job</title>
</head>

<body style="background-color:#dddfd4;">
<header class="main-header">
    <div class="nav">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a class="active" href="#">Job Search</a></li>
            <li><a href="companysearch.php">Company Search</a></li>
            <li><a href="myapplications.php">My Applications</a></li>
            <li><a href="myprofilework.php">My Profile</a></li>
        </ul>
    </div>
</header>
<br><br><br>

<form style="text-align: center" action="" method="GET">
    <input class="input" style="display: inline-block;width: 15%;margin-left: 24.5%" type="text" placeholder="Job Title" name="jobTitle">
    <input class="input" style="display: inline-block;width: 15%;margin-left: 20px" type="text" placeholder="Location" name="location">
    <select class="select" id="type" name="type" style="display:inline-block;width: 15%;margin-left: 20px">
        <option value="">Choose Job Type</option>
        <option value="Internship">Internship</option>
        <option value="Full Time">Full Time</option>
        <option value="Part Time">Part Time</option>
    </select>
    <button type="submit" class="button" style="display: inline-block; height: 50px; margin-left: 25px; background-color: transparent; box-shadow:none; color: #173e43; ">Search</button>
</form>
<form style="text-align: center" action="" method="POST">
    <div class="row">
        <div class="column4">
<?php
        if (isset($_GET['jobTitle']) || isset($_GET['location']) || isset($_GET['type'] )){
            if($_GET['jobTitle']!= "" && $_GET['location']!= "" && $_GET['type']!= "" ) {
                $sql = "SELECT * FROM job_offering NATURAL JOIN comp_user NATURAL JOIN posts WHERE job_title LIKE '".$_GET['jobTitle']."%' AND office_location LIKE '".$_GET['location']."%' AND job_type LIKE '".$_GET['type']."'% ";
            }else if($_GET['jobTitle']!= "" && $_GET['location']!= "" ) {
                $sql = "SELECT * FROM job_offering NATURAL JOIN comp_user NATURAL JOIN posts WHERE job_title LIKE '".$_GET['jobTitle']."%' AND office_location LIKE '".$_GET['location']."%' ";
            }else if($_GET['jobTitle']!= ""  && $_GET['type']!= "" ) {
                $sql = "SELECT * FROM job_offering NATURAL JOIN comp_user NATURAL JOIN posts WHERE job_title LIKE '".$_GET['jobTitle']."%'  AND job_type LIKE '".$_GET['type']."%' ";
            }else if( $_GET['location']!= "" && $_GET['type'] != "" ){
                $sql = "SELECT * FROM job_offering NATURAL JOIN comp_user NATURAL JOIN posts WHERE  office_location LIKE '".$_GET['location']."%' AND job_type LIKE '".$_GET['type']."%' ";
            }else if( $_GET['jobTitle']!= ""  ) {
                $sql = "SELECT * FROM job_offering NATURAL JOIN comp_user NATURAL JOIN posts WHERE job_title LIKE '".$_GET['jobTitle']."%' ";
            }else if($_GET['location']!= "") {
                $sql = "SELECT * FROM job_offering NATURAL JOIN comp_user NATURAL JOIN posts WHERE office_location LIKE '".$_GET['location']."%' ";
            }else if($_GET['type']!= ""  ) {
                $sql = "SELECT * FROM job_offering NATURAL JOIN comp_user NATURAL JOIN posts WHERE  job_type LIKE '".$_GET['type']."%' ";
            }else{
                $sql = "SELECT * FROM job_offering NATURAL JOIN comp_user NATURAL JOIN posts ";
            }
            $result = mysqli_query($db, $sql);
            while($job = mysqli_fetch_object($result)){

                $jobID = $job->offering_id;
                $jobTitle = $job->job_title;

                echo(" <li><button name=\"submit\" type=\"submit\" value=$jobID> $jobTitle </button></li>");
            }

        }

    ?>

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
        <h1 class="create" style="display: inline-block; margin-left: 20px">Job Details</h1>

        <button class="button" type = "submit" name="apply" style="display: inline-block; height: 50px;margin-left: 475px; font-size: 16px">Apply</button>
</form>
        <a style="margin-left: 30px;" href="home.html">Company Profile</a>
        <div class="row">
            <div class="column1">
                <?php
                if(isset($_POST['submit'])){
                    $ID = $_POST["submit"];
                    $_SESSION['curjobID'] = $ID;
                    $sql2 = "SELECT * FROM job_offering NATURAL JOIN comp_user NATURAL JOIN posts WHERE offering_ID = $ID";
                    $result2 = mysqli_query($db, $sql2);
                    if( $offering = mysqli_fetch_object($result2)){
                        $title = $offering->job_title;
                        $dept = $offering->job_dept;
                        $type = $offering->job_type;
                        $location = $offering->office_location;
                        $details = $offering->details;
                        $name = $offering->company_name;
                        $desc = $offering->description;
                        echo("<p style=\"display: inline-block; margin-left: 20px;\">JOB TITLE: $title Department: $dept Type: $type Location: $location Details: $details Company Name: $name Description: $desc </p>");
                    }
                }
                if(isset($_POST['apply'])){
                    $ID = $_SESSION['curjobID'];
                    $sql3 = "INSERT INTO applies VALUES ($userID,$ID,\"PENDING\")";
                    $result3 = mysqli_query($db, $sql3);
                    if (!$result3){
                        echo ( "<p> You already applied for this job offering.</p>");
                    }else{
                        echo ( "<p> Your application is succefully sent.</p>");
                        echo ( "<p> Please Check My Applications Page.</p>");
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
