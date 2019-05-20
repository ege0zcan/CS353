<?php
    include("config.php");
    session_start();
    if (!empty($_SESSION))
    {
        $userID = $_SESSION["currentWorkID"];
        $testID = $_SESSION["idForTest"];
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
        $count = 1;
        $soru = "SELECT question, answers FROM does NATURAL JOIN application_test WHERE user_id = '$userID'";
        $result1 = mysqli_query($db,$soru);
        
        
  
        if (isset($_POST['Accepted'])) {
            
            $value = $_POST['Accepted'];
            $sql = "UPDATE applies SET status ='$value' WHERE user_id = '$userID'";
            $result = mysqli_query($db,$sql);
        }
        
        if (isset($_POST['Rejected'])) {
            
            $value = $_POST['Rejected'];
            $sql = "UPDATE applies SET status ='$value' WHERE user_id = '$userID'";
            $result = mysqli_query($db,$sql);
        }
  
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
<title>My Profile</title>
</head>

<body style="background-color:#dddfd4;">
<header class="main-header">
<div class="nav">
<ul>
    <li><a href="myreviews.php">My Reviews</a></li>
    <li><a  href="createjob.php">Create Job</a></li>
    <li><a class="active" href="myjobscompany.php">My Jobs</a></li>
    <li><a  href="myprofilecompany.php">My Profile</a></li>
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
</div>
<br>

<div class="column" style="display:inline-block;width: 45%;margin-left: 24.5px">

<h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">Background Information</h2>
<p style="margin-left: 3%;"><?php echo $backInfo?> </p>

<h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">Experience</h2>
<p style="margin-left: 3%;"><?php echo $exp?></p>

<h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">Interests</h2>
<p style="margin-left: 3%;"><?php echo $interests?></p>

<h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">Contact Information</h2> <br />
<h3>Email</h3>
<p style="margin-left: 3%;"> <?php echo $email?></p>
<h3>Phone</h3>
<p style="margin-left: 3%;"><?php echo $phone?></p>
<h3>Addres</h3> <a href="https://www.w3schools.com/html/" class="edit">Edit</a>
<p style="margin-left: 3%;"><?php echo $apt_no," ", $street, " ", $city," ", $country, " ", $zipcode ?> </p>



</div>

<div class="row">
<div class="column" style="display:inline-block;width: 45%;margin-left: 24.5px">

<h2 style="display: inline-block; margin-left: 3%; padding-right: 15px;">ANSWERS</h2>

<p style="margin-left: 3%;"><?php
    
        while( $row = mysqli_fetch_array($result1, MYSQLI_NUM)){
            echo $count;
            echo ") ";
            echo ($row[0]);
            echo "<br>";
        
            echo ($row[1]);
            echo "<br>";
            $count = $count + 1;
        
    }
              
?> </p>





<form action="" method="POST">
<button class="button" type = "submit" name='Accepted' value = 'Accepted'style="display: inline-block; width: 20%;height: 5%;margin-left: 30.5px font-size: 8px">ACCEPT</button>

<button class="button" type = "submit" name='Rejected' value = 'Rejected'style="display: inline-block; width: 20%; height: 5%;margin-left: 30.5px font-size: 8px">REJECT</button>
  <button type="submit" class="button" style="display: inline-block; height: 50px; margin-left: 25px; background-color: transparent; box-shadow:none; color: #173e43; "><a href="myjobscompany.php">BACK</a></button>

</form>
</div>

</div>





</body>
</html>

