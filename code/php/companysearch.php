<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Company Search</title>
</head>

<body style="background-color:#dddfd4;">
<header class="main-header">
    <div class="nav">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Job Search</a></li>
            <li><a class="active" href="#">Company Search</a></li>
            <li><a href="#">My Applications</a></li>
            <li><a href="#">My Profile</a></li>
        </ul>
    </div>
</header>
<br><br><br>

<form>
    <input class="input" style="display: inline-block;width: 15%;margin-left: 3%;" type="text" placeholder="Company Name" name="email" required>
    <input class="input" style="display: inline-block;width: 15%;margin-left: 3%;" type="text" placeholder="Location" name="psw" required>
    <button type="submit" class="button" style="display: inline-block; height: 50px; margin-left: 0px; ; background-color: transparent; box-shadow:none; color: #173e43; ">Search</button>
</form>

<div class="row">
    <div class="column" style="margin-left: 3%">

        <h2><a href="home.html" style="display: inline-block; height: 50px; font-size: 24px; margin-left: 30px;">Company Profile</a></h2> <br>

        <h3>Company Rating</h3> <br />
        <h3>CEO Rating</h3> <br />
        <h3>Reviews</h3> <br />



        <div class="pagination" style="margin-left: 15px;">
            <a href="#">&laquo;</a>
            <a href="#">1</a>
            <a href="#" class="active">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">&raquo;</a>
        </div>

    </div>

    <div class="column4" style="background-color: #b3c2bf; height: 500px; width: 20%; margin-left: 20px; padding: 10px;">
        <h2>Leave Review</h2>
        <form style="text-align: center">
            <select class="select" id="type" name="type" style="width: 100%;float: left" required>
                <option disabled value="">Choose Type for Review</option>
                <option value="Internship">Internship</option>
                <option value="Full Time">Full Time</option>
                <option value="Part Time">Part Time</option>
            </select>
            <br><br>
            <label class="switch"><input type="checkbox" id="togBtn">
                <div class="slider round">
                    <span class="on">Public</span>
                    <span class="off">Anon</span>
                </div>
            </label>

            <label for="comprate" style="display: block;visibility: hidden">Company Rating</label>
            <div class="rate" id="comprate">
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="text">1 star</label>
            </div>

            <label for="ceorate" style="display: block; font-size: 12px;">Company Rating</label>

            <div class="rate" id="ceorate">
                <input type="radio" id="star55" name="rate2" value="5" />
                <label for="star55" title="text">5 stars</label>
                <input type="radio" id="star44" name="rate2" value="4" />
                <label for="star44" title="text">4 stars</label>
                <input type="radio" id="star33" name="rate2" value="3" />
                <label for="star33" title="text">3 stars</label>
                <input type="radio" id="star22" name="rate2" value="2" />
                <label for="star22" title="text">2 stars</label>
                <input type="radio" id="star11" name="rate2" value="1" />
                <label for="star11" title="text">1 star</label>
            </div>

            <label for="ceorate" style="display: block; font-size: 12px; line-height: 72px; text-align: left;">CEO Rating</label>


            <input class="input" style="height: 6%;width: 100%" type="text" placeholder="Enter Interview Info" id="interview" required>
            <br>

            <input class="input" style="height: 6%;width: 100%" type="text" placeholder="Enter Salary Info" id="salary" required>
            <br>

            <input class="input" style="height: 6%;width: 100%" type="text" placeholder="Enter Review" id="review" required>
            <br>
            <button class="button" style="height: 40px; width: 50%; font-size: 16px;" type="submit">Publish</button>
        </form>

    </div>
</div>

</body>
</html>
