
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

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $formType = $_POST["formType"];
    if ($formType == "description") {
        $editedDescriptionText = $_REQUEST["description"];
        $sql = "UPDATE comp_user SET description = '$editedDescriptionText' WHERE user_ID = '$userID'";
        $result = mysqli_query($db,$sql);
        echo $result, "edited description";
    }

    if ($formType == "location"){
        echo "edited location";
    }

    if ($formType == "address"){
        echo "edited address";
    }
}

?>

/////////////////////////////////////////////////////
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://sorgalla.com/jcarousel/dist/jquery.jcarousel.min.js?raw=1"></script>
    <script type="text/javascript" src="../jcarousel.responsive.js"></script>

    <title>My Profile</title>
</head>

<body style="background-color:#dddfd4;">

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
<div style="text-align:center" class="profile_pic">
    <img class="profile_pic" src="<?php echo $pplink; ?>">
</div>
<div style="text-align:center">
    <a href="https://www.w3schools.com/html/">Update Picture</a>
    <form action="uploadcompany.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</div>
<div style="text-align:center">
    <h3><?php echo $name?></h3>
</div>
<br>

<div class="row">
    <div class="column"  style="margin-left:15%">

        <h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">Description</h2><button onclick="editDescription()" class="edit">Edit</button>
        <p style="margin-left: 3%;"><?php echo $desc?></p>
        <form method="post" hidden id="editDescriptionForm">
            <input name="formType" value="description" hidden>
            <input type="text" id="editDescriptionInput" name="description"><br>
            <button type="submit">Submit</button>
        </form>


        <h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">Locations</h2><button onclick="editLocation()" class="edit">Add</button>
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
                    echo("<p style=\"margin-left: 3%;\"> Headquarter $apt_no $street $city $state $country  $zipcode</p>");
                }else {
                    echo("<p style=\"margin-left: 3%;\"> $apt_no $street $city $state $country  $zipcode </p>");
                }
            }
            ?>

        <form method="post" hidden id="addLocationForm">
            <input name="formType" value="location" hidden>
            <input type="text" id="addLocationInput"><br>
            <button type="submit">Submit</button>
        </form>


    </div>
    <div class="column" style="margin-left:15%">
        <h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">Contact Information</h2><br />
        <h3>Email</h3>
        <p style="margin-left: 3%;"><?php echo $email?></p>
        <h3>Phone</h3>
        <p style="margin-left: 3%;"><?php echo $phone?></p>
        <h3>Addres</h3> <a href="https://www.w3schools.com/html/" class="edit">Edit</a>
        <p style="margin-left: 3%;"><?php echo $mainApt," ", $mainStreet, " ", $mainCity," ", $mainCountry, " ", $mainZipcode ?> </p>
        <form method="post" hidden id="editAddressForm">
            <input name="formType" value="address" hidden>
            <input type="text" id="editAddressInput"><br>
            <button type="submit">Submit</button>
        </form>

        <h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">Photos</h2>
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

<!-- The Modal -->
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

