
<?php
include("config.php");
session_start();
if (!empty($_SESSION))
{
    $_SESSION["jobID"] = "";
    $userID = $_SESSION["userID"];
    $sql = "SELECT * FROM comp_user NATURAL JOIN general_user WHERE user_ID = '$userID'";
    $result = mysqli_query($db,$sql);
    $compUser = mysqli_fetch_object($result);
    $name = $compUser->company_name;
    $desc = $compUser->description;
    $phone= $compUser->phone_no;
    $pplink =$compUser->pp_link;
    $email = $compUser->email;
}
else
{
    header("location: home.php");
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://sorgalla.com/jcarousel/dist/jquery.jcarousel.min.js?raw=1"></script>
<link rel="stylesheet" type="text/css" href="jcarousel.responsive.css">
<script type="text/javascript" src="jcarousel.responsive.js"></script>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>My Profile</title>
</head>

<body style="background-color:#FF6F61;">
<header class="main-header">
    <div class="nav">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a  href="createjob.php">Create Job</a></li>
            <li><a href="myjobscompany.php">My Jobs</a></li>
            <li><a class="active" href="#">My Profile</a></li>
        </ul>
    </div>
</header>

<br>
<div class="profile_pic">
    <img class="profile_pic" src="<?php echo $pplink; ?>">
</div>
<div style="text-align:center">
    <a href="https://www.w3schools.com/html/">Update Picture</a>
</div>
<div style="text-align:center">
    <h3><?php echo $name?></h3>
</div>
<br>

<div class="row">
    <div class="column" style="background-color:#aaa;">

        <h2 style="display: inline-block;padding-right: 15px;">Description</h2><a href="https://www.w3schools.com/html/">Edit</a>
        <p><?php echo $desc?></p>

        <h2 style="display: inline-block;padding-right: 31px;">Locations</h2><a  href="https://www.w3schools.com/html/">Edit</a>
        <p>
            <?php
                $locationSql = "SELECT * FROM location WHERE comp_ID = '$userID'";
                $result2 = mysqli_query($db,$locationSql);
                    while($location = mysqli_fetch_object($result2)){
                        $apt_no = $location->apartment_no;
                        $street = $location->street;
                        $city = $location->city;
                        $state = $location->state;
                        $country = $location->country;
                        $zipcode = $location->zipcode;
                        if( $main = $location->mainLocation == 1){
                            $mainApt = $apt_no;
                            $mainStreet = $street;
                            $mainCity = $city;
                            $mainState = $state;
                            $mainCountry = $country;
                            $mainZipcode = $zipcode;
                            echo("<p> Headquarter $apt_no $street $city $state $country  $zipcode</p>");
                        }else {
                            echo("<p> $apt_no $street $city $state $country  $zipcode </p>");
                        }
                    }

            ?>
        </p>

        <h2>Photos</h2>
        <div class="wrapper">

            <div class="jcarousel-wrapper">
                <div class="jcarousel">
                    <ul>
                        <?php
                             $picSql = "SELECT * FROM picture WHERE user_ID = '$userID'";
                             $result3 = mysqli_query($db,$picSql);
                             while($pic = mysqli_fetch_object($result3)){
                               $link = $pic->link;
                               $picDesc = $pic->description;
                               echo("<li><figure><img src='$link' alt=$picDesc onclick=\"newModal(this)\">");
                               echo("<figcaption> $picDesc </figcaption></figure></li>");
                             }
                        ?>
                    </ul>
                </div>

                <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
                <a href="#" class="jcarousel-control-next">&rsaquo;</a>

                <p class="jcarousel-pagination"></p>
            </div>
        </div>

    </div>

    <div class="column" style="background-color:#bbb;">
        <h2>Contact Information</h2>
        <h3>Email</h3>
        <p><?php echo $email?></p>
        <h3>Phone</h3>
        <p><?php echo $phone?></p>
        <h3>Addres</h3>
        <p><?php echo $mainApt," ", $mainStreet, " ", $mainCity," ", $mainCountry, " ", $mainZipcode ?> </p>
        <a href="https://www.w3schools.com/html/">Edit</a>
    </div>
</div>

<div id="myModal" class="modal">

    <!-- The Close Button -->
    <span class="close">&times;</span>

    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="img01">

    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
</div>
</body>
</html>

