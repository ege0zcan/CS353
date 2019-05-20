<?php
include("config.php");



?>

////////////////////////////////////////////////
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Reviews</title>
</head>

<body style="background-color:#dddfd4;">
<header class="main-header">
    <div class="nav">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="searchjob.php">Job Search</a></li>
            <li><a href="companysearch.php">Company Search</a></li>
            <li><a class="active" href="#">Reviews</a></li>
        </ul>
    </div>
</header>



<body style="background-color:#dddfd4;">

<div class="row">
    <div class="column"  style="margin-left:15%">
        <table border = "1" width = "50%">
            <tbody>
            <tr>
                <th> Report No </th>
                <th> From Company </th>
                <th> Review Published By  </th>
                <th> Reason </th>
                <th> Review Info </th>
                <th> Remove Review </th>
                <th> Remove Report </th>
            </tr>
            <?php

            $sql = "SELECT DISTINCT r.report_id, company_name, rev.user_id,rev.review_id, r.description , rev.review_text FROM (report as r NATURAL JOIN submits as s NATURAL JOIN has ) JOIN review as rev JOIN comp_user WHERE has.review_id = rev.review_id and comp_user.user_id = s.user_id";
            $result = mysqli_query($db,$sql);
            while( $report = mysqli_fetch_object($result)){
                $reportID = $report->report_id;
                $reportCompanyName = $report->company_name;
                $reportUserID = $report->user_id;
                $reportDesc = $report->description;
                $reportRevtext  = $report->review_text;
                $reportRevID = $report->review_id;
                echo ("<tr>
              <th> $reportID </th>
              <th> $reportCompanyName </th>
              <th> $reportUserID </th>
              <th> $reportDesc </th>
              <th> $reportRevtext </th>
              <th><form method='post'> <input type='submit' name='removeREV' value=$reportRevID  placeholder = 'delete'> delete</input></form> </th>
              
              <th><form method='post'> <input type='submit' name='removeREP' value=$reportID  placeholder = 'delete'> delete</input></form>  </th>
              </tr>");

            }
            if(isset($_POST['removeREV'])){
                $value = $_POST['removeREV'];
                $reportID = "SELECT report_id FROM has WHERE review_id = $value";
                $result = mysqli_query($db,$reportID);
                $repId = mysqli_fetch_object($result);
                $ID = $repId->report_id;
                $delete = "DELETE FROM review WHERE review_id = $value";
                $delete2 = "DELETE FROM report WHERE report_id = $ID";
                $result = mysqli_query($db,$delete);
                $result2 = mysqli_query($db,$delete2);

                header("location: adminprofile.php");
            }
            if(isset($_POST['removeREP'])){
                $value2 = $_POST['removeREP'];

                $delete2 = "DELETE FROM report WHERE report_id = $value2";

                $result4 = mysqli_query($db,$delete2);


                header("location: adminprofile.php");
            }


            ?>
            </tbody>
        </table>

        <script type="text/javascript" src="../js/materialize.min.js"></script>



    </div>

</div>


</body>

</html>
