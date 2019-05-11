<?php
include("config.php");
session_start();
if (!empty($_SESSION))
{
    $userID = $_SESSION["userID"];
    $sql = "SELECT *FROM comp_user NATURAL JOIN general_user WHERE user_ID = '$userID'";
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
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>My Profile</title>
</head>

<body style="background-color:#FF6F61;">
<header class="main-header">
    <div class="nav">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a  href="#">Create Job</a></li>
            <li><a href="#">My Jobs</a></li>
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
                        $country = $location->country;
                        $zipcode = $location->zipcode;
                        if( $main = $location->mainLocation == 1){
                            $mainApt = $apt_no;
                            $mainStreet = $street;
                            $mainCity = $city;
                            $mainCountry = $country;
                            $mainZipcode = $zipcode;
                            echo("<p> Headquarter $apt_no $street $city $country  $zipcode</p>");
                        }else {
                            echo("<p> $apt_no $street $city $country  $zipcode </p>");
                        }
                    }

            ?>
        </p>

        <h2>Photos</h2>
        <div class="row">
            <div class="column4" style="background-color:#ebb;">
                <h2>Photo 1</h2>
            </div>
            <div class="column4" style="background-color:#bbb;">
                <h2>Photo 2</h2>
            </div>
            <div class="column4" style="background-color:#ccc;">
                <h2>Photo 3</h2>
            </div>
            <div class="column4" style="background-color:#ddd;">
                <h2>Photo 4</h2>
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


</body>
</html>

