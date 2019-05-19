<?php
    include("config.php");
    session_start();
    if (!empty($_SESSION))
    {
        $userID = $_SESSION["userID"];
        $sql = "SELECT *FROM work_user NATURAL JOIN general_user WHERE user_ID = '$userID'";
        $result = mysqli_query($db,$sql);
        $workUser = mysqli_fetch_object($result);
        $name = $workUser->name;
        $backInfo = $workUser->background_info;
        $exp = $workUser->experience;
        $interests = $workUser->saved_interests;
        $phone= $workUser->phone_no;
        $pplink =$workUser->pp_link;
        $apt_no = $workUser->apartment_no;
        $street = $workUser->street;
        $city = $workUser->city;
        $state = $workUser->state;
        $country = $workUser->country;
        $zipcode = $workUser->zipcode;
        $email = $workUser->email;
    }
    else
    {
        header("location: home.php");
    }

?>

////////////////////////////////////////////////
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>My Profile</title>
</head>

<body style="background-color:#dddfd4;">
<header class="main-header">
    <div class="nav">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="searchjob.php">Job Search</a></li>
            <li><a href="companysearch.php">Company Search</a></li>
            <li><a href="myapplications.php">My Applications</a></li>
            <li><a class="active" href="#">My Profile</a></li>
        </ul>
    </div>
</header>

<br>
<div class="profile_pic" >
    <img class="profile_pic" src="<?php echo $pplink; ?>">

</div>
<div style="text-align:center">
    <h3><?php echo $name?></h3>
</div>
<div style="text-align:center">
    <a href="https://www.w3schools.com/html/">Update Picture</a>
</div>
<br>

<div class="row">
    <div class="column" style="  margin-left:15%">

        <h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">Background Information</h2><a href="https://www.w3schools.com/html/" class="edit">Edit</a>
        <p style="margin-left: 3%;"><?php echo $backInfo?> </p>

        <h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">Experience</h2><a  href="https://www.w3schools.com/html/" class="edit">Edit</a>
        <p style="margin-left: 3%;"><?php echo $exp?></p>

        <h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">Interests</h2><a  href="https://www.w3schools.com/html/" class="edit">Edit</a>
        <p style="margin-left: 3%;"><?php echo $interests?></p>

        <h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">Contact Information</h2> <br />
        <h3>Email</h3>
        <p style="margin-left: 3%;"> <?php echo $email?></p>
        <h3>Phone</h3>
        <p style="margin-left: 3%;"><?php echo $phone?></p>
        <h3>Addres</h3> <a href="https://www.w3schools.com/html/" class="edit">Edit</a>
        <p style="margin-left: 3%;"><?php echo $apt_no," ", $street, " ", $city," ", $country, " ", $zipcode ?> </p>

    </div>

</div>


</body>
</html>

