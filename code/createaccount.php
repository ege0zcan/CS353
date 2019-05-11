<script>
var test = "asd";
function yesnoCheck() {
    
    if (document.getElementById('employerCheck').checked) {
        document.getElementById('street').style.display = 'block';
        document.getElementById('apt').style.display = 'block';
        document.getElementById('zip').style.display = 'block';
        document.getElementById('comp').style.display = 'block';
        document.getElementById('br').style.display = 'block';
        document.getElementById('br1').style.display = 'block';
        document.getElementById('br2').style.display = 'block';
        document.getElementById('br3').style.display = 'block';
        document.getElementById('name').style.display = 'none';
        document.getElementById('surname').style.display = 'none';
        document.getElementById('br4').style.display = 'none';
        document.getElementById('br5').style.display = 'none';
        
        $check = 1;
    }
    else {
        document.getElementById('street').style.display = 'none';
        document.getElementById('apt').style.display = 'none';
        document.getElementById('zip').style.display = 'none';
        document.getElementById('comp').style.display = 'none';
        document.getElementById('br1').style.display = 'none';
        document.getElementById('br2').style.display = 'none';
        document.getElementById('br3').style.display = 'none';
        document.getElementById('name').style.display = 'block';
        document.getElementById('surname').style.display = 'block';
        document.getElementById('br4').style.display = 'block';
        document.getElementById('br5').style.display = 'block';
        
    }
}
</script>
<?php
    include('config.php');
    session_start();
    
    $date = date("Y-m-d");
    echo $date;
     echo "<script>document.writeln(test);</script>";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = $_REQUEST["email"];
        $password = $_REQUEST["psw"];
        $phoneno = $_REQUEST["phone"];
        $countryId = $_REQUEST["country"];
        $stateId = $_REQUEST["state"];
        $cityId = $_REQUEST["city"];
        $chosenAnswer = $_POST["toggle"];
        if( $chosenAnswer == 1){
            $name = $_REQUEST["name"];
            $surname = $_REQUEST["surname"];
            $sql = "INSERT INTO general_user (email, password, phone_no, reg_date, apartment_no, street, city, country, zipcode) VALUES ('$email', '$password', '$phoneno', '$date', '', '','$cityId', '$countryId', '')";
            $result2 = mysqli_query($db,$sql);
            
            echo $result2;
            $getId = "SELECT user_ID FROM general_user WHERE email = '$email'";
            
            
            $result = mysqli_query($db,$getId);
            $id = mysqli_fetch_object($result);
            $idFetch = $id->user_ID;
            //work user
            $sql2 = "INSERT INTO work_user (user_ID, name, backgorund_info, experience, saved_interests) VALUES ('$idFetch','$name', '', '', '')";
            $result3 = mysqli_query($db,$sql2);
            if( $result3 == 1)
                echo "done";
        }else{
            $street = $_REQUEST["street"];
            $apt = $_REQUEST["apartment"];
            $zip = $_REQUEST["zipcode"];
            $comp = $_REQUEST["company"];
            $sql = "INSERT INTO general_user (email, password, phone_no, reg_date, apartment_no, street, city, country, zipcode) VALUES ('$email', '$password', '$phoneno', '$date', '$apt', '$street','$cityId', '$countryId', 'zipcode')";
            $result2 = mysqli_query($db,$sql);
            if( $result2 == 1) {
                $getId = "SELECT user_ID FROM general_user WHERE email = '$email'";
                $result = mysqli_query($db,$getId);
                $id = mysqli_fetch_object($result);
                
                $idFetch = $id->user_ID;
                echo $id->user_ID;
                echo $comp;
                //comp user
                $sql2 = "INSERT INTO comp_user (user_ID, company_name, description) VALUES ('$idFetch','$comp','')";
                $sql3 = "INSERT INTO location   (comp_ID, apartment_no, street, city, country, zipcode) VALUES ('$idFetch','$apt','$street', '$cityId','$countryId', '$zip')";
                $result4 = mysqli_query($db,$sql3);
                $result3 = mysqli_query($db,$sql2);
                echo $result3;
                if( $result3 == 1 && $result4 == 1)
                    echo "done";
            }
            
        }
        
        
    }else{

    }
    
    
?>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Create Account</title>
</head>
<body style="background-color:#FF6F61;">
<br>
<h1 style="text-align:center;" onclick="location.href='http://google.com';">Glass Ceiling</h1>

<form action="" method="post">

<div id="donate">
<label style="width:15%"></label>
<label ><input type="radio" name="toggle" id="employeeCheck" value = "1" onclick="yesnoCheck();" checked="checked" required><span>Employee</span></label>
<label><input type="radio" name="toggle" id="employerCheck" value = "2" onclick="yesnoCheck();"><span>Employer</span></label>
</div>


<br><br>
<input class="input" type="email" placeholder="Enter Email" name="email" id = "email" required>
<br>
<input class="input" type="password" placeholder="Enter Password" name="psw" id = "psw" required>
<br>
<input class="input" type="number" placeholder="Enter Phone" min="1" name="phone"  id = "phone" required>
<br>


<select style="display:inline-block;margin-left:35%;width: 14%;background-color: #FFF8E7;" name="country" class="countries" id="countryId" required>
<option value="">Select Country</option>
</select>
<select style="display: inline;background-color: #FFF8E7;" name="state" class="states" id="stateId" required>
<option value="">Select State</option>
</select>
<select style="display: inline;background-color: #FFF8E7;" name="city" class="cities" id="cityId" required>
<option value="">Select City</option>
</select>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//geodata.solutions/includes/countrystatecity.js"></script>
<br><br>

<input class="input" type="text" placeholder="Enter Company Name" name="company" id="comp" style="display:none" required>
<br id="br" style="display:none">
<input class="input" type="text" placeholder="Enter Street Name" name="street" id="street" style="display:none" required>
<br id="br1" style="display:none">
<input class="input" type="text" placeholder="Enter Apartment Name" name="apartment" id="apt" style="display:none"required>
<br id="br2" style="display:none" >
<input class="input" type="number" placeholder="Enter Zipcode" min="1" name="zipcode" id="zip" style="display:none"required>
<br id="br3" style="display:none">

<input class="input" type="text" placeholder="Enter Name" name="name" id="name" style="display:block" required>
<br id="br4" style="display:block">
<input class="input" type="text" placeholder="Enter Surname" name="surname" id="surname" style="display:block"required>
<br id="br5" style="display:block">


<button type="submit" name= "post" class="button">Register</button>
<br>
</form>


</body>
</html>

