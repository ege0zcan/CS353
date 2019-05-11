<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Create Account</title>
</head>
<body style="background-color:#FF6F61;">
    <br>
    <h1 style="text-align:center;" onclick="location.href='http://google.com';">Glass Ceiling</h1>
    <br><br><br>


    <form>
        <!--
        <input type="button" class="button" name="userTypee" value="Employee" id="employee1" required>
        <input type="button" class="button" name="userTypee" value="Employer" id="employer1" required>


            <ul class="donate-now">
                <li>
                    <input type="radio" id="employee" name="userType" required>
                    <label for="employee">Employee</label>
                </li>
                <li>
                    <input type="radio" id="employer" name="userType">
                    <label for="employer">Employer</label>
                </li>
            </ul>
            -->

        <div id="donate">
            <label ><input type="radio" name="toggle" required><span>Employee</span></label>
            <label><input type="radio" name="toggle"><span>Employer</span></label>
        </div>


        <br>
        <input class="input" type="email" placeholder="Enter Email" name="email" required>
        <br>
        <input class="input" type="password" placeholder="Enter Password" name="psw" required>
        <br>
        <input class="input" type="text" placeholder="Enter Street Name" name="street" required>
        <br>
        <input class="input" type="text" placeholder="Enter Apartment Name" name="apartment" required>
        <br>
        <input class="input" type="number" placeholder="Enter Zipcode" min="1" name="zipcode" required>
        <br>
        <input class="input" type="number" placeholder="Enter Phone" min="1" name="phone" required>
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

        <button type="submit" class="button">Register</button>
        <br>
    </form>
</body>
</html>
